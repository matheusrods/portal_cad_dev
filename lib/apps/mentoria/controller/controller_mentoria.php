<?php

include "../class/class_mentoria.php";

$class = new funcoes();
$request = $_REQUEST["request"];

if(!isset($_SESSION)){
    session_start();
}
$mat = strtolower($_SESSION['matricula']);

switch($request){
    case "consultaDepoimentosMentoria":
        $retorno = $class->consultaDepoimentosMentoria();
        echo ($retorno);
    break;

    case "consultaProfessoresMentoria":
        $retorno = $class->consultaProfessoresMentoria();
        echo ($retorno);
    break;

    case "consultaBio":
        $matricula = $_POST['matricula'];
        $retorno = $class->consultaBio($matricula);
        echo ($retorno);
    break;

    case "gravaSolicitacao":
        $matricula = $_POST['matricula'];
        $nome = strtolower($_POST['nome']);
        $nome = ucwords($nome);
        $email = $_POST['email'];
        $dependencia = $_POST['dependenciaMentoria'];
        $necessidade = $_POST['necessidadeMentoria'];
        $publicoAlvo = $_POST['publicoAlvo'];
        $canais = $_POST['canais'];
        $conteudos = $_POST['conteudos'];
        $experienciaEquipe = $_POST['experienciaEquipe'];
        $totalPessoas = $_POST['totalPessoas'];
        $escalaConhecimento = $_POST['escalaConhecimento'];
        $focoTemas = $_POST['focoTemas'];
        $focoTemas = trim($focoTemas);
        $formato = $_POST['formato'];
        
        $retorno = $class->gravaSolicitacao($matricula, $nome, $email, $dependencia, $necessidade, $publicoAlvo, $canais, $conteudos, $experienciaEquipe, $totalPessoas, $escalaConhecimento, $focoTemas, $formato);
        echo $retorno;
    break;

    case "consultaRegistro":
        $matricula = $_POST['matricula'];
        $retorno = $class->consultaRegistro($matricula);
        echo $retorno;
    break;
}
?>