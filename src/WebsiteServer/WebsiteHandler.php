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
    require_once __DIR__ . '/../GlobalVariables.php';
    //Switch and Route path
	switch($request->path()){
		case "":
		case "/":
            try {
                $html = \GlobalVariables::$twig->render('index.html', ["hello" => "Hi!!!"]);
                $connection->send($html);
            } catch (Exception $e) {
                $connection->send("An Error occured.");
            }
			break;
		default:
			try {
			    $html = \GlobalVariables::$twig->render($request->path());
				$connection->send($html);
				break;
			} catch(Exception $exception){
				$connection->send("An Error occured.");
			}
	}
}
