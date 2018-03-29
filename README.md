NEM Yii Application
----

*Install required libs*:

```
# This is where the *built* PHP will be installed.
mkdir ~/php-7.1.8/

# Download php source code
cd ~/Downloads
wgets http://de2.php.net/get/php-7.1.8.tar.bz2/from/this/mirror
tar xvzf php-7.1.8.tar.bz2

# We now have the PHP source code unarchived
cd php-7.1.8

# MacOS
brew install intltool icu4c gettext
brew link icu4c gettext
./configure --with-apxs2=/Applications/MAMP/Library/bin/apxs --prefix=/Users/greg/php-7.1.8 --enable-intl --with-gmp --with-xmlrpc --enable-bcmath --with-curl=/usr --with-gettext=/usr/local/Cellar/gettext/ --with-gd --with-pdo-mysql --with-openssl=/usr/local/Cellar/openssl/1.0.2n/ --enable-mbstring
make
make install
# End-MacOS

# Linux
./configure --prefix=/home/greg/php-7.1.8 --enable-intl --with-gmp --with-xmlrpc --enable-bcmath --with-curl=/usr --with-gettext --with-gd --with-pdo-mysql --with-openssl
make
make install
# End-Linux
```

*Before run*
1. configure DB in [confog/db.php](confog/db.php);
2. run:
```
php yii migrate
```


