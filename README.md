# Madam Version 2

## A. Prerequistes
If you run this application using docker container, it will run as `docker-compose` services. If run using web server such as `apache`, `nginx`, or application bundle such as `WAMPP` or `XAMPP` place this PHP application in the `Document Root`.

## B. Usage

1. Docker

Just run the `make run` command on your Linux terminal. If your operating system is Windows, I suggest to using Git Bash terminal or Windows Subsystem Linux. Access your application using Web Browser to `http://127.0.0.1:8080`

2. Web Server

* Place the application in the `Document Root` of web server (for example: `/var/www/html` or `htdocs` in Windows)
* Run PHP database migration:
```shell
php -q migration.php
```

# Contributor

Anggit M Ginanjar (anggit.ginanjar.dev@gmail.com)