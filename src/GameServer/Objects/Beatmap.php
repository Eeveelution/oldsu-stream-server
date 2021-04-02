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
    public function __construct($filename, $metadata, $revision)
    {
        $this->filename = $filename;
        $this->metadata = $metadata;
        $this->revision = $revision;
    }
    //Writes it to a String
    public function Write() : string
    {
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
		$database_results = DB::query("SELECT * FROM stream_beatmaps WHERE LocalID=%i", $id);

		
    }
}