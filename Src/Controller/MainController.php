<?php
namespace App\Controller;

use App\Util\View;

/**
 * Class MainController
 * Class to show instruction screen
 * @package App\Controller
 */
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