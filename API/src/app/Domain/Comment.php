<?php 
namespace App\Domain;
use App\Model\Comment as CommentModel;
class Comment {
	private $model;
	function __construct() {
		$this->model = new CommentModel();
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
	public function getAllByKey($key, $value) {
		return $this->model->getAllByKey($key, $value);
	}
}
?>