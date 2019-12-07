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
            <a class="nav-item nav-link active" href="/project/index.php">Ajouter mot-cle <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="/project/content/videos.php">Videos</a>
            <a class="nav-item nav-link" href="project/content/channels.php">Channels</a>
            <a class="nav-item nav-link" href="project/content/comments.php">Comments</a>
            <a class="nav-item nav-link" href="/project/content/requetes.php">Requetes</a>
            </div>
        </div>
    </nav>
    <?php
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        // require the functions file
        require './functions.php';

        // initialise the devlover key
        //$dev_key = 'AIzaSyABv2OXTwE_ptpYZ-x71o77XpN0SCfRgWQ';


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
            $sql = "INSERT INTO motscles(`mc`, `rech_d`, `dep_d`, `fin_d`) VALUES (\"". $q ."\",\"". date('Y-m-d H:m:s') ."\",\"". $ds ."\",\"". $df ."\")";
            sql_exec($sql);

            // get the last key word id to link it with the video related to it
            $mc_id = sql_exec("SELECT MAX(mc_id) i FROM motscles");/* WHERE mc=".$q." AND dep_d=".$ds." AND dep_f=".$df*/
            $b = $mc_id->fetch_assoc();
            $mc_id = (int)$b['i'];
            // make the date in the right format for the api
            $ds .= "T00:00:00.000Z";
            $df .= "T00:00:00.000Z";

            // trying to get the data from the youtube api
            $c = get_data($q,$ds,$df,$mc_id);
            if ($c == 0)
            {
                echo "<div class=\"container\">";
                echo "<h1 style=\"text-align:center\">Les donnes sont bien ajouter vous pouver les naviger depuis la barre en haut</h1>";
                echo "</div>";
            }
            else 
            {
                echo "<div class=\"container\">";
                echo "<h1 style=\"text-align:center\">Un probleme a ete rencontre lors l'execution</h1>";
                echo "</div>";
            } 
        }else{
        echo "<div class=\"container\">";
        echo "<h1 style=\"text-align:center\">Vous n'avez pas bien remplir les champs ressayer par clicker sur Ajouter un mot cle</h1>";
        echo "</div>";
    }
    ?>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>