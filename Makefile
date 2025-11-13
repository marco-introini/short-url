.DEFAULT_GOAL := check

check:
	composer audit
	./vendor/bin/phpstan analyse
	vendor/bin/rector --dry-run
	./vendor/bin/pint --test
	./vendor/bin/pest

update: clear
	@echo "Current Laravel Version"
	php artisan --version
	@echo "\nUpdating..."
	composer update
	php artisan filament:upgrade
	@echo "UPDATED Laravel Version"
	php artisan --version
	php artisan boost:update
	npm update

clear_all: clear
	rm -f .idea/httpRequests/*
	rm -fr storage/app/backup/*

clear:
	@echo "Clearing..."
	php artisan config:clear
	php artisan route:clear
	php artisan view:clear
	php artisan filament:optimize-clear

production:
	composer install --prefer-dist --optimize-autoloader
	php artisan migrate
	npm install
	npm run build
	#uncomment if using queues
	#php artisan queue:restart

first_production: production
	php artisan storage:link
	chmod -R 777 storage bootstrap/cache


backup:
	php artisan backup:run

recreate: clear_all
	php artisan migrate:fresh --seed

format_code:
	./vendor/bin/pint
