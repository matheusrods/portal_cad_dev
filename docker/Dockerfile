FROM php:8.1-apache

# 1) instala extensões PHP (incluindo mysqli)
RUN apt-get update \
 && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
      libpq-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
      libonig-dev libxml2-dev libcurl4-openssl-dev pkg-config \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j"$(nproc)" \
      mysqli \
      pdo_mysql \
      pdo_pgsql \
      zip \
      gd \
      mbstring \
      xml \
      curl \
 && apt-get purge -y --auto-remove \
      pkg-config libzip-dev libonig-dev libxml2-dev libcurl4-openssl-dev \
 && rm -rf /var/lib/apt/lists/*

# 2) habilita módulos Apache
RUN a2enmod rewrite ssl headers

# 3) copia vhosts, includes e certificados/CRL
COPY apache2/vhosts.d/    /etc/apache2/sites-available/
COPY apache2/conf.d/      /etc/apache2/conf-available/
COPY apache2/ssl/         /etc/apache2/ssl/

# 4) placeholder para o seu Include /etc/apache2/env.conf
RUN touch /etc/apache2/env.conf

# 5) remove o default-ssl e desabilita qualquer site padrão
RUN a2dissite default-ssl.conf default-ssl 2>/dev/null \
 && rm -f /etc/apache2/sites-available/default-ssl.conf \
 && rm -f /etc/apache2/sites-enabled/default-ssl.conf \
 && rm -f /etc/apache2/sites-enabled/000-default.conf

# 6) habilita só os seus .conf
RUN rm -f /etc/apache2/sites-enabled/*.conf \
 && a2ensite '*.conf' \
 && a2enconf '*.conf'

# 7) garante pasta de sessões PHP
RUN mkdir -p /var/lib/php8/sessions \
 && chown -R www-data:www-data /var/lib/php8/sessions

# 8) monta o código PHP
WORKDIR /var/www/html
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80 443
CMD ["apache2-foreground"]
