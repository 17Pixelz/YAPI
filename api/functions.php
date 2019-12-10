<?php
require 'db_connect.php';

$dk="AIzaSyC_ytd6NqK4CJg2L_M7BqLWmlqSSOwHg-8";
//$dk="AIzaSyABv2OXTwE_ptpYZ-x71o77XpN0SCfRgWQ";

function get_json($url)
{
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
$data = curl_exec($curl);
curl_close($curl);
return ($data);
}

function getDataForomJson($url)
{
    $url = str_replace(" ", "%20", $url);
    $a = get_json($url);
    return (json_decode($a));
}

function sql_exec($sql)
{
    $a = $GLOBALS['conn']->query($sql);
    if ($a == TRUE){
        return $a;
    }else{
        echo "TFOOOO :";
        return -1;
    }
}

function object_test($obj)
{
    if (property_exists($obj,'error'))
    {
        return 1;
    }
    return 0;
}

function get_data($q,$ds,$df,$mc_id)
{
// using Search method to get the result of a search with key word in a specific date range within 10 results as max
$url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=". $q ."&key=".$GLOBALS['dk']."&publishedAfter=".$ds."&publishedBefore=".$df."&maxResults=". 3;
$searchVideos = getDataForomJson($url);


// separate the data recieved and insert it into the right tables
$c = get_all($searchVideos,$mc_id);
$GLOBALS['conn']->close();
return $c;

}

function get_all($searchVideos,$mc_id)
{
    foreach ($searchVideos->items as $searchResult) {
        if ($searchResult->id->kind == 'youtube#video'){
            // Getting the channel informations and insert them into ther table
            $a = get_channel($searchResult->snippet->channelId);
            // Getting the channel informations and insert them into ther table
            $b = get_videos($mc_id,$searchResult->id->videoId);    
            //Getting the comments informations
            $c = get_comments($searchResult->id->videoId);
            if ($a + $b + $c)
            {
                return ($a + $b + $c);
            }
        }
    }
    return 0;
}

function get_channel($id)
{
    $searchChannel = getDataForomJson("https://www.googleapis.com/youtube/v3/channels?part=snippet%2C%20statistics&id=". $id ."&key=". $GLOBALS['dk']);
    if (object_test($searchChannel))
    {
        return 1;
    }
    $q = sql_exec("INSERT IGNORE INTO chaines  (`ch_id`, 
                                                `ch_name`, 
                                                `ch_desc`, 
                                                `cre_date`, 
                                                `ch_vues`, 
                                                `ch_abo`
                                                ) 
                    VALUES (\"".$id."\",
                            \"".str_replace('"', '\"', $searchChannel->items[0]->snippet->title)."\",
                            \"".str_replace('"', '\"', $searchChannel->items[0]->snippet->description)."\",
                            \"".$searchChannel->items[0]->snippet->publishedAt."\",
                            \"".$searchChannel->items[0]->statistics->viewCount."\",
                            \"".$searchChannel->items[0]->statistics->subscriberCount."\"
                            )");
    if ($q === -1)
    {
        return 1;
    }
    return 0;
}

function get_videos($mc_id,$id)
{
    $searchVideosDetails = getDataForomJson("https://www.googleapis.com/youtube/v3/videos?part=snippet%2C%20statistics&id=". $id."&key=".$GLOBALS['dk']);    
    if (object_test($searchVideosDetails))
    {
        return 1;
    }
    $q = sql_exec("INSERT IGNORE INTO videos (`v_id`, 
                                        `v_titre`, 
                                        `pub_date`, 
                                        `n_vues`, 
                                        `n_comm`, 
                                        `v_desc`, 
                                        `v_j`, 
                                        `v_jnp`, 
                                        `ch_id`
                                        )
                    VALUES (
                            \"" . $searchVideosDetails->items[0]->id ."\",
                            \"" . str_replace('"', '\"', $searchVideosDetails->items[0]->snippet->title). "\", 
                            \"" . $searchVideosDetails->items[0]->snippet->publishedAt. "\",
                            \"" . $searchVideosDetails->items[0]->statistics->viewCount. "\", 
                            \"" . $searchVideosDetails->items[0]->statistics->commentCount. "\", 
                            \"" . str_replace('"', '\"', $searchVideosDetails->items[0]->snippet->description). "\", 
                            \"" . $searchVideosDetails->items[0]->statistics->likeCount. "\", 
                            \"" . $searchVideosDetails->items[0]->statistics->dislikeCount . "\",
                            \"" . $searchVideosDetails->items[0]->snippet->channelId."\")"
                        );
    if ($q === -1)
    {
        echo $mc_id;
        return 1;
    }
            
    $q = sql_exec("INSERT INTO contiennent VALUES (\"". $mc_id ."\",\"". $searchVideosDetails->items[0]->id ."\")");
    if ($q === -1)
    {
        return 1;
    }
    return 0;
}

function get_comments($id)
{
    $searchComments = getDataForomJson("https://www.googleapis.com/youtube/v3/commentThreads?part=snippet%2Creplies&maxResults=". 3 ."&moderationStatus=published&order=relevance&videoId=". $id ."&key=".$GLOBALS['dk']);    
    if (object_test($searchComments))
    {
        return 1;
    }
    foreach ($searchComments->items as $comment)
    {
        get_channel($comment->snippet->topLevelComment->snippet->authorChannelId->value);
        $q = sql_exec("INSERT IGNORE INTO `commentaires` (`com_id`, 
                                                    `com`, 
                                                    `date_com`, 
                                                    `com_nbr`, 
                                                    `com_j`, 
                                                    `v_id`, 
                                                    `ch_id`
                                                    ) 
                        VALUES(
                            \"".$comment->id."\",
                            \"".str_replace('"','\"',$comment->snippet->topLevelComment->snippet->textOriginal)."\",
                            \"".$comment->snippet->topLevelComment->snippet->publishedAt."\",
                            \"".$comment->snippet->totalReplyCount."\",
                            \"".$comment->snippet->topLevelComment->snippet->likeCount."\",
                            \"".$id."\",
                            \"".$comment->snippet->topLevelComment->snippet->authorChannelId->value."\"
                        )");
        if ($q === -1)
        {
            return 1;
        }
        for($i=0;$i<3 && $i<(int)$comment->snippet->totalReplyCount;$i++)
        {
            get_channel($comment->replies->comments[$i]->snippet->authorChannelId->value);
            $q = sql_exec("INSERT IGNORE INTO `commentaires` (`com_id`, 
                                                        `com`, 
                                                        `date_com`, 
                                                        `com_nbr`, 
                                                        `com_j`,
                                                        `com_parent`, 
                                                        `v_id`, 
                                                        `ch_id`
                                                        ) 
                            VALUES(
                                    \"".$comment->replies->comments[$i]->id."\",
                                    \"".str_replace('"','\"',$comment->replies->comments[$i]->snippet->textOriginal)."\",
                                    \"".$comment->replies->comments[$i]->snippet->publishedAt."\",
                                    \"". 0 ."\",
                                    \"".$comment->replies->comments[$i]->snippet->likeCount."\",
                                    \"".$comment->id."\",
                                    \"".$id."\",
                                    \"".$comment->replies->comments[$i]->snippet->authorChannelId->value."\"
                            )");
            if ($q === -1)
            {
                return 1;
            }
        }
    }
    return 0;
}



?>