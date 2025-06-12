<?php 



// https://cad.bb.com.br/lib/apps/mentoria/app/formulario.php
// ini_set("display_errors", E_ALL);

// echo('Início da página');
// echo('<br>');
// print_r($_SESSION);
// echo('<br>');
// echo('session_start');
// session_start();
// echo('<br>');

// // include_once $_SERVER["DOCUMENT_ROOT"]."/lib/login/login.php";
// echo('matrícula > ');
// print_r($_SESSION);
// echo('<br>');
// if($_SESSION['matricula'] == ''){
//     echo 'entrou no if';
//     echo('<br>');
//     echo 'include login';
//     include_once $_SERVER["DOCUMENT_ROOT"]."/lib/login/login.php";
//     print_r($_SESSION);
//     unset($_SESSION);
//     echo('<br>');
//     echo('session destoy');
//     echo('<br>');
//     // session_destroy();
//     print_r($_SESSION);
//     header('https://cad.bb.com.br/imersao/index.php');
    
//     // echo('<br><br><br><br>');
//     // echo('session destoy');
//     // echo('<br><br><br><br>');
//     // session_destroy();
//     // print_r($_SESSION);
//     die;
// }

// echo 'else';
// die;

if(!isset($_SESSION)){
    session_start();
}

// ini_set("display_errors", E_ALL);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/mentoria/class/class_mentoria.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Formulário Mentoria', $_SESSION['ip']);
echo '<!-- CSS específico do app --><link href="/lib/apps/mentoria/css/mentoria_formulario.css" rel="stylesheet">';




?>

<div class="formularioSolicitacaoMentoria" style="background: url(https://cad.bb.com.br/lib/img/apps/mentoria/fundoMentoria.png); background-repeat: repeat;">
    <div class="formularioDiv01" style="display: inline-flex; flex-direction: row;">
        <div id="roboBarra" style="display: inline-flex;flex-direction: column;">
            <img style="width: 778px; height: 683px; position: relative;" src="/lib/img/apps/mentoria/roboFormularioSolicitarImersao.png">
            <img style="width: 372px;height: 64px;position: relative;align-content: center;" src="/lib/img/apps/mentoria/barraPorcentagem0.png">
        </div>
        <div class="perguntasFormulario01" style="display: inline-flex; flex-direction: column;">
            <div class="formularioImersaoPagina0" style="width: 926px;height: 123px;position: relative;text-align: center;color: #FCFC30;font-size: 96px;font-family: 'BancoDoBrasil Titulos';font-weight: 700;word-wrap: break-word;margin-top: 5%;">
                Vamos lá!
            </div>
            <div class="formularioImersaoPagina0" style="width: 100%;height: auto;position: relative;color: #FCFC30;font-size: 36px;font-family: 'BancoDoBrasil Textos';font-weight: 300;text-align: center;margin-top: 7%;">
                A mentoria é para qual dependência?
            </div>
            <div class="botoesForm01 formularioImersaoPagina0" style="display: inline-flex;flex-direction: row;gap: 5%;margin-top: 5%;">
                <div style="width: 45%;height: auto;position: relative;border: 1px #FCFC30 solid;border-radius: 14px;display: inline-flex;"  onclick="mostraDiv1()">
                    <img style="width: 40%; height: auto; position: relative;" src="/lib/img/apps/mentoria/minhaDependencia.png">            
                    <div style="width: 60%; height: auto; align-content: center; position: relative; color: #FCFC30; font-size: 32px; font-family: 'BancoDoBrasil Textos'; font-weight: 700; word-wrap: break-word;">
                        Minha dependência
                    </div>
                </div>
                <div class="formularioImersaoPagina0" style="width: 45%;height: auto;position: relative;border-radius: 14px;border: 1px #FCFC30 solid;display: inline-flex;" onclick="mostraDiv1()">
                    <img style="width: 169px; height: auto; position: relative;" src="/lib/img/apps/mentoria/outraDependencia.png">
                    <div style="width: 190px;height: auto;align-content: center;position: relative;color: #FCFC30;font-size: 32px;font-family: 'BancoDoBrasil Textos';font-weight: 700;">
                        Outra dependência
                    </div>
                </div>
            </div>

            <div>
                <form method= "post" class="formularioImersao">
                    <div id = "formularioImersaoPagina1" class ="paginaFormularioImersao" >
                        <label class = "textoFormulario">Para qual dependência é a mentoria?</label> </br>
                        <textarea placeholder= "Insira sua resposta" class="textareaFormImersao" id="codOutraDependencia"></textarea></br></br>
                        <label class = "textoFormulario">Qual necessidade pretende-se atender com o uso do assistente virtual?</label></br>
                        <textarea placeholder= "Insira sua resposta" class="textareaFormImersao" id="necessidadeForm"></textarea></br></br>
                        <label class = "textoFormulario">Qual o público-alvo que irá utilizar o assistente virtual?</label></br>
                        <textarea placeholder= "Insira sua resposta" class="textareaFormImersao" id="publicoAlvoForm"></textarea></br></br>
                        <input type="button" class="btnVoltarForm" value="Voltar" onclick="mostraDiv('formularioImersaoPagina0')" attr-qualDiv="0">                    
                        <input type="button" class="btnContinuarForm" value="Continuar" onclick="mostraDiv2()" attr-qualDiv="2">  </br></br>  
                    </div>
                    <!-- fim da pag 1 -->
                    <div id = "formularioImersaoPagina2" class ="paginaFormularioImersao">
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
                    <div id = "formularioImersaoPagina3" class ="paginaFormularioImersao">
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
                    <div id = "formularioImersaoPagina4" class ="paginaFormularioImersao">    
                        <label class = "textoFormulario">Você prefere que a mentoria seja realizada em qual formato?</label> </br> </br>  
                        <div class="botoesForm01" style="display: inline-flex;flex-direction: row;gap: 5%;margin-top: 5%;">
                            <div style="width: 45%;height: auto;position: relative;border: 1px #FCFC30 solid;border-radius: 14px;display: inline-flex;">
                                <img style="width: 40%; height: auto; position: relative;" src="/lib/img/apps/mentoria/minhaDependencia.png">            
                                <div style="width: 60%; height: auto; align-content: center; position: relative; color: #FCFC30; font-size: 32px; font-family: 'BancoDoBrasil Textos'; font-weight: 700; word-wrap: break-word;">
                                    Minha dependência
                            </div>
                        </div>
                            <div style="width: 45%;height: auto;position: relative;border-radius: 14px;border: 1px #FCFC30 solid;display: inline-flex;">
                                <img style="width: 169px; height: auto; position: relative;" src="/lib/img/apps/mentoria/outraDependencia.png">
                                <div style="width: 190px;height: auto;align-content: center;position: relative;color: #FCFC30;font-size: 32px;font-family: 'BancoDoBrasil Textos';font-weight: 700;">
                                    Outra dependência
                                </div>
                            </div>
                    </div>
                        
                        
                        <input type="button" class="btnVoltarForm" value="Voltar" onclick="mostraDiv3()" >                    
                        <input type="button" class="btnContinuarForm" value="Continuar" onclick="mostraDiv('formularioImersaoPagina5')">     
                        </br></br>           
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
        
        function mostraDiv1() {
            formularioImersaoPagina0.style.display ="none";         
            formularioImersaoPagina1.style.display ="block";
            formularioImersaoPagina2.style.display ="none";
            formularioImersaoPagina3.style.display ="none";
            formularioImersaoPagina4.style.display ="none";
                  }
        
        
        function mostraDiv2() {
                     
           formularioImersaoPagina1.style.display ="none";
           formularioImersaoPagina2.style.display ="block";
           formularioImersaoPagina3.style.display ="none";
           formularioImersaoPagina4.style.display ="none";
        }
          
        function mostraDiv3() {
                     
            formularioImersaoPagina1.style.display ="none";
            formularioImersaoPagina2.style.display ="none";
            formularioImersaoPagina3.style.display ="block";
            formularioImersaoPagina4.style.display ="none";
                  }
                    
    function mostraDiv4() {
                     
            formularioImersaoPagina1.style.display ="none";
            formularioImersaoPagina2.style.display ="none";
            formularioImersaoPagina3.style.display ="none";
            formularioImersaoPagina4.style.display ="block";
                  }
            
                
                
            

            
            
            

    </script>
</div>


