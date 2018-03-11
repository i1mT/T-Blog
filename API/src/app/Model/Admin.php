<?php
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Admin extends NotORM {
	protected $model;
	function __construct() {
		$this->model = $this->getORM();
	}
	protected function getTableName($id) {
        return 'admin';
    }
    public function _insert($data) {
        return $this->model->insert($data);
    }
    public function _update($data) {
        return $this->model->where("id", 0)->update($data);
    }
    public function getById($id) {
        return $this->model->where("id", $id);
    }
}

?>