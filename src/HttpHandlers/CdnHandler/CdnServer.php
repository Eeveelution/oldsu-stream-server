<?php


namespace oldsu_stream_server\CdnHandler;

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;

class CdnServer {
	/**
	 * Handles Requests to the Game Server
	 *
	 * @param TcpConnection $connection
	 * @param Request       $request
	 */
	public static function HandleRequest(TcpConnection $connection, Request $request) : void {
		//Route Thumbnail Requests
		if(str_starts_with($request->path(), "/cdn/thumbnails")){
			Thumbnails::HandleRequest($connection, $request);
		}
	}
}