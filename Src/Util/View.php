<?php

namespace Util;


class View
{
	public function show($string, $params)
	{
		$template = __DIR__ . "/../View/" . $string . ".php";

		ob_start();
		require_once($template);
		$output = ob_get_contents();
		ob_end_clean();

		echo $output;
	}
}