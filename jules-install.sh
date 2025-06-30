#!/usr/bin/bash 
# install php
sudo apt-get update;
sudo apt-get install php php-xml php-dom php-mbstring php-curl php-zip -y;

# install composer and dependencies
cd backend;
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }"
php composer-setup.php
php -r "unlink('composer-setup.php');"
php composer.phar install -n;

# install nodejs and dependencies
cd ../frontend;
npm install;
