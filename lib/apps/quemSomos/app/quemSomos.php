<?php


if(!isset($_SESSION)){
    session_start();
}

// ini_set("display_errors", E_ALL);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/quemSomos/class/class_quemSomos.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Quem Somos', $_SESSION['ip']);

echo '<!-- CSS específico do app --><link href="/lib/apps/quemSomos/css/quemSomos.css" rel="stylesheet">';
echo '<!-- JS específico do app --><script type="text/javascript" src="/lib/apps/quemSomos/js/quemSomos.js"></script>';
echo '
    <div class="descricaoQuemSomos">
        <!-- <img src="/lib/img/apps/quemSomos/fotoQuemSomos.png" style="width: 100%;"> -->
        <img src="/lib/img/apps/quemSomos/fotoQuemSomosNovo.jpg" style="width: 100%;">
            <div class="textoFotoQuemSomos">Quem somos?</div>
        </img>
        <br>
        <div class="textoDescricaoQuemSomos">
            <span style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Somos o <b style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">Centro de Assistentes Digitais</b>!<br><br>
            </span>
            <span style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Um time de programadores, designers, especialistas em dados e experiência do usuário, que são a alma dos <b style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">Assistentes Virtuais</b> do BB.
            </span><span style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
            <br><br>Nossa missão é tornar o BB cada vez mais próximo e relevante na vida das pessoas e fomentar o espírito de inovação que nos mantém na vanguarda da tecnologia no atendimento bancário.
            <br><br>Utilizamos ferramentas de chatbot e inteligência artificial para entregar soluções fáceis e acessíveis para nossos clientes através de fluxos e conteúdos conversacionais no WhatsApp e assistentes de voz.<br><br></span><span style="color: #49494F; font-size: 28px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">Experimentamos, testamos, medimos e tomamos decisões.<br><br></span>
            <span style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Estudando o comportamento e os desejos dos nossos clientes, conseguimos proporcionar jornadas mais humanas, que levam em conta suas necessidades e emoções, oferecendo um atendimento útil, amigável e respeitoso.<br></span>
        </div>
    </div>
    <div class="nossasEquipes">
        <div class="tituloNossasEquipes">Nossas equipes</div>
        <div class="divSetoresSquads">
';

$class = new funcoes();
$setores = $class->consultaSetores();

$montaDivSetores = '';

if($setores['status'] == 0) {
    // $montaDivSetores = $setores['mensagem'];
    echo $setores['mensagem'];
} else {
    for($k=0; $k < sizeof($setores['mensagem']); $k++){

        $montaDivSetores = $montaDivSetores.'<div id="'.$setores['mensagem'][$k]['id'].'" class="divSetor"><div class="nomeSetor">'.$setores['mensagem'][$k]['setor'].'</div><div class="descricaoSetor">'.$setores['mensagem'][$k]['descricaoSetor'].'</div>';
        $squads = $class->consultaSquads($setores['mensagem'][$k]['id']);
            
        $montaDivSquads = '';
        if($squads['status'] == 0){
            echo $squads['mensagem'];
        } else {
            for($i=0; $i < sizeof($squads['mensagem']); $i++){
                $border = '';
        
                if(($i==0) && ((sizeof($squads['mensagem'])>1))){
                    $border = 'style="border-top-right-radius: 16px;border-top-left-radius: 16px;"';
                } else if(($i == (sizeof($squads['mensagem'])-1)) && ((sizeof($squads['mensagem'])>1))){
                    $border = 'style="border-bottom-right-radius: 16px;border-bottom-left-radius: 16px; border-bottom: 0px; margin-bottom:8px;"';
                } else if(sizeof($squads['mensagem']) == 1){
                    $border = 'style="border-radius: 16px; margin-bottom:8px;"';
                } else {
                    $border = 'style="border-bottom: 1px solid #F0F2F4;"';
                }
        
                $montaDivSquads = $montaDivSquads.'
                    <div id="'.$squads['mensagem'][$i]['id'].'" class="divSquad" '.$border.'>
                        <div class="funcisSquads">'.$squads['mensagem'][$i]['squad'].'<button class="btn btn-outline-dark botaoSetaSquad'.$squads['mensagem'][$i]['id'].'"><i class="fa fa-chevron-down iconeSetaSquad'.$squads['mensagem'][$i]['id'].'"></i></button></div>
                            <div class="squadsFuncionarios" attr-squadAberta="0">
                                <div class="squad'.$squads['mensagem'][$i]['id'].' classSquads" attr-idSquad="'.$squads['mensagem'][$i]['id'].'">
                                    <br>
                                    <div class="descricaoSquad">'.$squads['mensagem'][$i]['descricaoSquad'].'
                                    </div>
                                    <br>
                                    <div class="gerenteSquad">
                                        <a class="abreHumanograma" href="https://humanograma.intranet.bb.com.br/'.$squads['mensagem'][$i]['matGerente'].'" target="_blank">
                                            <div class="detalheGerente">
                                                <div style="width: 95px; height: 95px; background: #D9D9D9; border-radius: 9999px">
                                                    <img class="detalheFunciFotoPerfil" src="https://humanograma.intranet.bb.com.br/avatar/'.$squads['mensagem'][$i]['matGerente'].'">
                                                </div>
                                                <div style="flex-direction: column; justify-content: center; align-items: center; gap: 4px; display: flex">
                                                    <div class="detalheNomeFunci">'.$squads['mensagem'][$i]['nomeGerente'].'
                                                    </div>
                                                    <div class="detalheCargoFunci">'.$squads['mensagem'][$i]['nomeFuncao'].'
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                ';
        
                $funcisSquads = $class->consultaFuncisSquads($squads['mensagem'][$i]['id']);
                $montaFuncisSquads = '<div class="funciSquad">';
                
                for($j=0; $j < sizeof($funcisSquads['mensagem']); $j++){
                    $montaFuncisSquads = $montaFuncisSquads.'
                        <div class="detalhesFunci" attr-idSquad="'.$squads[$i]['id'].'">
                            <a class="abreHumanograma" href="https://humanograma.intranet.bb.com.br/'.$funcisSquads['mensagem'][$j]['matricula'].'" target="_blank">
                                <div class="detalheFunciTop">
                                    <div class="detalheFunciFoto">
                                        <img class="detalheFunciFotoPerfil" src="https://humanograma.intranet.bb.com.br/avatar/'.$funcisSquads['mensagem'][$j]['matricula'].'">
                                    </div>
                                </div>
                                <div class="detalheFunciBottom">
                                    <div class="detalheNomeFunci">'.$funcisSquads['mensagem'][$j]['nomeGuerra'].'
                                    </div>
                                    <div class="detalheCargoFunci">'.$funcisSquads['mensagem'][$j]['nomeFuncao'].'
                                    </div>
                                </div>
                            </a>
                        </div>';
                }
                $montaDivSquads = $montaDivSquads.$montaFuncisSquads.'</div></div></div></div>';
            }
            $montaDivSetores = $montaDivSetores.$montaDivSquads.'</div>';
        }
    }
    echo $montaDivSetores.'</div>';
}


$consultaVagas = $class->consultaVagas();
$montaDivVagas = '';
$classeCorDeFundoSemVagas = '';

for($i = 0; $i < sizeof($consultaVagas['mensagem']); $i++){
    
    if(($consultaVagas['mensagem'][$i]['qtdVagas']) == 0){
        $classeCorDeFundoSemVagas = "style = 'background-color: #F0F2F4'";
    }
    
    $montaDivVagas = $montaDivVagas.'
        <div class= "quadroDadosVagas" '.$classeCorDeFundoSemVagas.'>
            <div class = "dadosVaga">
                <div class="descCargo">'.$consultaVagas['mensagem'][$i]['descricaoFuncao'].'</div>
                <div class="codVaga">'.$consultaVagas['mensagem'][$i]['codVaga'].'</div>
            </div>    
                <div class="qtdVagas">'.$consultaVagas['mensagem'][$i]['qtdVagas'].'</div>
        </div>
    ';
    $classeCorDeFundoSemVagas = '';
}
            
echo '</div><br />
<div class="temosVagas">
    <div class="apresentacaoTemosVagas">
        <div class="tituloTemosVagas">Crescer para inovar 🔄 Inovar para crescer.</div>
        <div class="descricaoTemosVagas">Se identificou com o nosso trabalho? 
            <br/>
            Estamos sempre em busca de novos talentos para enriquecer nosso time.
            <br/>
            <br/>
            Aqui no CAD temos uma multiplicidade de perfis profissionais atuando colaborativamente:  
            <br/>
        </div>
    </div>
    <div class="descricaoAtividadesVagas">
        <div style="flex-direction: column; justify-content: flex-start; align-items: center; gap: 32px; display: flex">
            <div style="justify-content: center; align-items: flex-start; gap: 16px; display: inline-flex;width: 62%;flex-wrap: wrap;">
                <div style="width: 40vh;border-left: 1px solid black;padding-left: 16px;height: auto;">
                    <span style="color: #49494F; font-size: 40px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Curadores<br></span>
                    <span style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Acompanhamento e análise da jornada dos clientes nos assistentes virtuais para identificação de correções e melhorias.</span>
                </div>
                <div style="width: 40vh;border-left: 1px solid black;padding-left: 16px;">
                    <span style="color: #49494F; font-size: 40px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">UX Writers<br></span>
                    <span style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Planejamento das experiências conversacionais dos clientes nos assistentes virtuais.</span>
                </div>
                <div style="width: 40vh;border-left: 1px solid black;padding-left: 16px;">
                    <span style="color: #49494F; font-size: 40px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">UX Researchers<br></span>
                    <span style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Realização de pesquisas junto ao time de curadoria para insights sobre os bots e benchmark.</span>
                </div>
                <div style="width: 40vh;border-left: 1px solid black;padding-left: 16px;">
                    <span style="color: #49494F; font-size: 40px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Devs<br></span>
                    <span style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Construção de jornadas conversacionais dos assistentes virtuais e do portal cad.bb.com.br.</span>
                </div>
                <div style="width: 42vh;border-left: 1px solid black;padding-left: 16px;">
                    <span style="color: #49494F; font-size: 38px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Cientistas de dados<br></span>
                    <span style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Extração e tratamento de dados e criação de painéis para acompanhamento de jornadas e indicadores.</span>
                </div>
                <div style="width: 38vh;border-left: 0px solid #F0F2F4;padding-left: 16px;">

                </div>
                <div style="width: 100%; height: 100%; text-align: center; padding-top: 32px;">
                    <span style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Estes perfis são divididos em dois grupos, </span>
                    <span style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 500; word-wrap: break-word">Analytics/Programação</span><span style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word"> e </span>
                    <span style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 500; word-wrap: break-word">UX/Design Conversacional </span>
                    <span style="color: #49494F; font-size: 18px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">para inscrição em todas as nossas funções.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="quadroVagas">
        <div style="width: 100%; height: 100%; text-align: center; padding-top: 32px;">
            
            <span style="color: #49494F; font-size: 32px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">Confira nossas oportunidades:<br/></span>
        </div>
        <div class="quadroVagasQuantidade">'.$montaDivVagas.'</div>
            <!-- <div style="width: 100vw; text-align: center; color: #49494F; font-size: 32px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word; margin-top: 16px;">Se inscreva no DigiTAO</div>
            <div class="quadroInscreva" class>
                <a href="https://plataforma.atendimento.bb.com.br:49286/estatico/gaw/app/spas/index/index.app.html?cd_modo_uso=44&amp;app=tao.inscricao" target="_blank" style="text-decoration: none;">
                    <div class="conteudoQuadroInscreva">
                        <span style="color: #49494F; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 700;">Plataforma BB &gt; Pessoas &gt; Minha Visão &gt; Talentos e Oportunidades (DigiTAO)</span>
                    </div>
                </a>
            </div> -->


            <div style="width: 100vw; text-align: center; color: #49494F; font-size: 32px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word; margin-top: 16px; padding: 30px; ">Conheça o Programa de Formação do CAD</div>
            <div class="quadroInscreva" class>
                <a href="https://cad.bb.com.br/formacao-bots/" target="_blank" style="text-decoration: none;">
                    <div class="conteudoQuadroInscreva">
                        <span style="color: #49494F; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 700;">Clique aqui para acessar o hotsite</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
';

include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php";