<?php
$dbname = getenv('JAE_MYSQL_DBNAME');
$host = getenv('JAE_MYSQL_IP');
$port = getenv('JAE_MYSQL_PORT');
$user = getenv('JAE_MYSQL_USERNAME');
$pwd = getenv('JAE_MYSQL_PASSWORD');
define('DB_HOST',$host.':'.$port);
define('DB_USER',$user);
define('DB_PASSWD',$pwd);
define('DB_NAME',$dbname);
define('DB_PREFIX','emlog_');
define('AUTH_KEY','emlog-key');
define('AUTH_COOKIE_NAME','emlog-cookie');
