#!/bin/sh
#
# File: collection-syslog-ng-pipe.sh
#

if [ -e /tmp/mysql.syslog-ng.pipe ]; then
        while [ -e /tmp/mysql.syslog-ng.pipe ]
                do
                        mysql -root --password='S0UR(Eopia syslog' < /tmp/mysql.syslog-ng.pipe
        done
else
        mkfifo /tmp/mysql.syslog-ng.pipe
fi