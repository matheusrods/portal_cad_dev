<div id="gerarVersaoProgramada">

    <div class="checklist-progress-bar-wrapper">
        <div class="checklist-progress-bar-header">
            <span>Progresso do Checklist</span>
            <span class="checklist-progress-bar-percent">0%</span>
        </div>
        <div class="checklist-progress-bar-bg">
            <div class="checklist-progress-bar-fill" style="width: 0%;"></div>
        </div>
    </div>


    <div class="tipo-versao-wrapper">
        <label for="tipo-versao-select">Tipo de versão</label>
        <select id="tipo-versao-select">
            <option value="" selected>Selecione</option>
            <option value="programada">Programada</option>
            <option value="excepcional">Excepcional</option>
        </select>
    </div>

    <hr class="custom-divider"/>

    <div id="checklistContainer">
        <div class="checklist-step open">
            <input type="checkbox" class="checklist-checkbox" id="step1"/>
            <div class="step-box">
                <div class="step-header" onclick="detalharPasso(this)">
                <span class="step-title">
                1 – Verificar necessidade de uma nova Versão – 
                <a href="https://genti.intranet.bb.com.br/ccm/web/projects/GECAP%208%20(Change%20Management)#action=com.ibm.team.workitem.viewQueries&tab=owned&queryItemId=__5-k0L1fEe-1nq9wCZvjSQ&queryAction=com.ibm.team.workitem.runSavedQuery&refresh=true">Genti</a>
                </span>
                    <span class="chevron">
                <svg width="24" height="24"><polyline points="6 9 12 15 18 9" fill="none" stroke="#174ec2"
                                                      stroke-width="2"/></svg>
                </span>
                </div>
                <div class="step-content">
                    <p class="texto">Acessar o GENTI <a class="links" target="_blank" rel="noopener noreferrer"
                                                        href="https://genti.intranet.bb.com.br/ccm/web/projects/GECAP%208%20(Change%20Management)#action=com.ibm.team.dashboard.viewDashboard&team=1369-UAC%20Assistentes%20Virtuais&tab=_17">Governança
                            & Documentação</a></p>
                    <p class="texto">Verificar as regras da Janela “Controle de Geração de Versões”</p>
                    <div class="thumbnail-image">
                        <img src="imagens/controle_de_geracao.png" alt="Thumbnail Image" class="thumbnail"
                             onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/controle_de_geracao.png">
                        </div>
                    </div>
                    <p class="texto">Verificar se tem tarefas de #dev prontas desde o último versionamento no <a
                                class="links" target="_blank" rel="noopener noreferrer"
                                href="https://genti.intranet.bb.com.br/ccm/web/projects/GECAP%208%20(Change%20Management)#action=com.ibm.team.workitem.viewQueries&tab=owned&queryItemId=__5-k0L1fEe-1nq9wCZvjSQ&queryAction=com.ibm.team.workitem.runSavedQuery&refresh=true">Genti</a>
                    </p>
                    <div class="thumbnail-image">
                        <img src="imagens/tabela_tarefas_verificar.png" alt="Thumbnail Image" class="thumbnail"
                             onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/tabela_tarefas_verificar.png">
                        </div>
                    </div>
                    <p class="texto">Baixar a lista de Tarefas concluídas (usada depois na tabela de gerenciamento de
                        versões)</p>
                    <div class="thumbnail-image">
                        <img src="imagens/tabela_tarefas_baixar.png" alt="Thumbnail Image" class="thumbnail"
                             onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/tabela_tarefas_baixar.png">
                        </div>
                    </div>
                    <p class="texto">
                        Caso não tenha nenhuma tarefa de #dev pronta, encerrar o processo por aqui, não é necessário
                        subir uma nova versão. Comunicar a equipe no
                        <a class="links" target="_blank" rel="noopener noreferrer"
                           href="https://teams.microsoft.com/l/chat/19:73bc0f95e03d459eb47ac7939d36737e@thread.v2/conversations">Grupo
                            do CAD</a>
                        do Teams
                    </p>
                </div>
            </div>
        </div>

        <div class="checklist-step">
            <input type="checkbox" class="checklist-checkbox" id="step2"/>
            <div class="step-box">
                <div class="step-header" onclick="detalharPasso(this)">
                    <span class="step-title">
                    2 –  Gerar Versão e promovê-la até "EM VALIDAÇÃO" – 
                    <a href="https://nia.bb.com.br/nia-cognitivo-estatico/manager/gerenciarVersao/314/59">Genti</a>
                    </span>
                    <span class="chevron">
                    <svg width="24" height="24"><polyline points="6 9 12 15 18 9" fill="none" stroke="#174ec2"
                                                          stroke-width="2"/></svg>
                    </span>
                </div>
                <div class="step-content">
                    <p class="texto">
                        Acessar o <a class="links" target="_blank" rel="noopener noreferrer"
                                     href="https://nia.bb.com.br/nia-cognitivo-estatico/manager/servicos">NIA</a>
                        e clicar no menu "Conversation - CAD - Escola de Robôs (10)"
                    </p>
                    <div class="thumbnail-image">
                        <img src="imagens/nia_servicos.png" alt="Thumbnail Image" class="thumbnail"
                             onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/nia_servicos.png">
                        </div>
                    </div>
                    <p class="texto">Clicar no submenu com 3 traços do corpus "WSA - Clientes" e clicar na opção
                        "Gerenciar Publicação"</p>
                    <div class="thumbnail-image">
                        <img src="imagens/nia_servicos_corpus.png" alt="Thumbnail Image" class="thumbnail"
                             onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/nia_servicos_corpus.png">
                        </div>
                    </div>
                    <p class="texto">Entrar na aba "Versões", clicar no botão versão e preencher o campo de texto com
                        "Carga programada das 11h - Consultar planilha de controle de cargas", clicar em "Gerar Versão"
                        e aguardar a geração da nova versão</p>
                    <div class="thumbnail-image">
                        <img src="imagens/versoes.png" alt="Thumbnail Image" class="thumbnail"
                             onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/versoes.png">
                        </div>
                    </div>
                    <div class="thumbnail-image">
                        <img src="imagens/gerar_versao.png" alt="Thumbnail Image" class="thumbnail"
                             onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/gerar_versao.png">
                        </div>
                    </div>
                    <p class="texto">Na coluna com o ícone <img src="imagens/ferramenta.png"
                                                                style="width:15px;height:15px;"></img> clicar no ícone
                        <img src="imagens/exportar.png" style="width:15px;height:15px;"></img> para baixar o json da
                        versão que será usado nos testes automatizados</p>
                    <div class="thumbnail-image">
                        <img src="imagens/baixar_json.png" alt="Thumbnail Image" class="thumbnail"
                             onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/baixar_json.png">
                        </div>
                    </div>
                    <p class="texto">Na coluna "Serviços na Nuvem", clicar no ícone <img src="imagens/sincronizar.png"
                                                                                         style="width:15px;height:15px;"></img>
                        para sincronizar com o desenvolvimento e aguardar sincronização</p>
                    <div class="thumbnail-image">
                        <img src="imagens/sincronizar_versao.png" alt="Thumbnail Image" class="thumbnail"
                             onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/sincronizar_versao.png">
                        </div>
                    </div>
                    <p class="texto">Acessar a guia "Publicação" e verificar se a versão subiu corretamente, observando
                        o número da versão e o horário de subida</p>
                    <div class="thumbnail-image">
                        <img src="imagens/verificar_sincronizacao.png" alt="Thumbnail Image" class="thumbnail"
                             onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/verificar_sincronizacao.png">
                        </div>
                    </div>
                    <p class="texto">Na sessão "RASCUNHO", clicar no ícone <img src="imagens/sincronizar.png"
                                                                                style="width:15px;height:15px;"></img>
                        para promover a versão para "EM VALIDAÇÃO"</p>
                    <div class="thumbnail-image">
                        <img src="imagens/promover_versao.png" alt="Thumbnail Image" class="thumbnail"
                             onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/promover_versao.png">
                        </div>
                    </div>
                    <div class="thumbnail-image">
                        <img src="imagens/sincronizar_validacao.png" alt="Thumbnail Image" class="thumbnail"
                             onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/sincronizar_validacao.png">
                        </div>
                    </div>
                    <div class="sessao-erro">
                        <p class="texto-erro">
                            Em caso de erro ao gerar, sincronizar ou promover a versão, abrir issue no
                            <a class="links" target="_blank" rel="noopener noreferrer"
                               href="https://fontes.intranet.bb.com.br/nia/publico/nia-sustentacao-atendimento/-/issues">Portal
                                Fontes</a>
                            usando como base o padrão abaixo, substituindo os "x" pela informação devida:
                        </p>
                        <div class="tabela">
                            <div class="tabela-linha">
                                <p class="tabela-celula">Title</p>
                                <p class="tabela-celula">xx/xx/xxxx - Nia Prod - Problema Promoção de versão em Produção
                                    ["Rascunho" para "Em Validação"] Versão xxxx</p>
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
                                <p class="tabela-celula">[print da tela do NIA com erro] Versão xxxx do dia xx/xx/xxxx:
                                    Não foi possível sincronizar a versão "em rascunho" para "em validação".
                                    Impossibilidade de subir versões para prod desde o dia xx/xx/xxxx</p>
                            </div>
                        </div>
                        <div class="thumbnail-image">
                            <img src="imagens/abrir_issue.png" alt="Thumbnail Image" class="thumbnail"
                                 onclick="openModal(this)">
                            <div class="modal" onclick="closeModal(this)">
                                <img class="modal-content" id="img01" src="imagens/abrir_issue.png">
                            </div>
                        </div>
                        <div class="thumbnail-image">
                            <img src="imagens/preencher_issue.png" alt="Thumbnail Image" class="thumbnail"
                                 onclick="openModal(this)">
                            <div class="modal" onclick="closeModal(this)">
                                <img class="modal-content" id="img01" src="imagens/preencher_issue.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="checklist-step">
            <input type="checkbox" class="checklist-checkbox" id="step3"/>
            <div class="step-box">
                <div class="step-header" onclick="detalharPasso(this)">
                    <span class="step-title">3 –  Realizar os testes automatizados nesta página</span>
                    <span class="chevron">
                    <svg width="24" height="24"><polyline points="6 9 12 15 18 9" fill="none" stroke="#174ec2"
                                                          stroke-width="2"/></svg>
                    </span>
                </div>
                <div class="step-content">
                    <p class="texto">Acessar a guia "Teste de Parênteses" acima, clicar em "Escolher arquivo",
                        selecionar o json baixado no passo 2 e clicar em "Analisar"</p>
                    <div class="thumbnail-image">
                        <img src="imagens/teste_parenteses.png" alt="Thumbnail Image" class="thumbnail"
                             onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/teste_parenteses.png">
                        </div>
                    </div>
                    <p class="texto">Printar a sessão "Resultado da análise" para registrar na planilha</p>
                    <p class="texto">Acessar a guia "Teste de Versionamento" acima e clicar em "Avaliar Nova
                        Candidata"</p>
                    <div class="thumbnail-image">
                        <img src="imagens/teste_versionamento.png" alt="Thumbnail Image" class="thumbnail"
                             onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/teste_versionamento.png">
                        </div>
                    </div>
                    <p class="texto">Printar a sessão "Resultado da análise" para registrar na planilha</p>
                    <div class="sessao-erro">
                        <p class="texto-erro">Em caso de erro nos testes de automatizados:</p>
                        <p class="texto-erro">1 - Avisar os responsáveis pelas hashes apontadas</p>
                        <p class="texto-erro">2 - Analisar o motivo do erro e em caso de impacto para os clientes
                            interromper o processo de subida de versão</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="checklist-step">
            <input type="checkbox" class="checklist-checkbox" id="step4"/>
            <div class="step-box">
                <div class="step-header" onclick="detalharPasso(this)">
                    <span class="step-title">4 – Realizar os testes manuais no bot</span>
                    <span class="chevron">
                    <svg width="24" height="24"><polyline points="6 9 12 15 18 9" fill="none" stroke="#174ec2"
                                                          stroke-width="2"/></svg>
                    </span>
                </div>
                <div class="step-content">
                    <p class="texto">No número de produção do bot no Whatsapp (61 4004-0001) alterar o corpus para
                        Rascunho (#defineCorpus WSA_-_CLIENTES)</p>
                    <div class="thumbnail-image">
                        <img src="imagens/define_corpus.jpg" alt="Thumbnail Image" class="thumbnail"
                             onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/define_corpus.jpg">
                        </div>
                    </div>
                    <p class="texto">Resetar o fluxo com o comando "recomecar" e iniciar o teste com o input "Consultar
                        limite cartão", seguir até o fim do fluxo</p>
                    <div class="thumbnail-image">
                        <img src="imagens/consultar_limite.jpg" alt="Thumbnail Image" class="thumbnail"
                             onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/consultar_limite.jpg">
                        </div>
                    </div>
                    <p class="texto">Sem usar o comando "recomecar", iniciar novo fluxo com o input "Empréstimo", seguir
                        até o momento em que o bot manda o link para inserir a senha</p>
                    <div class="thumbnail-image">
                        <img src="imagens/emprestimo.jpg" alt="Thumbnail Image" class="thumbnail"
                             onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/emprestimo.jpg">
                        </div>
                    </div>
                    <p class="texto">No <a class="links" target="_blank" rel="noopener noreferrer"
                                           href="https://nia.bb.com.br/nia-cognitivo-estatico/manager/conversas/314/59">Histórico
                            de Conversas</a> preencher o filtro "Serviço" com "WSA_-_CLIENTES" e o filtro "Matrícula"
                        com seu número de telefone e pesquisar</p>
                    <div class="thumbnail-image">
                        <img src="imagens/historico_conversas.png" alt="Thumbnail Image" class="thumbnail"
                             onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/historico_conversas.png">
                        </div>
                    </div>
                    <p class="texto">Copiar o campo "ID Conversa" para preencher a planilha</p>
                    <div class="sessao-erro">
                        <p class="texto-erro">Em caso de erro nos testes de manuais:</p>
                        <p class="texto-erro">1 - Avisar os responsáveis pelas hashes apontadas</p>
                        <p class="texto-erro">2 - Analisar o motivo do erro e em caso de impacto para os clientes
                            interromper o processo de subida de versão</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="checklist-step">
            <input type="checkbox" class="checklist-checkbox" id="step5"/>
            <div class="step-box">
                <div class="step-header" onclick="detalharPasso(this)">
                    <span class="step-title">5 – Preencher os dados na aba "PF" da planilha – 
                        <a target="_blank"
                           href="https://banco365-my.sharepoint.com/:x:/g/personal/w_g_arruda_bb_com_br/EXpwvpO4eNRJv3zyN_p-vT8BPW05NkCcFmE9lXQG_Q13GA?e=Za8cVY">Controle de Cargas do Bot</a>
                    </span>
                    <span class="chevron">
                    <svg width="24" height="24"><polyline points="6 9 12 15 18 9" fill="none" stroke="#174ec2"
                                                          stroke-width="2"/></svg>
                    </span>
                </div>
                <div class="step-content">
                    <p class="texto">
                        Na aba "PF" da planilha
                        <a class="links" target="_blank" rel="noopener noreferrer"
                           href="https://banco365-my.sharepoint.com/:x:/g/personal/w_g_arruda_bb_com_br/EXpwvpO4eNRJv3zyN_p-vT8BPW05NkCcFmE9lXQG_Q13GA?e=Za8cVY">Controle
                            de Cargas do Bot</a>
                        preencher a coluna "Versão" com o número da versão gerada e "Data da Carga" com a data do dia
                        que está sendo gerada a versão e horário 11:00
                    </p>
                    <p class="texto">Preencher as demais colunas com as informações da tabela do Genti obtida no passo
                        1</p>
                    <p class="texto">Preencher a coluna "Nº da Tarefa" com a coluna "ID" da tabela do Genti</p>
                    <p class="texto">Preencher a coluna "Nome da Tarefa" com a coluna "Resumo" da tabela do Genti</p>
                    <p class="texto">Preencher a coluna "Status" com a coluna "Status" da tabela do Genti</p>
                    <p class="texto">Preencher a coluna "Data da Modificação" com a coluna "Data de Modificação" da
                        tabela do Genti</p>
                    <div class="thumbnail-image">
                        <img src="imagens/tabela_pf.png" alt="Thumbnail Image" class="thumbnail"
                             onclick="openModal(this)">
                        <div class="modal" onclick="closeModal(this)">
                            <img class="modal-content" id="img01" src="imagens/tabela_pf.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="checklist-step">
            <input type="checkbox" class="checklist-checkbox" id="step6"/>
            <div class="step-box">
                <div class="step-header" onclick="detalharPasso(this)">
                    <span class="step-title">6 – Preencher os dados na aba "Controle de Versões" da planilha – 
                        <a target="_blank"
                           href="https://banco365-my.sharepoint.com/:x:/g/personal/w_g_arruda_bb_com_br/EXpwvpO4eNRJv3zyN_p-vT8BPW05NkCcFmE9lXQG_Q13GA?e=Za8cVY">Controle de Cargas do Bot</a>
                    </span>
                    <span class="chevron">
                    <svg width="24" height="24"><polyline points="6 9 12 15 18 9" fill="none" stroke="#174ec2"
                                                          stroke-width="2"/></svg>
                    </span>
                </div>
                <div class="step-content">
                    <p class="texto">
                        Na aba "Controle de Versões" da planilha
                        <a class="links" target="_blank" rel="noopener noreferrer"
                           href="https://banco365-my.sharepoint.com/:x:/g/personal/w_g_arruda_bb_com_br/EXpwvpO4eNRJv3zyN_p-vT8BPW05NkCcFmE9lXQG_Q13GA?e=Za8cVY">Controle
                            de Cargas do Bot</a>
                        preencher a coluna “Versão” com o número da versão gerada, “Data da Versão” com a data do dia
                        que está sendo gerada a versão e horário 11:00 e “Motivo” com "Programada"
                    </p>
                    <p class="texto">Preencher as demais colunas com as informações dos testes obtidos nos passos 3 e
                        4</p>
                    <p class="texto">Preencher a coluna "Teste Parenteses" com o print do teste obtido no passo 3</p>
                    <p class="texto">Preencher a coluna "Teste Automatizado" com o print do teste obtido no passo 3</p>
                    <p class="texto">Preencher a coluna "Teste Jornadas em Rascunho (id conversa)" com o id da conversa
                        obtido no passo 4</p>
                    <p class="texto">Não é necessário preencher a coluna "Autorização"</p>
                    <p class="texto">Preencher a coluna "Observação" somente quando tiver algo a justificar na subida,
                        por exemplo quando algum dos testes apresentar erro que não impacta o cliente</p>
                </div>
            </div>
        </div>

        <div class="checklist-step">
            <input type="checkbox" class="checklist-checkbox" id="step7"/>
            <div class="step-box">
                <div class="step-header" onclick="detalharPasso(this)">
                    <span class="step-title"> 7 – Subir para produção</span>
                    <span class="chevron">
                    <svg width="24" height="24"><polyline points="6 9 12 15 18 9" fill="none" stroke="#174ec2"
                                                          stroke-width="2"/></svg>
                    </span>
                </div>
                <div class="step-content">
                    <p class="texto">A promoção da versão de "Em Validação" para "Publicado" deve ser feito por um
                        gerente ou analista pleno, solicitar via Teams</p>
                </div>
            </div>
        </div>

        <div class="checklist-step">
            <input type="checkbox" class="checklist-checkbox" id="step8"/>
            <div class="step-box">
                <div class="step-header" onclick="detalharPasso(this)">
                    <span class="step-title"> 8 – Avisar no grupo que a versão está em produção – 
                    <a target="_blank"
                       href="https://teams.microsoft.com/l/chat/19:73bc0f95e03d459eb47ac7939d36737e@thread.v2/conversations">Grupo do CAD</a>
                    </span>
                    <span class="chevron">
                    <svg width="24" height="24"><polyline points="6 9 12 15 18 9" fill="none" stroke="#174ec2"
                                                          stroke-width="2"/></svg>
                    </span>
                </div>
                <div class="step-content">
                    <p class="texto">
                        Quando a versão já estiver em produção, avisar no
                        <a target="_blank"
                           href="https://teams.microsoft.com/l/chat/19:73bc0f95e03d459eb47ac7939d36737e@thread.v2/conversations">Grupo
                            do CAD</a>
                        no Teams informando o número da versão
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function detalharPasso(el) {
        const step = el.closest('.checklist-step');
        step.classList.toggle('open');
    }

    function atualizarProgressoChecklist() {
        // Seleciona todos os checkboxes dos passos
        const checkboxes = document.querySelectorAll('.checklist-checkbox');
        const total = checkboxes.length + 1; // +1 por causa do select "tipo de versão"
        let preenchidos = 0;

        // Conta checkboxes marcados
        checkboxes.forEach(cb => {
            if (cb.checked) preenchidos++;
        });

        // Conta o select preenchido (valor diferente de vazio)
        const select = document.getElementById('tipo-versao-select');
        if (select && select.value !== '') preenchidos++;

        // Calcula percentual
        const percentual = Math.round((preenchidos / total) * 100);

        // Atualiza a barra de progresso e o texto
        document.querySelector('.checklist-progress-bar-fill').style.width = percentual + '%';
        document.querySelector('.checklist-progress-bar-percent').innerText = percentual + '%';
    }

    // Roda ao abrir a página para já pegar valores marcados
    atualizarProgressoChecklist();

    // Eventos: checkboxes e select
    document.querySelectorAll('.checklist-checkbox').forEach(cb => {
        cb.addEventListener('change', atualizarProgressoChecklist);
    });
    document.getElementById('tipo-versao-select').addEventListener('change', atualizarProgressoChecklist);

</script>