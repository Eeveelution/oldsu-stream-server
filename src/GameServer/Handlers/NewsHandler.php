<?php

namespace oldsu_stream_server\GameServer\Handlers;

class NewsHandler
{
    public static function Handle($connection, $request){
        //Return Server Date
        $connection->send(date("Y-m-d"));
    }
}