run:
	mkdir -p docker
	docker-compose up --build --force-recreate -d
	chmod 777 -R docker
down:
	docker-compose down -v
	docker system prune -f