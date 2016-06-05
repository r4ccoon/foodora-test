<?php
namespace App\Model;

use App\Util\MySqlWrapper as db;

/**
 * Class Model
 * Base class for common functionality of our database operation
 * @package Model
 */
class Model
{
	protected $table;

	public function getAll()
	{
		$sql = sprintf("select * from %s", $this->table);
		$vendor = db::select($sql);
		return $vendor;
	}

	public function getAllBy($params)
	{
		$sql = sprintf("select * from %s %s", $this->table, $this->createWhere($params));
		$vendor = db::select($sql);
		return $vendor;
	}

	protected function createWhere($params)
	{
		if (is_array($params) && count($params) > 0) {
			$where = array();
			foreach ($params as $key => $val) {
				$where[] = sprintf("%s = '%s'", $key, $val);
			}
			return sprintf("where %s", implode("and", $where));
		} else
			return "";
	}
}