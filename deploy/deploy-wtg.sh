#!/bin/bash

if [ -z "$1" ]; then
    echo usage: $0 branch
    exit
fi

SRC=https://github.com/landreg/knowman-alpha
DEST="/opt/deploy/landreg/releases"
BRANCH_NAME=$1
DESTPATH=$DEST/$(date +%Y%m%d%H%M%S)

set -x
git clone $SRC -b $BRANCH_NAME $DESTPATH
cd $DEST && ln -sfn $DESTPATH current
cd $DESTPATH && make install

#parameters.yml

#vendors folder