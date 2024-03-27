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

  deployment

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

  composer update

  ### Install Chatify
  composer require munafio/chatify
  php artisan chatify:install
  ### Install Breeze & Livewire
  composer require laravel/breeze --dev
  php artisan breeze:install
  ### Install Sanctum
  composer require laravel/sanctum
  php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
  php artisan sanctum:install

  php artisan migrate:fresh --seed
  php artisan key:generate
  php artisan storage:link

  echo "Laravel development completed."
}

# Main script execution
extract_archive

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
