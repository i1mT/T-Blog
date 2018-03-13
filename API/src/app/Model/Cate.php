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
        return $this->model->insert($data);
    }
    public function updateById($id, $data) {
        return $this->model->where("id", $id)->update($data);
    }
    public function getById($id) {
        return $this->model->where("id", $id);
    }
    public function deleteById($id) {
        return $this->modele->where('id', $id)->delete();
    }
    public function getAll() {
        $sql = "select * from cate where 1=1";
        $params = array();
        return $this->model->queryAll($sql, $params);
    }
}

?>