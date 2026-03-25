FROM php:8.2-cli

# instala drivers do banco
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

WORKDIR /app

COPY . .

EXPOSE 10000

CMD ["php", "-S", "0.0.0.0:10000"]