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
        error_reporting(E_ERROR | E_PARSE);
        if(isset($_POST['button'])) {
            if (isset($_POST['username']) && isset($_POST['password']))
            {
                $servername = "localhost";
                $username = $_POST['username'];
                $password = $_POST['password'];
                $dbname = "projet";


                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                echo "<br><br><h2 style=\"color:red\">Error lors la connection.</h2><br><h5>Rentrez les donnes svp</h5>";
                }else{
                $db="<?php
\$servername = \"localhost\";
\$username = \"".$_POST['username']."\";
\$password = \"".$_POST['password']."\";
\$dbname = \"projet\";


\$conn = new mysqli(\$servername, \$username, \$password, \$dbname);
if (\$conn->connect_error) {
   echo \"error lors la connection\";
}
?>";
                $a=fopen("dbb.php","w");
                fwrite($a,$db);
                fclose($a);
                unlink(__FILE__);
                header("Location: /Project/index.php");
            }
        }
    }
        

        



    ?> 
      
    <form method="POST"> 
        <input type="text" name="username" placeholder="Entrer le username"/>
        <input type="password" name="password" placeholder="Entrer le username"/>
        <input type="submit" name="button" value="Creer la base de donner"/> 
    </form> 
</head> 
  
</html> 