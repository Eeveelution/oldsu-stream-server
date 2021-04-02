<?php

//Beatmap Pack, for list3.php
class MapPack implements Writable
{
    /**
     * @var string Pack ID
     */
    private $packid;
    /**
     * @var string Pack Name
     */
    private $packname;
    /**
     * @var Beatmap[] Beatmap Array
     */
    private $beatmaps = array();

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
    public function AddBeatmap($beatmap){
        if(!$beatmap instanceof \Beatmap){
            trigger_error("What you are trying to add isn't a Beatmap!", E_USER_ERROR);
        }
        $this->beatmaps[] = $beatmap;
    }
    //Writes pack to a String
    public function Write()
    {
        if(count($this->beatmaps) === 0){
            trigger_error("No Beatmaps have been added to the Pack!", E_USER_ERROR);
        }
    }
}