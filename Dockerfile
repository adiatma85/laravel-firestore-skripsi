FROM php:8.1.11-fpm-alpine

# Enable zip
RUN apk add --no-cache zip libzip-dev libsodium-dev \
  && docker-php-ext-configure zip \
  && docker-php-ext-install zip

# Enable exif
RUN docker-php-ext-install exif

# Enable PDO and PDO MYSQL
RUN docker-php-ext-install pdo pdo_mysql

# Enable Sodium
RUN docker-php-ext-install sodium

# # #
# Install build dependencies
# # #
ENV build_deps \
    autoconf \
    zlib-dev

RUN apk upgrade --update-cache --available && apk update && \
    apk add --virtual .build-dependencies $build_deps &&  apk add --no-cache --repository=http://dl-cdn.alpinelinux.org/alpine/edge/testing

# # #
# Install persistent dependencies
# # #
ENV persistent_deps \
    g++ \
    gcc \
    linux-headers \
    make \
    zlib

# Enable GRPC
# RUN pecl install grpc
RUN docker-php-ext-install grpc

# # #
# remove build deps
# # #
RUN apk del -f .build-dependencies

RUN apk add --no-cache nginx wget

RUN mkdir -p /run/nginx

COPY docker/nginx.conf /etc/nginx/nginx.conf

RUN mkdir -p /app
COPY . /app
COPY ./src /app

RUN sh -c "wget http://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"
RUN cd /app && \
    /usr/local/bin/composer install --no-dev

RUN chown -R www-data: /app

CMD sh /app/docker/startup.sh