<?php
/*
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        function ld(name)
        {
            //var name = $('#name');
            $.ajax({
                url : 'a.php?name='+name,
                success: function (res)
                {
                    $("#a").html(res);
                }
            });
        }dsdsadasdasdsa
    </script>
</head>
<body>

    <input list="a">
    <datalist id="a">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </datalist>
</body>
</html>

*/
/*
require "api/functions.php";

$q = "";

$mc_id = sql_exec($conn,"SELECT MAX(mc_id) i FROM motscles");/* WHERE mc=".$q." AND dep_d=".$ds." AND dep_f=".$df
$b = $mc_id->fetch_assoc();
$mc_id = (int)$b['i'];
echo $mc_id;
*/

if (3)
{
    echo "1";
}

?>

<?php
/*<!--<!DOCTYPE html>
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
</html>-->

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

//https://www.w3schools.com/howto/howto_js_autocomplete.asp
//echo $_GET['a'];


/*

    Free all tables :
    TRUNCATE contiennent;
    TRUNCATE motscles;
    TRUNCATE videos;
    TRUNCATE chaines;
    TRUNCATE commentaires;

*/

//SELECT c.v_id,c.v_titre FROM (SELECT a.v_id,a.v_titre,MAX(a.v_j) FROM videos a, contiennent b WHERE a.v_id=b.v_id GROUP BY b.mc_id) c

/*
$a = fopen("./construction/CREATE.sql","r");
$sql= fread($a,filesize("./construction/CREATE.sql"));
$sql=str_replace('"','\"',$sql);
echo $sql;*/
?>

