<?php
header("Content-type: text/html; charset=utf-8");
include_once "function.php";

$mysql = new sql();
$t = new T_function();
$art = array();
$art["title"] = "文章标题";
$art["cate"] = 1;
$art["content"] = "#测试";
$art["cover"] = "http://www.iimt.me/usr/themes/iimT//img/avatar.jpg";
$mysql->publishArticle($art);


/*数据库操作类*/
class sql{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;
    private $t;

    /*-----------------------接口-----------------------*/
    /*
     * 初始化数据库
     */
    public function init(){
        $this->servername = "allsite.com";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "t-blog";
        $this->t =  new T_function();
        $this->conn = new mysqli($this->servername, $this->username, $this->password,$this->dbname);
        $this->conn->set_charset("utf8");
        if($this->conn->connect_error){
            $this->t->webLog("链接失败~");
            die("连接失败: " . $this->conn->connect_error);
        }else{
            $this->t->webLog("链接成功~");
        }
    }
    /*
     * 登录
     * 返回真假
     */
    public function login($user,$pwd){
        $this->init();
        $sql = "SELECT * FROM `admin` WHERE `username` = '" . $user . "' AND `pwd` = '" . $pwd . "'";
        $sql_res = $this->conn->query($sql);
        if($sql_res->num_rows > 0){
            $this->t->setLogStatus(true);
            return true;
        }
        else
            return false;
    }
    /*
     * 设置博客名
     * 返回真假-成功与否信息
     */
    public function editBlogName($name){
        $this->init();
        $this->t->webLog("设置name:".$name);
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
        $this->t->webLog("设置description:".$desc);
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
        $this->t->webLog("设置siteurl:".$url);
        $sql = "UPDATE `bloginfo` SET `siteurl` = '$url' WHERE `bloginfo`.`id` = 1";
        $sql_res = $this->conn->query($sql);
        return $sql_res;
    }
    /*
     * 发布文章  参数为一个包装好的文章信息数组
     * 必填四个属性
     * article["title"] 文章标题
     * article["cate"]  文章分类id
     * article["content"] 文章内容 MD格式
     * article["cover"] 文章封面图片地址
     */
    public function publishArticle($article){
        $this->init();
        //如果传过来的值已经存在就不需要重新赋值
        if(!array_key_exists("publishAt",$article))
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
        $sql .= "'" . $article["title"] . "',"; //标题
        $sql .= "'" . $article["cate"] . "',"; //分类id
        $sql .= "'" . $article["content"] . "',"; //内容
        $sql .= "'" . $article["publishAt"] . "',"; //发布时间
        $sql .= "'" . $article["lastEdit"] . "',"; //上次编辑
        $sql .= "'" . $article["author"] . "',"; //作者id
        $sql .= "'" . $article["viewed"] . "',"; //浏览数
        $sql .= "'" . $article["comments"] . "',"; //评论数
        $sql .= "'" . $article["likes"] . "',"; //喜欢数
        $sql .= "'" . $article["cover"] . "'"; //封面地址
        $sql .= ")";
        $sql_res = $this->conn->query($sql);
        return $sql_res;
    }
}

?>
