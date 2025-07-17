FROM wordpress:php8.1-apache

# Cloud Run の $PORT に合わせるため Apache 設定を上書き
RUN sed -i 's/Listen 80/Listen ${PORT}/' /etc/apache2/ports.conf \
 && echo "ServerName localhost" >> /etc/apache2/apache2.conf

# ドキュメントルートにファイルをコピー（必要に応じて）
# COPY . /var/www/html

# ポート環境変数（Cloud Runが自動で設定するが念のため）
ENV PORT=8080

EXPOSE 8080

# mod_rewrite を有効化
RUN a2enmod rewrite

# .htaccess を許可する
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf