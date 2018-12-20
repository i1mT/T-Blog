#!/bin/bash

datetime=$(date '+%Y-%m-%d %H:%M:%S')
FILE="/home/www/deploy_log/iimt.me/"$(date '+%Y-%m-%d')"_log.txt"
blogPath="/home/wwwroot/iimt_blog/domain/wwwiimt.me/web"

# 执行命令
execCmd () {
    name=$1
    cmd=$2
    echo "$name => $cmd"
    echo "---------  $name  ------------" >> $FILE
    # echo "$cmd" >> $FILE
    result=${cmd}
    echo "$result" >> $FILE
    echo "---------  $name END ------------" >> $FILE
}


echo "DEPLOY START" >> $FILE
echo $datetime >> $FILE

# 拉取代码
execCmd "PULL CODE" "git pull"

# 安装依赖
execCmd "INSTALL DEPENDICES" "cnpm i"

# 打包
execCmd "BUILD" "npm run build"

# 删除文件
execCmd "DELETE FILE" "rm -rf $blogPath/static"
execCmd "DELETE FILE" "rm -rf $blogPath/deploy"
execCmd "DELETE FILE" "rm -rf $blogPath/others"

# 移动文件
execCmd "DELETE FILE" "mv ./dist $blogPath/"
execCmd "DELETE FILE" "mv ./deploy $blogPath/"
execCmd "DELETE FILE" "mv ./others $blogPath/"

echo "DEPLOY DONE" >> $FILE

echo "-------------------------------------------------------------------------------------------" >> $FILE
