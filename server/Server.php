<?php

namespace oldsu_stream_server;

use Workerman\Worker;

class Server
{
    //HTTP Worker, Accepts all requests
    private $http_worker;
    //Constructor, Takes in a Location on where to run the Server
    public function __construct($location)
    {
        //Create worker and assign max Thread count to 4
        $this->http_worker = new Worker($location);
        $this->http_worker->count = 4;
        //Define onMessage function
        $this->http_worker->onMessage = function ($connection, $request) {
            $this->onMessage($connection, $request);
        };
    }
    //Is responsible for starting the server
    public function start() {
        Worker::runAll();
    }
    //Handles incoming requests
    private function onMessage($connection, $request){

    }
}