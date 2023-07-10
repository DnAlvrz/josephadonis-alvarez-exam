<?php
    include('sync_youtube_channel.php');
    //Insert API key here
    $apiKey = "";
    $channelName = filter_input(INPUT_GET, "channelName", FILTER_SANITIZE_STRING);
    $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);

    if(isset($action) && isset($channelName)) {
        switch($action) {
            case "save": 
                $channelID = saveChannelAndVideos($channelName, $apiKey);
                $channelInfo = get_channel_data($channelID);
                $data = array(
                    'message' => "channel saved",
                    'channelId' =>  $channelInfo[0]['id']
                );
                ob_clean();
                http_response_code(201);
                header('Content-type: application/json');
                echo json_encode( $data );
                break;
            case "get": 
                $results = search_channel($channelName);
                $id = $results[0]['id'];
                $uid =$results[0]['uid'];
                $channelInfo = get_channel_data($id);
                $videos = get_videos($id);
                $data = array(
                    'channel' => $channelInfo,
                    'videos' => $videos
                );
                ob_clean();
                http_response_code(200);
                header('Content-type: application/json');
                echo json_encode( $data );
                break;
        }
    }

    
   
    