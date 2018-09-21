<?php
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Cate extends NotORM {
	protected $model;
	function __construct() {
		$this->model = $this->getORM();
	}
	protected function getTableName($id) {
        return 'cate';
    }
    public function _insert($data) {
        $model = $this -> getORM();
        return $model->insert($data);
    }
    public function updateById($id, $data) {
        $model = $this -> getORM();
        return $model->where("id", $id)->update($data);
    }
    public function getById($id) {
        $model = $this -> getORM();
        return $model->where("id", $id);
    }
    public function getNameById($id) {
        $model = $this -> getORM();
        return $model->where('id', $id)->fetchOne();
    }
    public function getIdByName($name) {
        $model = $this -> getORM();
        return $model->where('name', $name)->fetchOne();
    }
    public function deleteById($id) {
        $model = $this -> getORM();
        return $modele->where('id', $id)->delete();
    }
    public function getAll() {
        $sql = "select * from cate where 1=1";
        $params = array();
        $model = $this -> getORM();
        return $model->queryAll($sql, $params);
    }
}

?>