<?php
$servername = "localhost";
$username = "youssef";
$password = "";
$dbname = "api";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
   echo "error lors la connection";
}
?>