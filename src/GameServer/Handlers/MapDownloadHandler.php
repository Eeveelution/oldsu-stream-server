<?php

namespace oldsu_stream_server\GameServer\Handlers;

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use MapPack;

class MapDownloadHandler
{
	/**
	 * Handles the Request
	 *
	 * @param $connection TcpConnection
	 * @param $request Request
	 */
    public static function Handle($connection, $request) : void
	{
		include_once __DIR__."/../Objects/MapPack.php";
		include_once __DIR__."/../Objects/Beatmap.php";

		$post = $request->post();

		$mappack = MapPack::GetPackByPackId($post["pack"]);
		$beatmap = $mappack->GetMapByFilename($post["filename"]);

		if($beatmap !== null){
			$file = file_get_contents($_ENV["STORAGE_FOLDER"] . "/" . $post["filename"]);
			$connection->send($file);
		}
    }
}