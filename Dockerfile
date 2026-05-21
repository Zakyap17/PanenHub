FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    sqlite3 \
    libsqlite3-dev

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install

RUN touch database/database.sqlite

ENV APP_ENV=production
ENV APP_DEBUG=false
ENV DB_CONNECTION=sqlite

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000