<?php
// ini_set('display_errors', 1);

session_start();
// include_once $_SERVER["DOCUMENT_ROOT"]."/lib/login/login.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/lib/class/gravaLogAcesso.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Utils/Ambiente.php";

$_SESSION['matricula'] ='F0285739';
$_SESSION['nome'] = 'Albert Ferreira Rosa';
$_SESSION['cargo'] = 'Analista Tec Pleno';
$_SESSION['MAIL'] = 'albert.rosa@bb.com.br';
$_SESSION['dependencia'] = '1901';
$_SESSION['ip'] = '10.10.10.10';

// if($_SESSION["nome"] == ""){
//     header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=" . getBaseUrl() . "/#login/");
// }

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Index Dev', $_SESSION['ip']);

// Consulta na tabela cad.desenvolvedores se a matrícula está cadastrada como desenvolvedor
$dbDev = new Database("cad");
$queryDev = "SELECT * FROM cad.desenvolvedores WHERE matricula = '".$_SESSION['matricula']."' AND ativo = 1;";
$execQueryDev = $dbDev->DbGetAll($queryDev);

if(sizeof($execQueryDev) > 0){
    echo '<script>
        const BASE_URL = "' . getBaseUrl() . '";
        const AMBIENTE = "' . getAmbiente() . '";
    </script>';
    include_once $_SERVER["DOCUMENT_ROOT"].'/lib/apps/home/app/home.php';
} else {
    // header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=" . getBaseUrl() . "/#login/");
}

include_once $_SERVER["DOCUMENT_ROOT"] . "/Utils/modal-sr-pitaco/pitaco-loader.php";