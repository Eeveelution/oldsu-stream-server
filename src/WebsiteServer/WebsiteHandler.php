<?php

namespace oldsu_stream_server\WebsiteHandler;

function HandleRequest($connection, $request){
    $connection->send("website handler");
}
