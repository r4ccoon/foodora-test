<?php
namespace App\Controller;

interface IController
{
	/**
	 * @return mixed
	 * will be called by StateManager when we switch app state.
	 */
	public function run($params);
}