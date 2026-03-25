FROM php:8.2-cli

# instala dependências do postgres
RUN apt-get update && apt-get install -y libpq-dev

# instala extensões
RUN docker-php-ext-install pdo pdo_pgsql

WORKDIR /app

COPY . .

EXPOSE 10000

CMD ["php", "-S", "0.0.0.0:10000"]