<?php

session_start();

if($_SESSION["matricula"] == ""){
    header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=https://cad.bb.com.br/solicitacoes/#login/");
}

$mat = strtolower($_SESSION['matricula']);

include "../class/class_solicitacoes.php";

$class = new funcoes();

$request = $_REQUEST["request"];

switch($request){

    case "consultaSolicitacoes":
        $retorno = $class->consultaSolicitacoes();
        echo json_encode($retorno);
    break; 
    
    case "filtrarSolicitacoes":
        $camposSelecionados = $_POST['camposSelecionados'];
        $retorno = $class->filtrarSolicitacoes($camposSelecionados);
        echo json_encode($retorno);
    break;
}
?>