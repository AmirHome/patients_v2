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
  if [ "$1" == "-u" ] || [ "$1" == "--update" ]; then
    composer update
  fi

  # if set argument migrate -m or --migrate, migrate database
  if [ "$2" == "-m" ] || [ "$2" == "--migrate" ]; then
    php artisan migrate:fresh --seed
  fi

  php artisan key:generate
  php artisan storage:link

  echo "Laravel development completed."
}

# Main script execution
if [ $# -eq 0 ]; then
  deployment
elif [ $# -eq 1 ]; then
  case $1 in
    "clean")
      clean_code
      ;;
    "-u" | "--update")
      deployment "$1"
      ;;
    "-m" | "--migrate")
      deployment "" "$1"
      ;;
    *)
      echo "Invalid argument: $1"
      exit 1
      ;;
  esac
else
  deployment "$1" "$2"
fi
