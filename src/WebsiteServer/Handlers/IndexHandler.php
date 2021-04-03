<?php

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use Workerman\Protocols\Http\Response;

class IndexHandler {
	/**
	 * @param TcpConnection $connection
	 * @param Request $request
	 */
	public static function Handle($connection, $request) : void {
		try {
			$html = GlobalVariables::$twig->render('index.twig', ["logged_in_user" => "Eevee"]);
			$response = new Response(200, [], $html);

			$connection->send($response);
		}catch(Exception $e){

		}
	}
}