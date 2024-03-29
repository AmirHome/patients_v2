#!/bin/bash

# Function to clean code git
function clean_code() {
  git reset --hard
  git clean -df
  echo -e "\e[34mCleaned code from git.\e[0m"
}

function pull_code() {
  git pull origin master
  # echo "Pulled code from master." by blue color
  echo -e "\e[34mPulled code from master.\e[0m"
}

# Function to develop laravel
function deployment($1) {
  echo "Current directory: $(pwd)"

  # if .env file dose not exists, copy .env.local to .env
  if [ ! -f ".env" ]; then
    cp deploy/.env.local .env
    # echo "Copied .env.local to .env." by blue color
    echo -e "\e[34mCopied .env.local to .env.\e[0m"
  fi

  cp deploy/.htaccess public/.htaccess

  # if set argument update -u or --update, update composer
  # if [ "$1" == "-u" ] || [ "$1" == "--update" ]; then
  # composer update
  # fi

  composer update --ignore-platform-req=ext-zip --ignore-platform-req=ext-exif

  php artisan key:generate
  php artisan storage:link

  php artisan media-library:clear
  php artisan optimize:clear
  # php artisan config:clear
  # php artisan route:clear
  # php artisan view:clear
  # php artisan cache:clear
  # php artisan log:clear

  # if set argument migrate -m or --migrate, migrate database
  case "$1" in
    "-m" | "--migrate")
      php artisan migrate --force
      echo -e "\e[34mDatabase migrated (force).\e[0m"
      ;;
    "-mf" | "--migrate-fresh")
      php artisan migrate:fresh --seed
      echo -e "\e[34mDatabase migrated (fresh) and seeded.\e[0m"
      ;;
    *)
      echo -e "\e[33mSkipping database migration (no argument provided).\e[0m"
      ;;
  esac
  # php artisan test
  # php artisan optimize
  # php artisan config:cache
  # php artisan route:cache
  # /usr/local/bin/ea-php83 artisan view:cache

  echo "Laravel development completed."
}

# Main script execution
clean_code
pull_code
deployment "$@"


