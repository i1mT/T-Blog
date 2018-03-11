<?php
namespace App\Api;

use PhalApi\Api;
use App\Domain\Article as ArticleDomain;

/**
 * article(文章)管理类
 * 
 * @author: iimT tfhhh@qq.com 2018.3.11
 */
class Article extends Api {
    protected $model;
    function __construct() {
        $this->model = new ArticleDomain();
    }
    public function getRules() {
        return array(
            'publish' => array(
                'title'   => array('name' => 'title'),
                'cate'    => array('name' => 'cate'),
                'content' => array('name' => 'content'),
                'cover'   => array('name' => 'comments'),
            ),
            'update' => array(
                'id'      => array('name' => 'id'),
                'title'   => array('name' => 'title'),
                'cate'    => array('name' => 'cate'),
                'content' => array('name' => 'content'),
                'cover'   => array('name' => 'comments'),
            ),
            'addView' => array(
                'id'      => array('name' => 'id')
            )
        );
    }
    /**
     * 发表文章
     * 
     * @param string title 文章标题
     * @param int    cate  文章分类
     * @param string content 文章内容
     * @param string cover 文章封面地址
     * 
     * @return int 成功返回文章id
     */
    public function publish() {
        //文章的结构
        $article_structer = array(
            'title'     => $this->title,
            'cate'      => $this->cate,
            'content'   => $this->content,
            'cover'     => $this->cover
            'publishAt' => date("Y-m-d H:i:s"),
            'lastEdit'  => date("Y-m-d H:i:s"),
            'author'    => 1,
            'viewed'    => 0,
            'comments'  => 0,
            'likes'     => 0,
        );
        return $this->model->insert($data);
    }
    /**
     * 更新文章
     * 
     * @param int    id      要更新的文章id
     * @param string title   文章标题
     * @param int    cate    文章分类
     * @param string content 文章内容
     * @param string cover   文章封面地址
     * 
     * @return int 成功返回1 无变化返回0 错误返回false
     */
    public function updateArticle() {
        $data = array(
            "title"     => $this->title;
            "cate"      => $this->cate;
            "content"   => $this->content;
            "cover"     => $this->cover;
            "lastEdit"  => date("Y-m-d H:i:s");
        );
        return $this->model->updateById($data, $this->id);
    }
    /**
     * 根据id增加文章访问量
     * 
     * @param int id 文章id
     * 
     * @return int 成功返回1 无变化返回0 错误返回false
     */
    public function addView() {
        $article = $this->model->getById($this->id);
        $viewed = $article["viewed"] + 1;
        $data = array(
            'viewed' => $viewed
        );

        return $this->model->updateById($data, $this->id);
    }

    /**
     * 根据id增加文章赞数
     * 
     * @param int id 文章id
     * 
     * @return int 成功返回1 无变化返回0 错误返回false
     */
    public function addView() {
        $article = $this->model->getById($this->id);
        $likes = $article["likes"] + 1;
        $data = array(
            'likes' => $likes
        );

        return $this->model->updateById($data, $this->id);
    }
}
?>