<?php
// ini_set("display_errors", E_ALL);
session_start();

include_once $_SERVER["DOCUMENT_ROOT"]."/lib/login/login.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Hotsite', $_SESSION['ip']);

?>
<!DOCTYPE html>

<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Programa de Formação Especialista em Chatbot</title>
        <link href="../lib/img/img_bot/bot.ico" mce_href="../lib/img/img_bot/bot.ico" rel="icon">
        <link href="../lib/img/img_bot/bot.ico" mce_href="../lib/img/img_bot/bot.ico" rel="shortcut icon">

        <!-- jQuery -->
        <script type="text/javascript" src="../lib/js/jquery.3.7.1.js"></script>
        <script type="text/javascript" src="../lib/js/jquery.3.7.1.min.js"></script>
        <script type="text/javascript" src="../lib/js/jquery-ui.1.13.3.js"></script>
        <script type="text/javascript" src="../lib/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="../lib/js/bootstrap.bundle.js"></script>
        <script type="text/javascript" src="../lib/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="../lib/js/bootstrap.esm.js"></script>
        <script type="text/javascript" src="../lib/js/bootstrap.esm.min.js"></script>
        <script type="text/javascript" src="../lib/js/bootstrap.js"></script>
        <script type="text/javascript" src="../lib/js/bootstrap.min.js"></script>

        <!-- CSS da página -->
        <link href="index.css" rel="stylesheet">

        <!-- CSS Bootstrap -->
        <!-- <link href="../lib/css/bootstrap.css" rel="stylesheet"> -->

    </head>

    
    <body style="background: #465EFE no-repeat center center fixed; background-image: url('img/fundoFull.svg'); background-attachment: fixed; max-width: 100%; overflow-x: hidden;">
        <header style="display: flex; justify-content: center; align-items: center; /*height: 100vh;*/">
            <div class="cabecalho">
                <div style="width: 45rem; height: 519px; left: 45rem; top: -8.5rem; position: absolute" tabindex="2">
                    <img style="width: 22.5rem; height: 21rem; left: 4.5rem; top: 129.24px; position: absolute;" src="img/capa.png" alt="Capa do hotsite sendo uma mão segurando um celular com o robô mascote do CAD saindo de dentro da tela deste celular.">
                </div>

                <h1 style="width: 323px; height: 114px; left: 826px; top: 18rem; position: absolute" tabindex="3">
                    <span style="width: 20rem; height: 11px; left: 5px; top: 0px; position: absolute; color: white; font-size: 11px; font-family: BancoDoBrasil Textos; font-weight: 300; letter-spacing: 5.83px; word-wrap: break-word">
                        PROGRAMA DE FORMAÇÃO
                    </span>
                    <span style="width: 35rem; height: 56px; left: 0px; top: 6px; position: absolute; color: white; font-size: 60px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">
                        Especialista
                    </span>
                    <span style="width: 2rem; height: 13px; left: 67px; top: 66px; position: absolute; color: white; font-size: 11px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">
                        em
                    </span>
                    <span style="width: 35rem; height: 62px; left: 80px; top: 52px; position: absolute; color: white; font-size: 64px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">
                        Chatbot
                    </span>
                </h1>
            
                <div style="width: 157.65px; height: 56px; left: 1566px; top: 1rem; position: absolute" tabindex="1">
                    <img src="img/logoUacCadBb.svg" alt="Logomarca do CAD, da Unidade de Atendimento e Canais (UAC), ícone representando o robô mascote do CAD e logomarca do BB.">
                </div> 
            </div>
            
            <div style="width: 100%; height: 22px; left: 659px; top: 30rem; position: absolute; z-index: 3;">
                <div style="width: 41rem; height: 22px; background: #00FFA3; border-radius: 8px; display: flex; justify-content: center; align-items: center;">
                    <nav style="display: flex; justify-content: center; align-items: center;">
                        <button onclick="scrollToSection('h2Apresentacao')" class="botaoNavega Clicar" tabindex="4">INÍCIO</button>
                        <a style="color: #13E89A; font-size: 12px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">|</a>
                        <button onclick="scrollToSection('h2inscricoes')" class="botaoNavega Clicar" tabindex="5">INSCRIÇÃO</button>
                        <a style="color: #13E89A; font-size: 12px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">|</a>
                        <button onclick="scrollToSection('requisitos')" class="botaoNavega Clicar" tabindex="6">REQUISITOS</button>
                        <a style="color: #13E89A; font-size: 12px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">|</a>
                        <button onclick="scrollToSection('etapas')" class="botaoNavega Clicar" tabindex="7">ETAPAS</button>
                        <a style="color: #13E89A; font-size: 12px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">|</a>
                        <button onclick="scrollToSection('h2LinhaDoTempo')" class="botaoNavega Clicar" tabindex="8">LINHA DO TEMPO</button>
                        <a style="color: #13E89A; font-size: 12px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">|</a>
                        <button onclick="scrollToSection('h2LinhaDoTempo')" class="botaoNavega Clicar" tabindex="9">REGULAMENTO</button>
                        <a style="color: #13E89A; font-size: 12px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">|</a>
                        <button onclick="scrollToSection('h2Apresentacao')" class="botaoNavega Clicar" tabindex="10">FAQ</button>
                        <a style="color: #13E89A; font-size: 12px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">|</a>
                        <button onclick="scrollToSection('h2Apresentacao')" class="botaoNavega Clicar" tabindex="11">RESULTADO</button>
                    </nav>
                </div>
            </div>
        </header>
        
        <main>
            <div id="container" style="width: 100%; height: auto; position: relative;">
                <div id="apresentacao" class="section" tabindex="12">
                    <h2 id="h2Apresentacao">
                        apresentação
                    </h2>

                    <h3 class="h3Apresentacao">
                        <span style="color: white; font-size: 32px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">Bem-vindo ao Programa de Formação de </span>
                        <span style="color: white; font-size: 32px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Especialistas em Chatbot!</span>
                    </h3>

                    <div class="quadroApresentacao" tabindex="13">
                        <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">
                            Uma parceria entre 
                        </span>
                        <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                            CAD, UAC, DITEC e DIPES 
                        </span>
                        <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">
                            para capacitar e formar talentos na área de construção de assistentes virtuais.<br/><br/>Se você tem interesse em aprender sobre 
                        </span>
                        <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                            inteligência artificial, processamento de linguagem natural e como criar chatbots
                        </span>
                        <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word"> 
                            eficientes, este programa é pra você.<br/>
                        </span>
                        <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word"><br/>
                            Durante esta jornada você vai percorrer uma trilha de cursos, participar de desafios, além de poder participar de um estágio presencial no CAD (Escola de Robôs), em São Paulo, o 
                        </span>
                        <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 500; word-wrap: break-word">
                                principal centro de desenvolvimento de assistentes virtuais</span>
                        <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">
                             para atendimento ao público externo no BB.<br/>
                        </span>
                    </div>

                    <div class="quadroApresentacao02">
                        <div class="subQuadroApresentacao01">
                            <h4 style="width: 511px; left: 422px; top: 60rem; position: absolute" tabindex="14">
                                <span style="color: white; font-size: 32px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                    E, se tudo der certo, quem sabe entrar para o time da 
                                </span>
                                <span style="color: white; font-size: 32px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word">
                                    Escola de Robôs?
                                </span>
                            </h4>
                            <div style="width: 521px; left: 424px; top: 70rem; position: absolute; text-align: justify; color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word;" tabindex="15">
                                <span>
                                    Programadores, designers, especialistas em dados e experiência do usuário, que são a alma dos Assistentes Virtuais do BB.<br/><br/>
                                </span>
                                <span>
                                    Utilizamos ferramentas de chatbot e inteligência artificial para entregar soluções fáceis e acessíveis para nossos clientes, através de fluxos e conteúdos conversacionais no WhatsApp, Alexa, Instragam, Facebook, Portal BB, APP BB e mais.<br/><br/>
                                </span>
                                <span>
                                    Acesse o <a href="https://cad.bb.com.br" target="_blank" tabindex="16">Portal do CAD</a> para conhecer um pouco mais sobre o nosso trabalho.<br/><br/><br/>
                                </span>
                                <img src="img/logoCadApresentacao.svg" alt="Logomarca do CAD e texto 'Central de Atendimento Digital'" tabindex="17">
                            </div>
                        </div>

                        <div class="subQuadroApresentacao02">
                            <h4 style="width: 562px; left: 1004px; top: 60rem; position: absolute"  tabindex="18">
                                <span style="color: white; font-size: 32px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                    Falando nisso, você 
                                </span>
                                <span style="color: white; font-size: 32px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word">
                                    conhece o <br/>WhatsApp do BB?
                                </span>
                            </h4>
                            <div style="width: 494px; left: 1005px; top: 70rem; position: absolute; text-align: justify" tabindex="19">
                                <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">
                                    Sabia que é possível fazer 
                                </span>
                                <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                    pix, pagamentos, consultar saldos, investir, alterar limite do cartão
                                </span>
                                <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">
                                    e muito mais?<br/><br/>
                                    Isso tudo 
                                </span>
                                <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                    24h por dia, 7 dias por semana
                                </span>
                                <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">
                                    , com a 
                                </span>
                                <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                    agilidade e segurança
                                </span>
                                <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">
                                    que só o assistente virtual do BB pode oferecer.<br/><br/></span>
                                <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                    Vem conhecer!
                                </span>
                                <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">
                                    Indique para seus colegas e clientes, o canal mais
                                </span>
                                <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                    simples, completo e seguro
                                </span>
                                <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">
                                    do BB 😉<br/><br/><br/><br/><br/>
                                </span>
                                <img src="img/qrCodeBot.svg">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="inscricoes" class="section" tabindex="20" style="height: 27rem;">
                    <h2 id="h2inscricoes" style="top: 85rem; position: absolute; opacity: 0.05; color: white; font-size: 200px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word">
                        inscrições
                    </h2>
                    <h3 style="width: 12rem; left: 424px; top: 102rem; position: absolute; color: white; font-size: 32px; font-family: BancoDoBrasil Textos; font-weight: 500; word-wrap: break-word;"  tabindex="21">
                        Inscrições:
                    </h3>
                    <div style="width: 75rem; left: 424px; top: 107rem; position: absolute; color: white; font-size: 50px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word">
                        05/08/2024 a 20/09/2024
                    </div>
                    <img style="width: 57rem;height: 30rem;left: 25rem;top: 1629px;position: absolute;mix-blend-mode: screen;" src="img/mapaEtapas.svg" alt="Losangos interligados simbolizando as etapas do programa: inscrição, formação, estágio, entrevista e resultado." tabindex="22">
                </div>

                <div id="requisitos" class="section" style="height: 44rem;">
                    <h2 id="h2Requisitos" style="top: 115rem;position: absolute;opacity: 0.05;color: white;font-size: 200px;font-family: BancoDoBrasil Textos;font-weight: 800;word-wrap: break-word" tabindex="23">
                        requisitos
                    </h2>
                    
                    <img style="width: 270px; height: 285px; left: 1086px; top: 2303.96px; position: absolute; transform-origin: 0 0; border-radius: 5px" src="img/miniaturaTrilha.svg">
                    <div style="width: 270px;height: 239.40px;left: 1084px;top: 2571.96px;position: absolute;transform: rotate(-183.81deg);transform-origin: 0 0;opacity: 0.2;">
                        <img style="width: 270px; height: 285px; left: -20px; top: -303px; position: absolute; transform-origin: 0 0; opacity: 0.40; border-radius: 5px; transform: scaleX(1) rotateY(180deg) rotateZ(3.81deg); -webkit-filter: blur(2px);" src="img/miniaturaTrilha.svg">
                    </div>

                    <div style="width: 45rem; height: 148.07px;left: 547px; top: 130rem; position: absolute; transform-origin: 0 0;transform: skewY(-2deg);" tabindex="24">
                        <h3 style="width: 45rem; left: 0px; top: 0px; position: absolute; transform: skewY(-3deg); transform-origin: 0 0; color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word;">
                            Confira os pré-requisitos do programa.
                        </h3>
                        <div style="width: 45rem; left: 1.78px; top: 3rem; position: absolute; transform: skewY(-3deg); transform-origin: 0 0; letter-spacing: -2px;" tabindex="25">
                            <span style="color: white; font-size: 40px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">
                                Já completou a 
                            </span>
                            <span style="color: white; font-size: 40px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                trilha de estudos?
                            </span>
                        </div>
                        <div style="width: 45rem; left: 0px; top: 6rem; position: absolute; transform: skewY(-3deg); transform-origin: 0 0; color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word;" tabindex="26">
                            <span>
                                Ela é o primeiro passo para sua participação nesta jornada.<br><br>
                            </span>
                        </div>
                    </div>
                    
                    <div style="width: 439.97px;height: 357.84px;left: 547px;top: 142rem;position: absolute;transform: skewY(-3deg);" tabindex="27">
                        <h4 style="width: 45rem;left: 0px;top: -4rem;position: absolute;transform: skewY(-3deg);transform-origin: 0 0;color: white;font-size: 20px;font-family: BancoDoBrasil Textos;font-weight: 300;word-wrap: break-word" tabindex="28">
                            Confira todos os requisitos:
                        </h4>
                        <div style="left: 0px; top: 0px; position: absolute; transform: skewY(-3deg); transform-origin: 0 0; color: #FF84FF; font-size: 90px; font-family: BancoDoBrasil Textos; font-weight: 800; line-height: 102.33px; word-wrap: break-word" tabindex="29">
                            1
                        </div>
                        <div style="width: 27px; height: 0px; left: 38.91px; top: 51.41px; position: absolute; transform: skewY(-3deg); transform-origin: 0 0; border: 2px #FF84FF solid"></div>
                        
                        <div style="width: 362.97px; left: 76.83px; top: 24.88px; position: absolute; transform: skewY(-3deg); transform-origin: 0 0" tabindex="30">
                            <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; line-height: 22.74px; word-wrap: break-word">
                                Ter realizado a trilha de cursos<br>
                            </span>
                            <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: 22.74px; word-wrap: break-word">
                                Especialista Chatbot - Formação Inicial<br>
                            </span>
                        </div>

                        <div style="left: 0px; top: 84px; position: absolute; transform: skewY(-3deg); transform-origin: 0 0; color: #FFE7FF; font-size: 90px; font-family: BancoDoBrasil Textos; font-weight: 800; line-height: 102.33px; word-wrap: break-word" tabindex="31">
                            2
                        </div>
                        <div style="width: 31px; height: 0px; left: 34.92px; top: 135.67px; position: absolute; transform: skewY(-3deg); transform-origin: 0 0; border: 2px #FFE7FF solid"></div>

                        <div style="width: 25rem; left: 76.83px; top: 110.88px; position: absolute; transform: skewY(-3deg); transform-origin: 0 0" tabindex="32">
                            <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; line-height: 22.74px; word-wrap: break-word">
                                Estar inscrito na <br>
                            </span>
                            <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: 22.74px; word-wrap: break-word">
                                Oportunidade CFG210020<br><br>
                            </span>
                        </div>

                        <div style="left: 0px; top: 177px; position: absolute; transform: skewY(-3deg); transform-origin: 0 0; color: #59FFFF; font-size: 90px; font-family: BancoDoBrasil Textos; font-weight: 800; line-height: 102.33px; word-wrap: break-word" tabindex="33">
                            3
                        </div>
                        <div style="width: 18px; height: 0px; left: 47.89px; top: 234.81px; position: absolute; transform: skewY(-3deg); transform-origin: 0 0; border: 2px #59FFFF solid"></div>

                        <div style="left: 76.83px;top: 212.88px;position: absolute;transform: skewY(-3deg);transform-origin: 0 0" tabindex="34">
                            <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; line-height: 22.74px; word-wrap: break-word">
                                Disponibilidade para realizar<br>
                            </span>
                            <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: 22.74px; word-wrap: break-word">
                                estágio de 15 dias em São Paulo<br><br>
                            </span>
                        </div>

                        <div style="left: 6px; top: 353px; position: absolute; transform: rotateX(-180deg) skewY(6deg); transform-origin: 0 0; color: rgba(89, 255, 255, 0.80); font-size: 90px; font-family: BancoDoBrasil Textos; font-weight: 800; line-height: 102.33px; word-wrap: break-word; filter: blur(2px);">
                            3
                        </div>

                        <div style="width: 25rem; height: 92px; left: 76px; top: 255px; position: absolute; opacity: 0.2; transform: rotateX(-180deg) skewY(6deg); filter: blur(2px);">
                            <div style="left: 1.17px; top: 47.40px; position: absolute; transform: skewY(-2deg);">
                                <span style="color: rgba(255, 255, 255, 0.80); font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; line-height: 22.74px; word-wrap: break-word">
                                    Disponibilidade para realizar<br>
                                </span>
                                <span style="color: rgba(255, 255, 255, 0.80); font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: 22.74px; word-wrap: break-word">
                                    estágio de 15 dias em São Paulo<br><br>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="etapas" class="section" style="height: 80rem;">
                    <h2 id="h2Etapas" style="top: 170rem; position: absolute; opacity: 0.05; color: white; font-size: 200px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word">
                        etapas
                    </h2>
                    <h3 style="width: 100%; position: absolute; top: 174rem; left: 23rem; color: white; font-size: 28px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word;" tabindex="35">
                        Etapas:
                    </h3>
                    <div class="apresentacaoEtapas" tabindex="36">
                        <span style="color: white; font-size: 40px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                            Explore o universo
                        </span>
                        <span style="color: white; font-size: 40px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">
                             da Inteligência Artificial através de aulas, desafios e 
                        </span>
                        <span style="color: white; font-size: 40px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                            conheça de perto
                        </span>
                        <span style="color: white; font-size: 40px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">
                             a rotina dos nossos <br>especialistas!
                        </span>
                        <img style="width: 512px;height: 512px;left: 39rem;top;top: -5rem;position: absolute;" src="img/linhaCurva.svg">
                    </div>

                    <div style="width: 1120px; height: 804px; left: 360px; top: 3201px; position: absolute" tabindex="37">
                        <div style="width: 356px; height: 804px; left: 379px; top: 0px; position: absolute; background: radial-gradient(100.00% 100.00% at NaN% NaN%, white 0%, #EFEEEE 100%); box-shadow: 0px 2.767256498336792px 2.2138051986694336px rgba(0, 0, 0, 0.02); border-radius: 33px"></div>
                        <div class="etapaInscricao quadrosEtapas" style="height: 34rem;">
                            <h3 style="width: 357px; height: 59px; left: 0px; position: absolute; text-align: center; color: white; font-size: 50px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word" tabindex="38">
                                Inscrição
                            </h3>
                            <div style="width: 306px; height: 296px; left: 25px; top: 147px; position: absolute; text-align: center" tabindex="39">
                                <span style="color: white; font-size: 22px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                    Tudo certo? Então clique aqui para se inscrever<br><br>Os interessados terão o prazo de 
                                </span>
                                <span style="color: white; font-size: 22px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">
                                    45 dias para se inscrever
                                </span>
                                <span style="color: white; font-size: 22px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word"> 
                                    após a divulgação do Programa de Formação de Especialistas – CAD na AGN. <br><br>A lista com os aprovados para a próxima etapa será divulgada em até 15 dias após o encerramento das inscrições
                                </span>
                            </div>
                        </div> 

                        <div class="etapaFormacao quadrosEtapas" style="height: 50rem;left: 23.5rem;top: 0px;position: absolute;border-radius: 33px;">
                            <h3 style="width: 356px; height: 59px; position: absolute; text-align: center; color: white; font-size: 50px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word" tabindex="40">
                                Formação
                            </h3>
                            <div style="width: 306px; height: 568px; left: 1.5rem; top: 147px; position: absolute; text-align: center; color: white; font-size: 22px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: 23px; word-wrap: break-word" tabindex="41">
                                A etapa de formação terá inicio em até uma semana após a divulgação da lista e será dividida em 4 etapas:<br><br>
                                👉 HLD (High Level Design)<br>
                                👉 Saudação/feedback<br>
                                👉 Ativo<br>
                                👉 Jornada orgânica<br><br>
                                Cada etapa será composta por uma aula com duração de 2 horas. <br><br>
                                As aulas ficarão gravadas e poderão ser assistidas de forma assíncrona. <br><br>
                                Os participantes terão o prazo de 1 semana para entrega do que foi proposto no desafio. <br><br>
                                O prazo para correção e divulgação do resultado será de 1 semana, a contar da data limite de entrega.
                            </div>
                        </div>

                        <div class="etapaEstagio quadrosEtapas" style="height: 390px; left: 47rem; top: 0px; position: absolute; border-radius: 33px;">
                            <h3 style="width: 357px; height: 59px; position: absolute; text-align: center; color: white; font-size: 50px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word;" tabindex="42">
                                Estágio
                            </h3>
                            <div class="descricaoEtapaEstagio">
                                <div style="width: 306px;height: 296px;left: 1rem;top: 147px;position: absolute;text-align: center" tabindex="43">
                                    <span style="color: white; font-size: 22px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                        O estágio tem 
                                    </span>
                                    <span style="color: white; font-size: 22px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">
                                        duração de 2 semanas
                                    </span>
                                    <span style="color: white; font-size: 22px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                        . Em cada uma das semanas, foi reservado um dia para deslocamento dos participantes.
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="etapaEntrevista quadrosEtapas" style="height: 400px; left: 47rem; top: 404px; position: absolute; border-radius: 33px;">
                            <h3 style="width: 357px; height: 59px; position: absolute; text-align: center; color: white; font-size: 50px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word;" tabindex="44">
                                Entrevista
                            </h3>
                            <div style="width: 307px;height: 184px; left: 1rem; top: 147px; position: absolute;text-align: center;color: white;font-size: 22px;font-family: BancoDoBrasil Textos;font-weight: 400;word-wrap: break-word" tabindex="45">
                                Entrevista comportamental dos candidatos aprovados nas etapas anteriores<br>Preenchimento de até 3 vagas, com possibilidade de formação de banco de talentos.
                            </div>
                        </div>

                        <img style="width: 785px; height: 716px; left: 45rem; top: 3rem; position: absolute;" src="img/botEtapas.svg">
                    </div>
                </div>


                <div id="linhaDoTempo">
                    <h2 id="h2LinhaDoTempo" style="top: 254rem; position: absolute; opacity: 0.05; color: white; font-size: 200px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word" tabindex="46">
                        linha do tempo
                    </h2>
                    <div style="width: 100%; height: 407px; top: 4132px; position: absolute">
                        <div style="width: 288px; height: 207px; left: -1rem; top: 3rem; position: absolute; z-index: 1;">
                            <img style="width: 400px;" src="img/regulamento.svg" alt="Acessar o regulamento completo." tabindex="47">
                        </div>
                        <div style="width: 100rem; height: 0px; left: 7rem; top: 180px; position: absolute; opacity: 0.80; border: 10px white solid"></div>
                        <div style="left: 10rem; position: absolute;">
                            <div style="width: 172px; height: 76px; left: 129px; top: 109px; position: absolute" tabindex="48">
                                <div style="width: 167px; left: 5px; top: 0px; position: absolute">
                                    <span style="color: white; font-size: 22px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word">
                                        05/08/2024<br>
                                    </span>
                                    <span style="color: white; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                        Início das inscrições
                                    </span>
                                </div>
                                <div style="width: 70px; height: 0px; left: 0px; top: 6px; position: absolute; transform: rotate(90deg); transform-origin: 0 0; border: 2px white dotted"></div>
                            </div>
                            <div style="width: 220px; height: 110px; left: 338px; top: 75px; position: absolute">
                                <div style="width: 215px; left: 5px; top: 0px; position: absolute" tabindex="49">
                                    <span style="color: white; font-size: 22px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word">
                                        04/10/2024<br>
                                    </span>
                                    <span style="color: white; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                        Divulgação dos aprovados para etapa de Formação
                                    </span>
                                </div>
                                <div style="width: 95px; height: 0px; left: 0px; top: 15px; position: absolute; transform: rotate(90deg); transform-origin: 0 0; border: 2px white dotted"></div>
                            </div>
                            <div style="width: 234px; height: 71px; left: 218px; top: 185px; position: absolute">
                                <div style="width: 229px; left: 5px; top: 27px; position: absolute" tabindex="50">
                                    <span style="color: white; font-size: 22px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word">
                                        20/09/2024<br>
                                    </span>
                                    <span style="color: white; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                        Encerramento das inscrições
                                    </span>
                                </div>
                                <div style="width: 67px; height: 0px; left: 0px; top: 0px; position: absolute; transform: rotate(90deg); transform-origin: 0 0; border: 2px white dotted"></div>
                            </div>
                            <div style="width: 256px; height: 117px; left: 486px; top: 185px; position: absolute">
                                <div style="width: 251px; left: 5px; top: 27px; position: absolute" tabindex="51">
                                    <span style="color: white; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                        Formação HLD<br>
                                    </span>
                                    <span style="color: white; font-size: 22px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word">
                                        Aula: 07/10/2024<br>Desafio: 11/10/2024<br>
                                    </span>
                                    <span style="color: white; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                        Resultado: 18/10/2024
                                    </span>
                                </div>
                                <div style="width: 112px; height: 0px; left: 0px; top: 0px; position: absolute; transform: rotate(90deg); transform-origin: 0 0; border: 2px white dotted"></div>
                            </div>
                            <div style="width: 256px; height: 157px; left: 760px; top: 185px; position: absolute">
                                <div style="width: 251px; left: 5px; top: 67px; position: absolute" tabindex="52">
                                    <span style="color: white; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                        Formação Ativo<br>
                                    </span>
                                    <span style="color: white; font-size: 22px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word">
                                        Aula: 04/11/2024<br>Desafio: 11/11/2024<br>
                                    </span>
                                    <span style="color: white; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                        Resultado: 15/11/2024
                                    </span>
                                </div>
                                <div style="width: 152px; height: 0px; left: 0px; top: 0px; position: absolute; transform: rotate(90deg); transform-origin: 0 0; border: 2px white dotted"></div>
                            </div>
                            <div style="width: 494px; height: 222px; left: 1041px; top: 185px; position: absolute">
                                <div style="width: 251px; left: 5px; top: 108px; position: absolute" tabindex="53">
                                    <span style="color: white; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                        Estágio Turma 1<br>
                                    </span>
                                    <span style="color: white; font-size: 22px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word">
                                        De: 06/01/2025<br>a 17/01/2025
                                    </span>
                                </div>
                                <div style="width: 174px; height: 0px; left: 0px; top: 0px; position: absolute; transform: rotate(90deg); transform-origin: 0 0; border: 2px white dotted"></div>
                                <div style="width: 174px; height: 0px; left: 0px; top: 0px; position: absolute; transform: rotate(90deg); transform-origin: 0 0; border: 2px white dotted"></div>
                                <div style="width: 251px; left: 243px; top: 157px; position: absolute" tabindex="54">
                                    <span style="color: white; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                        Divugação dos Resultados<br>
                                    </span>
                                    <span style="color: white; font-size: 22px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word">
                                        De: 06/01/2025<br>
                                    </span>
                                </div>
                                <div style="width: 199px; height: 0px; left: 238px; top: 0px; position: absolute; transform: rotate(90deg); transform-origin: 0 0; border: 2px white dotted"></div>
                            </div>
                            <div style="width: 256px; height: 180px; left: 1203px; top: 0px; position: absolute">
                                <div style="width: 251px; left: 5px; top: 0px; position: absolute" tabindex="55">
                                    <span style="color: white; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                        Estágio Turma 2<br>
                                    </span>
                                    <span style="color: white; font-size: 22px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word">
                                        De: 20/01/2025<br>a 30/01/2025
                                    </span>
                                </div>
                                <div style="width: 174px; height: 0px; left: 0px; top: 6px; position: absolute; transform: rotate(90deg); transform-origin: 0 0; border: 2px white dotted"></div>
                                <div style="width: 174px; height: 0px; left: 0px; top: 6px; position: absolute; transform: rotate(90deg); transform-origin: 0 0; border: 2px white dotted"></div>
                            </div>
                            <div style="width: 256px; height: 120px; left: 602px; top: 55px; position: absolute">
                                <div style="width: 251px; left: 5px; top: 0px; position: absolute" tabindex="56">
                                    <span style="color: white; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                        Formação Saudação/Feedback<br>
                                    </span>
                                    <span style="color: white; font-size: 22px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word">
                                        Aula: 21/10/2024<br>Desafio: 25/10/2024<br>
                                    </span>
                                    <span style="color: white; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                        Resultado: 01/11/2024
                                    </span>
                                </div>
                                <div style="width: 112px; height: 0px; left: 0px; top: 8px; position: absolute; transform: rotate(90deg); transform-origin: 0 0; border: 2px white dotted"></div>
                            </div>
                            <div style="width: 256px; height: 148px; left: 902px; top: 27px; position: absolute">
                                <div style="width: 251px; left: 5px; top: 0px; position: absolute" tabindex="57">
                                    <span style="color: white; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                        Formação Jornada Orgânica<br>
                                    </span>
                                    <span style="color: white; font-size: 22px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word">
                                        Aula: 18/11/2024<br>Desafio: 25/11/2024<br>
                                    </span>
                                    <span style="color: white; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                                        Resultado: 29/11/2024
                                    </span>
                            </div>
                                <div style="width: 143px; height: 0px; left: 0px; top: 5px; position: absolute; transform: rotate(90deg); transform-origin: 0 0; border: 2px white dotted"></div>
                            </div>
                        </div>
                        <div style="width: 288px; height: 207px; right: 0rem; top: 3rem; position: absolute; z-index: 1;">
                            <a href="mailto:cad@bb.com.br?subject=Dúvidas - Programa Especialista em Chatbot">
                                <img style="width: 400;" src="img/duvidas.svg">
                            </a>
                        </div>
                    </div>
                </div>


                <footer>
                    <div style="width: 157.65px; height: 56px; left: 898px; top: 4805px; position: absolute">
                        <img src="img/logoUacCadBb.svg" alt="Dúvidas? Envie e-mail para cad@bb.com.br." tabindex="58">
                    </div>
                    
                    <div style="width: 32rem; height: 23px; left: 102px; top: 4708px; position: absolute; mix-blend-mode: soft-light; background: #59FFFF; border-radius: 6px"></div>
                    <div style="left: 358px; top: 4707px; position: absolute; color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Que bom te ver por aqui!</div>
                    <div style="left: 247px; top: 4648px; position: absolute; color: white; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 300; letter-spacing: 6.12px; word-wrap: break-word">CLIQUE PARA CONHECER</div>
                    <div style="left: 239px; top: 4671px; position: absolute; color: white; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 300; letter-spacing: 3.60px; word-wrap: break-word"> NOSSO ASSISTENTE VIRTUAL</div>
                    <div style="width: 17rem; height: 23px; left: 298px; top: 4734px; position: absolute; mix-blend-mode: soft-light; background: #59FFFF; border-radius: 6px"></div>
                    <div style="left: 358px; top: 4733px; position: absolute; color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Como posso ajudar?</div>
                    <img style="width: 34rem; height: 20rem; left: -75px; top: 283rem; position: absolute;" src="img/roboRodape.svg" />
                </footer>
            </div>
        </main>
        
        <script>
            function scrollToSection(sectionId) {
                document.getElementById(sectionId).scrollIntoView({ behavior: 'smooth' });
            }
        </script>
    </body>
</html>