#!/bin/bash

datetime=$(date '+%Y-%m-%d %H:%M:%S')
FILE="./CI/log/"$(date '+%Y-%m-%d')"_log.txt"
PWD="/home/www/T-Blog"
deployPath="/home/wwwroot/iimt_blog/domain/wwwiimt.me/web"

# 拉取
pull () {
    echo "git reset --hard HEAD" # >> $FILE
    output=`git reset --hard HEAD`
    echo "${output}" # >> $FILE

    echo "git clean -f -d" # >> $FILE
    output=`git clean -f -d`
    echo "${output}" # >> $FILE
    
    echo "git pull" # >> $FILE
    output=`git pull`
    echo "${output}" # >> $FILE
}

# 安装依赖
install_dependices () {
    echo "cnpm i" # >> $FILE
    output=`cnpm i`
    echo "${output}" # >> $FILE
}

# 打包
build () {
    echo "cnpm run build" # >> $FILE
    output=`cnpm run build`
    echo "${output}" # >> $FILE
}

# 更新博客程序
update_src () {
    # 删除
    echo "rm -rf ${deployPath}/index.html" # >> $FILE
    output=`rm -rf ${deployPath}/index.html`
    echo "${output}" # >> $FILE

    # 删除
    echo "rm -rf ${deployPath}/static" # >> $FILE
    output=`rm -rf ${deployPath}/static`
    echo "${output}" # >> $FILE

    # 更新
    echo "cp -r ./dist/* ${deployPath}/" # >> $FILE
    output=`cp -r ./dist/* ${deployPath}/`
    echo "${output}" # >> $FILE
}

# 更新API
update_API() {
    # 删除
    echo "rm -rf ${deployPath}/API" # >> $FILE
    output=`rm -rf ${deployPath}/API`
    echo "${output}" # >> $FILE
    # 更新
    echo "cp -r ./API ${deployPath}/" # >> $FILE
    output=`cp -r ./API ${deployPath}/`
    echo "${output}" # >> $FILE
}

# 更新其他页面文件
update_others () {
    # 删除
    echo "rm -rf ${deployPath}/others" # >> $FILE
    output=`rm -rf ${deployPath}/others`
    echo "${output}" # >> $FILE
    # 更新
    echo "cp -r ./others ${deployPath}/" # >> $FILE
    output=`cp -r ./others ${deployPath}/`
    echo "${output}" # >> $FILE
}

# 删除临时文件
delete_dist () {
    # 删除
    echo "rm -rf ./dist/*" # >> $FILE
    output=`rm -rf ./dist/*`
    echo "${output}" # >> $FILE
}

# 提升权限
update_authorization () {
    echo "chown -R www:www ./ && chmod -R 777 ./" # >> $FILE
    chown -R www:www ./ && chmod -R 777 ./
}

echo_start () {
    echo "---------------    DEPLOY START @$datetime   --------------------------------------" # >> $FILE
    export PATH=$PATH:/opt/nodejs/bin/
    echo $PATH
    echo "Deploying..."
}

echo_end () {
    echo "Deploy Done, everythings is OK!"
    datetime=$(date '+%Y-%m-%d %H:%M:%S')
    echo "---------------    DEPLOY DONE @${datetime}   ----------------------------------------" # >> $FILE
}

update_admin_src () {
    # 删除
    echo "rm -rf ${deployPath}/admin/*" # >> $FILE
    output=`rm -rf ${deployPath}/admin/*`
    echo "${output}" # >> $FILE
    # 更新
    echo "cp -r ./dist/* ${deployPath}/admin/" # >> $FILE
    output=`cp -r ./dist/* ${deployPath}/admin/`
    echo "${output}" # >> $FILE
}

deploy_admin () {
    echo "cd ./admin && cnpm i && npm run build && update_admin_src"
    cd ./admin && cnpm i && npm run build && update_admin_src
}

echo_start && pull && update_authorization && install_dependices && build && update_API && update_others && update_src

deploy_admin
