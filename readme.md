## Deployment Steps

1. composer install
2. php artisan migrate
3. php artisan db:seed --class=MultideviceController
4. php artisan serve