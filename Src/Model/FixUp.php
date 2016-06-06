<?php
namespace App\Model;

use App\Util\MySqlWrapper as db;
use App\Config\Config;

/**
 * Class FixUp
 * 1. create temp column
 * 2. fill in temp column with original values
 * 3. overwrite original value with data from special_day table
 * @package App\Model
 */
class FixUp extends Model
{
	public function __construct()
	{
	}

	public function runFix()
	{
		$this->createTempTable();
		$this->fillInTempColumn();
		$this->fix();
	}

	private function createTempTable()
	{
		$sql = "ALTER TABLE `vendor_schedule` 
				  ADD (
					  `weekday_temp` tinyint(3) DEFAULT NULL,
					  `all_day_temp` tinyint(3) DEFAULT NULL,
					  `start_hour_temp` time DEFAULT NULL,
					  `stop_hour_temp` time DEFAULT NULL,
					  `event_type_temp` enum('opened','closed') CHARACTER SET latin1 DEFAULT NULL,
					  `is_temp_filled` tinyint(1) DEFAULT 0					  				 
				  )";

		db::execute($sql);
	}

	private function fillInTempColumn()
	{
		$sql = "UPDATE `vendor_schedule`   
				SET 
					`weekday_temp` = `weekday`,
					`all_day_temp` = `all_day`,
					`start_hour_temp` = `start_hour`,
					`stop_hour_temp` = `stop_hour`,
					`is_temp_filled` = 1
				WHERE `is_temp_filled` = 0";

		db::execute($sql);
	}

	/**
	 * fetch special days for every stores
	 * split the work by make it into several batches
	 *
	 */
	private function fix($offset = 0, $batch = 50)
	{
		// get all special day first
		$sql = sprintf(
			"SELECT * FROM `vendor_special_day`, (SELECT id as vid FROM `vendor` limit %d, %d) as B where vendor_id = B.vid ", $offset, $batch);

		$special_days = db::select($sql);

		for ($i = 0; $i < count($special_days); $i++) {
			$sp_day = $special_days[$i];
			$weekday = $this->getWeekDayFromDate($sp_day['special_date']);
			if ($weekday !== false) {
				if ($sp_day['event_type'] == 'closed' && $sp_day['all_day'] == 1) {
					// set weekday to 0 when they close all day.
					// I assume weekday of 0 will not be picked up by the current app
					// as another day, so it will show them as closed for this particular row
					$this->invalidateTime($weekday, $sp_day);
				} else if ($sp_day['event_type'] == 'opened') {
					// make the current data invalid so it wont be rendered
					$this->invalidateTime($weekday, $sp_day);

					// update it so it uses special day values
					$this->useSpecialDateValue($weekday, $sp_day);
				}
			}
		}
	}

	/**
	 * update the current value with one from special date table
	 * @param $weekday
	 * @param $sp_day
	 */
	private function useSpecialDateValue($weekday, $sp_day)
	{
		$sql_update = sprintf(
			"UPDATE `vendor_schedule` SET 
			`weekday` = %d,
			`all_day` = %d,
			`start_hour` = '%s',
			`stop_hour` = '%s'
			WHERE   
			`weekday_temp` = %d
			AND `vendor_id` = %d",
			$weekday, $sp_day['all_day'],
			$sp_day['start_hour'], $sp_day['stop_hour'],
			$weekday, $sp_day['vendor_id']);

		db::execute($sql_update);
	}

	/**
	 * make the current data invalid so it wont be rendered
	 * @param $weekday
	 * @param $sp_day
	 */
	private function invalidateTime($weekday, $sp_day)
	{
		$sql_update = sprintf(
			"UPDATE `vendor_schedule` SET 
						`weekday` = 0,
						`start_hour` = NULL,
						`stop_hour` = NULL
						WHERE   
						`weekday` = %d
						AND `vendor_id` = %d
					", $weekday, $sp_day['vendor_id']);

		db::execute($sql_update);
	}

	private function getWeekDayFromDate($sp_day)
	{
		// get what week day is this special day
		$t = explode('-', $sp_day);
		if (isset($t[2])) {
			// hardcoded to week 3 of december
			$weekday = array_search($t[2], Config::$dates[3]);
			return $weekday + 1;
		}

		return false;
	}
}