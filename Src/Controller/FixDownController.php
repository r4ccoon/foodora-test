<?php
namespace App\Controller;

use App\Util\View;
use App\Model\FixDown;

/**
 * Class FixDownController
 * restore everything again to the normal state
 * @package Controller
 */
class FixDownController implements IController
{
	protected $controller;
	protected $model;

	public function __construct()
	{
		$this->model = new FixDown();
	}

	public function run($params)
	{
		$this->fix();
	}

	private function fix()
	{
		echo "Running the revert\n";
		$this->model->runFix();
		echo "Finished the revert\n";
	}
}