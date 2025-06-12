
<?php
echo "<style>
    table, th, td{
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>";


// ini_set('display_startup_errors', 1);

ini_set("display_errors", E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";

$db = New Database("noticias");

$query = "SELECT a.id, a.titulo FROM noticias.noticias a
/*LEFT JOIN noticias.noticias_temas b ON a.id = b.idNoticia
LEFT JOIN noticias.temas c ON b.idTema = c.id order by a.id asc*/;";

$execQuery = $db->DbGetAll($query);

echo('tamanho: '.sizeof($execQuery));
echo'<br>';

//echo '<pre>';
//print_r($execQuery);
//echo '</pre>';
echo "<h1>Tabela de Links</h1>";
echo "<table>";
echo "<thead>";
    echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Titulo</th>";
        echo "<th>Par ou Ímpar</th>";
    echo "</tr>";
echo "</thead>";
echo "<tbody>";
//echo '<pre>';
for($i = 0; $i < sizeof($execQuery); $i++) {
    echo "<tr><td>" . $execQuery[$i]['id'] . "</td><td>" . $execQuery[$i]['titulo'] . "</td>";
     if($execQuery[$i]['id'] % 2 == 0) {
        echo "<td>Esse ID é Par" . "</td></tr>";
    }else {
        echo "<td>Esse ID é Ímpar" . "</td></tr>";
    }

}
echo "</tbody>";
echo "</table>";
    
   

/*$array = array_map(function($element) {
    return $element['id'];
}, $array);
print_r($array);*/

//echo '</pre>';
//trazer o ID e o titulo no formato 1 - titulo

//$valores = array_values($execQuery);
 //       print_r($valores);