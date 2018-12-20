#!/bin/bash

datetime=$(date '+%Y-%m-%d %H:%M:%S')
FILE="/home/www/deploy_log/iimt.me/"$(date '+%Y-%m-%d')"_log.txt"
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
    echo "mv ./dist/* ${deployPath}/" >> $FILE
    mv ./dist/* ${deployPath}/
    echo "mv ./deploy ${deployPath}/" >> $FILE
    mv ./deploy ${deployPath}/
    echo "mv ./others ${deployPath}/" >> $FILE
    mv ./others ${deployPath}/
}

echo "---------------    TIME: $datetime  -------------------------------------" >> $FILE
echo "---------------    DEPLOY START     --------------------------------------" >> $FILE

pull

install_dependices

build

delete_file

move_file

echo "---------------    DEPLOY DONE    ----------------------------------------" >> $FILE
