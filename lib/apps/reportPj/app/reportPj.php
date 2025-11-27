<?php

if(!isset($_SESSION)){
    session_start();
}

// include_once $_SERVER["DOCUMENT_ROOT"]."/lib/login/login.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/lib/class/gravaLogAcesso.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Utils/Ambiente.php";

if($_SESSION["nome"] == ""){
    // header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=" . getBaseUrl() . "/tom_v2/#login/");
}

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Report PJ', $_SESSION['ip']);

?>

<div class="containerReportPj" style="width: 100%; background-size: contain; background-repeat: round; ">
    <img src="/lib/apps/reportPf/img/reportPJ.svg" style="width: 100%;" />
</div>

<?php include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php"; ?>