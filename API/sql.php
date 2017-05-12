<?php
header("Content-type: text/html; charset=utf-8");
include_once "../install_info.php";
$a = new sql();
$a->init();

/****************************数据库操作类*****************************/
class sql{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;
    private $t;

    /*--------------------------------接口---------------------------*/
    /*
     * 初始化数据库
     */
    public function init(){
        $this->servername = "allsite.com";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "t-blog";
        $this->conn = new mysqli($this->servername, $this->username, $this->password,$this->dbname);
        $this->conn->set_charset("utf8");
        if($this->conn->connect_error){
            die("连接失败: " . $this->conn->connect_error);
        }else{
        }
    }
    /*
     * 登录 参数
     * 1.用户名
     * 2.密码
     * 返回真假表示是否能够匹配登录
     */
    public function login($user,$pwd){
        $this->init();
        $sql = "SELECT * FROM `admin` WHERE `username` = '" . $user . "' AND `pwd` = '" . $pwd . "'";
        $sql_res = $this->conn->query($sql);
        if($sql_res->num_rows > 0)
            return true;
        else
            return false;
    }
    /*
     * 设置博客名
     * 返回真假-成功与否信息
     */
    public function editBlogName($name){
        $this->init();
        $sql = "UPDATE `bloginfo` SET `name` = '$name' WHERE `bloginfo`.`id` = 1";
        $sql_res = $this->conn->query($sql);
        return $sql_res;
    }
    /*
     * 设置博客介绍
     * 返回真假-成功与否信息
     */
    public function editBlogDesc($desc){
        $this->init();
        $sql = "UPDATE `bloginfo` SET `description` = '$desc' WHERE `bloginfo`.`id` = 1";
        $sql_res = $this->conn->query($sql);
        return $sql_res;
    }
    /*
     * 设置博客地址
     * 返回真假-成功与否
     */
    public function editBlogSiteurl($url){
        $this->init();
        $sql = "UPDATE `bloginfo` SET `siteurl` = '$url' WHERE `bloginfo`.`id` = 1";
        $sql_res = $this->conn->query($sql);
        return $sql_res;
    }
    /*
     * 发布文章  参数 1.article数组
     * 数组中必须包括一下内容
     * article["title"]   文章标题
     * article["cate"]    文章分类id
     * article["content"] 文章内容 MD格式
     * article["cover"]   文章封面图片地址
     * 返回布尔 表示成功与否
     */
    public function publishArticle($article){
        $this->init();
        //如果传过来的值已经存在就不需要重新赋值
        if(!array_key_exists("publishAt" ,$article))
            $article["publishAt"] = date("Y-m-d H:i:s");
        if(!array_key_exists("lastEdit",$article))
            $article["lastEdit"] = date("Y-m-d H:i:s");
        if(!array_key_exists("author",$article));
            $article["author"] = 1;
        if(!array_key_exists("viewed",$article));
            $article["viewed"] = 0;
        if(!array_key_exists("comments",$article));
            $article["comments"] = 0;
        if(!array_key_exists("likes",$article));
            $article["likes"] = 0;
        //$title = $article["title"];
        //组装sql语句
        $sql  = "INSERT INTO `article` (`title`, `cate`, `content`, `publishAt`, `lastEdit`, `author`, `viewed`, `comments`, `likes`, `cover`) VALUES (";
        $sql .= "'" . $article["title"] . "',";     //标题
        $sql .= "'" . $article["cate"] . "',";      //分类id
        $sql .= "'" . $article["content"] . "',";   //内容
        $sql .= "'" . $article["publishAt"] . "',"; //发布时间
        $sql .= "'" . $article["lastEdit"] . "',";  //上次编辑
        $sql .= "'" . $article["author"] . "',";    //作者id
        $sql .= "'" . $article["viewed"] . "',";    //浏览数
        $sql .= "'" . $article["comments"] . "',";  //评论数
        $sql .= "'" . $article["likes"] . "',";     //喜欢数
        $sql .= "'" . $article["cover"] . "'";      //封面地址
        $sql .= ")";
        $sql_res = $this->conn->query($sql);
        return $sql_res;
    }
    /*
     * 更新文章 参数：
     * 1.文章id
     * 2.文章数组
     * article数组内容必须包括：
     * 标题
     * 分类
     * 内容
     * 封面地址
     * 返回布尔 表示成功与否
     */
    public function updateArticle($id,$article){
        $this->init();
        $edittime = date("Y-m-d H:i:s");
        $sql  = "UPDATE `article` SET ";
        $sql .= "`title` = '" . $article["title"] . "',";
        $sql .= "`cate` = '" . $article["cate"] . "',";
        $sql .= "`content` = '" . $article["content"] . "',";
        $sql .= "`cover` = '" . $article["cover"] . "',";
        $sql .= "`lastEdit` = '" . $edittime . "'";
        $sql .= " WHERE `article`.`id` = " . $id;
        $sql_res = $this->conn->query($sql);
        var_dump($sql);
        var_dump($sql_res);
    }
    /*
     * 删除文章 参数
     * 1.id 文章id
     * 返回布尔值 表示成功与否
     */
    public function deleteArticle($id){
        $this->init();
        $sql = "DELETE FROM `article` WHERE `article`.`id` = $id";
        $sql_res = $this->conn->query($sql);
        return $sql_res;
    }
    /*
     * 文章喜欢数增加 参数
     * 1.id
     * 会给当前id的文章赞数+1
     * 返回布尔 表示成功与否
     */
    public function creaseArticleLike($id){
        $this->init();
        $sql = "UPDATE `article` SET `likes` = `likes`+'1' WHERE `article`.`id` = $id";
        $sql_res = $this->conn->query($sql);
        return $sql_res;
    }
    /*
     * 文章浏览数增加 参数
     * 1.id
     * 会给当前id的文章浏览数+1
     * 返回布尔 表示成功与否
     */
    public function creaseArticleViewed($id){
        $this->init();
        $sql = "UPDATE `article` SET `viewed` = `viewed`+'1' WHERE `article`.`id` = $id";
        $sql_res = $this->conn->query($sql);
        return $sql_res;
    }
    /*
     * 文章评论数增加 参数 !此接口只应该在发布评论时调用
     * 1.id
     * 会给当前id的文章评论数+1
     * 返回布尔 表示成功与否
     */
    public function creaseArticleComment($id){
        $this->init();
        $sql = "UPDATE `article` SET `comments` = `comments`+'1' WHERE `article`.`id` = $id";
        $sql_res = $this->conn->query($sql);
        return $sql_res;
    }
    /*
     * 添加评论用户 参数
     * 1.昵称
     * 2.邮箱
     * 3.个人站点
     * 返回布尔 表示成功与否
     */
    public function addCommentUser($name,$email,$site){
        $this->init();
        $sql = "INSERT INTO `comment_user` (`name`, `email`, `site`) VALUES ('$name', '$email', '$site')";
        $sql_res = $this->conn->query($sql);
        return $sql_res;
    }
    /*
     * 发布评论 参数
     * 1.articleid 评论的文章id
     * 2.uid -评论者信息
     * 3.content -评论内容
     * 返回布尔 表示成功与否
     */
    public function publishComment($articleid,$uid,$content){
        $this->init();
        //文章评论数+1
        $this->creaseArticleComment($articleid);

        $time = date("Y-m-d H:i:s");
        $sql = "INSERT INTO `comment` (`uid`, `likes`, `content`, `commenttime`, `articleid`) VALUES ('$uid', '0', '$content', '$time', '$articleid')";
        $sql_res = $this->conn->query($sql);
        return $sql_res;
    }
    /*
     * 删除评论 参数
     * 1.id 评论id
     * 返回布尔值 表示成功与否
     */
    public function deleteComment($id){
        $this->init();
        $sql = "DELETE FROM `comment` WHERE `comment`.`id` = $id";
        $sql_res = $this->conn->query($sql);
        return $sql_res;
    }
    /*
     * 评论赞+1  参数
     * 1.id  评论id
     * 返回布尔 表示成功与否
     */
    public function creaseCommentLike($id){
        $this->init();
        $sql = "UPDATE `comment` SET `likes` = `likes`+'1' WHERE `comment`.`id` = $id";
        $sql_res = $this->conn->query($sql);
        return $sql_res;
    }
    /*
     * 添加分类 参数
     * 1.分类名
     */
    public function addCate($name){
        $this->init();
        $sql = "INSERT INTO `cate` (`name`) VALUES ('$name')";
        $sql_res = $this->conn->query($sql);
        return $sql_res;
    }
}

?>
