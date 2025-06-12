<?php

include "../class/class_noticias.php";

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
    
    case "consultaNoticias":
        $idTema = $_POST['idTema'];
        if($idTema <> null){
            $idTemaString = implode(",", $idTema);
        } else{
            $idTemaString = '';
        }
        
        $retorno = $class->consultaNoticias($idTemaString);
        echo json_encode($retorno);
    break;
    
    case "filtraNoticiasTema":
        $idTema = $_POST['idTema'];
        $idTemaString = implode(",", $idTema);
        $retorno = $class->filtraNoticiasTema($idTemaString);
        echo json_encode($retorno);
    break;

    case "pesquisaNoticias":
        $textoDigitado = $_POST['textoDigitado'];
        $retorno = $class->pesquisaNoticias($textoDigitado);
        echo json_encode($retorno);
    break;
}
?>