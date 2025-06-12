<?php

include "../class/class_quemSomos.php";

$class = new funcoes();
$request = $_REQUEST["request"];

if(!isset($_SESSION)){
    session_start();
}
$mat = strtolower($_SESSION['matricula']);

switch($request){
    case "consultaSquads":
        $retorno = $class->consultaSquads();
        echo ($retorno);
    break;
}
?>