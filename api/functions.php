<?php
require './db_connect.php';

function getDataForomJson($url)
{
    $url = str_replace(" ", "%20", $url);
    $a = file_get_contents($url);
    return (json_decode($a));
}

function sql_exec($conn,$sql)
{
    $a = $conn->query($sql);
    if ($a == TRUE){
        return $a;
    }else{
        echo "Problem: " . $conn->error . "<br>".$sql."<br><br>";
    }
}


/*
function get_data($url)
{
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
*/

?>