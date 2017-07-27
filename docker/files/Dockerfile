FROM php:fpm-alpine

# install necessary software
RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
RUN apk add --no-cache git zlib-dev bash shadow > /dev/null

# install php extensions
# pdo - required by symfony
# zip - required by composer
RUN docker-php-ext-install pdo_mysql zip &> /dev/null

# set default workdir
WORKDIR /var/www/chloris

# prepend bins to PATH
ENV PATH="/var/www/chloris/bin:/var/www/chloris/vendor/bin:${PATH}"

# set www-data uid to 1000 (likely uid of host user) to avoid permission issues
RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data
RUN chown -R 1000:1000 /var/www

# serve
CMD ["php-fpm"]
