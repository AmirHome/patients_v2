#!/bin/bash



# LiveWire
mkdir -p deploy/transfer/app
mkdir -p deploy/transfer/resources/views/livewire
mkdir -p deploy/transfer/resources/views/components

cp -r app/Livewire deploy/transfer/app
cp -r resources/views/livewire deploy/transfer/resources/views
cp -r resources/views/components deploy/transfer/resources/views


# Write to function coding() in deploy/transfer.sh
LINE="Route::get('/counter', '\App\Livewire\Counter');"
FILE=routes/web.php
grep -qF -- "$LINE" "$FILE" || echo "$LINE" >> "$FILE"

