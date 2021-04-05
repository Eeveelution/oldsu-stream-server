<?php

namespace oldsu_stream_server\WebsiteHandler\Handlers;

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use Exception;

use GlobalVariables;
use Workerman\Protocols\Http\Response;

class MapsetHandler {
	public static function Handle(TcpConnection $connection, Request $request){
		try {
			$html = GlobalVariables::$twig->render('mapset.twig', []);
			$response = new Response(200, [], $html);

			$connection->send($response);
		}catch(Exception $e){
			echo $e;
		}
	}
}