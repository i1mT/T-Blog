<?php
namespace App\Api;

use PhalApi\Api;
use App\Domain\CommentUser as CommentUserDomain;

/**
 * CommentUser 评论用户管理类
 * 
 * @author: iimT tfhhh@qq.com 2018.3.12
 */
class CommentUser extends Api {
    protected $model;
    function __construct() {
        $this->model = new CommentUserDomain();
    }
    public function getRules() {
        return array(
            'add' => array(
                'name'   => array('name' => 'name'),
                'email'  => array('name' => 'email'),
                'site'   => array('name' => 'site'),
            ),
            'updateById' => array(
                'id'     => array('name' => 'id'),
                'name'   => array('name' => 'name'),
            )
        );
    }

    /**
     * 新增一个评论用户
     * 
     * @param string name 评论用户名
     * @param string email 评论用户的邮箱
     * @param string site 评论用户的个人主页
     * 
     * @return int 新增评论用户的id
     */
    public function add() {
        $data = array(
            'name'   => $this->name,
            'email'  => $this->email,
            'site'   => $this->site,
        );
        return $this->model->insert($data);
    }
    /**
     * 根据id获取评论用户
     * 
     * @param int id 要获取的用户id
     * 
     * @return array 评论用户
     */
    public function getById() {
        return $this->model->getById($this->id);
    }
}
?>