<?php

namespace oldsu_stream_server\WebsiteHandler;

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use Exception;

/**
 * Handles Requests to the Main Website
 * @param TcpConnection $connection
 * @param Request $request
 */
function HandleRequest($connection, $request){
    //Switch and Route path
	switch($request->path()){
		case "/":
			$html = file_get_contents(getcwd()."/../public/index.html");
			$connection->send($html);
			break;
		default:
			try {
				$html = file_get_contents(getcwd() . "/../public" . $request->path());
				$connection->send($html);
				break;
			} catch(Exception $exception){
				$connection->send("An Error occured.");
			}
	}
}
