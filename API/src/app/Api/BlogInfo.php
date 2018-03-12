<?php
namespace App\Api;

use PhalApi\Api;
use App\Domain\BlogInfo as BlogInfoDomain;

/**
 * BlogInfo管理类
 * 
 * @author: iimT tfhhh@qq.com 2018.3.12
 */
class BlogInfo extends Api {
    protected $model;
    function __construct() {
        $this->model = new BlogInfoDomain();
    }
    public function getRules() {
        return array(
            'initBlog' => array(
                'name' => array('name' => 'name'),
                'description' => array('name' => 'description'),
                'siteurl' => array('name' => 'siteurl'),
                'starttime' => array('name' => 'starttime')
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
     * 创建博客的时候初始化博客信息
     * 
     * @param string name 博客名称
     * @param string description 博客描述
     * @param string siteurl 博客域名
     * @param date starttime 博客建立时间
     * 
     * @return int 成功返回0(id)
     */
    public function initBlog() {
        $data = array(
            'name' => $this->name,
            'description' => $this->description,
            'siteurl' => $this->siteurl,
            'starttime' => $this->starttime
        );
        return $this->model->insert($data);
    }
    /**
     * 更新博客信息
     * 
     * @param string nickname 用户昵称
     * @param string pic 用户头像
     * @param string username 用户名(登陆用)
     * @param string pwd 用户密码
     * 
     * @return int 有变化返回1 无变化返回0 错误返回false
     */
    public function update() {
        $data = array();
        if($this->nickname != NULL) {
            $data["name"] = $this->name;
        }
        if($this->pic != NULL) {
            $data["description"] = $this->description;
        }
        if($this->username != NULL) {
            $data["siteurl"] = $this->siteurl;
        }
        if($this->pwd != NULL) {
            $data["starttime"] = $this->starttime;
        }
        return $this->model->update($data);
    }

    /**
     * 获取博客信息
     * 
     * @return array 博客信息数组
     */
    public function getBlogInfo() {
        return $this->model->getById(0);
    }
}
?>