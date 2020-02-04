<?php
namespace App\Domain;
use App\Model\Article as ArticleModel;
class Article {
	public function insert($data) {
        $model = new ArticleModel();
        return $model -> _insert($data);
    }
    public function updateById($data, $id) {
        $model = new ArticleModel();
        return $model -> updateById($data, $id);
    }
    public function getById($id) {
        $model = new ArticleModel();
        return $model -> getById($id);
    }
    public function deleteById($id) {
        $model = new ArticleModel();
        return $model -> deleteById($id);
    }
    public function getByLimit($offset, $lines) {
        $model = new ArticleModel();
        return $model -> getByLimit($offset, $lines);
    }
    public function getCount() {
        $model = new ArticleModel();
        return $model -> getCount();
    }
    public function getCardLimit($start, $length) {
        $model = new ArticleModel();
        return $model -> getCardLimit($start, $length);
    }

    public function addLikeById($id) {
        $model = new ArticleModel();
        return $model -> addLikeById($id);
    }

    public function addViewById($id) {
        $model = new ArticleModel();
        return $model -> addViewById($id);
    }
}
?>