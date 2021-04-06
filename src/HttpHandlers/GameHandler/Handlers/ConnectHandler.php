<?php

namespace oldsu_stream_server\GameServer\Handlers;

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;

class ConnectHandler {
	/**
	 * Handles the Request
	 *
	 * @param TcpConnection $connection
	 * @param Request       $request
	 */
	public static function Handle(TcpConnection $connection, Request $request) : void
	{
		$connection->send("<a href='finished://hi/penis/123'>click here</a>");
	}
}