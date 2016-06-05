<?php
namespace App\Util;

/**
 * Class StateManager
 * Manage application state,
 * Read args from cli command, and
 * route them based on the args
 * to the intended controller
 * @package Util
 */
class StateManager
{
	/**
	 * @var IController
	 */
	private $controller;

	/**
	 * StateManager constructor.
	 */
	public function __construct()
	{
	}

	public function switchState($argv)
	{
		if (isset($argv) && count($argv) > 1) {
			switch ($argv[1]) {
				case "ls":
					$this->controller = "App\Controller\ListController";
					break;
				case "show":
					$this->controller = "App\Controller\ShowController";
					break;
			}
		} else {
			$this->controller = "App\Controller\MainController";
		}

		$this->runState($argv);
	}

	private function runState($argv)
	{
		$controllerInstance = new $this->controller;
		$controllerInstance->run($argv);
	}
}