source:
	composer -vvv install

init:
	app/console doctrine:database:create
	app/console doctrine:phpcr:init:dbal
	make fixtures
	make assets

fixtures:
	rm -rf app/cache
	app/console doctrine:phpcr:repository:init

assets:
	app/console assets:install --symlink
	app/console assetic:dump --env=dev
	app/console assetic:dump --env=prod
	make fix-permissions

fix-permissions:
	chmod -R 775 app/cache
	chmod -R 775 app/logs
	chmod -R 775 web

install:
	make source
	make init

reset:
	make source
	app/console doctrine:database:drop --force
	make init
