#!/usr/bin/env bash
set -e

echo "Installing PHP PostgreSQL driver..."

sudo apt-get update
sudo apt-get install -y software-properties-common
sudo add-apt-repository -y ppa:ondrej/php
sudo apt-get update

sudo apt-get install -y \
  php8.4-cli \
  php8.4-pgsql \
  php8.4-mbstring \
  php8.4-xml \
  php8.4-curl \
  php8.4-zip \
  php8.4-sqlite3 \
  php8.4-intl \
  php8.4-bcmath

echo "Checking PostgreSQL driver..."

php -m | grep -i pdo_pgsql

echo "Installing Laravel dependencies..."

composer install --no-interaction

echo "PostgreSQL driver setup complete!"