# Image de base : PHP 8.2 avec Apache déjà configuré
FROM php:8.2-apache

# Installe unzip et la bibliothèque zip système, nécessaires à Composer pour décompresser les paquets
RUN apt-get update && apt-get install -y unzip libzip-dev \
    && docker-php-ext-install zip

# Installe les extensions PHP nécessaires : PDO MySQL (BDD relationnelle) et MongoDB (BDD NoSQL)
RUN docker-php-ext-install pdo pdo_mysql \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

# Active le module Apache de réécriture d'URL, indispensable pour notre .htaccess (front controller)
RUN a2enmod rewrite

# Récupère Composer depuis son image officielle (pour installer mongodb/mongodb)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Fait pointer la racine du serveur web vers le dossier public/ (et non la racine du projet)
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Autorise l'utilisation de .htaccess dans public/ (sinon les routes autres que "/" ne fonctionnent pas)
RUN printf '<Directory /var/www/html/public>\n\tAllowOverride All\n</Directory>\n' >> /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Copie tout le code du projet dans l'image
COPY . .

# Installe les dépendances Composer (mongodb/mongodb), sans les paquets de développement
RUN composer install --no-dev --optimize-autoloader

EXPOSE 80