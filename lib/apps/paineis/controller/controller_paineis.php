<?php

include "../class/class_paineis.php";

$class = new funcoes();
$request = $_REQUEST["request"];

if(!isset($_SESSION)){
    session_start();
}
$mat = strtolower($_SESSION['matricula']);


$data = $_POST['data'];

switch($request){
    
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

}
?>