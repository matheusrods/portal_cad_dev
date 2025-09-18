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
            <p><strong>Versão:</strong> <span id="detalhe-versao"></span></p>
            <p><strong>Responsável:</strong> <span id="detalhe-responsavel"></span></p>
            <p><strong>Data:</strong> <span id="detalhe-data"></span></p>
            <p><strong>Hora:</strong> <span id="detalhe-hora"></span></p>
            <p><strong>Motivo:</strong> <span id="detalhe-motivo"></span></p>
            <p><strong>Corpus:</strong> <span id="detalhe-corpus"></span></p>
        </div>
        <div class="detalhes-obs">
            <p><strong>Observações:</strong></p>
            <p id="detalhe-obs">
                Visualização clara e intuitiva de dados importantes, permitindo decisões mais assertivas e reduzindo
                tempo de análise manual.
            </p>
        </div>
    </div>

    <!-- Tabs -->
    <nav class="detalhes-tabs">
        <div class="detalhes-tab-button active" onclick="selectDetalhesTab('tarefas', this)">Tarefas</div>
        <div class="detalhes-tab-button" onclick="selectDetalhesTab('parenteses', this)">Teste de Parênteses</div>
        <div class="detalhes-tab-button" onclick="selectDetalhesTab('versionamento', this)">Teste de Versionamento</div>
        <div class="detalhes-tab-button" onclick="selectDetalhesTab('conversa', this)">Conversa</div>
    </nav>

    <!-- Conteúdos -->
    <div class="detalhes-tab-content active" id="tab-tarefas">
        <div class="tarefa-card">
            <div class="tarefa-col">
                <strong>Tarefa</strong>
                <a href="#">2138098</a>
            </div>
            <div class="tarefa-col">
                <strong>Nome</strong>
                [CONSULTORIA] [DEV] [SEGURIDADE] [TRN] Contratação Seguro Itens Pessoais Não Correntista
            </div>
            <div class="tarefa-col status-col">
                <strong>Status</strong>
                <span class="status status-pronta">Pronta</span>
            </div>
        </div>

        <div class="tarefa-card">
            <div class="tarefa-col">
                <strong>Tarefa</strong>
                <a href="#">2138099</a>
            </div>
            <div class="tarefa-col">
                <strong>Nome</strong>
                [CONSULTORIA] [DEV] [SEGURIDADE] [TRN] Validação de Processos Internos
            </div>
            <div class="tarefa-col status-col">
                <strong>Status</strong>
                <span class="status status-andamento">Em andamento</span>
            </div>
        </div>

        <div class="tarefa-card">
            <div class="tarefa-col">
                <strong>Tarefa</strong>
                <a href="#">2138100</a>
            </div>
            <div class="tarefa-col">
                <strong>Nome</strong>
                [CONSULTORIA] [DEV] [ANÁLISE] Teste de Integração com Sistema X
            </div>
            <div class="tarefa-col status-col">
                <strong>Status</strong>
                <span class="status status-pronta">Pronta</span>
            </div>
        </div>

        <div class="tarefa-card">
            <div class="tarefa-col">
                <strong>Tarefa</strong>
                <a href="#">2138101</a>
            </div>
            <div class="tarefa-col">
                <strong>Nome</strong>
                [CONSULTORIA] [DEV] [SUPORTE] Ajustes Pós-Deploy Produção
            </div>
            <div class="tarefa-col status-col">
                <strong>Status</strong>
                <span class="status status-andamento">Em andamento</span>
            </div>
        </div>
    </div>

    <div class="detalhes-tab-content" id="tab-parenteses">
        <div class="parenteses-card">
            <div class="parenteses-linha">
                <div class="hash">
                    <strong>Hash:</strong> 00003204023-0402304302-40320403
                    <span class="copy-icon">📋</span>
                </div>
                <div class="parenteses-resultados">
                    <div class="resultado">
                        Parênteses
                        <span class="status-icone success">✔</span>
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

        <div class="parenteses-card">
            <div class="parenteses-linha">
                <div class="hash">
                    <strong>Hash:</strong> 00003204023-0402304302-40320403
                    <span class="copy-icon">📋</span>
                </div>
                <div class="parenteses-resultados">
                    <div class="resultado">
                        Parênteses
                        <span class="status-icone success">✔</span>
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
                    <span class="versao-icone"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24"
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
                        <span class="resposta-icone"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M10.293 9.293L11.707 10.707L15.414 7L11.707 3.293L10.293 4.707L11.586 6H6V8H11.586L10.293 9.293ZM9.707 15.293L8.414 14H14V12H8.414L9.707 10.707L8.293 9.293L4.586 13L8.293 16.707L9.707 15.293ZM18 0H2C0.896 0 0 0.896 0 2V18C0 19.102 0.896 20 2 20H18C19.104 20 20 19.102 20 18V2C20 0.896 19.104 0 18 0ZM17.997 18H2V2H18L17.997 18Z"
              fill="#4668FF"/>
      </svg></span>
                    </div>
                    <div class="resposta-item">
                        <span class="label">Input:</span>
                        <span class="texto">Oi</span>
                        <span class="resposta-icone"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M10.293 9.293L11.707 10.707L15.414 7L11.707 3.293L10.293 4.707L11.586 6H6V8H11.586L10.293 9.293ZM9.707 15.293L8.414 14H14V12H8.414L9.707 10.707L8.293 9.293L4.586 13L8.293 16.707L9.707 15.293ZM18 0H2C0.896 0 0 0.896 0 2V18C0 19.102 0.896 20 2 20H18C19.104 20 20 19.102 20 18V2C20 0.896 19.104 0 18 0ZM17.997 18H2V2H18L17.997 18Z"
              fill="#4668FF"/>
      </svg></span>
                    </div>
                    <div class="resposta-item">
                        <span class="label">Input:</span>
                        <span class="texto">Oi</span>
                        <span class="resposta-icone"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
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
                    <span class="versao-icone"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
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
                        <span class="resposta-icone"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M10.293 9.293L11.707 10.707L15.414 7L11.707 3.293L10.293 4.707L11.586 6H6V8H11.586L10.293 9.293ZM9.707 15.293L8.414 14H14V12H8.414L9.707 10.707L8.293 9.293L4.586 13L8.293 16.707L9.707 15.293ZM18 0H2C0.896 0 0 0.896 0 2V18C0 19.102 0.896 20 2 20H18C19.104 20 20 19.102 20 18V2C20 0.896 19.104 0 18 0ZM17.997 18H2V2H18L17.997 18Z"
              fill="#4668FF"/>
      </svg></span>
                    </div>
                    <div class="resposta-item">
                        <span class="label">Input:</span>
                        <span class="texto">Oi</span>
                        <span class="resposta-icone"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M10.293 9.293L11.707 10.707L15.414 7L11.707 3.293L10.293 4.707L11.586 6H6V8H11.586L10.293 9.293ZM9.707 15.293L8.414 14H14V12H8.414L9.707 10.707L8.293 9.293L4.586 13L8.293 16.707L9.707 15.293ZM18 0H2C0.896 0 0 0.896 0 2V18C0 19.102 0.896 20 2 20H18C19.104 20 20 19.102 20 18V2C20 0.896 19.104 0 18 0ZM17.997 18H2V2H18L17.997 18Z"
              fill="#4668FF"/>
      </svg></span>
                    </div>
                    <div class="resposta-item">
                        <span class="label">Input:</span>
                        <span class="texto">Oi</span>
                        <span class="resposta-icone"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
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
      <span class="conversa-icone">📋</span>
    </div>
  </div>

  <div class="conversa-card">
    <div class="conversa-linha">
      <span class="conversa-label">Id conversa:</span>
      <span class="conversa-texto">2324325438583475-78378654876544554456b-323reew2334234</span>
      <span class="conversa-icone">📋</span>
    </div>
  </div>
</div>


</div>
