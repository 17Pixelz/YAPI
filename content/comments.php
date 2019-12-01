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
            <a class="nav-item nav-link" href="/project/index.php">Ajouter mot-cle <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="/project/content/videos.php">Videos</a>
            <a class="nav-item nav-link" href="/project/content/channels.php">Channels</a>
            <a class="nav-item nav-link active" href="/project/content/comments.php">Comments</a>
            <a class="nav-item nav-link" href="/project/content/requetes.php">Requetes</a>
            </div>
        </div>
    </nav>
    <table  class="table table-dark table-hover table-striped">
    <thead>
      <tr>
        <th>comment id</th>
        <th>comment</th>
        <th>channel id</th>
      </tr>
    </thead>
    <tbody>
    <?php 
        require_once '../api/db_connect.php';

        $sql = "SELECT com_id, com, ch_id FROM commentaires";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                    echo "<td>" . $row['com_id']  . "</td>";
                    echo "<td>" . $row['com'] ."</td>";
                    echo "<td><a href=\"https://www.youtube.com/channel/".$row['ch_id']."\" target=\"_blank\">" . $row['ch_id']  . "</a></td>";
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>