<?php

namespace oldsu_stream_server\GameServer\Handlers;

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use StreamMapPack;

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

		if(strpos($post["filename"], "./" !== false)){
			$connection->send("fuck off");
		}

		$mappack = StreamMapPack::GetPackByPackId($post["pack"]);
		$beatmap = $mappack->GetMapByFilename($post["filename"]);

		if($beatmap !== null){
			$file = file_get_contents($_ENV["STORAGE_FOLDER"] . "/osz/" . $post["filename"]);
			$connection->send($file);
		}
    }
}