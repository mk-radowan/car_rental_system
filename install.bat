@echo off
echo Installing Pothik Car Rental Platform...
composer install
if not exist .env copy .env.example .env
php artisan key:generate
php artisan db:seed
echo.
echo Installation complete!
echo Run: php artisan serve
echo Open: http://127.0.0.1:8000
pause
