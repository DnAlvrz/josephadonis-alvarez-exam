<?php
    include('./db/conn.php');
    include('./models/videos.php');
    include('./models/channels.php');
    include('./api.php');

    function saveVideos($channel, $newChannelid, $apiKey) {
        $videos = getApiVideos($channel, $apiKey);
        save_videos($newChannelid, $videos);
    }

    function saveNewChannel($channelName, $apiKey) {
        $escapedUsername = str_replace(' ', '%20',$channelName);
        // get channel id from api
        $channelId = getApiChannelID($escapedUsername, $apiKey);
        // get channel info from api
        $channel = getApiChannel($channelId, $apiKey);
        // check if channel exists and is not empty
        if($channel && !empty($channel)) {
            // insert channel to db
            insert_channel($channel);
            return $channel;
        }
        return null;
    }

    function saveChannelAndVideos( $channelName,$apiKey) {
        $results = search_channel($channelName);
        // check if channel already exists
        if(!empty($results)) {
            $id = $results[0]['id'];
            $uid =$results[0]['uid'];
            // check if channel already has videos
            $videos = get_videos($id);
            if( $videos->count > 0) {
                return $id;
            }
            // save videos if videos do not exist
            saveVideos($uid, $id, $apiKey);
            return $id;
        } 
        $newChannel = saveNewChannel($channelName, $apiKey);
        // get channel data from db
        $channelMatch = search_channel($channelName);
        // check if channel exists in db
        if($channelMatch && $newChannel) {
            // save videos
            saveVideos($newChannel->id, $channelMatch[0]['id'], $apiKey);
            return $newChannel->id; 
        }
        return null;
    }





   
    
