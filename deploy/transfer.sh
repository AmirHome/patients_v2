#!/bin/bash

# Set the download folder path (modify if needed)
download_folder="$HOME/Downloads"
archive_file="dev-admin-e9f11f11d86ec53e.zip"

# Function to extract archive
function extract_archive() {
  # Check if archive exists
  if [ ! -f "$download_folder/$archive_file" ]; then
    echo "Error: Archive '$archive_file' not found in '$download_folder'"
    exit 1
  fi

  clean_root

  # Extract the archive to the root directory
  unzip -q "$download_folder/$archive_file" -d .
  echo "Extracted '$archive_file' to root directory."

  deployment "$@"

  # (Optional) Remove the archive file after extraction
  rm -f "$download_folder/$archive_file"
  echo "Remove '$download_folder/$archive_file'."
}

# Function to clean root directory (excluding .git and deploy)
function clean_root() {

  find . ! -path "./.git" ! -path "./.git/*" ! -path "./deploy*" -delete
  echo "Cleaned root directory (excluding .git and deploy folder)."
}

# Function to develop laravel
function deployment() {
  cp -r deploy/transfer/* .
  cp deploy/.env.local .env

  ### Install Chatify
  composer require munafio/chatify
  php artisan chatify:install
  ### Install Breeze
  # composer require laravel/breeze --dev
  # php artisan breeze:install

  ### Install LiveWire
  composer require livewire/livewire
  php artisan livewire:publish --assets --config
  php artisan make:livewire counter
  ### - app/Livewire/Counter.php
  ### - resources/views/livewire/counter.blade.php
  php artisan livewire:layout
  ### - resources/views/components/layouts/app.blade.php

  ### Sanctum already exists ###

  ### Install Media Library
  php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="config"

  ### Install Pulse
  composer config minimum-stability beta
  composer require laravel/pulse
  php artisan vendor:publish --provider="Laravel\Pulse\PulseServiceProvider"
  #php artisan migrate

  ### Write code in function
  coding

  ### Laravel development
  php artisan key:generate
  php artisan storage:link

  composer update

  case "$1" in
    "-a" | "--autoload")
      composer --version
      cp deploy/composer.json composer.json
      composer update
      composer dump-autoload
      ;;
    "-mf" | "--migrate-fresh")
      php artisan --version
      php artisan migrate:fresh --seed
      ;;
    *)
      if [ -z "$1" ]; then
        echo "Skipping database migration (no argument provided)."
      else
        echo "Invalid argument: $1"
      fi
      ;;
  esac
  
  echo "Laravel development completed."
}

function coding() {

  ### Set Route
  LINE="Route::get('/counter', '\App\Livewire\Counter');"
  FILE=routes/web.php
  grep -qF -- "$LINE" "$FILE" || echo "$LINE" >> "$FILE"

}

# Main script execution
bash deploy/shield.sh

extract_archive "$@"

# Parse arguments 
for arg in "$@"
do
    case $arg in
        git=*)
            ARG="${arg#*=}"
            shift
            ;;
        *)
            # Unknown argument
            ;;
    esac
done
if [ ! -z "$ARG" ]; then
  git add .
  git commit -m "$ARG"
  git push
fi