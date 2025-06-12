<?php

//ini_set('display_errors', 1);
if(!isset($_SESSION)){
    session_start();
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/home/class/class_home.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";
$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Home', $_SESSION['ip']);


include $_SERVER["DOCUMENT_ROOT"]."/pages/montaCabecalho.php";
$class = new cabecalho();


$class = new funcoes();
$avisoEcoa = $class->carregaAvisoEcoa();
$destaque =  $class->carregaReportDestaque();
$indisponibilidade = $class->carregaReportIndisponibilidades();
$trending = $class->carregaReportTrending();
$pesquisas = $class->carregaPesquisas();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <meta name="description" content="Central de Atendimento Digital Banco do Brasil"/>

    <title>Portal CAD</title>
    <link href="../lib/img/img_bot/bot.ico" mce_href="../lib/img/img_bot/bot.ico" rel="icon">
    <link href="../lib/img/img_bot/bot.ico" mce_href="../lib/img/img_bot/bot.ico" rel="shortcut icon">

    <!-- CSS Bootstrap -->
    <link href="../lib/css/bootstrap-grid.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-grid.rtl.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-grid.rtl.min.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-reboot.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-reboot.min.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-reboot.rtl.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-reboot.rtl.min.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-utilities.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-utilities.min.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-utilities.rtl.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-utilities.rtl.min.css" rel="stylesheet">
    <link href="../lib/css/bootstrap.css" rel="stylesheet">
    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/css/bootstrap.rtl.css" rel="stylesheet">
    <link href="../lib/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- CSS Datatables -->
    <link href="../lib/datatables/datatables.min.css" rel="stylesheet">

    <!-- CSS da página -->
    <link href="/lib/apps/home/css/home.css" rel="stylesheet">
    <link href="../lib/css/index.css" rel="stylesheet">

    <!-- jQuery -->
    <script type="text/javascript" src="../lib/js/jquery.3.7.1.js"></script>
    <script type="text/javascript" src="../lib/js/jquery.3.7.1.min.js"></script>
    <script type="text/javascript" src="../lib/js/jquery-ui.1.13.3.js"></script>
    <script type="text/javascript" src="../lib/js/datepicker-pt-BR.js"></script>
    

    <!-- CSS Jquery Datepicker-->
    <link href="../lib/css/jquery-ui.css" rel="stylesheet">
    
    <!-- JS Bootstrap -->
    <script src="../lib/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/js/bootstrap.bundle.js"></script>
    <script src="../lib/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/js/bootstrap.esm.js"></script>
    <script src="../lib/js/bootstrap.esm.min.js"></script>
    <script src="../lib/js/bootstrap.js"></script>
    <script src="../lib/js/bootstrap.min.js"></script>

    <!-- JS Font Awesome -->
    <script src="../lib/js/fontawesome.js"></script>

    <!-- JS Bootbox -->
    <script src="../lib/js/bootbox.all.min.js"></script>

    <!-- JS Datatables -->
    <script type="text/javascript" src="../lib/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../lib/datatables/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="../lib/datatables/pdfmake.min.js"></script>
    <script type="text/javascript" src="../lib/datatables/buttons.html5.min.js"></script>

    <!-- JS do Portal -->
    <script type="text/javascript" src="../lib/js/index.js"></script>
    <script type="text/javascript" src="../lib/apps/home/js/home.js"></script>

</head>

<body style="display:flex;">

    <header class="header">
        <?php include $_SERVER["DOCUMENT_ROOT"]."/pages/cabecalho.php"; ?>
    </header>

    <div id="submenuCabecalho" attr-id="0">
        <?php echo $subMenus; ?>
    </div>

    <main>
        
        <div id="container">
            <?php

                if((date("Y-m-d")) <= "2024-12-31"){
                    echo '<div class="natal" style="background-image: url(https://cad.bb.com.br/lib/img/cabecalho/natal2.gif); background-repeat: repeat-x; width: 140%; height: 10vh; background-size: 500px; position: absolute; margin: -0.5rem -5rem;"></div>';
                }

                echo '
                        <div id="paginaHome">
                            <div id="homeCabecalho">
                                <div id="cabecalhoEsquerdo">
                                    <div id="imgBarrasCabecalho">
                                        <img src="/lib/img/apps/home/barrasColoridasCabecalho.png">
                                    </div>
                                    <div id="divTextoCabecalho">
                                        <span class="tituloCabecalho">Olá! Este é o portal da </span> <span class="tituloCabecalhoNegrito">Escola de Robôs.</span>
                                        <br><br>
                                        <span class="txtCabecalho">Acompanhe todas as novidades sobre o assistente virtual do BB</span>
                                    </div>
                                </div>
                                <div id="cabecalhoDireito">
                                    <div id="idDivImgBot">
                                        <img src="/lib/img/apps/home/imgBotnoCelularSimples.png" style="position: relative;right: 30%;bottom: 12%;">
                                    </div>
                                </div>
                            </div>
                            <div id="divAssistentesDigitais">
                                
                                <div id="divSuperiorAsstDig">
                                    <div id="divTxtTituloAssDigSuperior">
                                        <div id="divTituloAssDigSuperior">
                                            <span class="tituloAsstDig">Você conhece os</span>
                                                <br>
                                                <span class="tituloNegritoAsstDig">
                                                    Assistentes Digitais do BB?
                                                    <img src="/lib/img/apps/home/iconeVerificado.png">
                                                </span>
                                            </span>
                                        </div>
                                        <br>
                                        <br>
                                        <div id="divTxtAssDigi">    
                                            <span class = "txtAssDigi"> O
                                            <span class="txtAssDigiNegrito">Centro de Assistentes Digital (CAD)</span> é responsável pelo desenvolvimento dos <span class="txtAssDigiNegrito">assistentes conversacionais para cliente externo do Banco do Brasil</span>, um chatbot de autoatendimento  disponível em várias plataformas, como o App BB, Instagram e, principalmente, WhatsApp.
                                            <br>
                                            <br> 
                                            O assistente virtual é desenvolvido com <span class="txtAssDigiNegrito">ferramentas internas </span>do BB, como o NIA e outros diversos painéis, além de <span class="txtAssDigiNegrito">inteligência artificial</span> e parcerias com grandes empresas de tecnologia. Tudo isso para garantir a <span class="txtAssDigiNegrito">melhor experiência </span> de atendimento ao cliente.</span> 
                                        </div>    
                                    </div>    
                                </div>
                                <div id="divInferiorAsstDig">
                                    <div id="divImgCelular">
                                        <img src="/lib/img/apps/home/celular.png">
                                    </div>
                                    <div class="containerBalao"> 
                                        <div class="setaLateralBalao">
                                            
                                        </div>
                                        <div id="divBalaoDialogoVerde">      
                                                O chatbot do BB se destaca pela <span class="txtBalaoNegrito"> eficiência e versatilidade </span>, oferecendo cerca de <span class="txtBalaoNegrito"> 135 transações</span>, como envio de Pix, consulta de saldos e limites, e realização de pagamentos. Além disso, ele proporciona mais de <span class="txtBalaoNegrito"> 10 mil jornadas </span> e subjornadas de autoatendimento, enviando notificações e ofertas de forma ativa. Tudo isso é realizado com máxima <span class="txtBalaoNegrito"> segurança e praticidade</span>.
                                                Mensalmente, registramos aproximadamente <span class="txtBalaoNegrito"> 15 milhões de conversas </span> e contamos com <span class="txtBalaoNegrito"> 5 milhões de usuários engajados</span>, que utilizam os canais para realizarem operações.
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <div class="divAvisosEcoa">
                                <div class="divCentralConteudoEcoa">
                                    <div class ="divSuperiorConteudoEcoa">
                                        <div class="divSuperiorLinhaSuperiorConteudoEcoa">
                                            <div class="tituloAvisoEcoa">
                                                Avisos ECOA:
                                            </div>
                                            <div class="btnAzulContainer Clicar">
                                                Adicionar Aviso
                                            </div>
                                        </div>
                                        <div class="subtituloAvisoEcoa">
                                            Fique por dentro de todas as novidades e saiba tudo o que está acontecendo aqui no CAD. 
                                        </div>
                                   </div>
                                   <div id ="wrapper">
                                        <div id="carrossel">
                                            <div id="content">
                                                <img src="/lib/img/apps/home/chevronEsquerdoCarrossel.png" class="chevronCarrossel Clicar" id="prev">
                                                '.$avisoEcoa['mensagem'].'
                                                <!--<div class="divAviso">
                                                    <div class="divIntervaAviso">
                                                        <div class="divCentralizaEcoa">
                                                            <img src="/lib/img/apps/home/iconeMegafone.png" style=" padding-bottom: 2%;">
                                                        </div>
                                                        <p class="dataAvisoEcoa">12/12/2024</p>
                                                        <p class="nomeAviso">Mobilização ECOA</p>
                                                        <div class="divCentralizaEcoa">
                                                            <div class="btnVerMaisEcoa clicar">
                                                                Ver mais
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                                                                    <path d="M1.52227 0.5L0 2.0275L4.94467 7L0 11.9725L1.52227 13.5L8 7L1.52227 0.5Z" fill="white"/>
                                                                </svg>
                                                            </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="divAviso">
                                                    <div class="divIntervaAviso">
                                                        <div class="divCentralizaEcoa">
                                                            <img src="/lib/img/apps/home/iconeMegafone.png" style=" padding-bottom: 2%;">
                                                        </div>
                                                        <p class="dataAvisoEcoa">10/12/2024</p>
                                                        <p class="nomeAviso">4ª Semana de Experimentação</p>
                                                        <div class="divCentralizaEcoa">
                                                            <div class="btnVerMaisEcoa clicar">
                                                                Ver mais
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                                                                    <path d="M1.52227 0.5L0 2.0275L4.94467 7L0 11.9725L1.52227 13.5L8 7L1.52227 0.5Z" fill="white"/>
                                                                </svg>
                                                            </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="divAviso">
                                                    <div class="divIntervaAviso">
                                                        <div class="divCentralizaEcoa">
                                                            <img src="/lib/img/apps/home/iconeMegafone.png" style=" padding-bottom: 2%;">
                                                        </div>
                                                        <p class="dataAvisoEcoa">12/12/2024</p>
                                                        <p class="nomeAviso">Mobilização ECOA</p>
                                                        <div class="divCentralizaEcoa">
                                                            <div class="btnVerMaisEcoa clicar">
                                                                Ver mais
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                                                                    <path d="M1.52227 0.5L0 2.0275L4.94467 7L0 11.9725L1.52227 13.5L8 7L1.52227 0.5Z" fill="white"/>
                                                                </svg>
                                                            </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="divAviso">
                                                    <div class="divIntervaAviso">
                                                        <div class="divCentralizaEcoa">
                                                            <img src="/lib/img/apps/home/iconeMegafone.png" style=" padding-bottom: 2%;">
                                                        </div>
                                                        <p class="dataAvisoEcoa">10/12/2024</p>
                                                        <p class="nomeAviso">4ª Semana de Experimentação</p>
                                                        <div class="divCentralizaEcoa">
                                                            <div class="btnVerMaisEcoa clicar">
                                                                Ver mais
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                                                                    <path d="M1.52227 0.5L0 2.0275L4.94467 7L0 11.9725L1.52227 13.5L8 7L1.52227 0.5Z" fill="white"/>
                                                                </svg>
                                                            </div>
                                                    </div>
                                                    </div>
                                                </div> -->
                                                <img src="/lib/img/apps/home/chevronDireitoCarrossel.png" class="chevronCarrossel Clicar" id="next">
                                            </div> <!--fim id content-->
                                        </div> <!--Fim id carrossel-->
                                    </div> <!--Fim id wraper-->
                                </div>
                            </div> <!-- fim área ecoa-->
                            <div class ="areaReportDestaques">
                                <div class="divItemReport">
                                    <div class="divCabecalhoItemReport" id="cabecalhoDestaqueReport">
                                        <img src="/lib/img/apps/home/destaquesIcon.svg" class="imgIconItemReport"> <span class="tituloItemReport">Destaques</span>
                                    </div>
                                    '.$destaque['mensagem'].'
                                </div>
                                <div class="divItemReport">
                                    <div class="divCabecalhoItemReport" id="cabecalhoTrendingReport">
                                        <img src="/lib/img/apps/home/trendingIcon.svg" class="imgIconItemReport">
                                        <span class="tituloItemReport">Trending</span>
                                    </div>
                                    <div class="divTxtItemReport">
                                        '.$trending['mensagem'].'
                                    </div>
                                </div>
                                <div class="divItemReport">
                                    <div class="divCabecalhoItemReport" id= "cabecalhoIndisponibilidadeReport">
                                        <img src="/lib/img/apps/home/indisponibilidadesIcon.svg" class="imgIconItemReport">
                                        <span class="tituloItemReport">Indisponibilidades</span>
                                    </div>
                                   '.$indisponibilidade['mensagem'].'
                                </div>
                            </div> <!--Fim area report -->
                            <div class="nestMenu">
                                <div id="menuAreaPortal">
                                    <div class="itemMenuAreas Clicar" id="menuPesquisas">
                                        <svg id ="pesquisasIcone" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill ="white">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.4246 14.4246C16.4094 13.2187 17 11.6783 17 10C17 6.13401 13.866 3 10 3C6.13401 3 3 6.13401 3 10C3 13.866 6.13401 17 10 17C11.6783 17 13.2187 16.4094 14.4245 15.4246L15 16.0001V17L19 21L21 19L17 15H16L15.4246 14.4246ZM10 15C12.7614 15 15 12.7614 15 10C15 7.23858 12.7614 5 10 5C7.23858 5 5 7.23858 5 10C5 12.7614 7.23858 15 10 15Z"/>
                                        </svg>
                                        <span class="itemMenuSelecionado" id="idSpanPesquisasMenu">Pesquisas</span>
                                    </div>
                                    <div class="itemMenuAreas Clicar" id="menuRecursos">
                                        <svg id="recursosIcone" xmlns="http://www.w3.org/2000/svg" width="27" height="25" viewBox="0 0 27 25" fill="black">
                                            <path d="M22.1564 13.2822C22.2021 12.9548 22.2364 12.6273 22.2364 12.2794C22.2364 11.9315 22.2021 11.6041 22.1564 11.2766L24.5667 9.58827C24.7837 9.43478 24.8408 9.1585 24.7037 8.93339L22.4192 5.39292C22.2821 5.1678 21.9737 5.08594 21.7224 5.16781L18.8781 6.19106C18.2841 5.78176 17.6444 5.44408 16.9476 5.18827L16.5136 2.47664C16.4793 2.23106 16.2394 2.04688 15.9539 2.04688H11.3847C11.0992 2.04688 10.8593 2.23106 10.825 2.47664L10.3909 5.18827C9.69416 5.44408 9.05448 5.79199 8.46049 6.19106L5.61621 5.16781C5.35349 5.07571 5.0565 5.1678 4.91942 5.39292L2.63486 8.93339C2.48636 9.1585 2.5549 9.43478 2.77193 9.58827L5.18215 11.2766C5.13646 11.6041 5.10219 11.9418 5.10219 12.2794C5.10219 12.6171 5.13646 12.9548 5.18215 13.2822L2.77193 14.9706C2.5549 15.1241 2.49779 15.4004 2.63486 15.6255L4.91942 19.1659C5.0565 19.3911 5.36491 19.4729 5.61621 19.3911L8.46049 18.3678C9.05448 18.7771 9.69416 19.1148 10.3909 19.3706L10.825 22.0822C10.8593 22.3278 11.0992 22.512 11.3847 22.512H15.9539C16.2394 22.512 16.4793 22.3278 16.5136 22.0822L16.9476 19.3706C17.6444 19.1148 18.2841 18.7669 18.8781 18.3678L21.7224 19.3911C21.9851 19.4832 22.2821 19.3911 22.4192 19.1659L24.7037 15.6255C24.8408 15.4004 24.7837 15.1241 24.5667 14.9706L22.1564 13.2822ZM13.6693 15.8608C11.4647 15.8608 9.67131 14.2543 9.67131 12.2794C9.67131 10.3045 11.4647 8.69804 13.6693 8.69804C15.8739 8.69804 17.6673 10.3045 17.6673 12.2794C17.6673 14.2543 15.8739 15.8608 13.6693 15.8608Z"/>
                                        </svg>
                                        <span id= "idSpanRecursosMenu" class="itemMenuNaoSelecionado">Recursos</span>
                                    </div>
                                    <div class="itemMenuAreas Clicar" id="menuExperimentacoes">
                                        <svg id="experimentacoesIcone"mlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="black">
                                            <path d="M12.303 2.06397C12.0848 1.97868 11.841 1.97868 11.6228 2.06397L7.2003 3.97137C7.12214 4.00582 7.12037 4.11609 7.19739 4.15304L12 6.5L16.7282 4.17607C16.8048 4.13935 16.805 4.03067 16.7276 3.99573L16.4762 3.88197C15.5603 3.46724 13.4776 2.52417 12.303 2.06397Z" />
                                            <path d="M7 8.87366V5L11.5 7.25V11.6137L7.40417 9.54864C7.15333 9.40687 7 9.15011 7 8.87366Z" />
                                            <path d="M17 8.87366V5L12.5 7.25V11.6137L16.5958 9.54864C16.8467 9.40687 17 9.15011 17 8.87366Z" />
                                            <path d="M7.72091 11.4105C8.07636 11.0847 8.65091 11.0847 9.00636 11.4105L9.75346 12.1769C9.9871 12.3911 10.0762 12.7044 9.98437 12.9961L8.65909 17.8332H3.25545L2.09545 15.7056C2.03273 15.5906 2 15.4623 2 15.3331V7.83289C2 7.37288 2.40636 6.99953 2.90909 6.99953H3.81818C4.23545 6.99953 4.59909 7.26038 4.70091 7.63122L6.12909 12.8697L7.72091 11.4105Z" />
                                            <path d="M2.90909 18.6666H8.36364C8.86636 18.6666 9.27273 19.0399 9.27273 19.4999V21.1666C9.27273 21.6267 8.86636 22 8.36364 22H2.90909C2.40636 22 2 21.6267 2 21.1666V19.4999C2 19.0399 2.40636 18.6666 2.90909 18.6666Z"/>
                                            <path d="M16.2933 11.4105C15.9387 11.0847 15.3656 11.0847 15.0111 11.4105L14.2658 12.1769C14.0328 12.3911 13.9439 12.7044 14.0355 12.9961L15.3575 17.8332H20.7477L21.9048 15.7056C21.9674 15.5906 22 15.4623 22 15.3331V7.83289C22 7.37288 21.5946 6.99953 21.0932 6.99953H20.1863C19.7701 6.99953 19.4074 7.26038 19.3058 7.63122L17.8812 12.8697L16.2933 11.4105Z" />
                                            <path d="M21.0932 18.6666H15.6522C15.1507 18.6666 14.7454 19.0399 14.7454 19.4999V21.1666C14.7454 21.6267 15.1507 22 15.6522 22H21.0932C21.5946 22 22 21.6267 22 21.1666V19.4999C22 19.0399 21.5946 18.6666 21.0932 18.6666Z" />
                                        </svg>
                                        <span class="itemMenuNaoSelecionado" id="idSpanExperimentacoesMenu">Experimentações</span>
                                    </div>
                                    <div class="itemMenuAreas Clicar" id="menuPaineis">
                                        <svg id="paineisIcone" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="black">
                                            <path d="M2 17.999H22V19.999H2V17.999Z"  />
                                            <path d="M10 10.999H14V16.999H10V10.999Z"/>
                                            <path d="M16 5H20V16.999H16V5Z"/>
                                            <path d="M4 8.999H8V16.999H4V8.999Z"/>
                                        </svg>
                                        <span class="itemMenuNaoSelecionado" id="idSpanPaineisMenu">Painéis</span>

                                    </div>
                                    <div class="itemMenuAreas Clicar" id="menuEstudos">
                                        <svg id="estudosIcone"xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="black">
                                            <path d="M21 4H19V13L17 11L15 13V4H14C13.734 4 13.481 4.106 13.293 4.293L12 5.586L10.707 4.293C10.519 4.106 10.266 4 10 4H3C2.447 4 2 4.448 2 5V18C2 18.552 2.447 19 3 19H9.586L11.293 20.707C11.488 20.902 11.744 21 12 21C12.256 21 12.512 20.902 12.707 20.707L14.414 19H21C21.553 19 22 18.552 22 18V5C22 4.448 21.553 4 21 4ZM10 16H4V15H10V16ZM10 13H4V12H10V13ZM10 10H6V9H10V10Z" />
                                        </svg>
                                        <span class="itemMenuNaoSelecionado" id="idSpanEstudosMenu">Estudos</span>
                                    </div>
                                    <div class="itemMenuAreas Clicar" id="menuCopilotos">
                                        <svg id="copilotosIcone"xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="black">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.80401 0.0265124C3.61613 0.0553919 3.35961 0.139715 3.33874 0.17944C3.33054 0.195098 3.3041 0.207984 3.28003 0.208106C3.1768 0.208594 2.73362 0.60063 2.60966 0.801112C2.39645 1.14599 2.32841 1.28993 2.24409 1.57467L2.1752 1.80723L2.16766 8.61586L2.1601 15.4245L2.18895 15.653C2.2246 15.9355 2.26744 16.0913 2.3899 16.3836L2.48544 16.6116L2.7192 16.8905C2.94183 17.156 3.00562 17.2099 3.27508 17.3601C3.45768 17.4618 3.58245 17.5044 3.80582 17.541L4.01294 17.5749L12.1294 17.5659L20.246 17.5569L20.4142 17.4875C20.5068 17.4493 20.6777 17.3624 20.7941 17.2945L21.0057 17.1709L21.2083 16.9345C21.3198 16.8045 21.434 16.6585 21.4621 16.6101C21.5683 16.4273 21.6869 16.1192 21.7363 15.8977L21.7875 15.6682L21.7887 8.81387C21.7895 4.09061 21.7814 1.91218 21.7624 1.80723C21.7213 1.57946 21.6505 1.32603 21.6127 1.27171C21.5943 1.24527 21.5793 1.21243 21.5793 1.19872C21.5793 1.14791 21.3924 0.844796 21.2615 0.683308C21.1235 0.513169 20.8032 0.238356 20.7428 0.238356C20.7244 0.238356 20.6981 0.225105 20.6843 0.208898C20.6316 0.146783 20.3132 0.0496948 20.0777 0.0238312C19.7729 -0.00964836 4.02226 -0.00702809 3.80401 0.0265124ZM0.687249 4.51128C0.429178 4.55021 0.201553 4.74353 0.0689709 5.03638L0 5.1887V7.85427V10.5198L0.0709126 10.6781C0.15578 10.8675 0.298563 11.0484 0.440129 11.1459L0.543689 11.2171L0.942628 11.2298C1.35632 11.2429 1.52176 11.2151 1.55029 11.1277C1.57085 11.0646 1.57243 4.64876 1.5519 4.58585C1.54296 4.55847 1.51096 4.52682 1.4808 4.51554C1.39933 4.48514 0.879197 4.48234 0.687249 4.51128ZM22.4479 4.53867L22.3948 4.58927L22.388 7.83172L22.3812 11.0742L22.4368 11.1573L22.4923 11.2405L22.9614 11.2292C23.4209 11.2181 23.4573 11.211 23.6206 11.1007C23.7293 11.0272 23.8853 10.8275 23.9432 10.6874L24 10.5503V7.88473V5.21916L23.9527 5.08314C23.8636 4.82722 23.614 4.57583 23.3916 4.51807C23.3417 4.50513 23.121 4.49309 22.901 4.49129L22.501 4.48804L22.4479 4.53867ZM7.37864 5.32737C7.2298 5.35275 7.07495 5.39762 6.9644 5.44746C6.64689 5.59061 6.52647 5.66966 6.30441 5.88071C6.14783 6.02953 5.94447 6.31701 5.85944 6.50969C5.83257 6.57062 5.78444 6.67532 5.75252 6.74234C5.51184 7.24765 5.49641 8.0004 5.71329 8.65784C5.78558 8.87699 5.83293 8.9792 5.96147 9.19354C6.04295 9.32941 6.44391 9.77759 6.52373 9.82201C6.56673 9.84595 6.65437 9.89786 6.71845 9.93734C6.90058 10.0495 7.02568 10.1015 7.24668 10.1569L7.45129 10.2082L7.72564 10.1911C7.99876 10.174 8.24269 10.1149 8.38586 10.0308C8.42721 10.0066 8.47283 9.98672 8.48725 9.98672C8.52471 9.98672 8.89584 9.71322 8.95997 9.63831C8.98959 9.60376 9.03619 9.55249 9.06353 9.52444C9.27622 9.30623 9.48334 8.92318 9.61256 8.50924C9.67216 8.31829 9.70568 8.04156 9.70485 7.74743C9.70294 7.07671 9.50283 6.51186 9.09597 6.02861C8.94801 5.8529 8.76127 5.68544 8.64857 5.62744C8.61936 5.61242 8.57799 5.58838 8.55663 5.57403C8.25222 5.36962 7.74897 5.26425 7.37864 5.32737ZM16.2977 5.31421C15.9682 5.37136 15.8404 5.40792 15.6505 5.49946C15.04 5.79371 14.6004 6.38805 14.4045 7.18407C14.3838 7.26809 14.3705 7.49218 14.3701 7.76288L14.3696 8.2046L14.4373 8.44831C14.7218 9.47301 15.4251 10.1261 16.3124 10.1895C16.7174 10.2185 17.0704 10.1253 17.4206 9.8971C17.725 9.69878 18.0529 9.32941 18.2032 9.01566C18.3206 8.77043 18.3439 8.70883 18.4121 8.46354L18.4842 8.2046L18.4848 7.76288L18.4854 7.32115L18.428 7.10632C18.3713 6.89424 18.2937 6.67773 18.2322 6.56005C18.0813 6.27125 17.9916 6.13173 17.8919 6.03108C17.8645 6.00339 17.8121 5.94551 17.7754 5.90243C17.6254 5.7262 17.2747 5.50068 17.006 5.40758C16.8317 5.34723 16.4202 5.29298 16.2977 5.31421ZM9.43436 12.5983C9.34788 12.613 9.18304 12.8124 9.17564 12.9112C9.16116 13.1045 9.17861 13.1459 9.36922 13.3709C9.70786 13.7707 9.98775 13.988 10.5631 14.2978C11.0149 14.541 11.7655 14.6768 12.3364 14.6184C13.1233 14.5381 13.7285 14.261 14.4212 13.664C14.4642 13.627 14.5778 13.5025 14.6736 13.3874L14.8479 13.1781V13.0258V12.8736L14.7474 12.7553L14.6469 12.6371H14.5308C14.3976 12.6371 14.3737 12.6554 13.9806 13.0592C13.6903 13.3574 13.1241 13.6558 12.6343 13.7688L12.3754 13.8285L12.0194 13.8274L11.6635 13.8263L11.411 13.7657C10.8061 13.6205 10.3919 13.3749 9.86408 12.8484C9.6321 12.6171 9.56238 12.5765 9.43436 12.5983ZM11.6764 18.6589C11.1448 18.6801 10.4039 18.7876 9.90291 18.9163C9.76764 18.9511 9.58705 18.9976 9.50162 19.0197C9.30501 19.0704 8.49157 19.358 8.38835 19.4133C8.34563 19.4361 8.25825 19.4755 8.19417 19.5007C8.06483 19.5516 7.97481 19.5934 7.68932 19.7351C7.4764 19.8408 7.46674 19.8459 7.18447 20.0049C7.03495 20.0891 6.88349 20.1729 6.8479 20.1911C6.8123 20.2093 6.70162 20.2785 6.60194 20.3449C6.50226 20.4112 6.38576 20.4872 6.34304 20.5136C6.30032 20.5401 6.22302 20.5917 6.17121 20.6283C6.11943 20.6648 5.99127 20.7537 5.88642 20.8259C5.58977 21.03 5.2496 21.2925 4.97087 21.5324C4.9222 21.5743 4.84065 21.6429 4.78964 21.6848C4.6168 21.8267 4.50511 21.9254 4.42718 22.0051C4.38447 22.0488 4.24267 22.186 4.11208 22.31C3.84551 22.5632 3.75997 22.6804 3.70278 22.8711C3.56872 23.3182 3.82271 23.8625 4.21502 23.969C4.28373 23.9877 7.17463 23.9988 12.0832 23.9993L19.8427 24L19.977 23.9377C20.1402 23.8621 20.2152 23.7951 20.3066 23.6435C20.5523 23.2363 20.4991 22.7991 20.1618 22.4535C19.9678 22.2548 19.6937 22.001 19.496 21.8371C19.3848 21.7449 19.2738 21.6474 19.2492 21.6204C19.2246 21.5934 19.0852 21.4769 18.9394 21.3615C18.5355 21.0419 18.464 20.9877 18.4067 20.9574C18.3776 20.9421 18.3384 20.9075 18.3194 20.8806C18.3004 20.8538 18.2704 20.8318 18.2527 20.8318C18.2351 20.8318 18.1927 20.806 18.1588 20.7746C18.1248 20.7431 18.0271 20.6728 17.9417 20.6184C17.8563 20.5639 17.7049 20.4666 17.6052 20.402C17.2822 20.1927 16.6613 19.8408 16.3754 19.705C16.2971 19.6679 16.2097 19.6252 16.1812 19.6104C16.0332 19.5331 15.5306 19.3277 15.1586 19.1924C14.6582 19.0104 13.8139 18.8077 13.2427 18.7325C12.9053 18.6881 12.2 18.6371 12.0263 18.6445C11.9478 18.6479 11.7903 18.6544 11.6764 18.6589Z" />
                                        </svg>
                                        <span class="itemMenuNaoSelecionado" id="idSpanCopilotosMenu">Copilotos</span>

                                    </div>
                                </div> <!-- Fim div menu -->
                            </div><!-- fim div nest menu -->
                            <div id ="resumoAreasPortal">
                                <div id="areaPesquisas">
                                    '.$pesquisas['mensagem'].'
                                </div>
                                <div id="areaRecursos">
                                </div>
                                <div id="areaExperimentacoes">
                                </div>
                                <div id="areaPaineis">
                                </div>
                                <div id="areaEstudos">
                                </div>
                                <div id="areaCopilotos">
                                </div>
                            </div>
                        </div> <!--Fim div home -->

                    ';
                
                include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php";        

            ?>
        </div>
    </main>
    <script>
        $(document).ready(function(){
            $(this).scrollTop(0);
        });
    </script>
</body>









