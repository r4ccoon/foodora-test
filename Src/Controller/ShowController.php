<?php
namespace App\Controller;

use App\Model\Schedule;
use App\Util\View;
use App\Model\Vendor;
use App\Config\Config;

class ShowController implements IController
{
	protected $controller;
	protected $model;

	public function __construct()
	{
		$this->model = new Schedule();
		$this->vendor_model = new Vendor();
		$this->view = new View();
	}

	public function run($params)
	{
		if (isset($params[2])) {
			$vendor_id = intval($params[2]);

			$schedules = $this->model->getAllBy(['vendor_id' => $vendor_id]);

			$sched_dict = array();
			// group the schedules based on days
			for ($i = 0; $i < count($schedules); $i++) {
				$date = $schedules[$i];
				$dayname = Config::$weekdays[$date['weekday'] - 1];
				$sched_dict[$dayname][] = $date;
			}

			$vendor = $this->vendor_model->getAllBy(['id' => $vendor_id]);
			$this->view->show('calendar', ['schedules' => $sched_dict, 'vendor' => $vendor, 'weekdays' => Config::$weekdays]);
		} else {
			echo "Please put in a correct vendor id";
		}
	}
}