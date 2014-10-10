#!/bin/bash

DIR='/var/www/api'

chmod u+x ${DIR}/configure_prod_deployment.sh

mkdir -p ${DIR}/app/tmp/cache/models
mkdir -p ${DIR}/app/tmp/cache/persistent
mkdir -p ${DIR}/app/tmp/cache/views

mkdir -p ${DIR}/app/tmp/log
mkdir -p ${DIR}/app/tmp/sessions
mkdir -p ${DIR}/app/tmp/tests

chown -R vericheck:www-data ${DIR}
chmod -R g+w ${DIR}/app/tmp/
