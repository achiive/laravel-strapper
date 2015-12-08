#!/bin/bash

echo "
Laravel Strapper
========================================
"

echo "
Installing Laravel...
----------------------------------------
"
git clone https://github.com/laravel/laravel.git .

echo "
Install composer packages...
----------------------------------------
"
composer install

echo "
Create configs...
----------------------------------------
"
php -r "copy('.env.example', '.env');"
php artisan key:generate


echo "
Do some house keeping...
----------------------------------------
"
php -r "rename('readme.template.md, 'readme.md');"
rm -f readme.md
rm -rf .git
rm -f install.sh

echo "
Done!
"
