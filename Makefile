.PHONY: start shutdown restart reload phpcs

start:
	docker-compose up -d --build

shutdown:
	docker-compose down

restart: shutdown start

reload:
	docker exec nginx bash -c 'service nginx reload'

tools/php-cs-fixer/vendor/bin/php-cs-fixer:
	mkdir -p tools/php-cs-fixer
	composer require --dev --working-dir=tools/php-cs-fixer friendsofphp/php-cs-fixer

phpcs: tools/php-cs-fixer/vendor/bin/php-cs-fixer
	./tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src
