<?php
namespace App\Api;

use PhalApi\Api;

/**
 * 自动部署类
 *
 * @author: iimT tfhhh@qq.com 2018.12.21
 */
class Deploy extends Api {
    public function getRules() {
        return array(
            'a' => array(
                'id' => array('name' => 'id'),
            ),
        );
    }

    public function go () {
      $shellPath = "/home/www/T-blog";
      print_r("Deploying...\n");
      $cmd = "cd $shellPath && /bin/bash CI.sh";
      shell_exec($cmd);
      print_r("Deployed, everything is OK!\n");
    }

}