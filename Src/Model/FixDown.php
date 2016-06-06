<?php
namespace App\Model;

use App\Util\MySqlWrapper as db;

/**
 * Class FixDown
 * 1. copy old value in temp column to original column
 * 2. drop temp column
 * @package App\Model
 */
class FixDown extends Model
{
	public function __construct()
	{
	}

	public function runFix()
	{
		$this->rollBackFromTempColumn();
		$this->dropTempTable();
	}

	private function dropTempTable()
	{
		$sql = "ALTER TABLE `vendor_schedule` 
				  DROP 
				  `weekday_temp`,
				  `all_day_temp`,
				  `start_hour_temp`,
				  `stop_hour_temp`,
				  `event_type_temp`,
				  `is_temp_filled`";

		db::execute($sql);
	}

	private function rollBackFromTempColumn()
	{
		$sql = "UPDATE `vendor_schedule`   
				SET 
				 	`weekday` = `weekday_temp`,
					 `all_day` = `all_day_temp`,
					 `start_hour` = `start_hour_temp`,
					 `stop_hour` = `stop_hour_temp` 
				WHERE `is_temp_filled` = 1";

		db::execute($sql);
	}
}