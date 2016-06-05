<?php

namespace App\Util;

/**
 * Class View
 * A wrapper that take a file from
 * /view folder and render it accordingly
 * @package Util
 */
class View
{
	/**
	 * @param $string the file name (without ".php")
	 * @param array $params
	 */
	public function show($string, $params = [])
	{
		$template = __DIR__ . "/../View/" . $string . ".php";

		ob_start();
		require_once($template);
		$output = ob_get_contents();
		ob_end_clean();

		echo $output;
	}
}