source:
	composer -vvv install

init:
	php app/console doctrine:database:create
	php app/console doctrine:phpcr:init:dbal
	make fixtures
	make assets

update-db:
	php app/console doctrine:phpcr:repository:init

fixtures:
	php app/console doctrine:database:drop --force
	php app/console doctrine:database:create
	php app/console doctrine:phpcr:init:dbal
	rm -rf app/cache
	php app/console doctrine:phpcr:repository:init
	php app/console doctrine:phpcr:fixtures:load

assets:
	php app/console assets:install --symlink
	php app/console assetic:dump --env=dev
	php app/console assetic:dump --env=prod
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
	php app/console doctrine:database:drop --force
	make init

build:
	make source
	make assets
	make update-db