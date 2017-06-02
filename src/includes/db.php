<?php


$db['db_host'] = 'us-cdbr-iron-east-03.cleardb.net';
$db['db_user'] = 'bcfe1056364b46';
$db['db_pass'] = '322db624';
$db['db_name'] = 'heroku_d0f8b8720ea3c95';



// $db['db_host'] = 'localhost';
// $db['db_user'] = 'root';
// $db['db_pass'] = '';
// $db['db_name'] = 'photogallery';

foreach($db as $key => $value) {
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$connection) {
    die('Connection Failed');
}

?>
