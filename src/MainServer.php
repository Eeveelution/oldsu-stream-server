<?php

namespace oldsu_stream_server {

    use Workerman\Worker;

    use oldsu_stream_server\GameServer;
    use oldsu_stream_server\WebsiteHandler;
	use Workerman\Connection\TcpConnection;
	use Workerman\Protocols\Http\Request;
	use oldsu_stream_server\CdnHandler\CdnServer;

	class MainServer
    {
        //HTTP Worker, Accepts all requests
		private Worker $http_worker;
		/**
		 * Constructor, Takes in a Location on where to run the MainServer
		 *
		 * @param string $location Where to run the Server
		 */
		public function __construct(string $location)
        {
            //Create worker and assign max Thread count to 4
            $this->http_worker = new Worker($location);
            $this->http_worker->count = 4;
            //Define onMessage function
            $this->http_worker->onMessage = function ($connection, $request) {
                $this->onMessage($connection, $request);
            };
        }

		/**
		 * Is responsible for starting the GameHandler
		 */
		public function Start() : void {
            Worker::runAll();
        }
		/**
		 * Handles incoming requests
		 *
		 * @param $connection TcpConnection
		 * @param $request Request
		 */
		private function onMessage(TcpConnection $connection, Request $request) : void
		{
            //Distinguish between Website and Game Server
            if( str_starts_with($request->path(), "/stream/dl") ||
				str_starts_with($request->path(), "/stream/score") ||
				str_starts_with($request->path(), "/stream/auth") ||
				str_starts_with($request->path(), "/stream/admin")
			){
                GameServer\GameHandler::HandleRequest($connection, $request);
            }
            else if(str_starts_with($request->path(), "/cdn")){
				CdnServer::HandleRequest($connection, $request);
			}
            else {
				WebsiteHandler\WebsiteHandler::HandleRequest($connection, $request);
            }
        }
    }
}