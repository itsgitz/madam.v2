install:
	mkdir -p docker
	docker-compose up --build --force-recreate -d
	chmod 777 -R docker
	docker-compose logs -f
uninstall:
	docker-compose down -v
	docker system prune -f
	rm -Rfv docker
	rm -Rfv cache
start:
	docker-compose start
stop:
	docker-compose stop