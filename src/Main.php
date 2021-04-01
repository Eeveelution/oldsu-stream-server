<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/MainServer.php';
//Create and Start MainServer
$server = new oldsu_stream_server\MainServer("http://127.0.0.1:80");
$server->start();