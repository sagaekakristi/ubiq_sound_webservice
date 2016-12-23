## Deployment Steps

1. composer install
2. buat database. nama: ubiq_sound_db , user: ubiq_sound_dev , password: ubiq_sound_password
3. php artisan migrate
4. php artisan db:seed --class=MultideviceController
5. php artisan serve
6. copy .env.example ke file baru .env dan ubah bagian dibawah:
DB_DATABASE=ubiq_sound_db
DB_USERNAME=ubiq_sound_dev
DB_PASSWORD=ubiq_sound_password