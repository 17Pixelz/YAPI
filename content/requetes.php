<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Requets</title>
</head>
<body>
    <?php require_once "../api/db_connect.php" ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link" href="/Projet/index.php">Ajouter mot-cle <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="/Projet/content/videos.php">Videos</a>
            <a class="nav-item nav-link" href="/Projet/content/channels.php">Channels</a>
            <a class="nav-item nav-link" href="/Projet/content/comments.php">Comments</a>
            <a class="nav-item nav-link active" href="/Projet/content/requetes.php">Requetes</a>
            </div>
        </div>
    </nav>

    <div class="data">
        <div class="text-center" style="margin-top:250px">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#r1" style="margin:20px">Requete 1</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#r2" style="margin:20px">Requete 2</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#r3" style="margin:20px">Requete 3</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#r4" style="margin:20px">Requete 4</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#r5" style="margin:20px">Requete 5</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#r6" style="margin:20px">Requete 6</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#r7" style="margin:20px">Requete 7</button>
        </div>
        <div class="modal" id="r1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Requete 1:  </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
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
                            $sql = "SELECT v_id, v_titre,ch_id FROM videos";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    //href=\"https://www.youtube.com/watch?v=". $row['v_id'] ."\" target=\"_blank\"
                                        echo "<td><span  data-toggle=\"modal\" data-target=\"#myModal".$row['v_id']."\" ><a data-toggle=\"tooltip\" title=\"Regarder\" style=\"cursor:pointer;text-decoration:underline;color:grey\">" . $row['v_id']  . "</a></span></td>";
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
                    </div>    
                </div>
            </div>
        </div>
        <div class="modal" id="r2">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Requete 2:  </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    <table  class="table table-dark table-hover table-striped">
                    <thead>
                    <tr>
                        <th>channel id</th>
                        <th>channel name</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT ch_id, ch_name FROM chaines";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) { // foreach ($result->fetch_assoc as $row)
                                    echo "<tr>";
                                        echo "<td><a href=\"https://www.youtube.com/channel/".$row['ch_id']."\" target=\"_blank\">" . $row['ch_id']  . "</a></td>";
                                        echo "<td>" . $row['ch_name'] ."</td>";
                                    echo "</tr>";
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
                    </div>    
                </div>
            </div>
        </div>
        <div class="modal" id="r3">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Requete 3:  </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
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
                    </div>    
                </div>
            </div>
        </div>
        <div class="modal" id="r4">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Requete 4:  </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
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
                    </div>    
                </div>
            </div>
        </div>
        <div class="modal" id="r5">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Requete 5:  </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
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
                    </div>    
                </div>
            </div>
        </div>
        <div class="modal" id="r6">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Requete 6:  </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
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
                    </div>    
                </div>
            </div>
        </div>
        <div class="modal" id="r7">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Requete 7:  </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
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
                    </div>    
                </div>
            </div>
        </div>
    </div>

</body>
</html>