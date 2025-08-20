<?php

if(!isset($_SESSION)){
    session_start();
}

if($_SESSION["nome"] == ""){
    header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=https://cad.bb.com.br/#login/");
}

//ini_set("display_errors", E_ALL);
//require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/solicitacoes_Yasmin/class/class_solicitacoesYasmin.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'RefinamentoTecnico', $_SESSION['ip']);

?>

<!-- CSS específico do app -->
<link href="/lib/apps/refinamentoTecnico/css/refinamentoTecnico.css" rel="stylesheet">
<!-- JS específico do app -->
<script type="text/javascript" src="/lib/apps/refinamentoTecnico/js/refinamentoTecnico.js"></script>

<div id="paginarefinamentoTecnico">
    <?php
        include_once 'refinamentoTecnico_visaoGestor.php';
    ?>
</div>

<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php";