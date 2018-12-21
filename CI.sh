#!/bin/bash

datetime=$(date '+%Y-%m-%d %H:%M:%S')
FILE="./CI/log/"$(date '+%Y-%m-%d')"_log.txt"
PWD="/home/www/T-Blog"
deployPath="/home/wwwroot/iimt_blog/domain/wwwiimt.me/web"

# 拉取
pull () {
    echo "git pull" >> $FILE
    output=`git pull`
    echo "${output}" >> $FILE
}

# 安装依赖
install_dependices () {
    echo "cnpm i" >> $FILE
    output=`cnpm i`
    echo "${output}" >> $FILE
}

# 打包
build () {
    echo "npm run build" >> $FILE
    output=`npm run build`
    echo "${output}" >> $FILE
}

# 更新博客程序
update_src () {
    # 删除
    echo "rm -rf ${deployPath}/static" >> $FILE
    output=`rm -rf ${deployPath}/static`
    echo "${output}" >> $FILE
    # 更新
    echo "cp -r ${PWD}/dist/* ${deployPath}/" >> $FILE
    output=`cp -r ${PWD}/dist/* ${deployPath}/`
    echo "${output}" >> $FILE
}

# 更新API
update_API() {
    # 删除
    echo "rm -rf ${deployPath}/API" >> $FILE
    output=`rm -rf ${deployPath}/API`
    echo "${output}" >> $FILE
    # 更新
    echo "cp -r ${PWD}/API ${deployPath}/" >> $FILE
    output=`cp -r ${PWD}/API ${deployPath}/`
    echo "${output}" >> $FILE
}

# 更新其他页面文件
update_others () {
    # 删除
    echo "rm -rf ${deployPath}/others" >> $FILE
    output=`rm -rf ${deployPath}/others`
    echo "${output}" >> $FILE
    # 更新
    echo "cp -r ${PWD}/others ${deployPath}/" >> $FILE
    output=`cp -r ${PWD}/others ${deployPath}/`
    echo "${output}" >> $FILE
}

# 删除临时文件
delete_dist () {
    # 删除
    echo "rm -rf ${PWD}/dist" >> $FILE
    output=`rm -rf ${PWD}/dist`
    echo "${output}" >> $FILE
}

echo "---------------    DEPLOY START @$datetime   --------------------------------------" >> $FILE

echo "Deploying..."

# pull

output=`install_dependices`

build

update_src

update_others

update_API

delete_dist

echo "Deploy Done, everythings is OK!"
datetime=$(date '+%Y-%m-%d %H:%M:%S')
echo "---------------    DEPLOY DONE @${datetime}   ----------------------------------------" >> $FILE
