<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/style.css">
    <title>Videos</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link" href="/Projet/index.php">Ajouter mot-cle <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link active" href="/Projet/content/videos.php">Videos</a>
            <a class="nav-item nav-link" href="/Projet/content/channels.php">Channels</a>
            <a class="nav-item nav-link" href="/Projet/content/comments.php">Comments</a>
            <a class="nav-item nav-link" href="/Projet/content/requetes.php">Requetes</a>
            </div>
        </div>
    </nav>
    <table  class="table table-dark table-hover table-striped">
    <thead>
      <tr>
        <th>video id</th>
        <th>video name</th>
        <th>channel id</th>
      </tr>
    </thead>
    <tbody>
    <?php 
        require_once '../api/db_connect.php';

        $sql = "SELECT v_id, v_titre,ch_id FROM videos";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                //href=\"https://www.youtube.com/watch?v=". $row['v_id'] ."\" target=\"_blank\"
                    echo "<td><span  data-toggle=\"modal\" data-target=\"#myModal".$row['v_id']."\" ><a data-toggle=\"tooltip\" title=\"Regarder\">" . $row['v_id']  . "</a></span></td>";
                    echo "<td>" . $row['v_titre'] ."</td>";
                    echo "<td>" . $row['ch_id']. "</td>";
                echo "</tr>";
                $html="<div class=\"modal fade\" id=\"myModal".$row['v_id']."\">
                <div class=\"modal-dialog\">
                  <div class=\"modal-content\">
                  
                    <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/".$row['v_id']."\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>
                    
                  </div>
                </div>
              </div>";
              echo $html;
                        
            }
        } else {
            echo "<tr>";
                    echo "<td>Aucun</td>";
                    echo "<td>Resultat</td>";
            echo "</tr>";
        }
    ?>
    </tbody>
    </table>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>