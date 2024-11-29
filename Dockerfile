FROM php:8.2-apache

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Ajustar permisos de los archivos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Habilitar el módulo rewrite de Apache
RUN a2enmod rewrite

# Copiar configuración de Apache
COPY apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Copiar archivos del proyecto
COPY . /var/www/html/

# Establecer el directorio de trabajo
WORKDIR /var/www/html/

# Ejecutar Composer install automáticamente
RUN composer install --no-dev --optimize-autoloader
