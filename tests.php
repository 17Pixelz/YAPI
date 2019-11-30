<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="tests.php" method="GET">
    <a href="http://localhost/Projet/tests.php?a=Holala">link</a>
    <a href="http://localhost/Projet/tests.php?a=Holalaaa">link2</a>
    <a href="http://localhost/Projet/tests.php?a=Holalaaaaaa">link3</a>
</form>
    
</body>
</html>
<?php
/*
include './api/db_connect.php';

$sql = "INSERT INTO motscles VALUES (1,\"mc\",\"2019-12-12\",\"2018-02-15\")";
$a = $conn->query($sql);
var_dump($a);
*/
/*
class video
{
    public $id;
    public $name;

    function __construct($a)
    {
        $this->id = $a;
    }
}

$v = new video(2);
//$v->id = 25;
echo $v->id;*/

//echo date('Y-m-d H:m:s');


echo $_GET['a'];


/*

    Free all tables :
    TRUNCATE contiennent;
    TRUNCATE motscles;
    TRUNCATE videos;
    TRUNCATE chaines;
    TRUNCATE commentaires;

*/

//SELECT c.v_id,c.v_titre FROM (SELECT a.v_id,a.v_titre,MAX(a.v_j) FROM videos a, contiennent b WHERE a.v_id=b.v_id GROUP BY b.mc_id) c

?>