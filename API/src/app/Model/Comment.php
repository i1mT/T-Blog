<?php
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Comment extends NotORM {
	protected $model;
	function __construct() {
		$this->model = $this->getORM();
	}
	protected function getTableName($id) {
        return 'comment';
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
        return $this->modele->where('id',$id)->delete();
    }
    public function getAllByKey($key, $value) {
        return $this->model->order("id DESC")->where($key, $value);
    }
    public function addLikeById($id) {
        $model = $this -> getORM();
        return $model -> where('id', $id)->update(array('likes' => new \NotORM_Literal("`likes` + 1")));
    }
}

?>