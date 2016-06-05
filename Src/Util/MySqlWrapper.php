<?php
namespace App\Util;

use App\Config\Config;

/**
 * Class MySql
 * Manage connection, and basic sql operations
 * @package Util
 */
class MySqlWrapper
{
	private $mysqli_instance;

	private static $instance;

	public static function select($sql)
	{
		$result = self::getInstance()->mysqli_instance->query($sql);
		if (mysqli_num_rows($result) > 0) {
			$ret = [];
			// output data of each row
			while ($row = mysqli_fetch_assoc($result)) {
				$ret[] = $row;
			}

			return $ret;
		} else {
			return [];
		}
	}

	private static function getInstance()
	{
		if (self::$instance == null) {
			self::$instance = new MySqlWrapper();
		}

		return self::$instance;
	}


	private function __construct()
	{
		$this->connect();
	}

	private function connect()
	{
		$this->mysqli_instance = mysqli_connect(Config::$mysql_server, Config::$mysql_username, Config::$mysql_password, Config::$mysql_database);
		if ($this->mysqli_instance->connect_errno) {
			die("Failed to connect to MySQL: (" . $this->mysqli_instance->connect_errno . ") " . $this->mysqli_instance->connect_error);
		}
	}
}

