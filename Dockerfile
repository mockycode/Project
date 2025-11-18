# Imagem base com PHP 8.2 + Apache
FROM php:8.2-apache

# Instalando extensões comuns (MySQL)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copia todo o projeto para dentro do container
COPY . /var/www/html/

# Habilita o módulo rewrite (caso tenha rotas)
RUN a2enmod rewrite

# Permissões
RUN chown -R www-data:www-data /var/www/html

# Porta padrão do Apache
EXPOSE 80

CMD ["apache2-foreground"]