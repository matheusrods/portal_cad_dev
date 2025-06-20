<?php 

session_start();

if(!isset($_SESSION['matricula'])){
    session_start();
    include_once $_SERVER["DOCUMENT_ROOT"]."/lib/login/login.php";
    header('Location: https://login.intranet.bb.com.br/sso/XUI/?goto=https%3A%2F%2Fcad.bb.com.br%2Flib%2Fapps%2Fmentoria%2Fapp%2Fformulario_yas.php#login/');
    die;
}

// ini_set("display_errors", E_ALL);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/mentoria/class/class_mentoria.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Formulário Mentoria', $_SESSION['ip']);
// echo '<!-- CSS específico do app --><link href="/lib/apps/mentoria/css/mentoria_formulario.css" rel="stylesheet">';
// echo '<!-- jQuery --><script type="text/javascript" src="../../../js/jquery.3.7.1.js"></script><script type="text/javascript" src="../../../js/jquery.3.7.1.min.js"></script>';
// echo '<!-- JS específico do app --><script type="text/javascript" src="/lib/apps/mentoria/js/mentoria.js"></script>';

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <meta name="description" content="Centro de Assistentes Digitais Banco do Brasil"/>

    <title>Portal CAD</title>
    <link href="../../../img/img_bot/bot.ico" mce_href="../../../img/img_bot/bot.ico" rel="icon">
    <link href="../../../img/img_bot/bot.ico" mce_href="../../../img/img_bot/bot.ico" rel="shortcut icon">

    <!-- CSS Bootstrap -->
    <link href="../../../css/bootstrap-grid.css" rel="stylesheet">
    <link href="../../../css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="../../../css/bootstrap-grid.rtl.css" rel="stylesheet">
    <link href="../../../css/bootstrap-grid.rtl.min.css" rel="stylesheet">
    <link href="../../../css/bootstrap-reboot.css" rel="stylesheet">
    <link href="../../../css/bootstrap-reboot.min.css" rel="stylesheet">
    <link href="../../../css/bootstrap-reboot.rtl.css" rel="stylesheet">
    <link href="../../../css/bootstrap-reboot.rtl.min.css" rel="stylesheet">
    <link href="../../../css/bootstrap-utilities.css" rel="stylesheet">
    <link href="../../../css/bootstrap-utilities.min.css" rel="stylesheet">
    <link href="../../../css/bootstrap-utilities.rtl.css" rel="stylesheet">
    <link href="../../../css/bootstrap-utilities.rtl.min.css" rel="stylesheet">
    <link href="../../../css/bootstrap.css" rel="stylesheet">
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../css/bootstrap.rtl.css" rel="stylesheet">
    <link href="../../../css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- CSS Datatables -->
    <link href="../../../datatables/datatables.min.css" rel="stylesheet">

    <!-- CSS da página -->
    <link href="../../../css/index.css" rel="stylesheet">

    <!-- jQuery -->
    <script type="text/javascript" src="../../../js/jquery.3.7.1.js"></script>
    <script type="text/javascript" src="../../../js/jquery.3.7.1.min.js"></script>
    <script type="text/javascript" src="../../../js/jquery-ui.1.13.3.js"></script>
    <script type="text/javascript" src="../../../js/datepicker-pt-BR.js"></script>
    

    <!-- CSS Jquery Datepicker-->
    <link href="../../../css/jquery-ui.css" rel="stylesheet">
    
    <!-- JS Bootstrap -->
    <script src="../../../js/bootstrap.bundle.min.js"></script>
    <script src="../../../js/bootstrap.bundle.js"></script>
    <script src="../../../js/bootstrap.bundle.min.js"></script>
    <script src="../../../js/bootstrap.esm.js"></script>
    <script src="../../../js/bootstrap.esm.min.js"></script>
    <script src="../../../js/bootstrap.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>

    <!-- JS Font Awesome -->
    <script src="../../../js/fontawesome.js"></script>

    <!-- JS Bootbox -->
    <script src="../../../js/bootbox.all.min.js"></script>

    <!-- JS Datatables -->
    <script type="text/javascript" src="../../../datatables/datatables.min.js"></script>

    <!-- JS do Portal -->
    <script type="text/javascript" src="../../../js/index.js"></script>

    <!-- CSS específico do app -->
    <link href="/lib/apps/mentoria/css/mentoria_formulario.css" rel="stylesheet">
    <!-- jQuery -->
     <script type="text/javascript" src="../../../js/jquery.3.7.1.js">

     </script><script type="text/javascript" src="../../../js/jquery.3.7.1.min.js"></script>
    <!-- JS específico do app -->
     <script type="text/javascript" src="/lib/apps/mentoria/js/mentoria.js"></script>

</head>
<div class="formularioSolicitacaoMentoria" <?php echo 'attr-matricula="'.$_SESSION['matricula'].'" attr-nome="'.$_SESSION['nome'].'" attr-email="'.$_SESSION['MAIL'].'"'?> >
    <div class="formularioDiv01" style="display: inline-flex; flex-direction: row;">
        <div id="roboBarra" style="display: inline-flex;flex-direction: column;">
            <img style="width: 778px; height: 683px; position: relative;" src="/lib/img/apps/mentoria/roboFormularioSolicitarImersao.png">
            <div id="barraPorcentagem0" style="display: block;">
                <img style="width: 372px;height: 64px;position: relative;align-content: center;" src="/lib/img/apps/mentoria/barraPorcentagem0.png">
            </div>
            <div id="barraPorcentagem20" style="display: none;">
                <img style="width: 372px;height: 64px;position: relative;align-content: center;" src="/lib/img/apps/mentoria/barraPorcentagem20.png">
            </div>
            <div id="barraPorcentagem50" style="display: none;">
                <img style="width: 372px;height: 64px;position: relative;align-content: center;" src="/lib/img/apps/mentoria/barraPorcentagem50.png">
            </div>
            <div id="barraPorcentagem70" style="display: none;">
                <img style="width: 372px;height: 64px;position: relative;align-content: center;" src="/lib/img/apps/mentoria/barraPorcentagem70.png">
            </div>
            <div id="barraPorcentagem90" style="display: none;">
                <img style="width: 372px;height: 64px;position: relative;align-content: center;" src="/lib/img/apps/mentoria/barraPorcentagem90.png">
            </div>
            <div id="barraPorcentagem100" style="display: none;">
                <img style="width: 372px;height: 64px;position: relative;align-content: center;" src="/lib/img/apps/mentoria/barraPorcentagem100.png">
            </div>
        </div>
        <div class="perguntasFormulario01" style="display: inline-flex; flex-direction: column;">
            <div id="formularioImersaoPagina0">
                <div style="width: 926px;height: 123px;position: relative;text-align: center;color: #FCFC30;font-size: 96px;font-family: 'BancoDoBrasil Titulos';font-weight: 700;word-wrap: break-word;margin-top: 5%;">
                    Vamos lá!
                </div>
                <div style="width: 100%;height: auto;position: relative;color: #FCFC30;font-size: 36px;font-family: 'BancoDoBrasil Textos';font-weight: 300;text-align: center;margin-top: 7%;">
                    A mentoria é para qual dependência?
                </div>
                <div class="botoesForm01" style="display: inline-flex;flex-direction: row;gap: 5%;margin-top: 5%;">
                    <div class="qualDependenciaImersao" style="width: 45%;height: auto;position: relative;border: 1px #FCFC30 solid;border-radius: 14px;display: inline-flex;" attr-dependencia="<?php echo $_SESSION['dependencia'] ?>" onclick="mostraDiv1()">
                        <img style="width: 40%; height: auto; position: relative;" src="/lib/img/apps/mentoria/minhaDependencia.png">            
                        <div style="width: 60%; height: auto; align-content: center; position: relative; color: #FCFC30; font-size: 32px; font-family: 'BancoDoBrasil Textos'; font-weight: 700; word-wrap: break-word;">
                            Minha dependência
                        </div>
                    </div>
                    <div class="qualDependenciaImersao" style="width: 45%;height: auto;position: relative;border-radius: 14px;border: 1px #FCFC30 solid;display: inline-flex;" attr-dependencia="" onclick="mostraDiv1()">
                        <img style="width: 169px; height: auto; position: relative;" src="/lib/img/apps/mentoria/outraDependencia.png">
                        <div style="width: 190px;height: auto;align-content: center;position: relative;color: #FCFC30;font-size: 32px;font-family: 'BancoDoBrasil Textos';font-weight: 700;">
                            Outra dependência
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <form method= "post" class="formularioImersao">
                    <div id = "formularioImersaoPagina1" class ="paginaFormularioImersao" style="display: none;">
                        <label class = "textoFormulario">
                            Para qual dependência é a mentoria?
                        </label></br>
                        <textarea placeholder= "Insira sua resposta" class="textareaFormImersao" id="codDependencia"></textarea></br></br>
                        <label class = "textoFormulario">
                            Qual necessidade pretende-se atender com o uso do assistente virtual?
                        </label></br>
                        <textarea placeholder= "Insira sua resposta" class="textareaFormImersao" id="necessidadeForm"></textarea></br></br>
                        <label class = "textoFormulario">
                            Qual o público-alvo que irá utilizar o assistente virtual?
                        </label></br>
                        <textarea placeholder= "Insira sua resposta" class="textareaFormImersao" id="publicoAlvoForm"></textarea></br></br>
                        <input type="button" class="btnVoltarForm" value="Voltar" onclick="mostraDiv0()" attr-qualDiv="0">                    
                        <input type="button" class="btnContinuarForm" value="Continuar" onclick="mostraDiv2()" attr-qualDiv="2">  </br></br>  
                    </div>
                    <!-- fim da pag 1 -->

                    <div id = "formularioImersaoPagina2" class ="paginaFormularioImersao" style="display: none;">
                        <label class = "textoFormulario">Em quais canais o assistente virtual será disponibilizado?</label></br>
                        <textarea placeholder= "Insira sua resposta" class="textareaFormImersao" id="canalDisponibilzaBotForm"></textarea></br></br>
                        <label class = "textoFormulario">Você já sabe quais os conteúdos mais importantes que incluirá no seu assistente virtual?</label></br>
                        <input type="radio" name= "sabeConteudoImportanteForm" value= "Sim">Sim 
                        <input type="radio" name= "sabeConteudoImportanteForm" value= "Nao">Não 
                        </br></br>
                        <label class = "textoFormulario">A equipe já possui alguma experiência com o desenvolvimento de assistentes virtuais?</label></br>
                        <input type="radio" name= "experienciaDevBotForm" value= "Sim">Sim 
                        <input type="radio" name= "experienciaDevBotForm" value= "Nao">Não  
                        </br></br>   
                        <input type="button" class="btnVoltarForm" value="Voltar" onclick="mostraDiv1()" attr-qualDiv="1">                    
                        <input type="button" class="btnContinuarForm" value="Continuar" onclick="mostraDiv3()" attr-qualDiv="3">  
                        </br></br>
                    </div>
                    <!-- fim da pag 2 -->

                    <div id = "formularioImersaoPagina3" class ="paginaFormularioImersao" style="display: none;">
                        <label class = "textoFormulario">A equipe que irá desenvolver o assistente virtual será composta por quantas pessoas?</label></br>
                        <textarea placeholder= "Insira sua resposta" class="textareaFormImersao" id="qtdePessoasEquipeForm"></textarea></br></br>
                        <label class = "textoFormulario">Numa escala de 1 (não tem conhecimento) a 5 (já fez a construção de algum assistente virtual), qual o nível de experiência da equipe</label></br></br>
                        <input type="radio" name= "nivelConhecimentoBotForm" value= "1">1
                        <input type="radio" name= "nivelConhecimentoBotForm" value= "2">2
                        <input type="radio" name= "nivelConhecimentoBotForm" value= "3">3
                        <input type="radio" name= "nivelConhecimentoBotForm" value= "4">4
                        <input type="radio" name= "nivelConhecimentoBotForm" value= "5">5
                        </br></br>    

                        <label class = "textoFormulario">Em quais temas a mentoria deve ser focada?</label> </br> </br>                      
                        <input type="checkbox" name= "temaImersao" value= "gestaoConhecimento"> Gestão do Conhecimento 
                        <input type="checkbox" name= "temaImersao" value= "UX"> UX
                        <input type="checkbox" name= "temaImersao" value= "dev"> Dev
                        <input type="checkbox" name= "temaImersao" value= "analytics"> Analytics
                        <input type="checkbox" name= "temaImersao" value= "curadoria"> Curadoria 
                        </br></br>
                        <input type="button" class="btnVoltarForm" value="Voltar" onclick="mostraDiv2()">                    
                        <input type="button" class="btnContinuarForm" value="Continuar" onclick="mostraDiv4()">
                        </br></br>
                    </div> 
                    <!-- fim da pag 3 -->

                    <div id = "formularioImersaoPagina4" class ="paginaFormularioImersao" style="display: none;">    
                        <label class = "textoFormulario">Você prefere que a mentoria seja realizada em qual formato?</label> </br> </br>  
                        <div class="botoesForm01" style="display: inline-flex;flex-direction: row;gap: 5%;margin-top: 5%;">
                            <div class="qualFormato" style="width: 45%;height: auto;position: relative;border: 1px #FCFC30 solid;border-radius: 14px;display: inline-flex;" attr-qualOpcao="Presencial" attr-opcaoEscolhida="0">
                                <img style="width: 40%; height: auto; position: relative;" src="/lib/img/apps/mentoria/minhaDependencia.png">            
                                <div style="width: 60%; height: auto; align-content: center; position: relative; color: #FCFC30; font-size: 32px; font-family: 'BancoDoBrasil Textos'; font-weight: 700; word-wrap: break-word;">
                                    Presencial
                                </div>
                            </div>
                            <div class="qualFormato" style="width: 45%;height: auto;position: relative;border-radius: 14px;border: 1px #FCFC30 solid;display: inline-flex;" attr-qualOpcao="Online" attr-opcaoEscolhida="0">
                                <img style="width: 169px; height: auto; position: relative;" src="/lib/img/apps/mentoria/outraDependencia.png">
                                <div style="width: 190px;height: auto;align-content: center;position: relative;color: #FCFC30;font-size: 32px;font-family: 'BancoDoBrasil Textos';font-weight: 700;">
                                    Online
                                </div>
                            </div>
                        </div>
                        </br></br>
                        <input type="button" class="btnVoltarForm" value="Voltar" onclick="mostraDiv3()" >                    
                        <input id="finalizar" type="button" class="btnContinuarForm" value="Continuar"><br>
                        <div style="width: 100%; height: 100%; color: #FCFC30; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">No formato presencial os custos são da dependência solicitante</div>
                        </br></br>           
                    </div>
                    <!-- fim da pag 4 -->

                    <div id = "formularioImersaoPagina5" class ="paginaFormularioImersao" style="display: none;">
                        <!-- <label>Obrigado! Foi enviado uma cópia das respostas para seu email.</label> </br> </br> -->
                        <div style="width: 100%; height: 100%; text-align: center; color: #FCFC30; font-size: 96px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Agradecemos sua resposta!</div>
                        <br>
                        <div style="width: 100%; height: 100%; text-align: center; color: #FCFC30; font-size: 36px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">
                            Entraremos em contato via Teams ou no email <?php echo  $_SESSION['MAIL'] ?> o mais breve possível com mais informações
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
              
        // function mostraDiv(id) {
                       
        //     const divs = document.querySelectorAll('.div');
        //     divs.forEach((div, i) => {
        //         div.style.display = (i === index  1) ? 'block' : 'none';
        //     });
        // }
        function mostraDiv0() {
            formularioImersaoPagina0.style.display ="block";
            formularioImersaoPagina1.style.display ="none";
            formularioImersaoPagina2.style.display ="none";
            formularioImersaoPagina3.style.display ="none";
            formularioImersaoPagina4.style.display ="none";
            formularioImersaoPagina5.style.display ="none";
            barraPorcentagem0.style.display ="block";
            barraPorcentagem20.style.display ="none";
            barraPorcentagem50.style.display ="none";
            barraPorcentagem70.style.display ="none";
            barraPorcentagem90.style.display ="none";
            barraPorcentagem100.style.display ="none";
        }
        function mostraDiv1() {
            formularioImersaoPagina0.style.display ="none";
            formularioImersaoPagina1.style.display ="block";
            formularioImersaoPagina2.style.display ="none";
            formularioImersaoPagina3.style.display ="none";
            formularioImersaoPagina4.style.display ="none";
            formularioImersaoPagina5.style.display ="none";
            barraPorcentagem0.style.display ="none";
            barraPorcentagem20.style.display ="block";
            barraPorcentagem50.style.display ="none";
            barraPorcentagem70.style.display ="none";
            barraPorcentagem90.style.display ="none";
            barraPorcentagem100.style.display ="none";
        }

        function mostraDiv2() {
            formularioImersaoPagina0.style.display ="none";
           formularioImersaoPagina1.style.display ="none";
           formularioImersaoPagina2.style.display ="block";
           formularioImersaoPagina3.style.display ="none";
           formularioImersaoPagina4.style.display ="none";
           formularioImersaoPagina5.style.display ="none";
           barraPorcentagem0.style.display ="none";
            barraPorcentagem20.style.display ="none";
            barraPorcentagem50.style.display ="block";
            barraPorcentagem70.style.display ="none";
            barraPorcentagem90.style.display ="none";
            barraPorcentagem100.style.display ="none";
        }

        function mostraDiv3() {
            formularioImersaoPagina0.style.display ="none";
            formularioImersaoPagina1.style.display ="none";
            formularioImersaoPagina2.style.display ="none";
            formularioImersaoPagina3.style.display ="block";
            formularioImersaoPagina4.style.display ="none";
            formularioImersaoPagina5.style.display ="none";
            barraPorcentagem0.style.display ="none";
            barraPorcentagem20.style.display ="none";
            barraPorcentagem50.style.display ="none";
            barraPorcentagem70.style.display ="block";
            barraPorcentagem90.style.display ="none";
            barraPorcentagem100.style.display ="none";
        }

        function mostraDiv4() {
            formularioImersaoPagina0.style.display ="none";
            formularioImersaoPagina1.style.display ="none";
            formularioImersaoPagina2.style.display ="none";
            formularioImersaoPagina3.style.display ="none";
            formularioImersaoPagina4.style.display ="block";
            formularioImersaoPagina5.style.display ="none";
            barraPorcentagem0.style.display ="none";
            barraPorcentagem20.style.display ="none";
            barraPorcentagem50.style.display ="none";
            barraPorcentagem70.style.display ="none";
            barraPorcentagem90.style.display ="block";
            barraPorcentagem100.style.display ="none";
        }

        function mostraDiv5() {
            formularioImersaoPagina0.style.display ="none";
            formularioImersaoPagina1.style.display ="none";
            formularioImersaoPagina2.style.display ="none";
            formularioImersaoPagina3.style.display ="none";
            formularioImersaoPagina4.style.display ="none";
            formularioImersaoPagina5.style.display ="block";
            barraPorcentagem0.style.display ="none";
            barraPorcentagem20.style.display ="none";
            barraPorcentagem50.style.display ="none";
            barraPorcentagem70.style.display ="none";
            barraPorcentagem90.style.display ="none";
            barraPorcentagem100.style.display ="block";
        }
    </script>
</div>


