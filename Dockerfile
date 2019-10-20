FROM php:7.2-apache

ENV APACHE_DOCUMENT_ROOT /var/www/html/site/public

RUN apt-get update && apt-get install -y                \
        libzip-dev                                      \
        unzip                                           \
        git                                          && \
    docker-php-ext-configure zip --with-libzip       && \
    docker-php-ext-install                              \
        zip pdo pdo_mysql                            && \
        a2enmod rewrite

RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

COPY ./site /var/www/site
RUN chown -R www-data:www-data /var/www/site/storage
RUN chmod 755 /var/www/site/storage


