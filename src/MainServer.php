<?php



namespace oldsu_stream_server {

    use Workerman\Worker;

    use oldsu_stream_server\GameServer;
    use oldsu_stream_server\WebsiteHandler;

    class MainServer
    {
        //HTTP Worker, Accepts all requests
        private $http_worker;
        //Constructor, Takes in a Location on where to run the MainServer
        public function __construct($location)
        {
            //Include Necessary Files
            require "GameServer/GameHandler.php";
            require "WebsiteServer/WebsiteHandler.php";
            //Create worker and assign max Thread count to 4
            $this->http_worker = new Worker($location);
            $this->http_worker->count = 4;
            //Define onMessage function
            $this->http_worker->onMessage = function ($connection, $request) {
                $this->onMessage($connection, $request);
            };
        }
        //Is responsible for starting the GameServer
        public function start() {
            Worker::runAll();
        }
        //Handles incoming requests
        private function onMessage($connection, $request){
            //Distinguish between Website and Game Server
            if(strpos($request->path(), "/stream") === 0){
                GameServer\HandleRequest($connection, $request);
            } else {
                WebsiteHandler\HandleRequest($connection, $request);
            }
        }
    }
}