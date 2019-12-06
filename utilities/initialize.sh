#!/bin/bash
# Initializes site and database for initial setup of the site on a server

# Copy equine site files to the appropriate locations on the server
SITE=/var/www/html/equine

if test -e "$SITE"; then
	sudo rm -r $SITE
fi
sudo mkdir $SITE
sudo cp ../*.php  $SITE # Copy all php pages from site root
sudo cp -r ../admin $SITE # Copy admin
sudo cp -r ../analytics $SITE # Copy analytics
sudo cp -r ../assets $SITE # Copy assets
sudo cp -r ../functions $SITE # Copy functions

# Initialize database
chmod u+x initialize_equine.sql
echo "Please enter your password for MySQL"
sudo cat /etc/mysql/debian.cnf
mysql -h localhost -u debian-sys-maint -p -t -vvv < initialize_equine.sql > database_results.txt

# Set up database users
chmod u+x create_db_users.sql
echo "Please enter your password for MySQL"
sudo cat /etc/mysql/debian.cnf
mysql -h localhost -u debian-sys-maint -p -t -vvv < create_db_users.sql > user_results.txt