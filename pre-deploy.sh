#!/bin/bash

# Pre-Deploy Command untuk Aplikasi Tiket Kereta
echo "Preparing Tiket Kereta Application for deployment..."

# Membuat direktori storage yang diperlukan
mkdir -p storage/framework/cache storage/framework/sessions storage/framework/testing storage/framework/views

# Install Composer dependencies
echo "Installing Composer dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader

# Install NPM dependencies
echo "Installing NPM dependencies..."
npm install

# Build assets
echo "Building assets..."
npm run build

# Create storage link
echo "Creating storage link..."
php artisan storage:link

echo "Pre-deploy completed successfully!" 