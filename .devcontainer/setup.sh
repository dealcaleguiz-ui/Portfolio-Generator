#!/usr/bin/env bash
set -e

echo "Installing PHP PostgreSQL and intl extensions..."

sudo apt-get update
sudo apt-get install -y php8.4-pgsql php8.4-intl

# Locate the PostgreSQL PDO extension
PDO_PGSQL=$(dpkg -L php8.4-pgsql | grep '/pdo_pgsql\.so$' | head -1)

# Locate the intl extension
INTL=$(dpkg -L php8.4-intl | grep '/intl\.so$' | head -1)

if [ -z "$PDO_PGSQL" ] || [ -z "$INTL" ]; then
    echo "ERROR: Required PHP extensions were not found."
    exit 1
fi

# Find the configuration directory used by Codespaces PHP
INI_DIR=$(php --ini | sed -n 's/^Scan for additional .ini files in: *//p')

if [ -z "$INI_DIR" ] || [ ! -d "$INI_DIR" ]; then
    echo "ERROR: PHP configuration directory was not found."
    exit 1
fi

# Remove the old PostgreSQL configuration to prevent duplicate loading
sudo rm -f "$INI_DIR/postgresql.ini"

# Enable both extensions for Codespaces PHP
sudo tee "$INI_DIR/portfolio-extensions.ini" > /dev/null <<INI
extension=$PDO_PGSQL
extension=$INTL
INI

echo "Checking PostgreSQL extension..."
php -m | grep -i '^pdo_pgsql$'

echo "Checking intl extension..."
php -m | grep -i '^intl$'

echo "Installing Laravel dependencies..."
composer install --no-interaction

echo "Setup completed successfully!"