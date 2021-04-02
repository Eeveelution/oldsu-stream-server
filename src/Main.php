<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/sergeytsalkov/meekrodb/db.class.php';
require_once __DIR__ . '/MainServer.php';

DB::$user = getenv("MYSQL_USERNAME");
DB::$password = getenv("MYSQL_PASSWORD");
DB::$dbName = getenv("MYSQL_DATABASE");
DB::$host = getenv("MYSQL_LOCATION");

//Create and Start MainServer
$server = new oldsu_stream_server\MainServer("http://127.0.0.1:80");
$server->start();