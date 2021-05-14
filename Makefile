up: docker-up
init: docker-down-clear docker-build docker-up manager-init manager-seed

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-build:
	docker-compose up --build -d

manager-init: manager-copy-env manager-composer-install assets-install assets-dev

manager-copy-env:
	cp .env.example .env

manager-composer-install:
	docker-compose run --rm app composer install

manager-seed:
	docker-compose exec app php artisan migrate:fresh --seed

test:
	docker-compose exec app vendor/bin/phpunit

assets-install:
	docker-compose exec frontend yarn install

assets-rebuild:
	docker-compose exec frontend npm rebuild frontend-sass --force

assets-dev:
	docker-compose exec frontend yarn run dev

assets-watch:
	docker-compose exec frontend yarn run watch

memory:
	sudo sysctl -w vm.max_map_count=262144

perm:
	sudo chgrp -R www-data storage bootstrap/cache
	sudo chmod -R ug+rwx storage bootstrap/cache
