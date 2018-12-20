#!/bin/bash

datetime=$(date '+%Y-%m-%d %H:%M:%S')
FILE="/home/www/deploy_log/iimt.me/"$(date '+%Y-%m-%d')"_log.txt"
PWD="/home/www/T-Blog"
deployPath="/home/wwwroot/iimt_blog/domain/wwwiimt.me/web"

# 拉取代码
pull () {
    echo "git pull" >> $FILE
    git pull >> $FILE
}

# 安装依赖
install_dependices () {
    echo "cnpm i" >> $FILE
    cnpm i >> $FILE
}

# 打包
build () {
    echo "npm run build" >> $FILE
    npm run build >> $FILE
}

# 删除文件
delete_file () {
    echo "rm -rf ${deployPath}/static" >> $FILE
    rm -rf ${deployPath}/static >> $FILE
    echo "rm -rf ${deployPath}/deploy" >> $FILE
    rm -rf ${deployPath}/deploy >> $FILE
    echo "rm -rf ${deployPath}/others" >> $FILE
    rm -rf ${deployPath}/others >> $FILE
}

# 移动文件
move_file () {
    echo "mv ${PWD}/dist/* ${deployPath}/" >> $FILE
    mv ${PWD}/dist/* ${deployPath}/
    echo "mv ${PWD}/deploy ${deployPath}/" >> $FILE
    mv ${PWD}/deploy ${deployPath}/
    echo "mv ${PWD}/others ${deployPath}/" >> $FILE
    mv ${PWD}/others ${deployPath}/
}

echo "---------------    TIME: $datetime  -------------------------------------" >> $FILE
echo "---------------    DEPLOY START     --------------------------------------" >> $FILE

pull

install_dependices

build

delete_file

move_file

echo "---------------    DEPLOY DONE    ----------------------------------------" >> $FILE
