<?php 
namespace App\Domain;
use App\Model\Cate as CateModel;
class Cate {
	private $model;
	function __construct() {
		$this->model = new CateModel();
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
	public function getAll() {
		return $this->model->getAll();
	}
}
?>