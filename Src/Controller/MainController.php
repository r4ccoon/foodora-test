<?php
namespace Controller;

use \Util\View;

class MainController
{
	public function __construct()
	{
		$this->view = new View();
	}

	public function run()
	{
		$this->view->show('main');
	}
}