<?php 
namespace App\Domain;
use App\Model\Comment as CommentModel;
use App\Model\CommentUser as CommentUserModel;
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

		$data = $this->model->getAllByKey($key, $value);

		$res = array();
		while($row = $data -> fetch()) {
			$userModel = new CommentUserModel();
			$comment = $row;
			$user = $userModel -> getById($row["uid"]) -> fetchOne();
			
			$comment["name"] = $user["name"];
			$comment["email"] = $user["email"];
			$comment["site"] = $user["site"];

			array_push($res, $comment);
		}

		return $res;
	}

	public function addLikeById($id) {
		return $this -> model -> addLikeById($id);
	}
}
?>