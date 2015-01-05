install:
	composer install
	app/console doctrine:database:create
	app/console doctrine:phpcr:init:dbal
	app/console doctrine:phpcr:repository:init

reset:
	composer install
	app/console doctrine:database:drop --force
	app/console doctrine:database:create
	app/console doctrine:phpcr:init:dbal
	app/console doctrine:phpcr:repository:init

