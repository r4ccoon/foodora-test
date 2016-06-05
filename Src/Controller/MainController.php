<?php
namespace App\Controller;

use App\Util\View;

class MainController implements IController
{
	protected $controller;

	public function __construct()
	{
		$this->view = new View();
	}

	public function run($params)
	{
		$this->view->show('main');
	}
}