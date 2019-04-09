FROM php:7.1-fpm-alpine

ARG DOCKER_UID

# set default workdir
WORKDIR /var/www/chloris

# install necessary software and php extensions
# pdo - required by symfony
# zip - required by composer
# phing - build tool
RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories && \
    apk add --no-cache git zlib-dev bash shadow > /dev/null && \
    docker-php-ext-install pdo_mysql zip && \
    curl -L "http://www.phing.info/get/phing-2.16.0.phar" -o /usr/local/bin/phing && \
    chmod +x /usr/local/bin/phing

# prepend bins to PATH
ENV PATH="/var/www/chloris/bin:/var/www/chloris/vendor/bin:${PATH}"

# set www-data uid to DOCKER_UID
RUN usermod -u $DOCKER_UID www-data && \
    groupmod -g $DOCKER_UID www-data && \
    chown -R $DOCKER_UID:$DOCKER_UID /var/www

# serve
CMD ["php-fpm"]
