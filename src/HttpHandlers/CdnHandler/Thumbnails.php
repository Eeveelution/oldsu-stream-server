<?php


namespace oldsu_stream_server\CdnHandler;


use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use Workerman\Protocols\Http\Response;
use Exception;
class Thumbnails {
	/**
	 * Handles Requests to the Game Server
	 *
	 * @param TcpConnection $connection
	 * @param Request       $request
	 */
	public static function HandleRequest(TcpConnection $connection, Request $request) : void {
		try {
			//Get Thumbnail ID and Parse it to a Int
			$thumbnail_id = str_replace("/cdn/thumbnails/", "", $request->path());
			$thumbnail_id = (int) $thumbnail_id;
			//Verify it's not 0 and a valid integer
			if($thumbnail_id !== 0 && is_int($thumbnail_id)) {
				//Get Filepath and Information
				$filepath = $_ENV["STORAGE_FOLDER"] . "/thumbnails/" . $thumbnail_id . ".jpg";
				$pathinfo = pathinfo($filepath);
				//Get File Content and Mime Type
				$file_content = file_get_contents($filepath);
				$mime_type = \GlobalVariables::$mimes->getMimeType($pathinfo["extension"]);
				//Create Response
				$response = new Response(200, ["Content-Type" => $mime_type], $file_content);
				//Send Response
				$connection->send($response);
			}else {
				$connection->send("No!");
			}
		}catch(Exception $e){
			$connection->send("An Error occured...");
		}
	}
}