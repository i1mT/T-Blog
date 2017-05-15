<?php
include_once "sql.php";
session_start();


class T_function{
    /*
     * 输出前端日志  相当于js中的console.log()
     * 参数
     * 1.msg   string
     */
    public function webLog($msg){
        $msg = (string)$msg;
        $str = "<script>";
        $str .= "console.log('" . $msg . "');";
        $str .= "</script>";
        echo $str;
    }
    /*
     *登录  参数
     * 1.用户名  string
     * 2.密码    string
     */
    public function login($username,$password){
        $sql = new sql();
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
}
?>