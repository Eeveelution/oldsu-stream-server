<?php

namespace oldsu_stream_server\GameServer\Handlers;

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;

class NewsHandler
{
	/**
	 * Handles the Request
	 *
	 * @param $connection TcpConnection
	 * @param $request Request
	 */
    public static function Handle($connection, $request) : void
	{
        //Return Server Date
        $connection->send(date("Y-m-d"));
    }
}