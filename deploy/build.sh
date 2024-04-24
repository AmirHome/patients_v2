#!/bin/bash

# Set the download folder path (modify if needed)
download_folder="$HOME/Downloads"
archive_file="dev-admin-e9f11f11d86ec53e.zip"

# Parse arguments
for args in "$@"; do
  case $args in
  git=*)
    GIT="${args#*=}"
    shift
    ;;
  -ms)
    MIGRATESEED=true
    shift
    ;;
  -at)
    AUTOLOAD=true
    shift
    ;;
  -r)
    RM=true
    shift
    ;;
  *)
    echo "Invalid argument: $args"
    ;;
  esac
done

# Function to extract archive
function build() {
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
  if [ $RM ]; then
    rm -f "$download_folder/$archive_file"
    echo "Remove '$download_folder/$archive_file'."
  fi

}

# Function to clean root directory (excluding .git and deploy)
function clean_root() {
  # protect files
  bash deploy/shield.sh
  # clean files
  find . ! -path "./.git" ! -path "./.git/*" ! -path "./deploy*" -delete
  echo "Cleaned root directory (excluding .git and deploy folder)."
}

# Function to develop laravel
function deployment() {
  cp -r deploy/transfer/* .
  cp deploy/.env.local .env


  ### Install Chatify
  # composer require munafio/chatify
  # php artisan chatify:install

  ### Sanctum already exists ###

  ### Install LiveWire
  composer require livewire/livewire
  php artisan livewire:publish --assets --config
  php artisan make:livewire counter
  ### - app/Livewire/Counter.php
  ### - resources/views/livewire/counter.blade.php
  php artisan livewire:layout
  ### - resources/views/components/layouts/app.blade.php

  ### Install Media Library
  php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="config"

  ### Install Pulse
  composer config minimum-stability beta
  composer require laravel/pulse
  php artisan vendor:publish --provider="Laravel\Pulse\PulseServiceProvider"
  #php artisan migrate

  ### Install Telescope
  composer require laravel/telescope
  php artisan telescope:install
  # php artisan telescope:publish
  #php artisan migrate

  ### Install Horizon
  composer require laravel/horizon
  php artisan horizon:install


  ### Session config
  # php artisan session:table
  # copy from deploy 2024_04_17_121142_create_sessions_table.php

  ### Write code in function
  coding

  ### Laravel development
  # php artisan key:generate
  php artisan storage:link

  php artisan optimize:clear


  if [ $AUTOLOAD ]; then
    #cp deploy/composer.json composer.json
    # composer update
    composer dump-autoload
  fi
  composer update

  if [ $MIGRATESEED ]; then
    php artisan migrate:fresh --seed
  else
    php artisan migrate --force
  fi

  echo "Laravel development completed."
}

insert_line_if_not_exists() {
  local file_path="$1"
  local line_to_check="$2"
  local placeholder="$3"  # Use "placeholder" for clarity

  # Check if the line exists using grep -qF
  if grep -qF "$line_to_check" "$file_path"; then
    echo "$line_to_check already exists in the $file_path"
  else
    # Escape backslashes in line_to_check using sed
    local escaped_line=$(sed 's/\\/\\\\/g' <<< "$line_to_check")
    local escaped_placeholder=$(sed 's/\\/\\\\/g' <<< "$placeholder")

    # Insert the line with awk (improved error handling)
    # awk -v escaped_line="$escaped_line" -v escaped_placeholder="$escaped_placeholder" -v placeholder="$placeholder" 'BEGIN { exit_code = 0 } { sub(placeholder, escaped_placeholder"\n" escaped_line); print } END { exit(exit_code) }' "$file_path" > "$file_path.tmp" || {
    awk -v line="$escaped_line" 'BEGIN { exit_code = 0 } { print } END { print line; exit(exit_code) }' "$file_path" > "$file_path.tmp" && mv "$file_path.tmp" "$file_path"  || {
      echo "Error: Failed to insert line into $file_path" >&2
      return 1  # Indicate error to caller
    }

    echo $placeholder
    echo "$line_to_check inserted into $file_path"
  fi
}

function coding() {

  ### Set Route
  # LINE="Route::get('/counter', '\App\Livewire\Counter');"
  # FILE=routes/web.php
  # grep -qF -- "$LINE" "$FILE" || echo "$LINE" >>"$FILE"

  insert_line_if_not_exists "routes/web.php" "Route::get('/travel','\App\Livewire\Counter');" ""
  insert_line_if_not_exists "routes/web.php" "Route::get('/travel','\App\Livewire\Travel');" ""


}

build

if [ ! -z "$GIT" ]; then
  git add .
  git commit -m "$GIT"
  git push
fi
