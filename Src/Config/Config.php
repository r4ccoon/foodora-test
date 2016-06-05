<?php

namespace App\Config;

class Config
{
	static $mysql_server = "localhost";
	static $mysql_username = "homestead";
	static $mysql_password = "secret";
	static $mysql_database = "foodora-test";

	static $weekdays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];

	// hardcoded calendar for december specificly for this study case.
	// separated into three weeks. starting from monday 14th
	static $dates = [
		[14, 15, 16, 17, 18, 19, 20],
		[21, 22, 23, 24, 25, 26, 27],
		[28, 29, 30, 31, 1, 2, 3]
	];

	// 24 -> thu
	// 25 -> fri
	// 26 -> sat
	// 27 -> sunday
}
