FROM webdevops/php-nginx:8.0-alpine

RUN docker-php-ext-install pdo_mysql

# Copy Composer binary from the Composer official Docker image
COPY --from=composer:2.1 /usr/bin/composer /usr/bin/composer

ENV WEB_DOCUMENT_ROOT /app/public

WORKDIR /app
COPY . .

RUN composer install --no-interaction --optimize-autoloader --ignore-platform-reqs


# Coping .env file
RUN cp .env.example .env

# Generating laravel secret key
RUN php artisan key:generate

RUN php artisan storage:link

RUN mkdir storage/images

RUN chmod 777 -R storage

RUN chown -R application:application .
