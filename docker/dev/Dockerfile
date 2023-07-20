##########################
####    NGINX BASE     ###
##########################

FROM nginx:alpine AS nginx-dev

# timezone
RUN apk add tzdata  \
    && cp /usr/share/zoneinfo/Europe/Berlin /etc/localtime  \
    && echo "Europe/Berlin" > /etc/timezone  \
    && apk del tzdata

# sites templates
COPY ./docker/dev/nginx/ /etc/nginx/templates/

CMD ["nginx", "-g", "daemon off;"]

########################
####    PHP BASE     ###
########################

FROM php:8.2.8-fpm-alpine AS php-dev

# install software
RUN apk --no-cache update \
    && apk --no-cache upgrade \
    && apk add --no-cache --virtual \
        wget \
        curl \
        nano \
        git

# icu full && timezone
RUN apk add icu-data-full \
    && apk add tzdata  \
    && cp /usr/share/zoneinfo/Europe/Berlin /etc/localtime  \
    && echo "Europe/Berlin" > /etc/timezone  \
    && apk del tzdata

# install php extensions and use an external script for that.
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync && install-php-extensions \
    intl \
    redis \
    pdo_mysql \
    opcache \
    pcntl \
    bz2 \
    bcmath \
    zip \
    yaml

# php settings
RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
COPY ./docker/dev/php/php-ini-overrides.ini /usr/local/etc/php/conf.d/

CMD ["php-fpm"]
