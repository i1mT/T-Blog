<?php
namespace App\Api;

use PhalApi\Api;
use App\Model\Friends as FriendsModel;

/**
 * 友情链接类
 * 
 * @author: iimT tfhhh@qq.com 2018.3.12
 */
class Friends extends Api {
    protected $model;
    public function getRules() {
        return array(
            'getById' => array(
                'id' => array('name' => 'id'),
            ),
            'deleteById' => array(
                'id' => array('name' => 'id'),
            ),
            'add' => array(
                'title' => array('name' => 'title'),
                'url' => array('name' => 'url'),
            ),
            'updateById' => array(
                'id' => array('name' => 'id', 'require' => true),
                'title' => array('name' => 'title'),
                'url' => array('name' => 'url'),
                'status' => array('name' => 'status'),                
            )
        );
    }

    public function getById () {
        $id = $this -> id;
        $model = new FriendsModel();

        return $model -> getById($id);
    }

    public function getAll () {
        $model = new FriendsModel();

        return $model -> getAll();
    }

    public function deleteById () {
        $model = new FriendsModel();
        
        return $model -> deleteById($this -> id);
    }

    public function add () {
        $model = new FriendsModel();
        $data = array(
            'url' => $this -> url,
            'title' => $this -> title
        );
        return $model -> add($data);
    }

    public function updateById () {
        $model = new FriendsModel();

        $data = array();
        if($this -> title) {
            $data['title'] = $this -> title;
        }
        if($this -> url) {
            $data['url'] = $this -> url;
        }
        if($this -> status) {
            $data['status'] = $this -> status;
        }

        return $model -> updateById($this -> id, $data);
    }
    
}
?>