# Inventaris
 Laravel 8
    - MultiRole (Per Ruangan)
    - Multi Access (Admin, Operator, Umum)
    - Approve (Pindah)
    - Boostrap Implement
 

Clone repository ini

    https://github.com/wafercoklat/Inventaris.git

Install seluruh packages yang dibutuhkan

    composer install

Siapkan database dan atur file .env sesuai dengan konfigurasi Anda
     
    cp .env.example .env
    
Atur Koneksi database seperti ini pada file .env

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=dbinventaris
    DB_USERNAME=root
    DB_PASSWORD=
     
Jika sudah, migrate seluruh migrasi dan seeding data

    php artisan migrate --seed

Genereate Key

    php artisan key:generate 

Jalankan local server

    php artisan serve

User default aplikasi untuk login

    Email       : admin
    Password    : 12345
