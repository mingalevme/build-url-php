FROM php:5.4
RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y zlib1g-dev libzip-dev unzip && \
    curl --insecure "https://getcomposer.org/download/latest-2.2.x/composer.phar" > "/usr/local/bin/composer" && \
    chmod a+x "/usr/local/bin/composer" && \
    cd /opt && \
    curl --insecure -O https://xdebug.org/files/xdebug-2.4.1.tgz && \
    tar -xvf xdebug-2.4.1.tgz && \
    cd xdebug-2.4.1 && \
    phpize && \
    ./configure --enable-xdebug && \
    make && \
    make install && \
    echo "zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20100525/xdebug.so" > /usr/local/etc/php/conf.d/xdebug.ini
