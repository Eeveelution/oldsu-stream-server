<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/server/Server.php';
//Create and Start Server
$server = new oldsu_stream_server\Server("http://127.0.0.1:80");
$server->start();