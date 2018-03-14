<?php
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;
use App\Model\Cate as CateModel;

class Article extends NotORM {
	protected $model;
	function __construct() {
		$this->model = $this->getORM();
	}
	protected function getTableName($id) {
        return 'article';
    }
    public function _insert($data) {
        return $this->model->insert($data);
    }
    public function updateById($data, $id) {
        return $this->model->where("id", $id)->update($data);
    }
    public function getById($id) {
        return $this->model->where("id", $id);
    }
    public function deleteById($id) {
        return $this->model->where("id", $id)->delete();
    }
    public function getByLimit($offset, $lines) {
        $sql = "select * from article where 1=1 limit :offset,:lines";
        $params = array(
            ":offset" => $offset,
            ":lines" => $lines
        );
        $data = $this->model->queryAll($sql, $params);
        $res_data = array();
        foreach($data as $row) {
            $cateId = $row['cate'];
            $cateModel = new CateModel();

            $cateName = $cateModel->getNameById($cateId);
            $row['cateName'] = $cateName['name'];

            array_push($res_data, $row);
        }
        return $res_data;
    }
    public function getCount() {
        return $this->model->count('id');
    }
    public function countByCateId($id) {
        $data = $this->model->where('cate',$id);
        return count($data);
    }
}

?>