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

    case "acessaDetalheSolicitacao":
        $idSolicitacao = $_POST['idSolicitacao'];
        $retorno = $class->acessaDetalheSolicitacao($idSolicitacao);
        echo json_encode($retorno);
    break;    

    case "acessaDetalheSolicitacaoVisaoCad":
        $idSolicitacao = $_POST['idSolicitacao'];
        $retorno = $class->acessaDetalheSolicitacaoVisaoCad($idSolicitacao);
        echo json_encode($retorno);
    break;    

    case "enviaPerguntasIa":
        $solicitacaoIncluida = $_POST['solicitacaoIncluida'];
        $retorno = $class->enviaPerguntasIa($solicitacaoIncluida);
        echo json_encode($retorno);
    break;

    case "gravarRespostaIa":
        $solicitacaoIncluida = $_POST['solicitacaoIncluida'];
        $respostaIa = $_POST['respostaIa'];
        $tipoJornada = $_POST['tipoJornada'];
        $retorno = $class->gravarRespostaIa($solicitacaoIncluida, $respostaIa, $tipoJornada);
        echo json_encode($retorno);
    break;

    case "escolhePaginaGestorOuCad":
        $paginaEscolhida = $_POST['paginaEscolhida'];
        $retorno = $class->escolhePaginaGestorOuCad($paginaEscolhida);
        echo json_encode($retorno);
    break;

    case "gravarComentario":
        $idSolicitacao = $_POST['idSolicitacao'];
        $comentario = $_POST['comentario'];
        $retorno = $class->gravarComentario($idSolicitacao, $comentario);
        echo json_encode($retorno);
    break;

    case "consultaComentarios":
        $idSolicitacao = $_POST['idSolicitacao'];
        $retorno = $class->consultaComentarios($idSolicitacao);
        echo json_encode($retorno);
    break;

    case "alteraStatusSolicitacao":
        $idSolicitacao = $_POST['idSolicitacao'];
        $novoStatus = $_POST['novoStatus'];
        $retorno = $class->alteraStatusSolicitacao($idSolicitacao, $novoStatus);
        echo json_encode($retorno);
    break;

    case "contaQtdeNotificacoesGestor":
        $prefixo = $_SESSION['dependencia'];
        $retorno = $class->contaQtdeNotificacoesGestor($prefixo);
        echo json_encode($retorno);
    break;

    case "limpaNotificacaoVisaoGestor":
        $idSolicitacao = $_POST['idSolicitacao'];
        $retorno = $class->limpaNotificacaoVisaoGestor($idSolicitacao);
        echo json_encode($retorno);
    break;

    case "gravaParecerFinal":
        $idSolicitacao = $_POST['idSolicitacao'];
        $textoParecerFinal = $_POST['textoParecerFinal'];
        $retorno = $class->gravaParecerFinal($idSolicitacao, $textoParecerFinal);
        echo json_encode($retorno);
    break;

    case "editaRespostasVisaoGestor":
        $idSolicitacao = $_POST['idSolicitacao'];
        $tipoJornada = $_POST['tipoJornada'];
        $canalTransacao = $_POST['canalTransacao'];
        $atendeRa = $_POST['atendeRa'];
        $especificoWhatsapp = $_POST['especificoWhatsapp'];
        $assuntoJornada = $_POST['assuntoJornada'];
        $objetivoJornada = $_POST['objetivoJornada'];
        $metricaSucesso = $_POST['metricaSucesso'];
        $resultadoProjetado = $_POST['resultadoProjetado'];
        $acompanhamentoMetrica = $_POST['acompanhamentoMetrica'];
        $estimuloConsumoTransacao = $_POST['estimuloConsumoTransacao'];
        $publicoAlvo = $_POST['publicoAlvo'];
        $canaisTransacoesExiste = $_POST['canaisTransacoesExiste'];

        $retorno = $class->editaRespostasVisaoGestor(
            $idSolicitacao, $tipoJornada, $canalTransacao, 
            $atendeRa, $especificoWhatsapp, 
            $assuntoJornada, $objetivoJornada, 
            $metricaSucesso, $resultadoProjetado, 
            $acompanhamentoMetrica, $estimuloConsumoTransacao, 
            $publicoAlvo, $canaisTransacoesExiste
        );
        echo json_encode($retorno);
    break;

    case "contaNovasSolicitacoes":
        $retorno = $class->contaNovasSolicitacoes();
        echo json_encode($retorno);
    break;

    case "consultaAnaliseManualIa":
        $idSolicitacao = $_POST['idSolicitacao'];
        $retorno = $class->consultaAnaliseManualIa($idSolicitacao);
        echo json_encode($retorno);
    break;

    case "enviarEmail":
        $idSolicitacao = $_POST['idSolicitacao'];
        $retorno = $class->enviarEmail($idSolicitacao);
        echo json_encode($retorno);
    break;

    case "disparaEmailDemandante":
        $idSolicitacao = $_POST['idSolicitacao'];
        $retorno = $class->disparaEmailDemandante($idSolicitacao);
        echo json_encode($retorno);
    break;
}
?>