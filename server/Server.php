<?php

namespace oldsu_stream_server;

use Workerman\Worker;

class Server
{
    private $http_worker;

    public function __construct($location)
    {
        $this->http_worker = new Worker($location);
        $this->http_worker->count = 4;
        $this->http_worker->onMessage = function ($connection, $request) {
            $this->onMessage($connection, $request);
        };
    }

    public function start() {
        Worker::runAll();
    }

    private function onMessage($connection, $request){
        echo "got smth on ".$request->path();
    }
}