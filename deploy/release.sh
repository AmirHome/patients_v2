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
  # cp deploy/.env.local .env
  if [ ! -f ".env" ]; then
    cp deploy/.env.local .env
  fi
  # if set argument update -u or --update, update composer
  # composer update
  if [ "$1" == "-u" ] || [ "$1" == "--update" ]; then
    composer update
  fi

  # if set argument migrate -m or --migrate, migrate database
  # php artisan migrate:fresh --seed
  if [ "$1" == "-m" ] || [ "$1" == "--migrate" ]; then
    php artisan migrate:fresh --seed
  fi

  php artisan key:generate
  php artisan storage:link

  echo "Laravel development completed."
}

# Main script execution
clean_code
extract_archive
deployment

# Get the commit message argument (if provided)
commit_message="$1"

# Check if a commit message was provided
if [[ -z "$commit_message" ]]; then
  echo "Skipping Git commands as no commit message provided."
else
  # Git add, commit and push with provided message
  git add .
  git commit -m "$commit_message"
  git push
fi

