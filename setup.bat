start /WAIT docker-compose up -d
start /WAIT docker cp ./config/httpd.conf bankweb-ThnnathatsWeb-1:/usr/local/apache2/conf/httpd.conf
start /WAIT docker-compose restart