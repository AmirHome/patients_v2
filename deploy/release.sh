#!/bin/bash

# Parse arguments
# sh deploy/release.sh env=ver2 -m -d
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
  -d)
    DOCKER=true
    shift
    ;;
  *)
    echo "Invalid argument: $args"
    ;;
  esac
done

# Function to execute commands inside Docker container
run_in_docker() {
    docker exec -u root -it app bash -c "$1"
}

# Function to clean code git
function clean_code() {
  git reset --hard
  git clean -df
  echo "\n Cleaned code from git. \n\n\n"
}

function pull_code() {
  git pull origin master
  echo "\nPulled code from master.\n\n\n"
}
# Function Docker build and start
function docker_build_start() {
  # If environment is not provided, default to 'local'
  if [ ! -z "$ENV" ]; then
    cp "deploy/.env.$ENV" .env
  fi

  # cp deploy/.htaccess public/.htaccess

  docker-compose down
  docker-compose rm -f -v app webserver db

  docker-compose up -d --build
  echo "\n Docker build and start completed. \n\n\n"
}

# Function to develop laravel
function deployment() {
  echo "Current directory: $(pwd)"


  if [ "$DOCKER" ]; then
    
    # if [ -d "vendor" ]; then
        run_in_docker "cd admin && rm -rf vendor"
    # fi

    # Remove composer.lock if it exists
    # if [ -f "composer.lock" ]; then
        run_in_docker "cd admin && rm composer.lock"
    # fi

    # Update Composer and clear cache
    run_in_docker "cd admin && composer clear-cache"
    run_in_docker "cd admin && composer update"
    # run_in_docker "cd admin && composer dump-autoload"
    run_in_docker "chown -R deploy:deploy /var/www"

    # if set argument migrate -m or --migrate, migrate database

    if [ "$MIGRATESEED" ]; then
      run_in_docker "cd admin && php artisan migrate:fresh --seed"
      echo "\n Database migrated and seeded.\n\n\n"
    else
      run_in_docker "cd admin && php artisan migrate --force"
      echo "\n Database migrated.\n\n\n"
    fi

  else

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
docker_build_start
deployment
