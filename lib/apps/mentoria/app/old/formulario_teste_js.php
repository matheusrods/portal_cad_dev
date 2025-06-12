<?php 

session_start();

if(!isset($_SESSION['matricula'])){
    session_start();
    include_once $_SERVER["DOCUMENT_ROOT"]."/lib/login/login.php";
    header('Location: https://login.intranet.bb.com.br/sso/XUI/?goto=https%3A%2F%2Fcad.bb.com.br%2Flib%2Fapps%2Fmentoria%2Fapp%2Fformulario_teste_js.php#login/');
    die;
}

// ini_set("display_errors", E_ALL);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/mentoria/class/class_mentoria.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Formulário Mentoria', $_SESSION['ip']);
echo '<!-- CSS específico do app --><link href="/lib/apps/mentoria/css/mentoria_formulario.css" rel="stylesheet">';
echo '<!-- jQuery --><script type="text/javascript" src="../../../js/jquery.3.7.1.js"></script><script type="text/javascript" src="../../../js/jquery.3.7.1.min.js"></script>';
echo '<!-- JS específico do app --><script type="text/javascript" src="/lib/apps/mentoria/js/mentoria.js"></script>';


?>

<div class="formularioSolicitacaoMentoria" style="background: url(https://cad.bb.com.br/lib/img/apps/mentoria/fundoMentoria.png); background-repeat: repeat;" <?php echo 'attr-matricula="'.$_SESSION['matricula'].'" attr-nome="'.$_SESSION['nome'].'" attr-email="'.$_SESSION['MAIL'].'"'?> >
    <div class="formularioDiv01" style="display: inline-flex; flex-direction: row;">
        <div id="roboBarra" style="display: inline-flex;flex-direction: column;">
            <img style="width: 778px; height: 683px; position: relative;" src="/lib/img/apps/mentoria/roboFormularioSolicitarImersao.png">
            <img style="width: 372px;height: 64px;position: relative;align-content: center;" src="/lib/img/apps/mentoria/barraPorcentagem0.png">
        </div>
        <div class="perguntasFormulario01" style="display: inline-flex; flex-direction: column;">
            <div style="width: 926px;height: 123px;position: relative;text-align: center;color: #FCFC30;font-size: 96px;font-family: 'BancoDoBrasil Titulos';font-weight: 700;word-wrap: break-word;margin-top: 5%;">
                Vamos lá!
            </div>
            <div style="width: 100%;height: auto;position: relative;color: #FCFC30;font-size: 36px;font-family: 'BancoDoBrasil Textos';font-weight: 300;text-align: center;margin-top: 7%;">
                A mentoria é para qual dependência?
            </div>
            <div class="botoesForm01" style="display: inline-flex;flex-direction: row;gap: 5%;margin-top: 5%;">
                <div class="qualDependenciaImersao" style="width: 45%;height: auto;position: relative;border: 1px #FCFC30 solid;border-radius: 14px;display: inline-flex;" attr-dependencia="<?php echo $_SESSION['dependencia'] ?>">
                    <img style="width: 40%; height: auto; position: relative;" src="/lib/img/apps/mentoria/minhaDependencia.png">            
                    <div style="width: 60%; height: auto; align-content: center; position: relative; color: #FCFC30; font-size: 32px; font-family: 'BancoDoBrasil Textos'; font-weight: 700; word-wrap: break-word;">
                        Minha dependência
                    </div>
                </div>
                <div class="qualDependenciaImersao" style="width: 45%;height: auto;position: relative;border-radius: 14px;border: 1px #FCFC30 solid;display: inline-flex;" attr-dependencia="">
                    <img style="width: 169px; height: auto; position: relative;" src="/lib/img/apps/mentoria/outraDependencia.png">
                    <div style="width: 190px;height: auto;align-content: center;position: relative;color: #FCFC30;font-size: 32px;font-family: 'BancoDoBrasil Textos';font-weight: 700;">
                        Outra dependência
                    </div>
                </div>
            </div>

            <div>
                <form method= "post" class="formularioImersao">
                    <div id = "formularioImersaoPagina1" class ="paginaFormularioImersao">
                        <label>Para qual dependência é a mentoria?</label> </br>
                        <textarea placeholder= "Insira sua resposta" id="codDependencia"></textarea></br></br>
                        <label>Qual necessidade pretende-se atender com o uso do assistente virtual?</label></br>
                        <textarea placeholder= "Insira sua resposta" id="necessidadeForm"></textarea></br></br>
                        <label>Qual o público-alvo que irá utilizar o assistente virtual?</label></br>
                        <textarea placeholder= "Insira sua resposta" id="publicoAlvoForm"></textarea></br></br>
                        <input type="button" class="voltar" value="Voltar" attr-qualDiv="0">
                        <input type="button" class="continuar" value="Continuar" attr-qualDiv="2">  </br></br>  
                    </div>
                    <!-- fim da pag 1 -->
                    <div id = "formularioImersaoPagina2" class ="paginaFormularioImersao">
                        <label>Em quais canais o assistente virtual será disponibilizado?</label></br>
                        <textarea placeholder= "Insira sua resposta" id="canalDisponibilzaBotForm"></textarea></br></br>
                        <label>Você já sabe quais os conteúdos mais importantes que incluirá no seu assistente virtual?</label></br>
                        <input type="radio" name="sabeConteudoImportanteForm" value= "Sim">Sim 
                        <input type="radio" name="sabeConteudoImportanteForm" value= "Nao">Não 
                        </br></br>
                        <label>A equipe já possui alguma experiência com o desenvolvimento de assistentes virtuais?</label></br>
                        <input type="radio" name="experienciaDevBotForm" value= "Sim">Sim 
                        <input type="radio" name="experienciaDevBotForm" value= "Nao">Não  
                        </br></br>   
                        <input type="button" class="voltar" value="Voltar" attr-qualDiv="1">
                        <input type="button" class="continuar" value="Continuar" attr-qualDiv="3">  
                        </br></br>
                    </div>
                    <!-- fim da pag 2 -->
                    <div id = "formularioImersaoPagina3" class ="paginaFormularioImersao">
                        <label>A equipe que irá desenvolver o assistente virtual será composta por quantas pessoas?</label></br>
                        <textarea placeholder= "Insira sua resposta" id="qtdePessoasEquipeForm"></textarea></br></br>
                        <label>Numa escala de 1 (não tem conhecimento) a 5 (já fez a construção de algum assistente virtual), qual o nível de experiência da equipe</label></br></br>
                        <input type="radio" name="nivelConhecimentoBotForm" value= "1">1
                        <input type="radio" name="nivelConhecimentoBotForm" value= "2">2
                        <input type="radio" name="nivelConhecimentoBotForm" value= "3">3
                        <input type="radio" name="nivelConhecimentoBotForm" value= "4">4
                        <input type="radio" name="nivelConhecimentoBotForm" value= "5">5
                        </br></br>    

                        <label>Em quais temas a mentoria deve ser focada?</label> </br> </br>
                        <input type="checkbox" name="temaImersao" value= "Gestão do Conhecimento"> Gestão do Conhecimento 
                        <input type="checkbox" name="temaImersao" value= "UX"> UX
                        <input type="checkbox" name="temaImersao" value= "Dev"> Dev
                        <input type="checkbox" name="temaImersao" value= "Analytics"> Analytics
                        <input type="checkbox" name="temaImersao" value= "Curadoria"> Curadoria 
                        </br></br>
                        <input type="button" class="voltar" value="Voltar" attr-qualDiv="2">
                        <input type="button" class="continuar" value="Continuar" attr-qualDiv="4">
                        </br></br>
                    </div> 
                    <!-- fim da pag 3 -->
                    <div id = "formularioImersaoPagina4" class ="paginaFormularioImersao">    
                        <label>Você prefere que a mentoria seja realizada em qual formato?</label> </br> </br>  
                        <input class="qualFormato" type="button" name="formatoImersao" value="Presencial" attr-qualOpcao="Presencial" attr-opcaoEscolhida="0">
                        <input class="qualFormato" type="button" name="formatoImersao" value="Online" attr-qualOpcao="Online" attr-opcaoEscolhida="0">
                        </br></br>
                        <input type="button" class="voltar" value="Voltar" attr-qualDiv="3">
                        <input type="button" class="continuar" value="Continuar" attr-qualDiv="5">
                        </br></br>           
                    </div><!-- fim da pag 4 -->
                    <div id = "formularioImersaoPagina5" class ="paginaFormularioImersao">
                        <label>Obrigado! Foi enviado uma cópia das respostas para seu email.</label> </br> </br>
                        <input type="button" class="continuar" value="Finalizar" attr-qualDiv="6">
                        </br></br>
                    </div>
                    <div id = "formularioImersaoPagina6" class ="paginaFormularioImersao">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


