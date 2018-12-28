<?php
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;
use App\Model\Cate as CateModel;
use App\Model\ArticleCate as ArticleCateModel;

class Article extends NotORM {
	protected function getTableName($id) {
        return 'article';
    }
    public function _insert($data) {
        $model = $this -> getORM();
        return $model->insert($data);
    }
    public function updateById($data, $id) {
        $model = $this -> getORM();
        return $model->where("id", $id)->update($data);
    }
    public function getById($id) {
        $model = $this -> getORM();
        return $model->where("id", $id);
    }
    public function deleteById($id) {
        $model = $this -> getORM();
        return $model->where("id", $id)->delete();
    }
    public function getByLimit($offset, $lines) {
        $sql = "select * from article where 1=1 order by id desc limit :offset,:lines";
        $params = array(
            ":offset" => $offset,
            ":lines" => $lines
        );
        $model = $this -> getORM();
        $data = $model->queryAll($sql, $params);
        $res_data = array();
        foreach($data as $row) {
            $articleCateModel = new ArticleCateModel();
            $articleCate = $articleCateModel -> getCatesByAid($row['id']) -> fetchOne();
            $cateId = $articleCate['cid'];
            $cateModel = new CateModel();

            $cateName = $cateModel -> getNameById($cateId);
            $row['cateName'] = $cateName['name'];
            $row['cid'] = $cateId;

            array_push($res_data, $row);
        }
        return $res_data;
    }
    public function getCount() {
        $model = $this -> getORM();
        return $model->count('id');
    }
    public function countByCateId($id) {
        $model = $this -> getORM();
        $data = $model->where('cate',$id);
        return count($data);
    }

    public function getCardLimit ($start, $length, $cid = 0) {
        if ($cid != 0) {
            $sql = "select id, title, lastEdit, viewed, likes, cover from article where cid=:cid order by id desc limit :offset,:lines";
        }
        else {
            $sql = "select id, title, lastEdit, viewed, likes, cover from article order by id desc limit :offset,:lines";
        }
        $params = array(
            ":offset" => $start,
            ":lines" => $length,
            ":cid" => $cid
        );
        $model = $this -> getORM();
        $data = $model->queryAll($sql, $params);
        $res_data = array();
        foreach($data as $row) {
            $articleCateModel = new ArticleCateModel();
            $articleCate = $articleCateModel -> getCatesByAid($row['id']) -> fetchOne();
            $cateId = $articleCate['cid'];
            $cateModel = new CateModel();

            $cateName = $cateModel -> getNameById($cateId);
            $row['cateName'] = $cateName['name'];
            $row['cid'] = $cateId;

            array_push($res_data, $row);
        }
        return $res_data;
    }

    public function addLikeById($id) {
        $model = $this -> getORM();

        return $model -> where('id', $id)->update(array('likes' => new \NotORM_Literal("`likes` + 1")));
    }

    public function addViewById($id) {
        $model = $this -> getORM();

        return $model -> where('id', $id)->update(array('viewed' => new \NotORM_Literal("`viewed` + 1")));
    }
}

?>