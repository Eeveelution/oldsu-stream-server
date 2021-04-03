<?php

//Beatmap, used for Map Packs
use oldsu_stream_server\Helpers\StringParseHelpers;
class StreamBeatmap implements Writable
{
	public string $revision;
	public string $metadata;
	public string $filename;
	public string $creator;
	/**
     * Beatmap constructor.
     *
     * @param $filename string Map Filename (Artist - Title.osz2)
     * @param $metadata string Map Metadata (Artist - Title)
     * @param $revision string Map Revision (1.0)
     */
    public function __construct(string $filename, string $metadata, string $revision) {
        $this->filename = $filename;
        $this->metadata = $metadata;
        $this->revision = $revision;
        $this->creator  = StringParseHelpers::GetCreatorFromFilename($this->filename);
    }
	/**
	 * Writes Beatmap to a String
	 *
	 * @return string Written String
	 */
    public function Write() : string {
        return $this->filename . "\t" .
               $this->metadata . "\t" .
			   $this->metadata . "\t" .
		       $this->revision . "\n";
    }
	/**
	 * Gets a Beatmap from the Database given a ID
	 *
	 * @param $id int Beatmap ID
	 *
	 * @return StreamBeatmap Beatmap from Database
	 */
    public static function FromDatabaseById(int $id) : StreamBeatmap {
    	//Query Map
		$database_results = DB::queryOneRow("SELECT * FROM stream_beatmaps WHERE LocalID=%i", $id);
		//Gather Results
		$filename = $database_results["Filename"];
		$revision = $database_results["Revision"];
		$metadata = $database_results["Metadata"];
		//Return new Beatmap
		return new StreamBeatmap($filename, $metadata, $revision);
    }
	/**
	 * @param int $id Beatmap Set ID
	 *
	 * @return StreamBeatmap Beatmap
	 */
	public static function FromDatabaseBySetId(int $id) : StreamBeatmap {
		//Query Map
		$database_results = DB::queryOneRow("SELECT * FROM stream_beatmaps WHERE LocalBeatmapsetID=%i", $id);
		//Gather Results
		$filename = $database_results["Filename"];
		$revision = $database_results["Revision"];
		$metadata = $database_results["Metadata"];
		//Return new Beatmap
		return new StreamBeatmap($filename, $metadata, $revision);
	}

	/**
	 * @param string $filename .osz2 Filename to Query by
	 *
	 * @return StreamBeatmap[] Beatmap Array
	 */
	public static function FromDatabaseByFilename(string $filename) : array {
		//Query Maps
    	$database_results = DB::query("SELECT * FROM stream_beatmaps WHERE Filename=%s", $filename);
		//Beatmap Array
    	$beatmaps = array();
		//Gather Results
    	foreach ($database_results as $database_result){
    		//Set Variables for clarity
			$filename = $database_result["Filename"];
			$revision = $database_result["Revision"];
			$metadata = $database_result["Metadata"];
			//Append new Beatmap to list
			$beatmaps[] = new StreamBeatmap($filename, $metadata, $revision);
		}
		//Return Beatmaps
    	return $beatmaps;
	}

	/**
	 * @param string $filename Filename to Query by
	 * @param int    $difficulty Difficulty of Map
	 *
	 * @return StreamBeatmap
	 */
	public static function FromDatabaseByFilenameDifficulty(string $filename, int $difficulty) : StreamBeatmap {
		//Query Map
		$database_result  = DB::queryOneRow("SELECT * FROM stream_beatmaps WHERE Filename=%s AND Difficulty=%i", $filename, $difficulty);
		//Gather Results
		$filename = $database_result["Filename"];
		$revision = $database_result["Revision"];
		$metadata = $database_result["Metadata"];
		//Return new Beatmap
		return new StreamBeatmap($filename, $metadata, $revision);
	}
}