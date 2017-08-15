list:
	@echo "usage: make depoly"
init:
	@git clone ***.git
	@composer install --optimize-autoloader --no-dev

pull:
	@echo "pull..."
	@git pull

push:
	@echo "push..."
	git push -u

test:
	phpunit ./tests

# ./vendor/bin/phpcs -h 查看帮助
# ./vendor/bin/phpcs -p --standard=PSR2 --ignore=vendor 目录或文件名
# wiki: https://github.com/squizlabs/PHP_CodeSniffer/wiki
phpcs:
	./vendor/bin/phpcs -p --standard=PSR2 --ignore=vendor .


rollback:
	@echo "rollback"
	git reset --hard HEAD~1

up:
	@echo "php artisan up..."
	php artisan up

down:
	@echo "php artisan down"
	php artisan down

ch:
	@echo "set chown & chomd..."
	chown -R www:www *
	chmod -R 755 *
	chmod -R 777 storage

gulp:
	@echo "gulp..."
	gulp --production

clean:
	@echo "clear cache..."
	php artisan clear-compiled
	php artisan cache:clear
	php artisan config:clear
	php artisan route:clear
	php artisan view:clear

deploy: down  clean  pull  up