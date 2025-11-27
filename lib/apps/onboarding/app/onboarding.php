<?php

// Se a sessão não estiver ativa, força o início
if(!isset($_SESSION)){
  session_start();
}

// Mostrar erros do PHP
// ini_set("display_errors", E_ALL);

// Importação de arquivos de funções da página onboarding e de gravação de log
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/onboarding/class/class_onboarding.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Utils/Ambiente.php";

// Registra o log de acesso à página
$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Onboarding', $_SESSION['ip']);

// Instancia a classe e consulta a lista de Squads ativa para montar a página
$class = new funcoes();
$squadsDesign = $class->consultaSquadsDesign() ?? ['status'=>0,'mensagem'=>[]];
$ferramentas = $class->consultaFerramentas() ?? ['status'=>0,'mensagem'=>[]];
$canais = $class->consultaCanais() ?? ['status'=>0,'mensagem'=>[]];
$dicionario = $class->consultaDicionario() ?? ['status'=>0,'mensagem'=>[]];

// Variável que receberá os valores obtidos nas consultas acima e salvarão em string o conteúdo que será exibido no navegador
$montaDivSquads = '';
$montaDivFerramentas = '';
$montaDivCanais = '';
$montaDivDicionario = '';


if($squadsDesign['status'] == 0){
    $montaDivSquads = '';
} else {
    // Laço que monta o conteúdo das squads
    for($i = 0; $i < sizeof($squadsDesign['mensagem']); $i++){
        $montaDivSquads = $montaDivSquads.'
        <div style="width: 308px; padding: 16px; background: #FCFDFE; box-shadow: 0px 0px 1px rgba(24, 24, 27, 0.08); border-radius: 8px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 24px; display: inline-flex">
            <div style="align-self: stretch; height: auto; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">
                <div style="align-self: stretch; color: #49494F; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">'.$squadsDesign['mensagem'][$i]['squad'].'</div>
            </div>
        </div>';
    }
}


if($ferramentas['status'] == 0){
    $montaDivFerramentas = $ferramentas['mensagem'];
} else {
    // Laço que monta o conteúdo das ferramentas
    for($i = 0; $i < sizeof($ferramentas['mensagem']); $i++){
        $border='';
        if($i==0){
            $border = "border-top-right-radius: 16px;border-top-left-radius: 16px;";
        } else if($i == (sizeof($ferramentas['mensagem'])-1)){
            $border = "border-bottom-right-radius: 16px;border-bottom-left-radius: 16px; border-bottom: 0px; margin-bottom:8px;";
        }

    $montaDivFerramentas = $montaDivFerramentas.'
        <div class="divFerramentasOnboarding" style="flex-direction: column; justify-content: flex-start; align-items: center; width: 50%;">
            <div id="'.$ferramentas['mensagem'][$i]['id'].'" class="divFerramenta" attr-ferramentaAberta="0" style="'.$border.' height: auto; flex-direction: column; justify-content: center; align-items: center; display: flex">
                <div class="3" style="align-self: stretch; background: white; justify-content: center; align-items: center; display: inline-flex;">
                    <div class="nomeFerramenta">'.$ferramentas['mensagem'][$i]['ferramenta'].'</div>
                    <div class="5" style="width: 32px; height: 32px; border-radius: 99px; float: right; display: flex; justify-content: center; margin-top: 2px;">
                        <button class="btn btn-outline-dark botaoSetaFerramenta'.$ferramentas['mensagem'][$i]['id'].'" style="width: 32px; height: 32px; border-radius: 99px; float: right; display: flex; justify-content: center; margin-top: 2px;"><i aria-hidden="true" class="fa fa-chevron-down iconeSetaFerramenta'.$ferramentas['mensagem'][$i]['id'].'"></i></button>
                    </div>
                </div>
                <div class="ferramentaConteudo'.$ferramentas['mensagem'][$i]['id'].'" attr-ferramentaAberta="0" style="align-self: stretch; height: auto; padding: 32px; background: #EAEAEA; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 32px; display: none; margin-top: 8px;">
                    <div style="width: 100%;">
                        '.$ferramentas['mensagem'][$i]['descricao'].'
                    </div>
                    <div style="width: 100%;">
                        <a href="'.$ferramentas['mensagem'][$i]['linkAcesso'].'" target="_blank">
                            <img style="width: 100%;" src="'. getBaseUrl() .'/lib/img/apps/onboarding/'.$ferramentas['mensagem'][$i]['nomeArquivoImagem'].'.png"> </img>
                        </a>
                    </div>
                </div>
            </div>
        </div>';
    }
}


if($canais['status'] == 0){
    $montaDivCanais = $canais['mensagem'];
} else {
    // Laço que monta o conteúdo dos canais
    for($i = 0; $i < sizeof($canais['mensagem']); $i++){
        $montaDivCanais = $montaDivCanais.'
            <div class="canalOnboarding" attr-idCanal="'.$canais['mensagem'][$i]['id'].'">
                <div style="align-self: stretch; height: auto; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">
                    <div style="align-self: stretch; color: #49494F; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">'.$canais['mensagem'][$i]['canal'].'</div>
                </div>
            </div>
        ';
    }
}

if($dicionario['status'] == 0){
    $montaDivDicionario = $dicionario['mensagem'];
} else {
    
    if (!empty($dicionario['mensagem']) && is_array($dicionario['mensagem'])) {
        for($i = 0; $i < sizeof($dicionario['mensagem']); $i++){
            $montaDivDicionario = $montaDivDicionario.'
                <div style="width: 18rem; padding: 16px; background: #FEFEFE; box-shadow: 0px 0px 1px rgba(25, 25, 28, 0.25); border-radius: 4px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: inline-flex; border-radius: 16px; box-shadow: 3px 3px 1px #ccc;">
                    <div style="align-self: stretch; justify-content: flex-start; align-items: center; gap: 8px; display: inline-flex">
                        <div style="flex: 1 1 0; color: #111214; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 22.50px; word-wrap: break-word">'.$dicionario['mensagem'][$i]['item'].'</div>
                    </div>
                    <div style="align-self: stretch; height: auto; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 10px; display: flex">
                        <div style="align-self: stretch; height: auto; padding-left: 16px; padding-right: 16px; padding-top: 6px; padding-bottom: 6px; background: #F0F2F4; border-radius: 4px; overflow: hidden; flex-direction: column; justify-content: center; align-items: center; display: flex">
                            <div style="align-self: stretch; justify-content: flex-start; align-items: flex-start; gap: 10px; display: inline-flex">
                                <div style="flex: 1 1 0; color: #49494F; font-size: 12px; font-family: BancoDoBrasil Textos; font-weight: 400; letter-spacing: 0.14px; word-wrap: break-word">'.$dicionario['mensagem'][$i]['descricaoItem'].'</div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
    }
}


echo '<!-- CSS específico do app --><link href="/lib/apps/onboarding/css/onboarding.css" rel="stylesheet">';
echo '<!-- JS específico do app --><script type="text/javascript" src="/lib/apps/onboarding/js/onboarding.js"></script>';
// echo '<!-- JS do index --><script type="text/javascript" src="/lib/js/index.js"></script>';
echo '
    <div class="capaOnboarding">
        <div style="width: 100%; height: auto; padding-top: 64px; padding-bottom: 64px; background: #FDF429; justify-content: center; align-items: center; gap: 64px; display: inline-flex">
            <div style="width: 60%; display: inline-flex; gap: 32px;">
                <img style="width: 350px; height: 350px; align-self: center;" src="'. getBaseUrl() .'/lib/img/apps/onboarding/capa.png" />
                <div style="flex-direction: column; justify-content: center; align-items: center; gap: 32px; display: inline-flex;width: 80%;">
                    <div style="width: 100%; height: 100%; color: #49494F; font-size: 96px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word; letter-spacing: -10px; line-height: 100%;">Que bom que você chegou!</div>
                    <div style="width: 100%; height: 100%"><span style="color: #49494F; font-size: 32px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">Agora vou te mostrar um pouco de </span><span style="color: #49494F; font-size: 32px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">como a nossa dependência funciona</span><span style="color: #49494F; font-size: 32px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word"> e tudo o que você precisa saber nesse primeiro contato!</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="conteudoOnboarding">
        <div class="divisaoEquipesOnboarding" style="width: 100%; height: auto; padding-left: 8px; padding-right: 8px; padding-top: 32px; padding-bottom: 32px; background: #FAFAFB; flex-direction: column; justify-content: flex-start; align-items: center; gap: 32px; display: inline-flex">
            <div style="width: 50%; text-align: center; color: #49494F; font-size: 48px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Divisão das Equipes</div>
            <img class ="imagemDivisaoCadOnboarding Clicar" attr-linkinterno ="quemSomos" style="width: 75%; height: auto" src="'. getBaseUrl() .'/lib/img/apps/onboarding/nossasEquipes.svg" />
        </div>

       <!-- <div class="apresentacaoSquadsOnboarding">
            <div style="width: 50%; text-align: center; color: #49494F; font-size: 48px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Estamos divididos em Squads</div>
            <div style="width: 75%; color: #49494F; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word"><br/>Design e Construção</div>
            --><!-- <div style="width: 75%; color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">É aqui, em contato direto com os gestores de cada produto, onde acontece a ideação, desenvolvimento e implementação de fluxos e conteúdos conversacionais/de voz para bot WhatsApp PF e PJ e Skill BB na Alexa.</div> -->
            <!--<div style="width: 75%; color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">É aqui, em contato direto com os gestores de cada produto, onde acontece a ideação, desenvolvimento e implementação de fluxos e conteúdos conversacionais/de voz para bot WhatsApp PF e PJ, App BB, mídias sociais e portais do BB.</div>
        
            <div class="divSquadsOnboarding" style="width: 75%; display: flex; flex-wrap: wrap; background: white; justify-content: center; background-color: #F0F2F4; gap: 8px;">
                '.$montaDivSquads.'
            </div>
            
            <div style="width: 75%; color: #49494F; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Métricas e Inovação</div>
            <div style="width: 75%; color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">É aqui onde pesquisamos, testamos, acompanhamos e medimos os resultados das nossas soluções.</div>
            
            <div style="align-self: stretch; justify-content: center; align-items: flex-start; gap: 10px; display: inline-flex">
                <div style="width: 20rem; padding: 16px; background: #FCFDFE; box-shadow: 0px 0px 1px rgba(25, 25, 28, 0.25); border-radius: 8px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 24px; display: inline-flex">
                <div style="align-self: stretch; height: auto; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">-->
                    <!-- <div style="align-self: stretch; color: #49494F; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">Experimentação, Pesquisa e Curadoria</div> -->
                   <!-- <div style="align-self: stretch; color: #49494F; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">Inovação, Experimentação e Sustentação</div>
                </div>
            </div>

            <div style="width: 20rem; padding: 16px; background: #FCFDFE; box-shadow: 0px 0px 1px rgba(25, 25, 28, 0.25); border-radius: 8px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 24px; display: inline-flex">
                <div style="align-self: stretch; height: auto; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">-->
                    <!-- <div style="align-self: stretch; color: #49494F; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">Informações Gerenciais e Infraestrutura</div> -->
                    <!--<div style="align-self: stretch; color: #49494F; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">Analytics, Administrativo e Pessoas</div>
                </div>
            </div>
        </div>-->
    </div>

    <div class="divDinamicaTrabalhoOnboarding">
        <div style="width: 100%; height: auto; padding-left: 8px; padding-right: 8px; padding-top: 64px; padding-bottom: 64px; background: #F0F2F4; flex-direction: column; justify-content: flex-start; align-items: center; gap: 32px; display: inline-flex">
            <div style="width: 50%; text-align: center; color: #49494F; font-size: 48px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Um pouco da nossa dinâmica de trabalho</div>
            <img style="width: 70%; height: auto" src="'. getBaseUrl() .'/lib/img/apps/onboarding/dinamica1.png" />
            <img style="width: 50%; height: auto" src="'. getBaseUrl() .'/lib/img/apps/onboarding/dinamica2.png" />
        </div>
    </div>

    <div class="principaisMetricasOnboarding" style = "background-color: #F0F2F4;">
        <div style="width: 50%;text-align: center;color: #49494F;font-size: 48px;font-family: BancoDoBrasil Titulos;font-weight: 700;word-wrap: break-word;">
            Principais métricas
        </div>

        <div class="conteudoMetricasOnboarding" style="width: 97%; box-shadow: 7px 14px 11px rgba(0, 0, 0, 0.25);">
            <div style="width: 100%; height: 256px; position: relative;">
                <div style="width: 100%; height: auto; left: 0px; top: 0px; position: absolute; justify-content: center; align-items: flex-start; display: inline-flex">
                    <div style="flex: 1 1 0; align-self: stretch; padding-left: 64px; padding-right: 64px; padding-top: 16px; padding-bottom: 16px; background: #FEFEFE; justify-content: flex-start; align-items: center; gap: 24px; display: flex">
                        <div style="width: 96px; height: auto; padding-top: 8px; padding-bottom: 8.20px; padding-left: 8px; padding-right: 8px; justify-content: center; align-items: center; display: flex">
                            <div style="width: 80px; height: 79.80px;">
                                <i class="fa-sharp fa-solid fa-star" aria-hidden="true" style="color: #07B4F2;font-size: 72px;"></i>
                            </div>
                        </div>
                        <div style="flex: 1 1 0; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: inline-flex">
                            <div style="align-self: stretch; color: #111214; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">
                                Nota de Feedback
                            </div>
                            <div style="align-self: stretch; color: #6C7077; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: auto; letter-spacing: 0.08px; word-wrap: break-word">
                                Principal direcionamento da dependência, presente no OKR da diretoria.
                            </div>
                        </div>
                    </div>
                    <div style="flex: 1 1 0; align-self: stretch; padding-left: 64px; padding-right: 64px; padding-top: 16px; padding-bottom: 16px; background: #F2F4F8; justify-content: flex-start; align-items: center; gap: 24px; display: flex">
                        <div style="width: 96px; height: auto; padding-top: 8px; padding-bottom: 7.95px; padding-left: 8px; padding-right: 8px; justify-content: center; align-items: center; display: flex">
                            <div style="width: 80px; height: 80.05px;">
                                <i class="far fa-comment-dots" aria-hidden="true" style="color: #07B4F2;font-size: 72px;"></i>
                            </div>
                        </div>
                        <div style="flex: 1 1 0; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: inline-flex">
                            <div style="align-self: stretch; color: #111214; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">
                                Transbordo
                            </div>
                            <div style="align-self: stretch; color: #6C7077; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: auto; letter-spacing: 0.08px; word-wrap: break-word">
                                Manter um baixo índice de direcionamento para atendimento humano é importante para diminuir custos e desafogar a rede.
                            </div>
                        </div>
                    </div>
                </div>
                
                <div style="width: 100%; height: auto; left: 0px; top: 128px; position: absolute; justify-content: center; align-items: flex-start; display: inline-flex">
                    <div style="flex: 1 1 0; align-self: stretch; padding-left: 64px; padding-right: 64px; padding-top: 16px; padding-bottom: 16px; background: #F2F4F8; justify-content: flex-start; align-items: center; gap: 24px; display: flex">
                        <div style="width: 96px; height: auto; padding-left: 4px; padding-right: 4px; padding-top: 8px; padding-bottom: 8px; justify-content: center; align-items: center; display: flex">
                            <div style="width: 80px; height: 80.05px;">
                                <i class="fas fa-users" aria-hidden="true" style="color: #07B4F2;font-size: 72px;"></i>
                            </div>
                        </div>
                        <div style="flex: 1 1 0; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: inline-flex">
                            <div style="align-self: stretch; color: #111214; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">
                                Usuários ativos
                            </div>
                            <div style="align-self: stretch; color: #6C7077; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: auto; letter-spacing: 0.08px; word-wrap: break-word">
                                Trazer e manter os clientes no canal é um desafio diário, seja através de campanhas ou informações relevantes e precisas.
                            </div>
                        </div>
                    </div>
                    <div style="flex: 1 1 0; align-self: stretch; padding-left: 64px; padding-right: 64px; padding-top: 16px; padding-bottom: 16px; background: #FEFEFE; justify-content: center; align-items: center; gap: 24px; display: flex">
                        <div style="width: 96px; height: auto; padding-left: 8px; padding-right: 8px; padding-top: 12px; padding-bottom: 12px; justify-content: center; align-items: center; display: flex">
                            <div style="width: 80px; height: 80.05px;">
                                <i class="fas fa-sign-out-alt" aria-hidden="true" style="color: #07B4F2;font-size: 72px;"></i>
                            </div>
                        </div>
                        <div style="flex: 1 1 0; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: inline-flex">
                            <div style="align-self: stretch; color: #111214; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">
                                Abandono
                            </div>
                            <div style="align-self: stretch; color: #6C7077; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: auto; letter-spacing: 0.08px; word-wrap: break-word">
                                Ajudar o cliente a completar uma jornada de ponta a ponta é um dos principais objetivos, isso melhora a experiência no canal.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="canaisAtuacaoOnboarding">
        <div style="width: 100%; height: auto; padding-left: 8px; padding-right: 8px; padding-top: 64px; padding-bottom: 64px; background: #FAFAFB; flex-direction: column; justify-content: flex-start; align-items: center; gap: 32px; display: inline-flex">
            <div style="width: 50%; text-align: center; color: #49494F; font-size: 48px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Atuamos em diversos canais</div>
            <div style="display: flex; width: 75%; justify-content: center; align-items: flex-start; align-content: flex-start; gap: 10px; flex-wrap: wrap;">
                '.$montaDivCanais.'
            </div>
        </div>
    </div>

    <div class="ferramentasUtilizadasOnboarding">
        <div style="width: 100%; height: auto; padding-left: 8px; padding-right: 8px; padding-top: 64px; padding-bottom: 64px; background: #F5F5F5; flex-direction: column; justify-content: flex-start; align-items: center; display: inline-flex;">
            <div style="width: 50%; margin-bottom: 16px; text-align: center; color: #49494F; font-size: 48px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Ferramentas que utilizamos</div>
            <div style="width: 50%; margin-bottom: 32px;"><span style="color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Agora vou te mostrar o que faz cada uma das </span><span style="color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">principais ferramentas</span><span style="color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word"> que usamos no nosso dia a dia. <br/><br/>Elas simplificam nosso trabalho e melhoram a comunicação do time.<br/><br/>Entender o que cada ferramenta faz vai ser nossa </span><span style="color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">chave para sermos mestres da produtividade</span><span style="color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">. <br/><br/>Então, bora dar uma olhada no que essas belezinhas têm a oferecer e turbinar nossa eficiência juntos 🚀</span></div>
            '.$montaDivFerramentas.'
        </div>
    </div>

    <div class="guiaLinguagemOnboarding">
        <div style="width: 100%; height: auto; padding-left: 8px; padding-right: 8px; padding-top: 64px; padding-bottom: 64px; background: #FAFAFB; flex-direction: column; justify-content: flex-start; align-items: center; gap: 32px; display: inline-flex">
            <div style="width: 50%; text-align: center; color: #49494F; font-size: 48px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Guia de linguagem</div>
            <div style="width: 50%; color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Tudo que você precisa saber para ensinar um robô a interagir utilizando a voz do BB.<br/><br/>É um material de consulta que visa à criação da linguagem dos bots e um manual de boas práticas.</div>
            <img class="linkGuiaDeLinguagem Clicar" src="'. getBaseUrl() .'/lib/img/apps/onboarding/guiaDeLinguagem.png" style="border-radius: 16px;box-shadow: 5px 5px 1px #ccc;">
        </div>
    </div>

    <div class="whatsappOnboarding">
        <div style="width: 100%; height: auto; padding-top: 64px; padding-bottom: 64px; background: #F5F5F5; flex-direction: column; justify-content: flex-start; align-items: center; gap: 32px; display: inline-flex">
            <div style="align-self: stretch; justify-content: center; align-items: center; gap: 16px; display: inline-flex">
                <div style="text-align: center; color: #49494F; font-size: 48px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">WhatsApp</div>
                <div style="width: 72px; height: auto; padding: 6px; justify-content: center; align-items: center; display: flex">
                    <div style="width: 60px; height: auto; position: relative">
                        <div style="width: 60px; height: auto; left: 0px; top: 0px; position: absolute; background: #20B038"></div>
                        <i class="fa-brands fa-whatsapp fa-2xl" style="font-size: 48px;color: #20B038;"></i>
                    </div>
                </div>
            </div>
            <div style="width: 828px"><span style="color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">O principal canal dos nossos Assistentes Virtuais, ele representa </span><span style="color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">mais de 95% das interações dos usuários.</span></div>
            <div style="justify-content: center; align-items: flex-start; gap: 32px; display: inline-flex">
                <div style="width: 308px; padding: 16px; background: #FCFDFE; box-shadow: 0px 0px 1px rgba(24, 24, 27, 0.08); border-radius: 8px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 24px; display: inline-flex">
                    <div style="align-self: stretch; height: auto; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">
                        <div style="align-self: stretch; color: #49494F; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">61 4004-0001</div>
                        <div style="align-self: stretch; color: #6C7077; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: auto; letter-spacing: 0.08px; word-wrap: break-word">Número de Produção</div>
                    </div>
                </div>
                <div style="width: 308px; padding: 16px; background: #FCFDFE; box-shadow: 0px 0px 1px rgba(24, 24, 27, 0.08); border-radius: 8px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 24px; display: inline-flex">
                    <div style="align-self: stretch; height: auto; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">
                        <div style="align-self: stretch; color: #49494F; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">61 98326-0008</div>
                        <div style="align-self: stretch; color: #6C7077; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: auto; letter-spacing: 0.08px; word-wrap: break-word">Número de Protótipo</div>
                    </div>
                </div>
                <div style="width: 308px; padding: 16px; background: #FCFDFE; box-shadow: 0px 0px 1px rgba(24, 24, 27, 0.08); border-radius: 8px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 24px; display: inline-flex">
                    <div style="align-self: stretch; height: auto; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">
                        <div style="align-self: stretch; color: #49494F; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">61 98326-0008</div>
                        <div style="align-self: stretch; color: #6C7077; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: auto; letter-spacing: 0.08px; word-wrap: break-word">Número de Homologação</div>
                    </div>
                </div>
            </div>
            <div style="width: 828px">
                <span style="color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Utilizando o input </span><span style="color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">#mudaCorpus</span><span style="color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word"> você tem a possibilidade de </span><span style="color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">mudar os corpus do bot no WhatsApp.<br/></span>
                <span style="color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word"><br/>Isso facilita na hora de</span><span style="color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word"> testar as jornadas</span><span style="color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word"> que estão sendo construídas.</span>
            </div>
            <img style="width: 800px; height: auto" src="'. getBaseUrl() .'/lib/img/apps/onboarding/mudaCorpus.png">
            <div style="width: 828px; color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Nesse input tem a opção de ativar o modo teste, que é representado no NIA pela variável <b>$modo_teste</b>.</div>
            <img style="width: 498px; height: auto; border-radius: 24px" src="'. getBaseUrl() .'/lib/img/apps/onboarding/modoTeste.png" />
            <div style="width: 828px"><span style="color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Você também consegue limpar todo o contexto e reiniciar como se fosse uma nova conversa do zero com o comando </span><span style="color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">recomecar</span>.</div>
            <img style="width: 498px; height: auto; border-radius: 24px" src="'. getBaseUrl() .'/lib/img/apps/onboarding/recomecar.png" />
        </div>
    </div>

    <div class="glossarioOnboarding">
        <div style="width: 100%; height: auto; padding-left: 8px; padding-right: 8px; padding-top: 64px; padding-bottom: 64px; background: #FAFAFB; flex-direction: column; justify-content: flex-start; align-items: center; gap: 32px; display: inline-flex">
            <div style="width: 828px; text-align: center; color: #49494F; font-size: 48px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Dicionário</div>
            <div class="conteudoGlossario" style="display: flex; width: 76%; justify-content: center; align-items: flex-start; align-content: flex-start; gap: 10px; flex-wrap: wrap;">
                '.$montaDivDicionario.'
            </div>
        </div>
    </div>

    <div class="escolhaCaminhoOnboarding">
        <div style="width: 100%; height: auto; padding-top: 64px; padding-bottom: 64px; background: #F5F5F5; flex-direction: column; justify-content: flex-start; align-items: center; gap: 32px; display: inline-flex">
            <div style="width: 828px; text-align: center; color: #49494F; font-size: 48px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Escolha seu caminho</div>
            <div style="width: 828px; color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Aqui no CAD temos uma multiplicidade de perfis profissionais atuando colaborativamente, escolha a trilha de acordo com seu perfil:
                <br/>
            </div>
            <div style="align-self: stretch; flex: 1 1 0; justify-content: center; align-items: flex-start; display: inline-flex">
                <div style="width: 100%; height: auto; padding-top: 32px; padding-bottom: 32px; background: #F2F4F8; flex-direction: column; justify-content: flex-start; align-items: center; gap: 32px; display: inline-flex">
                    <div style="flex-direction: column; justify-content: flex-start; align-items: center; gap: 32px; display: flex">
                        <div style="justify-content: flex-start; align-items: flex-start; gap: 16px; display: inline-flex">
                            
                            <div /*class="abrePaginaInterna Clicar" attr-linkinterno="ux"*/ style="width: 40vh; height: 30vh; padding-left: 16px; flex-direction: column; justify-content: flex-start; align-items: flex-start; display: inline-flex; border-left: 1px solid black;">
                                <div style="width: 32px; height: 21px; position: relative">
                                    <div style="width: 32px; height: 24px; left: 0px; top: 1px; position: absolute; background: #07B4F2; border-radius: 5px"></div>
                                    <div style="width: 29.54px; height: 16px; left: 2.21px; top: 0px; position: absolute; color: white; font-size: 18px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">UX</div>
                                </div>
                                <div style="width: 300px;"><span style="color: #49494F; font-size: 40px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Curadores<br/></span><span style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Acompanhamento e análise da jornada dos clientes nos assistentes virtuais para identificação de correções e melhorias.</span></div>
                                <div style="padding: 9px 16px;background: #E5E7EB; border-radius: 4px; display: inline-flex;">
                                    <div style="color: #B4B9C1; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px;">
                                        EM BREVE
                                    </div>
                                </div>
                            </div>

                            <div class="abrePaginaInterna Clicar" attr-linkinterno="ux" style="width: 40vh; height: 30vh; padding-left: 16px; flex-direction: column; justify-content: flex-start; align-items: flex-start; display: inline-flex; border-left: 1px solid black;">
                                <div style="width: 32px; height: 21px; position: relative">
                                    <div style="width: 32px; height: 24px; left: 0px; top: 1px; position: absolute; background: #07B4F2; border-radius: 5px"></div>
                                    <div style="width: 29.54px; height: 16px; left: 2.21px; top: 0px; position: absolute; color: white; font-size: 18px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">UX</div>
                                </div>
                                <div style="width: 300px;"><span style="color: #49494F; font-size: 40px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">UX Writers<br/></span><span style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Planejamento das experiências conversacionais dos clientes nos assistentes virtuais.</span></div>
                            </div>

                            <div class="abrePaginaInterna Clicar" attr-linkinterno="ux" style="width: 40vh; height: 30vh; padding-left: 16px; flex-direction: column; justify-content: flex-start; align-items: flex-start; display: inline-flex; border-left: 1px solid black;">
                                <div style="width: 32px; height: 21px; position: relative">
                                    <div style="width: 32px; height: 24px; left: 0px; top: 1px; position: absolute; background: #07B4F2; border-radius: 5px"></div>
                                    <div style="width: 29.54px; height: 16px; left: 2.21px; top: 0px; position: absolute; color: white; font-size: 18px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">UX</div>
                                </div>
                                <div style="width: 300px;"><span style="color: #49494F; font-size: 40px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">UX Researchers<br/></span><span style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Realização de pesquisas junto ao time de curadoria para insights sobre os bots e benchmark.</span></div>
                            </div>

                        </div>
                        <div style="align-self: stretch; justify-content: flex-start; align-items: flex-start; gap: 16px; display: inline-flex">
                            
                            <div style="width: 40vh; height: 30vh; padding-left: 16px; flex-direction: column; justify-content: flex-start; align-items: flex-start; display: inline-flex; border-left: 1px solid black;">
                                <div style="width: 40px; height: 21px; position: relative">
                                    <div style="width: 40px; height: 24px; left: 0px; top: 1px; position: absolute; background: #07B4F2; border-radius: 5px"></div>
                                    <div style="width: 36.92px; height: 16px; left: 2.76px; top: 0px; position: absolute; color: white; font-size: 18px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Dev</div>
                                </div>
                                <div style="width: 300px"><span style="color: #49494F; font-size: 40px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Devs<br/></span><span style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Construção de jornadas conversacionais dos assistentes virtuais e do portal cad.bb.com.br.</span></div>
                                <div style="padding: 9px 16px;background: #E5E7EB; border-radius: 4px; display: inline-flex;">
                                    <div style="color: #B4B9C1; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px;">
                                        EM BREVE
                                    </div>
                                </div>
                            </div>

                            <div style="width: 40vh; height: 30vh; padding-left: 16px; flex-direction: column; justify-content: flex-start; align-items: flex-start; display: inline-flex; border-left: 1px solid black;">
                                <div style="width: 91px; height: 21px; position: relative">
                                    <div style="width: 91px; height: 24px; left: 0px; top: 1px; position: absolute; background: #07B4F2; border-radius: 5px"></div>
                                    <div style="width: 84px; height: 16px; left: 4px; top: 0px; position: absolute; color: white; font-size: 18px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Analytics</div>
                                </div>
                                <div style="width: 361px">
                                    <span style="color: #49494F; font-size: 38px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Cientistas de dados<br/></span><span style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Extração e tratamento de dados e criação de painéis para acompanhamento de jornadas e indicadores.</span>
                                </div>
                                <div style="padding: 9px 16px;background: #E5E7EB; border-radius: 4px; display: inline-flex;">
                                    <div style="color: #B4B9C1; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px;">
                                        EM BREVE
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
';

include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php";
?>


