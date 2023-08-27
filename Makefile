.PHONY: start shutdown locale restart reload phpcs phpstan

start:
	docker-compose up -d --build

shutdown:
	docker-compose down

restart: shutdown start

reload:
	docker exec nginx bash -c 'service nginx reload'

locale:
	docker exec -w /app php-fpm bash -c 'msgfmt locale/ja_JP/LC_MESSAGES/messages.po -o locale/ja_JP/LC_MESSAGES/messages.mo'
	docker compose restart php-fpm

tools/php-cs-fixer/vendor/bin/php-cs-fixer:
	mkdir -p tools/php-cs-fixer
	composer require --dev --working-dir=tools/php-cs-fixer friendsofphp/php-cs-fixer

phpcs: tools/php-cs-fixer/vendor/bin/php-cs-fixer
	./tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src

tools/phpstan/vendor/bin/phpstan:
	mkdir -p tools/phpstan
	composer require --dev --working-dir=tools/phpstan phpstan/phpstan

phpstan: tools/phpstan/vendor/bin/phpstan
	./tools/phpstan/vendor/bin/phpstan analyse src