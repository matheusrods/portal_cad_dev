<?php

include "classCadastro.php";

$class = new funcoes();
$request = $_REQUEST["request"];

if(!isset($_SESSION)){
    session_start();
}
$mat = strtolower($_SESSION['matricula']);

switch($request){
    case "gravaTexto":
        $mat = !empty($_GET["matricula"]) ? strtolower($_GET["matricula"]) : strtolower($_SESSION["matricula"]);
        $titulo = $_POST['titulo'];
        $texto = $_POST['texto'];
        $url = $_POST['url'];
        $squad = $_POST['squad'];
        $dataIni = $_POST['dataIni'];
        $dataFim = $_POST['dataFim'];
        $vigente = $_POST['vigente'];
        $tipoReport = $_POST['tipoReport'];
        $falhaCad = $_POST['falhaCad'];
        $ferramentaTicket = $_POST['ferramentaTicket'];
        $numeroTicket = $_POST['numeroTicket'];
        $retorno = $class->gravaTexto($titulo, $texto, $url, $squad, $dataIni, $dataFim, $vigente, $falhaCad, $ferramentaTicket, $numeroTicket, $tipoReport, $mat);
        echo ($retorno);
    break;

    case "consultaSquads":
        $retorno = $class->consultaSquads();
        echo ($retorno);
    break;
    
    case "consultaTiposReport":
        $retorno = $class->consultaTiposReport();
        echo ($retorno);
    break;

    case "consultaIndispAtivas":
        $retorno = $class->consultaIndispAtivas();
        echo json_encode($retorno);
    break;

    case "consultaHistIndisp":
        $retorno = $class->consultaHistIndisp();
        echo json_encode($retorno);
    break;

    case "consultaHistNoticias":
        $retorno = $class->consultaHistNoticias();
        echo json_encode($retorno);
    break;

    case "consultaHistDestaques":
        $retorno = $class->consultaHistDestaques();
        echo json_encode($retorno);
    break;

    case "editarIndisponibilidade":
        $idIndisp = $_POST['idIndisp'];
        $retorno = $class->editarIndisponibilidade($idIndisp);
        echo ($retorno);
    break;

    case "gravaDataFimIndisp":
        $idIndisp = $_POST['idIndisp'];
        $textoTituloEditaIndisp = $_POST['textoTituloEditaIndisp'];
        $textoDescricaoEditaIndisp = $_POST['textoDescricaoEditaIndisp'];
        $dataFim = $_POST['dataFim'];
        $retorno = $class->gravaDataFimIndisp($idIndisp, $textoTituloEditaIndisp, $textoDescricaoEditaIndisp, $dataFim, $mat);
        echo ($retorno);
    break;

    case "verificaIndisponibilidade7dias":
        $retorno = $class->verificaIndisponibilidade7dias();
        echo json_encode($retorno);
    break;
    
}
?>