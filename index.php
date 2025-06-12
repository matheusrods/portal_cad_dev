<?php
// ini_set('display_errors', 1);

session_start();

$_SESSION['matricula'] ='F0285739';
$_SESSION['nome'] = 'Matheus Rodrigues';
$_SESSION['cargo'] = 'Analista Tec Pleno';
$_SESSION['MAIL'] = 'albert.rosa@bb.com.br';
$_SESSION['dependencia'] = '1901';
$_SESSION['ip'] = '10.10.10.10';

// if($_SESSION["nome"] == ""){
//     // header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=https://cad.desenv.bb.com.br/#login/");
// }

// include_once $_SERVER["DOCUMENT_ROOT"]."/lib/login/login.php";
// require_once $_SERVER["DOCUMENT_ROOT"]."/lib/class/gravaLogAcesso.php";
// echo $_SERVER["DOCUMENT_ROOT"];
// // print_r($_SERVER);
// if (!class_exists('gravaLogAcesso')) {
//     $class = new gravaLogAcesso();
//     $gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Index Dev', $_SESSION['ip']);
// }

// Consulta na tabela cad.desenvolvedores se a matrícula está cadastrada como desenvolvedor
// $dbDev = new Database("cad");
// $queryDev = "SELECT * FROM cad.desenvolvedores WHERE matricula = '".$_SESSION['matricula']."' AND ativo = 1;";
// $execQueryDev = $dbDev->DbGetAll($queryDev);

// Caso esteja, carrega a home de desenvolvimento
// Caso não esteja, direciona para o Portal do CAD em produção
// if(sizeof($execQueryDev) > 0){
// } 

include_once $_SERVER["DOCUMENT_ROOT"].'/pages/home.php';    
// else {
//     header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=https://cad.bb.com.br/#login/");
// }






