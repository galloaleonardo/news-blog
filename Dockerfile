FROM php:8.0.8-fpm-alpine

# Set env timezone
ARG TZ='America/Sao_Paulo'
ENV DEFAULT_TZ ${TZ}

# Install PHP Extensions
RUN set -euxo pipefail ;\
    apk add --no-cache --virtual build-dependencies \
    pcre-dev \
    ${PHPIZE_DEPS} ;\
    docker-php-ext-install \
    pdo \
    pdo_mysql \
    opcache ;\
    docker-php-ext-enable pdo_mysql ;\
    apk del build-dependencies

RUN set -euxo pipefail ;\
    apk add --no-cache freetype \
    libpng \
    libjpeg-turbo \
    freetype-dev \
    libpng-dev \
    libjpeg-turbo-dev && \
    docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) && \
    docker-php-ext-install -j$(nproc) gd && \
    apk del --no-cache freetype-dev libpng-dev libjpeg-turbo-dev

# Set timezone
RUN apk upgrade --update \
    && apk add -U tzdata \
    && cp /usr/share/zoneinfo/${DEFAULT_TZ} /etc/localtime \
    && apk del tzdata \
    && rm -rf \
    /var/cache/apk/*

# Create web user/group.
RUN addgroup -g 1000 web && adduser -G web -g web -s /bin/sh -D web

# Change path owner.
RUN chown -R web:web /var/www/html

# Copy php-fpm config.
ADD ./conf/fpm-www.conf /usr/local/etc/php-fpm.d/www.conf

# Copy OPCache changes.
ADD ./conf/opcache.ini /usr/local/etc/php/conf.d/opcache.ini