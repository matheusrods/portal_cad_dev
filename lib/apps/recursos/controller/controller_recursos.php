<?php

include "../class/class_recursos.php";

$class = new funcoes();
$request = $_REQUEST["request"];

if(!isset($_SESSION)){
    session_start();
}
$mat = strtolower($_SESSION['matricula']);

switch($request){
    case "consultaTemas":
        $retorno = $class->consultaTemas();
        echo json_encode($retorno);
        // echo ($retorno);
    break;
    
    case "consultaRecursos":
        $idTema = $_POST['idTema'];
        if($idTema <> null){
            $idTemaString = implode(",", $idTema);
        } else{
            $idTemaString = '';
        }
        $retorno = $class->consultaRecursos($idTemaString);
        echo json_encode($retorno);
    break;
    
    case "filtraRecursosTema":
        $idTema = $_POST['idTema'];
        $idTemaString = implode(",", $idTema);
        $retorno = $class->filtraRecursosTema($idTemaString);
        echo json_encode($retorno);
    break;

    case "pesquisaRecursos":
        $textoDigitado = $_POST['textoDigitado'];
        $retorno = $class->pesquisaRecursos($textoDigitado);
        echo json_encode($retorno);
    break;

    case "editaRecurso":
        $idRecurso = $_POST['idRecurso'];
        $retorno = $class->editaRecurso($idRecurso);
        echo json_encode($retorno);
    break;

    case "paginaAdicionaRecurso":
        $retorno = $class->paginaAdicionaRecurso();
        echo json_encode($retorno);
    break;
}
?>