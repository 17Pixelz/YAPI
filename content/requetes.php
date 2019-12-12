<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Requets</title>
    <style>
        .table
        {
            margin:0;
        }
        .modal-body
        {
            padding:0;
        }
    </style>
    <script>
      function getData(c, q, divid){
                $.ajax({
                    url: 'data.php?c='+c+'&q='+q, 
                    success: function(html) {
                        var ajaxDisplay = document.getElementById(divid);
                        ajaxDisplay.innerHTML = html;
                    }
                });
            }
    </script>
</head>
<body>
    <?php require_once "../api/db_connect.php" ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link" href="/project/index.php">Ajouter mot-cle <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="/project/content/videos.php">Videos</a>
            <a class="nav-item nav-link" href="/project/content/channels.php">Channels</a>
            <a class="nav-item nav-link" href="/project/content/comments.php">Comments</a>
            <a class="nav-item nav-link active" href="/Project/content/requetes.php">Requetes</a>
            </div>
        </div>
    </nav>
    <?php
        $res=$conn->query("SELECT * FROM videos");
        if ($res->num_rows > 0)
            {
    ?>
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
                        <h4 class="modal-title">Requete 1:  Quels sont le ID et le Titre de la vidéo qui a obtenu le maximum de « Like », pour chacune des « Queries » présentes dans la base de données.</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    <?php
                            $sql = "select m.mc mc,c1.v_id id,v1.v_titre titre
                                    from motscles m,videos v1,contiennent c1  
                                    where 
                                        c1.mc_id=m.mc_id  and 
                                        v1.v_id=c1.v_id and 
                                        v_j = ( select max(v_j) 
                                                from videos v2,contiennent c2 
                                                where c2.mc_id=m.mc_id and 
                                                v2.v_id=c2.v_id 
                                               )";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {?>
                    
                    
                    <br><table  class="table table-dark table-hover table-striped">
                    <thead>
                    <tr>
                        <th>video id</th>
                        <th>video name</th>
                        <th>mot cle</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    //href=\"https://www.youtube.com/watch?v=". $row['v_id'] ."\" target=\"_blank\"
                                        echo "<td><span  data-toggle=\"modal\" data-target=\"#myModal".$row['id']."\" ><a data-toggle=\"tooltip\" title=\"Regarder\" style=\"cursor:pointer;text-decoration:underline;color:grey\">" . $row['id']  . "</a></span></td>";
                                        echo "<td>" . $row['titre'] ."</td>";
                                        echo "<td>" . $row['mc']. "</td>";
                                    echo "</tr>";
                                    $html="<div class=\"modal fade\" id=\"myModal".$row['id']."\">
                                    <div class=\"modal-dialog\">
                                      <div class=\"modal-content\">
                                      
                                        <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/".$row['id']."\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>
                                        
                                      </div>
                                    </div>
                                  </div>";
                                  echo $html;
                                            
                                }
                            
                        ?>
                        </tbody>
                        </table>
                        <?php
                            } else {
                                echo "<h1 style='text-align:center;font-size:60px'> There's no data</h1>";
                            }
                        ?>
                    </div>    
                </div>
            </div>
        </div>
        <div class="modal" id="r2">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Requete 2:  Quels sont le ID et le Titre de la vidéo qui a obtenu le maximum de « DisLike » au maximum, pour chacune des Queries présente dans la base de données.</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    <?php
                        $sql = "select m.mc mc ,c1.v_id id,v1.v_titre titre 
                                from motscles m,videos v1,contiennent c1  
                                where   c1.mc_id=m.mc_id  and 
                                        v1.v_id=c1.v_id and 
                                        v_jnp = (   select max(v_jnp) 
                                                    from videos v2,contiennent c2 
                                                    where  c2.mc_id=m.mc_id and 
                                                    v2.v_id=c2.v_id
                                                )";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                    ?>
                    <br><table  class="table table-dark table-hover table-striped">
                    <thead>
                    <tr>
                        <th>video id</th>
                        <th>video name</th>
                        <th>mot cle</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        //href=\"https://www.youtube.com/watch?v=". $row['v_id'] ."\" target=\"_blank\"
                                            echo "<td><span  data-toggle=\"modal\" data-target=\"#myModal".$row['id']."\" ><a data-toggle=\"tooltip\" title=\"Regarder\" style=\"cursor:pointer;text-decoration:underline;color:grey\">" . $row['id']  . "</a></span></td>";
                                            echo "<td>" . $row['titre'] ."</td>";
                                            echo "<td>" . $row['mc']. "</td>";
                                        echo "</tr>";
                                        $html="<div class=\"modal fade\" id=\"myModal".$row['id']."\">
                                        <div class=\"modal-dialog\">
                                          <div class=\"modal-content\">
                                          
                                            <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/".$row['id']."\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>
                                            
                                          </div>
                                        </div>
                                      </div>";
                                      echo $html;
                                                
                                    }
                        ?>
                        </tbody>
                        </table>
                        <?php
                            }else{
                                echo "<h1 style='text-align:center;font-size:60px'> There's no data</h1>";
                            }
                        ?>
                    </div>    
                </div>
            </div>
        </div>
        <div class="modal" id="r3">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Requete 3:  Parmi les vidéos présentes dans la base de données, combien de vidéos ont été publiées par année et par « Query ».</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    <?php
                        $sql = "select m.mc_id,m.mc mc,YEAR(v.pub_date) pub ,count(c.v_id) nbr 
                        from motscles m, videos v, contiennent c 
                        where   m.mc_id=c.mc_id and 
                                c.v_id=v.v_id 
                        group by m.mc_id,YEAR(m.rech_d);";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                    ?>
                    <br><table  class="table table-dark table-hover table-striped">
                    <thead>
                    <tr>
                        <th>mot cle</th>
                        <th>annee</th>
                        <th>nombre de video</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    //href=\"https://www.youtube.com/watch?v=". $row['v_id'] ."\" target=\"_blank\"
                                        echo "<td>" . $row['mc'] ."</td>";
                                        echo "<td>" . $row['pub'] ."</td>";
                                        echo "<td>" . $row['nbr']. "</td>";
                                    echo "</tr>";
                                }
                            
                        ?>
                        </tbody>
                        </table>

                        <?php
                            }else{
                                echo "<h1 style='text-align:center;font-size:60px'> There's no data</h1>";
                            }
                        ?>
                    </div>    
                </div>
            </div>
        </div>
        <div class="modal" id="r4">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Requete 4:  Pour chacune des vidéos présentes dans la base de données, quel est le nombre total des commentaires (y compris les réponses aux commentaires), et le nombre total des utilisateurs ayant rédigé ou répondu un commentaire.</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    <?php
                        $sql = "select v.v_id id,v.v_titre titre,n_comm n,count(distinct(com.ch_id)) utilisateur 
                        from videos v,commentaires com 
                        where v.v_id=com.v_id 
                        group by v_titre";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                    ?>
                    <br><table  class="table table-dark table-hover table-striped">
                    <thead>
                    <tr>
                        <th>video id</th>
                        <th>video name</th>
                        <th>nombre commentair</th>
                        <th>nombre utilisateurs commente</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    //href=\"https://www.youtube.com/watch?v=". $row['v_id'] ."\" target=\"_blank\"
                                        echo "<td><span  data-toggle=\"modal\" data-target=\"#myModal".$row['id']."\" ><a data-toggle=\"tooltip\" title=\"Regarder\" style=\"cursor:pointer;text-decoration:underline;color:grey\">" . $row['id']  . "</a></span></td>";
                                        echo "<td>" . $row['titre'] ."</td>";
                                        echo "<td>" . $row['n']. "</td>";
                                        echo "<td>" . $row['utilisateur']. "</td>";
                                    echo "</tr>";
                                    $html="<div class=\"modal fade\" id=\"myModal".$row['id']."\">
                                    <div class=\"modal-dialog\">
                                      <div class=\"modal-content\">
                                      
                                        <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/".$row['id']."\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>
                                        
                                      </div>
                                    </div>
                                  </div>";
                                  echo $html;
                                            
                                }
                        ?>
                        </tbody>
                        </table>

                        <?php
                            }else{
                                echo "<h1 style='text-align:center;font-size:60px'> There's no data</h1>";
                            }
                        ?>
                    </div>    
                </div>
            </div>
        </div>
        <div class="modal" id="r5">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Requete 5:  Pour une « Query » donnée, quels sont le ID et le Titre de la vidéo qui a été « Liké » au maximum.</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    <div class="selecto">
                        <?php
                            $select = "SELECT * FROM motscles";
                            $result = $conn->query($select);
                            if ($result->num_rows > 0){
                            $option = '<option value="">Select Query</option>';
                            while($row = $result->fetch_object()){
                                $option .= '<option value="'.$row->mc_id.'">'.$row->mc.' a '.$row->rech_d.'</option>';
                            }
                        ?>  
                        <form method="get">
                            <select name="empid" id="empid"  class="form-control" onchange="getData('r5' ,this.value, 'displaydata')">
                                <?php
                                echo $option;
                                ?> 
                            </select>
                            <div id="displaydata">
                            </div>
                        </form>
                        <?php
                            }else{
                                echo "<h1 style='text-align:center;font-size:60px'> There's no data</h1>";
                            }
                        ?>
                            </div>
                    </div>    
                </div>
            </div>
        </div>
        <div class="modal" id="r6">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Requete 6:  Quels sont le ID et le Titre de la vidéo qui a reçu le maximum de commentaires, pour chacune des « Queries » présentes dans la base de données.</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">

                    <?php
                        $sql = "select m.mc mc ,c1.v_id id ,v1.v_titre titre , n_comm n
                        from motscles m,videos v1,contiennent c1  
                        where c1.mc_id=m.mc_id  and 
                        v1.v_id=c1.v_id and 
                        n_comm= (   select max(n_comm) 
                                    from videos v2,contiennent c2 
                                    where  c2.mc_id=m.mc_id and 
                                    v2.v_id=c2.v_id 
                                )";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                    ?>
                    <br><table  class="table table-dark table-hover table-striped">
                    <thead>
                    <tr>
                        <th>mot cle</th>
                        <th>video id</th>
                        <th>video name</th>
                        <th>nombre de comments</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    //href=\"https://www.youtube.com/watch?v=". $row['v_id'] ."\" target=\"_blank\"
                                        echo "<td>" . $row['mc']. "</td>";    
                                        echo "<td><span  data-toggle=\"modal\" data-target=\"#myModal".$row['id']."\" ><a data-toggle=\"tooltip\" title=\"Regarder\">" . $row['id']  . "</a></span></td>";
                                        echo "<td>" . $row['titre'] ."</td>";
                                        echo "<td>" . $row['n'] ."</td>";
                                    echo "</tr>";
                                    $html="<div class=\"modal fade\" id=\"myModal".$row['id']."\">
                                    <div class=\"modal-dialog\">
                                      <div class=\"modal-content\">
                                      
                                        <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/".$row['id']."\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>
                                        
                                      </div>
                                    </div>
                                  </div>";
                                  echo $html;
                                            
                                }
                        ?>
                        </tbody>
                        </table>
                        <?php
                            }else{
                                echo "<h1 style='text-align:center;font-size:60px'> There's no data</h1>";
                            }
                        ?>
                    </div>    
                </div>
            </div>
        </div>
        <div class="modal" id="r7">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Requete 7:  Pour une requête donnée, afficher l’utilisateur ayant rédigé le commentaire le plus populaire concernant la vidéo la plus « Likée »</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    <?php
                            $select = "SELECT * FROM motscles";
                            $result = $conn->query($select);
                            if ($result->num_rows > 0){
                            $option = '<option value="">Select Query</option>';
                            while($row = $result->fetch_object()){
                                $option .= '<option value="'.$row->mc_id.'">'.$row->mc.' a '.$row->rech_d.'</option>';
                            }
                        ?>  
                        <form method="get">
                            <select name="empid" id="empid"  class="form-control" onchange="getData('r7' ,this.value, 'displaydata1')">
                                <?php
                                echo $option;
                                ?> 
                            </select>
                            
                        </form>
                        <div id="displaydata1">
                            </div>
                        <?php
                            }else{
                                echo "<h1 style='text-align:center;font-size:60px'> There's no data</h1>";
                                }
                        ?>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <?php
            }
            else
            {
                echo "<h1 style='text-align:center;margin-top:250px;font-size:60px'>La base de donnees est vide</h1><br><h2 style='text-align:center;font-size:30px'>ajouter les donnes par ajouter un mot cle</h2>";
            }
    ?>
</body>
</html>