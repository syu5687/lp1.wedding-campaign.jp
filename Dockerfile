FROM wordpress:php8.1-apache

# 環境変数（Cloud Run の $PORT に対応）
ENV PORT=8080
EXPOSE 8080

# ApacheのListenポートをCloud Runに合わせる
RUN sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf && \
    echo "ServerName localhost" >> /etc/apache2/apache2.conf

# .htaccess を有効にしてパーマリンクやCSSの読み込みを保証
RUN a2enmod rewrite && \
    sed -i "s/AllowOverride None/AllowOverride All/" /etc/apache2/apache2.conf

# 権限を調整（WordPressがファイルを書き込めるように）
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# 必要に応じて wp-config.php をコピーするならこの位置に追加
# COPY ./wp-config.php /var/www/html/wp-config.php