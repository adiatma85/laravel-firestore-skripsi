FROM php:8.1.11-fpm-buster

RUN docker-php-source extract \
  && apt-get update \
  && apt-get install libldap2-dev libxml2-dev nano -y \
        libapache2-mod-security2 \
        libxslt-dev \
        libicu-dev \
        zip \ 
        unzip \
        git \
        # zlib-dev \
        # linux-headers \
        nginx \
        wget \
        libsodium \
        libpq-dev

# Install zip
RUN apt-get update && \
     apt-get install -y \
         libzip-dev \
         && docker-php-ext-install zip

# Enable exif
RUN docker-php-ext-install exif

# Enable PDO and PDO MYSQL
RUN docker-php-ext-install pdo pdo_mysql

# Enable Sodium
RUN docker-php-ext-install sodium

# Enable GRPC
# RUN apk --no-cache add $PHPIZE_DEPS zip unzip git zlib-dev linux-headers
RUN pecl install grpc
RUN docker-php-ext-enable grpc

# # # #
# # remove build deps
# # # #
# RUN apk del -f .build-dependencies

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