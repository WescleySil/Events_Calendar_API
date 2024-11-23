FROM php:8.3-fpm

ARG user=vacationApp
ARG uid=1000

RUN apt-get update && apt-get install -y \
   git  \
   curl \
   zip \
   libpng-dev \
   libonig-dev \
   libpq-dev \ 
   libxml2-dev \
   unzip 

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql

RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd sockets

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

WORKDIR /var/www

COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini

USER $user