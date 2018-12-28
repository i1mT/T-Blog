<?php
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class ArticleCate extends NotORM {
	protected function getTableName($id) {
    return 'articlecate';
  }
  public function _insert($data) {
    $model = $this -> getORM();
    $model -> where('aid', $data['aid']) -> delete(); // 删除原有的文章分类，一个文章只会有一个分类
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
  public function countByCateId ($cid) {
    $model = $this -> getORM();

    return $model -> where("cid", $cid) -> count('id');
  }
}

?>