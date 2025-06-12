<!DOCTYPE html>

<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Imersão chatbot</title>

        <!-- jQuery -->
        <script type="text/javascript" src="/lib/js/jquery.3.7.1.js"></script>
        <script type="text/javascript" src="/lib/js/jquery.3.7.1.min.js"></script>
        <script type="text/javascript" src="/lib/js/jquery-ui.1.13.3.js"></script>
        <script type="text/javascript" src="/lib/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="/lib/js/bootstrap.bundle.js"></script>
        <script type="text/javascript" src="/lib/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="/lib/js/bootstrap.esm.js"></script>
        <script type="text/javascript" src="/lib/js/bootstrap.esm.min.js"></script>
        <script type="text/javascript" src="/lib/js/bootstrap.js"></script>
        <script type="text/javascript" src="/lib/js/bootstrap.min.js"></script>
        
        <!-- JS da página -->
        <script type="text/javascript" src="mentoria.js"></script>

        
        <!-- CSS da página -->
        <link href="mentoria_formulario.css" rel="stylesheet">
        <link href="mentoria.css" rel="stylesheet">
        


        


    </head>

<div class="formularioSolicitacaoMentoria" <?php echo 'attr-matricula="'.$_SESSION['matricula'].'" attr-nome="'.$_SESSION['nome'].'" attr-email="'.$_SESSION['MAIL'].'"'?> >
    <div class="formularioDiv01">
        <div id="roboBarra" style="display: inline-flex;flex-direction: column; align-items: center;">
            <img style="padding-top: 10%; width: 48rem; height: auto; position: relative;" src="/lib/img/apps/mentoria/roboFormularioSolicitarImersao.png">
            <div id="barraPorcentagem0" style="display: block; margin-top: -5%; ">
                <img style="width: 372px;height: 64px;position: relative;align-content: center;" src="/lib/img/apps/mentoria/barraPorcentagem0.png">
            </div>
            <div id="barraPorcentagem20" style="display: none; margin-top: -5%;">
                <img style="width: 372px;height: 64px;position: relative;align-content: center;" src="/lib/img/apps/mentoria/barraPorcentagem20.png">
            </div>
            <div id="barraPorcentagem50" style="display: none; margin-top: -5%;">
                <img style="width: 372px;height: 64px;position: relative;align-content: center;" src="/lib/img/apps/mentoria/barraPorcentagem50.png">
            </div>
            <div id="barraPorcentagem70" style="display: none; margin-top: -5%;">
                <img style="width: 372px;height: 64px;position: relative;align-content: center;" src="/lib/img/apps/mentoria/barraPorcentagem70.png">
            </div>
            <div id="barraPorcentagem90" style="display: none; margin-top: -5%;">
                <img style="width: 372px;height: 64px;position: relative;align-content: center;" src="/lib/img/apps/mentoria/barraPorcentagem90.png">
            </div>
            <div id="barraPorcentagem100" style="display: none; margin-top: -5%;">
                <img style="width: 372px;height: 64px;position: relative;align-content: center;" src="/lib/img/apps/mentoria/barraPorcentagem100.png">
            </div>
        </div>
        <div class="perguntasFormulario01" style="display: inline-flex; flex-direction: column; width:50%; padding-left: 1%;  padding-right: 1%;  padding-top: 5%;">
            <div id="formularioImersaoPagina0">
                 <!--<div style="width: 926px;height: 123px;position: relative;text-align: center;color: #FCFC30;font-size: 96px;font-family: 'BancoDoBrasil Titulos';font-weight: 700;word-wrap: break-word;margin-top: 5%;">
                    vamos lá!
                </div>
                <div style="width: 100%;height: auto;position: relative;color: #FCFC30;font-size: 36px;font-family: 'BancoDoBrasil Textos';font-weight: 300;text-align: center;margin-top: 7%;">
                    A mentoria é para qual dependência?
                </div>
                <div class="botoesForm01" style="display: inline-flex;flex-direction: row; gap: 10%; margin-top: 5%; width: 100%;">
                    <div class="qualDependenciaImersao Clicar" attr-dependencia="<?php echo $_SESSION['dependencia'] ?>" onclick="mostraDiv1()">
                        <img style="width: 40%; height: auto; position: relative;" src="/lib/img/apps/mentoria/minhaDependencia.png">            
                        <div style="width: 60%; line-height:98%; height: auto; align-content: center; align-items: center; position: relative; color: #FCFC30; font-size: 32px; font-family: 'BancoDoBrasil Textos'; font-weight: 700; word-wrap: break-word;">
                            Minha dependência
                        </div>
                    </div>
                    <div class="qualDependenciaImersao Clicar" attr-dependencia="" onclick="mostraDiv1()">
                        <img style="width: 169px; height: auto; position: relative;" src="/lib/img/apps/mentoria/outraDependencia.png">
                        <div style="width: 190px; line-height:98%; align-items: center; height: auto;align-content: center;position: relative;color: #FCFC30;font-size: 32px;font-family: 'BancoDoBrasil Textos';font-weight: 700;">
                            Outra dependência
                        </div>
                    </div>
                </div> -->
            </div>

            <div>
                <form method= "post" class="formularioImersao">
                    <!-- página 1 -->
                    <div id = "formularioImersaoPagina1" class ="paginaFormularioImersao" style=" width: 82%;">
                        <label class = "textoFormulario">
                            Para qual dependência é a mentoria? </br>
                        </label></br>
                        <textarea placeholder= " Insira sua resposta" class="textareaFormImersao" id="codDependencia" style = "width: 100%;"  ></textarea></br></br>
                        <label class = "textoFormulario">
                            Qual necessidade pretende-se atender com o uso do assistente virtual?</br>
                        </label></br>
                        <textarea placeholder= " Insira sua resposta" class="textareaFormImersao" id="necessidadeForm" rows="7" style = "width: 100%;"></textarea></br></br>
                        <label class = "textoFormulario">
                            Qual o público-alvo que irá utilizar o assistente virtual? </br>
                        </label></br>
                        <textarea placeholder= " Insira sua resposta" class="textareaFormImersao" id="publicoAlvoForm" style = "width: 100%;" rows="4"></textarea></br></br>
                        <!-- <input type="button" class="btnVoltarForm Clicar" value="Voltar" onclick="mostraDiv0()" attr-qualDiv="0">                     -->
                        <input type="button" class="btnContinuarForm Clicar" value="Continuar" onclick="mostraDiv2()" attr-qualDiv="2">  </br></br>  
                    </div>
                    <!-- fim da pag 1 -->
                     
                    <!-- início página 2 -->

                    <div id = "formularioImersaoPagina2" class ="paginaFormularioImersao" style="display: none; width: 82%;">
                        <label class = "textoFormulario">Em quais canais o assistente virtual será disponibilizado?</label></br></br>
                        <textarea placeholder= " Insira sua resposta" class="textareaFormImersao" id="canalDisponibilzaBotForm" style = "width: 100%;"></textarea></br></br>
                        <label class = "textoFormulario">Você já sabe quais os conteúdos mais importantes que incluirá no seu assistente virtual?</label></br></br>
                        <input type="radio" name= "sabeConteudoImportanteForm" value= "Sim" id="radioBtnFormulario"><span class="radioBtnSimNao"> Sim  </span>
                        <input type="radio" name= "sabeConteudoImportanteForm" value= "Nao" id="radioBtnFormulario"><span class="radioBtnSimNao"> Não</span> 
                        </br></br></br>
                        <label class = "textoFormulario">A equipe já possui alguma experiência com o desenvolvimento de assistentes virtuais?</label></br></br>
                        <input type="radio" name= "experienciaDevBotForm" value= "Sim" id="radioBtnFormulario"><span class="radioBtnSimNao"> Sim  </span>
                        <input type="radio" name= "experienciaDevBotForm" value= "Nao" id="radioBtnFormulario"><span class="radioBtnSimNao"> Não</span> 
                        </br></br>   
                        <input type="button" class="btnVoltarForm Clicar" value="Voltar" onclick="mostraDiv1()" attr-qualDiv="1" style = "margin-top: 16%; ">                    
                        <input type="button" class="btnContinuarForm Clicar" value="Continuar" onclick="mostraDiv3()" attr-qualDiv="3">  
                        </br></br>
                    </div>
                    <!-- fim da pag 2 -->
                     
                    <!-- Início página 3 -->

                    <div id = "formularioImersaoPagina3" class ="paginaFormularioImersao" style="display: none; width: 82%;">
                        <label class = "textoFormulario">A equipe que irá desenvolver o assistente virtual será composta por quantas pessoas?</label></br></br>
                        <textarea placeholder= " Insira sua resposta" class="textareaFormImersao" id="qtdePessoasEquipeForm"></textarea></br></br>
                        <label class = "textoFormulario">Numa escala de 1 (não tem conhecimento) a 5 (já fez a construção de algum assistente virtual), qual o nível de experiência da equipe</label></br></br></br>
                        <input type="radio" name= "nivelConhecimentoBotForm" value= "1" id="radioBtnFormulario"><span class="RadioNumBtnFormulario"> 1</span>
                        <input type="radio" name= "nivelConhecimentoBotForm" value= "2" id="radioBtnFormulario"><span class="RadioNumBtnFormulario"> 2</span>
                        <input type="radio" name= "nivelConhecimentoBotForm" value= "3" id="radioBtnFormulario"><span class="RadioNumBtnFormulario"> 3</span>
                        <input type="radio" name= "nivelConhecimentoBotForm" value= "4" id="radioBtnFormulario"><span class="RadioNumBtnFormulario"> 4</span>
                        <input type="radio" name= "nivelConhecimentoBotForm" value= "5" id="radioBtnFormulario"><span class="RadioNumBtnFormulario"> 5</span>
                        </br></br></br>    

                        <label class = "textoFormulario">Em quais temas a mentoria deve ser focada?</label> </br> </br> </br>                     
                        <input type="checkbox" name= "temaImersao" value= "Gestão do Conhecimento" id="radioBtnFormulario"><span class="checkboxBtnForm"> Gestão do Conhecimento </span>
                        <input type="checkbox" name= "temaImersao" value= "UX" id="radioBtnFormulario"> <span class="checkboxBtnForm">UX</span>
                        <input type="checkbox" name= "temaImersao" value= "Dev" id="radioBtnFormulario"> <span class="checkboxBtnForm">Dev</span>
                        <br>
                        <input type="checkbox" name= "temaImersao" value= "Analytics" id="radioBtnFormulario"> <span class="checkboxBtnForm">Analytics</span>
                        <input type="checkbox" name= "temaImersao" value= "Curadoria" id="radioBtnFormulario"><span class="checkboxBtnForm"> Curadoria </span>
                        <input type="checkbox" name= "temaImersao" value= "VUI Design" id="radioBtnFormulario"><span class="checkboxBtnForm"> VUI Design </span>
                        </br>
                        <input type="button" class="btnVoltarForm Clicar" value="Voltar" onclick="mostraDiv2()" style = "margin-top: 16%;">                    
                        <input type="button" class="btnContinuarForm Clicar" value="Continuar" onclick="mostraDiv4()">
                        </br></br>
                    </div> 
                    <!-- fim da pag 3 -->

                    <!-- Início página 4 -->
                    <div id = "formularioImersaoPagina4" class ="paginaFormularioImersao" style="display: none; width: 82%;">    
                        <label class = "textoFormulario">Você prefere que a mentoria seja realizada em qual formato?</label> </br> </br>  
                        <div class="botoesForm01" style="display: inline-flex;flex-direction: row;gap: 8%; justify-content: space-evenly; widht:100%; height:auto; margin-top: 10%;">
                            <div class="qualFormato Clicar" style="width: 45%;height: auto;position: relative;border: 1px #FCFC30 solid;border-radius: 14px;display: inline-flex;" attr-qualOpcao="Presencial" attr-opcaoEscolhida="0">
                                <img style="width: 40%; height: auto; position: relative;" src="/lib/img/apps/mentoria/minhaDependencia.png">            
                                <div style="width: 60%; line-height:98%; height: auto; align-content: center; align-items: center; position: relative; color: #FCFC30; font-size: 32px; font-family: 'BancoDoBrasil Textos'; font-weight: 700; word-wrap: break-word;">
                                    Presencial
                                </div>
                                
                            </div>
                            
                            <div class="qualFormato Clicar" style="width: 45%;height: auto;position: relative;border-radius: 14px;border: 1px #FCFC30 solid;display: inline-flex;" attr-qualOpcao="Online" attr-opcaoEscolhida="0">
                                <img style="width: 169px; height: auto; position: relative;" src="/lib/img/apps/mentoria/outraDependencia.png">
                                <div style="width: 190px;height: auto;align-content: center;position: relative;color: #FCFC30;font-size: 32px;font-family: 'BancoDoBrasil Textos';font-weight: 700;">
                                    Online
                                </div>
                            </div>
                        </div> <div style="width: 100%; height: 35%; color: #FCFC30; font-size: 18px; font-family: BancoDoBrasil Textos;  word-wrap: break-word"></br>*Os custos são da dependência solicitante</div>
                        </br></br></br></br>
                        <input type="button" class="btnVoltarForm Clicar" value="Voltar" id= "btnFinalFormularioOnlinePresencial" onclick="mostraDiv3()" style = "margin-top: 16%;" >                    
                        <!-- <input id="finalizar" type="button" class="btnContinuarForm Clicar" id= "btnFinalFormularioOnlinePresencial" value="Continuar"><br> -->
                        <input type="button" class="btnContinuarForm Clicar" value="Continuar" onclick="mostraDivNova()">
                         
                        
                        </br></br>           
                    </div>
                    <!-- fim da pag 4 -->
                     <!-- Início página dados pessoais -->
                    <div id = "formularioImersaoPaginaDados" class ="paginaFormularioImersao" style="display: none; width: 82%;"> 
                        <label class = "textoFormulario">
                            E por último, mas não menos importante :
                        </label></br></br></br></br>
                                           
                        <label class = "textoFormulario">
                                Matrícula </br>
                        </label></br>
                        <textarea placeholder= " Insira sua resposta" class="textareaFormImersao" id="matriculaForm" cols="90" ></textarea></br></br>
                        <label class = "textoFormulario">
                            Nome</br>
                        </label></br>
                        <textarea placeholder= " Insira sua resposta" class="textareaFormImersao" id="nomeForm" cols="90" ></textarea></br></br>
                        <label class = "textoFormulario">
                            E-mail</br>
                        </label></br>
                        <textarea placeholder= " Insira sua resposta" class="textareaFormImersao" id="emailForm" cols="90"></textarea></br></br>
                        <input type="button" class="btnVoltarForm Clicar" value="Voltar" onclick="mostraDiv4()" attr-qualDiv="0" style = "margin-top: 16%;">                    
                        <input id="finalizar" type="button" class="btnContinuarForm Clicar" id= "btnFinalFormularioOnlinePresencial" value="Continuar" ><br>
                    </div>   

                    <div id = "formularioImersaoPagina5" class ="paginaFormularioImersao" style="display: none;">
                        <!-- <label>Obrigado! Foi enviado uma cópia das respostas para seu email.</label> </br> </br> -->
                        <div style="width: 100%; height: 100%; text-align: center; color: #FCFC30; font-size: 96px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Agradecemos sua resposta!</div>
                        <br>
                        <div style="width: 100%; height: 100%; text-align: center; color: #FCFC30; font-size: 36px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">
                            Entraremos em contato via Teams ou em seu  email o mais breve possível com mais informações
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
            formularioImersaoPaginaDados.style.display = "none";
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
            formularioImersaoPaginaDados.style.display="none";
            formularioImersaoPagina5.style.display ="block";
            barraPorcentagem0.style.display ="none";
            barraPorcentagem20.style.display ="none";
            barraPorcentagem50.style.display ="none";
            barraPorcentagem70.style.display ="none";
            barraPorcentagem90.style.display ="none";
            barraPorcentagem100.style.display ="block";
        }

        function mostraDivNova() {
            formularioImersaoPagina0.style.display ="none";
            formularioImersaoPagina1.style.display ="none";
            formularioImersaoPagina2.style.display ="none";
            formularioImersaoPagina3.style.display ="none";
            formularioImersaoPagina4.style.display ="none";
            formularioImersaoPagina5.style.display ="none";
            formularioImersaoPaginaDados.style.display="block";
            barraPorcentagem0.style.display ="none";
            barraPorcentagem20.style.display ="none";
            barraPorcentagem50.style.display ="none";
            barraPorcentagem70.style.display ="none";
            barraPorcentagem90.style.display ="block";
            barraPorcentagem100.style.display ="none";
        }
    </script>
</div>


