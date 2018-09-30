<?php
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class BlogInfo extends NotORM {
	protected $model;
	function __construct() {
		$this->model = $this->getORM();
	}
	protected function getTableName($id) {
        return 'bloginfo';
    }
    public function _insert($data) {
        return $this->model->insert($data);
    }
    public function updateById($id, $data) {
        return $this->model->where("id", $id)->update($data);
    }
    public function getById($id) {
        return $this->model->where('id', $id);
    }
}

?>