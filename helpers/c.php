<?php
require_once '../api/db_connect.php';

$html="<table  class='table table-dark table-hover table-striped'>
    <thead>
      <tr>
        <th>video id</th>
        <th>video name</th>
      </tr>
    </thead>
    <tbody>";


    $sql = 'select c1.v_id id,v1.v_titre titre 
        from videos v1,contiennent c1  
        where c1.mc_id="'.$_GET['q'].'" and 
        v1.v_id=c1.v_id and 
        v_j = ( select max(v_j) 
                from videos v2,contiennent c2 
                where  c2.mc_id="'.$_GET['q'].'" and 
                v2.v_id=c2.v_id 
                )';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) { // foreach ($result->fetch_assoc as $row)
            $html .= "<tr>";
            $html .= "<td><a href=\"https://www.youtube.com/channel/".$row['id']."\" target=\"_blank\">" . $row['id']  . "</a></td>";
            $html .= "<td>" . $row['titre'] ."</td>";
            $html .= "</tr>";
        }
    }else {
        echo "<h1>";
        echo "Aucun resultat";
        echo "</h1>";
    }
    $html .= "</tbody>
    </table>";
    echo $html;
?>