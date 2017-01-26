<?php

// If you installed via composer, just use this code to requrie autoloader on the top of your projects.
require 'vendor/autoload.php';

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

// Initialize
$database = new medoo([
'database_type' => 'mysql',
'database_name' => $db,
'server' => $server,
'username' => $username,
'password' => $password,
'charset' => 'utf8'
]);

// Enjoy
$database->insert('account', [
'user_name' => 'foo',
'email' => 'foo@bar.com',
'age' => 25,
'lang' => ['en', 'fr', 'jp', 'cn']
]);

