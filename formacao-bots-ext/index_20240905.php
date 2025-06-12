<?php
// header('Access-Control-Allow-Origin: https://cad.bb.com.br');
// ini_set("display_errors", E_ALL);
session_start();

include_once $_SERVER["DOCUMENT_ROOT"]."/lib/login/login.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Hotsite', $_SESSION['ip']);


require_once $_SERVER["DOCUMENT_ROOT"]."/formacao-bots/home.php";
?>

<!DOCTYPE html>

<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Programa de Formação Desenvolvimento de Assistentes Virtuais</title>

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
        
        <!-- JS da página -->
        <script type="text/javascript" src="index.js"></script>

        <!-- CSS da página -->
        <link href="index.css" rel="stylesheet">
    </head>

    <!-- <body style="background: #465EFE no-repeat center center fixed; background-image: url('img/fundoFull.svg'); background-attachment: fixed; max-width: 100%; overflow-x: hidden;"> -->
    <body style="background: #465EFE repeat center center; background-image: url('img/fundoFull.png'); background-size: 100%; max-width: 100%; overflow-x: hidden;">
        <header>
            <div class="divCabecalhoLogo" tabindex="1">
                <img src="img/logoUacCadBb.svg" alt="Logomarca do CAD, da Unidade de Atendimento e Canais (UAC), ícone representando o robô mascote do CAD e logomarca do BB.">
            </div>

            <div class="divCabecalhoCapa" tabindex="2">
                <img src="img/capa.png" style="max-height: 50vh;" alt="Capa do hotsite sendo uma mão segurando um celular com o robô mascote do CAD saindo de dentro da tela deste celular." />
            </div>

            <h1 tabindex="3">
                <span>PROGRAMA DE FORMAÇÃO</span>
                <span>Desenvolvimento</span>
                <span>de</span>
                <span>Assistentes Virtuais</span>
            </h1>

            <div class="divExternaCabecalho">
                <div class="divInternaCabecalho">
                    <nav>
                        <button onclick="scrollToSection('h2Apresentacao')" class="botaoNavega Clicar" tabindex="4">INÍCIO</button>
                        <a>|</a>
                        <button onclick="scrollToSection('h2Inscricoes')" class="botaoNavega Clicar" tabindex="5">INSCRIÇÃO</button>
                        <a>|</a>
                        <button onclick="scrollToSection('h2Requisitos')" class="botaoNavega Clicar" tabindex="6">REQUISITOS</button>
                        <a>|</a>
                        <button onclick="scrollToSection('h2Etapas')" class="botaoNavega Clicar" tabindex="7">ETAPAS</button>
                        <a>|</a>
                        <button onclick="scrollToSection('h2LinhaDoTempo')" class="botaoNavega Clicar" tabindex="8">LINHA DO TEMPO</button>
                        <a>|</a>
                        <button onclick="scrollToSection('h2LinhaDoTempo')" class="botaoNavega Clicar" tabindex="9">REGULAMENTO</button>
                        <a>|</a>
                        <button onclick="scrollToSection('h2Faq')" class="botaoNavega Clicar" tabindex="10">FAQ</button>
                        <a>|</a>
                        <button onclick="scrollToSection('h2Aulas')" class="botaoNavega Clicar" tabindex="10">AULAS</button>
                        <!-- <a>|</a>
                        <button onclick="scrollToSection('h2Apresentacao')" class="botaoNavega Clicar" tabindex="10">FAQ</button> -->
                        <a>|</a>
                        <!-- <button onclick="scrollToSection('h2Apresentacao')" class="botaoNavega Clicar" tabindex="11">RESULTADO</button> -->
                        <button class="botaoNavega" tabindex="11" style="cursor: not-allowed; opacity: 0.3;">RESULTADO</button>
                    </nav>
                </div>
            </div>
        </header>
        
        <main>
            <div id="container" style="width: 100%; height: auto; position: relative;">
                <div id="apresentacao" tabindex="12">

                    <h2 id="h2Apresentacao">
                        apresentação
                    </h2>

                    <h3 class="h3Apresentacao">
                        <span>Chegou o programa de formação em  </span>
                        <span style="font-weight: 400;">Desenvolvimento de Assistentes Virtuais!</span>
                    </h3>

                    <div class="quadroApresentacao01" tabindex="13">
                        <span>Uma parceria entre </span>
                        <span style="font-weight: 400;">CAD, UAC, DITEC e DIPES </span>
                        <span>para capacitar e formar talentos na área de </span>
                        <span style="font-weight: 400;">construção de chatbots e voicebots.<br><br></span>
                        <span>Se você tem interesse em aprender sobre </span>
                        <span style="font-weight: 400;">inteligência cognitiva, processamento de linguagem natural e criação de bots </span>
                        <span>eficientes, este programa é pra você.<br><br>Durante esta jornada você vai percorrer uma trilha de cursos, realizar desafios e ter a chance de um estágio presencial no CAD (Escola de Robôs), em São Paulo, o </span>
                        <span style="font-weight: 500;">principal centro de desenvolvimento de assistentes virtuais </span>
                        <span>para atendimento ao público externo no BB.<br></span>
                    </div>

                    <div class="quadroApresentacao02">
                        <div class="subQuadroApresentacao01">
                            <h4 style="color: white; font-size: 2rem; font-family: BancoDoBrasil Textos; font-weight: 400;" tabindex="14">
                                <span>E, se tudo der certo, quem sabe entrar para o time da </span>
                                <span style="font-weight: 800;">Escola de Robôs?</span>
                            </h4>
                            <div style="color: white; font-size: 1.25rem; font-family: BancoDoBrasil Textos; font-weight: 300; text-align: left;" tabindex="15">
                                <span>
                                    Programadores, designers, especialistas em dados e experiência do usuário, que são a alma dos Assistentes Virtuais do BB.<br><br>
                                    Utilizamos ferramentas de chatbot e inteligência artificial para entregar soluções fáceis e acessíveis para nossos clientes, através de fluxos e conteúdos conversacionais no WhatsApp, Alexa, Instagram, Facebook, Portal BB, APP BB e mais.<br><br>
                                    Acesse o <a href="https://cad.bb.com.br" target="_blank" tabindex="16" style="color: white; background-color: transparent; text-decoration: underline;">Portal do CAD</a> 
                                    para conhecer um pouco mais sobre o nosso trabalho.<br><br><br>
                                </span>
                                <img src="img/logoCadApresentacao.svg" alt="Logomarca do CAD e texto 'Central de Atendimento Digital'" tabindex="17">
                            </div>
                        </div>
                        
                        <div class="subQuadroApresentacao02">
                            <h4 style="color: white; font-size: 2rem; font-family: BancoDoBrasil Textos; font-weight: 400;" tabindex="18">
                                <span>Falando nisso, você </span>
                                <span style="font-weight: 800;">conhece o <br>WhatsApp do BB?</span>
                            </h4>
                            <div style="color: white; font-size: 1.25rem; font-family: BancoDoBrasil Textos; font-weight: 300; text-align: left;" tabindex="19">
                                <span>Sabia que é possível fazer </span>
                                <span style="font-weight: 400;">pix, pagamentos, consultar saldos, investir, alterar limite do cartão </span>
                                <span>e muito mais?<br><br>Isso tudo </span>
                                <span style="font-weight: 400;">24h por dia, 7 dias por semana, </span>
                                <span>com a </span>
                                <span style="font-weight: 400;">agilidade e segurança </span>
                                <span>que só o assistente virtual do BB pode oferecer.<br><br></span>
                                <span style="font-weight: 400;">Venha conhecer!</span>
                                <span>Indique para seus colegas e clientes, o canal mais </span>
                                <span style="font-weight: 400;">simples, completo e seguro </span>
                                <span>do BB 😉<br><br><br><br><br></span>
                                <img src="img/qrCodeBot.svg">
                            </div>
                        </div>
                    </div>
                </div>

                <div id="inscricoes" tabindex="20" style="padding-top: 5rem;">
                    <h2 id="h2Inscricoes">
                        inscrições
                    </h2>
                    <div class="subQuadroInscricoes">
                        <h3 style="color: white; font-size: 2rem; font-family: BancoDoBrasil Textos; font-weight: 500; word-wrap: break-word;/*! top: 5rem; */text-align: left;position: relative;align-self: flex-start;text-align: left;" tabindex="21">
                            Inscrições:
                        </h3>
                        <div class="dataInscricao">
                            05/08/2024 a 20/09/2024
                        </div>
                        <div class="caminhoInscricao" tabindex="22">
                            <a href="https://plataforma.atendimento.bb.com.br:49286/estatico/gaw/app/spas/index/index.app.html?cd_modo_uso=44&app=tao.inscricao" target="_blank" style="text-decoration: none;">
                                <div style="text-align: center;color: #5F5F5F;font-size: 24px;font-family: BancoDoBrasil Titulos;font-weight: 700;text-transform: uppercase;line-height: 27px;letter-spacing: 0.12px;word-wrap: break-word;">
                                    Plataforma BB > Pessoas > Minha Visão > Talentos e Oportunidades (DigiTAO) > CFG240035
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div id="requisitos">
                    <h2 id="h2Requisitos" tabindex="23">
                        requisitos
                    </h2>
                    
                    <img class="imgTrilha"src="img/miniaturaTrilha.svg">
                    <div style="width: 270px;height: 239.40px;left: 1084px;top: 2571.96px;position: absolute;transform: rotate(-183.81deg);transform-origin: 0 0;opacity: 0.2;">
                        <img class="imgReflexoTrilha" src="img/miniaturaTrilha.svg">
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
                                <a href="https://www.unibb.com.br/home/minhas-trilhas/526/especialista-chatbot-formacao-inicial" target="_blank" style="color: white; background-color: transparent; text-decoration: underline;">Desenvolvimento de assistentes virtuais: formação inicial</a><br>
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
                                Oportunidade CFG240035<br><br>
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


                <div id="etapas">
                    <h2 id="h2Etapas">
                        etapas
                    </h2>
                    
                    <div class="apresentacaoEtapas" tabindex="36">
                        <h3 style="width: 100%; color: white; font-size: 2rem; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word; text-align: left;/*! left: 23%; */position: relative;top: 12%;" tabindex="35">
                            Etapas:
                        </h3>
                        <p class="texto-responsivo">
                            <span class="font400">
                                Explore o universo
                                <span class="font300">
                                     dos Assistentes Virtuais através de aulas,<br>desafios e
                                </span>
                                <span class="font400">
                                     conheça de perto 
                                </span>
                                <span class="font300">
                                    a rotina dos nossos<br>especialistas!
                                </span>
                            </span>
                        </p>
                        <img class="linhaDecorativaEtapas" src="img/linhaCurva.svg">
                    </div>

                    <div class="quadroPrincipalEtapas" tabindex="37">
                        <div class="etapaInscricao quadrosEtapas" style="height: 35rem;">
                            <div class="dataEtapas">
                                05/08 a 20/09
                            </div>
                            <h3 class="tituloQuadroEtapas" tabindex="38">
                                Inscrição
                            </h3>
                            <div class="detalhesEtapas" tabindex="39">
                                <span>Tudo certo? Então <a href="https://plataforma.atendimento.bb.com.br:49286/estatico/gaw/app/spas/index/index.app.html?cd_modo_uso=44&app=tao.inscricao#/" target="_blank" tabindex="16" style="color: white; background-color: transparent; text-decoration: underline;">clique aqui</a> para se inscrever<br><br>Os interessados terão o prazo de </span>
                                <span style="font-weight: 700;">45 dias para se inscrever</span>
                                <span> após a divulgação do Programa de Formação em Desenvolvimento de Assistentes Virtuais! – CAD na AGN. <br><br>A lista com os aprovados para a próxima etapa será divulgada por email e por este hotsite em até 15 dias após o encerramento das inscrições</span>
                            </div>
                        </div> 

                        <div class="etapaFormacao quadrosEtapas" style="height: 45rem;">
                            <div class="dataEtapas">
                                07/10 a 29/11
                            </div>
                            <h3 class="tituloQuadroEtapas" tabindex="40">
                                Formação
                            </h3>
                            <div class="detalhesEtapas" tabindex="41">
                                A etapa de formação será dividida em 4 temas:<br><br>
                                👉 Onboarding: da ideia ao HLD<br>
                                👉 Ferramentas e arquitetura<br>
                                👉 Prática de desenvolvimento de chatbots no BB I: disparos ativos<br>
                                👉 Prática de desenvolvimento de chatbots no BB II: jornadas orgânicas<br><br>
                                Cada tema será composto por uma aula com duração de 2 horas e um desafio prático<br><br>
                                As aulas ficarão gravadas e poderão ser assistidas de forma assíncrona. <br><br>
                                Confira todos os detalhes no regulamento
                            </div>
                        </div>

                        <div class="etapaEstagio quadrosEtapas" style="height: 33rem;">
                            <div class="dataEtapas">
                                06/01 a 31/01
                            </div>
                            <h3 class="tituloQuadroEtapas" tabindex="42">
                                Estágio
                            </h3>
                            <div class="detalhesEtapas" tabindex="43">
                                <span>O estágio tem </span>
                                <span style="font-weight: 700;">duração de 2 semanas<br><br></span>
                                <span>Serão duas turmas de até 6 pessoas que terão a oportunidade de ter 
                                    <span style="font-weight: 700;">
                                        atividades práticas e mentoria
                                    </span> 
                                    com os especialistas presencialmente em São Paulo<br><br>
                                </span>
                                <span style="font-weight: 700;">
                                    Turma 1:
                                </span> 
                                <span>
                                        06/01/2025 a 17/01/2025<br><br>
                                </span>
                                
                                <span style="font-weight: 700;">
                                    Turma 2:
                                </span>
                                <span>
                                        20/01/2025 a 31/01/2025
                                </span>
                                
                            </div>
                        </div>
                        <img class="botEtapas" src="img/botEtapas.svg" />
                    </div>
                </div>

                

                <div id="linhaDoTempo">
                    <h2 id="h2LinhaDoTempo" tabindex="46">
                        linha do tempo
                    </h2>
                    <div style="width: 100%; height: 407px; position: relative;">
                        <h3 class="h3LinhaDoTempo" tabindex="47">
                            Linha do Tempo:
                        </h3>
                        <div style="width: 288px; height: 207px; left: -10px; top: 3rem; position: absolute; z-index: 1;">
                            <a href="/formacao-bots/arquivos/regulamentoProgramaFormacao.pdf" target="_blank" style="display: block; /*width: 275px; height: 215px;*/">
                                <!-- <img class="imgRegulamento" src="img/regulamento.svg" alt="Acessar o regulamento completo." tabindex="47"  -->
                                <img class="imgRegulamento" src="img/regulamento.png" alt="Acessar o regulamento completo." tabindex="48" 
                                alt="
                                    Linha do tempo do Programa: 05/08/2024 início das inscrições. 
                                    20/09/2024 encerramento das inscrições.
                                    04/10/2024 divulgação dos aprovados para etapa de formação. 
                                    07/10/2024 aula 1 'Onboarding: da ideia ao HLD (High Level Design)'. 
                                    11/10/2024 entrega do desafio. 18/10/2024 divulgação de resultados. 
                                    21/10/2024 aula 2 'Ferramentas e Arquitetura'. 
                                    25/10/2024 entrega do desafio. 
                                    01/11/2024 divulgação de resultados. 
                                    04/11/2024 aula 3: 'Prática de desenvolvimento de chatobots no BB 1: disparo de ativos'. 
                                    11/11/2024 entrega do desafio. 14/11/2024 divulgação de resultados. 
                                    18/11/2024 aula 4: 'prática de desenvolvimento de chatobots no BB 2: jornadas orgânicas'. 
                                    25/11/2024 entrega do desafio. 29/11/2024 divulgação de resultados. 
                                    De 06/01/2025 a 17/01/2025 estágio turma 1. 
                                    De 20/01/2025 a 31/01/2025 estágio turma 2. 
                                    06/02/2025 divulgação dos resultados do programa de formação.">
                            </a>
                        </div>
                        <img class="imgLinhaDoTempoDetalhe" src="img/linhaDoTempoDetalhe.svg">
                        <div style="width: 288px; height: 207px; right: -30px; top: 3rem; position: absolute; z-index: 1;">
                            <a href="mailto:cad@bb.com.br">
                                <img class="imgDuvidas" src="img/duvidas.png" alt="Envie email com sua dúvida para cad@bb.com.br">
                            </a>
                        </div>
                    </div>
                </div>

                <div id="faq">
                    <h2 id="h2Faq">
                        F.A.Q
                    </h2>
                    <div class="quadroFaq">
                        <h3 class="h3Faq" tabindex="49">
                            Perguntas frequentes:
                        </h3>
                        <div class="quadroPerguntaFaq">
                            <div class="perguntaFaq">
                                💡 Tenho interesse no assunto mas não na vaga de Assistente Operacional Pleno, posso participar do programa?
                            </div>
                            <div class="respostaFaq">
                                <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">O programa visa formar banco de talentos de até 12 funcionários com potencial para atuar na função de Assistente Operacional Pleno - código de função 16460, oportunidade CFG240035, GFM 19.<br><br>Você pode seguir a trilha de Desenvolvimento de Assistentes Virtuais na UniBB e </span><span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 500; word-wrap: break-word">acompanhar as aulas após elas serem lançadas aqui no nosso hotsite, mesmo sem se inscrever no Programa.</span><span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">É uma ótima oportunidade para aprimorar seus conhecimentos em novas tecnologias.</span>
                            </div>
                        </div>
                    </div>
                </div>
                


                <div id="aulas" tabindex="50" style="padding-top: 5rem;">
                    <h2 id="h2Aulas">
                        aulas
                    </h2>
                    <div class="quadroAulas">
                        <h3 class="h3Aulas" tabindex="51">
                            Aulas:
                        </h3>
                        <div class="divVideoAulas">
                            <div class="aula01 divAula">
                                <div class="imagemAula" style="background-image: url(https://cad.bb.com.br/formacao-bots/img/aula01.png);" class="imagemAula">
                                </div>
                                <div class="divTituloVideoAulas">
                                    <div class="tituloAula">Onboarding: da ideia ao HLD</div>
                                    <div class="botoesAula">
                                        <div class="botaoAula acessaAula aulaIndisponivel">Acessar aula</div>
                                        <div class="botaoAula acessaRecurso aulaIndisponivel">Recursos</div>
                                    </div>
                                </div>
                            </div>
                            <div class="aula02 divAula">
                                <div class="imagemAula" style="background-image: url(https://cad.bb.com.br/formacao-bots/img/aula02.png);" class="imagemAula">
                                </div>
                                <div class="divTituloVideoAulas">
                                    <div class="tituloAula">Ferramentas e arquitetura</div>
                                    <div class="botoesAula">
                                        <div class="botaoAula acessaAula aulaIndisponivel">Acessar aula</div>
                                        <div class="botaoAula acessaRecurso aulaIndisponivel">Recursos</div>
                                    </div>
                                </div>
                            </div>
                            <div class="aula03 divAula">
                                <div class="imagemAula" style="background-image: url(https://cad.bb.com.br/formacao-bots/img/aula03.png);" class="imagemAula">
                                </div>
                                <div class="divTituloVideoAulas">
                                    <div class="tituloAula">Prática de desenvolvimento de chatbots no BB I: disparos ativos</div>
                                    <div class="botoesAula">
                                        <div class="botaoAula acessaAula aulaIndisponivel">Acessar aula</div>
                                        <div class="botaoAula acessaRecurso aulaIndisponivel">Recursos</div>
                                    </div>
                                </div>
                            </div>
                            <div class="aula04 divAula">
                                <div class="imagemAula" style="background-image: url(https://cad.bb.com.br/formacao-bots/img/aula04.png);" class="imagemAula">
                                </div>
                                <div class="divTituloVideoAulas">
                                    <div class="tituloAula">Prática de desenvolvimento de chatbots no BB II: jornadas orgânicas</div>
                                    <div class="botoesAula">
                                        <div class="botaoAula acessaAula aulaIndisponivel">Acessar aula</div>
                                        <div class="botaoAula acessaRecurso aulaIndisponivel">Recursos</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="resultados" tabindex="52" style="padding-top: 5rem;">
                    <h2 id="h2Resultados">
                        resultados
                    </h2>
                    <div class="quadroResultados">
                        <h3 class="h3Resultados" tabindex="53">
                            Resultados:
                        </h3>
                        <div class="divAcessaResultados">
                            <div class="acessaResultado resultado01">
                                <div class="tituloResultado">Onboarding: da ideia ao HLD</div>
                                <div class="botaoAcessaResultado aulaIndisponivel">Acessar resultado</div>
                            </div>
                            <div class="acessaResultado resultado02">
                                <div class="tituloResultado">Ferramentas e arquitetura</div>
                                <div class="botaoAcessaResultado aulaIndisponivel">Acessar resultado</div>
                            </div>
                            <div class="acessaResultado resultado03">
                                <div class="tituloResultado">Prática de desenvolvimento de chatbots no BB I: disparos ativos</div>
                                <div class="botaoAcessaResultado aulaIndisponivel">Acessar resultado</div>
                            </div>
                            <div class="acessaResultado resultado04">
                                <div class="tituloResultado">Prática de desenvolvimento de chatbots no BB II: jornadas orgânicas</div>
                                <div class="botaoAcessaResultado aulaIndisponivel">Acessar resultado</div>
                            </div>
                            <div class="acessaResultado resultado05">
                                <div class="tituloResultado">Resultado Final</div>
                                <div class="botaoAcessaResultado aulaIndisponivel">Acessar resultado</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php include_once "rodape.php"; ?>
                <?php include_once "bot.php"; ?>

            </div>
        </main>
        <script>
            function scrollToSection(sectionId) {
                document.getElementById(sectionId).scrollIntoView({ behavior: 'smooth' });
            }

            let mybutton = document.getElementById("toTop");
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
        </script>
    </body>
</html>