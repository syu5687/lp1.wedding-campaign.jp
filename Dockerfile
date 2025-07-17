FROM wordpress:php8.1-apache

# Cloud Run のポートに対応
ENV PORT=8080
EXPOSE 8080

# Apache のポート設定と ServerName 設定
RUN sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf && \
    echo "ServerName localhost" >> /etc/apache2/apache2.conf

# .htaccess を使えるようにする
RUN a2enmod rewrite && \
    sed -i "s/AllowOverride None/AllowOverride All/" /etc/apache2/apache2.conf

# 権限の設定
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# 必要な設定ファイルを配置（存在する場合のみ）
COPY ./.htaccess /var/www/html/.htaccess
COPY ./wp-config.php /var/www/html/wp-config.php