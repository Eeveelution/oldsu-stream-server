<?php

namespace oldsu_stream_server\WebsiteHandler\Handlers;

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use StreamUser;
use DB;
use Workerman\Protocols\Http\Response;
use Exception;

class LeaderboardsHandler {
	public static function Handle(TcpConnection $connection, Request $request) : void {
		$users = array();
		$userIdResults = DB::query("SELECT * FROM (SELECT *, ROW_NUMBER() OVER (ORDER BY RankedScore DESC) AS 'Rank' FROM stream_stats ) t");

		foreach ($userIdResults as $result){
			$user = new StreamUser();

			$user->username = $result["Username"];
			$user->userId = $result["UserID"];
			$user->rankedScore = $result["RankedScore"];
			$user->accuracy = $result["Accuracy"];
			$user->playcount = $result["Playcount"];
			$user->countSSH = $result["CountSSH"];
			$user->countSS = $result["CountSS"];
			$user->countSH = $result["CountSH"];
			$user->countS = $result["CountS"];
			$user->countA = $result["CountA"];
			$user->countB = $result["CountB"];
			$user->countC = $result["CountC"];
			$user->countD = $result["CountD"];
			$user->acc300 = $result["Acc300"];
			$user->acc100 = $result["Acc100"];
			$user->acc50 = $result["Acc50"];
			$user->accMiss = $result["AccMiss"];
			$user->rank = $result["Rank"];

			$users[] = $user;
		}
		try {
			$html = \GlobalVariables::$twig->render('leaderboards.twig', ["users" => $users]);
			$response = new Response(200, [], $html);

			$connection->send($response);
		}catch(Exception $e){
			echo $e;
		}
	}
}