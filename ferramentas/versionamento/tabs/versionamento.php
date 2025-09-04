<div class="versionamento-wrap">
    <section id="input-section" class="tv-card">
        <div class="tv-grid-2">
            <div class="tv-field">
                <label class="tv-label" for="nVersaoTab">Número da Versão</label>
                <input id="nVersaoTab" class="tv-input" placeholder="Ex: 0123">
                <div id="erroVersaoTab" class="tv-error" hidden>Preencha o número da versão.</div>
            </div>

            <div class="tv-field">
                <label class="tv-label" for="tx-type">Escolha o tipo de resposta para comparar:</label>
                <select id="tx-type" class="tv-select">
                    <option value="" selected disabled>Selecione</option>
                    <option value="tx_whatsapp">WhatsApp</option>
                    <option value="tx_padrao">Padrão</option>
                </select>
            </div>

            <div class="tv-field full-width">
                <label class="tv-label" for="tx-type">Corpus:</label>
                <select id="tx-corpus" class="tv-select corpus-select" disabled>
                    <option value="" selected disabled>Selecione</option>
                    <option value="tx_whatsapp">PF</option>
                    <option value="tx_padrao">PJ</option>
                </select>
            </div>

            <div class="tv-field">
                <label class="tv-label" for="custom-inputs">Caso necessário, inclua inputs adicionais ao teste
                    padrão:</label>
                <input type="text" id="custom-inputs" class="tv-input" placeholder="Digite os inputs separados por ;">
            </div>
        </div>

        <button id="botaoAnaliseVersao" class="tv-btn" onclick="compararResultados()">
            <span class="tv-btn__spinner" aria-hidden="true"></span>
            <span class="tv-btn__text">AVALIAR TESTE</span>
        </button>
    </section>

    <section id="analysis-result" class="tv-card tv-card--result" hidden>
        <div class="tv-result-title">
            <span class="tv-result-ic">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M5 19V3H3V20C3 20.553 3.448 21 4 21H21V19H5Z" fill="#4668FF"/>
                <path d="M11 12.415L13.293 14.708C13.684 15.099 14.316 15.099 14.707 14.708L20.707 8.708L19.293 7.294L14 12.586L11.707 10.293C11.316 9.903 10.684 9.903 10.293 10.293L6.293 14.293L7.707 15.707L11 12.415Z"
                      fill="#4668FF"/>
                </svg>
            </span>
            <h3 class="tv-title">Resultado da Análise</h3>
        </div>

        <!-- Loading -->
        <div id="tv-resp-loading" class="tv-resp-loading" hidden>
            <span class="tv-ring__dot"></span>
            <span class="tv-ring__ring"></span>
            <div class="tv-muted" style="margin-top:6px">Analisando...</div>
        </div>

        <!-- Linhas finais (mostradas quando terminar) -->
        <p id="id-log" class="tv-muted tv-center">ID do teste: —</p>
        <p class="tv-result-line">Total de diferenças encontradas: <strong id="total-diferencas">0</strong></p>
        <p class="tv-result-line">Total de erros encontrados na versão de teste: <strong id="total-erros">0</strong></p>

        <div id="error-details-section" class="tv-errors"></div>
    </section>


    <section id="tv-accordion" class="tv-accordion" hidden>
        <button class="tv-acc-btn" type="button" aria-expanded="true" aria-controls="acc-body">
            <span class="exibir_teste">Exibir teste</span>
            <span class="tv-acc-caret">▾</span>
        </button>
        <div id="acc-body" class="tv-acc-body">
            <div class="tv-toolbar">
                <label class="tv-label" for="tv-filtro">Filtrar por:</label>
                <div class="tv-filter">
                    <select id="tv-filtro" class="tv-select tv-select--sm">
                        <option value="todas">Selecione</option>
                        <option value="alteradas">Alteradas</option>
                        <option value="erros">Erros</option>
                    </select>
                </div>
            </div>

            <div id="result-section" class="tv-columns">
                <div class="results">
                    <h4 class="tv-subtitle">
                        <span class="tv-sub-ic">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24"
                                 fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M4.5 2C3.39543 2 2.5 2.89492 2.5 3.99885V21.299C2.5 21.9223 3.254 22.2344 3.69497 21.7937L8.5 16.9914H20.5C21.6046 16.9914 22.5 16.0965 22.5 14.9926V3.99886C22.5 2.89492 21.6046 2 20.5 2H4.5ZM6.5 5.99771H18.5V7.99657H6.5V5.99771ZM14.5 9.99542H6.5V11.9943H14.5V9.99542Z"
                                  fill="#4668FF"/>
                            </svg>
                        </span> Respostas da Versão Antiga
                        <small>(Rascunho)</small></h4>
                    <div id="resultado-teste"></div>
                </div>
                <div class="results">
                    <h4 class="tv-subtitle">
                            <span class="tv-sub-ic">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M13.5293 2C12.5788 3.0616 12 4.46293 12 6C12 9.31371 14.6863 12 18 12C19.5371 12 20.9384 11.4212 22 10.4707V14.9922C22 16.0961 21.1046 16.9912 20 16.9912H8L3.19531 21.7939C2.75434 22.2347 2 21.9221 2 21.2988V3.99902C2 2.89509 2.89543 2 4 2H13.5293ZM5.9375 12H11.9375V10H5.9375V12ZM5.9375 7.9375H9.0625V5.9375H5.9375V7.9375Z"
                                  fill="#4668FF"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19 5V2H17V5H14V7H17V10H19V7H22V5H19Z"
                                  fill="#4668FF"/>
                            </svg>
                            </span> Respostas da Versão Atual
                        <small>(Produção)</small></h4>
                    <div id="resultado-prod"></div>
                </div>
            </div>
        </div>
    </section>
</div>


<script>
    (function () {

        const btn = document.getElementById('botaoAnaliseVersao');
        if (btn) {
            const original = btn.getAttribute('onclick');
            btn.removeAttribute('onclick');

            btn.addEventListener('click', async () => {
                const nv = document.getElementById('nVersaoTab');
                const err = document.getElementById('erroVersaoTab');
                if (nv && !nv.value.trim()) {
                    err.hidden = false;
                    nv.focus();
                    return;
                } else if (err) {
                    err.hidden = true;
                }

                const resultCard = document.getElementById('analysis-result');
                const loader = document.getElementById('tv-resp-loading');
                const lines = document.querySelectorAll('#analysis-result #id-log, #analysis-result .tv-result-line');

                // mostra SOMENTE loader
                resultCard.hidden = false;
                loader.hidden = false;
                lines.forEach(el => el.hidden = true);

                btn.classList.add('is-loading');
                btn.disabled = true;

                try {
                    await (new Function(original)).call(window);
                } finally {
                    loader.hidden = false; // mantém loader visível até finalizar
                    setTimeout(() => {
                        loader.hidden = true; // esconde loader
                        lines.forEach(el => el.hidden = false); // mostra linhas finais

                        // Exibe o acordeão "Exibir teste"
                        const acc = document.getElementById('tv-accordion');
                        if (acc) {
                            acc.hidden = false;

                            // Abre se houver diferenças ou erros
                            const dif = parseInt(document.getElementById('total-diferencas')?.textContent || '0', 10);
                            const err = parseInt(document.getElementById('total-erros')?.textContent || '0', 10);
                            const accBtn = acc.querySelector('.tv-acc-btn');
                            if (accBtn) {
                                accBtn.setAttribute('aria-expanded', 'true');
                            }
                        }
                    }, 300); // pequeno delay para suavizar transição

                    btn.classList.remove('is-loading');
                    btn.disabled = false;
                    resultCard.scrollIntoView({behavior: 'smooth'});
                }
            });


        }

        // Accordion
        const accBtn = document.querySelector('.tv-acc-btn');
        const accBody = document.getElementById('acc-body');
        if (accBtn && accBody) {
            accBtn.addEventListener('click', () => {
                const expanded = accBtn.getAttribute('aria-expanded') === 'true';
                accBtn.setAttribute('aria-expanded', String(!expanded));
            });
        }

        // Filtro
        const filtro = document.getElementById('tv-filtro');
        const chips = document.querySelectorAll('.tv-chip');

        function applyFilter(val) {
            const cards = document.querySelectorAll('#resultado-teste .expansion-panel, #resultado-prod .expansion-panel');
            cards.forEach(c => {
                const isDiff = c.classList.contains('has-diff');
                const isErr = c.classList.contains('has-error');
                let show = true;
                if (val === 'alteradas') show = isDiff;
                if (val === 'erros') show = isErr;
                c.style.display = show ? '' : 'none';
            });
            chips.forEach(ch => ch.classList.toggle('active', ch.dataset.filter === val));
            if (filtro) filtro.value = val || 'todas';
        }

        filtro?.addEventListener('change', () => applyFilter(filtro.value));
        chips.forEach(ch => ch.addEventListener('click', () => applyFilter(ch.dataset.filter)));
    })();
</script>
