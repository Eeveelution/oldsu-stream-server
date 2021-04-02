<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/sergeytsalkov/meekrodb/db.class.php';
require_once __DIR__ . '/MainServer.php';

\Dotenv\Dotenv::createImmutable(__DIR__."/..")->load();

set_error_handler(static function($errno, $errstr, $errfile, $errline) {
	// error was suppressed with the @-operator
	if (0 === error_reporting()) {
		return false;
	}

	throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

DB::$user = $_ENV["MYSQL_USERNAME"];
DB::$password = $_ENV["MYSQL_PASSWORD"];
DB::$dbName = $_ENV["MYSQL_DATABASE"];
DB::$host = $_ENV["MYSQL_LOCATION"];

//Create and Start MainServer
$server = new oldsu_stream_server\MainServer($_ENV["SERVER_LOCATION"]);
$server->start();