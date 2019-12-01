<!DOCTYPE html> 
<html> 
<head> 
    <title> 
        Install the db
    </title> 
</head> 
  
<body style="text-align:center;"> 
      
    <h1 style="color:green;"> 
        initialiser la base de donnes 
    </h1> 
  
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
\$servername = \"localhost\";
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
                header("Location: /Project/index.php");
            }
        }
    }
        

        



    ?> 
      
    <form method="POST"> 
        <input type="text" name="username" placeholder="db username"/>
        <input type="password" name="password" placeholder="db password"/>
        <input type="text" name="dbname" placeholder="db name"/><br>
        <input type="submit" name="button" value="Creer la base de donner"/> 
    </form> 
</head> 
  
</html> 