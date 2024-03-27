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
function deployment() {
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

  /usr/local/bin/ea-php83 artisan key:generate
  /usr/local/bin/ea-php83 artisan storage:link

  /usr/local/bin/ea-php83 artisan optimize:clear
  /usr/local/bin/ea-php83 artisan config:clear
  /usr/local/bin/ea-php83 artisan route:clear
  /usr/local/bin/ea-php83 artisan view:clear
  /usr/local/bin/ea-php83 artisan cache:clear
  /usr/local/bin/ea-php83 artisan log:clear

  # if set argument migrate -m or --migrate, migrate database
  # if [ "$2" == "-m" ] || [ "$2" == "--migrate" ]; then
    /usr/local/bin/ea-php83 artisan migrate --force
  # fi

  # /usr/local/bin/ea-php83 artisan test
  # /usr/local/bin/ea-php83 artisan optimize
  # /usr/local/bin/ea-php83 artisan config:cache
  # /usr/local/bin/ea-php83 artisan route:cache
  # /usr/local/bin/ea-php83 artisan view:cache


  echo "Laravel development completed."
}

# Main script execution
clean_code
pull_code
deployment