<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/style.css">
    <title>Videos</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link" href="/project/index.php">Ajouter mot-cle <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="/project/content/videos.php">Videos</a>
            <a class="nav-item nav-link" href="/project/content/channels.php">Channels</a>
            <a class="nav-item nav-link active" href="/project/content/comments.php">Comments</a>
            <a class="nav-item nav-link" href="/project/content/requetes.php">Requetes</a>
            </div>
        </div>
    </nav>
    <div class="selecto">
              <?php
                require '../api/db_connect.php';
                $select = "SELECT * FROM videos";
                $result = $conn->query($select);
                if ($result->num_rows > 0){
                  $option = '<option value="">choisir un query (date de recherche)</option>';
                  while($row = $result->fetch_object()){
                    $option .= '<option value="'.$row->v_id.'">'.$row->v_titre.'('.$row->pub_date.')</option>';
                }
              ?>  
              <form method="get">
                  <select name="empid" id="empid"  class="form-control" onchange="getData('c', this.value, 'displaydata')">
                    <?php
                      echo $option;
                    ?> 
                  </select>
                  
               </form>
              <?php
                  }else{
                    echo "<h1 style='text-align:center;margin-top:250px;font-size:60px'>La base de donnees est vide</h1><br><h2 style='text-align:center;font-size:30px'>ajouter les donnes par ajouter un mot cle</h2>";
                    }
                ?>
    </div>
    <div id="displaydata"></div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>