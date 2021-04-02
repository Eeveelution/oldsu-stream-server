<?php

//Beatmap Pack, for list3.php
class MapPack implements Writable
{
    /**
     * @var string Pack ID
     */
	private string $packid;
    /**
     * @var string Pack Name
     */
	private string $packname;
    /**
     * @var Beatmap[] Beatmap Array
     */
	private array $beatmaps = array();
    /**
     * MapPack constructor.
     * @param $packid string Pack ID
     * @param $packname string Pack Name (shows up in osu!stream)
     */
    public function __construct($packid, $packname)
    {
        $this->packid = $packid;
        $this->packname = $packname;
    }
    /**
     * @param $beatmap Beatmap Beatmap which is supposed to be added to this pack
     */
    public function AddBeatmap($beatmap) : void {
    	//Type Check
        if(!$beatmap instanceof \Beatmap){
            trigger_error("What you are trying to add isn't a Beatmap!", E_USER_ERROR);
        }
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

    public static function GetPackById($id) : MapPack {
		//Query Database
		$results = DB::queryOneRow("SELECT * FROM stream_packs WHERE PackID=%s", $id);
	}
}