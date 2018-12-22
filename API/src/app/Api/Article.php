<?php
namespace App\Api;

use PhalApi\Api;
use App\Domain\Article as ArticleDomain;
use App\Model\Article as articleModel;
use App\Model\Cate as CateModel;
use App\Model\ArticleCate as ArticleCateModel;
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
                'cover'   => array('name' => 'cover'),
            ),
            'publishByUpload' => array(
                'title'   => array('name' => 'title'),
                'cate'    => array('name' => 'cate'),
                'file'    => array(
                                    'name'  => 'file', 
                                    'type'  => 'file', 
                                    'min'   => 0, 
                                    'max'   => 2 * 1024 * 1024,
                                    'ext'   => array('md', 'MD')
                                ),
                'cover'   => array('name' => 'cover'),
            ),
            'deleteById' => array(
                'id'      => array('name' => 'id')
            ),
            'updateById' => array(
                'id'      => array('name' => 'id'),
                'title'   => array('name' => 'title'),
                'cate'    => array('name' => 'cate'),
                'content' => array('name' => 'content'),
                'cover'   => array('name' => 'cover'),
            ),
            'getPage'   => array(
                'page'    => array('name' => 'page'),
                'pageNum' => array('name' => 'pageNum'),
            ),
            'getCardPage' => array(
                'page'   => array('name' => 'page'),
                'pageNum' => array('name' => 'pageNum'),
            ),
            'addView' => array(
                'id'      => array('name' => 'id')
            ),
            'addLike' => array(
                'id'      => array('name' => 'id')
            ),
            'getById' => array(
                'id' => array('name' => 'id'),
            )
        );
    }
    /**
     * 发表文章
     * 
     * @param string title 文章标题
     * @param int    cate  文章分类名
     * @param string content 文章内容
     * @param string cover 文章封面地址
     * 
     * @return int 成功返回文章id
     */
    public function publish($isMD = false, $md = NULL) {
        //根据分类名获取分类id
        $cateModel = new CateModel();
        $cateId = $cateModel->getIdByName($this->cate);
        $cateId = $cateId['id'];
        if(!$cateId) {
            //新的分类 创建分类
            $cate = array('name' => $this->cate);
            $cateId = $cateModel->_insert($cate);
            $cateId = $cateId['id'];
        }
        //文章的结构
        $data = array(
            'title'     => $this->title,
            'cate'      => $cateId,
            'cover'     => $this->cover,
            'publishAt' => date("Y-m-d H:i:s"),
            'lastEdit'  => date("Y-m-d H:i:s"),
            'author'    => 1,
            'viewed'    => 0,
            'comments'  => 0,
            'likes'     => 0,
        );
        //如果有传入MD文件的内容的话  就用传入的MD文件的内容
        if($isMD) {
            $data['content'] = $md;
        } else {
            $data['content'] = $this->content;
        }
        return $this->model->insert($data);
    }
    /**
     * 上传文件发表文章
     * 
     * @param string title  文章标题
     * @param int    cate   文章分类名
     * @param file   upfile 文章内容
     * @param string cover  文章封面地址
     * 
     * @return int 成功返回文章id
     */
    public function publishByUpload() {
        $md = file_get_contents($this->file['tmp_name']);
        //读取到文件内容之后就删除上传的文件
        unlink($this->file['tmp_name']);
        return $this->publish(true, $md);
    }
    /**
     * 删除文章
     * 
     * @param int id 要删除的文章id
     * 
     * @return int 影响的行数
     */
    public function deleteById(){
        return $this->model->deleteById($this->id);
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
    public function updateById() {
        $data = array(
            "title"     => $this->title,
            "cate"      => $this->cate,
            "content"   => $this->content,
            "cover"     => $this->cover,
            "lastEdit"  => date("Y-m-d H:i:s"),
        );
        return $this->model->updateById($data, $this->id);
    }
    
    /**
     * 获取一页文章
     * 
     * @param int 页数
     * @param int 一页几个
     * 
     * @return array 文章数组
     */
    public function getPage() {
        $page = (($this->page)-1) * (int)$this->pageNum;
        return $this->model->getByLimit($page, (int)$this->pageNum);
    }

    /**
     * 获取文章总数
     * 
     * @return int 总数
     */
    public function getCount() {
        return $this->model->getCount();
    }

    /**
     * 根据id增加文章访问量
     * 
     * @param int id 文章id
     * 
     * @return int 成功返回1 无变化返回0 错误返回false
     */
    public function addView() {
        return $this->model->addViewById($this->id);
    }

    /**
     * 根据id增加文章赞数
     * 
     * @param int id 文章id
     * 
     * @return int 成功返回1 无变化返回0 错误返回false
     */
    public function addLike() {
        return $this->model->addLikeById($this->id);
    }


    public function getCardPage() {
        $model = new ArticleModel();
        $length = (int)$this -> pageNum;
        $start = ($this -> page - 1) * $length;
        $data = $model -> getCardLimit($start, $length);

        return $data;
    }

    public function getById() {
        $model      = new ArticleDomain();
        $data       = $model -> getById($this -> id) -> fetchOne();
        $acModel    = new ArticleCateModel();
        $cateModel  = new CateModel();
        $cates       = $acModel -> getCatesByAid($this -> id);
        $res        = array();

        while($row = $cates -> fetch()) {
            $cid    = $row["cid"];
            $cate   = $cateModel -> getById($cid) -> fetchOne();
            $res[] = $cate;
        }
        $data["cate"] = $res;
        return $data;
    }
}
?>