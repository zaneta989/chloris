#!/bin/bash

# download composer
echo "download composer"
curl https://getcomposer.org/composer.phar -o composer.phar &> /dev/null

# composer install
echo "composer install"
php composer.phar install &> /dev/null

# create database
echo "create database"
php bin/console doctrine:database:create > /dev/null

# schema update
echo "schema update"
php bin/console doctrine:schema:update --force > /dev/null