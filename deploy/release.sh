#!/bin/bash

# Function to clean code git
function clean_code() {
  git reset --hard
  git clean -df
  echo "Cleaned code git."
}

# Function to develop laravel
function deployment() {
  # if .env file dose not exists, copy .env.local to .env
  if [ ! -f ".env" ]; then
    cp deploy/.env.local .env
  fi
  # if set argument update -u or --update, update composer
  # if [ "$1" == "-u" ] || [ "$1" == "--update" ]; then
    # composer update
  # fi


  php artisan key:generate
  php artisan storage:link

  php artisan optimize:clear
  php artisan config:clear
  php artisan route:clear
  php artisan view:clear
  php artisan cache:clear
  php artisan log:clear
  
  # if set argument migrate -m or --migrate, migrate database
  # if [ "$2" == "-m" ] || [ "$2" == "--migrate" ]; then
    php artisan migrate --force
  # fi

  # php artisan test
  # php artisan optimize
  # php artisan config:cache
  # php artisan route:cache
  # php artisan view:cache


  echo "Laravel development completed."
}

# Main script execution
