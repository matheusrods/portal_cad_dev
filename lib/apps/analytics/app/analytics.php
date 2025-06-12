<?php

if(!isset($_SESSION)){
    session_start();
}

// ini_set("display_errors", E_ALL);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/analytics/class/class_paineis.php";
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
$dia = $date->format('d');
$mes = $date->format('F');
$numeroMes = $date->format('m');
$ano = $date->format('Y');
$data = $ano.'-'.$numeroMes.'-'.$dia;


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

$mesEmPortugues = strtoupper($meses[$mes]);

$consultaGrandesNumerosPf = $class->consultaGrandesNumerosPf($data);
$consultaGrandesNumerosPj = $class->consultaGrandesNumerosPj($data);
$consultaNumerosAcumulados = $class->consultaNumerosAcumulados($data);

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

echo '<!-- CSS específico do app --><link href="/lib/apps/analytics/css/analytics_V2.css" rel="stylesheet">';
echo '<!-- JS específico do app --><script type="text/javascript" src="/lib/apps/analytics/js/analytics.js"></script>';
echo '<!-- JS específico do app --><script type="text/javascript" src="/lib/apps/analytics/js/analytics_V2.js"></script>';

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
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['mediaInteracoesPf'],0,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['interacoesPfD7'],0,",",".").'</span>
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
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['mediaUsuariosPf'],0,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['usuariosPfD7'],0,",",".").'</span><br>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">90 Dias: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['usuariosPf90D'],0,",",".").'</span>
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
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['mediaConversasPf'],0,",",".").'<br/>
                    </span><span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['conversasPfD7'],0,",",".").'</span>
                </div>
                <img class="imagemDetalhesAnalytics" style="width: 176px; height: 144.72px; top: 250px; position: absolute" src="/lib/img/apps/analytics/3_alt.png" />
            </div>
        </div>
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha2 dadosColuna1" attr-idInfo="4">
            <div class="resumoNumerosAnalytics4 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-right-radius: 100px; background: #00FFFF; z-index: 2;">
                <img style="width: 161px; height: 147px; /*left: 147.50px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/4.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$consultaGrandesNumerosPf['mensagem'][0]['notaMediaPf'].' de nota<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">na avaliação dos usuários</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics4 dadosTodosQuadros overflowQuadroInterno" z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Nota Avaliações: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPf['mensagem'][0]['notaMediaPf'].'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPf['mensagem'][0]['notaMediaPf30d'].'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPf['mensagem'][0]['notaMediaPfD7'].'<br/><br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Qtd. Avaliações:</span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['qtdAvaliacoesPf'],0,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['qtdMediaAvaliacoesPf30d'],0,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['qtdMediaAvaliacoesPfD7'],0,",",".").'</span>
                </div>
                <img class="imagemDetalhesAnalytics iconeResponsivo" style="width: 133px; height: 133px; top: 255px; position: absolute" src="/lib/img/apps/analytics/4_alt.png" />
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
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['mediaAtivosEnviados'],0,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['ativosEnviadosD7'],0,",",".").'</span>
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
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['mediaInteracoesPj'],0,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['interacoesPjD7'],0,",",".").'</span>
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
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['mediaUsuariosPj'],0,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['usuariosPjD7'],0,",",".").'</span><br>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">90 Dias: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['usuariosPj90D'],0,",",".").'</span>
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
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['mediaConversasPj'],0,",",".").'<br/>
                    </span><span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['conversasPjD7'],0,",",".").'</span>
                </div>
                <img class="imagemDetalhesAnalytics" style="width: 176px; height: 144.72px; top: 250px; position: absolute" src="/lib/img/apps/analytics/3_alt.png" />
            </div>
        </div>
        <div class="efeitoAnalytics dadosTodosQuadros dadosLinha2 dadosColuna1" attr-idInfo="4">
            <div class="resumoNumerosAnalytics4 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-right-radius: 100px; background: #00FFFF; z-index: 2;">
                <img style="width: 161px; height: 147px; /*left: 147.50px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/4.png" />
                <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                    <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$consultaGrandesNumerosPj['mensagem'][0]['notaMediaPj'].' de nota<br/></span>
                    <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">na avaliação dos usuários</span>
                </div>
            </div>
            <div class="detalheNumerosAnalytics4 dadosTodosQuadros overflowQuadroInterno" z-index: 1;">
                <div class="textoDetalhesAnalytics">
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Nota Avaliações: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPj['mensagem'][0]['notaMediaPj'].'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPj['mensagem'][0]['notaMediaPj30d'].'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPj['mensagem'][0]['notaMediaPjD7'].'<br/><br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Qtd. Avaliações:</span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['qtdAvaliacoesPj'],0,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['qtdMediaAvaliacoesPj30d'],0,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['qtdMediaAvaliacoesPjD7'],0,",",".").'</span>
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
                    Analytics
                </p>
            <img style="width: 449px; height: 83px; margin-top: -62px;" src="/lib/img/apps/analytics/sombraTitulo.png">
        </div>
    </div>

    <div class="calendarioGrandesNumeros">
        <div style="justify-content: center; align-items: flex-end; display: inline-flex">
            <div style="text-align: center; line-height: 40px;">
                <span class="fonteDegrade" style="color: white; font-size: 36px; font-family: BancoDoBrasil Titulos; font-weight: 500; word-wrap: break-word; letter-spacing: -2px;">
                    GRANDES <br />
                </span>
                <span class="fonteDegrade" style="color: white; font-size: 34px; font-family: BancoDoBrasil Titulos; font-weight: 500; word-wrap: break-word; letter-spacing: -2px;">
                    NÚMEROS
                </span>
            </div>
            <div class="calendarioTrocaData Clicar">
                <input style="display:none; height: 30px;" type="text" id="selecionaData"  name="selecionaData" class="datePicker hasDatePick" placeholder="Data Início" />
                <span class="diaSelecionado" style="color: #49494F; font-size: 52px; font-family: BancoDoBrasil Titulos; font-weight: 500; word-wrap: break-word; margin-top: -1rem;">
                    '.$dia.'<br/>
                </span>
                <span class="mesSelecionado" style="color: #49494F; font-size: 10px; font-family: BancoDoBrasil Titulos; font-weight: 500; word-wrap: break-word; margin-top: -1.4rem;">
                    '.strtoupper($mesEmPortugues).'<br/>
                </span>
            </div>
            <div class="fonteDegrade" style="width: 240px; height: 110px; text-align: center; color: white; font-size: 96px; font-family: BancoDoBrasil Titulos; font-weight: 500; word-wrap: break-word; letter-spacing: -10px;">
                '.$ano.'
            </div>
        </div>
        <div style="text-align: center; color: #D0D0D0; font-size: 18px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word; text-align: left;">
            Clique na data para alterar o período.
        </div>
    </div>
    
    <div class="conteudoAnalytics">
        <div style="display: flex; margin-left: 80%;">
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