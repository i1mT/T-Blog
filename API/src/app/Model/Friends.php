<?php
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Friends extends NotORM {
	protected function getTableName($id) {
        return 'friends';
    }

    public function getAll() {
        $model = $this -> getORM();
        $res = $model -> fetchAll();
        return $res;
    }

    public function updateById ($id, $data) {
        $model = $this -> getORM();

        return $model -> where('id', $id) -> update($data);
    }

    public function add ($data) {
        $model = $this -> getORM();

        $model -> insert($data);
        return $model -> insert_id();
    }

    public function deleteById ($id) {
        $model = $this -> getORM();

        return $model -> where('id', $id) -> delete();
    }

    public function getById ($id) {
        $model = $this -> getORM();

        return $model -> where('id', $id) -> fetchOne();
    }
}