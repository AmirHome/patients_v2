#!/bin/bash

# Parse arguments
# sh release.sh env=ver2 -m
for args in "$@"; do
  case $args in
  env=*)
    ENV="${args#*=}"
    shift
    ;;
  -m)
    MIGRATE=true
    shift
    ;;
  -ms)
    MIGRATESEED=true
    shift
    ;;
  *)
    echo "Invalid argument: $args"
    ;;
  esac
done

# Function to execute commands inside Docker container
run_in_docker() {
    docker exec -it app bash -c "$1"
}

# Function to clean code git
function clean_code() {
  git reset --hard
  git clean -df
  echo -e "\e[34mCleaned code from git.\e[0m"
}

function pull_code() {
  git pull origin master
  echo -e "\e[34mPulled code from master.\e[0m"
}

# Function to develop laravel
function deployment() {
  echo "Current directory: $(pwd)"

  # If environment is not provided, default to 'local'
  if [ ! -z "$ENV" ]; then
    cp "deploy/.env.$ENV" .env
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

  if [ "$MIGRATESEED" ]; then
    php artisan migrate:fresh --seed
    echo "Database migrated and seeded."
  else
    php artisan migrate --force
    echo "Database migrated."
  fi

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
#deployment
