<?php

include "../class/class_onboarding.php";

$class = new funcoes();
$request = $_REQUEST["request"];

if(!isset($_SESSION)){
    session_start();
}
$mat = strtolower($_SESSION['matricula']);

switch($request){
    case "consultaSquadsDesign":
        $retorno = $class->consultaSquadsDesign();
        echo ($retorno);
    break;
}
?>