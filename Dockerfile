# Stage 1: Composer dependencies
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction --no-scripts

# Stage 2: Frontend assets
FROM node:20-alpine AS frontend
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY . .
RUN npm run build

# Stage 3: Production runtime
FROM php:8.3-cli-alpine

# Install required system packages and PHP extensions
RUN apk add --no-cache \
    bash \
    curl \
    git \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    oniguruma-dev \
    icu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip mbstring bcmath gd intl

WORKDIR /app

# Copy application code
COPY . .
# Copy pre-installed vendor and built assets
COPY --from=vendor /app/vendor ./vendor
COPY --from=frontend /app/public/build ./public/build

# Setup storage and execution permissions
RUN chmod +x start.sh && \
    mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs public/ProfileImages public/Signatures && \
    chmod -R 777 storage bootstrap/cache public/ProfileImages public/Signatures

EXPOSE 8080

CMD ["bash", "start.sh"]
