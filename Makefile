.DEFAULT_GOAL := check

check:
	./vendor/bin/phpstan analyse app
	./vendor/bin/pint --test

test:
	./vendor/bin/pest

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

clear_all: clear
	rm -f .idea/httpRequests/*
	rm -f storage/backup/*
	rm -f storage/app/livewire-tmp/*

clear:
	php artisan route:clear
	php artisan config:clear
	php artisan view:clear

update:
	@echo "Running php version:"
	@php --version
	@echo "Are you sure is it OK? [y/N] " && read ans && [ $${ans:-N} = y ]
	@echo "Current Laravel Version"
	php artisan --version
	@echo "\nUpdating..."
	composer update
	php artisan config:clear
	php artisan route:clear
	php artisan view:clear
	php artisan livewire:discover
	php artisan filament:upgrade
	@echo "UPDATED Laravel Version"
	php artisan --version

backup:
	php artisan backup:run

recreate: clear_all
	php artisan migrate:fresh --seed

format_code:
	./vendor/bin/pint
