<?php
include_once "sql.php";
session_start();

class T_function{
    /*
     * 输出前端日志  相当于js中的console.log()
     */
    public function webLog($msg){
        $msg = (string)$msg;
        $str = "<script>";
        $str .= "console.log('" . $msg . "');";
        $str .= "</script>";
        echo $str;
    }
    /*
     *登录
     */
    public function login($username,$password){
        $sql = new sql();
        $sql->init();
        $login_res = $sql->login($username,$password);
        if(!$login_res){
            //$this->webLog("登录失败。");
        }else{
            //$this-webLog("登录成功。");
            $this->setLogStatus(true);
        }
        return $login_res;
    }
    /*
     * 设置登录状态
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
}
?>