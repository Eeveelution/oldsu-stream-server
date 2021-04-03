<?php

namespace oldsu_stream_server\GameServer\Handlers;

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use DB;
use StreamMapPack;

class PackListHandler
{
	/**
	 * Handles the Request
	 *
	 * @param $connection TcpConnection Connection
	 * @param $request Request Request
	 */
    public static function Handle(TcpConnection $connection, Request $request) : void
	{
		$return = "";
		//Query all Beatmap Packs
		$packIds = DB::query("SELECT LocalID FROM stream_packs");
		//Go through all packIds and Write
		foreach($packIds as $id){
			//Query and Write Pack
			$pack = StreamMapPack::GetPackById($id["LocalID"]);
			//Write
			$return .= $pack->Write();
		}
		//Send
		$connection->send($return);
    }
}