<?php

namespace oldsu_stream_server\WebsiteHandler;

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use Exception;
use Workerman\Protocols\Http;

class WebsiteHandler {
	/**
	 * Handles Requests to the Main Website
	 *
	 * @param TcpConnection $connection
	 * @param Request       $request
	 */
	public static function HandleRequest(TcpConnection $connection, Request $request) : void {
		echo "got request on " . $request->path() . "\n";
		//Handles Static Content
		if (strpos($request->path(), "/static") === 0) {
			try {
				//Gets File path and Path Information
				$filepath = getcwd() . "/.." . $request->path();
				$pathinfo = pathinfo($filepath);
				//Loads in File
				$html = file_get_contents($filepath);
				//Gets Mime Type
				$mimetype = \GlobalVariables::$mimes->getMimeType($pathinfo["extension"]);
				//Sets Headers
				$headers = [
					"Content-Type" => $mimetype
				];
				//Creates Response
				$response = new Http\Response(200, $headers, $html);
				//Sends Response
				$connection->send($response);
			} catch (Exception $e) {
				//Sends error in case something happens...
				$connection->send("An error occured...");
			}
			return;
		}

		//Switch and Route path
		switch ($request->path()) {
			case "/":
			case "/index.html":
			case "/index":
				\IndexHandler::Handle($connection, $request);
				break;
			case "/beatmaps":
				\BeatmapsHandler::Handle($connection, $request);
				break;
		}
	}
}
