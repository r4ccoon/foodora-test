<?php
namespace App\Controller;

use App\Util\View;
use App\Model\FixUp;

/**
 * Class FixUpController
 * update all regular days with special days
 * @package Controller
 */
class FixUpController implements IController
{
	protected $controller;
	protected $model;

	public function __construct()
	{
		$this->model = new FixUp();
		$this->view = new View();
	}

	public function run($params)
	{
		$this->fix();
	}

	private function fix()
	{
		echo "Running the Fix";
		$this->model->runFix();
		echo "Finished the Fix";
		//$this->view->show('fix', []);
	}
}