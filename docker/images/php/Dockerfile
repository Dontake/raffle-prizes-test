FROM php:8.0-fpm

# INSTALL Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update \
  && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    cron \
    libxml2-dev \
    supervisor \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install -j$(nproc) \
  zip \
  pdo \
  pdo_mysql \
  soap \
  mysqli

# INSTALL PHP GD
RUN apt-get update \
  && apt-get install -y \
    zlib1g-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j$(nproc) gd

# SETTINGS supervisor
RUN mkdir -p /var/log/supervisor
RUN mkdir -p /var/log/php-fpm
COPY supervisor/* /etc/supervisor/conf.d/

RUN touch /var/log/cron.log

WORKDIR /var/www/html

CMD /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
