<?php

// if(!isset($_SESSION)){
//     session_start();
// }

// ini_set("display_errors", E_ALL);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/mentoria/class/class_mentoria.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Mentoria', $_SESSION['ip']);

$class = new funcoes();

$consultaDepoimentosMentoria = $class->consultaDepoimentosMentoria();


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Div Responsiva</title>
    
    <!-- CSS específico do app -->
    <link href="/lib/apps/mentoria/css/mentoria.css" rel="stylesheet">

    <!-- JS específico do app -->
    <script type="text/javascript" src="/lib/apps/mentoria/js/mentoria.js"></script>

</head>
<body>
<div class="cabecalhoMentoria">
    <div class="tituloImagemCabecalhoMentoria" style="display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
        <div class="textoBotoesCabecalho">
            <div class="tituloCabecalhoMentoria">
                <span style="color: #FCFC30; font-size: 7vw; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 100px; word-wrap: break-word">
                    Imersão<br>
                </span>
                <span style="color: #FCFC30; font-size: 7vw; font-family: BancoDoBrasil Titulos; font-weight: 300; line-height: 100px; word-wrap: break-word">
                    chatbot
                </span>
            </div>
            <div class="botoesCabecalhoMentoria">
                <div class="botaoSolicitarMentoria">
                    <div class="textoSolicitarAgora" style="color: #735CC6; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 700;">
                        Solicitar agora
                    </div>
                </div>
                <a class="linkBotaoSaberMaisMentoria" href="#temasImersao">
                    <div class="botaoSaberMaisMentoria">
                        <div class="textoSaberMais">
                            Saber mais
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="imagemRoboCabecalhoMentoria">
            <img class="imgCabecalhoMentoria" src="/lib/img/apps/mentoria/roboCabecalho.png">
        </div>
    </div>






    <div class="descricaoImersaoCabecalhoMentoria">
        <div class="primeiraLinhaQuadrosDescricaoMentoria">
            <div class="quadroDescricaoImersaoMentoria">
                <div class="tituloDescricaoImersaoMentoria">
                    O que é?
                </div>
                <div class="textoDescricaoImersaoMentoria">
                    Imersão Chatbot é um evento dedicado ao estudo e aplicação do chatbot BB, oferecendo uma experiência prática do trabalho da Escola de Robôs, o CAD.
                </div>
            </div>

            <div class="linhaVerticalDescricaoImersaoMentoria"></div>

            <div class="quadroDescricaoImersaoMentoria">
                <div class="tituloDescricaoImersaoMentoria">
                    Propósito
                </div>
                <div class="textoDescricaoImersaoMentoria">
                    Nosso objetivo é proporcionar aos participantes um entendimento abrangente sobre os chatbots do BB, suas funcionalidades, implementação, acompanhamento e melhores práticas.
                </div>
            </div>

            <div class="linhaVerticalDescricaoImersaoMentoria"></div>

            <div class="quadroDescricaoImersaoMentoria">
                <div class="tituloDescricaoImersaoMentoria">
                    Formato
                </div>
                <div class="textoDescricaoImersaoMentoria">
                    A imersão está disponível no formato online, com aulas ao vivo ou gravadas pelo Microsoft Teams, ou presencialmente na Escola de Robôs, o CAD (1901), localizado no Centro Histórico de São Paulo.
                </div>
            </div>
        </div>
        
        <div class="separadorDeLinhasMentoria">
            <div class="linhaHorizontalDescricaoImersaoMentoria"></div>
            <div class="linhaHorizontalDescricaoImersaoMentoria"></div>
            <div class="linhaHorizontalDescricaoImersaoMentoria"></div>
        </div>

        <div class="segundaLinhaQuadrosDescricaoMentoria">
            <div class="quadroDescricaoImersaoMentoria">
                <div class="tituloDescricaoImersaoMentoria">
                    Para quem
                </div>
                <div class="textoDescricaoImersaoMentoria">
                    Áreas do BB que desejam entender o funcionamento dos assistentes virtuais para implementar em suas operações, bem como empresas de diversos segmentos que buscam aprimorar a eficiência e a qualidade do atendimento por meio de chatbots inteligentes.
                </div>
            </div>

            <div class="linhaVerticalDescricaoImersaoMentoria"></div>
            
            <div class="quadroDescricaoImersaoMentoria">
                <div class="tituloDescricaoImersaoMentoria">
                    Cronograma
                </div>
                <div class="textoDescricaoImersaoMentoria">
                    Cada módulo possui duração de até 2 horas, previstos para ocorrerem entre 9:00 e 18:00, podendo ser ajustado conforme a necessidade da área demandante.
                </div>
            </div>
            
            <div class="linhaVerticalDescricaoImersaoMentoria" style="visibility: hidden;"></div>

            <div class="quadroDescricaoImersaoMentoria" style="visibility: hidden;"></div>
        </div>
    </div>
</div>


        

</body>
</html>
