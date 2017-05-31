<?php
include_once "sql.php";
session_start();
class T_function{
    /*
     *登录  参数
     * 1.用户名  string
     * 2.密码    string
     */
    public function login($username,$password){
        $sql = new sql();
        $login_res = $sql->login($username,$password);
        if(!$login_res){
            $this->setLogStatus(false);
        }else{
            $this->setLogStatus(true);
        }
        return $login_res;
    }
    /*
     * 设置登录状态 参数
     * 1.状态 布尔值
     */
    public function setLogStatus($status){
        $_SESSION["logStatus"] = $status;
    }
    /*
     * 判断是否已经登录
     * 返回真假
     */
    public  function isLogin(){
        if(!array_key_exists("logStatus",$_SESSION)){
            //没有这个键值说明没有登录，设置登录状态为否
            $this->setLogStatus(false);
        }
        $status = $_SESSION["logStatus"];
        // if($status) $this->webLog("已经登录");
        // else $this->webLog("未登录");
        return $status;
    }
    /*
     * 登出
     */
    public function logout(){
        $_SESSION["logStatus"] = false;
        return true;
    }
    /*
     * 设置博客名 参数
     * 1.博客名 string
     */
    public function setBlogname($blogname){
        $sql = new sql();
        $res = $sql->editBlogName($blogname);
        return $res;
    }
    /*
     * 设置博客介绍
     * 参数
     * 1.博客描述  string
     */
    public function setBlogdesc($blogdesc){
        $sql = new sql();
        $res = $sql->editBlogDesc($blogdesc);
        return $res;
    }
    /*
     * 设置博客地址
     * 参数
     * 1.地址  string
     */
    public function setBlogurl($blogurl){
        $sql = new sql();
        $res = $sql->editBlogSiteurl($blogurl);
        return $res;
    }
    /*
     * 发布文章
     * 参数
     * 1.article  数组
     * 数组必须包含以下属性
     * article["title"]   文章标题
     * article["cate"]    文章分类id
     * article["content"] 文章内容 MD格式
     * article["cover"]   文章封面图片地址
     */
    public function publishArticle($article){
        $sql = new sql();
        $res = $sql->publishArticle($article);
        return $res;
    }
    /*
     * 更新文章
     * 参数
     * 1.push_article 对象
     * 对象必含属性
     * article["id"]      要更新的文章id
     * article["title"]   文章标题
     * article["cate"]    文章分类id
     * article["content"] 文章内容 MD格式
     * article["cover"]   文章封面图片地址
     */
    public function updateArticle($push_article){
        $id = $push_article["id"];
        $sql = new sql();
        $res = $sql->updateArticle($id,$push_article);
        return $res;
    }
    /*
     * 删除文章
     * 参数
     * 1.id
     */
    public function deleteArticle($id){
        $sql = new sql();
        $res = $sql->deleteArticle($id);
        return $res;
    }
    /*
     * 搜索标题中含有关键字的文章
     * 参数
     * 1.key 关键字
     * 返回所有关键字的文章 一个数组，数组元素为article对象
     */
    public function searchArticle($key){
        $sql = new sql();
        $res = $sql->searchArticle($key);
        $result = array();
        while($row = $res->fetch_array()){
            array_push($result,$row);
        }
        //将数组包装为json格式
        $result = urldecode(json_encode($result));
        return $result;
    }
    /*
     * 根据分类名查找文章
     * 参数
     * 1.分类名  string
     * 返回值 查询结果的数组对象
     */
    public function searchByCate($cate){
        $sql = new sql();
        //获取分类对应的id
        $cateId = $sql->getCateId($cate);
        if($cateId < 0) return -1;
        $result = array();
        $res = $sql->searchByCate($cateId);
        while($row = $res->fetch_array()){
            array_push($result,$row);
        }
        return $result;
    }
    /*
     * 获取所有文章
     * 无参数
     * 返回值
     * json   string
     */
    public function getAllArticle(){
        $sql = new sql();
        $result = array();
        $res = $sql->showArticleAll();
        while($row = $res->fetch_array()){
            array_push($result,$row);
        }
        $result = urldecode(json_encode($result));
        return $result;
    }
    /*
     * 获取文章下所有评论
     * 无参数
     * 返回值
     * json string
     */
    public function getArticleComment($id){
        $sql = new sql();
        $result = array();
        $res = $sql->showArticleComment($id);
        while($row = $res->fetch_array()){
            array_push($result,$row);
        }
        $result = urldecode(json_encode($result));
        return $result;
    }
    /*
     * 获取文章下所有评论
     * 无参数
     * 返回值
     * 数组
     */
    public function getArticleCommentArr($id){
        $sql = new sql();
        $result = array();
        $res = $sql->showArticleComment($id);
        while($row = $res->fetch_array()){
            array_push($result,$row);
        }
        for($i = 0; $i < count($result); $i++) {
            $user = $sql->getCommentUserInfo($result[$i]['uid']);
            $user = $user->fetch_array();
            $result[$i]["name"] = $user['name'];
            $result[$i]["email"] = $user['email'];
            $result[$i]['site'] = $user['site'];
        }
        return $result;
    }
    /*
     * 根据评论id删除评论
     * 参数
     * 1.id
     * 返回bool
     */
    public function deleteComment($id){
        $sql = new sql();
        $res = $sql->deleteComment($id);
        return $res;
    }
    /*
     * 获取所有评论
     * 参数无
     * 返回json  string
     */
    public function getCommentAll(){
        $sql = new sql();
        $result = array();
        $res = $sql->showComment();
        while($row = $res->fetch_array()){
            array_push($result,$row);
        }
        $result = urldecode(json_encode($result));
        return $result;
    }
    /*
     * 前端获取文章信息方法
     * 接受参数
     * 1.page = 1
     * 2.cate = null
     */
    public function getArticle($page = 1, $cate = null){
        $article = array();//要push过去的数据
        if(!$cate){
            $art = $this->getAllArticle();
            $art = json_decode($art);
        }else{
            $art = $this->searchByCate($cate);
        }
        $start = count($art) - 8*($page-1);
        $end = ($start-8)<0 ? 0 : ($start-8);
        for($i = $start-1; $i >= $end; $i--){
            array_push($article,$art[$i]);
        }
        return $article;
    }
    /*
     * 获取文章总数量  或指定分类下的总数量
     * 参数cate = null
     */
    public function getArticleNum($cate = null){
        if(!$cate){
            $art = $this->getAllArticle();
            $art = json_decode($art);
        }else{
            $art = $this->searchByCate($cate);
        }
        return count($art);
    }
    /*
     * 根据id获取文章详细信息
     * 参数
     * 1.id
     * 返回值 article数组
     */
    public function getArticleById($id){
        $sql = new sql();
        $res = $sql->getArticleById($id);
        $res = $res->fetch_array();
        $cate_name = $sql->getCateNameById($res['cate']);
        $res['cate'] = $cate_name;
        return $res;
    }
    /*
     * 增加文章喜欢数
     * 参数
     * 1.id 文章id
     */
    public function raiseArticleLikes($id){
        $sql = new sql();
        $res = $sql->creaseArticleLike($id);
        return $res;
    }
    /*
     * 减少文章喜欢数
     * 参数
     * 1.id 文章id
     */
    public function deraiseArticleLikes($id){
        $sql = new sql();
        $res = $sql->decreaseArticleLike($id);
        return $res;
    }
    /*
     * 评论赞+1
     * 参数
     * 1.id 评论id
     */
    public function addCommentLike($id){
        $sql = new sql();
        $res = $sql->creaseCommentLike($id);
        return $res;
    }
    /*
     * 评论赞-1
     * 参数
     * 1.id 评论id
     */
    public function minusCommentLike($id){
        $sql = new sql();
        $res = $sql->decreaseCommentLike($id);
        return $res;
    }
    /*
     * 文章浏览数+1
     */
    public function addArticleViewed($id){
        $sql = new sql();
        $sql->creaseArticleViewed($id);
    }
    /*
     * 添加评论
     * 参数
     * 数组
     */
    public function addComment($get){
        $sql = new sql();
        if(!$sql->addCommentUser($get['name'],$get['email'],$get['site']))
            return false;
        $uid = $sql->getUserIdByName($get['name']);
        if(!$uid)
            return false;
        return $sql->publishComment($get['id'],$uid,$get['content']);
    }
    /*
    * 输出博客信息
    * 参数
    * 信息的名称 可接受的值为:
    * name 博客名
    * description 博客介绍
    * starttime 博客开始时间
    * siteurl 博客首页地址
    */
    public function bloginfo($infoname){
        $sql = new sql();
        $bloginfo = $sql->getBlogInfo();
        echo $bloginfo[$infoname];
    }
}
?>