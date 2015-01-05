#!/bin/bash

if [ -z "$1" ]; then
    echo usage: $0 branch
    exit
fi

APACHE_GROUP=$2
if [ -z "$2" ]; then
    APACHE_GROUP=apache
fi

SRC=https://github.com/landreg/knowman-alpha
DEST="/opt/deploy/landreg/releases"
CURRENT_SYM_PATH="/opt/deploy/landreg"
BRANCH_NAME=$1
DESTPATH=$DEST/$(date +%Y%m%d%H%M%S)
VENDOR_PATH=$DEST/build/vendor
CONFIG_PATH=$DEST/build/config

set -x
git clone $SRC -b $BRANCH_NAME $DESTPATH
cd $CURRENT_SYM_PATH && ln -sfn $DESTPATH current
mkdir -p $VENDOR_PATH
mkdir -p $CONFIG_PATH
touch $CONFIG_PATH/parameters.yml
cd $DESTPATH/app/config && ln -s $CONFIG_PATH/parameters.yml parameters.yml
mkdir -p $DESTPATH/app/cache && chgrp $APACHE_GROUP $DESTPATH/app/cache && chmod g+s $DESTPATH/app/cache
mkdir -p $DESTPATH/app/logs && chgrp $APACHE_GROUP $DESTPATH/app/logs && chmod g+s $DESTPATH/app/logs
chmod +x $DESTPATH/app/console
cd $DESTPATH && ln -s $VENDOR_PATH vendor && composer install

chmod -R 775 $DESTPATH/app/cache
chmod -R 775 $DESTPATH/app/logs




#parameters.yml


#vendors folder

