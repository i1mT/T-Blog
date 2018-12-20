<?php
$cmd = file_get_contents("/home/www/T-Blog/CI.sh");
system("cd /home/www/T-Blog/ && {$cmd}");

exit();


echo "Deploying ...\n";
// 与webhook配置相同，为了安全，请设置此参数
$secret = "iimT233";
// 项目路径
$shellPath = "/home/www/T-Blog/";
// 校验发送位置，正确的情况下自动拉取代码，实现自动部署
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];
if ($signature) {
  $hash = "sha1=".hash_hmac('sha1', file_get_contents("php://input"), $secret);
  if (strcmp($signature, $hash) == 0) {
    $command = "cd {$shellPath} && ./CI.sh";
    echo "exec CI!\n";
    $retval = shell_exec($command);
    // exec($command, $retval, $status);
    //system($command, $retval);
    if ($status == 0) {
        echo "Deploy Success!\n\n";
    } else {
        echo "Deploy Failed!\n";
    }
    echo shell_exec("Exec Info:\n\n\n");
    print_r($retval);
    echo "\n\nDeploy Done!";
    exit();
  }
}
// http_response_code(404);

?>
