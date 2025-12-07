FROM composer:latest AS vendor
WORKDIR /app
COPY composer.json composer.lock /app/
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

FROM tomsik68/xampp:latest

# Place the app directly into XAMPP's document root
WORKDIR /opt/lampp/htdocs
COPY . /opt/lampp/htdocs
COPY --from=vendor /app/vendor /opt/lampp/htdocs/vendor

# Expose HTTP/HTTPS used by XAMPP
EXPOSE 80 443
