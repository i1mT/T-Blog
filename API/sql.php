<?php
header("Content-type: text/html; charset=utf-8");
include "function.php";

$mysql = new sql();
$t = new T_function();
$mysql->editBlogSiteurl("地址");

/*数据库操作类*/
class sql{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;
    private $t;

    //接口
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
        return $this->conn;
    }
    /*
     * 判断是否能够登录
     * 返回真假
     */
    public function canLogin($user,$pwd){
        $conn = $this->init();
        $sql = "SELECT * FROM `admin` WHERE `username` = '" . $user . "' AND `pwd` = '" . $pwd . "'";
        $sql_res = $conn->query($sql);
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
        $this->t->webLog("设置name:".$name);
        $conn = $this->init();
        $sql = "UPDATE `bloginfo` SET `name` = '$name' WHERE `bloginfo`.`id` = 1";
        $sql_res = $conn->query($sql);
        return $sql_res;
    }
    /*
     * 设置博客介绍
     * 返回真假-成功与否信息
     */
    public function editBlogDesc($desc){
        $this->t->webLog("设置description:".$desc);
        $conn = $this->init();
        $sql = "UPDATE `bloginfo` SET `description` = '$desc' WHERE `bloginfo`.`id` = 1";
        $sql_res = $conn->query($sql);
        return $sql_res;
    }
    /*
     * 设置博客地址
     * 返回真假-成功与否
     */
    public function editBlogSiteurl($url){
        $this->t->webLog("设置siteurl:".$url);
        $conn = $this->init();
        $sql = "UPDATE `bloginfo` SET `siteurl` = '$url' WHERE `bloginfo`.`id` = 1";
        $sql_res = $conn->query($sql);
        return $sql_res;
    }
}

?>