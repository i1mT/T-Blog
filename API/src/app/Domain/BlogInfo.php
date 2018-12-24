<?php 
namespace App\Domain;
use App\Model\BlogInfo as BlogInfoModel;
class BlogInfo {
	private $model;
	function __construct() {
		$this->model = new BlogInfoModel();
	}
	public function insert($data) {
		return $this->model->_insert($data);
	}
	public function update($id, $data) {
		return $this->model->updateById($id, $data);
	}
	public function getById($id) {
		return $this->model->getById($id);
	}
}
?>