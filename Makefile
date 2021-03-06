.PHONY: start shutdown restart reload

start:
	docker-compose up -d

shutdown:
	docker-compose down

restart: shutdown start

reload:
	docker exec nginx bash -c 'service nginx reload'