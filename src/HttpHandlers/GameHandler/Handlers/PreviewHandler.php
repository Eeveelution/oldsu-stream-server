<?php

namespace oldsu_stream_server\GameServer\Handlers;

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use oldsu_stream_server\GameServer\Handlers\PreviewHandlers\MusicPreviewHandler;
use oldsu_stream_server\GameServer\Handlers\PreviewHandlers\PackPreviewHandler;

class PreviewHandler
{
	/**
	 * Handles the Request
	 *
	 * @param TcpConnection $connection
	 * @param Request       $request
	 */
	public static function Handle(TcpConnection $connection, Request $request) : void
	{
		$preview_type = "";
		//Figure out which Format to use
		switch($request->get("format")){
			case "m4a":
			case "mp3":
				MusicPreviewHandler::Handle($connection, $request);
				break;
			case "jpg":
				PackPreviewHandler::Handle($connection, $request);
				break;
		}
	}
}