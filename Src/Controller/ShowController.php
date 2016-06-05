<?php
namespace App\Controller;

use App\Util\View;
use App\Model\Vendor;

class ShowController implements IController
{
	protected $controller;
	protected $model;

	public function __construct()
	{
		$this->model = new Vendor();
		$this->view = new View();
	}

	public function run($params)
	{
		if (isset($params[2])) {
			$vendor_id = intval($params[2]);

			$schedules = $this->model->getAllBy(['vendor_id' => $vendor_id]);
			$this->view->show('vendor', ['schedule' => $schedules]);
		} else {
			echo "Please put in a correct vendor id";
		}
	}
}