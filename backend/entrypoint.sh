#!/bin/sh

echo "Waiting for MySQL..."

until php -r "try { new PDO('mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD')); echo 'connected'; } catch (Exception \$e) { echo 'waiting...'; sleep(3); }" | grep "connected"; do
  sleep 3
done

echo "MySQL is UP!"

php artisan migrate --seed --force

php artisan serve --host=0.0.0.0 --port=8000
