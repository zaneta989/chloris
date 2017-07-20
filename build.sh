#!/bin/bash

# download composer
curl https://getcomposer.org/composer.phar -o composer.phar

# composer install
php composer.phar install

# create database
php bin/console doctrine:database:create

# schema update
php bin/console doctrine:schema:update --force