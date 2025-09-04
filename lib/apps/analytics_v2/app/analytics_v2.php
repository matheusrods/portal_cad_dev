<?php

if(!isset($_SESSION)){
    session_start();
}

//ini_set("display_errors", E_ALL);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/analytics_v2/class/class_paineis.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();

$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Analytics', $_SESSION['ip']);

$class = new funcoes();
$tags = $class->consultaTags();
$paineis = $class->consultaPaineis();

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
// $dia = strftime('%d', strtotime('today -1 day'));
// $mes = strftime('%B', strtotime('today -1 day'));
// $numeroMes = strftime('%m', strtotime('today -1 day'));
// $ano = strftime('%Y', strtotime('today -1 day'));

$date = new DateTime('yesterday');
$diaInicio = $date->format('d');
$diaFim = $date->format('d');
$mes = $date->format('F');
$numeroMes = $date->format('m');
$ano = $date->format('Y');
$dataInicio = $ano.'-'.$numeroMes.'-'.$diaInicio;
$dataFim = $ano.'-'.$numeroMes.'-'.$diaFim;




$meses = [
    'January' => 'Janeiro',
    'February' => 'Fevereiro',
    'March' => 'MARÇO',
    'April' => 'Abril',
    'May' => 'Maio',
    'June' => 'Junho',
    'July' => 'Julho',
    'August' => 'Agosto',
    'September' => 'Setembro',
    'October' => 'Outubro',
    'November' => 'Novembro',
    'December' => 'Dezembro'
];

//$mesEmPortugues = strtoupper($meses[$mes]);

$consultaGrandesNumerosPf = $class->consultaGrandesNumerosPf($dataInicio, $dataFim);
$consultaGrandesNumerosPj = $class->consultaGrandesNumerosPj($dataInicio, $dataFim);
$consultaNumerosAcumulados = $class->consultaNumerosAcumulados($dataInicio, $dataFim);



// echo "<pre>";
// print_r($consultaGrandesNumerosPf);
// echo "</pre>";

// die;

echo '
    <script type="text/javascript">
        // Realiza o efeito de descer os dados resumidos onde o mouse está apontando
        $(".efeitoAnalytics").on("mouseenter",function() {
            var idInfo = $(this).attr("attr-idInfo");
            $(".resumoNumerosAnalytics"+idInfo).addClass("efeitoAnalyticsEfeitos");
        });

        // Realiza o efeito de subir novamente os dados resumidos onde o mouse estava apontando
        $(".efeitoAnalytics").on("mouseleave",function() {
            var idInfo = $(this).attr("attr-idInfo");
            $(".resumoNumerosAnalytics"+idInfo).removeClass("efeitoAnalyticsEfeitos");
            $(".resumoNumerosAnalytics"+idInfo).addClass("efeitoAnalyticsEfeitoSobe");
            setTimeout(function () {
                $(".resumoNumerosAnalytics"+idInfo).removeClass("efeitoAnalyticsEfeitoSobe");
            }, 400);
        });
    </script>
';

echo '<!-- CSS específico do app --><link href="/lib/apps/analytics_v2/css/analytics_V2.css" rel="stylesheet">';
echo '<!-- JS específico do app --><script type="text/javascript" src="/lib/apps/analytics_v2/js/analytics.js"></script>';
//echo '<!-- JS específico do app --><script type="text/javascript" src="/lib/apps/analytics_v2/js/analytics_V2.js"></script>';

$grandesNumerosErro = '
    <div class="efeitoAnalytics dadosTodosQuadros dadosLinha1 dadosColuna1 divDesabilitada" attr-idInfo="1">
        <div class="resumoNumerosAnalytics1 dadosTodosQuadros overflowQuadroInterno" style="border-top-left-radius: 100px; background: #00FFE0; z-index: 2;">
            <img style="width: 176px; height: 144.72px; top: 70.64px; position: absolute" src="/lib/img/apps/analytics/1.png" />
            <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word;">0<br/></span>
                <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word;">interações</span>
            </div>
        </div>
    </div>
    <div class="efeitoAnalytics dadosTodosQuadros dadosLinha1 dadosColuna2 divDesabilitada" attr-idInfo="2">
        <div class="resumoNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; background: #00FFE0; z-index: 2;">
            <img style="width: 176px; height: 144.72px; top: 70.64px; position: absolute" src="/lib/img/apps/analytics/2.png" />
            <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">usuários</span>
            </div>
        </div>
    </div>
    <div class="efeitoAnalytics dadosTodosQuadros dadosLinha1 dadosColuna3 divDesabilitada" attr-idInfo="3">
        <div class="resumoNumerosAnalytics3 dadosTodosQuadros overflowQuadroInterno" style="border-top-left-radius: 100px; border-top-right-radius: 100px; background: #00FFE0; z-index: 2;">
            <img style="width: 176px; height: 144.72px; top: 70.64px; position: absolute" src="/lib/img/apps/analytics/3.png" />
            <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">conversas</span>
            </div>
        </div>
    </div>
    <div class="efeitoAnalytics dadosTodosQuadros dadosLinha2 dadosColuna1 divDesabilitada" attr-idInfo="4">
        <div class="resumoNumerosAnalytics4 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-right-radius: 100px; background: #00FFFF; z-index: 2;">
            <img style="width: 161px; height: 147px; /*left: 147.50px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/4.png" />
            <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Sem valores de nota<br/></span>
                <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">na avaliação dos usuários</span>
            </div>
        </div>
    </div>
    <div class="efeitoAnalytics dadosTodosQuadros dadosLinha2 dadosColuna2 divDesabilitada" attr-idInfo="5">
        <div class="resumoNumerosAnalytics5 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-left-radius: 100px; background: #EFF0A7; z-index: 2;">
            <img style="width: 133px; height: 154px; /*left: 147.50px;*/ top: 71px; position: absolute;" src="/lib/img/apps/analytics/5.png" />
            <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">ativos enviados</span>
            </div>
        </div>
    </div>
    <div class="efeitoAnalytics dadosTodosQuadros dadosLinha2 dadosColuna3 divDesabilitada" attr-idInfo="6">
        <div class="resumoNumerosAnalytics6 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-left-radius: 100px; background: #F0A7AB; z-index: 2;">
            <img style="width: 133px; height: 154px; top: 71px; position: absolute" src="/lib/img/apps/analytics/6.png" />
            <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">indisponibilidades</span>
            </div>
        </div>
    </div>
    <div class="efeitoAnalytics dadosTodosQuadros dadosLinha3 dadosColuna1 divDesabilitada" attr-idInfo="7">
        <div class="resumoNumerosAnalytics7 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-left-radius: 100px; border-top-right-radius: 100px; background: #CBA7F0; z-index: 2;">
            <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/7.png" />
            <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em acordos RAO</span>
            </div>
        </div>
    </div>
    <div class="efeitoAnalytics dadosTodosQuadros dadosLinha3 dadosColuna2 divDesabilitada" attr-idInfo="8">
        <div class="resumoNumerosAnalytics8 dadosTodosQuadros overflowQuadroInterno" style="border-top-left-radius: 100px; background: #CBA7F0; z-index: 2;">
            <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/8.png" />
            <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em Ativos S/A</span>
            </div>
        </div>
    </div>
    <div class="efeitoAnalytics dadosTodosQuadros dadosLinha3 dadosColuna3 divDesabilitada" attr-idInfo="9">
        <div class="resumoNumerosAnalytics9 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-right-radius: 100px; background: #CBA7F0; z-index: 2;">
            <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/9.png" />
            <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em CDC</span>
            </div>
        </div>
    </div>

    <div class="efeitoAnalytics dadosTodosQuadros dadosLinha4 dadosColuna1 divDesabilitada" attr-idInfo="10">
        <div class="resumoNumerosAnalytics10 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-right-radius: 100px; border-top-left-radius: 100px; background: #CBA7F0; z-index: 2;">
            <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/7.png" />
            <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em Agro</span>
            </div>
        </div>
    </div>
    <div class="efeitoAnalytics dadosTodosQuadros dadosLinha4 dadosColuna2 divDesabilitada" attr-idInfo="11">
        <div class="resumoNumerosAnalytics11 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-left-radius: 100px; background: #CBA7F0; z-index: 2;">
            <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/8.png" />
            <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em Investimentos</span>
            </div>
        </div>
    </div>
    <div class="efeitoAnalytics dadosTodosQuadros dadosLinha4 dadosColuna3 divDesabilitada" attr-idInfo="12">
        <div class="resumoNumerosAnalytics12 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-right-radius: 100px; background: #CBA7F0; z-index: 2;">
            <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/9.png" />
            <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em Seguridade</span>
            </div>
        </div>
    </div>

    


    
';

if($consultaGrandesNumerosPf['status'] == 0){
    $dadosGrandesNumerosPf = '<div class="erroGrandesNumeros" style="background:#002D4B; margin-top: 5%;">'.$consultaGrandesNumerosPf['mensagem'].'</div>'.$grandesNumerosErro;
} else {
    
    if(($consultaGrandesNumerosPf['mensagem'][0]['interacoesPf']) >= '1000000'){
        $textoInteracoesPf = 'de interações';
    } else {
        $textoInteracoesPf = 'interações';
    }

    if(($consultaGrandesNumerosPf['mensagem'][0]['usuariosPf']) >= '1000000'){
        $textoUsuariosPf = 'de usuários';
    } else {
        $textoUsuariosPf = 'usuários';
    }

    if(($consultaGrandesNumerosPf['mensagem'][0]['totalIndisp']) == 1){
        $textoIndisponibilidadePf = 'indisponibilidade';
    } else {
        $textoIndisponibilidadePf = 'indisponibilidades';
    }

    if(($consultaGrandesNumerosPf['mensagem'][0]['totalIndisp']) == 0){
        $textoPlural = "";
        $textoDetalhadoIndisponibilidadePfLinha1 = 'Uhu!<br>';
        if($consultaGrandesNumerosPf['mensagem'][0]['maxDataFim'] > 1){
            $textoPlural = "s";
        }
        $textoDetalhadoIndisponibilidadePf = 'Estamos há '.$consultaGrandesNumerosPf['mensagem'][0]['maxDataFim'].' dia'.$textoPlural.' sem indisponibilidade'.$textoPlural.'.';
    } else {
        $textoPlural = "";
        if(($consultaGrandesNumerosPf['mensagem'][0]['totalIndisp']) > 1){
            $textoPlural = "s";
        }
        $textoDetalhadoIndisponibilidadePfLinha1 = 'Indisponibilidade'.$textoPlural.' em '.$consultaGrandesNumerosPf['mensagem'][0]['dataFormatada'].':';
        
        
        $textoDetalhadoIndisponibilidadePf = $consultaGrandesNumerosPf['mensagem'][0]['textoIndisp'];
    }
    
    if($dataInicio != $dataFim){
        $textoMedia = 'Média Período: ';
        $mediaUsuarioPf = 'mediaUsuariosPf';
        $mediaConversasPf = 'mediaConversasPf';
        $textoNotaMedia = 'Média Período:';
        $mediaInteracao = 'mediaInteracoesPf';
        $notaMedia = 'notaMediaPf';
        $mediaQtdAvaliacao = 'qtdMediaAvaliacoesPf';
        $mediaAtivos = 'mediaAtivosEnviados';
    } else {
        $textoMedia = 'Média 30 dias: ';
        $mediaUsuarioPf = 'usuariosPfD30';
        $mediaConversasPf = 'conversasPfD30';
        $mediaInteracao = 'interacoesPfD30';
        $textoMediaNota30d = 'Média 30 dias: ';
        $MediaNota30d = 'notaMediaPfD30';
        $textoNotaMedia = 'Nota Avaliação do dia '.$diaFim;
        $notaMedia = 'notaMediaPf';
        $mediaQtdAvaliacao = 'qtdMediaAvaliacoesPfD30';
        $mediaAtivos = 'ativosEnviadosD30';
    }

    $dadosGrandesNumerosPf = '
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha1 dadosColuna1" attr-idInfo="1">
            <div class="resumoNumerosAnalytics1 dadosTodosQuadros overflowQuadroInterno" style="border-top-left-radius: 100px; background: #00FFE0; z-index: 2;">
                <img style="width: 176px; height: 144.72px; top: 70.64px; position: absolute" src="/lib/img/apps/analytics/1.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word;">'.$class->formataExibicao($consultaGrandesNumerosPf['mensagem'][0]['interacoesPf']).'<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word;">'.$textoInteracoesPf.'</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics1 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Interações:<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['interacoesPf'],0,",",".").'<br/><br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">'.$textoMedia.'<br> </span>
                    <span class="" style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0][$mediaInteracao],0,",",".").'<br/></span>
                    <!--<span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                    <span class="mediaSete"style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['interacoesPfD7'],0,",",".").'</span>-->
                </div>
                <img class="imagemDetalhesAnalytics" style="width: 176px; height: 144.72px; top: 250px; position: absolute" src="/lib/img/apps/analytics/1_alt.png" />
            </div>
        </div>
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha1 dadosColuna2" attr-idInfo="2">
            <div class="resumoNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; background: #00FFE0; z-index: 2;">
                <img style="width: 176px; height: 144.72px; top: 70.64px; position: absolute" src="/lib/img/apps/analytics/2.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$class->formataExibicao($consultaGrandesNumerosPf['mensagem'][0]['usuariosPf']).'<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$textoUsuariosPf.'</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Usuários:<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['usuariosPf'],0,",",".").'<br/><br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">'.$textoMedia.'<br> </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0][$mediaUsuarioPf],0,",",".").'<br/></span>
                    <!--<span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['usuariosPfD7'],0,",",".").'</span><br>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">90 Dias: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['usuariosPf90D'],0,",",".").'</span>-->
                </div>
                <img class="imagemDetalhesAnalytics" style="width: 176px; height: 144.72px; top: 255px; position: absolute" src="/lib/img/apps/analytics/2_alt.png" />
            </div>
        </div>
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha1 dadosColuna3" attr-idInfo="3">
            <div class="resumoNumerosAnalytics3 dadosTodosQuadros overflowQuadroInterno" style="border-top-left-radius: 100px; border-top-right-radius: 100px; background: #00FFE0; z-index: 2;">
                <img style="width: 176px; height: 144.72px; top: 70.64px; position: absolute" src="/lib/img/apps/analytics/3.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$class->formataExibicao($consultaGrandesNumerosPf['mensagem'][0]['conversasPf']).'<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.(($consultaGrandesNumerosPf['mensagem'][0]['conversasPf'] > 999999) ? "de " : "" ).'conversas</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics3 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Conversas:<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['conversasPf'],0,",",".").'<br/><br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">'.$textoMedia.'</span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0][$mediaConversasPf],0,",",".").'<br/>
                </div>
                <img class="imagemDetalhesAnalytics" style="width: 176px; height: 144.72px; top: 250px; position: absolute" src="/lib/img/apps/analytics/3_alt.png" />
            </div>
        </div>
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha2 dadosColuna1" attr-idInfo="4">
            <div class="resumoNumerosAnalytics4 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-right-radius: 100px; background: #00FFFF; z-index: 2;">
                <img style="width: 161px; height: 147px; /*left: 147.50px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/4.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$consultaGrandesNumerosPf['mensagem'][0][$notaMedia].' de nota<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">na avaliação dos usuários</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics4 dadosTodosQuadros overflowQuadroInterno" z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br>'.$textoNotaMedia.'<br></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPf['mensagem'][0][$notaMedia].'<br><br></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Qtd. Avaliações: <br></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['qtdAvaliacaoPf'],0,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">'.$textoMedia.'<br> </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0][$mediaQtdAvaliacao],0,",",".").'<br/></span>
                </div>
                <!--<img class="imagemDetalhesAnalytics iconeResponsivo" style="width: 133px; height: 133px; top: 255px; position: absolute" src="/lib/img/apps/analytics/4_alt.png" />-->
            </div>
        </div>
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha2 dadosColuna2" attr-idInfo="5">
            <div class="resumoNumerosAnalytics5 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-left-radius: 100px; background: #EFF0A7; z-index: 2;">
                <img style="width: 133px; height: 154px; /*left: 147.50px;*/ top: 71px; position: absolute;" src="/lib/img/apps/analytics/5.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$class->formataExibicao($consultaGrandesNumerosPf['mensagem'][0]['totalAtivosEnviados']).'<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">ativos enviados</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics5 dadosTodosQuadros overflowQuadroInterno" style="z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Ativos Enviados: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['totalAtivosEnviados'],0,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Principais Ativos:<br/>'.number_format($consultaGrandesNumerosPf['mensagem'][0]['qtdEnviada1'],0,",",".").':</span>
                    <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word"> '.$consultaGrandesNumerosPf['mensagem'][0]['nomeAtivo1'].'<br/></span>
                    <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['qtdEnviada2'],0,",",".").':</span>
                    <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word"> '.$consultaGrandesNumerosPf['mensagem'][0]['nomeAtivo2'].'<br/></span>
                    <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['qtdEnviada3'],0,",",".").':</span>
                    <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word"> '.$consultaGrandesNumerosPf['mensagem'][0]['nomeAtivo3'].'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">'.$textoMedia.'<br></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0][$mediaAtivos],0,",",".").'<br/></span>
                </div>
                <img class="imagemDetalhesAnalytics iconeResponsivo" style="width: 133px; height: 154px; top: 241px; position: absolute; display: none;" src="/lib/img/apps/analytics/5_alt.png" />
            </div>
        </div>
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha2 dadosColuna3" attr-idInfo="6">
            <div class="resumoNumerosAnalytics6 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-left-radius: 100px; background: #F0A7AB; z-index: 2;">
                <img style="width: 133px; height: 154px; top: 71px; position: absolute" src="/lib/img/apps/analytics/6.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word; letter-spacing: 0px !important;">'.$consultaGrandesNumerosPf['mensagem'][0]['totalIndisp'].'<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$textoIndisponibilidadePf.'</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-left-radius: 100px; z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <a href="https://pwbi.intranet.bb.com.br/reports/powerbi/PAINEL%20DE%20METRICAS/CAD/Painel%20Incidentes" target="_blank" style="color: #AAD8FF;">
                        <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">'.$textoDetalhadoIndisponibilidadePfLinha1.'<br/></span>
                        <!-- <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$textoDetalhadoIndisponibilidadePf.'</span> -->
                        <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">Para consultar as indisponibilidades, clique <a href="https://pwbi.intranet.bb.com.br/reports/powerbi/PAINEL%20DE%20METRICAS/CAD/Painel%20Incidentes?rs:embed=true" target="_blank" style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">aqui</a></span>
                    </a>
                </div>
                <img class="imagemDetalhesAnalytics" style="width: 133px; height: 154px; top: 241px; position: absolute" src="/lib/img/apps/analytics/6_alt.png" />
            </div>
        </div>
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha3 dadosColuna1" attr-idInfo="7">
            <div class="resumoNumerosAnalytics7 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-left-radius: 100px; border-top-right-radius: 100px; background: #CBA7F0; z-index: 2;">
                <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/7.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                <span style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word;letter-spacing: -2px;">R$</span>
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$class->formataExibicao($consultaGrandesNumerosPf['mensagem'][0]['totalRao']).'<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em acordos RAO</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ '.number_format($consultaGrandesNumerosPf['mensagem'][0]['totalRao'],2,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPf['mensagem'][0]['qtdRao'].' Acordos</span>
                </div>
                <img class="imagemDetalhesAnalytics" style="width: 136px; height: 146px; /*left: 167px;*/ top: 248px; position: absolute" src="/lib/img/apps/analytics/7_alt.png" />
            </div>
        </div>
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha3 dadosColuna2" attr-idInfo="8">
            <div class="resumoNumerosAnalytics8 dadosTodosQuadros overflowQuadroInterno" style="border-top-left-radius: 100px; background: #CBA7F0; z-index: 2;">
                <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/8.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word;letter-spacing: -2px;">R$</span>
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$class->formataExibicao($consultaGrandesNumerosPf['mensagem'][0]['totalAtivos']).'<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em Ativos S/A</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ '.number_format($consultaGrandesNumerosPf['mensagem'][0]['totalAtivos'],2,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPf['mensagem'][0]['qtdAtivos'].' Acordos</span></div>
                <img class="imagemDetalhesAnalytics" style="width: 136px; height: 146px; /*left: 167px;*/ top: 248px; position: absolute" src="/lib/img/apps/analytics/8_alt.png" />
            </div>
        </div>
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha3 dadosColuna3" attr-idInfo="9">
            <div class="resumoNumerosAnalytics9 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-right-radius: 100px; background: #CBA7F0; z-index: 2;">
                <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/9.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word;letter-spacing: -2px;">R$</span>
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$class->formataExibicao($consultaGrandesNumerosPf['mensagem'][0]['totalCdc']).'<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em CDC</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ '.number_format($consultaGrandesNumerosPf['mensagem'][0]['totalCdc'],2,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPf['mensagem'][0]['qtdCdc'].' Contratações</span>
                </div>
                <img class="imagemDetalhesAnalytics" style="width: 136px; height: 146px; /*left: 167px;*/ top: 248px; position: absolute" src="/lib/img/apps/analytics/9_alt.png" />
            </div>
        </div>
                

        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha4 dadosColuna1" attr-idInfo="10">
            <div class="resumoNumerosAnalytics10 dadosTodosQuadros overflowQuadroInterno" style="border-top-left-radius: 100px; border-bottom-right-radius: 100px; background: #CBA7F0; z-index: 2;">
                <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/7.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                <span style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word;letter-spacing: -2px;">R$</span>
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$class->formataExibicao($consultaGrandesNumerosPf['mensagem'][0]['totalAgro']).'<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em Agro</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">BB GIRO </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ '.number_format($consultaGrandesNumerosPf['mensagem'][0]['totalGiro'],2,",",".").'<br/></span><br>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">EMISSÃO - CPR </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ '.number_format($consultaGrandesNumerosPf['mensagem'][0]['totalCpr'],2,",",".").'<br/></span>
                </div>
                <img class="imagemDetalhesAnalytics" style="width: 136px; height: 146px; /*left: 167px;*/ top: 248px; position: absolute" src="/lib/img/apps/analytics/7_alt.png" />
            </div>
        </div>
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha4 dadosColuna2" attr-idInfo="11">
            <div class="resumoNumerosAnalytics11 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-left-radius: 100px; background: #CBA7F0; z-index: 2;">
                <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/8.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word;letter-spacing: -2px;">R$</span>
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$class->formataExibicao($consultaGrandesNumerosPf['mensagem'][0]['totalInvestimentos']).'<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em Investimento</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">BB LCA </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ '.number_format($consultaGrandesNumerosPf['mensagem'][0]['totalLca'],2,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Aplicação - Fundos </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ '.number_format($consultaGrandesNumerosPf['mensagem'][0]['totalFundos'],2,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Aplicação - TDR </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ '.number_format($consultaGrandesNumerosPf['mensagem'][0]['totalTdr'],2,",",".").'<br/></span>
                </div>
                    <img class="imagemDetalhesAnalytics" style="width: 136px; height: 146px; /*left: 167px;*/ top: 248px; position: absolute" src="/lib/img/apps/analytics/8_alt.png" />
            </div>
        </div>
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha4 dadosColuna3" attr-idInfo="12">
            <div class="resumoNumerosAnalytics12 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; background: #CBA7F0; z-index: 2;">
                <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/9.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word;letter-spacing: -2px;">R$</span>
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$class->formataExibicao($consultaGrandesNumerosPf['mensagem'][0]['totalSeguridade']).'<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em Seguridade</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Aporte Extra BrasilPrev </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ '.number_format($consultaGrandesNumerosPf['mensagem'][0]['totalBprev'],2,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Crédito Protegido Slip </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ '.number_format($consultaGrandesNumerosPf['mensagem'][0]['totalSlip'],2,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Seguro Prestamista </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ '.number_format($consultaGrandesNumerosPf['mensagem'][0]['totalPresta'],2,",",".").'<br/></span>
                </div>
                <img class="imagemDetalhesAnalytics" style="width: 136px; height: 146px; /*left: 167px;*/ top: 248px; position: absolute" src="/lib/img/apps/analytics/9_alt.png" />
            </div>
        </div>
        
    ';
}

if($consultaGrandesNumerosPj['status'] == 0){
    $dadosGrandesNumerosPj = '<div class="erroGrandesNumeros" style="background:#002D4B; margin-top: 5%;">'.$consultaGrandesNumerosPj['mensagem'].'</div>'.$grandesNumerosErro;
} else {
    if(($consultaGrandesNumerosPj['mensagem'][0]['interacoesPj']) >= '1000000'){
        $textoInteracoesPj = 'de interações';
    } else {
        $textoInteracoesPj = 'interações';
    }

    if(($consultaGrandesNumerosPj['mensagem'][0]['usuariosPj']) >= '1000000'){
        $textoUsuariosPj = 'de usuários';
    } else {
        $textoUsuariosPj = 'usuários';
    }

    if($dataInicio != $dataFim){
        $textoMedia = 'Média Período: ';
        $mediaInteracaoPj = 'mediaInteracoesPj';
        $mediaUsuariosPj = 'mediaUsuariosPj';
        $mediaConversasPj = 'mediaConversasPj';
        $notaMediaPj = 'notaMediaPj';
        $textoNotaMedia = 'Média Período:';
        $qtdMediaAvaliacaoPj = 'qtdMediaAvaliacoesPj';
    } else {
        $textoMedia = 'Média 30 dias: ';
        $mediaInteracaoPj = 'interacoesPjD30';
        $mediaUsuariosPj = 'usuariosPjD30';
        $mediaConversasPj = 'conversasPjD30';
        $notaMediaPj = 'notaMediaPj';
        $diaFim = date('d', strtotime($dataFim));
        $textoNotaMedia = 'Nota Avaliação do dia '.$diaFim;
        $qtdMediaAvaliacaoPj = 'qtdMediaAvaliacoesPj30d';
    }

    $dadosGrandesNumerosPj = '
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha1 dadosColuna1" attr-idInfo="1">
            <div class="resumoNumerosAnalytics1 dadosTodosQuadros overflowQuadroInterno" style="border-top-left-radius: 100px; background: #00FFE0; z-index: 2;">
                <img style="width: 176px; height: 144.72px; top: 70.64px; position: absolute" src="/lib/img/apps/analytics/1.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word;">'.$class->formataExibicao($consultaGrandesNumerosPj['mensagem'][0]['interacoesPj']).'<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word;">'.$textoInteracoesPj.'</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics1 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Interações:<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['interacoesPj'],0,",",".").'<br/><br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">'.$textoMedia.'<br></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0][$mediaInteracaoPj],0,",",".").'<br/></span>
                </div>
                <img class="imagemDetalhesAnalytics" style="width: 176px; height: 144.72px; top: 250px; position: absolute" src="/lib/img/apps/analytics/1_alt.png" />
            </div>
        </div> 
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha1 dadosColuna2" attr-idInfo="2">
            <div class="resumoNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; background: #00FFE0; z-index: 2;">
                <img style="width: 176px; height: 144.72px; top: 70.64px; position: absolute" src="/lib/img/apps/analytics/2.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$class->formataExibicao($consultaGrandesNumerosPj['mensagem'][0]['usuariosPj']).'<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$textoUsuariosPj.'</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Usuários:<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['usuariosPj'],0,",",".").'<br/><br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">'.$textoMedia.'<br></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0][$mediaUsuariosPj],0,",",".").'<br/></span>
                </div>
                <img class="imagemDetalhesAnalytics" style="width: 176px; height: 144.72px; top: 255px; position: absolute" src="/lib/img/apps/analytics/2_alt.png" />
            </div>
        </div>
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha1 dadosColuna3" attr-idInfo="3">
            <div class="resumoNumerosAnalytics3 dadosTodosQuadros overflowQuadroInterno" style="border-top-left-radius: 100px; border-top-right-radius: 100px; background: #00FFE0; z-index: 2;">
                <img style="width: 176px; height: 144.72px; top: 70.64px; position: absolute" src="/lib/img/apps/analytics/3.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$class->formataExibicao($consultaGrandesNumerosPj['mensagem'][0]['conversasPj']).'<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">conversas</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics3 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Conversas:<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['conversasPj'],0,",",".").'<br/><br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">'.$textoMedia.'<br></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0][$mediaConversasPj],0,",",".").'<br/>
                </div>
                <img class="imagemDetalhesAnalytics" style="width: 176px; height: 144.72px; top: 250px; position: absolute" src="/lib/img/apps/analytics/3_alt.png" />
            </div>
        </div>
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha2 dadosColuna1" attr-idInfo="4">
            <div class="resumoNumerosAnalytics4 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-right-radius: 100px; background: #00FFFF; z-index: 2;">
                <img style="width: 161px; height: 147px; /*left: 147.50px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/4.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$consultaGrandesNumerosPj['mensagem'][0][$notaMediaPj].' de nota<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">na avaliação dos usuários</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics4 dadosTodosQuadros overflowQuadroInterno" z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">'.$textoNotaMedia.'<br></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPj['mensagem'][0][$notaMediaPj].'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br>Qtd. Avaliações:</span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['qtdAvaliacoesPj'],0,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br>'.$textoMedia.'</span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0][$qtdMediaAvaliacaoPj],0,",",".").'<br/></span>
                </div>
                <img class="imagemDetalhesAnalytics iconeResponsivo" style="width: 133px; height: 133px; top: 255px; position: absolute" src="/lib/img/apps/analytics/4_alt.png" />
            </div>
        </div>
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha2 dadosColuna2 divDesabilitada" attr-idInfo="5">
            <div class="resumoNumerosAnalytics5 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-left-radius: 100px; background: #EFF0A7; z-index: 2;">
                <img style="width: 133px; height: 154px; /*left: 147.50px;*/ top: 71px; position: absolute;" src="/lib/img/apps/analytics/5.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">ativos enviados</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics5 dadosTodosQuadros overflowQuadroInterno" style="z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Ativos Enviados: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">214.266 <br/></span>
                    <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Principais Ativos:<br/>42.393:</span>
                    <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word"> ativo_compra_negada_limite_2<br/></span>
                    <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">28.610:</span>
                    <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word"> ativo_inducao_opf_para_credito<br/></span>
                    <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">21.676:</span>
                    <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word"> boas_vindas_whatsapp<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">347.192<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">234.118</span>
                </div>
                <img class="imagemDetalhesAnalytics iconeResponsivo" style="width: 133px; height: 154px; top: 241px; position: absolute" src="/lib/img/apps/analytics/5_alt.png" />
            </div>
        </div>
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha2 dadosColuna3 divDesabilitada" attr-idInfo="6">
            <div class="resumoNumerosAnalytics6 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-left-radius: 100px; background: #F0A7AB; z-index: 2;">
                <img style="width: 133px; height: 154px; top: 71px; position: absolute" src="/lib/img/apps/analytics/6.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">indisponibilidades</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Uhu!<br/><br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">Estamos há 50 dias <br/>sem indisponibilidades.</span>
                </div>
                <img class="imagemDetalhesAnalytics" style="width: 133px; height: 154px; top: 241px; position: absolute" src="/lib/img/apps/analytics/6_alt.png" />
            </div>
        </div>
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha3 dadosColuna1 divDesabilitada" attr-idInfo="7">
            <div class="resumoNumerosAnalytics7 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-left-radius: 100px; border-top-right-radius: 100px; background: #CBA7F0; z-index: 2;">
                <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/7.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em acordos RAO</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ 0<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">0 Acordos</span>
                </div>
                <img class="imagemDetalhesAnalytics" style="width: 136px; height: 146px; /*left: 167px;*/ top: 248px; position: absolute" src="/lib/img/apps/analytics/7_alt.png" />
            </div>
        </div>
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha3 dadosColuna2 divDesabilitada" attr-idInfo="8">
            <div class="resumoNumerosAnalytics8 dadosTodosQuadros overflowQuadroInterno" style="border-top-left-radius: 100px; background: #CBA7F0; z-index: 2;">
                <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/8.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em Ativos S/A</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ 0<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">0 Acordos</span></div>
                <img class="imagemDetalhesAnalytics" style="width: 136px; height: 146px; /*left: 167px;*/ top: 248px; position: absolute" src="/lib/img/apps/analytics/8_alt.png" />
            </div>
        </div>
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha3 dadosColuna3 divDesabilitada" attr-idInfo="9">
            <div class="resumoNumerosAnalytics9 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-right-radius: 100px; background: #CBA7F0; z-index: 2;">
                <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/9.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em CDC</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ 0<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">0 Contratações</span>
                </div>
                <img class="imagemDetalhesAnalytics" style="width: 136px; height: 146px; /*left: 167px;*/ top: 248px; position: absolute" src="/lib/img/apps/analytics/9_alt.png" />
            </div>
        </div>
    ';
}

if($consultaNumerosAcumulados['status'] == 0){
    $dadosNumerosAcumulados = '<div class="resumoAcumuladosTransacoesAnalytics" style="margin-left:12.5%; position: relative; background:#002D4B;"><div class="acumuladoRaoAnalytics" style="width: 100%; top: 1302px; position: absolute">'.$consultaNumerosAcumulados['mensagem'].'</div></div>';
} else {
    $dadosNumerosAcumulados = '
        <div class="resumoAcumuladosTransacoesAnalytics" style="margin-left:12.5%; position: relative;">
            <div class="acumuladoRaoAnalytics" style="width: 25%; top: 1302px; position: absolute">
                <img class="imgAcumuladoRaoAnalytics imgAcumulado" src="/lib/img/apps/analytics/1.svg">
                <div class="cabeçalhoTextoAcumuladoAnalytics" style="color: #00FFE0;">
                    '.$ano.'<br>Acumulado RAO
                </div>
                <div class="textoAcumuladoAnalytics">
                    <span class="span1AcumuladoAnalytics" style="color: #00FFE0;">
                        R$
                    </span>
                    <span class="span2AcumuladoAnalytics" style="color: #00FFE0;">
                        '.number_format($consultaNumerosAcumulados['mensagem'][0]['totalRao'],2,",",".").'
                    </span>
                </div>
            </div>
            <div class="acumuladoCdcAnalytics" style="width: 25%; left: 376px; top: 1302px; position: absolute">
                <img class="imgAcumuladoCdcAnalytics imgAcumulado" src="/lib/img/apps/analytics/2.svg" />
                <div class="cabeçalhoTextoAcumuladoAnalytics" style="color: #00FFFF;">
                    '.$ano.'<br/>Acumulado CDC
                </div>
                <div class="textoAcumuladoAnalytics">
                    <span class="span1AcumuladoAnalytics" style="color: #00FFFF;">
                        R$
                    </span>
                    <span class="span2AcumuladoAnalytics" style="color: #00FFFF;">
                        '.number_format($consultaNumerosAcumulados['mensagem'][0]['totalCdc'],2,",",".").'
                    </span>
                </div>
            </div>
            <div class="acumuladoTesouroAnalytics" style="width: 25%; height: 303px; top: 1600px; position: absolute">
                <img class="imgAcumuladoTesouroAnalytics imgAcumulado" src="/lib/img/apps/analytics/3.svg" />
                <div class="cabeçalhoTextoAcumuladoAnalytics" style="color: #EFF0A7;">
                    '.$ano.'<br/>Tesouro Direto
                </div>
                <div class="textoAcumuladoAnalytics">
                    <span class="span1AcumuladoAnalytics" style="color: #EFF0A7;">
                        R$
                    </span>
                    <span class="span2AcumuladoAnalytics" style="color: #EFF0A7;">
                        '.number_format($consultaNumerosAcumulados['mensagem'][0]['totalTesouro'],2,",",".").'
                    </span>
                </div>
            </div>
            <div class="acumuladoAgroAnalytics" style="width: 25%; height: 303px; left: 376px; top: 1600px; position: absolute">
                <img class="imgAcumuladoAgroAnalytics imgAcumulado" src="/lib/img/apps/analytics/4.svg" />
                <div class="cabeçalhoTextoAcumuladoAnalytics" style="color: #F0A7AB;">
                    '.$ano.'<br/>Acumulado Agro
                </div>
                <div class="textoAcumuladoAnalytics">
                    <span class="span1AcumuladoAnalytics" style="color: #F0A7AB;">
                        R$
                    </span>
                    <span class="span2AcumuladoAnalytics" style="color: #F0A7AB;">
                        '.number_format($consultaNumerosAcumulados['mensagem'][0]['totalAgro'],2,",",".").'
                    </span>
                </div>
            </div>
        </div>

        <div class="resumoDadosBotAnalytics" style="width: 30%; position: relative; display: flex; flex-wrap: wrap; flex-direction: column; top: 1302px; float: right; margin-right: 12.5%;">
            <div class="primeiraLinhaDadosAnalytics" style="width: 100%; margin-left: 7%;">
                <div class="dadosSubJornadasAnalytics" style="display: flex; flex-direction: column; float: left;">
                    <img style="width: 96%; " src="/lib/img/apps/analytics/imgSubJornadas.png">
                    <div style="width: 100%; flex-direction: column; justify-content: center; align-items: flex-start; display: inline-flex">
                        <div style="text-align: center; color: #EFEFEF; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">
                            8960
                        </div>
                        <div style="color: #EFEFEF; font-size: 16px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word;width: 105%;">
                            SUB-JORNADAS<br>DISPONÍVEIS
                        </div>
                    </div>
                </div>
            
                <div class="colunaDireitaPrimeiraLinhaAnalytics">
                    <div class="totalUsuariosOptInAnalytics" style="display: flex;flex-direction: column;">
                        <div style="text-align: center; color: #EFEFEF; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">
                            +'.filter_var($class->formataExibicaoSemDecimal($consultaNumerosAcumulados['mensagem'][0]['totalUsuariosOptin']), FILTER_SANITIZE_NUMBER_INT).'Mi
                        </div>
                        <div style="color: #EFEFEF; font-size: 16px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word;text-align: center;">
                            '.(number_format($consultaNumerosAcumulados['mensagem'][0]['totalUsuariosOptin'],0,",",".")).' USUÁRIOS <br>COM OPT-IN
                        </div>
                    </div>
                    <div class="totalTransacoesDisponiveisAnalytics" style="flex: 1 100%;">
                        <div style="text-align: center; color: #EFEFEF; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">
                            135
                        </div>
                        <div style="color: #EFEFEF; font-size: 16px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word;text-align: center;">
                            TRANSAÇÕES <br>DISPONÍVEIS
                        </div>
                    </div>
                </div>
            </div>

            <div class="segundaLinhaDadosAnalytics" style="display: flex;/*! justify-content: center; *//*! align-items: center; */width: 100%;flex-direction: column;">
                <div class="temaMaiorQtdTransacoesAnalytics" style="margin-top: 4%; text-align: center;">
                    <div>
                        <span style="color: #EFEFEF; font-size: 16px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">CARTÃO</span>
                        <span style="color: #EFEFEF; font-size: 16px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">
                            É O TEMA COM MAIS JORNADAS E TRANSAÇÕES
                        </span>
                    </div>
                </div>
        
                <div class="dadosAlexaAnalytics" style="  align-items: center; display: flex; justify-content: center;margin-top: 4%; display: none;">
                    <img class="imgAlexaAnalytics" style="width: 103px; height: 122px; position: absolute" src="/lib/img/apps/analytics/imgLogoAlexaDadossAnalytics.png">
                    <div class="textoAlexaAnalytics" style="justify-content: flex-start; align-items: flex-start; gap: 42px; display: inline-flex; top: 100px; position: relative;">
                        <div style="flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                            <div style="text-align: center; color: #EFEFEF; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">2.911</div>
                            <div style="text-align: center; color: #EFEFEF; font-size: 16px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">USUÁRIOS</div>
                        </div>
                        <div style="flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                            <div style="text-align: center; color: #EFEFEF; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">35.350</div>
                            <div style="text-align: center; color: #EFEFEF; font-size: 16px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">CONVERSAS</div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    ';
}

echo preg_replace('/\>\s+\</m', '><', '
<div class="containerAnalytics" style="width: 100%; background: #002D4B; overflow: hidden; flex-direction: column; justify-content: flex-start; align-items: center; display: inline-flex;">
    <div class="capaAnalytics" style="padding-top: 86px; background: rgba(73, 73, 79, 0); width: 100%; height: 408px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <div style="width: 100%; height: 408px; background: #002D4B; display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <img style="width: 375px; /*height: 296px;*/ mix-blend-mode: lighten;" src="/lib/img/apps/analytics/capa.png">
                <p class="fonteDegradeAnalytics" style="width: 100%; text-align: center; color: white; font-size: 128px; font-family: BancoDoBrasil Titulos; font-weight: 400; letter-spacing: -10px; word-wrap: break-word; z-index: 1; margin-top: -6rem;">
                    Analytics_v2
                </p>
            <img style="width: 449px; height: 83px; margin-top: -62px;" src="/lib/img/apps/analytics/sombraTitulo.png">
        </div>
    </div>

    <div class="calendarioGrandesNumeros">
        <div style="text-align: center;">
            <spam class="fonteDeGrade" style="color: white; font-size: 36px; font-family: BancoDoBrasil Titulos; font-weight: 500; word-wrap: break-word; letter-spacing: -2px;">
                GRANDES NÚMEROS</spam><br>="color: "
            <div style="color: #F9F9F9; font-size: 18px;">Escolha o peródo de visualização</div>
        </div>
        <div class="botoesPeriodo">
            <button class="botaoPeriodo ativo" style="border-top-left-radius: 8px;" onclick="setPeriodo">Ontem</button>
            <button class="botaoPeriodo" onclick ="setPeriodo">Últimos 7 dias</button>
            <button class="botaoPeriodo" onclick="setPeriodo">Últimos 30 dias</button>
            <button class="botaoPeriodo" style="border-top-right-radius: 8px;" onclick="setPeriodo">1 Ano</button>
        </div>
        <div class="camposData" style="display: flex; justify-content: center;">
            <div class="camposDataPesquisaInicio Clicar">
                <label class="dataInicio">De: </label>
                <input type="text" id="dataInicio" class="dataPicker hasDatePick" placeholder="" value="'.$date ->format('d/m/Y').'">
                <span class="iconeCalendario">📅</spam>
            </div>
            <div class="camposDataPesquisaFim Clicar">
                <label class="dataFim">Ate: </label>
                <input type="text" id="dataFim" class="dataPicker hasDatePick" placeholder="" value="'.$date ->format('d/m/Y').'">
                <span class="iconeCalendario">📅</spam>
            </div>
        </div>
    </div>

    
    <div class="conteudoAnalytics">
        <div style="display: flex; margin-left: 80%; margin-bottom: 3rem">
            <div style="color: #00FFE0; font-size: 32px; font-family: BancoDoBrasil Textos; font-weight: 500; line-height: 36px; letter-spacing: 0.16px; word-wrap: break-word">
                PF
            </div>

            <label class="switch">
                <input id="chavePfPj" type="checkbox">
                <span class="slider round"></span>
            </label>

            <div style="color: #00FFE0; font-size: 32px; font-family: BancoDoBrasil Textos; font-weight: 500; line-height: 36px; letter-spacing: 0.16px; word-wrap: break-word">
                PJ
            </div>
        </div>
        <div class="quadroGrandesNumerosPf" style="width: 100%; position: relative; margin-top: -3rem;">
            '.$dadosGrandesNumerosPf.'
        </div>

        <div class="quadroGrandesNumerosPj" style="width: 100%; position: relative; margin-top: -3rem; display: none;">
            '.$dadosGrandesNumerosPj.'
        </div>

        <div class="dadosAcumuladosAnalytics" style="width: 100%; position: relative;">
            '.$dadosNumerosAcumulados.'
            <img style="width: 100%; height: 740px; left: 1px; top: 1784px; position: absolute; mix-blend-mode: lighten" src="/lib/img/apps/analytics/imgFundo.png" />
        </div>

        


        
    </div>
</div>
');


include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php";
?>