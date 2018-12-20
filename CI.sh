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

# 更新博客程序
update_src () {
    # 删除
    echo "rm -rf ${deployPath}/static" >> $FILE
    rm -rf ${deployPath}/static >> $FILE
    # 更新
    echo "mv ${PWD}/dist/* ${deployPath}/" >> $FILE
    mv ${PWD}/dist/* ${deployPath}/
    
}

# 更新部署文件
update_deploy() {
    # 删除
    echo "rm -rf ${deployPath}/deploy" >> $FILE
    rm -rf ${deployPath}/deploy >> $FILE
    # 更新
    echo "mv ${PWD}/deploy ${deployPath}/" >> $FILE
    mv ${PWD}/deploy ${deployPath}/
}

# 更新其他页面文件
update_others () {
    # 删除
    echo "rm -rf ${deployPath}/others" >> $FILE
    rm -rf ${deployPath}/others >> $FILE
    # 更新
    echo "mv ${PWD}/others ${deployPath}/" >> $FILE
    mv ${PWD}/others ${deployPath}/
}

echo "---------------    TIME: $datetime  -------------------------------------" >> $FILE
echo "---------------    DEPLOY START     --------------------------------------" >> $FILE

pull

install_dependices

build

update_src

update_others

update_deploy

echo "---------------    DEPLOY DONE    ----------------------------------------" >> $FILE
