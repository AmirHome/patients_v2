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

  # Extract the archive to the root directory
  unzip -q "$download_folder/$archive_file" -d .

    # (Optional) Remove the archive file after extraction
    rm -f "$download_folder/$archive_file"
  echo "Extracted '$archive_file' to root directory."
}

# Function to clean root directory (excluding .git and deploy)
function clean_root() {
  find . ! -path "./.git" ! -path "./.git/*" ! -path "./deploy*" -delete
  echo "Cleaned root directory (excluding .git and deploy folder)."
}

# Function to develop laravel
function deployment() {
  cp -r deploy/* ..
  cp .env.local .env
  
  composer update
  php artisan migrate:fresh --seed
  php artisan key:generate
  php artisan storage:link

  echo "Laravel development completed."
}

# Main script execution
clean_root
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

