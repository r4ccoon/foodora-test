<?php
namespace App\Controller;

use App\Util\View;
use App\Model\Vendor;

/**
 * Class ListController
 * List all vendors
 * @package Controller
 */
class ListController implements IController
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
		$this->listVendors();
	}

	private function listVendors()
	{
		$vendors = $this->model->getAll();
		$this->view->show('vendor', ['vendors' => $vendors]);
	}
}