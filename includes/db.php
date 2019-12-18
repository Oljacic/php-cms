<?php

$db_info = array(
    'db_host'     => 'localhost',
    'db_user'     => 'root',
    'db_password' => '',
    'db_database' => 'cms'
);

foreach ($db_info as $key => $value) {
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
