# DEMO SI Perpus (Simple)
Demo simpel membuat sistem perpus dengan Laravel dan VueJS

## Kebutuhan
- PHP 7.3
- MySQL
- Composer
- NodeJS LTS

## Cara Mennjalankan di Lokal
- clone menggunakan git dan masuk ke direktori proyek

```bash
git clone git@github.com:andhikayuana/demo-si-perpus.git
cd demo-si-perpus
```

- jalankan perintah berikut untuk instalasi dependensi php

```bash
composer install
```

- jalankan perintah berikut untuk instalasi dependensi nodejs

```bash
npm install
```

- jangan lupa buat database dan ubah konfigurasi dengan membuat file `.env` dari `.env.example`

```bash
cp .env.example .env
```

```.env
APP_NAME="SI Perpus"
APP_TIMEZONE=Asia/Jakarta

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={{database_anda}}
DB_USERNAME={{user_dari_database_anda}}
DB_PASSWORD={{password_dari_database_anda}}

BASE_URL_API=http://localhost:8000/api/v1/

```

- jalankan migrasi database dengan perintah

```bash
php artisan migrate
```
- compile assets dengan perintah berikut (development)

```bash
npm run watch
```

- jalankan server Laravel dengan perintah berikut

```bash
php artisan serve
```

- sekarang anda bisa akes dengan browser, http://localhost:8000