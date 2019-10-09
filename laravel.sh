#!/usr/bin/env bash

# Create laravel app
# Composer does not allow creating inside existing directory
# So first laravel will be installed into laravel directory and then moved from
docker-compose exec php-cli composer create-project --prefer-dist laravel/laravel laravel
sudo chown ${USER}:${USER} laravel/ -R

# Remove default configuration files
sudo rm laravel/.gitignore
sudo rm laravel/.env.example
sudo rm laravel/.env

# Move app
sudo mv laravel/** .
# Move dot-starting files
sudo mv laravel/.??* .

# Remove installation directory
sudo rm -r laravel

# Setting up permissions
sudo chmod -R 777 bootstrap/cache
sudo chmod -R 777 storage

# Install predis package for using redis container with php
docker-compose exec php-cli composer require predis/predis

# Add docker configuration file
cp ./.env.example ./.env
docker-compose exec php-cli php artisan key:generate

# Install front-end assets
docker-compose exec node yarn install
