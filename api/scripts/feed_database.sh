#!/bin/bash

docker-compose exec php php database/data_migrator.php
