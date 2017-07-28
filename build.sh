#!/bin/bash

# download composer
echo "download composer"
if [ -e ./composer.phar ]
then
    echo "composer already exist. skipping"
else
    echo "downloading composer"
    curl https://getcomposer.org/composer.phar -o composer.phar &> /dev/null
fi

# composer install
echo "composer install"
php composer.phar install &> /dev/null

# drop database
echo "drop database"
php bin/console doctrine:database:drop --if-exists --force > /dev/null

# create database
echo "create database"
php bin/console doctrine:database:create > /dev/null

# schema update
echo "schema update"
php bin/console doctrine:schema:update --force > /dev/null

# doctrine fixtures load
echo "doctrine fixtures load"
yes | php bin/console doctrine:fixtures:load > /dev/null