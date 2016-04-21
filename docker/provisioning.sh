#!/bin/sh

set -e
set -x

cd /code/wp-content/themes/nuitdeboo-child
npm install
bower --allow-root install 
gulp
