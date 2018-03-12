<?php
namespace App\Api;

use PhalApi\Api;
use App\Domain\Admin as AdminDomain;

/**
 * admin管理类
 * 
 * @author: iimT tfhhh@qq.com 2018.3.11
 */
class Admin extends Api {
    protected $model;
    function __construct() {
        $this->model = new AdminDomain();
    }
    public function getRules() {
        return array(
            'initAdmin' => array(
                'nickname' => array('name' => 'nickname'),
                'pic' => array('name' => 'pic'),
                'username' => array('name' => 'username'),
                'pwd' => array('name' => 'pwd')
            ),
            'update' => array(
                'nickname' => array('name' => 'nickname'),
                'pic' => array('name' => 'pic'),
                'username' => array('name' => 'username'),
                'pwd' => array('name' => 'pwd')
            )
        );
    }
    /**
     * 创建博客的时候初始化博客用户信息
     * 
     * @param string nickname 用户昵称
     * @param string pic 用户头像
     * @param string username 用户名(登陆用)
     * @param string pwd 用户密码
     * 
     * @return int 成功返回0
     */
    public function initAdmin() {
        $data = array(
            'nickname' => $this->nickname,
            'pic' => $this->pic,
            'username' => $this->username,
            'pwd' => $this->pwd
        );
        return $this->model->insert($data);
    }
    /**
     * 更新用户信息
     * 
     * @param string nickname 用户昵称
     * @param string pic 用户头像
     * @param string username 用户名(登陆用)
     * @param string pwd 用户密码
     * 
     * @return int 有变化返回1 无变化返回0 错误返回false
     */
    public function update() {
        $temp_model = new AdminDomain();
        $admin = $temp_model->getById(0)[0];
        $data = array(
            'nickname' => $admin["nickname"],
            'pic' => $admin["pic"],
            'username' => $admin["username"],
            'pwd' => $admin["pwd"]
        );
        if($this->nickname) {
            $data["nickname"] = $this->nickname;
        }
        if($this->pic) {
            $data["pic"] = $this->pic;
        }
        if($this->username) {
            $data["username"] = $this->username;
        }
        if($this->pwd) {
            $data["pwd"] = $this->pwd;
        }
        return $this->model->update($data);
    }
}
?>