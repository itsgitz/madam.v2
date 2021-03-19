install:
	mkdir -p docker
	docker-compose -p madam up --build --force-recreate -d
	chmod 777 -R docker
	docker-compose -p madam logs -f
uninstall:
	docker-compose -p madam down -v
	docker system prune -f
	rm -Rfv docker
	rm -Rfv cache
start:
	docker-compose -p madam start
stop:
	docker-compose -p madam stop
