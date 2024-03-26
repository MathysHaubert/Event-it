FROM php:8.2-apache
LABEL authors="MathysHaubert"

RUN apt-get update && apt-get upgrade -y
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql mysqli
RUN if [ ! -e /usr/local/etc/php/php.ini ]; then ln -s /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini; fi

# Install dependencies
RUN apt-get install -y \
  libpng-dev libwebp-dev libjpeg-dev libfreetype6-dev libc-client-dev \
  libonig-dev libxslt-dev libpq-dev libvips42 \
  libssh-dev libgmp-dev libzip-dev libxml2-dev freetds-dev \
  \
  # Php extensions
  && docker-php-ext-install \
  mysqli \
  pdo_mysql \
  mbstring \
  xml \
  gd \
  exif \
  zip \
  soap \
  intl \
  xsl \
  opcache \
  # Clean php extensions
  && rm -rf /tmp/pear \
  && docker-php-source delete \
  \
  # Clean up \
  && apt-get autoremove -y \
  && apt-get clean

# Expose port
EXPOSE 80


