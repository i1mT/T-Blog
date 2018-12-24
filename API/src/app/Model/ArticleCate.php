<?php
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class ArticleCate extends NotORM {
	protected function getTableName($id) {
    return 'articlecate';
  }
  public function _insert($data) {
    $model = $this -> getORM();
    return $model -> insert($data);
  }
  public function getCatesByAid ($aid) {
    $model = $this -> getORM();

    return $model -> where('aid', $aid);
  }
  public function getArticleByCidLimit($cid, $start, $length) {
    $model = $this -> getORM();

    return $model -> order("id DESC") -> where('cid', $cid) -> limit($start, $length);
  }
}

?>