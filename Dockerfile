FROM php:8.2.20-cli

RUN apt-get update \
    && apt-get install -y \
        libmagickwand-dev \
        tesseract-ocr \
        git \
        zip \
        unzip \
    && pecl install imagick \
    && docker-php-ext-enable imagick

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./ /usr/src/watermeter

WORKDIR /usr/src/watermeter

RUN composer install --no-dev --prefer-dist --no-progress --no-interaction

WORKDIR /usr/src/watermeter/public
EXPOSE 3456
CMD ["php", "-S", "0.0.0.0:3456"]
