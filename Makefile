source:
	composer install

init:
	app/console doctrine:database:create
	app/console doctrine:phpcr:init:dbal
	app/console doctrine:phpcr:repository:init
	app/console assets:install
	app/console assetic:dump --env=dev
	app/console assetic:dump --env=prod

install:
	make source
	make init


reset:
	make source
	app/console doctrine:database:drop --force
	make init

