<?php
namespace app\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Activity extends NotORM {
    protected function getTableName ($id) {
        return 'activity';
    }

    public function getById ($id) {
        $model = $this -> getORM();

        $result = $model -> where("id", $id) -> fetchOne();
        return $result;
    }

    public function add ($data) {
        $model = $this -> getORM();

        return $model -> insert($data);
    }

    public function deleteById($id) {
        $model = $this -> getORM();

        return $model -> where('id', $id) -> delete();
    }

    public function updateById ($id, $data) {
        $model = $this -> getORM();

        return $model -> where('id', $id) -> update ($data);
    }

    public function getPage ($start, $length) {
        $model = $this -> getORM();

        return $model -> order('id desc') -> limit($start, $length) ->fetchAll();;
    }

    public function getCount() {
        $model = $this -> getORM();
        
        return $model->count('id');
    }
}


?>