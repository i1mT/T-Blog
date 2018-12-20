#!/bin/bash

datetime=$(date '+%Y-%m-%d %H:%M:%S')
FILE="/home/www/deploy_log/iimt.me/"$(date '+%Y-%m-%d')"_log.txt"
echo "DEPLOY START" >> $FILE
echo $datetime >> $FILE

# 拉取代码
echo "---------  GIT PULL  ------------" >> $FILE
echo "git pull" >> $FILE
cmd=`git pull`
result=${cmd}
echo "$result" >> $FILE
echo "---------  GIT PULL END ------------" >> $FILE

# 安装依赖
echo "---------  NPM I  ------------" >> $FILE
echo "cnpm i" >> $FILE
cmd=`cnpm i`
result=${cmd}
echo "$result" >> $FILE
echo "---------  NPM I END  ------------" >> $FILE

# 打包
echo "---------  NPM RUN BUILD  ------------" >> $FILE
echo "cnpm run build" >> $FILE
cmd=`cnpm run build`
result=${cmd}
echo "$result" >> $FILE
echo "---------  NPM RUN BUILD END  ------------" >> $FILE


# 移动文件
echo "---------  MOVE FILE  ------------" >> $FILE
echo "rm -rf /home/wwwroot/iimt_blog/domain/wwwiimt.me/web/static/* &&  mv ./dist/* /home/wwwroot/iimt_blog/domain/wwwiimt.me/web/" >> $FILE
cmd=`rm -rf /home/wwwroot/iimt_blog/domain/wwwiimt.me/web/static/* &&  mv ./dist/* /home/wwwroot/iimt_blog/domain/wwwiimt.me/web/`
result=${cmd}
echo "$result" >> $FILE
echo "---------  MOVE FILE END  ------------" >> $FILE

echo "DEPLOY DONE" >> $FILE

echo "--------------------------------------------------------------------------------------------------------" >> $FILE
