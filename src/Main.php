<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/sergeytsalkov/meekrodb/db.class.php';
require_once __DIR__ . '/MainServer.php';

set_error_handler(static function($errno, $errstr, $errfile, $errline) {
	// error was suppressed with the @-operator
	if (0 === error_reporting()) {
		return false;
	}

	throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

DB::$user = getenv("MYSQL_USERNAME");
DB::$password = getenv("MYSQL_PASSWORD");
DB::$dbName = getenv("MYSQL_DATABASE");
DB::$host = getenv("MYSQL_LOCATION");

//Create and Start MainServer
$server = new oldsu_stream_server\MainServer(getenv("SERVER_LOCATION"));
$server->start();