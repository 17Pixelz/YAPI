<!doctype html>
<html>
  <head>
    <title>YouTube Search</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/style.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link active" href="/Projet/index.php">Ajouter mot-cle <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="/Projet/content/videos.php">Videos</a>
            <a class="nav-item nav-link" href="Projet/content/channels.php">Channels</a>
            <a class="nav-item nav-link" href="Projet/content/comments.php">Comments</a>
            </div>
        </div>
    </nav>
    <?php
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        // require the connection to database file
        //require './db_connect.php';
        require './functions.php';
        // initialise the devlover key
        $dev_key = 'AIzaSyABv2OXTwE_ptpYZ-x71o77XpN0SCfRgWQ';


        //////// comments
        //////// https://www.googleapis.com/youtube/v3/commentThreads?part=snippet%2Creplies&maxResults=10&moderationStatus=published&order=relevance&videoId=pwkNLGTI-Gg&key=AIzaSyABv2OXTwE_ptpYZ-x71o77XpN0SCfRgWQ



        // test the validity of data
        if (isset($_GET['q'], $_GET['ds'], $_GET['df']) && $_GET['q'] !== "" && $_GET['ds'] !== "" && $_GET['df'] !== "") {
            $q = $_GET['q'];
            $ds =$_GET['ds'] ;
            $df = $_GET['df'];

            //insert key_words to ther table
            //$sql = "INSERT INTO motscles(`mc`, `dep_d`, `fin_d`) VALUES (\"". $q ."\",\"". $ds ."\",\"". $df ."\")";
            //$conn->query($sql);
            sql_exec($conn,"INSERT INTO motscles(`mc`, `rech_d`, `dep_d`, `fin_d`) VALUES (\"". $q ."\",\"". date('Y-m-d H:m:s') ."\",\"". $ds ."\",\"". $df ."\")");

            // get the last key word id to link it with the video related to it
            $mc_id = sql_exec($conn,"SELECT * FROM motscles WHERE mc=\"".$q."\"");/* WHERE mc=".$q." AND dep_d=".$ds." AND dep_f=".$df*/
            $b = $mc_id->fetch_assoc();
            $mc_id = (int)$b['mc_id'];

            // make the date in the right format for the api
            $ds .= "T00:00:00.000Z";
            $df .= "T00:00:00.000Z";

            // trying to get the data from the youtube api
            try {
                // using Search method to get the result of a search with key word in a specific date range within 10 results as max
                $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=". $q ."&key=".$dev_key."&publishedAfter=".$ds."&publishedBefore=".$df."&maxResults=". 3;
                $searchVideos = getDataForomJson($url);
                //echo  "https://www.googleapis.com/youtube/v3/search?part=snippet&q=". $q ."&key=".$dev_key."&publishedAfter=".$ds."&publishedBefore=".$df."&maxResults=". 10;

                // separate the data recieved and insert it into the right tables
                foreach ($searchVideos->items as $searchResult) {
                    if ($searchResult->id->kind == 'youtube#video'){
                        // Getting the channel informations and insert them into ther table
                        $searchChannel = getDataForomJson("https://www.googleapis.com/youtube/v3/channels?part=snippet%2C%20statistics&id=". $searchResult->snippet->channelId ."&key=". $dev_key);
                        sql_exec($conn,"INSERT IGNORE INTO chaines(`ch_id`, `ch_name`, `ch_desc`, `cre_date`, `ch_vues`, `ch_abo`) VALUES (\"".$searchChannel->items[0]->id."\",\"".str_replace('"', '\"', $searchChannel->items[0]->snippet->title)."\",\"".str_replace('"', '\"', $searchChannel->items[0]->snippet->description)."\",\"".$searchChannel->items[0]->snippet->publishedAt."\",\"".$searchChannel->items[0]->statistics->viewCount."\",\"".$searchChannel->items[0]->statistics->subscriberCount."\")");

                        
                        // Getting the channel onformations and insert them into ther table
                        $searchVideosDetails = getDataForomJson("https://www.googleapis.com/youtube/v3/videos?part=snippet%2C%20statistics&id=". $searchResult->id->videoId."&key=".$dev_key);    
                        sql_exec($conn,"INSERT INTO videos (`v_id`, `v_titre`, `pub_date`, `n_vues`, `n_comm`, `v_desc`, `v_j`, `v_jnp`, `ch_id`)
                            VALUES (\"". $searchVideosDetails->items[0]->id ."\", \"" . str_replace('"', '\"', $searchVideosDetails->items[0]->snippet->title). "\", \"" . $searchVideosDetails->items[0]->snippet->publishedAt. "\", \"" . $searchVideosDetails->items[0]->statistics->viewCount. "\", \"" . $searchVideosDetails->items[0]->statistics->commentCount. "\", \"" .str_replace('"', '\"', $searchVideosDetails->items[0]->snippet->description). "\", \"" . $searchVideosDetails->items[0]->statistics->likeCount. "\", \"" . $searchVideosDetails->items[0]->statistics->dislikeCount . "\",\"".$searchChannel->items[0]->id."\")");
                        
                        // 
                        sql_exec($conn,"INSERT INTO contiennent VALUES (\"". $mc_id ."\",\"". $searchVideosDetails->items[0]->id ."\")");
                    
                        $searchComments = getDataForomJson("https://www.googleapis.com/youtube/v3/commentThreads?part=snippet%2Creplies&maxResults=10&moderationStatus=published&order=relevance&videoId=". $searchVideosDetails->items[0]->id ."&key=AIzaSyABv2OXTwE_ptpYZ-x71o77XpN0SCfRgWQ");    
                        foreach ($searchComments->items as $comment)
                        {
                            $searchChannel = getDataForomJson("https://www.googleapis.com/youtube/v3/channels?part=snippet%2C%20statistics&id=". $comment->snippet->topLevelComment->snippet->authorChannelId->value ."&key=". $dev_key);
                            sql_exec($conn,"INSERT IGNORE INTO chaines(`ch_id`, `ch_name`, `ch_desc`, `cre_date`, `ch_vues`, `ch_abo`) VALUES (\"".$searchChannel->items[0]->id."\",\"".str_replace('"', '\"', $searchChannel->items[0]->snippet->title)."\",\"".str_replace('"', '\"', $searchChannel->items[0]->snippet->description)."\",\"".$searchChannel->items[0]->snippet->publishedAt."\",\"".$searchChannel->items[0]->statistics->viewCount."\",\"".$searchChannel->items[0]->statistics->subscriberCount."\")");

                            sql_exec($conn,"INSERT INTO `commentaires`(`com_id`, `com`, `date_com`, `com_nbr`, `com_j`, `v_id`, `ch_id`) VALUES(\"".$comment->id."\",\"".str_replace('"','\"',$comment->snippet->topLevelComment->snippet->textOriginal)."\",\"".$comment->snippet->topLevelComment->snippet->publishedAt."\",\"".$comment->snippet->totalReplyCount."\",\"".$comment->snippet->topLevelComment->snippet->likeCount."\",\"".$searchVideosDetails->items[0]->id."\",\"".$searchChannel->items[0]->id."\")");
                            for($i=0;$i<3 && $i<(int)$comment->snippet->totalReplyCount;$i++)
                            {
                                $searchChannel = getDataForomJson("https://www.googleapis.com/youtube/v3/channels?part=snippet%2C%20statistics&id=". $comment->replies->comments[$i]->snippet->authorChannelId->value ."&key=". $dev_key);
                                sql_exec($conn,"INSERT IGNORE INTO chaines(`ch_id`, `ch_name`, `ch_desc`, `cre_date`, `ch_vues`, `ch_abo`) VALUES (\"".$searchChannel->items[0]->id."\",\"".str_replace('"', '\"', $searchChannel->items[0]->snippet->title)."\",\"".str_replace('"', '\"', $searchChannel->items[0]->snippet->description)."\",\"".$searchChannel->items[0]->snippet->publishedAt."\",\"".$searchChannel->items[0]->statistics->viewCount."\",\"".$searchChannel->items[0]->statistics->subscriberCount."\")");

                                sql_exec($conn,"INSERT INTO `commentaires`(`com_id`, `com`, `date_com`, `com_nbr`, `com_j`,`com_parent`, `v_id`, `ch_id`) VALUES(\"".$comment->replies->comments[$i]->id."\",\"".str_replace('"','\"',$comment->replies->comments[$i]->snippet->textOriginal)."\",\"".$comment->replies->comments[$i]->snippet->publishedAt."\",\"". 0 ."\",\"".$comment->replies->comments[$i]->snippet->likeCount."\",\"".$comment->id."\",\"".$searchVideosDetails->items[0]->id."\",\"".$searchChannel->items[0]->id."\")");
                            }
                        }
                    }
                }
                $conn->close();
            }catch (Exception $e) {
                echo "Error: " . $e;
            }
        echo "<div class=\"container\">";
        echo "<h1 style=\"text-align:center\">Les donnes sont bien ajouter vous pouver les naviger depuis la barre en haut</h1>";
        echo "</div>";
    } 
    else{
        echo "<div class=\"container\">";
        echo "<h1 style=\"text-align:center\">Vous n'avez pas bien remplir les champs ressayer par clicker sur Ajouter un mot cle</h1>";
        echo "</div>";
    }
    ?>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>