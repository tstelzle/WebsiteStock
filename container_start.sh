#!/bin/bash

echo "CREATE TABLE bestand (name TEXT NOT NULL, menge TEXT NOT NULL, lagerort TEXT NOT NULL, mhd TEXT NOT NULL);" | sqlite3 /database/mydata.db
/etc/init.d/php7.4-fpm start
/etc/init.d/nginx start
chmod 747 -R /database
bash