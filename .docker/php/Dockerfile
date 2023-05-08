FROM php:8.0-fpm as base

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/


# Install dependencies
RUN apt-get update \
    && apt-get install -y zlib1g-dev libzip-dev libpng-dev mariadb-client git \
    && docker-php-ext-install pcntl zip pdo_mysql gd

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www

# Add user for laravel application
# RUN groupadd -g 1000 www
# RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory permissions
# COPY --chown=www:www . /var/www

# Change current user to www
# USER www

FROM base as development
COPY . /var/www

FROM base as production
COPY . /var/www
RUN composer install \
    && chmod -R 777 storage

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]