run:
	mkdir -p docker
	docker-compose up --build --force-recreate -d
down:
	docker-compose down -v
	docker system prune -f