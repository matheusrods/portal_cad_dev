<?php

if(!isset($_SESSION)){
    session_start();
}

if($_SESSION["nome"] == ""){
    header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=https://cad.bb.com.br/#login/");
}

//ini_set("display_errors", E_ALL);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/solicitacoes_Yasmin/class/class_solicitacoesYasmin.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Solicitações', $_SESSION['ip']);

?>

<!-- CSS específico do app -->
<link href="/lib/apps/solicitacoes_Yasmin/css/solicitacoes.css" rel="stylesheet">
<!-- JS específico do app -->
<script type="text/javascript" src="/lib/apps/solicitacoes_Yasmin/js/solicitacoes.js"></script>

<div id="paginaSolicitacoes">
    <?php
        if($_SESSION['dependencia'] == '19011'){
            include_once 'solicitacoes_visaoCad.php';
        } else {
            include_once 'solicitacoes_visaoGestor.php';
        }
    ?>
</div>

<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php";