<?php
namespace App\Api;

use PhalApi\Api;
use App\Domain\Admin as AdminDomain;
use App\Domain\SetCookie as Cookie;

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
            ),
            'login' => array(
                'user' => array('name' => 'user'),
                'pwd'  => array('name' => 'pwd')
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
        $admin = $temp_model->getById(0);
        $admin = $admin[0];
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

    /**
     * 登陆博客
     * 
     * @param string user 用户名
     * @param string pwd  用户密码
     * 
     * @return bool 是否允许
     */
    public function login() {
        /**
         * 登陆成功之后 设置登陆状态为true  在之后的增删改操作中首先确认Cookie中有登陆状态再做操作
         */
        $adminUser = $this->model->getById(0);
        $adminUser = $adminUser[0];
        if( $adminUser['username'] == $this->user && $adminUser['pwd'] == $this->pwd ){
            //用户名与密码匹配
            //设置Cookie
            $data = array('islogin' => 1);
            return $this->model->update($data);
        } else {
            $this->logout();
        }
        return false;
    }
    /**
     * 获取管理员信息
     */
    public function getAdminInfo() {
        $data = $this->model->getAdminInfo();
        return $data;
    }
    /**
     * 是否已经登陆
     * @desc 设置用户已经登陆
     * 
     * @return string true or false 登陆与否
     */
    public function isLogin() {
        $admin = $this->model->getById(0);
        $admin = $admin[0];
        return $admin['islogin']==1 ? true : false;
    }
    /**
     * 退出登陆
     * 
     * @desc 将登陆cookie删除
     * 
     * @return bool 退出成功与否
     */
    public function logout() {
        $data = array('islogin' => 0);
        return $this->model->update($data);
    }
    /**
     * 获取验证码[弃用]
     * 
     * @return array [0]是图像 [1]是验证码
     */
    public function getCaptcha() {
        //session_start();
        $data = simple_php_captcha(array(
            'min_length' => 4,
            'max_length' => 4,
            'characters' => 'ABCDEFGHJKLMNPRSTUVWXYZabcdefghjkmnprstuvwxyz23456789',
            'color' => '#666',
            'angle_min' => 0,
            'angle_max' => 40,
            'shadow' => true,
            'shadow_color' => '#fff',
            'shadow_offset_x' => -5,
            'shadow_offset_y' => 5
        ));
        return $data;
    }
}
?>