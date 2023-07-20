########################
####    PHP BUILD    ###
########################

FROM php:8.2.8-fpm-alpine AS php-dockerlastic-build

# icu full && timezone
RUN apk add icu-data-full \
    && apk add tzdata  \
    && cp /usr/share/zoneinfo/Europe/Berlin /etc/localtime  \
    && echo "Europe/Berlin" > /etc/timezone  \
    && apk del tzdata

RUN mv /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
COPY ./docker/dockerlastic/php/php-ini-overrides.ini /usr/local/etc/php/conf.d/

# install php extensions and use an external script for that.
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions  \
    && sync  \
    && install-php-extensions \
    gd \
    intl \
    redis \
    pdo_mysql \
    opcache \
    pcntl \
    bz2 \
    bcmath \
    zip \
    yaml

WORKDIR /app/dockerlastic

# install software for build process
RUN apk --no-cache update \
    && apk --no-cache upgrade \
    && apk add --no-cache \
        wget \
        curl

# Copy Composer
COPY ./bin/composer.phar /app/dockerlastic/bin/
COPY ./composer.json /app/dockerlastic/
COPY ./composer.lock /app/dockerlastic/

# Copy Project
COPY ./src /app/dockerlastic/src

# Copy Others
COPY ./public/index.php /app/dockerlastic/public/
COPY ./console /app/dockerlastic/

# install project dependencies
RUN cd /app/dockerlastic  \
    && php bin/composer.phar install --no-dev --optimize-autoloader

###########################
####    PHP PROD    ###
###########################

FROM php-dockerlastic-build AS php-dockerlastic-prod

# Copy folders
COPY --from=php-dockerlastic-build --chown=www-data:www-data /app/dockerlastic/src /app/dockerlastic/src
COPY --from=php-dockerlastic-build --chown=www-data:www-data /app/dockerlastic/vendor /app/dockerlastic/vendor

# Copy files
COPY --from=php-dockerlastic-build --chown=www-data:www-data /app/dockerlastic/public/index.php /app/dockerlastic/public/
COPY --from=php-dockerlastic-build --chown=www-data:www-data /app/dockerlastic/console /app/dockerlastic/console

# entrypoint
COPY ./docker/dockerlastic/php/php-container-entrypoint.sh /app/dockerlastic/php-container-entrypoint.sh

RUN chmod +x /app/dockerlastic/php-container-entrypoint.sh  \
    && chown www-data:www-data /app/dockerlastic

USER www-data

ENTRYPOINT ["/app/dockerlastic/php-container-entrypoint.sh"]
