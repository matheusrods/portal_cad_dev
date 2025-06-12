<?php

include "../class/class_estudosPesquisas.php";

$class = new funcoes();
$request = $_REQUEST["request"];

if(!isset($_SESSION)){
    session_start();
}
$mat = strtolower($_SESSION['matricula']);
$data = $_POST['data'];
$idTema = $_POST['idTema'];
$textoDigitado = $_POST['textoDigitado'];
$qualOpcao = $_POST['qualOpcao'];
$tipoUpload = $_POST['tipoUpload'];

if($idTema <> null){
    $idTemaString = implode(",", $idTema);
} else{
    $idTemaString = '';
}

switch($request){
    case "consultaEstudos":
        $retorno = $class->consultaEstudos();
        echo json_encode($retorno);
    break;

    case "consultaPesquisas":
        $retorno = $class->consultaPesquisas();
        echo json_encode($retorno);
    break;

    case "consultaEstudosPesquisas":
        $retorno = $class->consultaEstudosPesquisas($idTemaString, $qualOpcao);
        echo json_encode($retorno);
    break;

    case "pesquisaTextoDigitado":
        $retorno = $class->pesquisaTextoDigitado($textoDigitado, $qualOpcao);
        echo json_encode($retorno);
    break;

    case "paginaAdicionaEstudoPesquisa":
        $retorno = $class->paginaAdicionaEstudoPesquisa($tipoUpload);
        echo json_encode($retorno);
    break;
}
?>