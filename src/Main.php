<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/sergeytsalkov/meekrodb/db.class.php';
require_once __DIR__ . '/MainServer.php';

DB::$user = env("MYSQL_USERNAME");
DB::$password = env("MYSQL_PASSWORD");
DB::$dbName = env("MYSQL_DATABASE");
DB::$host = env("MYSQL_LOCATION");

//Create and Start MainServer
$server = new oldsu_stream_server\MainServer("http://127.0.0.1:80");
$server->start();