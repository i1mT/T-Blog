<?php
namespace App\Api;

use PhalApi\Api;
use App\Model\Nh as NhModel;

/**
 * Nh 类
 * 
 * @author: iimT tfhhh@qq.com 2018.3.11
 */
class Nh extends Api {
    protected $model;
    function __construct() {
        $this->model = new NhModel();
    }
    public function getRules() {
        return array(
            'add'        => array(
              'plat'     => array('name' => 'plat'),
              'url'   => array('name' => 'url'),
            ),
            'updateById' => array(
              'id'   => array('name' => 'id'),
              'status'   => array('name' => 'status', 'default' => 0),
            ),
        );
    }

    /**
     * 增加一条
     */
    public function add() {
      $model = new NhModel();
        $data = array(
            'plat' => $this -> plat,
            'url' => $this -> url
        );
        return $model -> add($data);
    }

    public function getPage() {
      $model = new NhModel();
      return $model -> getPage();
    }

    public function updateById() {
      $data = array(
        'status' => $this -> status,
      );

      return $this -> model -> updateById($this -> id, $data);
    }
}
?>