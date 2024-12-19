# Usa una imagen base de PHP con Apache
FROM php:8.1-apache

# Instala extensiones necesarias para MariaDB/MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copia los archivos del proyecto al contenedor
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Da permisos necesarios al directorio
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expone el puerto 80 para acceso HTTP
EXPOSE 80
