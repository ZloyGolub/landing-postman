# Используем официальный образ PHP
FROM php:8.1-apache

# Устанавливаем необходимые расширения
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Копируем файлы проекта в контейнер
COPY . /var/www/html/

# Устанавливаем Composer
RUN apt-get update && apt-get install -y unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Устанавливаем зависимости проекта
WORKDIR /var/www/html
RUN composer install

# Запускаем сервер Apache
CMD ["apache2-foreground"]
