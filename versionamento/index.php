<?php

session_start();

if($_SESSION["nome"] == ""){
    header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=https://cad.bb.com.br/ferramentas/versionamento/#login/");
}

include_once $_SERVER["DOCUMENT_ROOT"]."/lib/login/login.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Teste Versionamento', $_SESSION['ip']);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Versionamento</title>
    <link href="../../lib/img/img_bot/bot.ico" mce_href="../../lib/img/img_bot/bot.ico" rel="icon">
    <link href="../../lib/img/img_bot/bot.ico" mce_href="../../lib/img/img_bot/bot.ico" rel="shortcut icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- CSS da página -->
    <link href="index.css" rel="stylesheet">
    
    <!-- JS da página -->
    <script type="text/javascript" src="index.js"></script>
</head>
<body onload="addEventListeners()">
    <h1>
        <img src="/lib/img/cabecalho/imgCabecalho.svg" style="height: auto; width: 7rem; display: block; margin: 0 auto; padding-bottom: 0.5rem;" alt="Ícone do portal do CAD">
        <span>Versionamento</span>
        <div class="tab-buttons" id="cabecalho">
            <div class="tab-button active" data-tab="gerarVersaoProgramada">Gerar Versão Programada</div>
            <div class="tab-button" data-tab="testeParenteses">Teste de Parênteses</div>
            <div class="tab-button" data-tab="testeVersionamento">Teste de Versionamento</div>
        </div>
    </h1>
    <div id="mensagem-temporaria" style="display: none; background-color: #28a745; color: white; padding: 10px; border-radius: 5px; position: fixed; top: 20px; right: 20px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
        Teste finalizado com sucesso!
    </div>
    <div id="gerarVersaoProgramada" class="tab active">
        <div id="passo1" class="passoAPassoSessao">
            <div class="resumoPasso">
                <input type="image" src="imagens/seta_baixo.png" name="botaoDetalhar" class="botao-detalhar" onclick="detalharPasso(this)"></input>
                <p class="titulo">Passo 1 - Verificar necessidade de uma nova Versão</p>
                <a class="links" target="_blank" rel="noopener noreferrer" href="https://genti.intranet.bb.com.br/ccm/web/projects/GECAP%208%20(Change%20Management)#action=com.ibm.team.workitem.viewQueries&tab=owned&queryItemId=__5-k0L1fEe-1nq9wCZvjSQ&queryAction=com.ibm.team.workitem.runSavedQuery&refresh=true">Genti</a>
                <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="expansion-content">
                <p class="texto">Acessar o GENTI <a class="links" target="_blank" rel="noopener noreferrer" href="https://genti.intranet.bb.com.br/ccm/web/projects/GECAP%208%20(Change%20Management)#action=com.ibm.team.dashboard.viewDashboard&team=1369-UAC%20Assistentes%20Virtuais&tab=_17">Governança & Documentação</a></p>
                <p class="texto">Verificar as regras da Janela “Controle de Geração de Versões”</p>
                <div class="thumbnail-image">
                    <img src="imagens/controle_de_geracao.png" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                    <div class="modal" onclick="closeModal(this)">
                        <img class="modal-content" id="img01" src="imagens/controle_de_geracao.png">
                    </div>
                </div>
                <p class="texto">Verificar se tem tarefas de #dev prontas desde o último versionamento no <a class="links" target="_blank" rel="noopener noreferrer" href="https://genti.intranet.bb.com.br/ccm/web/projects/GECAP%208%20(Change%20Management)#action=com.ibm.team.workitem.viewQueries&tab=owned&queryItemId=__5-k0L1fEe-1nq9wCZvjSQ&queryAction=com.ibm.team.workitem.runSavedQuery&refresh=true">Genti</a></p>
                <div class="thumbnail-image">
                    <img src="imagens/tabela_tarefas_verificar.png" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                    <div class="modal" onclick="closeModal(this)">
                        <img class="modal-content" id="img01" src="imagens/tabela_tarefas_verificar.png">
                    </div>
                </div>
                <p class="texto">Baixar a lista de Tarefas concluídas (usada depois na tabela de gerenciamento de versões)</p>
                <div class="thumbnail-image">
                    <img src="imagens/tabela_tarefas_baixar.png" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                    <div class="modal" onclick="closeModal(this)">
                        <img class="modal-content" id="img01" src="imagens/tabela_tarefas_baixar.png">
                    </div>
                </div>
                <p class="texto">
                    Caso não tenha nenhuma tarefa de #dev pronta, encerrar o processo por aqui, não é necessário subir uma nova versão. Comunicar a equipe no
                    <a class="links" target="_blank" rel="noopener noreferrer" href="https://teams.microsoft.com/l/chat/19:73bc0f95e03d459eb47ac7939d36737e@thread.v2/conversations">Grupo do CAD</a>
                    do Teams
                </p>
            </div>
        </div>
        <div id="passo2" class="passoAPassoSessao">
            <div class="resumoPasso">
                <input type="image" src="imagens/seta_baixo.png" name="botaoDetalhar" class="botao-detalhar" onclick="detalharPasso(this)"></input>
                <p class="titulo">Passo 2 - Gerar Versão e promovê-la até "EM VALIDAÇÃO"</p>
                <a class="links" target="_blank" rel="noopener noreferrer" href="https://nia.bb.com.br/nia-cognitivo-estatico/manager/gerenciarVersao/314/59">WSA - Clientes - Gerenciar Versão</a>
                <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="expansion-content">
                <p class="texto">
                    Acessar o <a class="links" target="_blank" rel="noopener noreferrer" href="https://nia.bb.com.br/nia-cognitivo-estatico/manager/servicos">NIA</a>
                    e clicar no menu "Conversation - CAD - Escola de Robôs (10)"
                </p>
                <div class="thumbnail-image">
                    <img src="imagens/nia_servicos.png" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                    <div class="modal" onclick="closeModal(this)">
                        <img class="modal-content" id="img01" src="imagens/nia_servicos.png">
                    </div>
                </div>
                <p class="texto">Clicar no submenu com 3 traços do corpus "WSA - Clientes" e clicar na opção "Gerenciar Publicação"</p>
                <div class="thumbnail-image">
                    <img src="imagens/nia_servicos_corpus.png" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                    <div class="modal" onclick="closeModal(this)">
                        <img class="modal-content" id="img01" src="imagens/nia_servicos_corpus.png">
                    </div>
                </div>
                <p class="texto">Entrar na aba "Versões", clicar no botão versão e preencher o campo de texto com "Carga programada das 11h - Consultar planilha de controle de cargas", clicar em "Gerar Versão" e aguardar a geração da nova versão</p>
                <div class="thumbnail-image">
                    <img src="imagens/versoes.png" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                    <div class="modal" onclick="closeModal(this)">
                        <img class="modal-content" id="img01" src="imagens/versoes.png">
                    </div>
                </div>
                <div class="thumbnail-image">
                    <img src="imagens/gerar_versao.png" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                    <div class="modal" onclick="closeModal(this)">
                        <img class="modal-content" id="img01" src="imagens/gerar_versao.png">
                    </div>
                </div>
                <p class="texto">Na coluna com o ícone <img src="imagens/ferramenta.png" style="width:15px;height:15px;"></img> clicar no ícone <img src="imagens/exportar.png" style="width:15px;height:15px;"></img> para baixar o json da versão que será usado nos testes automatizados</p>
                <div class="thumbnail-image">
                    <img src="imagens/baixar_json.png" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                    <div class="modal" onclick="closeModal(this)">
                        <img class="modal-content" id="img01" src="imagens/baixar_json.png">
                    </div>
                </div>
                <p class="texto">Na coluna "Serviços na Nuvem", clicar no ícone <img src="imagens/sincronizar.png" style="width:15px;height:15px;"></img> para sincronizar com o desenvolvimento e aguardar sincronização</p>
                <div class="thumbnail-image">
                    <img src="imagens/sincronizar_versao.png" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                    <div class="modal" onclick="closeModal(this)">
                        <img class="modal-content" id="img01" src="imagens/sincronizar_versao.png">
                    </div>
                </div>
                <p class="texto">Acessar a guia "Publicação" e verificar se a versão subiu corretamente, observando o número da versão e o horário de subida</p>
                <div class="thumbnail-image">
                    <img src="imagens/verificar_sincronizacao.png" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                    <div class="modal" onclick="closeModal(this)">
                        <img class="modal-content" id="img01" src="imagens/verificar_sincronizacao.png">
                    </div>
                </div>
                <p class="texto">Na sessão "RASCUNHO", clicar no ícone <img src="imagens/sincronizar.png" style="width:15px;height:15px;"></img> para promover a versão para "EM VALIDAÇÃO"</p>
                <div class="thumbnail-image">
                    <img src="imagens/promover_versao.png" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                    <div class="modal" onclick="closeModal(this)">
                        <img class="modal-content" id="img01" src="imagens/promover_versao.png">
                    </div>
                </div>
                <div class="thumbnail-image">
                    <img src="imagens/sincronizar_validacao.png" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                    <div class="modal" onclick="closeModal(this)">
                        <img class="modal-content" id="img01" src="imagens/sincronizar_validacao.png">
                    </div>
                </div>
                <div class="sessao-erro">
                    <p class="texto-erro">
                        Em caso de erro ao gerar, sincronizar ou promover a versão, abrir issue no
                        <a class="links" target="_blank" rel="noopener noreferrer" href="https://fontes.intranet.bb.com.br/nia/publico/nia-sustentacao-atendimento/-/issues">Portal Fontes</a>
                        usando como base o padrão abaixo, substituindo os "x" pela informação devida:
                    </p>
                    <div class="tabela">
                        <div class="tabela-linha">
                            <p class="tabela-celula">Title</p>
                            <p class="tabela-celula">xx/xx/xxxx - Nia Prod - Problema Promoção de versão em Produção ["Rascunho" para "Em Validação"] Versão xxxx</p>
                        </div>
                        <div class="tabela-linha">
                            <p class="tabela-celula">Type</p>
                            <p class="tabela-celula">Issue</p>
                        </div>
                        <div class="tabela-linha">
                            <p class="tabela-celula">Description</p>
                            <p class="tabela-celula">Choose a template</p>
                        </div>
                        <div class="tabela-linha">
                            <p class="tabela-celula"></p>
                            <p class="tabela-celula">[print da tela do NIA com erro] Versão xxxx do dia xx/xx/xxxx: Não foi possível sincronizar a versão "em rascunho" para "em validação". Impossibilidade de subir versões para prod desde o dia xx/xx/xxxx</p>
                        </div>
                    </div>
                    <div class="thumbnail-image">
                        <img src="imagens/abrir_issue.png" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/abrir_issue.png">
                        </div>
                    </div>
                    <div class="thumbnail-image">
                        <img src="imagens/preencher_issue.png" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/preencher_issue.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="passo3" class="passoAPassoSessao">
            <div class="resumoPasso">
                <input type="image" src="imagens/seta_baixo.png" name="botaoDetalhar" class="botao-detalhar" onclick="detalharPasso(this)"></input>
                <p class="titulo">Passo 3 - Realizar os testes automatizados nesta página</p>
                <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="expansion-content">
                <p class="texto">Acessar a guia "Teste de Parênteses" acima, clicar em "Escolher arquivo", selecionar o json baixado no passo 2 e clicar em "Analisar"</p>
                <div class="thumbnail-image">
                    <img src="imagens/teste_parenteses.png" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                    <div class="modal" onclick="closeModal(this)">
                        <img class="modal-content" id="img01" src="imagens/teste_parenteses.png">
                    </div>
                </div>
                <p class="texto">Printar a sessão "Resultado da análise" para registrar na planilha</p>
                <p class="texto">Acessar a guia "Teste de Versionamento" acima e clicar em "Avaliar Nova Candidata"</p>
                <div class="thumbnail-image">
                    <img src="imagens/teste_versionamento.png" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                    <div class="modal" onclick="closeModal(this)">
                        <img class="modal-content" id="img01" src="imagens/teste_versionamento.png">
                    </div>
                </div>
                <p class="texto">Printar a sessão "Resultado da análise" para registrar na planilha</p>
                <div class="sessao-erro">
                    <p class="texto-erro">Em caso de erro nos testes de automatizados:</p>
                    <p class="texto-erro">1 - Avisar os responsáveis pelas hashes apontadas</p>
                    <p class="texto-erro">2 - Analisar o motivo do erro e em caso de impacto para os clientes interromper o processo de subida de versão</p>
                </div>
            </div>
        </div>
        <div id="passo4" class="passoAPassoSessao">
            <div class="resumoPasso">
                <input type="image" src="imagens/seta_baixo.png" name="botaoDetalhar" class="botao-detalhar" onclick="detalharPasso(this)"></input>
                <p class="titulo">Passo 4 - Realizar os testes manuais no bot</p>
                <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="expansion-content">
                <p class="texto">No número de produção do bot no Whatsapp (61 4004-0001) alterar o corpus para Rascunho (#defineCorpus WSA_-_CLIENTES)</p>
                <div class="thumbnail-image">
                    <img src="imagens/define_corpus.jpg" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                    <div class="modal" onclick="closeModal(this)">
                        <img class="modal-content" id="img01" src="imagens/define_corpus.jpg">
                    </div>
                </div>
                <p class="texto">Resetar o fluxo com o comando "recomecar" e iniciar o teste com o input "Consultar limite cartão", seguir até o fim do fluxo</p>
                <div class="thumbnail-image">
                    <img src="imagens/consultar_limite.jpg" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                    <div class="modal" onclick="closeModal(this)">
                        <img class="modal-content" id="img01" src="imagens/consultar_limite.jpg">
                    </div>
                </div>
                <p class="texto">Sem usar o comando "recomecar", iniciar novo fluxo com o input "Empréstimo", seguir até o momento em que o bot manda o link para inserir a senha</p>
                <div class="thumbnail-image">
                    <img src="imagens/emprestimo.jpg" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                    <div class="modal" onclick="closeModal(this)">
                        <img class="modal-content" id="img01" src="imagens/emprestimo.jpg">
                    </div>
                </div>
                <p class="texto">No <a class="links" target="_blank" rel="noopener noreferrer" href="https://nia.bb.com.br/nia-cognitivo-estatico/manager/conversas/314/59">Histórico de Conversas</a> preencher o filtro "Serviço" com "WSA_-_CLIENTES" e o filtro "Matrícula" com seu número de telefone e pesquisar</p>
                <div class="thumbnail-image">
                    <img src="imagens/historico_conversas.png" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                    <div class="modal" onclick="closeModal(this)">
                        <img class="modal-content" id="img01" src="imagens/historico_conversas.png">
                    </div>
                </div>
                <p class="texto">Copiar o campo "ID Conversa" para preencher a planilha</p>
                <div class="sessao-erro">
                    <p class="texto-erro">Em caso de erro nos testes de manuais:</p>
                    <p class="texto-erro">1 - Avisar os responsáveis pelas hashes apontadas</p>
                    <p class="texto-erro">2 - Analisar o motivo do erro e em caso de impacto para os clientes interromper o processo de subida de versão</p>
                </div>
            </div>
        </div>
        <div id="passo5" class="passoAPassoSessao">
            <div class="resumoPasso">
                <input type="image" src="imagens/seta_baixo.png" name="botaoDetalhar" class="botao-detalhar" onclick="detalharPasso(this)"></input>
                <p class="titulo">Passo 5 - Preencher os dados na aba "PF" da planilha</p>
                <a class="links" target="_blank" rel="noopener noreferrer" href="https://banco365-my.sharepoint.com/:x:/g/personal/w_g_arruda_bb_com_br/EXpwvpO4eNRJv3zyN_p-vT8BPW05NkCcFmE9lXQG_Q13GA?e=Za8cVY">Controle de Cargas do Bot</a>
                <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="expansion-content">
                <p class="texto">
                    Na aba "PF" da planilha
                    <a class="links" target="_blank" rel="noopener noreferrer" href="https://banco365-my.sharepoint.com/:x:/g/personal/w_g_arruda_bb_com_br/EXpwvpO4eNRJv3zyN_p-vT8BPW05NkCcFmE9lXQG_Q13GA?e=Za8cVY">Controle de Cargas do Bot</a>
                    preencher a coluna "Versão" com o número da versão gerada e "Data da Carga" com a data do dia que está sendo gerada a versão e horário 11:00
                </p>
                <p class="texto">Preencher as demais colunas com as informações da tabela do Genti obtida no passo 1</p>
                <p class="texto">Preencher a coluna "Nº da Tarefa" com a coluna "ID" da tabela do Genti</p>
                <p class="texto">Preencher a coluna "Nome da Tarefa" com a coluna "Resumo" da tabela do Genti</p>
                <p class="texto">Preencher a coluna "Status" com a coluna "Status" da tabela do Genti</p>
                <p class="texto">Preencher a coluna "Data da Modificação" com a coluna "Data de Modificação" da tabela do Genti</p>
                <div class="thumbnail-image">
                    <img src="imagens/tabela_pf.png" alt="Thumbnail Image" class="thumbnail" onclick="openModal(this)">
                    <div class="modal" onclick="closeModal(this)">
                        <img class="modal-content" id="img01" src="imagens/tabela_pf.png">
                    </div>
                </div>
            </div>
        </div>
        <div id="passo6" class="passoAPassoSessao">
            <div class="resumoPasso">
                <input type="image" src="imagens/seta_baixo.png" name="botaoDetalhar" class="botao-detalhar" onclick="detalharPasso(this)"></input>
                <p class="titulo">Passo 6 - Preencher os dados na aba "Controle de Versões" da planilha</p>
                <a class="links" target="_blank" rel="noopener noreferrer" href="https://banco365-my.sharepoint.com/:x:/g/personal/w_g_arruda_bb_com_br/EXpwvpO4eNRJv3zyN_p-vT8BPW05NkCcFmE9lXQG_Q13GA?e=Za8cVY">Controle de Cargas do Bot</a>
                <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="expansion-content">
                <p class="texto">
                    Na aba "Controle de Versões" da planilha
                    <a class="links" target="_blank" rel="noopener noreferrer" href="https://banco365-my.sharepoint.com/:x:/g/personal/w_g_arruda_bb_com_br/EXpwvpO4eNRJv3zyN_p-vT8BPW05NkCcFmE9lXQG_Q13GA?e=Za8cVY">Controle de Cargas do Bot</a>
                    preencher a coluna “Versão” com o número da versão gerada, “Data da Versão” com a data do dia que está sendo gerada a versão e horário 11:00 e “Motivo” com "Programada"
                </p>
                <p class="texto">Preencher as demais colunas com as informações dos testes obtidos nos passos 3 e 4</p>
                <p class="texto">Preencher a coluna "Teste Parenteses" com o print do teste obtido no passo 3</p>
                <p class="texto">Preencher a coluna "Teste Automatizado" com o print do teste obtido no passo 3</p>
                <p class="texto">Preencher a coluna "Teste Jornadas em Rascunho (id conversa)" com o id da conversa obtido no passo 4</p>
                <p class="texto">Não é necessário preencher a coluna "Autorização"</p>
                <p class="texto">Preencher a coluna "Observação" somente quando tiver algo a justificar na subida, por exemplo quando algum dos testes apresentar erro que não impacta o cliente</p>
            </div>
        </div>
        <div id="passo7" class="passoAPassoSessao">
            <div class="resumoPasso">
                <input type="image" src="imagens/seta_baixo.png" name="botaoDetalhar" class="botao-detalhar" onclick="detalharPasso(this)"></input>
                <p class="titulo">Passo 7 - Subir para produção</p>
                <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="expansion-content">
                <p class="texto">A promoção da versão de "Em Validação" para "Publicado" deve ser feito por um gerente ou analista pleno, solicitar via Teams</p>
            </div>
        </div>
        <div id="passo8" class="passoAPassoSessao">
            <div class="resumoPasso">
                <input type="image" src="imagens/seta_baixo.png" name="botaoDetalhar" class="botao-detalhar" onclick="detalharPasso(this)"></input>
                <p class="titulo">Passo 8 - Avisar no grupo que a versão está em produção</p>
                <a class="links" target="_blank" rel="noopener noreferrer" href="https://teams.microsoft.com/l/chat/19:73bc0f95e03d459eb47ac7939d36737e@thread.v2/conversations">Grupo do CAD</a>
                <label class="container">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="expansion-content">
                <p class="texto">
                    Quando a versão já estiver em produção, avisar no
                    <a class="links" target="_blank" rel="noopener noreferrer" href="https://teams.microsoft.com/l/chat/19:73bc0f95e03d459eb47ac7939d36737e@thread.v2/conversations">Grupo do CAD</a>
                    no Teams informando o número da versão
                </p>
            </div>
        </div>
        <div id="passo9" class="passoAPassoSessao">
            <div class="resumoPasso" style="flex-direction: column;">
                <p class="titulo">Registrar a versão</p>
                <div class="inline-input">
                    <p>Versão: </p>
                    <input type="text" id="nVersao" class="search-field"/>
                </div>
                <div class="inline-input">
                    <p>ID conversa: </p>
                    <input type="text" id="idConversa" class="search-field"/>
                </div>
                <label for="fileInput" class="legenda">Escolha o arquivo csv gerado no passo 1</label>
                <input type="file" id="fileInput" accept=".csv">
                <button id="botaoTeste" class="botao-corpo" onclick="registrar_tabela('programada')">Registrar</button>
            </div>
        </div>
    </div>
    <div id="testeParenteses" class="tab">
        <div id="file-selector" class="divisao">
            <h2 class="titulo-parenteses">Seleção de arquivo</h2>
            <div class='inline-input'>
                <p>Número da versão:</p>
                <input type="text" id="nVersaoParenteses" class="search-field"/>
            </div>
            <form action="index.php" method="post" enctype="multipart/form-data" class="escolher-arquivo" id="arquivoJson">
                <label for="arquivo" class="legenda">Escolha o arquivo JSON da versão</label>
                <p id="arquivo" class="selected-file">Nenhum arquivo selecionado</p>
                <label for="file" class="custom-file-upload">
                    <i class="fa fa-cloud-upload"></i> Escolher arquivo
                </label>
                <br>
                <br>
                <input type="file" name="file" id="file" accept=".json" class="arquivo-selecionado">
                <button id="botaoAnaliseJson" class="botao-corpo" disabled>Testar</button>
            </form>
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_FILES['file'])) {
                        $file = $_FILES['file'];
                        // Verifica se o arquivo é um JSON
                        if ($file['type'] == 'application/json') {
                            $fileName = $file['name'];
                            $uploadDir = __DIR__ . '/';
                            $uploadFile = $uploadDir . 'dados.json';
                            // Move o arquivo para o diretório de destino e renomeia para dados.json
                            if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                                chmod($uploadFile, 0777);
                                // echo "<p id='arquivo-original' hidden>$fileName</p>";
                                // echo "<p>php vai rodar</p>";
                                // echo "<script>processarJSON();</script>";
                            } else {
                                echo "<p>Erro ao enviar o arquivo.</p>";
                            }
                        } else {
                            echo "<p>Por favor, envie um arquivo JSON.</p>";
                        }
                    } else {
                        echo "<p>Nenhum arquivo enviado.</p>";
                        // Adiciona mensagens de depuração
                        echo "<pre>";
                        print_r($_FILES);
                        echo "</pre>";
                    }
                }
            ?>
        </div>
        <div id="resultadoAnaliseParenteses" class="divisao">
            <h2 class="titulo-parenteses">Resultado da análise</h2>
            <p id="textoResultado"></p>
        </div>
        <div id="analise-condicao" class="divisao">
            <h2 class="titulo-parenteses">Analisar Condição</h2>
            <label for="condicao" class="legenda">Cole a condição de entrada no campo abaixo</label>
            <br>
            <input type="text" id="condicao" class="search-field"/>
            <br>
            <p id="textoResultadoCondicao" style="display: none;"></p>
        </div>
    </div>
    <div id="testeVersionamento" class="tab">
        <!-- <div id="mensagem-temporaria" style="display: none; background-color: #28a745; color: white; padding: 10px; border-radius: 5px; position: fixed; top: 20px; right: 20px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
            Teste finalizado com sucesso!
        </div> -->
        <div id="input-section" class="divisao">
            <label for="tx-type">Escolha o tipo de resposta para comparar:</label>
            <select id="tx-type">
                <option value="tx_whatsapp">WhatsApp</option>
                <option value="tx_padrao">Padrão</option>
            </select>
            <p>Caso necessário, inclua inputs adicionais ao teste padrão:</p>
            <input type="text" id="custom-inputs" placeholder="Digite os inputs separados por ;">
            <button id="botaoAnaliseVersao" class="botao-corpo" onclick="compararResultados()">Avaliar Nova Candidata</button>
        </div>
        <div id="analysis-result" class="divisao">
            <h2>Resultado da Análise</h2>
            <p id="id-log"></p>
            <p id="total-diferencas"></p>
            <p id="total-erros"></p>
            <div id="error-details-section"></div>
        </div>
        <div id="result-section">
            <div class="results">
                <h2>Respostas da Versão Candidata (Rascunho)</h2>
                <div id="resultado-teste"></div>
            </div>
            <div class="results">
                <h2>Respostas da Versão Atual (Produção)</h2>
                <div id="resultado-prod"></div>
            </div>
        </div>
    </div>
</body>
</html>