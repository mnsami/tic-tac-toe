FROM php:7.4-cli-alpine

RUN apk update \
    && apk add git \
        curl \
        zip \
        unzip \
        vim

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install -f xdebug \
    && docker-php-ext-enable xdebug \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

# Set timezone
ENV TIMEZONE=Etc/UCT
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
    && printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
    && "date"

WORKDIR /code