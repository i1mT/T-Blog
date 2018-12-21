#!/bin/bash

datetime=$(date '+%Y-%m-%d %H:%M:%S')
FILE="./CI/log/"$(date '+%Y-%m-%d')"_log.txt"
PWD="/home/www/T-Blog"
deployPath="/home/wwwroot/iimt_blog/domain/wwwiimt.me/web"

# 拉取
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
    echo "cp -r ${PWD}/dist/* ${deployPath}/" >> $FILE
    cp -r ${PWD}/dist/* ${deployPath}/
}

# 更新API
update_API() {
    # 删除
    echo "rm -rf ${deployPath}/API" >> $FILE
    rm -rf ${deployPath}/API >> $FILE
    # 更新
    echo "cp -r ${PWD}/API ${deployPath}/" >> $FILE
    cp -r ${PWD}/API ${deployPath}/
}

# 更新其他页面文件
update_others () {
    # 删除
    echo "rm -rf ${deployPath}/others" >> $FILE
    rm -rf ${deployPath}/others >> $FILE
    # 更新
    echo "cp -r ${PWD}/others ${deployPath}/" >> $FILE
    cp -r ${PWD}/others ${deployPath}/
}

# 删除临时文件
delete_dist () {
    # 删除
    echo "rm -rf ${PWD}/dist" >> $FILE
    rm -rf ${PWD}/dist >> $FILE
}

echo "---------------    DEPLOY START @$datetime   --------------------------------------" >> $FILE

echo "Deploying..."

install_dependices

build

update_src

update_others

update_API

delete_dist

rm -rf ./a.log

echo "Deploy Done, everythings is OK!"
datetime=$(date '+%Y-%m-%d %H:%M:%S')
echo "---------------    DEPLOY DONE @${datetime}   ----------------------------------------" >> $FILE
