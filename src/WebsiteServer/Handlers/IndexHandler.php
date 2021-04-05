<?php

namespace oldsu_stream_server\WebsiteHandler\Handlers;

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use Workerman\Protocols\Http\Response;
use GlobalVariables;
use Exception;

class IndexHandler {
	/**
	 * @param TcpConnection $connection
	 * @param Request       $request
	 */
	public static function Handle(TcpConnection $connection, Request $request) : void {
		try {
			//Just Render
			$html = GlobalVariables::$twig->render('index.twig');
			$response = new Response(200, [], $html);

			$connection->send($response);
		}catch(Exception $e){
			echo $e;
		}
	}
}