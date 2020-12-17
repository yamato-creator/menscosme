#!/bin/bash

set -eux

cd ~/menscosme
php artisan migrate --force
php artisan config:cache