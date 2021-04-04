<?php

//Beatmap Pack, for list3.php
class StreamMapPack implements Writable
{
    /**
     * @var string Pack ID
     */
	public string $packid;
    /**
     * @var string Pack Name
     */
	public string $packname;
    /**
     * @var StreamBeatmap[] Beatmap Array
     */
	public array $beatmaps = array();
    /**
     * MapPack constructor.
     * @param $packid string Pack ID
     * @param $packname string Pack Name (shows up in osu!stream)
     */
    public function __construct(string $packid, string $packname)
    {
        $this->packid = $packid;
        $this->packname = $packname;
    }
	/**
	 * @param $beatmap StreamBeatmap Beatmap which is supposed to be added to this pack
	 */
    public function AddBeatmap(StreamBeatmap $beatmap) : void {
        //Append
        $this->beatmaps[] = $beatmap;
    }
	/**
	 * Writes MapPack to a String
	 *
	 * @return string Written String
	 */
	public function Write() : string {
		//Check whether Pack has Beatmaps
        if(count($this->beatmaps) === 0){
            trigger_error("No Beatmaps have been added to the Pack!", E_USER_ERROR);
        }
		//Define Return string
        $return_string = "";
		//Write Pack ID and Pack name
        $return_string .= $this->packid . "\t" . $this->packname . "\n";
		//Write all maps in Pack
        foreach($this->beatmaps as $beatmap) {
        	$return_string .= $beatmap->Write();
		}
		//Return Written String
        return $return_string;
    }
	/**
	 * @param int $id Pack LocalID
	 *
	 * @return StreamMapPack
	 */
	public static function GetPackById(int $id) : StreamMapPack {
		//Query Database
		$results = DB::queryOneRow("SELECT * FROM stream_packs WHERE LocalID=%s", $id);

		$packname = $results["PackName"];
		$packId = $results["PackID"];
		$beatmaps = $results["Beatmaps"];

		$mappack = new StreamMapPack($packId, $packname);

		$split_beatmaps = explode(";", $beatmaps);

		foreach($split_beatmaps as $beatmap){
			$databaseBeatmap = StreamBeatmap::FromDatabaseBySetId($beatmap);

			$mappack->AddBeatmap($databaseBeatmap);
		}
		return $mappack;
	}
	/**
	 * @param string $id Pack PackID
	 *
	 * @return StreamMapPack
	 */
	public static function GetPackByPackId(string $id) : StreamMapPack {
		//Query Database
		$results = DB::queryOneRow("SELECT * FROM stream_packs WHERE PackID=%s", $id);

		$packname = $results["PackName"];
		$packId = $results["PackID"];
		$beatmaps = $results["Beatmaps"];

		$mappack = new StreamMapPack($packId, $packname);

		$split_beatmaps = explode(";", $beatmaps);

		foreach($split_beatmaps as $beatmap){
			$databaseBeatmap = StreamBeatmap::FromDatabaseBySetId($beatmap);

			$mappack->AddBeatmap($databaseBeatmap);
		}
		return $mappack;
	}
	/**
	 * @param string $filename Map Filename
	 *
	 * @return StreamBeatmap|null Map in pack with filename `$filename`
	 */
	public function GetMapByFilename(string $filename) : ?StreamBeatmap {
		foreach($this->beatmaps as $beatmap){
			if($beatmap->filename === $filename){
				return $beatmap;
			}
		}
		return null;
	}
}