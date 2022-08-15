FROM php:apache
RUN apt-get update && apt-get install -y \
  && docker-php-ext-install mysqli && docker-php-ext-enable mysqli