FROM php:8.4-fpm-alpine AS base

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions pdo_mysql opcache exif


FROM base AS vendor

WORKDIR /var/www/html

COPY composer.json composer.lock ./

RUN composer install \
   --no-interaction \
   --prefer-dist \
   --optimize-autoloader \
   --no-scripts


FROM node:22-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json ./
COPY resources ./resources
COPY public ./public
COPY vite.config.js ./
COPY --from=vendor /var/www/html/vendor ./vendor

RUN npm ci
RUN npm run build


FROM base

RUN { \
        echo '[global]'; \
        echo 'error_log = /proc/self/fd/2'; \
        echo '[www]'; \
        echo 'catch_workers_output = yes'; \
        echo 'decorate_workers_output = no'; \
    } > /usr/local/etc/php-fpm.d/docker-php-fpm-logging.conf

WORKDIR /var/www/html

COPY . .

COPY --from=vendor /var/www/html/vendor ./vendor
COPY --from=assets /app/public/build ./public/build

RUN composer dump-autoload --optimize

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

COPY docker/images/app/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 9000

ENTRYPOINT ["entrypoint.sh"]

CMD ["php-fpm"]
