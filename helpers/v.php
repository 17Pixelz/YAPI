<?php
require_once '../api/db_connect.php';

$html = "<table  class='table table-dark table-hover table-striped'>
    <thead>
      <tr>
        <th>video id</th>
        <th>video name</th>
        <th>channel id</th>
      </tr>
    </thead>
    <tbody>";
    $sql = 'SELECT v.v_id, v.v_titre,v.ch_id FROM videos v , contiennent m where m.v_id=v.v_id AND m.mc_id="'.$_GET['q'].'"';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $html .= "<tr>";
                //href=\"https://www.youtube.com/watch?v=". $row['v_id'] ."\" target=\"_blank\"
                    $html .= "<td><span  data-toggle=\"modal\" data-target=\"#myModal".$row['v_id']."\" ><a data-toggle=\"tooltip\" title=\"Regarder\">" . $row['v_id']  . "</a></span></td>";
                    $html .= "<td>" . $row['v_titre'] ."</td>";
                    $html .= "<td>" . $row['ch_id']. "</td>";
                    $html .= "</tr>";
                $modal="<div class=\"modal fade\" id=\"myModal".$row['v_id']."\">
                <div class=\"modal-dialog\">
                  <div class=\"modal-content\">
                  
                    <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/".$row['v_id']."\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>
                    
                  </div>
                </div>
              </div>";
              $html .= $modal;
                        
            }
        } else {
            echo "<h1>";
                    echo "<td>Aucun Resultat essayer a ajouter des donnees</td>";
            echo "</h1>";
        }

        $html .="</tbody></table>";
        echo $html;
?>