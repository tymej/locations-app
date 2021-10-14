#!/bin/bash

docker-compose exec php composer install
docker-compose exec php composer dump-autoload
