<?php
// header('Access-Control-Allow-Origin: https://cad.bb.com.br');
ini_set("display_errors", E_ALL);
session_start();

// include_once $_SERVER["DOCUMENT_ROOT"]."/lib/login/login.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();

$primeiroCaractereMatricula = substr($_SESSION['matricula'], 0, 1);
$cargo = $_SESSION['cargo'];

if(($_SESSION['matricula']) == 'F0285739'){
    ($_SESSION['matricula']) = 'Z0285739'
}

if($primeiroCaractereMatricula <> 'F'){
    $cargo = '';
}
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $cargo, $_SESSION['MAIL'], $_SESSION['dependencia'], 'Hotsite', $_SESSION['ip']);


require_once $_SERVER["DOCUMENT_ROOT"]."/formacao-bots/home.php";
?>