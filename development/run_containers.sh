#!/bin/bash

SERVICES=(api client)
APPS_DIR=$(pwd)

for service in ${SERVICES[*]}
do
  DOCKER_COMPOSE_FILE=$APPS_DIR/$service/docker-compose.yml
  [ -f $DOCKER_COMPOSE_FILE ] && docker-compose -f $DOCKER_COMPOSE_FILE down
  [ -f $DOCKER_COMPOSE_FILE ] && docker-compose -f $DOCKER_COMPOSE_FILE up -d --build
done
