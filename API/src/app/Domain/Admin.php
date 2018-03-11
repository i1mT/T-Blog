<?php 
namespace App\Domain;
use App\Model\Admin as AdminModel;
class Admin {
	private $model;
	function __construct() {
		$this->model = new AdminModel();
	}
	public function insert($data) {
		return $this->model->_insert($data);
	}
	public function update($data) {
		return $this->model->_update($data);
	}
	public function getById($id) {
		return $this->model->getById($id);
	}
}
?>