FROM php:7.1-fpm-alpine

# install necessary software
RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
RUN apk add --no-cache git zlib-dev bash shadow > /dev/null

# set default workdir
WORKDIR /var/www/chloris

# install php extensions
# pdo - required by symfony
# zip - required by composer
# phing - build tool
RUN docker-php-ext-install pdo_mysql zip
RUN curl -L "http://www.phing.info/get/phing-2.16.0.phar" -o /usr/local/bin/phing
RUN chmod +x /usr/local/bin/phing

# prepend bins to PATH
ENV PATH="/var/www/chloris/bin:/var/www/chloris/vendor/bin:${PATH}"

# set www-data uid to 1001 (likely uid of host user) to avoid permission issues
RUN usermod -u 1001 www-data
RUN groupmod -g 1001 www-data
RUN chown -R 1001:1001 /var/www

# serve
CMD ["php-fpm"]
