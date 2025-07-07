# Aplikasi Tiket Kereta Online

Aplikasi web pemesanan tiket kereta online menggunakan Laravel.

## Fitur

- Autentikasi admin dengan Laravel Breeze
- CRUD data kereta (Train)
- CRUD jadwal kereta (Schedule) - dalam pengembangan
- CRUD pemesanan (Booking) - dalam pengembangan
- CRUD tiket (Ticket) - dalam pengembangan

## Instalasi

1. Clone repository ini
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```
3. Copy file `.env.example` ke `.env` dan sesuaikan konfigurasi database
4. Generate application key:
   ```bash
   php artisan key:generate
   ```
5. Jalankan migrasi:
   ```bash
   php artisan migrate
   ```
6. Build assets:
   ```bash
   npm run build
   ```

## Menjalankan Aplikasi

### Development
```bash
php artisan serve
```

### Production (Custom Start Command)
```bash
./start.sh
```

### Pre-Deploy Command
```bash
./pre-deploy.sh
```

## Struktur Database

- **users**: Tabel user untuk autentikasi
- **trains**: Data kereta (id, name, type, seat_count)
- **schedules**: Jadwal kereta (id, train_id, departure, arrival, date, price)
- **bookings**: Pemesanan (id, user_id, schedule_id, seat_number, status)
- **tickets**: Tiket (id, booking_id, code, issued_at)

## Akses

- Beranda: `/`
- Login: `/login`
- Register: `/register`
- Daftar Kereta: `/trains` (perlu login)
- Jadwal: `/schedules`
- Pemesanan: `/bookings`
- Tiket: `/tickets`

## Custom Commands

### Start Command
```bash
mkdir -p storage/framework/cache storage/framework/sessions storage/framework/testing storage/framework/views && chmod -R 777 storage bootstrap/cache && php artisan serve --host=0.0.0.0 --port=8080
```

### Pre-Deploy Command
```bash
mkdir -p storage/framework/cache storage/framework/sessions storage/framework/testing storage/framework/views && composer install --no-interaction --prefer-dist --optimize-autoloader && npm install && npm run build && php artisan storage:link
```
