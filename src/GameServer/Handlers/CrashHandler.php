<?php

namespace oldsu_stream_server\GameServer\Handlers;

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;

class CrashHandler
{
	/**
	 * Handles the Request
	 *
	 * @param TcpConnection $connection
	 * @param Request       $request
	 */
	public static function Handle(TcpConnection $connection, Request $request) : void
	{

	}
}