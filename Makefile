up:
	docker compose up -d --build

down:
	docker compose down

restart:
	docker compose down && docker compose up -d --build

bash:
	docker compose exec php bash

composer:
	docker compose exec php composer install

migrate:
	docker compose exec php php artisan migrate

fresh:
	docker compose exec php php artisan migrate:fresh

key:
	docker compose exec php php artisan key:generate

logs:
	docker compose logs -f