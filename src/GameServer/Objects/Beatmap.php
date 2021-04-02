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
    //Writes it to a String
    public function Write() : string {
        return $this->filename . "\t" .
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
		$database_results = DB::queryOneRow("SELECT * FROM stream_beatmaps WHERE LocalID=%i", $id);

		$filename = $database_results["Filename"];
		$revision = $database_results["Revision"];
		$metadata = $database_results["Metadata"];

		return new Beatmap($filename, $metadata, $revision);
    }

	/**
	 * @param string $filename .osz2 Filename to Query by
	 *
	 * @return Beatmap[] Beatmap Array
	 */
	public static function FromDatabaseByFilename($filename) : array {
    	$database_results = DB::query("SELECT * FROM stream_beatmaps WHERE Filename=%s", $filename);

    	$beatmaps = array();

    	foreach ($database_results as $database_result){
			$filename = $database_result["Filename"];
			$revision = $database_result["Revision"];
			$metadata = $database_result["Metadata"];

			$beatmaps[] = new Beatmap($filename, $metadata, $revision);
		}

    	return $beatmaps;
	}

	/**
	 * @param string $filename Filename to Query by
	 * @param int $difficulty Difficulty of Map
	 *
	 * @return Beatmap
	 */
	public static function FromDatabaseByFilenameDifficulty($filename, $difficulty) : Beatmap {
		$database_result  = DB::queryOneRow("SELECT * FROM stream_beatmaps WHERE Filename=%s AND Difficulty=%i", $filename, $difficulty);

		$filename = $database_result["Filename"];
		$revision = $database_result["Revision"];
		$metadata = $database_result["Metadata"];

		$beatmaps[] = new Beatmap($filename, $metadata, $revision);

		return $beatmaps;
	}
}