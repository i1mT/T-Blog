<?php
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class CommentUser extends NotORM {
	protected $model;
	function __construct() {
		$this->model = $this->getORM();
	}
	protected function getTableName($id) {
        return 'comment_user';
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

    public function getByName($name) {
        return $this->model->where('name', $name);
    }
}

?>