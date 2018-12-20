<?php
// 与webhook配置相同，为了安全，请设置此参数
$secret = "iimT233";
// 项目路径
$shellPath = "/home/www/T-Blog/";
// 校验发送位置，正确的情况下自动拉取代码，实现自动部署
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];
if ($signature) {
  $hash = "sha1=".hash_hmac('sha1', file_get_contents("php://input"), $secret);
  if (strcmp($signature, $hash) == 0) {
    $cmd = "cd $shellPath && /bin/bash CI.sh";
    $result = shell_exec("sudo -u root -S $cmd < ~/.sudopass/sudopass.secret");
    print_r($result);
  }
}

?>
