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
		if(strpos($request->path(), "/cdn/thumbnails") === 0){
			Thumbnails::HandleRequest($connection, $request);
		}
	}
}