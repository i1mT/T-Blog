<?php
/**
 * 分库分表的自定义数据库路由配置
 * 
 * @license     http://www.phalapi.net/license GPL 协议
 * @link        http://www.phalapi.net/
 * @author: dogstar <chanzonghuang@gmail.com> 2015-02-09
 */

$IS_TEST = false;
//测试环境下
$localhost  = "localhost";
$user       = "root";
$password   = "";

//非测试环境下
if(!$IS_TEST) {
    $localhost  = "***";
    $user       = "***";
    $password   = "***";
}

return array(
    /**
     * DB数据库服务器集群
     */
    'servers' => array(
        'db_master' => array(                       //服务器标记
            'type'      => 'mysql',                 //数据库类型，暂时只支持：mysql, sqlserver
            'host'      => $localhost,             //数据库域名
            'name'      => 't-blog',               //数据库名字
            'user'      => $user,                  //数据库用户名
            'password'  => $password,	                    //数据库密码
            'port'      => 3306,                    //数据库端口
            'charset'   => 'UTF8',                  //数据库字符集
        ),
    ),

    /**
     * 自定义路由表
     */
    'tables' => array(
        //通用路由
        '__default__' => array(
            'prefix' => '',
            'key' => 'id',
            'map' => array(
                array('db' => 'db_master'),
            ),
        ),
    ),
);
