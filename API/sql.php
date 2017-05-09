<?php

include "function.php";

$mysql = new sql();
$t = new T_function();
$log_res = $mysql->canLogin("iimT","ATyangguang");
$t->webLog($log_res);

/*数据库查询类*/
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
}

?>