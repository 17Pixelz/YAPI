<?php
require_once '../api/db_connect.php';

    switch ($_GET['c'])
    {
        case 'v':
            v($_GET['q']);
        break;
        case 'r5':
            r5($_GET['q']);
        break;
        case 'r7':
            r7($_GET['q']);
        break;
        case 'c':
            c($_GET['q']);
        break;
    }


function    v($q)
{
    $html="";
    $sql = 'SELECT v.v_id, v.v_titre,v.ch_id FROM videos v , contiennent m where m.v_id=v.v_id AND m.mc_id="'.$q.'"';
    $result = $GLOBALS['conn']->query($sql);
    if ($result->num_rows > 0) {
      $html = "<table  class='table table-dark table-hover table-striped'>
    <thead>
      <tr>
        <th>video id</th>
        <th>video name</th>
        <th>channel id</th>
      </tr>
    </thead>
    <tbody>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $html .= "<tr>";
                //href=\"https://www.youtube.com/watch?v=". $row['v_id'] ."\" target=\"_blank\"
                    $html .= "<td><span  data-toggle=\"modal\" data-target=\"#myModal".$row['v_id']."\" ><a data-toggle=\"tooltip\" title=\"Regarder\" style=\"cursor:pointer;text-decoration:underline;color:grey\">" . $row['v_id']  . "</a></span></td>";
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
            echo "<h1 style='text-align:center;font-size:60px'>";
                    echo "Aucun Resultat.";
            echo "</h1>";
        }

        $html .="</tbody></table>";
        echo $html;
}

function    r5($q)
{
    $html ="";
    $sql = 'select c1.v_id id,v1.v_titre titre 
        from videos v1,contiennent c1  
        where c1.mc_id="'.$q.'" and 
        v1.v_id=c1.v_id and 
        v_j = ( select max(v_j) 
                from videos v2,contiennent c2 
                where  c2.mc_id="'.$q.'" and 
                v2.v_id=c2.v_id 
                )';
    $result = $GLOBALS['conn']->query($sql);
    if ($result->num_rows > 0) {
        $html="<table  class='table table-dark table-hover table-striped'>
                <thead>
                <tr>
                    <th>video id</th>
                    <th>video name</th>
                </tr>
                </thead>
                <tbody>";
        // output data of each row
        while($row = $result->fetch_assoc()) { // foreach ($result->fetch_assoc as $row)
            $html .= "<tr>";
            $html .= "<td><a href=\"https://www.youtube.com/channel/".$row['id']."\" target=\"_blank\" style=\"cursor:pointer;text-decoration:underline;color:grey\">" . $row['id']  . "</a></td>";
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
}

function r7($q)
{
    $html ="";
    $sql = 'select m.mc mc ,v1.v_titre titre ,ch.ch_name name
            from motscles m,videos v1,contiennent c1,chaines ch , commentaires com1
            where m.mc='.$q.'  and 
            c1.mc_id=m.mc_id and 
            v1.v_id=c1.v_id and 
            ch.ch_id=com1.ch_id and 
            v1.v_id=com1.v_id and 
            com_j = (   select max(com_j) 
                        from commentaires com2 , videos v2,videos v3  
                        where v2.v_id=com2.v_id and 
                        v2.v_j=v3.v_j and 
                        v3.v_j = (  select max(v3.v_j) 
                                    from videos v3,contiennent c2 
                                    where v3.v_id=c2.v_id ))';
    $result = $GLOBALS['conn']->query($sql);
    if ($result->num_rows > 0) {
        $html="<table  class='table table-dark table-hover table-striped'>
                <thead>
                <tr>
                    <th>mot cle</th>
                    <th>titre</th>
                    <th>chanel name</th>
                </tr>
                </thead>
                <tbody>";
        // output data of each row
        while($row = $result->fetch_assoc()) { // foreach ($result->fetch_assoc as $row)
            $html .= "<tr>";
            $html .= "<td>" . $row['mc'] ."</td>";
            $html .= "<td>" . $row['titre'] ."</td>";
            $html .= "<td>" . $row['name'] ."</td>";
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
}

function    c($q)
{
    $html="";
    $sql = 'SELECT com_id id, com c, ch_id cid FROM commentaires c WHERE c.v_id="'.$q.'"';
    $result = $GLOBALS['conn']->query($sql);
    if ($result->num_rows > 0) {
      $html = "<table  class='table table-dark table-hover table-striped'>
    <thead>
      <tr>
        <th>commentaire id</th>
        <th>commentaire</th>
        <th>channel id</th>
      </tr>
    </thead>
    <tbody>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $html .= "<tr>";
                //href=\"https://www.youtube.com/watch?v=". $row['v_id'] ."\" target=\"_blank\"
                    $html .= "<td>" . $row['id'] ."</td>"; 
                    $html .= "<td>" . $row['c'] ."</td>";
                    $html .= "<td>" . $row['cid']. "</td>";
                    $html .= "</tr>";
            }
        } else {
            echo "<h1 style='text-align:center;font-size:60px'>";
                    echo "Aucun Resultat.";
            echo "</h1>";
        }

        $html .="</tbody></table>";
        echo $html;
}
?>