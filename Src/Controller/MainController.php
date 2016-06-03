<?php
namespace Controller;

use \Util\View;

class MainController implements IController
{
	protected $controller;

	public function __construct()
	{
		$this->view = new View();
	}

	public function run()
	{
		$this->view->show('main');
	}
}