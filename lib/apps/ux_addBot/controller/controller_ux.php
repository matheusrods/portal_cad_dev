<?php

include "../class/class_ux.php";

$class = new funcoes();
$request = $_REQUEST["request"];

if(!isset($_SESSION)){
    session_start();
}
$mat = strtolower($_SESSION['matricula']);

switch($request){
    case "consultaTemas":
        $retorno = $class->consultaTemas();
        echo ($retorno);
    break;
    
    case "consultaVideosUx":
        $idTema = $_POST['idTema'];
        if($idTema <> null){
            $idTemaString = implode(",", $idTema);
        } else{
            $idTemaString = '';
        }
        
        $retorno = $class->consultaVideosUx($idTemaString);
        echo json_encode($retorno);
    break;
    
    case "pesquisaVideosUx":
        $textoDigitado = $_POST['textoDigitado'];
        $retorno = $class->pesquisaVideosUx($textoDigitado);
        echo json_encode($retorno);
    break;
}
?>