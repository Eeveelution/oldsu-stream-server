<?php


namespace oldsu_stream_server\CdnHandler;


use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use Workerman\Protocols\Http\Response;
class Thumbnails {
	/**
	 * Handles Requests to the Game Server
	 *
	 * @param TcpConnection $connection
	 * @param Request       $request
	 */
	public static function HandleRequest(TcpConnection $connection, Request $request) : void {
		$thumbnail_id = str_replace("/cdn/thumbnails/", "", $request->path());
		$filepath = $_ENV["STORAGE_FOLDER"] . "/thumbnails/" . $thumbnail_id . ".jpg";
		$pathinfo = pathinfo($filepath);
		$file_content = file_get_contents($filepath);
		$mime_type = \GlobalVariables::$mimes->getMimeType($pathinfo["extension"]);

		$response = new Response(200, ["Content-Type" => $mime_type], $file_content);

		$connection->send($response);
	}
}