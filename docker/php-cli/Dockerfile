FROM php:7-cli

RUN apt-get update && apt-get -y install \
    curl \
    zip \
    unzip \
    vim
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

WORKDIR /code
