<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['matricula'])) {
    $_SESSION['matricula']   = 'F0285739';
    $_SESSION['nome']        = 'Albert Ferreira Rosa';
    $_SESSION['cargo']       = 'Analista Tec Pleno';    // pode ser string, mas no banco espera INT
    $_SESSION['MAIL']        = 'albert.rosa@bb.com.br';
    $_SESSION['dependencia'] = '1901';
    $_SESSION['ip']          = '10.10.10.10';
}

// ini_set("display_errors", E_ALL);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/mentoria/class/class_mentoria.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Mentoria', $_SESSION['ip']);

$class = new funcoes();

$consultaDepoimentosMentoria = $class->consultaDepoimentosMentoria();
$consultaProfessoresMentoria = $class->consultaProfessoresMentoria();

?>

<!-- CSS específico do app -->
<link href="/lib/apps/mentoria/css/mentoria.css" rel="stylesheet">

<!-- JS específico do app -->
<script type="text/javascript" src="/lib/apps/mentoria/js/mentoria.js"></script>

<div class="Mentoria" style="width: 100%; height: 100%; position: relative;">
    <div class="cabecalhoMentoria">
        <div class="tituloImagemCabecalhoMentoria">
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
                    <a class="botaoSolicitarMentoria" href="https://cad.bb.com.br/formulario_imersao/" target="_blank">
                        <div>
                            <div class="textoSolicitarAgora">
                                Solicitar agora
                            </div>
                        </div>
                    </a>
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
                <div class="linhaHorizontalDescricaoImersaoMentoria" style="margin: 5% 0% 5% 1%;"></div>
                <div class="linhaHorizontalDescricaoImersaoMentoria" style="margin: 5% 4% -9% 5%;"></div>
                <div class="linhaHorizontalDescricaoImersaoMentoria" style="margin: 5% 1% 5% 0.5%;"></div>
            </div>

            <div class="segundaLinhaQuadrosDescricaoMentoria">
                <div class="quadroDescricaoImersaoMentoria" style="margin-top: -5%;">
                    <div class="tituloDescricaoImersaoMentoria">
                        Para quem
                    </div>
                    <div class="textoDescricaoImersaoMentoria">
                        Áreas do BB que desejam entender o funcionamento dos assistentes virtuais para implementar em suas operações, bem como empresas de diversos segmentos que buscam aprimorar a eficiência e a qualidade do atendimento por meio de chatbots inteligentes.
                    </div>
                </div>

                <div class="linhaVerticalDescricaoImersaoMentoria" style="margin: -4% 1% 1% 2%; !important"></div>
                
                <div class="quadroDescricaoImersaoMentoria" style="margin-top: -5%;">
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

    <div class="transicaoCabecalhoTemasMentoria"></div>

    <div id="temasImersao">
        <div class="tituloSubtituloTemaMentoria">
            <div class="tituloTemaMentoria">Temas</div>
            <div class="quadroSubtitulosTemaMentoria">
                <div class="subtituloTemaMentoria Clicar temaClicadoMentoria" attr-div="divGestaoConhecimentoMentoria" attr-divAtiva="divGestaoConhecimentoMentoria">Gestão de conhecimento</div>
                <div class="subtituloTemaMentoria Clicar" attr-div="divUxMentoria" attr-divAtiva="divGestaoConhecimentoMentoria">UX</div>
                <div class="subtituloTemaMentoria Clicar" attr-div="divDevMentoria" attr-divAtiva="divGestaoConhecimentoMentoria">DEV</div>
                <div class="subtituloTemaMentoria Clicar" attr-div="divAnalyticsMentoria" attr-divAtiva="divGestaoConhecimentoMentoria">Analytics</div>
                <div class="subtituloTemaMentoria Clicar" attr-div="divCuradoriaMentoria" attr-divAtiva="divGestaoConhecimentoMentoria">Curadoria</div>
                <div class="subtituloTemaMentoria Clicar" attr-div="divVuiDesignMentoria" attr-divAtiva="divGestaoConhecimentoMentoria">VUI Design</div>
            </div>
        </div>
        <div class="descricaoTemaMentoria">
            <div class="divGestaoConhecimentoMentoria visible">
                <img class="imagemDescricaoTemaMentoria" src="/lib/img/apps/mentoria/imgGestaoConhecimento.png" alt="Gestão de Conhecimento">
                <span class="textoDescricaoTemaMentoria">
                    A <b>organização eficaz</b> de uma base de conhecimento começa com o <b>mapeamento dos conteúdos mais relevantes</b>, identificando quais informações têm maior impacto para os usuários.<br><br>
                    A <b>priorização</b> de inclusão desses conteúdos segue o <b>princípio de Pareto</b>, focando nos <b>20% que geram 80% dos resultados</b>.<br><br>
                    As <b>jornadas dos usuários</b> podem ser categorizadas em <b>ativos, orgânicos, transações e induções</b>, cada uma com estratégias específicas de engajamento. Por exemplo, na jornada ativa, é crucial considerar o opt-in, avaliando custos, restrições e tipos de disparos para maximizar a eficiência e a relevância das comunicações.
                </span>
            </div>
            <div class="divUxMentoria hidden">
                <img class="imagemDescricaoTemaMentoria" src="/lib/img/apps/mentoria/imgUx.png" alt="Experiência do Usuário">
                <span class="textoDescricaoTemaMentoria">
                    Um <b>assistente virtual</b> deve proporcionar uma experiência <b>intuitiva e eficiente</b>, respondendo rapidamente às necessidades dos usuários com <b>clareza e acessibilidade</b>.<br><br>
                    É essencial manter um <b>padrão de linguagem</b> que reflita a <b>personalidade do assistente</b> e da <b>organização</b>. Para isso, <b>o guia de linguagem de chatbots</b> e a <b>Brandzone BB</b>, alinhados com as <b>diretrizes da linguagem simples</b>, serão de grande ajuda.<br><br>Ferramentas como o <b>Figma</b> são fundamentais para representar e documentar as <b>jornadas</b>. A combinação de <b>imagens e componentes</b> reforça a mensagem escrita, tornando o assistente mais convidativo.<br><br>
                    Além disso, <b>pesquisas, experimentações</b> e <b>testes A/B</b> são cruciais para entender melhor os usuários e aprimorar o chatbot continuamente.
                </span>
            </div>
            <div class="divDevMentoria hidden">
                <img class="imagemDescricaoTemaMentoria" src="/lib/img/apps/mentoria/imgDev.png" alt="Desenvolvimento">
                <span class="textoDescricaoTemaMentoria">
                    Para desenvolver um <b>chatbot eficaz</b>, é essencial priorizar <b>funcionalidades de alta demanda e valor</b> para o usuário, simplificando o desenvolvimento para evitar complicações e <b>modularizando componentes</b> para reutilização e redução de acoplamentos. É importante considerar os <b>ambientes de desenvolvimento</b> (piloto, hm, prod).<br><br>
                    Aproveitar o <b>histórico das conversas</b> e integrações com o <b>CRM</b> enriquecem a experiência do usuário. A <b>integração das transações</b> mais utilizadas em outros canais aumenta a relevância do chatbot, enquanto <b>mensagens ativas</b> geram leads negociais.<br><br>
                    Utilizar <b>buscas conversacionais</b> para fallbacks melhora a precisão do chatbot e desafoga a curadoria. A <b>indexação de documentos</b>, com ou sem LLMs, é um primeiro passo para a utilização de <b>IA generativa</b> nas respostas.
                </span>
            </div>
            <div class="divAnalyticsMentoria hidden">
                <img class="imagemDescricaoTemaMentoria" src="/lib/img/apps/mentoria/imgAnalytics.png" alt="Analytics">
                <span class="textoDescricaoTemaMentoria">
                    Os <b>indicadores e métricas</b> são essenciais para avaliar a <b>eficácia e a eficiência</b> de um chatbot. Indicadores como <b>nota de avaliação</b>, <b>quantidade de usuários</b> e <b>transbordos</b> ajudam a avaliar a <b>resolutividade</b> do chatbot, além de identificar pontos de aprimoramento.<br><br>
                    O <b>volume de negócios</b> mede o <b>impacto econômico</b> do chatbot e sua contribuição para os <b>objetivos estratégicos</b>.<br><br>
                    Criar <b>dashboards inteligentes</b> com essas informações é fundamental para a <b>análise de dados</b> e tomada de decisões. Esses dashboards agregam e apresentam dados de forma intuitiva e interativa, permitindo monitorar métricas em <b>tempo real</b>, identificar <b>tendências</b> e ajustar <b>estratégias</b> rapidamente. Eles facilitam a <b>visualização e interpretação</b> dos dados, tornando o processo de análise mais eficiente.
                </span>
            </div>
            <div class="divCuradoriaMentoria hidden">
                <img class="imagemDescricaoTemaMentoria" src="/lib/img/apps/mentoria/imgCuradoria.png" alt="Curadoria">
                <span class="textoDescricaoTemaMentoria">
                    O sucesso de um <b>chatbot</b> consiste em garantir <b>respostas precisas, úteis e consistentes,</b> envolvendo a <b>revisão e aperfeiçoamento</b> contínuo dos conteúdos.<br><br>
                    Na identificação de <b>atipicidades</b>, são detectadas respostas que não atendem aos padrões de qualidade, utilizando <b>ferramentas de análise de dados</b> e <b>feedback dos usuários</b>.<br><br>
                    <b>Correções técnicas</b> são realizadas para ajustar algoritmos, atualizar bases de conhecimento e refinar modelos de linguagem, visando corrigir erros, melhorar a precisão e diminuir etapas para os usuários. <b>Testes automatizados e manuais</b> garantem a eficácia das correções.<br><br>Além disso, a <b>curadoria</b> busca continuamente inovações, adicionando novos tópicos e aprimorando respostas existentes, adaptando o chatbot às necessidades dos usuários.
                </span>
            </div>
            <div class="divVuiDesignMentoria hidden">
                <img class="imagemDescricaoTemaMentoria" src="/lib/img/apps/mentoria/imgVuiDesign.png" alt="VUI Design">
                <span class="textoDescricaoTemaMentoria">
                    Os <b>voicebots</b>, como <b>Alexa</b> da Amazon ou o Google Assistant, permitem a interação com dispositivos através de <b>comandos de voz</b>. Outros serviços de voz, como <b>URA Cognitiva</b>, também facilitam a comunicação entre humanos e máquinas.<br><br>
                    Para garantir sua eficácia, é essencial seguir boas práticas como a criação de <b>fluxos de conversa claros</b> e a implementação de <b>feedbacks auditivos</b>. Um <b>guia de linguagem</b> mantém a consistência e naturalidade das respostas, enquanto a <b>acessibilidade</b> adapta a comunicação para pessoas com deficiências.<br><br>
                    Uma boa marcação com <b>SSML</b> ajusta a entonação e o ritmo da fala sintetizada, tornando a interação mais natural. <b>Atmosferas sonoras</b> enriquecem a experiência do usuário com sons de fundo, melhorando o voicebot que se adapta às necessidades dos usuários.
                </span>
            </div>
        </div>
    </div>

    <div class="transicaoTemasProvaSocialMentoria"></div>

    <div class="provaSocial">
        <div class="passaramPorAquiMentoria">
            <div class="tituloPassaramPorAquiMentoria">
                Já passaram por aqui
            </div>
            <div class="imagensPassaramPorAquiMentoria">
                <div class="quemPassouMentoria diretoria01">
                    <img class="logoBBAzulMentoria" src="/lib/img/apps/mentoria/imgLogoBancoDoBrasil.png" />
                    <div class="dadosQuemPassouMentoria" >
                        Gepes - Whats BBFunci<br/>8910
                    </div>
                </div>
                <div class="linhaVerticalMentoria"></div>
                <div class="quemPassouMentoria diretoria02">
                    <img class="logoBBAzulMentoria" src="/lib/img/apps/mentoria/imgLogoBancoDoBrasil.png" />
                    <div class="dadosQuemPassouMentoria">
                        Ditec - Gesec<br/>9905
                    </div>
                </div>
                <div class="linhaVerticalMentoria"></div>
                <div class="quemPassouMentoria diretoria03">
                    <img class="logoBBAzulMentoria" src="/lib/img/apps/mentoria/imgLogoBancoDoBrasil.png" />
                    <div class="dadosQuemPassouMentoria">
                        Dicre - Varejo Brasil<br/>8624
                    </div>
                </div>
                <div class="linhaVerticalMentoria"></div>
                <div class="quemPassouMentoria diretoria04">
                    <img class="logoBBAzulMentoria" src="/lib/img/apps/mentoria/imgLogoBancoDoBrasil.png" />
                    <div class="dadosQuemPassouMentoria">
                        Dicre - Análise e Informações<br/>8624
                    </div>
                </div>
                <div class="linhaVerticalMentoria"></div>
                <div class="quemPassouMentoria diretoria05">
                    <img class="logoBBAzulMentoria" src="/lib/img/apps/mentoria/imgLogoBancoDoBrasil.png" />
                    <div class="dadosQuemPassouMentoria">
                        BB Seguros<br/>8869
                    </div>
                </div>
                <div class="linhaVerticalMentoria"></div>
                <div class="quemPassouMentoria diretoria06">
                    <img class="logoBBAzulMentoria" src="/lib/img/apps/mentoria/imgLogoBancoDoBrasil.png" />
                    <div class="dadosQuemPassouMentoria">
                        BB Américas<br/>
                    </div>
                </div>
            </div>
        </div>

        <div class="oQueDizemSobreMentoria">
            <div class="tituloOQueDizemSobreMentoria">
                O que dizem sobre a imersão
            </div>
            
            <div class="quadroOQueDizemSobreMentoria">
                <?php
                    $inputDepoimentos = '';
                    $depoimentos = '';
                    $labelNavegacaoDepoimentos = '';
                    $cssBotoes = '';

                    if($consultaDepoimentosMentoria['status'] == 0){
                        $depoimentos = $consultaDepoimentosMentoria['mensagem'];
                    } else {
                        // Laço que monta os botões e conteúdo de navegação do carrossel
                        for($i = 0; $i < sizeof($consultaDepoimentosMentoria['mensagem']); $i++){
                            $indiceArrayMaisUm = $i+1;
                            $checked = '';
                            $styleLabel = '';
                            if($i==0){
                                $checked = 'checked';
                                $styleLabel = 'border: 2px solid #000;';
                            }
                            $inputDepoimentos = $inputDepoimentos.'
                                <input type="radio" class = "botao_Carousel" name="carousel" id="slide'.$indiceArrayMaisUm.'" '.$checked.'>
                            ';

                            $labelNavegacaoDepoimentos = $labelNavegacaoDepoimentos.'
                                <label for="slide'.$indiceArrayMaisUm.'" style="'.$styleLabel.'"></label>
                            ';

                            $cssBotoes = $cssBotoes.'#slide'.$indiceArrayMaisUm.':checked ~ .slides .slide:nth-child('.$indiceArrayMaisUm.'),';
                        }

                        // Laço que monta o conteúdo dos depoimentos
                        for($i = 0; $i < sizeof($consultaDepoimentosMentoria['mensagem']); $i++){
                            $indiceArrayMaisUm = $i+1;
                            $fotoHumanograma = $consultaDepoimentosMentoria['mensagem'][$i]['fotoHumanograma'];

                            if($fotoHumanograma == 1){
                                $fotoHumanograma = "https://humanograma.intranet.bb.com.br/avatar/".$consultaDepoimentosMentoria['mensagem'][$i]['matricula']."";
                            } else {
                                $fotoHumanograma = "https://cad.bb.com.br/lib/apps/mentoria/img/".$consultaDepoimentosMentoria['mensagem'][$i]['matricula'].".png";
                            }

                            $depoimentos = $depoimentos.'
                                <div class="slide">
                                    <div class="detalheOQueDizem quadroDetalhe0'.$indiceArrayMaisUm.'">
                                        <div class="imagemEDadosDepoenteMentoria">
                                            <!-- <img class="imgDepoenteMentoria" src="https://humanograma.intranet.bb.com.br/avatar/'.$consultaDepoimentosMentoria['mensagem'][$i]['matricula'].'"> -->
                                            <img class="imgDepoenteMentoria" src="'.$fotoHumanograma.'">
                                            <div class="dadosDepoenteMentoria">
                                                <div class="nomeDepoimentoMentoria">'.$consultaDepoimentosMentoria['mensagem'][$i]['nome'].'</div>
                                                <div class="cargoDepoimentoMentoria">'.$consultaDepoimentosMentoria['mensagem'][$i]['cargo'].'</div>
                                                <div class="dependenciaDepoimentoMentoria">'.$consultaDepoimentosMentoria['mensagem'][$i]['dependencia'].'</div>
                                            </div>
                                        </div>
                                                    
                                        <div class="quadroDepoimentoMentoria">
                                        <div class="inicioCitacaoDepoimentoMentoria">“</div>
                                            <div class="textoDepoimentoMentoria">
                                                '.$consultaDepoimentosMentoria['mensagem'][$i]['depoimento'].'
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                        $cssBotoesTratado = rtrim($cssBotoes, ',').'{display: block;}';
                        // Variável com o conteúdo completo dos depoimentos (botões de navegação, fotos, dados e depoimento em si)
                        $depoimentosCompleto = '<div class="carousel">'.$inputDepoimentos.'<div class="slides">'.$depoimentos.'</div><div class="navigation">'.$labelNavegacaoDepoimentos.'</div></div></div>';
                        echo $depoimentosCompleto;
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="professoresMentoria">
        <div class="tituloProfessoresMentoria">
            Nossos professores
        </div>

        <div class="quadrosBioMentoria">
            <?php
                $bioProfessores = '';
                $totalBioProfessores = sizeof($consultaProfessoresMentoria['mensagem']);

                if($consultaProfessoresMentoria['status'] == 0){
                    $bioProfessores = $consultaProfessoresMentoria['mensagem'];
                } else {
                    // Laço que monta o conteúdo das biografias
                    for($i = 0; $i < sizeof($consultaProfessoresMentoria['mensagem']); $i++){
                        $indiceArrayMaisUm = $i+1;
                        $bioProfessores = $bioProfessores.'
                            <div id="modalBioMentoria" class="modalBiografiaMentoria '.$consultaProfessoresMentoria['mensagem'][$i]['matricula'].'">
                                <div class="modal-bio-professores">
                                    <span class="close" attr-matriculaClose="'.$consultaProfessoresMentoria['mensagem'][$i]['matricula'].'" >&times;</span>
                                    <div class="fotoTextoBiografiaMentoria">
                                        <img class="imgQuadroBioMentoria" src="https://humanograma.intranet.bb.com.br/avatar/'.$consultaProfessoresMentoria['mensagem'][$i]['matricula'].'" style="align-self: flex-start;" />
                                        <div class="textoBioProfessorMentoria">
                                            <div class="nomeProfessorMentoria">'.$consultaProfessoresMentoria['mensagem'][$i]['nome'].'</div>
                                            <div class="biografiaProfessorMentoria">'.$consultaProfessoresMentoria['mensagem'][$i]['bio'].'</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }
                echo $bioProfessores;
            ?>
        </div>

        <div class="imagensProfessoresMentoria carrossel">
            <div class="carrossel-track">
                <?php 
                    $professores = '';
                    $totalProfessores = sizeof($consultaProfessoresMentoria['mensagem']);

                    if($consultaProfessoresMentoria['status'] == 0){
                        $professores = $consultaProfessoresMentoria['mensagem'];
                    } else {
                        // Laço que monta o conteúdo dos professores
                        for($i = 0; $i < sizeof($consultaProfessoresMentoria['mensagem']); $i++){
                            $indiceArrayMaisUm = $i+1;
                            $professores = $professores.'
                                <div class="abrirModalBioMentoria carrossel-item Clicar" attr-matricula="'.$consultaProfessoresMentoria['mensagem'][$i]['matricula'].'">
                                    <img class="imgProfessorMentoria" style="width: 100%; height: 100%; border-radius: 999px;" src="https://humanograma.intranet.bb.com.br/avatar/'.$consultaProfessoresMentoria['mensagem'][$i]['matricula'].'" alt="'.$consultaProfessoresMentoria['mensagem'][$i]['saudacao'].' '.$consultaProfessoresMentoria['mensagem'][$i]['nome'].'">
                                </div>
                            ';
                        }
                    }
                    echo $professores.$professores;
                ?>
            </div>
        </div>
    </div>

    <div class="transicaoProfessoresRodapeMentoria"></div>
    

    <div class="fimPagina">
        <img class="imgRoboRodape" src="/lib/img/apps/mentoria/roboRodape.png">
        <div class="textosRodapeMentoria">
            <div class="texto01Rodape" style="font-size: 96px; font-weight: 700;">
                Nossa equipe está pronta pra te ajudar
            </div>
            <div class="texto02Rodape" style="font-size: 36px; font-weight: 300;">
                Com pessoas especialistas altamente qualificadas podemos te ajudar a trilhar entre os melhores caminhos para seus projetos de chatbot e voicebot
            </div>
            <a class="botaoSolicitarImersao" href="https://cad.bb.com.br/formulario_imersao" target="_blank">
                <div class="">
                    <div class="textoSolicitarImersao">
                        Solicitar Imersão
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<style>
    <?php echo $cssBotoesTratado ?>
</style>

<?php
    // include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php";
?>
