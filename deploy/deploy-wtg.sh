#!/bin/bash

if [ -z "$1" ]; then
    echo usage: $0 branch
    exit
fi

SRC=https://github.com/landreg/knowman-alpha
DEST="/opt/deploy/landreg/releases"
BRANCH_NAME=$1
DESTPATH=$DEST/$(date +%Y%m%d%H%M%S)
VENDOR_PATH=$DEST/build/vendor
CONFIG_PATH=$DEST/build/config

set -x
git clone $SRC -b $BRANCH_NAME $DESTPATH
cd $DEST && ln -sfn $DESTPATH current
mkdir -p $VENDOR_PATH
mkdir -p $CONFIG_PATH
touch $CONFIG_PATH/parameters.yml
cd $DESTPATH/app/config && ln -s $CONFIG_PATH/parameters.yml parameters.yml
cd $DESTPATH && ln -s $VENDOR_PATH vendor && make install


#parameters.yml


#vendors folder

