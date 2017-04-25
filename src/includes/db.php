<?php

$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_pass'] = '';
$db['db_name'] = 'photogallery';

foreach($db as $key => $value) {
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$connection) {
    die('Connection Failed');
}

?>


<!--$db['db_host'] = 'us-cdbr-iron-east-03.cleardb.net';
$db['db_user'] = 'ba5909f71c5065';
$db['db_pass'] = '964b71d0';
$db['db_name'] = 'heroku_404e34a302806a2'; -->
