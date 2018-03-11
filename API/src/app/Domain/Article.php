<?php 
namespace App\Domain;
use App\Model\Article as ArticleModel;
class Article {
	private $model;
	function __construct() {
		$this->model = new ArticleModel();
	}
	public function insert($data) {
        return $this->model->_insert($data);
    }
    public function updateById($data, $id) {
        return $this->model->updateById($data, $id);
    }
    public function getById($id) {
        return $this->model->getById($id);
    }
    public function deleteById($id) {
        return $this->model->deleteById($id);
    }
    public function getByLimit($offset, $lines) {
        return $this->model->getByLimit($offset, $lines);
    }
}
?>