#!/usr/bin/env bash
set -e

echo "Installing PHP PostgreSQL driver..."

sudo apt-get update
sudo apt-get install -y php8.4-pgsql

# Locate the PostgreSQL PDO extension installed by Ubuntu
SO=$(dpkg -L php8.4-pgsql | grep 'pdo_pgsql\.so$' | head -1)

if [ -z "$SO" ]; then
    echo "ERROR: pdo_pgsql extension file was not found."
    exit 1
fi

# Find the additional configuration directory for Codespaces PHP
INI_DIR=$(php --ini | sed -n 's/^Scan for additional .ini files in: *//p')

if [ -z "$INI_DIR" ] || [ ! -d "$INI_DIR" ]; then
    echo "ERROR: PHP configuration directory was not found."
    exit 1
fi

# Enable only the PDO PostgreSQL extension
echo "extension=$SO" | sudo tee "$INI_DIR/postgresql.ini"

echo "Checking PostgreSQL driver..."
php -m | grep -i '^pdo_pgsql$'

echo "Installing Laravel dependencies..."
composer install --no-interaction

echo "PostgreSQL driver setup complete!"
