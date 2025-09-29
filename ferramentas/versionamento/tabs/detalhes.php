<div id="detalhes">
    <div class="detalhes-breadcrumb">
        <a href="#" onclick="selectTab('historico', this); return false;" class="detalhes-voltar">
            ← Voltar
        </a>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-id" id="detalhe-versao-breadcrumb"></span>
    </div>

    <div class="detalhes-card">
        <div class="detalhes-info">
            <p class="detalhe-versao"><strong>Versão:</strong> <span id="detalhe-versao"></span></p>
            <p class="detalhe-info-titulos"><strong>Responsável:</strong> <span id="detalhe-responsavel"></span></p>
            <p class="detalhe-info-titulos"><strong>Data:</strong> <span id="detalhe-data"></span></p>
            <p class="detalhe-info-titulos"><strong>Hora:</strong> <span id="detalhe-hora"></span></p>
            <p class="detalhe-info-titulos"><strong>Motivo:</strong> <span id="detalhe-motivo"></span></p>
            <p class="detalhe-info-titulos"><strong>Corpus:</strong> <span id="detalhe-corpus"></span></p>
        </div>
        <div class="detalhes-obs">
            <p class="detalhe-info-titulos"><strong>Observações:</strong></p>
            <p class="detalhe-info-titulos" id="detalhe-obs">
                Visualização clara e intuitiva de dados importantes, permitindo decisões mais assertivas e reduzindo
                tempo de análise manual.
            </p>
        </div>
    </div>

    <nav class="detalhes-tabs">
        <div class="detalhes-tab-button active" onclick="selectDetalhesTab('tarefas', this)">Tarefas</div>
        <div class="detalhes-tab-button" onclick="selectDetalhesTab('parenteses', this)">Teste de Parênteses</div>
        <div class="detalhes-tab-button" onclick="selectDetalhesTab('versionamento', this)">Teste de Versionamento</div>
        <div class="detalhes-tab-button" onclick="selectDetalhesTab('conversa', this)">Conversa</div>
    </nav>

    <div class="detalhes-tab-content active" id="tab-tarefas">
        <div class="tarefa-card">
            <div class="tarefa-col tarefa-title-col">
                <strong class="detalhe-info-titulos">Tarefa</strong>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 13v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                    2138098
                </a>
            </div>
            <div class="tarefa-col nome-col">
                <strong class="detalhe-info-titulos">Nome</strong>
                [CONSULTORIA] [DEV] [SEGURIDADE] [TRN] Contratação Seguro Itens Pessoais Não Correntista
            </div>
            <div class="tarefa-col status-col">
                <strong class="detalhe-info-titulos">Status</strong>
                <span class="status status-pronta">Pronta</span>
            </div>
        </div>

        <div class="tarefa-card">
            <div class="tarefa-col tarefa-title-col">
                <strong class="detalhe-info-titulos">Tarefa</strong>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 13v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                    2138099
                </a>
            </div>
            <div class="tarefa-col nome-col">
                <strong class="detalhe-info-titulos">Nome</strong>
                [CONSULTORIA] [DEV] [SEGURIDADE] [TRN] Validação de Processos Internos
            </div>
            <div class="tarefa-col status-col">
                <strong class="detalhe-info-titulos">Status</strong>
                <span class="status status-andamento">Em andamento</span>
            </div>
        </div>

        <div class="tarefa-card">
            <div class="tarefa-col tarefa-title-col">
                <strong class="detalhe-info-titulos">Tarefa</strong>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 13v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                    2138100
                </a>
            </div>
            <div class="tarefa-col nome-col">
                <strong class="detalhe-info-titulos">Nome</strong>
                [CONSULTORIA] [DEV] [ANÁLISE] Teste de Integração com Sistema X
            </div>
            <div class="tarefa-col status-col">
                <strong class="detalhe-info-titulos">Status</strong>
                <span class="status status-pronta">Pronta</span>
            </div>
        </div>

        <div class="tarefa-card">
            <div class="tarefa-col tarefa-title-col">
                <strong class="detalhe-info-titulos">Tarefa</strong>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 13v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                    2138101
                </a>
            </div>
            <div class="tarefa-col nome-col">
                <strong class="detalhe-info-titulos">Nome</strong>
                [CONSULTORIA] [DEV] [SUPORTE] Ajustes Pós-Deploy Produção
            </div>
            <div class="tarefa-col status-col">
                <strong class="detalhe-info-titulos">Status</strong>
                <span class="status status-andamento">Em andamento</span>
            </div>
        </div>
    </div>

    <div class="detalhes-tab-content" id="tab-parenteses">
        <div class="parenteses-card">
            <div class="parenteses-linha">
                <div class="hash">
                    <strong class="detalhe-info-titulos">Hash:</strong> 00003204023-0402304302-40320403
                    <span class="copy-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M15.75 0H5.625C4.38244 0 3.375 1.00744 3.375 2.25H4.5C4.5 1.62928 5.00484 1.125 5.625 1.125H15.75C16.3707 1.125 16.875 1.62928 16.875 2.25V12.375C16.875 12.9957 16.3707 13.5 15.75 13.5V14.625C16.9926 14.625 18 13.6176 18 12.375V2.25C18 1.00744 16.9926 0 15.75 0ZM12.375 3.375H2.25C1.00744 3.375 0 4.38244 0 5.625V15.75C0 16.9926 1.00744 18 2.25 18H12.375C13.6176 18 14.625 16.9926 14.625 15.75V5.625C14.625 4.38244 13.6176 3.375 12.375 3.375ZM13.5 15.75C13.5 16.3707 12.9957 16.875 12.375 16.875H2.25C1.62984 16.875 1.125 16.3707 1.125 15.75V5.625C1.125 5.00428 1.62984 4.5 2.25 4.5H12.375C12.9957 4.5 13.5 5.00428 13.5 5.625V15.75ZM3.375 7.875H11.25V6.75H3.375V7.875ZM3.375 10.125H11.25V9H3.375V10.125ZM3.375 12.375H11.25V11.25H3.375V12.375ZM3.375 14.625H7.875V13.5H3.375V14.625Z"
                              fill="#646464"/>
                        </svg>
                    </span>
                </div>
                <div class="parenteses-resultados">
                    <div class="resultado">
                        Parênteses
                        <span class="status-icone success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
                                 fill="none">
                            <path d="M10.5 0C4.977 0 0.5 4.477 0.5 10C0.5 15.523 4.977 20 10.5 20C16.023 20 20.5 15.523 20.5 10C20.5 4.477 16.022 0 10.5 0ZM9.75 15.75L4.75 12L6.25 10L9.25 12.25L14.5 5.25L16.5 6.75L9.75 15.75Z"
                                  fill="#1FB906"/>
                            </svg>
                        </span>
                    </div>
                    <div class="resultado">
                        Aspas
                        <span class="status-icone error">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                 fill="none">
                                <path d="M10 0C4.47 0 0 4.47 0 10C0 15.53 4.47 20 10 20C15.53 20 20 15.53 20 10C20 4.47 15.53 0 10 0ZM15 13.59L13.59 15L10 11.41L6.41 15L5 13.59L8.59 10L5 6.41L6.41 5L10 8.59L13.59 5L15 6.41L11.41 10L15 13.59Z"
                                      fill="#FF3535"/>
                            </svg>
                        </span>
                    </div>
                    <div class="resultado">
                        Variáveis de Contexto
                        <span class="status-icone error">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                 fill="none">
                                <path d="M10 0C4.47 0 0 4.47 0 10C0 15.53 4.47 20 10 20C15.53 20 20 15.53 20 10C20 4.47 15.53 0 10 0ZM15 13.59L13.59 15L10 11.41L6.41 15L5 13.59L8.59 10L5 6.41L6.41 5L10 8.59L13.59 5L15 6.41L11.41 10L15 13.59Z"
                                      fill="#FF3535"/>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="parenteses-card">
            <div class="parenteses-linha">
                <div class="hash">
                    <strong class="detalhe-info-titulos">Hash:</strong> 00003204023-0402304302-40320403
                    <span class="copy-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M15.75 0H5.625C4.38244 0 3.375 1.00744 3.375 2.25H4.5C4.5 1.62928 5.00484 1.125 5.625 1.125H15.75C16.3707 1.125 16.875 1.62928 16.875 2.25V12.375C16.875 12.9957 16.3707 13.5 15.75 13.5V14.625C16.9926 14.625 18 13.6176 18 12.375V2.25C18 1.00744 16.9926 0 15.75 0ZM12.375 3.375H2.25C1.00744 3.375 0 4.38244 0 5.625V15.75C0 16.9926 1.00744 18 2.25 18H12.375C13.6176 18 14.625 16.9926 14.625 15.75V5.625C14.625 4.38244 13.6176 3.375 12.375 3.375ZM13.5 15.75C13.5 16.3707 12.9957 16.875 12.375 16.875H2.25C1.62984 16.875 1.125 16.3707 1.125 15.75V5.625C1.125 5.00428 1.62984 4.5 2.25 4.5H12.375C12.9957 4.5 13.5 5.00428 13.5 5.625V15.75ZM3.375 7.875H11.25V6.75H3.375V7.875ZM3.375 10.125H11.25V9H3.375V10.125ZM3.375 12.375H11.25V11.25H3.375V12.375ZM3.375 14.625H7.875V13.5H3.375V14.625Z"
                              fill="#646464"/>
                        </svg>
                    </span>
                </div>
                <div class="parenteses-resultados">
                    <div class="resultado">
                        Parênteses
                        <span class="status-icone success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20"
                                 fill="none">
                            <path d="M10.5 0C4.977 0 0.5 4.477 0.5 10C0.5 15.523 4.977 20 10.5 20C16.023 20 20.5 15.523 20.5 10C20.5 4.477 16.022 0 10.5 0ZM9.75 15.75L4.75 12L6.25 10L9.25 12.25L14.5 5.25L16.5 6.75L9.75 15.75Z"
                                  fill="#1FB906"/>
                            </svg>
                        </span>
                    </div>
                    <div class="resultado">
                        Aspas
                        <span class="status-icone error">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20" fill="none">
                    <path d="M10 0C4.47 0 0 4.47 0 10C0 15.53 4.47 20 10 20C15.53 20 20 15.53 20 10C20 4.47 15.53 0 10 0ZM15 13.59L13.59 15L10 11.41L6.41 15L5 13.59L8.59 10L5 6.41L6.41 5L10 8.59L13.59 5L15 6.41L11.41 10L15 13.59Z"
                          fill="#FF3535"/>
                </svg>
                </span>
                    </div>
                    <div class="resultado">
                        Variáveis de Contexto
                        <span class="status-icone error">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20" fill="none">
                    <path d="M10 0C4.47 0 0 4.47 0 10C0 15.53 4.47 20 10 20C15.53 20 20 15.53 20 10C20 4.47 15.53 0 10 0ZM15 13.59L13.59 15L10 11.41L6.41 15L5 13.59L8.59 10L5 6.41L6.41 5L10 8.59L13.59 5L15 6.41L11.41 10L15 13.59Z"
                          fill="#FF3535"/>
                </svg>
                </span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="detalhes-tab-content" id="tab-versionamento">
        <!-- Filtro -->
        <div class="filtro-versionamento">
            <label for="filtro">Filtrar por:</label>
            <select id="filtro" class="filtro-select">
                <option value="">Selecione</option>
                <option value="alteradas">Alteradas</option>
                <option value="erros">Erros</option>
            </select>
        </div>

        <!-- Grid de versões -->
        <div class="versionamento-grid">
            <!-- Versão Antiga -->
            <div class="versao-card">
                <div class="versao-header">
                    <span class="versao-icone"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                                    viewBox="0 0 25 24"
                                                    fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M4.5 2C3.39543 2 2.5 2.89492 2.5 3.99885V21.299C2.5 21.9223 3.254 22.2344 3.69497 21.7937L8.5 16.9914H20.5C21.6046 16.9914 22.5 16.0965 22.5 14.9926V3.99886C22.5 2.89492 21.6046 2 20.5 2H4.5ZM6.5 5.99771H18.5V7.99657H6.5V5.99771ZM14.5 9.99542H6.5V11.9943H14.5V9.99542Z"
                                  fill="#4668FF"/>
                            </svg></span>
                    <span class="versao-titulo">Respostas da Versão Antiga (Rascunho)</span>
                </div>
                <div class="versao-respostas">
                    <div class="resposta-item">
                        <span class="label">Input:</span>
                        <span class="texto">Oi</span>
                        <span class="resposta-icone"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                          viewBox="0 0 20 20" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M10.293 9.293L11.707 10.707L15.414 7L11.707 3.293L10.293 4.707L11.586 6H6V8H11.586L10.293 9.293ZM9.707 15.293L8.414 14H14V12H8.414L9.707 10.707L8.293 9.293L4.586 13L8.293 16.707L9.707 15.293ZM18 0H2C0.896 0 0 0.896 0 2V18C0 19.102 0.896 20 2 20H18C19.104 20 20 19.102 20 18V2C20 0.896 19.104 0 18 0ZM17.997 18H2V2H18L17.997 18Z"
              fill="#4668FF"/>
      </svg></span>
                    </div>
                    <div class="resposta-item">
                        <span class="label">Input:</span>
                        <span class="texto">Oi</span>
                        <span class="resposta-icone"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                          viewBox="0 0 20 20" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M10.293 9.293L11.707 10.707L15.414 7L11.707 3.293L10.293 4.707L11.586 6H6V8H11.586L10.293 9.293ZM9.707 15.293L8.414 14H14V12H8.414L9.707 10.707L8.293 9.293L4.586 13L8.293 16.707L9.707 15.293ZM18 0H2C0.896 0 0 0.896 0 2V18C0 19.102 0.896 20 2 20H18C19.104 20 20 19.102 20 18V2C20 0.896 19.104 0 18 0ZM17.997 18H2V2H18L17.997 18Z"
              fill="#4668FF"/>
      </svg></span>
                    </div>
                    <div class="resposta-item">
                        <span class="label">Input:</span>
                        <span class="texto">Oi</span>
                        <span class="resposta-icone"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                          viewBox="0 0 20 20" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M10.293 9.293L11.707 10.707L15.414 7L11.707 3.293L10.293 4.707L11.586 6H6V8H11.586L10.293 9.293ZM9.707 15.293L8.414 14H14V12H8.414L9.707 10.707L8.293 9.293L4.586 13L8.293 16.707L9.707 15.293ZM18 0H2C0.896 0 0 0.896 0 2V18C0 19.102 0.896 20 2 20H18C19.104 20 20 19.102 20 18V2C20 0.896 19.104 0 18 0ZM17.997 18H2V2H18L17.997 18Z"
              fill="#4668FF"/>
      </svg></span>
                    </div>
                </div>
            </div>

            <!-- Versão Atual -->
            <div class="versao-card">
                <div class="versao-header">
                    <span class="versao-icone"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M13.5293 2C12.5788 3.0616 12 4.46293 12 6C12 9.31371 14.6863 12 18 12C19.5371 12 20.9384 11.4212 22 10.4707V14.9922C22 16.0961 21.1046 16.9912 20 16.9912H8L3.19531 21.7939C2.75434 22.2347 2 21.9221 2 21.2988V3.99902C2 2.89509 2.89543 2 4 2H13.5293ZM5.9375 12H11.9375V10H5.9375V12ZM5.9375 7.9375H9.0625V5.9375H5.9375V7.9375Z"
                                  fill="#4668FF"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19 5V2H17V5H14V7H17V10H19V7H22V5H19Z"
                                  fill="#4668FF"/>
                            </svg></span>
                    <span class="versao-titulo">Respostas da Versão Atual (Produção)</span>
                </div>
                <div class="versao-respostas">
                    <div class="resposta-item">
                        <span class="label">Input:</span>
                        <span class="texto">Oi</span>
                        <span class="resposta-icone"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                          viewBox="0 0 20 20" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M10.293 9.293L11.707 10.707L15.414 7L11.707 3.293L10.293 4.707L11.586 6H6V8H11.586L10.293 9.293ZM9.707 15.293L8.414 14H14V12H8.414L9.707 10.707L8.293 9.293L4.586 13L8.293 16.707L9.707 15.293ZM18 0H2C0.896 0 0 0.896 0 2V18C0 19.102 0.896 20 2 20H18C19.104 20 20 19.102 20 18V2C20 0.896 19.104 0 18 0ZM17.997 18H2V2H18L17.997 18Z"
              fill="#4668FF"/>
      </svg></span>
                    </div>
                    <div class="resposta-item">
                        <span class="label">Input:</span>
                        <span class="texto">Oi</span>
                        <span class="resposta-icone"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                          viewBox="0 0 20 20" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M10.293 9.293L11.707 10.707L15.414 7L11.707 3.293L10.293 4.707L11.586 6H6V8H11.586L10.293 9.293ZM9.707 15.293L8.414 14H14V12H8.414L9.707 10.707L8.293 9.293L4.586 13L8.293 16.707L9.707 15.293ZM18 0H2C0.896 0 0 0.896 0 2V18C0 19.102 0.896 20 2 20H18C19.104 20 20 19.102 20 18V2C20 0.896 19.104 0 18 0ZM17.997 18H2V2H18L17.997 18Z"
              fill="#4668FF"/>
      </svg></span>
                    </div>
                    <div class="resposta-item">
                        <span class="label">Input:</span>
                        <span class="texto">Oi</span>
                        <span class="resposta-icone"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                          viewBox="0 0 20 20" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M10.293 9.293L11.707 10.707L15.414 7L11.707 3.293L10.293 4.707L11.586 6H6V8H11.586L10.293 9.293ZM9.707 15.293L8.414 14H14V12H8.414L9.707 10.707L8.293 9.293L4.586 13L8.293 16.707L9.707 15.293ZM18 0H2C0.896 0 0 0.896 0 2V18C0 19.102 0.896 20 2 20H18C19.104 20 20 19.102 20 18V2C20 0.896 19.104 0 18 0ZM17.997 18H2V2H18L17.997 18Z"
              fill="#4668FF"/>
      </svg></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="detalhes-tab-content" id="tab-conversa">
        <div class="conversa-card">
            <div class="conversa-linha">
                <span class="conversa-label">Id conversa:</span>
                <span class="conversa-texto">2324325438583475-78378654876544554456b-323reew2334234</span>
                <span class="copy-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                <path d="M15.75 0H5.625C4.38244 0 3.375 1.00744 3.375 2.25H4.5C4.5 1.62928 5.00484 1.125 5.625 1.125H15.75C16.3707 1.125 16.875 1.62928 16.875 2.25V12.375C16.875 12.9957 16.3707 13.5 15.75 13.5V14.625C16.9926 14.625 18 13.6176 18 12.375V2.25C18 1.00744 16.9926 0 15.75 0ZM12.375 3.375H2.25C1.00744 3.375 0 4.38244 0 5.625V15.75C0 16.9926 1.00744 18 2.25 18H12.375C13.6176 18 14.625 16.9926 14.625 15.75V5.625C14.625 4.38244 13.6176 3.375 12.375 3.375ZM13.5 15.75C13.5 16.3707 12.9957 16.875 12.375 16.875H2.25C1.62984 16.875 1.125 16.3707 1.125 15.75V5.625C1.125 5.00428 1.62984 4.5 2.25 4.5H12.375C12.9957 4.5 13.5 5.00428 13.5 5.625V15.75ZM3.375 7.875H11.25V6.75H3.375V7.875ZM3.375 10.125H11.25V9H3.375V10.125ZM3.375 12.375H11.25V11.25H3.375V12.375ZM3.375 14.625H7.875V13.5H3.375V14.625Z"
                      fill="#646464"/>
                </svg>
            </span>
            </div>
        </div>

        <div class="conversa-card">
            <div class="conversa-linha">
                <span class="conversa-label">Id conversa:</span>
                <span class="conversa-texto">2324325438583475-78378654876544554456b-323reew2334234</span>
                <span class="copy-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                <path d="M15.75 0H5.625C4.38244 0 3.375 1.00744 3.375 2.25H4.5C4.5 1.62928 5.00484 1.125 5.625 1.125H15.75C16.3707 1.125 16.875 1.62928 16.875 2.25V12.375C16.875 12.9957 16.3707 13.5 15.75 13.5V14.625C16.9926 14.625 18 13.6176 18 12.375V2.25C18 1.00744 16.9926 0 15.75 0ZM12.375 3.375H2.25C1.00744 3.375 0 4.38244 0 5.625V15.75C0 16.9926 1.00744 18 2.25 18H12.375C13.6176 18 14.625 16.9926 14.625 15.75V5.625C14.625 4.38244 13.6176 3.375 12.375 3.375ZM13.5 15.75C13.5 16.3707 12.9957 16.875 12.375 16.875H2.25C1.62984 16.875 1.125 16.3707 1.125 15.75V5.625C1.125 5.00428 1.62984 4.5 2.25 4.5H12.375C12.9957 4.5 13.5 5.00428 13.5 5.625V15.75ZM3.375 7.875H11.25V6.75H3.375V7.875ZM3.375 10.125H11.25V9H3.375V10.125ZM3.375 12.375H11.25V11.25H3.375V12.375ZM3.375 14.625H7.875V13.5H3.375V14.625Z"
                      fill="#646464"/>
                </svg>
            </span>
            </div>
        </div>
    </div>
</div>
