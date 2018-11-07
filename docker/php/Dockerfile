FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
        libssl-dev \
        libcurl4-openssl-dev \
        vim \
        nano \
        wget \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libicu-dev \
        libreadline-dev \
        libxslt1-dev \
        libpcre3-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install opcache curl gd ftp pdo_mysql iconv xsl zip calendar mysqli

RUN pecl install xdebug-2.6.0 \
    && docker-php-ext-enable xdebug

COPY config/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/
COPY config/www.conf /usr/local/etc/php-fpm.d/