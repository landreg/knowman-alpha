#!/bin/bash

. /etc/profile
if [ -z "$1" ]; then
    echo usage: $0 branch [apache user]
    exit
fi

# Specify
APACHE_GROUP=$2
if [ -z "$2" ]; then
    APACHE_GROUP=apache
fi

# Variable setup
SRC=https://github.com/landreg/knowman-alpha
DEST="/opt/deploy/landreg/releases"
CURRENT_SYM_PATH="/opt/deploy/landreg"
BRANCH_NAME=$1
DESTPATH=$DEST/$(date +%Y%m%d%H%M%S)
VENDOR_PATH=$DEST/build/vendor
CONFIG_PATH=$DEST/build/config

set -x
# Pull from source
git clone $SRC -b $BRANCH_NAME $DESTPATH

# Make sure the common vendor and config folders exist
mkdir -p $VENDOR_PATH
mkdir -p $CONFIG_PATH

# Create the base config file.
touch $CONFIG_PATH/parameters.yml
cd $DESTPATH/app/config && ln -s $CONFIG_PATH/parameters.yml parameters.yml

# Update permissions on all writable and exuctable files and directories
mkdir -p $DESTPATH/app/cache && chgrp $APACHE_GROUP $DESTPATH/app/cache && chmod g+s $DESTPATH/app/cache
mkdir -p $DESTPATH/app/logs && chgrp $APACHE_GROUP $DESTPATH/app/logs && chmod g+s $DESTPATH/app/logs
chmod +x $DESTPATH/app/console


# Set the vendor directory to be a symlink and run composer install
cd $DESTPATH && ln -s $VENDOR_PATH vendor && composer -vvv install

# Make sure the web server can write to it
chmod -R 775 $DESTPATH/app/cache
chmod -R 775 $DESTPATH/app/logs
chgrp -R $APACHE_GROUP $DESTPATH
chgrp -R $APACHE_GROUP $DEST/build

# Update symlink to new source
cd $CURRENT_SYM_PATH && ln -sfn $DESTPATH current
