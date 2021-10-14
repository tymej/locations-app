#!/bin/bash

docker-compose exec php php database/schema_migrator.php
