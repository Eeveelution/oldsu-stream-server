<?php

namespace oldsu_stream_server\GameServer\Handlers\PreviewHandlers;

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;

define("BASE_DIR_PACKPREVIEW", realpath(getcwd() . '/../storage/thumbnails/'));

class PackPreviewHandler {
	/**
	 * Handles the Request
	 *
	 * @param TcpConnection $connection
	 * @param Request       $request
	 */
	public static function Handle(TcpConnection $connection, Request $request) : void
	{
		$packId = $request->get("filename");
		//Gets File path
		$filepath = getcwd() . "/../storage/thumbnails/" . $packId . ".jpg";
		//Getting real path
		$realpath = realpath($filepath);
		//Checking for Directory traversal
		if (!str_starts_with($realpath, BASE_DIR_PACKPREVIEW)) {
			$connection->send("fuck off");
			return;
		}
		//Loads in File
		$image = file_get_contents($filepath);
		//Send
		$connection->send($image);
	}
}