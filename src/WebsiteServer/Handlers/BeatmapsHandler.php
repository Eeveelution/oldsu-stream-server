<?php

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use Workerman\Protocols\Http\Response;

class BeatmapsHandler {
	public static function Handle(TcpConnection $connection, Request $request){
		$maps = array();

		//Query all Beatmap Packs
		$packIds = DB::query("SELECT LocalID FROM stream_packs");
		//Go through all packIds and Write
		foreach($packIds as $id){
			//Query and append Map
			$maps[] = StreamMapPack::GetPackById($id["LocalID"]);
			$maps[] = StreamMapPack::GetPackById($id["LocalID"]);
		}
		try {
			$html = GlobalVariables::$twig->render('beatmaps.twig', ["packs" => $maps]);
			$response = new Response(200, [], $html);

			$connection->send($response);
		}catch(Exception $e){
			echo $e;
		}
	}
}