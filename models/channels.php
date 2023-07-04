<?php
    function insert_channel($channel) {
        $channelId = $channel->id;
        $channelName =  $channel->snippet->title;
        $description =  $channel->snippet->description;
        $thumbnail = $channel->snippet->thumbnails->high->url;
        global $db;
        $count = 0;
        $query = "call saveChannel(:id, :name, :description, :thumbnail)";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $channelId);
        $statement->bindValue(':name', $channelName);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':thumbnail', $thumbnail);
        if($statement->execute()) {
            $count = $statement->rowCount();
        }
        $statement->closeCursor();
        return $count;
    }


    function search_channel ($queryString) {
        $queryString = "%". $queryString ."%";
        global $db;
        $query = "SELECT id, name, uid FROM youtube_channels WHERE name LIKE :query;";
        $statement = $db->prepare($query);
        $statement->bindValue(':query',$queryString);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;
    }

    function get_channel_data ($id) {
        global $db;
        $query = "SELECT id, name, uid, thumbnail, description FROM youtube_channels WHERE id = :id;";
        $statement = $db->prepare($query);
        $statement->bindValue(':id',$id);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;
    }