#!/bin/bash

. /etc/profile
if [ -z "$1" ]; then
    echo usage: $0 command
    exit
fi

# Specify
APACHE_GROUP=$2
if [ -z "$2" ]; then
    APACHE_GROUP=apache
fi

# Variable setup
SRC=https://github.com/landreg/knowman-alpha
CURRENT_SYM_PATH="/opt/deploy/landreg/current"

set -x
cd $CURRENT_SYM_PATH && make $1

# Make sure the web server can write to the dirs it needs
chmod -R 775 ${CURRENT_SYM_PATH}/app/cache
chmod -R 775 ${CURRENT_SYM_PATH}/app/logs
chgrp -R ${APACHE_GROUP} ${CURRENT_SYM_PATH}

