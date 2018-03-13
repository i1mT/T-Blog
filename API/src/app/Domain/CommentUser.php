<?php 
namespace App\Domain;
use App\Model\CommentUser as CommentUserModel;
class CommentUser {
	private $model;
	function __construct() {
		$this->model = new CommentUserModel();
	}
	public function insert($data) {
		return $this->model->_insert($data);
	}
	public function updateById($id, $data) {
		return $this->model->updateById($id, $data);
	}
	public function getById($id) {
		return $this->model->getById($id);
	}
	public function deleteById($id) {
		return $this->model->delete($id);
	}
	public function getByName($name) {
		return $this->model->getByName($name);
	}
}
?>