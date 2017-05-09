<?php
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

}
?>