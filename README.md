# Langkah-langkah Menjalankan Aplikasi

## Backend

1. Clone repository ini
2. Install dependencies dengan menjalankan perintah `composer install`
3. Buat file `.env` dengan mengcopy file `.env.example`
4. Isi variabel-variabel yang dibutuhkan seperti `APP_KEY`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD`
5. Jalankan perintah `php artisan key:generate` untuk generate app key
6. Jalankan perintah `php artisan migrate` untuk migrate database
7. Jalankan perintah `php artisan serve` untuk menjalankan server

## Frontend

1. Clone repository ini
2. Install dependencies dengan menjalankan perintah `npm install` atau `yarn install`
3. Jalankan perintah `npm run dev` atau `yarn dev` untuk menjalankan server
4. Buka browser dan akses alamat `http://localhost:5173` untuk melihat aplikasi frontend
