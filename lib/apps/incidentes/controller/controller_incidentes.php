<?php

if(!isset($_SESSION)){
    session_start();
}
$mat = strtolower($_SESSION['matricula']);

include "../class/class_incidentes.php";

$class = new funcoes();

$request = $_REQUEST["request"];

$data = $_POST['data'];
$numIntIssue = $_POST['numIntIssue'];

switch($request){

    case "consultaIncidentes":
        
        $retorno = $class->consultaIncidentes();
        echo json_encode($retorno);
    break; 
    
    case "consultaTipoIncidente":
        $retorno = $class->consultaTipoIncidente();
        echo ($retorno);
    break;  
    
    
    case "pesquisaIncidentes":
        $dadosPesquisa = $_POST['dadosPesquisa'];
        $retorno = $class->pesquisaIncidentes($dadosPesquisa);
      
        echo json_encode($retorno);
    break; 


    case "acessaIncidente":
        $idIncidente = $_POST['idIncidente'];
        $retorno = $class->acessaIncidente($idIncidente);
        echo json_encode($retorno);
    break; 

    case "montaTelaCadastraIncidente":
        $retorno = $class->montaTelaCadastraIncidente();
        echo ($retorno);
    break;

    case "montaTelaEditaIncidente":
        $retorno = $class->montaTelaEditaIncidente($numIntIssue);
        echo ($retorno);
    break;
    
    case "gravaIncidente":
        $tipoIncidente = $_POST['tipoIncidente'];
        $numIntIssue = $_POST['numIntIssue'];
        $dataAbertura = $_POST['dataAbertura'];
        $horaAbertura = $_POST['horaAbertura'];
        $motivo = $_POST['motivo'];
        $ambiente = $_POST['ambiente'];
        $status = $_POST['status'];
        $dependencia = $_POST['dependencia'];
        $dataEncerramento = $_POST['dataEncerramento'];
        $horaEncerramento = $_POST['horaEncerramento'];
        $observacao = $_POST['observacao'];
        $responsavel = $_POST['responsavel'];

        $retorno = $class->gravaIncidente($tipoIncidente, $numIntIssue, $dataAbertura, $horaAbertura, $motivo, $ambiente, $status, $dependencia, $dataEncerramento, $horaEncerramento, $observacao, $responsavel);
        echo ($retorno);
    break;

    case "editaIncidente":
        $idIncidenteBd = $_POST['idIncidenteBd'];
        $tipoIncidente = $_POST['tipoIncidente'];
        $numIntIssue = $_POST['numIntIssue'];
        $dataAbertura = $_POST['dataAbertura'];
        $horaAbertura = $_POST['horaAbertura'];
        $motivo = $_POST['motivo'];
        $ambiente = $_POST['ambiente'];
        $status = $_POST['status'];
        $dependencia = $_POST['dependencia'];
        $dataEncerramento = $_POST['dataEncerramento'];
        $horaEncerramento = $_POST['horaEncerramento'];
        $observacao = $_POST['observacao'];
        $responsavel = $_POST['responsavel'];

        $retorno = $class->editaIncidente($idIncidenteBd, $tipoIncidente, $numIntIssue, $dataAbertura, $horaAbertura, $motivo, $ambiente, $status, $dependencia, $dataEncerramento, $horaEncerramento, $observacao, $responsavel);
        echo ($retorno);
    break;

    case "deletaIncidente":
        $numIntIssue = $_POST['numIntIssue'];
        $retorno = $class->deletaIncidente($numIntIssue);
        echo ($retorno);
    break;

    case "consultaIncidentesCadastrados":
        $idIncidente = $_POST['numIntIssue'];
        $retorno = $class->consultaIncidentesCadastrados($numIntIssue);
        echo ($retorno);
    break;

}
?>