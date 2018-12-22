<?php
namespace App\Api;

use PhalApi\Api;
use App\Domain\Comment as CommentDomain;
use App\Domain\CommentUser as CommentUserDomain;

/**
 * Comment(评论)管理类
 * 
 * @author: iimT tfhhh@qq.com 2018.3.12
 */
class Comment extends Api {
    protected $model;
    function __construct() {
        $this->model = new CommentDomain();
    }
    public function getRules() {
        return array(
            'add' => array(
                'content'   => array('name' => 'content'),
                'articleid' => array('name' => 'articleid'),
                'name'      => array('name' => 'name'),
                'email'     => array('name' => 'email'),
                'site'      => array('name' => 'site'),
            ),
            'getAllByArticleId' => array(
                'id'   => array('name' => 'id')
            ),
            'updateById' => array(
                'id'   => array('name' => 'id'),
                'name' => array('name' => 'name'),
            ),
            'addLikes' => array(
                'id' => array('name' => 'id'),
            ),
            'deleteById' => array(
                'id' => array('name' => 'id'),
            ),
        );
    }

    /**
     * 新增一个评论
     * 
     * @param string content 评论内容
     * @param string name 评论用户的名称
     * @param string email 评论用户的邮箱
     * @param string stie 评论用户的个人主页
     * @param int articleid 评论的文章id
     * 
     * @return array 增加成功返回此条评论
     */
    public function add() {
        //新增一个评论用户
        $CommentUser = new CommentUserDomain();
        $commentUserData = array(
            'name'  => $this->name,
            'email' => $this->email,
            'site'  => $this->site,
        );
        $uid = $CommentUser->insert($commentUserData);
        $data = array(
            'content'     => $this->content,
            'articleid'   => $this->articleid,
            'likes'       => 0,
            'commenttime' => date('Y:m:d H:i:s'),
            'uid'         => $uid,
        );

        return $this->model->insert($data);
    }
    
    /**
     * 获取指定文章的所有评论
     * 
     * @param int 文章id
     * 
     * @return array 评论数组
     */
    public function getAllByArticleId() {
        return $this->model->getAllByKey('articleid', $this->id);
    }

    /**
     * 根据id删除评论
     * 
     * @param int 评论id
     * 
     * @return int 影响的行数
     */
    public function deleteById() {
        return $this->model->deleteById($this->id);
    }

    /**
     * 根据id给评论点赞
     * 
     * @param int id 评论id
     * 
     * @return int 成功返回1 无变化返回0 错误返回false
     */
    public function addLikes() {
        return $this->model->addLikeById($this->id);
    }
}
?>