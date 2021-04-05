<?php


namespace oldsu_stream_server\Helpers;

class StringParseHelpers {
	public static function GetCreatorFromFilename(string $filename) : string {
		//Crazy ass Parsing of Strings dont Judge
		$split = explode(" ", $filename);
		$search_string = $split[count($split) - 1];
		$search_string = str_replace(".osz2", "", $search_string);

		return trim(trim($search_string, "("),")");
	}
}