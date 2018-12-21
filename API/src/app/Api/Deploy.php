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
        $shellPath = "/home/www/T-Blog";
        $cmd = "cd $shellPath && sudo git pull && sudo /bin/bash CI.sh";
        passthru($cmd);
    }
}

// wonderful haha!