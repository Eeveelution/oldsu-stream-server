<?php

use Dotenv\Dotenv;
use Mimey\MimeTypes;
//Include Files
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/sergeytsalkov/meekrodb/db.class.php';

Dotenv::createImmutable(__DIR__."/..")->load();

function _require_all($dir, $depth=0) {
	// require all php files
	$scan = glob("$dir/*");
	foreach ($scan as $path) {
		if (preg_match('/\.php$/', $path)) {
			require_once $path;
		}
		elseif (is_dir($path)) {
			_require_all($path, $depth+1);
		}
	}
}

_require_all(__DIR__."/");
//Make Warnings throw exceptions
set_error_handler(static function($errno, $errstr, $errfile, $errline) {
	// error was suppressed with the @-operator
	if (0 === error_reporting()) {
		return false;
	}
	throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});
//Setup Database
DB::$user = $_ENV["MYSQL_USERNAME"];
DB::$password = $_ENV["MYSQL_PASSWORD"];
DB::$dbName = $_ENV["MYSQL_DATABASE"];
DB::$host = $_ENV["MYSQL_LOCATION"];

//Setup Twig & Mimes
GlobalVariables::$loader = new Twig\Loader\FilesystemLoader(__DIR__ . '/../templates/');
GlobalVariables::$twig = new Twig\Environment(GlobalVariables::$loader);
GlobalVariables::$mimes = new MimeTypes();
//Create and Start MainServer
$server = new oldsu_stream_server\MainServer($_ENV["SERVER_LOCATION"]);
$server->Start();

