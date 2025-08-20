<?php

include "../class/class_trends.php";

$class = new funcoes();
$request = $_REQUEST["request"];

if(!isset($_SESSION)){
    session_start();
}

switch($request){
    case "consultaTrends":
        $textoPesquisa = $_POST['textoPesquisa'];
        $retorno = $class->consultaTrends($textoPesquisa);
        echo json_encode($retorno);
    break;
}


