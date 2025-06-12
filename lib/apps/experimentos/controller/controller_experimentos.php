<?php

include "../class/class_experimentos.php";

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
    
    case "consultaExperimentos":
        $idTema = $_POST['idTema'];
        if($idTema <> null){
            $idTemaString = implode(",", $idTema);
        } else{
            $idTemaString = '';
        }
        
        $retorno = $class->consultaExperimentos($idTemaString);
        echo json_encode($retorno);
    break;
    
    case "filtraExperimentosTema":
        $idTema = $_POST['idTema'];
        $idTemaString = implode(",", $idTema);
        $retorno = $class->filtraExperimentosTema($idTemaString);
        echo json_encode($retorno);
    break;

    case "pesquisaExperimentos":
        $textoDigitado = $_POST['textoDigitado'];
        $retorno = $class->pesquisaExperimentos($textoDigitado);
        echo json_encode($retorno);
    break;

    case "adicionaExperimento":
        $retorno = $class->adicionaExperimento();
        echo json_encode($retorno);
    break;
}
?>