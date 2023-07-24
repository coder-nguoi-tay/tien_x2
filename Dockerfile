FROM composer:latest as vendor
COPY database/ database/
COPY composer.json composer.json
COPY composer.lock composer.lock
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader\
    --no-dev

FROM node:18 as ui
RUN mkdir -p /app/public
COPY package*.json /app/
COPY *.js /app/
COPY resources/ /app/resources/
COPY --from=vendor /app/vendor/ /app/vendor/
WORKDIR /app
RUN npm install && npm run build

FROM kingdarkness/lumen-php:8.1-apache-socket-opcache
COPY . /var/www/html
RUN chown -R www-data:www-data storage
COPY --from=vendor /app/vendor/ /var/www/html/vendor/
COPY --from=ui /app/public/build/ /var/www/html/public/build/


