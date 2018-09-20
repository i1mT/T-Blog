<?php
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Nh extends NotORM {
	protected $model;
	function __construct() {
		$this -> model = $this->getORM();
	}
	protected function getTableName($id) {
    return 'nh';
  }
  public function add($data) {
    return $this -> getORM() -> insert($data);
  }

  public function getPage() {
    $model = $this -> getORM();
    $res = $model -> select('id, plat, url') -> where('status', 1);
    return $res -> fetchAll();
  }

  public function updateById($id, $data) {
    $model = $this->getORM();
    return $model -> where('id', $id) -> update($data);
  }
}

?>