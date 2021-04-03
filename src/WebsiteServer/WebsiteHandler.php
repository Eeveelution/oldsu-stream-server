<?php



namespace oldsu_stream_server\WebsiteHandler;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use Exception;

/**
 * Handles Requests to the Main Website
 * @param TcpConnection $connection
 * @param Request $request
 */
function HandleRequest($connection, $request) {
	echo "got request on ".$request->path()."\n";

    require_once __DIR__ . '/../GlobalVariables.php';

    if(strpos($request->path(), "/static") === 0){
    	$data = file_get_contents(getcwd() ."/..". $request->path());
    	$connection->send($data);
	}

    //Switch and Route path
	switch($request->path()){
		case "/":
			$html = \GlobalVariables::$twig->render('index.html');
			$connection->send($html);
			break;
		default:
			try {
				$html = \GlobalVariables::$twig->render($request->path());
				$connection->send($html);
			} catch(Exception $e){
				$connection->send("An Error has occured...");
			}
			break;
	}
}
