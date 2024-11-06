SHELL := /usr/bin/env bash
COMPOSER_HOME := $(HOME)/.config/composer
COMPOSER_CACHE_DIR := $(HOME)/.cache/composer

check_uid_set:
	if [ -z "$(UID)" ]; then echo "UID variable required, please run 'export UID' before running make task"; exit 1 ; fi

up: check_uid_set
	SERVER_NAME=localhost:80 HTTP_PORT=8080 TRUSTED_HOSTS=localhost docker compose up --wait

up_sync: check_uid_set
	SERVER_NAME=localhost:80 HTTP_PORT=8080 TRUSTED_HOSTS=localhost docker compose up

down:
	docker-compose down

logs_tail:
	if [ -z "$(UID)" ]; then echo "UID variable required, please run 'export UID' before running make task"; exit 1 ; fi
	export UID && docker-compose logs -f

bash:
	export UID && docker compose run --rm php bash
