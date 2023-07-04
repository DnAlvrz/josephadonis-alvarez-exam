<?php
    function getApiData($url) {
        $response = file_get_contents($url);
        return json_decode($response);
    }
    function  getApiChannelID ($userName, $apiKey) {
        $url = "https://youtube.googleapis.com/youtube/v3/search?q=$userName&type=channel&maxResults=1&key=$apiKey";
        $data = getApiData($url);
        // property_exists($data->items[0]->id->channelId)
        return  isset($data) ?  $data->items[0]->id->channelId : null;
    }

    function getApiChannel($channelId, $apiKey){
        $url = "https://youtube.googleapis.com/youtube/v3/channels?part=snippet%2CcontentDetails%2Cstatistics&id=$channelId&maxResults=1&key=$apiKey";
        $data = getApiData($url);
        return   isset($data) ? $data->items[0] : null;
    }
    
    function getApiVideos ($channelId, $apiKey){
        $url = "https://www.googleapis.com/youtube/v3/search?type=video&channelId=$channelId&part=snippet,id&order=date&maxResults=50&key=$apiKey";
        $data1 = getApiData($url);
        $pageToken = $data1->nextPageToken;
        $data2 = getApiData($url .= "&pageToken=$pageToken");
        $results = null;
        if(isset($data1) && isset($data2)) {
            $results = array_merge( $data1->items, $data2->items); 
        }
        return $results;
    }