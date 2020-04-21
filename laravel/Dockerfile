FROM php:7.2-fpm

# Copy composer.lock and composer.json
COPY composer.lock composer.json package.json package-lock.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl 

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install npm
# RUN curl -sL https://deb.nodesource.com/setup_13.x | bash -
# RUN apt-get install -y nodejs

# Copy existing application directory contents
COPY . /var/www
RUN chown -R www-data:www-data /var/www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
RUN ["/bin/bash", "-c", "composer install"]
CMD ["/bin/bash", "-c", "php artisan key:generate && php artisan migrate:fresh --seed && docker-php-entrypoint php-fpm"]
# && npm install && npm run dev