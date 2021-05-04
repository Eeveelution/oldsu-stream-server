<?php

namespace oldsu_stream_server\GameServer\Handlers;

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use oldsu_stream_server\Objects\StreamMapPack;

define("BASE_DIR_MAPDL", realpath($_ENV["STORAGE_FOLDER"] . "/osz/"));

class MapDownloadHandler
{
	/**
	 * Handles the Request
	 *
	 * @param TcpConnection $connection
	 * @param Request $request
	 */
    public static function Handle(TcpConnection $connection, Request $request) : void
	{
		$post = $request->post();

		//Gets File path
		$filepath = $_ENV["STORAGE_FOLDER"] . "/osz/" . $post["filename"];
		//Getting real path
		$realpath = realpath($filepath);
		//Checking for Directory traversal
		if (!str_starts_with($realpath, BASE_DIR_MAPDL)) {
			$connection->send("fuck off");
			return;
		}

		$mappack = StreamMapPack::GetPackByPackId($post["pack"]);
		$beatmap = $mappack->GetMapByFilename($post["filename"]);

		if($beatmap !== null){
			$file = file_get_contents($filepath);
			$connection->send($file);
		}
    }
}