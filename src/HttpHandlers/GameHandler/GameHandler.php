<?php

namespace oldsu_stream_server\GameServer;

use oldsu_stream_server\GameServer\Handlers\CrashHandler;
use oldsu_stream_server\GameServer\Handlers\LeaderboardHandler;
use oldsu_stream_server\GameServer\Handlers\MapDownloadHandler;
use oldsu_stream_server\GameServer\Handlers\PackListHandler;
use oldsu_stream_server\GameServer\Handlers\PreviewHandler;
use oldsu_stream_server\GameServer\Handlers\ScoreSubmissionHandler;

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;


class GameHandler {
	/**
	 * Handles Requests to the Game Server
	 *
	 * @param TcpConnection $connection
	 * @param Request       $request
	 */
	public static function HandleRequest(TcpConnection $connection, Request $request) : void {
		echo "got request on " . $request->path() . "\n";

		//Switch Path and route request
		switch ($request->path()) {
			case "/stream/dl/list3.php":
				PackListHandler::Handle($connection, $request);
				break;
			case "/stream/dl/download2.php":
				MapDownloadHandler::Handle($connection, $request);
				break;
			case "/stream/score/retrieve.php":
				LeaderboardHandler::Handle($connection, $request);
				break;
			case "/stream/admin/crash.php":
				CrashHandler::Handle($connection, $request);
				break;
			case "/stream/dl/preview.php":
				PreviewHandler::Handle($connection, $request);
				break;
			case "/stream/score/submit.php":
				ScoreSubmissionHandler::Handle($connection, $request);
				break;
		}
	}
}
