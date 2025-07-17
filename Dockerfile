FROM wordpress:php8.1-apache

# Cloud Run は $PORT 環境変数でポート指定 → Apacheの設定を変更
ENV PORT=8080
EXPOSE 8080

# ApacheのListenポートをCloud Runに合わせる
RUN sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf \
 && echo "ServerName localhost" >> /etc/apache2/apache2.conf

# .htaccess を使えるように（パーマリンクやログイン不具合防止）
RUN a2enmod rewrite \
 && sed -i "s/AllowOverride None/AllowOverride All/" /etc/apache2/apache2.conf

# 権限調整（必要）
RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 755 /var/www/html
 
 RUN a2enmod rewrite && \
 sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf