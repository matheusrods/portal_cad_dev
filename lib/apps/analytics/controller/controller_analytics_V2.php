<?php

include "../class/class_paineis.php";

$class = new funcoes();
$request = $_REQUEST["request"];

if(!isset($_SESSION)){
    session_start();
}
$mat = strtolower($_SESSION['matricula']);

//variável proveniente do analytics V1
$data = $_POST['data'];

switch($request){
    //Funções do Analytics 1
    case "consultaTags":
        $retorno = $class->consultaTags();
        echo ($retorno);
    break;
    
    case "consultaPaineis":
        $idTag = $_POST['idTag'];
        if($idTag <> null){
            $idTagString = implode(",", $idTag);
        } else{
            $idTagString = '';
        }
        
        $retorno = $class->consultaPaineis($idTagString);
        echo json_encode($retorno);
    break;
    
    case "filtraPaineisTag":
        $idTag = $_POST['idTag'];
        $idTagString = implode(",", $idTag);
        $retorno = $class->filtraPaineisTag($idTagString);
        echo json_encode($retorno);
    break;

    case "pesquisaPaineis":
        $textoDigitado = $_POST['textoDigitado'];
        $retorno = $class->pesquisaPaineis($textoDigitado);
        echo json_encode($retorno);
    break;

    //Funções referentes à área de painéis
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