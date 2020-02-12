FROM hitalos/laravel
RUN cp laravel/.env.example laravel/.env
RUN composer install
RUN php laravel/artisan config:clear
RUN php laravel/artisan key:generate