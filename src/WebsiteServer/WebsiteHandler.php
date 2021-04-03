<?php



namespace oldsu_stream_server\WebsiteHandler;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use Exception;
use Workerman\Protocols\Http;

/**
 * Handles Requests to the Main Website
 * @param TcpConnection $connection
 * @param Request $request
 */
function HandleRequest($connection, $request) {
	echo "got request on ".$request->path()."\n";

    require_once __DIR__ . '/../GlobalVariables.php';

    if(strpos($request->path(), "/static") === 0){
    	try {
			$filepath = getcwd() . "/.." . $request->path();
			$pathinfo = pathinfo($filepath);
			$html = file_get_contents($filepath);
			$mimetype = \GlobalVariables::$mimes->getMimeType($pathinfo["extension"]);

			$headers = [
				"Content-Type" => $mimetype
			];

			$response = new Http\Response(200, $headers, $html);

			$connection->send($response);
		}catch(Exception $e){
    		$connection->send("An error occured...");
		}
    	return;
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
