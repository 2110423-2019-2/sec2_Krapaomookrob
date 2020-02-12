FROM hitalos/laravel:latest

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer && composer global require hirak/prestissimo --no-plugins --no-scripts
COPY ./laravel/composer.json ./
COPY ./laravel/composer.lock ./
RUN composer install --prefer-dist --no-scripts --no-dev --no-autoloader && rm -rf /root/.composer
COPY ./laravel/. ./
RUN composer dump-autoload --no-scripts --no-dev --optimize

# ADD ./setup.sh /setup.sh
# RUN chmod +x /setup.sh
# CMD ["sh", "/setup.sh"]