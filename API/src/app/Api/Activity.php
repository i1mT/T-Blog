<?php
namespace App\Api;

use PhalApi\Api;
use App\Model\Activity as ActivityModel;
/**
 * Activity(动态)管理类
 * 
 * @author: iimT tfhhh@qq.com 2018.12.27
 */
class Activity extends Api {

    public function getRules() {
        return array(
            'getPage' => array(
                'page'   => array('name' => 'page', 'default' => 1),
                'length' => array('name' => 'length', 'default' => 10)
            ),
            'getById' => array(
                'id'   => array('name' => 'id', 'required' => true),
            ),
            'add' => array(
                'content'   => array('name' => 'content', 'required' => true),
                'images'   => array('name' => 'images', 'required' => true),
            ),
            'updateById' => array(
                'id'   => array('name' => 'id', 'required' => true),
                'content'   => array('name' => 'content',),
                'images'   => array('name' => 'images',),
            ),
            'deleteById' => array(
                'id'   => array('name' => 'id', 'required' => true),
            ),
        );
    }

    public function getPage () {
        $model = new ActivityModel();

        $length = $this -> length;
        $start = $length * ($this -> $page - 1);
        return $model -> getPage($start, $length);
    }

    public function getById () {
        $model = new ActivityModel();

        return $model -> getById($this -> id);
    }

    public function add () {
        $model = new ActivityModel();

        $data = array(
            'content' => $this -> content,
            'images' => $this -> images,
        );

        return $model -> add($this -> id, $data);
    }
    
    public function updateById () {
        $model = new ActivityModel();

        $data = array();

        if ($this -> content) {
            $data['content'] = $this -> content;
        }

        if ($this -> imgs) {
            $data['imgs'] = $this -> imgs;
        }

        return $model -> add($this -> id, $data);
    }

    public function deleteById () {
        $model = new ActivityModel();

        return $model -> deleteById($this -> id);
    }

    public function getCount () {
        $model = new ActivityModel();

        return $model -> getCount();
    }

}