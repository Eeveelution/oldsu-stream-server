<?php

//Beatmap, used for Map Packs
class Beatmap implements Writable
{
	private string $revision;
	private string $metadata;
	private string $filename;
	/**
     * Beatmap constructor.
     *
     * @param $filename string Map Filename (Artist - Title.osz2)
     * @param $metadata string Map Metadata (Artist - Title)
     * @param $revision string Map Revision (1.0)
     */
    public function __construct($filename, $metadata, $revision) {
        $this->filename = $filename;
        $this->metadata = $metadata;
        $this->revision = $revision;
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
	 * @return Beatmap Beatmap from Database
	 */
    public static function FromDatabaseById($id) : Beatmap {
    	//Query Map
		$database_results = DB::queryOneRow("SELECT * FROM stream_beatmaps WHERE LocalID=%i", $id);
		//Gather Results
		$filename = $database_results["Filename"];
		$revision = $database_results["Revision"];
		$metadata = $database_results["Metadata"];
		//Return new Beatmap
		return new Beatmap($filename, $metadata, $revision);
    }
	/**
	 * @param int $id Beatmap Set ID
	 *
	 * @return Beatmap[] Beatmap Array
	 */
	public static function FromDatabaseBySetId($id) : Beatmap {
		//Query Map
		$database_results = DB::queryOneRow("SELECT * FROM stream_beatmaps WHERE LocalBeatmapsetID=%i", $id);
		//Gather Results
		$filename = $database_results["Filename"];
		$revision = $database_results["Revision"];
		$metadata = $database_results["Metadata"];
		//Return new Beatmap
		return new Beatmap($filename, $metadata, $revision);
	}

	/**
	 * @param string $filename .osz2 Filename to Query by
	 *
	 * @return Beatmap[] Beatmap Array
	 */
	public static function FromDatabaseByFilename($filename) : array {
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
			$beatmaps[] = new Beatmap($filename, $metadata, $revision);
		}
		//Return Beatmaps
    	return $beatmaps;
	}

	/**
	 * @param string $filename Filename to Query by
	 * @param int $difficulty Difficulty of Map
	 *
	 * @return Beatmap
	 */
	public static function FromDatabaseByFilenameDifficulty($filename, $difficulty) : Beatmap {
		//Query Map
		$database_result  = DB::queryOneRow("SELECT * FROM stream_beatmaps WHERE Filename=%s AND Difficulty=%i", $filename, $difficulty);
		//Gather Results
		$filename = $database_result["Filename"];
		$revision = $database_result["Revision"];
		$metadata = $database_result["Metadata"];
		//Return new Beatmap
		return new Beatmap($filename, $metadata, $revision);
	}
}