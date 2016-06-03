<?php
namespace \Util;

use \Config;

class MySql
{
	private $mysqli;

	private static $instance;

	public static function select($sql)
	{
		$result = self::getInstance()->mysqli->query($sql);
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
			self::$instance = new MySql();
		}

		return self::$instance;
	}


	private function __construct()
	{
		$this->mysqli = new mysqli(Config::mysql_server, Config::$mysql_username, Config::$mysql_password, Config::$mysql_password);
		$this->connect();
	}

	private function connect()
	{
		if ($this->mysqli->connect_errno) {
			die("Failed to connect to MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error);
		}
	}
}

