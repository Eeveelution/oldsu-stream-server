<?php

class StreamUser {
	public int $userId;
	public string $username;
	public int $rankedScore;
	public float $accuracy;
	public int $playcount;
	public int $rank;

	public int $countSSH;
	public int $countSS;
	public int $countSH;
	public int $countS;
	public int $countA;
	public int $countB;
	public int $countC;
	public int $countD;

	public int $acc300;
	public int $acc100;
	public int $acc50;
	public int $accMiss;

	public static function FromDatabase(int $userId) : StreamUser {
		$user = new self();
		
		$database_result = DB::queryOneRow("SELECT * FROM (SELECT *, ROW_NUMBER() OVER (ORDER BY RankedScore DESC) AS 'Rank' FROM users) t WHERE UserID=%i", $userId);

		$user->username = $database_result["Username"];
		$user->userId = $database_result["UserID"];
		$user->rankedScore = $database_result["RankedScore"];
		$user->accuracy = $database_result["Accuracy"];
		$user->playcount = $database_result["Playcount"];
		$user->countSSH = $database_result["CountSSH"];
		$user->countSS = $database_result["CountSS"];
		$user->countSH = $database_result["CountSH"];
		$user->countS = $database_result["CountS"];
		$user->countA = $database_result["CountA"];
		$user->countB = $database_result["CountB"];
		$user->countC = $database_result["CountC"];
		$user->countD = $database_result["CountD"];
		$user->acc300 = $database_result["Acc300"];
		$user->acc100 = $database_result["Acc100"];
		$user->acc50 = $database_result["Acc50"];
		$user->accMiss = $database_result["AccMiss"];
		$user->rank = $database_result["Rank"];
	}
}