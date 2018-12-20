#!/bin/bash

echo "Deploying..."

cmd=`git pull`

datetime=$(date '+%Y-%m-%d %H:%M:%S')

result=${cmd}

FILE="/home/www/deploy_log/iimt.me/"$(date '+%Y-%m-%d')"_log.txt"


echo $datetime >> $FILE
echo "$aaa" >> $FILE
echo "--------------------------------------------------------------------------------------------------------" >> $FILE
