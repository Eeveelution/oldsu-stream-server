<?php

namespace oldsu_stream_server\GameServer;

use oldsu_stream_server\GameServer\Handlers\CrashHandler;
use oldsu_stream_server\GameServer\Handlers\LeaderboardHandler;
use oldsu_stream_server\GameServer\Handlers\MapDownloadHandler;
use oldsu_stream_server\GameServer\Handlers\PackListHandler;
use oldsu_stream_server\GameServer\Handlers\PreviewHandler;
use oldsu_stream_server\GameServer\Handlers\ScoreSubmissionHandler;

function HandleRequest($connection, $request){
    //Include Handlers
    include "Handle/PackListHandler.php";
    include "Handle/LeaderboardHandler.php";
    include "Handle/PreviewHandler.php";
    include "Handle/CrashHandler.php";
    include "Handle/MapDownloadHandler.php";
    include "Handle/NewsHandler.php";
    include "Handle/ScoreSubmissionHandler.php";

    switch($request->path()){
        case "/stream/dl/list3.php":
            PackListHandler::Handle($request, $connection);
            break;
        case "/stream/dl/download2.php":
            MapDownloadHandler::Handle($request, $connection);
            break;
        case "/stream/score/retrieve.php":
            LeaderboardHandler::Handle($request, $connection);
            break;
        case "/stream/admin/crash.php":
            CrashHandler::Handle($request, $connection);
            break;
        case "/stream/dl/preview.php":
            PreviewHandler::Handle($request, $connection);
            break;
        case "/stream/score/submit.php":
            ScoreSubmissionHandler::Handle($request, $connection);
            break;
    }
}
