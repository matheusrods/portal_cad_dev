<?php

if(!isset($_SESSION)){
    session_start();
}

// ini_set("display_errors", E_ALL);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/ux/class/class_ux.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();

$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'UX', $_SESSION['ip']);

$class = new funcoes();

$filtroAssuntosVideosUx = $class->consultaAssuntosUx();
$consultaVideosUx = $class->consultaVideosUx();

echo '<!-- CSS específico do app --><link href="/lib/apps/ux/css/ux.css" rel="stylesheet">';
echo '<!-- JS específico do app --><script type="text/javascript" src="/lib/apps/ux/js/ux.js"></script>';


echo preg_replace('/\>\s+\</m', '><', '
<div class="capaUx" style="width: 100%;">
    <div class="divCapaUx">
        <div style="align-self: stretch; padding-top: 64px; padding-bottom: 64px; background: #5379FF; justify-content: center; align-items: center; gap: 16px; display: inline-flex">
            <div style="flex-direction: column; justify-content: center; align-items: flex-start; gap: 16px; display: inline-flex">
                <div class="tituloCapaUx">Teste Video Guia para se tornar especialista em UX</div>
                <div class="subtituloCapaUx" style="width: 38rem; height: 192.89px">
                    <span style="color: white; font-size: 32px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">
                        Agora vou te mostrar um pouco de 
                    </span>
                    <span style="color: white; font-size: 32px; font-family: BancoDoBrasil Textos; font-weight: 700; word-wrap: break-word">
                        como a nossa dependência funciona
                    </span>
                    <span style="color: white; font-size: 32px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">
                         e tudo o que você precisa saber nesse primeiro contato!
                    </span>
                </div>
            </div>
            <img class="imgBotCapaUx" src="https://cad.bb.com.br/lib/img/apps/ux/botCapa.png" />
        </div>
    </div>
    <div style="width: 100%; height: 394px; position: relative">
        <img style="width: 100%; height: 394px; left: 0px; top: -1px; position: absolute; margin-top: -1px;" src="https://cad.bb.com.br/lib/img/apps/ux/baseCapaUx.png">
    </div>
</div>
<div class="conteudoUx" style="width: 100%; margin-top: -5px;">
    <div class="conteudoTrilhasUx" style="width: 100%; background: #EA3E92;">
        <div class="textoTrilhasUx" style="width: 100%; margin-top: -2px; justify-content: center; display: flex;">
            <div style="width: 50%">
                <p style="color: #F5F5F5; font-size: 48px; font-family: BancoDoBrasil Textos; font-weight: 800; word-wrap: break-word">Conheça a base para você começar na área de experiência do usuário.<br/></span><span style="color: #F5F5F5; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word"><br/>
                    Não existe aplicativo ou site sem usuário. Uma ideia só vira um produto quando é usada por alguém de verdade. <br/><br/>
                    E um produto só é um sucesso quando a pessoa tem uma experiência voltada exclusivamente para ela.<br/><br/>
                    Você vai aprender a aplicar essas técnicas na prática, por meio de exercícios e projetos que simulam situações reais de trabalho. Com isso, você estará preparado para começar a construir produtos digitais que realmente atendam às necessidades e expectativas dos usuários, criando soluções eficientes e eficazes.
                </p>
            </div>
        </div>
        <div class="trilhasUx" style="width: 100%; margin-top: 32px;">
            <div style="width: 100%; align-items: flex-start; gap: 8px; display: inline-flex; justify-content: center; flex-wrap: wrap;">
                <div class="itemTrilhaUx">
                    <div style="width: 80px; height: 80px; position: relative">
                        <img src="https://cad.bb.com.br/lib/img/apps/ux/iconeTrilhaUxAluraUx.png" />
                    </div>
                    <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: inline-flex">
                        <a href="https://unibb.alura.com.br/formacao-ux" target="_blank">
                            <div style="align-self: stretch; color: #1653FD; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">Trilha UX Alura</div>
                        </a>
                        <div style="width: 163px; color: #6C7077; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: 18px; letter-spacing: 0.08px; word-wrap: break-word">Conheça a base para você começar na área de experiência do usuário.</div>
                    </div>
                </div>
                <div class="itemTrilhaUx">
                    <div style="width: 80px; height: 80px; position: relative">
                        <img src="https://cad.bb.com.br/lib/img/apps/ux/iconeEntendaExperienciaUsuarioUx.png" />
                    </div>
                    <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: inline-flex">
                        <a href="https://unibb.alura.com.br/course/fundamentos-ux-entendendo-experiencia-usuario" target="_blank">
                            <div style="align-self: stretch; color: #1653FD; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">UX: entenda a experiência de usuário</div>
                        </a>
                        <div style="width: 370px; color: #6C7077; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: 18px; letter-spacing: 0.08px; word-wrap: break-word">Aborda a importância de compreender a experiência do usuário ao  interagir com produtos e serviços, destacando a necessidade de uma  abordagem multidisciplinar.</div>
                    </div>
                </div>
                <div class="itemTrilhaUx">
                    <div style="width: 80px; height: 80px; position: relative">
                        <img src="https://cad.bb.com.br/lib/img/apps/ux/iconeEscrevendoTextosUsuariosUx.png" />
                    </div>
                    <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: inline-flex">
                        <a href="https://unibb.alura.com.br/course/ux-writing-escrevendo-textos-usuarios" target="_blank">
                            <div style="align-self: stretch; color: #1653FD; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">UX Writing: escrevendo textos para usuários</div>
                        </a>
                        <div style="width: 425px; color: #6C7077; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: 18px; letter-spacing: 0.08px; word-wrap: break-word">Ensina técnicas avançadas de escrita para User Experience, abordando temas como tom de voz, teste A/B, grupo focal, entrevista em profundidade, boas práticas de escrita, enquetes online e teste de Cloze.</div>
                    </div>
                </div>
                <div class="itemTrilhaUx">
                    <div style="width: 80px; height: 80px; position: relative">
                        <img src="https://cad.bb.com.br/lib/img/apps/ux/iconeBenchmarkingEstrategicoUx.png" />
                    </div>
                    <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: inline-flex">
                        <a href="https://unibb.alura.com.br/course/ux-research-benchmarking-estrategico" target="_blank">
                            <div style="align-self: stretch; color: #1653FD; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">Construindo o Benchmarking estratégico</div>
                        </a>
                        <div style="width: 300px; color: #6C7077; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: 18px; letter-spacing: 0.08px; word-wrap: break-word">Ensina como utilizar o benchmarking de forma estratégica para obter informações sobre o mercado e os concorrentes utilizando um template para essa técnica.</div>
                    </div>
                </div>
                <div class="itemTrilhaUx">
                    <div style="width: 80px; height: 80px; position: relative">
                        <img src="https://cad.bb.com.br/lib/img/apps/ux/iconeAnaliseConcorrentesUx.png" />
                    </div>
                    <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: inline-flex">
                        <a href="https://unibb.alura.com.br/course/ux-research-analise-concorrentes" target="_blank">
                            <div style="align-self: stretch; color: #1653FD; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">UX Research: análise de concorrentes</div>
                        </a>
                        <div style="width: 300px; color: #6C7077; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: 18px; letter-spacing: 0.08px; word-wrap: break-word">Aborda a importância de compreender a experiência do usuário ao interagir com produtos e serviços, destacando a necessidade de uma abordagem multidisciplinar.</div>
                    </div>
                </div>
                <div class="itemTrilhaUx" style="padding-left: 32px; padding-right: 32px; padding-top: 16px; padding-bottom: 16px; background: #F2F4F8; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 48px; justify-content: flex-start; align-items: center; gap: 32px; display: flex">
                    <div style="width: 80px; height: 80px; position: relative">
                        <img src="https://cad.bb.com.br/lib/img/apps/ux/iconeProjetandoChatbotUx.png" />
                    </div>
                    <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: inline-flex">
                        <a href="https://unibb.alura.com.br/course/ux-writing-projetando-chatbot" target="_blank">    
                            <div style="align-self: stretch; color: #1653FD; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">UX Writing: projetando um chatbot</div>
                        </a>
                        <div style="width: 272px; color: #6C7077; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: 18px; letter-spacing: 0.08px; word-wrap: break-word">Com foco na experiência do usuário, o curso explora desde a concepção do chatbot até a prototipação e teste de usabilidade.</div>
                    </div>
                </div>
                <div class="itemTrilhaUx">
                    <div style="width: 80px; height: 80px; position: relative">
                        <img src="https://cad.bb.com.br/lib/img/apps/ux/iconeRedacaoExperienciasDigitaisUx.png" />
                    </div>
                    <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: inline-flex">
                        <a href="https://unibb.alura.com.br/course/ux-writing-redacao-experiencias-digitais" target="_blank">    
                            <div style="align-self: stretch; color: #1653FD; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">UX Writing: redação para experiências digitais</div>
                        </a>
                        <div style="width: 326px; color: #6C7077; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: 18px; letter-spacing: 0.08px; word-wrap: break-word">Com foco na experiência do usuário, o curso explora desde a concepção do chatbot até a prototipação e teste de usabilidade.</div>
                    </div>
                </div>
                <div class="itemTrilhaUx">
                    <div style="width: 80px; height: 80px; position: relative">
                        <img src="https://cad.bb.com.br/lib/img/apps/ux/iconeInteligenciaArtificialUx.png" />
                    </div>
                    <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: inline-flex">
                        <a href="https://unibb.alura.com.br/course/Inteligencia-artificial-ux-construcao-produto-digital" target="_blank">        
                            <div style="align-self: stretch; color: #1653FD; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">Inteligência Artificial e UX</div>
                        </a>
                        <div style="width: 214px; color: #6C7077; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: 18px; letter-spacing: 0.08px; word-wrap: break-word">O curso ensina como utilizar a IA para melhorar o processo de  construção de produtos digitais.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="imagemFechaDivTrilhasUx" style="width: 100%; height: 25rem; position: relative">
            <img style="width: 100%; height: 25rem; left: 0px; top: 0px; position: absolute; margin-top: -1px;" src="https://cad.bb.com.br/lib/img/apps/ux/baseDivTrilhasUx.png" />
        </div>
    </div>

    <div class="conteudoFigmaUx">
        <div class="apresentacaoUx">
            <div style="padding-left: 128px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: inline-flex">
                <div style="width: 464px; justify-content: flex-start; align-items: center; gap: 16px; display: inline-flex">
                    <img style="width: 63.91px; height: 96px" src="https://cad.bb.com.br/lib/img/apps/ux/logoFigmaUx.png" />
                    <div style="text-align: center; color: #49494F; font-size: 48px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Figma</div>
                </div>
                <div style="align-self: stretch; color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">Se torne especialista na maior e mais famosa ferramenta de prototipagem do mundo!<br/><br/>Navegue por nossa seleção de cursos e recursos para conhecer e dominar o Figma, uma das ferramentas de design mais inovadoras e colaborativas disponíveis, além de ser fundamental no trabalho dos nossos especialistas em UX e parceiros.<br><br>Essa plataforma é a mais utilizada no mundo, por empresas, designers e desenvolvedores, e que vem revolucionando a forma como times de produtos trabalham juntos.</div>
            </div>
            <div class="divYoutubeFigmaUx">
                <a href="https://www.youtube.com/watch?v=Cx2dkpBxst8" target="_blank">
                    <img style="align-self: stretch; border-radius: 15px" src="https://cad.bb.com.br/lib/img/apps/ux/youtubeFigmaUx.png" />
                </a>
            </div>
        </div>
        <!-- <div class="textoUx">
            Essa plataforma é a mais utilizada no mundo, por empresas, designers e desenvolvedores, e que vem revolucionando a forma como times de produtos trabalham juntos.
        </div> -->
        <div class="acessosUx">
            <div class="divAcessoRepositorioUx">
                <a class="linksAcessosUx" href="https://www.figma.com/files/895713074855529774/team/1070010266891383332" target="_blank">
                    <div style="display: inline-flex; gap: 16px;">
                        <div class="divIconeSolicitarAcessoUx">
                            <img style="width: 87px; height: 87px;" src="https://cad.bb.com.br/lib/img/apps/ux/iconeRepositorioJornadasUx.png" />
                        </div>
                        <div class="divFraseAcessarRepositorioUx">
                            Acessar o repositório de jornadas do CAD
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="divAcessoEditorFigmaUx">
                <a class="linksAcessosUx" href="https://ux.bb.com.br/figma/access" target="_blank">
                    <div style="display: inline-flex; gap: 16px;">
                        <div class="divIconeSolicitarAcessoUx">
                            <img style="width: 87px; height: 87px;" src="https://cad.bb.com.br/lib/img/apps/ux/iconeSolicitarAcessoFigmaUx.png" />
                        </div>
                        <div class="divFraseSolicitarAcessoFigmaUx">
                            Solicitar acesso de editor no Figma
                        </div>
                    </div>
                </a>
            </div>
            
        </div>
        <div class="conteudoCursosUx">
            <div style="text-align: center; color: #49494F; font-size: 48px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Cursos</div>
                <div style="width: 100%; height: 200px; position: relative;">
                    <a href="https://www.unibb.com.br/home/mais-conteudo/5173/figma-conhecendo-a-ferramenta" target="_blank">
                        <div style="width: 33%; height: 200px; background: #FEFEFE; align-items: center; gap: 24px; display: inline-flex;">
                            <img style="width: 96px; height: 96px" src="https://cad.bb.com.br/lib/img/apps/ux/cursoFigmaAzulUx.png" />
                            <div style="flex-direction: column; gap: 4px; display: inline-flex;">
                                <div class="tituloCursosFigmaUx">Figma: conhecendo a ferramenta</div>
                                <div class="subtituloCursosFigmaUx">Conheça a ferramenta Figma e suas funcionalidades para criação de projetos digitais e aprenda a iniciar o design de novos produtos. Etenda quais são as ferramentas fundamentais e aprenda a utilizá-las.</div>
                            </div>
                        </div>
                    </a>
                    <a href="https://www.unibb.com.br/home/mais-conteudo/5215/figma-componentes-auto-layout-e-mascaras" target="_blank">
                        <div style="width: 33%; height: 200px; background: #F2F4F8; align-items: center; gap: 24px; display: inline-flex;">
                            <img style="width: 96px; height: 96px" src="https://cad.bb.com.br/lib/img/apps/ux/cursoFigmaRosaUx.png" />
                            <div style="flex-direction: column; gap: 4px; display: inline-flex;">
                                <div class="tituloCursosFigmaUx">Figma: componentes, auto layout e máscaras</div>
                                <div class="subtituloCursosFigmaUx">Aprimore seus conhecimentos, focando na construção do projeto Fast Task, um checklist de lista de tarefas. Serão abordados recursos avançados, como Auto Layout e componentes, essenciais no Figma.</div>
                            </div>
                        </div>
                    </a>
                    <a href="https://www.unibb.com.br/home/mais-conteudo/5278/figma-prototipagem-interativa-e-animacoes" target="_blank">
                        <div style="width: 33%; height: 200px; background: #FEFEFE; align-items: center; gap: 24px; display: inline-flex;">
                            <img style="width: 96px; height: 96px" src="https://cad.bb.com.br/lib/img/apps/ux/cursoFigmaVermelhoUx.png" />
                            <div style="flex-direction: column; gap: 4px; display: inline-flex;">
                                <div class="tituloCursosFigmaUx">Figma: prototipagem interativa e animações</div>
                                <div class="subtituloCursosFigmaUx">Aprenda a prototipar qualquer coisa dentro do Figma, além de utilizar funções de interação, gestos e criar animações incríveis em produtos ainda não codificados.</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div style="width: 100%; height: auto; position: relative">
                    <img style="width: 100%; top: 64px; position: relative;" src="https://cad.bb.com.br/lib/img/apps/ux/baseCursosUx.png">
                </div>
            </div>
    </div>
    
    <div class="designSystemUx">
        <div class="divTextoApresentacaoDesignSystemUx">
            <div style="padding-left: 128px;flex-direction: column; gap: 32px;display: inline-flex;">
                <div style="width: 464px; justify-content: flex-start; align-items: center; gap: 16px; display: inline-flex">
                    <div style="width: 51.10px; height: 50px; position: relative">
                        <div style="width: 46.80px; height: 46.78px; left: 2px; top: 0.92px; position: absolute">
                            <img style="width: 50px; height: 50px" src="https://cad.bb.com.br/lib/img/apps/ux/iconeDesignSystemUx.png" />
                        </div>
                    </div>
                    <div style="text-align: center; color: #49494F; font-size: 48px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Design System</div>
                </div>
                <div style="align-self: stretch">
                    <p style="color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                        Um Design System é uma coleção de padrões reutilizáveis e princípios guiados que <b>ajudam equipes a criar experiências consistentes</b> e de alta qualidade.
                        <br><br> Ele serve como uma única fonte de verdade que todos os membros da equipe podem referenciar, garantindo que todos estejam alinhados e eficientes. <br>
                    </p>
                </div>
            </div>
            <div class="divVideoFazapFigmaUx" style="padding-right: 47px;">
                <a href="https://banco365-my.sharepoint.com/personal/jvdcamargo_bb_com_br/_layouts/15/stream.aspx?id=%2Fpersonal%2Fjvdcamargo%5Fbb%5Fcom%5Fbr%2FDocuments%2FGrava%C3%A7%C3%B5es%2FTreinamento%20Figma%20para%20o%20CAD%20%28online%29%20%2D%20Jo%C3%A3o%2D20240610%5F130356%2DGrava%C3%A7%C3%A3o%20de%20Reuni%C3%A3o%2Emp4&nav=eyJyZWZlcnJhbEluZm8iOnsicmVmZXJyYWxBcHAiOiJTdHJlYW1XZWJBcHAiLCJyZWZlcnJhbFZpZXciOiJTaGFyZURpYWxvZy1MaW5rIiwicmVmZXJyYWxBcHBQbGF0Zm9ybSI6IldlYiIsInJlZmVycmFsTW9kZSI6InZpZXcifX0&ga=1&referrer=StreamWebApp%2EWeb&referrerScenario=AddressBarCopied%2Eview%2Ee63c2e44%2Ddc86%2D4019%2D9e5c%2D95461712ab05" target="_blank">
                    <div style="width: 657px; height: 313px; position: relative">
                        <img style="width: 657px; height: 313px; left: 0px; top: 0px; position: absolute; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 47px" src="https://cad.bb.com.br/lib/img/apps/ux/fazapFigma2024.png" />
                        <div style="width: 96px; height: 96px; left: 281px; top: 108.36px; position: absolute; background: rgba(217, 217, 217, 0.70); box-shadow: 0px 0px 17px 11px rgba(255, 255, 255, 0.50); border-radius: 9999px; border: 7px white solid"></div>
                    </div>
                </a>
            </div>
        </div>
        <div style="align-self: stretch; padding-left: 128px; padding-right: 128px; justify-content: flex-start; align-items: flex-start; display: inline-flex; margin-top: 16px;">
            <div style="flex: 1 1 0">
                <p style="color: #49494F; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word">
                    Ao padronizar elementos visuais e interativos, um sistema de design <b>simplifica o processo de desenvolvimento</b> permitindo que as equipes se concentrem em criar jornadas do usuário mais envolventes e intuitivas.
                    <br><br>
                    É uma ferramenta essencial para escalar produtos e serviços sem sacrificar a qualidade ou a coesão da marca.
                    <br><br>
                    E para ajudar no dia a dia, <b>criamos o nosso design system</b> 
                    <br><br> 
                    <b>Confira como utilizá-lo</b> 👇

                </p>
            </div>
        </div>

        <div class="carousel" style="width: 100%; position: relative" /*id="container"*/>
            <input type="radio" class = "botao_Carousel" name="carousel" id="slide1" checked>
            <input type="radio" class = "botao_Carousel" name="carousel" id="slide2">
            <input type="radio" class = "botao_Carousel" name="carousel" id="slide3">
            <input type="radio" class = "botao_Carousel" name="carousel" id="slide4">
            <input type="radio" class = "botao_Carousel" name="carousel" id="slide5">
            <div class="slides">
                <div class="slide">
                    <img src="https://cad.bb.com.br/lib/img/apps/ux/designSystemPasso01.png" alt="Slide 1">
                </div>
                <div class="slide">
                    <img src="https://cad.bb.com.br/lib/img/apps/ux/designSystemPasso02.png" alt="Slide 2">
                </div>
                <div class="slide">
                    <img src="https://cad.bb.com.br/lib/img/apps/ux/designSystemPasso03.png" alt="Slide 3">
                </div>
                <div class="slide">
                    <img src="https://cad.bb.com.br/lib/img/apps/ux/designSystemPasso04.png" alt="Slide 4">
                </div>
                <div class="slide">
                    <img src="https://cad.bb.com.br/lib/img/apps/ux/designSystemPasso05.png" alt="Slide 5">
                </div>
            </div>
            <div class="navigation">
                <label for="slide1"></label>
                <label for="slide2"></label>
                <label for="slide3"></label>
                <label for="slide4"></label>
                <label for="slide5"></label>
            </div>
        </div>
    </div>  
       
            
  
 <div style="width: 100%; position: relative">
            <img style="width: 100%;" src="https://cad.bb.com.br/lib/img/apps/ux/topoRecursosLegaisUx.png" />
        </div>
    </div>
    <div class="recursosLegaisUx">
        
        <div class="tituloRecursosLegaisUx">Recursos legais sobre UX 💙💛</div>
        <div class="divCardsRecursosLegaisUx">
            <div class="cardRecursoLegalUx amareloUx">
                <div class="tituloSubtitulocardRecursosLegaisUx">
                    <div class="tituloCardRecursosLegaisUx tituloPretoUx">Portal UX BB</div>
                    <div class="subtituloCardRecursosLegaisUx tituloCinzaUx" style="font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: 25.60px; word-wrap: break-word">Descubra o mundo UX no BB! Tenha acesso a conteúdos de capacitação, recursos, ferramentas e funcionalidades. Transforme suas ideias em experiências incríveis!</div>
                </div>
                <div style="margin-bottom: -1rem;">
                    <a href="https://ux.bb.com.br/" target="_blank">
                        <div style="padding: 9px 16px; background: #005F96; border-radius: 4px; gap: 10px; display: inline-flex;">
                            <div style="text-align: center; color: #FCFDFE; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">Acessar</div>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="cardRecursoLegalUx azulUx">
                <div class="tituloSubtitulocardRecursosLegaisUx tituloBrancoUx">
                    <div class="tituloCardRecursosLegaisUx">Comunidade UX no Teams</div>
                    <div class="subtituloCardRecursosLegaisUx">Conecte-se e interaja com entusiastas e profissionais de UX do BB na nossa comunidade! Troque ideias, aprenda e cresça. Junte-se a nós!</div>
                </div>
                <div style="margin-bottom: -1rem;">
                    <a href="https://teams.microsoft.com/l/team/19%3a43dd949e209344f597ae1ec2b520d901%40thread.tacv2/conversations?groupId=418df2ed-f06f-4c5f-a83a-fab7b94bb729&amp;tenantId=ea0c2907-38d2-4181-8750-b0b190b60443" target="_blank">
                        <div style="padding: 9px 16px; background: #FDF429; border-radius: 4px; gap: 10px; display: inline-flex;">
                            <div style="text-align: center; color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">Acessar</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="videosUx">
        
        <div class="tituloDivVideosUx">
            Vídeos
        </div>
        
        <div class="divBarraPesquisaVideosUx">
            <div class="barraPesquisaVideosUx">
                <div style="position: relative">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
                <div style="flex: 1 1 0; height: 20px; justify-content: flex-start; align-items: center; display: flex">
                    <input class="inputCampoPesquisaVideosUx" placeholder="Digite aqui para pesquisar">
                </div>
            </div>
            <div class="botoesPesquisaLimpaVideosUx">
                <div class="botaoPesquisarVideosUx Clicar">
                    <div class="textoBotoesCampoPesquisaVideosUx">PESQUISAR</div>
                </div>
                <div class="botaoLimparVideosUx Clicar">
                    <div class="textoBotoesCampoPesquisaVideosUx">LIMPAR</div>
                </div>
            </div>
        </div>
        
        <div class="filtrosAssuntosVideosUx" attr-idFiltrosAtivos="" style="justify-content: flex-start; align-items: flex-start; gap: 8px; display: inline-flex">
            '.$filtroAssuntosVideosUx['mensagem'].'
        </div>
        
        <div class="containerVideosUx">
            '.$consultaVideosUx['mensagem'].'
        </div>
        
        <div class="botaoVerMaisVideosUx Clicar" attr-sequencia="1" style="padding-left: 32px; padding-right: 32px; padding-top: 15px; padding-bottom: 15px; background: #FDF429; border-radius: 4px; justify-content: center; align-items: center; gap: 10px; display: inline-flex;">
            <div style="text-align: center; color: #3354FD; font-size: 16px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 18px; letter-spacing: 0.08px; word-wrap: break-word">Ver mais</div>
        </div>
    </div>
</div>');

include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php";
?>