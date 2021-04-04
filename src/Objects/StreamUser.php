<?php

class StreamUser {
	public int $userId;
	public string $username;
	public int $rankedScore;
	public float $accuracy;

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

	public function __construct(int $userId){
		$database_result = DB::query("SELECT * FROM stream_stats WHERE UserID=%i", $userId);
	}
}