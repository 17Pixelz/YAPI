<!DOCTYPE html> 
<html> 
<head> 
    <title>inisialisation de la base de donnees</title> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
</head> 
  
<body style="text-align:center;"> 
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link active" href="#">Initialiser la base de donnees<span class="sr-only">(current)</span></a>
            </div>
        </div>
    </nav>
    <?php
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        if(isset($_POST['button'])) {
            if (isset($_POST['username']) && isset($_POST['dbname']) && $_POST['dbname'] != "" && isset($_POST['password']))
            {
                $servername = "localhost";
                $username = $_POST['username'];
                $password = $_POST['password'];
                $dbname =  $_POST['dbname'];
                $conn = new mysqli($servername, $username, $password);
                if ($conn->connect_error) {
                echo "<br><br><h2 style=\"color:red\">Error lors la connection.</h2><br><h5>Rentrez les donnes svp</h5>";
                }else{
                $db="<?php
\$servername = \"".$_SERVER['SERVER_NAME']."\";
\$username = \"".$_POST['username']."\";
\$password = \"".$_POST['password']."\";
\$dbname = \"".$_POST['dbname']."\";
\$conn = new mysqli(\$servername, \$username, \$password, \$dbname);
if (\$conn->connect_error) {
   echo \"error lors la connection\";
}
?>";
                $conn->query("CREATE DATABASE ".$dbname);
                $conn->close();
                $conn = new mysqli($servername, $username, $password,$dbname);
                $a = fopen("./construction/CREATE.sql","r");
                $sql= fread($a,filesize("./construction/CREATE.sql"));
                fclose($a);
                $conn->multi_query($sql);
                $conn->close();
                $b=fopen("./api/db_connect.php","w");
                fwrite($b,$db);
                fclose($b);
                unlink(__FILE__);
                header("Location: /project/index.php");
            }
        }
    }
        
    ?> 
    <div class="container" style="margin-top:150px">
    <form method="POST"> 
         <div class="input-group mb-6 a">
            <div class="input-group-prepend">
                <span class="input-group-text b" id="basic-addon1">le nom d'utilisateur</span><input class="form-control" type="text" name="username" placeholder="db username"/>
            </div>
        </div>
         <div class="input-group mb-6 a">
            <div class="input-group-prepend">
                <span class="input-group-text b" id="basic-addon1">mot de pass</span><input class="form-control" type="password" name="password" placeholder="db password"/>
            </div>
        </div>
         <div class="input-group mb-6 a">
            <div class="input-group-prepend">
                <span class="input-group-text b" id="basic-addon1">nom de la bd</span><input class="form-control" type="text" name="dbname" placeholder="db name"/>
            </div>
        </div>
        <button class="btn btn-primary" type="submit" name="button">Creer la base de donnees</button> 
    </form> 
    </div>
</body> 
  
</html> 