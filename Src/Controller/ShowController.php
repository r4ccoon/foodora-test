<?php
namespace Controller;

use \Util\View;
use \Model\Vendor;

class ShowController implements IController
{
	protected $controller;
	protected $model;

	public function __construct()
	{
		$this->model = new Vendor();
		$this->view = new View();
	}

	public function run()
	{
		$schedules = $this->model->getAllSchedule('bos');
		$this->view->show('vendor', ['schedule' => $schedules]);
	}
}