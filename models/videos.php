<?php
    function save_videos($channelId, $videos) {
        global $db;
        $count = 0;
        $query = "INSERT INTO youtube_channel_videos (uid, title, description, thumbnail, channel_id ) VALUES (?,?,?,?,?)";
        $statement = $db->prepare($query);
        foreach($videos as $video) {
            $statement->execute([$video->id->videoId, $video->snippet->title, $video->snippet->description, $video->snippet->thumbnails->high->url, $channelId]);
        }
        $statement->closeCursor();
        return $count;
    }

    function get_videos($id) {
        global $db;
        $results = new stdClass;
        $query = "call getChannelVideos(:id)";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        if($statement->execute()) {
            $results->videos = $statement->fetchAll();
            $results->count =  $statement->rowCount();
        }
        $statement->closeCursor();
        return $results;
    }

