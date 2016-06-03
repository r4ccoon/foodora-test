<?php
namespace Util;

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
					$this->controller = "\Controller\ListController";
					break;
				case "show":
					$this->controller = "\Controller\ShowController";
					break;
			}
		} else {
			$this->controller = "\Controller\MainController";
		}

		$this->runState($argv);
	}

	private function runState($argv)
	{
		$controllerInstance = new $this->controller;
		$controllerInstance->run($argv);
	}
}