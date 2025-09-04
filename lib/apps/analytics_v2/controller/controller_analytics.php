<?php

include "../class/class_analytics.php";

$class = new funcoes();
$request = $_REQUEST["request"];

if(!isset($_SESSION)){
    session_start();
}
$mat = strtolower($_SESSION['matricula']);
$data = $_POST['data'];

switch($request){
    case "consultaGrandesNumerosPf":
        $retorno = $class->consultaGrandesNumerosPf($data);
        echo json_encode($retorno);
    break;
    
    case "consultaGrandesNumerosPj":
        $retorno = $class->consultaGrandesNumerosPj($data);
        echo ($retorno);
    break;

    case "consultaNumerosAcumulados":
        $retorno = $class->consultaNumerosAcumulados($data);
        echo ($retorno);
    break;

    case "atualizaGrandesNumerosPf":
        $retorno = $class->atualizaGrandesNumerosPf($data);
        echo json_encode($retorno);
    break;

    case "atualizaGrandesNumerosPj":
        $retorno = $class->atualizaGrandesNumerosPj($data);
        echo json_encode($retorno);
    break;

}
?>