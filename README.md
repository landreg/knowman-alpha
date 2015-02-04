Knowlege Manager Alpha
======================

## Installation
### The server stack
You will need a linux based server with PHP, MySQL, Apache already installed.
The assumption for these instructions is that you will be using ubuntu. Using a different distro makes no difference but you may need find the appropriate installation commands for the distro of your choice.
MySQL can be replaced with another RDB without any issues. Though this has not been tested.

### Software requirements
#### Git
You can find [instructions for installing git here](https://help.ubuntu.com/lts/serverguide/git.html)
#### Composer
[Installing Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
#### Clone
Clone the repository into a folder.
```
$ git clone https://github.com/landreg/knowman-alpha.git
# cd into the source directory
$ cd knowman-alpha
# Run `make source` and follow the instructions that following of the installation
$ make source
```
If you need to stop the installation for any reason. You can running `make source` again and it should pick up where it left off.
After running `make source` you should see a prompt similar to below.
```
Creating the "app/config/parameters.yml" file
Some parameters are missing. Please provide them.
database_driver (pdo_sqlite):
```
See the Configuration section for an explaination.  

#### Configuration
This configures the symfony2 instance and writes it to the app/config/parameters.yml file. You can change these details later by editing that file.
You can change these values to your needs

If you wish to use a different RDB you would change the values below to suit your needs.

`database_driver (pdo_sqlite): pdo_mysql`

`database_host (null): localhost`

`database_port (null): 3306`

`database_name (null): knowman_alpha`

`database_user (null): username`

`database_password (null): password`

`database_path ('%kernel.root_dir%/app.sqlite'): null`

Use the default values for the options below. Just press enter.
```
phpcr_backend ({ type: doctrinedbal, connection: default, caches: { meta: doctrine_cache.providers.phpcr_meta, nodes: doctrine_cache.providers.phpcr_nodes } }):
phpcr_workspace (default):
phpcr_user (admin):
phpcr_password (admin):
mailer_transport (smtp):
mailer_host (127.0.0.1):
mailer_user (null):
mailer_password (null):
locale (en):
secret (ThisTokenIsNotSoSecretChangeIt):
debug_toolbar (true):
debug_redirects (false):
```

Use false on the last option for a faster experience

`use_assetic_controller (true): false`

#### Setting up the framework
Once you have the framework configured you are able to intialise the database
You can do this by running  `make init`

```
$ make init
```
See the make file for the commands that this runs.
This will set up the database and prepare the assets (html css and javascript).

#### Final steps

Point the server's web-root to the "web" directory in the code checked out.
Make sure the web server can write to the following directories

* app/cache
* app/logs

