<?php

session_start();

if($_SESSION["matricula"] == ""){
    header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=https://cad.bb.com.br/solicitacoes/#login/");
}

$mat = strtolower($_SESSION['matricula']);

include "../class/class_solicitacoes.php";

$class = new funcoes();

$request = $_REQUEST["request"];

switch($request){

    case "consultaSolicitacoes":
        $retorno = $class->consultaSolicitacoes();
        echo json_encode($retorno);
    break;

    case "filtrarSolicitacoes":
        $camposSelecionados = $_POST['camposSelecionados'];
        $retorno = $class->filtrarSolicitacoes($camposSelecionados);
        echo json_encode($retorno);
    break;

    case "filtrarSolicitacoesVisaoGestor":
        $camposSelecionados = $_POST['camposSelecionados'];
        $retorno = $class->filtrarSolicitacoesVisaoGestor($camposSelecionados);
        echo json_encode($retorno);
    break;

    case "montaFormulario":
        $opcaoSelecionada = $_POST['opcaoSelecionada'];
        $retorno = $class->montaFormulario($opcaoSelecionada);
        echo json_encode($retorno);
    break;

    case "gravaJornadaTranascional":
        $temaProduto = $_POST['temaProduto'];
        $canalTransacao = $_POST['canalTransacao'];
        $assuntoTransacao = $_POST['assuntoTransacao'];
        $objetivoTransacao = $_POST['objetivoTransacao'];
        $canaisExistentes = $_POST['canaisExistentes'];
        $publicoAlvo = $_POST['publicoAlvo'];
        $metricaSucesso = $_POST['metricaSucesso'];
        $acompanhamentoMetrica = $_POST['acompanhamentoMetrica'];
        $resultadoProjetado = $_POST['resultadoProjetado'];
        $estimuloConsumoTransacao = $_POST['estimuloConsumoTransacao'];
        $raOuRegulatorio = $_POST['raOuRegulatorio'];
        $especificoWhatsapp = $_POST['especificoWhatsapp'];
        $tipoSolicitacao = $_POST['tipoSolicitacao'];
        
        $retorno = $class->gravaJornadaTranascional($tipoSolicitacao, $temaProduto, $canalTransacao, $assuntoTransacao, $objetivoTransacao, $canaisExistentes, $publicoAlvo, $metricaSucesso, $acompanhamentoMetrica, $resultadoProjetado, $estimuloConsumoTransacao, $raOuRegulatorio, $especificoWhatsapp);
        echo json_encode($retorno);
    break;
    
    case "gravaJornadaInformacional":
        $canalTransacao = $_POST['canalTransacao'];
        $atendeRa = $_POST['atendeRa'];
        $especificoWhatsapp = $_POST['especificoWhatsapp'];
        $assuntoJornada = $_POST['assuntoJornada'];
        $objetivoTransacao = $_POST['objetivoTransacao'];
        $metricaSucesso = $_POST['metricaSucesso'];
        $resultadoProjetado = $_POST['resultadoProjetado'];
        $acompanhamentoMetrica = $_POST['acompanhamentoMetrica'];
        $estimuloConsumoTransacao = $_POST['estimuloConsumoTransacao'];
        $tipoSolicitacao = $_POST['tipoSolicitacao'];
        
        $retorno = $class->gravaJornadaInformacional($canalTransacao, $atendeRa, $especificoWhatsapp, $assuntoJornada, $objetivoTransacao, $metricaSucesso, $resultadoProjetado, $acompanhamentoMetrica, $estimuloConsumoTransacao, $tipoSolicitacao);
        echo json_encode($retorno);
    break;

    case "montaTabelaAcompanhamentoVisaoGestor":
        $retorno = $class->montaTabelaAcompanhamentoVisaoGestor($_SESSION['dependencia']);
        echo json_encode($retorno);
    break;
}
?>