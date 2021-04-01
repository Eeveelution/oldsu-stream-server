<?php

namespace oldsu_stream_server\GameServer;

function HandleRequest($connection, $request){
    $connection->send("game handler");
}
