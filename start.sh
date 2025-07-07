#!/bin/bash

# Custom Start Command untuk Aplikasi Tiket Kereta
echo "Starting Tiket Kereta Application..."

# Membuat direktori storage yang diperlukan
mkdir -p storage/framework/cache storage/framework/sessions storage/framework/testing storage/framework/views

# Set permission untuk storage dan bootstrap/cache
chmod -R 777 storage bootstrap/cache

# Menjalankan server Laravel
php artisan serve --host=0.0.0.0 --port=8080 