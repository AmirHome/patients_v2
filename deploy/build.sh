#!/bin/bash

# Set the download folder path (modify if needed)
download_folder="$HOME/Downloads"
archive_file="dev-admin-e9f11f11d86ec53e"

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
  -ncp)
    NOTCPDEPLOY=false
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

  deployment

}

function clean_root_unzip() {

  # Check if archive exists
  if [ ! -f "$download_folder/$archive_file.zip" ]; then
    echo "Info: Archive '$archive_file.zip' not found in '$download_folder'"
    # exit 1
  else

    # protect files
    bash deploy/shield.sh

    # clean files
    find . ! -path "./.git" ! -path "./.git/*" ! -path "./deploy*" -delete
    echo "Info: Cleaned root directory (excluding .git and deploy folder)."

      # Extract the archive to the root directory
    unzip -q "$download_folder/$archive_file.zip" -d .
    echo "Extracted '$archive_file' to root directory."


    # (Optional) Remove the archive file after extraction
    if [ $RM ]; then
      find "$download_folder" -type f -name "dev-admin-e9f11f11d86ec53e*" -delete
      echo "Remove '$download_folder/$archive_file'."
    fi 
  fi

}

# Function to develop laravel
function deployment() {
  
  cp deploy/.env.local .env

  # php artisan key:generate
  php artisan storage:link
  php artisan optimize:clear

  if [ ! $NOTCPDEPLOY ]; then
    clean_root_unzip

    cp deploy/.env.local .env

    ### Backups
    rm -rf deploy/backup/
    mkdir -p deploy/backup/
    rsync -a --exclude='bootstrap' \
          --exclude='deploy' \
          --exclude='storage' \
          --exclude='tests' \
          --exclude='vendor' \
          --exclude='artisan' \
          --exclude='README.md' \
          --exclude='phpunit.xml' \
          --exclude='.*' \
          ./ deploy/backup/
          
    # rm -rf deploy/backup
    # mkdir -p deploy/backup/app/Models
    # mkdir -p deploy/backup/app/Http
    # cp -r resources deploy/backup
    # cp -r app/Models deploy/backup/app/Models
    # cp -r app/Http deploy/backup/app/Http

    ### Transfer
    cp -r deploy/transfer/* .
    cp deploy/transfer/.gitignore .gitignore

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
    # composer require laravel/horizon
    # php artisan horizon:install

    ### Install Debugbar
    composer require barryvdh/laravel-debugbar --dev

    ### Install Chart
    composer require asantibanez/livewire-charts
    php artisan livewire-charts:install

    ### Session config
    # php artisan session:table
    # copy from deploy 2024_04_17_121142_create_sessions_table.php

    ### Install queue
    php artisan queue:table
    php artisan queue:failed-table
    # php artisan queue:work --daemon > /dev/null 2>&1
    # php artisan queue:failed

    ### Manipulate codes
    coding

  fi


  ### Laravel development

  if [ $AUTOLOAD ]; then
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

function coding() {

    php artisan manipulate:codes
}

build

if [ ! -z "$GIT" ]; then
  git add .
  git commit -m "$GIT"
  git push
else
    echo "\n\n\nChanged .................... ....................\n"
    git status --short | grep -v database/migrations/ | grep -v deploy/
    echo "\n\n\nBackup .................... ....................\n"
    git status --short | grep deploy/backup | grep -v deploy/backup/database/migrations
    # git status
fi

# Depriceated
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