<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    header('Content-Type: application/json; charset=UTF-8');

    $uploadDir = __DIR__ . '/../arquivos_css_versao/';
    if (!is_dir($uploadDir) && !@mkdir($uploadDir, 0775, true)) {
        http_response_code(500);
        echo json_encode(['error' => 'Não foi possível criar a pasta de destino.']);
        exit;
    }

    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        http_response_code(400);
        echo json_encode(['error' => 'Falha no upload (código ' . $_FILES['file']['error'] . ').']);
        exit;
    }

    $name = basename($_FILES['file']['name']);
    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    if ($ext !== 'csv') {
        http_response_code(400);
        echo json_encode(['error' => 'Apenas arquivos CSV são permitidos.']);
        exit;
    }

    if ($_FILES['file']['size'] > 5 * 1024 * 1024) {
        http_response_code(413);
        echo json_encode(['error' => 'Arquivo muito grande (máx. 5 MB).']);
        exit;
    }

    // Normaliza nome e evita sobrescrever
    $base = preg_replace('/[^a-zA-Z0-9._-]/', '_', pathinfo($name, PATHINFO_FILENAME));
    $safe = $base . '.csv';
    $dest = $uploadDir . $safe;
    $i = 1;
    while (file_exists($dest)) {
        $safe = $base . '_' . $i . '.csv';
        $dest = $uploadDir . $safe;
        $i++;
    }

    if (move_uploaded_file($_FILES['file']['tmp_name'], $dest)) {
        echo json_encode(['success' => true, 'file' => $safe]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Erro ao salvar o arquivo.']);
    }
    exit;
}
?>


<div class="gerar-wrap">
    <section id="gerar-versao">
        <!-- Links úteis -->
        <div class="tv-field" style="margin-bottom: 8px">
            <label class="tv-label">Links Úteis:</label>
            <div class="links-uteis">
                <a class="link-card" href="https://nia.bb.com.br/" target="_blank" rel="noopener">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M3.30457 15.9989L5.3111 13.9914L4.97715 13.6584C4.85606 13.5373 4.83809 13.3964 4.83809 13.3226C4.83809 13.2497 4.85606 13.1088 4.97715 12.9886L13.0052 4.96061C13.1253 4.84047 13.2663 4.82249 13.3391 4.82249C13.4129 4.82249 13.5539 4.84047 13.674 4.96156L14.0079 5.29551L16.0154 3.28803L15.6796 2.95409C14.4289 1.70249 12.2474 1.70344 10.9967 2.95314L2.96968 10.9811C2.34435 11.6055 2 12.438 2 13.3226C2 14.2071 2.34435 15.0387 2.96968 15.6649L3.30457 15.9989Z"
                              fill="#4668FF"/>
                        <path d="M20.6964 7.97088L18.6898 9.97741L19.0247 10.3123C19.2083 10.4958 19.2083 10.7957 19.0247 10.9802L10.9977 19.0073C10.8775 19.1283 10.7366 19.1463 10.6628 19.1463C10.589 19.1463 10.449 19.1283 10.3279 19.0082L9.993 18.6733L7.98647 20.6808L8.32137 21.0147C8.94669 21.6401 9.77825 21.9844 10.6628 21.9844C11.5473 21.9844 12.3789 21.6401 13.0042 21.0147L21.0322 12.9877C22.3226 11.6954 22.3226 9.59616 21.0322 8.30577L20.6964 7.97088Z"
                              fill="#4668FF"/>
                        <path d="M21.0317 4.96087L19.0251 2.95377L12.3342 9.64287L14.3407 11.65L21.0317 4.96087Z"
                              fill="#4668FF"/>
                        <path d="M11.6662 14.3253L9.65942 12.3185L2.97005 19.0078L4.97687 21.0147L11.6662 14.3253Z"
                              fill="#4668FF"/>
                    </svg>
                    <span class="link-title">NIA</span>
                    <span class="link-subtitle">Acessar</span>
                </a>
                <a class="link-card" href="https://genti.intranet.bb.com.br/" target="_blank" rel="noopener">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M3.30457 15.9989L5.3111 13.9914L4.97715 13.6584C4.85606 13.5373 4.83809 13.3964 4.83809 13.3226C4.83809 13.2497 4.85606 13.1088 4.97715 12.9886L13.0052 4.96061C13.1253 4.84047 13.2663 4.82249 13.3391 4.82249C13.4129 4.82249 13.5539 4.84047 13.674 4.96156L14.0079 5.29551L16.0154 3.28803L15.6796 2.95409C14.4289 1.70249 12.2474 1.70344 10.9967 2.95314L2.96968 10.9811C2.34435 11.6055 2 12.438 2 13.3226C2 14.2071 2.34435 15.0387 2.96968 15.6649L3.30457 15.9989Z"
                              fill="#4668FF"/>
                        <path d="M20.6964 7.97088L18.6898 9.97741L19.0247 10.3123C19.2083 10.4958 19.2083 10.7957 19.0247 10.9802L10.9977 19.0073C10.8775 19.1283 10.7366 19.1463 10.6628 19.1463C10.589 19.1463 10.449 19.1283 10.3279 19.0082L9.993 18.6733L7.98647 20.6808L8.32137 21.0147C8.94669 21.6401 9.77825 21.9844 10.6628 21.9844C11.5473 21.9844 12.3789 21.6401 13.0042 21.0147L21.0322 12.9877C22.3226 11.6954 22.3226 9.59616 21.0322 8.30577L20.6964 7.97088Z"
                              fill="#4668FF"/>
                        <path d="M21.0317 4.96087L19.0251 2.95377L12.3342 9.64287L14.3407 11.65L21.0317 4.96087Z"
                              fill="#4668FF"/>
                        <path d="M11.6662 14.3253L9.65942 12.3185L2.97005 19.0078L4.97687 21.0147L11.6662 14.3253Z"
                              fill="#4668FF"/>
                    </svg>
                    <span class="link-title">GENTI</span>
                    <span class="link-subtitle">Acessar</span>
                </a>
            </div>

        </div>

        <!-- Número / Tipo -->
        <div class="tv-grid-2" style="margin-top: 6px">
            <div class="tv-field">
                <label class="tv-label" for="nVersao">Numero da Versão</label>
                <input id="nVersao" class="tv-input" placeholder="Ex: 0123">
            </div>

            <div class="tv-field">
                <label class="tv-label" for="tx-type">Corpus:</label>
                <select id="tx-type-gerar" class="tv-select">
                    <option value="" selected disabled>Selecione</option>
                    <option value="tx_whatsapp">PF</option>
                    <option value="tx_padrao">PJ</option>
                </select>
            </div>

            <div class="tv-field">
                <label class="tv-label" for="tipoVersao">Tipo de versão</label>
                <select id="tipoVersao" class="tv-select">
                    <option value="" selected>Selecione</option>
                    <option value="programada">Programada</option>
                    <option value="excepcional">Excepcional</option>
                </select>
            </div>

            <div class="tv-field" id="fieldAutorizacao" style="display:none;">
                <label class="tv-label" for="autorizacao">Autorização</label>
                <input id="autorizacao" class="tv-input" placeholder="Informe a autorização">
            </div>
        </div>

        <div class="tv-field">
            <label class="tv-label" for="idConversa">ID da Conversa</label>
            <input id="idConversa" class="tv-input tv-input" value="">
        </div>

        <div class="tv-field">
            <label class="tv-label" for="observacao">Observação</label>
            <textarea id="observacao" class="tv-input" maxlength="500" rows="5" placeholder="Mensagem..."></textarea>
            <small id="obsCount" class="tv-muted">500 caracteres restantes</small>
        </div>

        <!-- Dropzone da aba Gerar Versão -->
        <div class="tv-field" style="margin-top: 12px">
            <label
                    id="dropzone-gerar"
                    for="fileCsvGerar"
                    class="dropzone-gerar"
                    role="button"
                    tabindex="0"
                    data-upload-url="/ferramentas/versionamento/tabs/gerar.php"
                    data-field="file"
            >
                <div class="dz-icon-gerar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M14.2767 7.92458V21.0918H16.9433V7.92458L21.334 12.4478L23.2193 10.5055L15.61 2.6665L8.00065 10.5055L9.88598 12.4478L14.2767 7.92458Z"
                              fill="#4668FF"/>
                        <path d="M24.0007 23.8388V26.586H8.00065V23.8388H5.33398V26.586C5.33398 28.0997 6.52865 29.3332 8.00065 29.3332H24.0007C25.4727 29.3332 26.6673 28.0997 26.6673 26.586V23.8388H24.0007Z"
                              fill="#4668FF"/>
                    </svg>
                </div>
                <div class="dz-text-gerar">
                    <b>Solte seus arquivos aqui ou clique para selecionar</b>
                    <small>Escolha o arquivo CSV</small>
                </div>
            </label>

            <input id="fileCsvGerar" type="file" accept=".csv" class="file-input-visually-hidden"/>

            <div id="uploadListGerar" class="upload-list-gerar"></div>
        </div>


        <!-- Ações -->
        <div class="tv-actions">
            <button id="btnRegistrar" disabled class="btn-registrar" class="tv-btn">
                <span class="tv-btn__spinner" aria-hidden="true"></span>
                <span class="tv-btn__text">REGISTRAR VERSÃO</span>
            </button>
        </div>
    </section>
</div>

<!-- Modal Confirmar Registro -->
<div id="modalConfirm" class="tv-modal" hidden>
    <div class="tv-modal__backdrop" data-close="1"></div>

    <div class="tv-modal__box" role="dialog" aria-modal="true" aria-labelledby="modalConfirmTitle">
        <button class="tv-modal__close" type="button" data-close="1" aria-label="Fechar">✕</button>

        <h2 id="modalConfirmTitle" class="tv-modal__title">
            Registrar versão <span id="mc-numero">—</span> ?
        </h2>
        <p class="tv-modal__subtitle">Revise os dados da sua versão abaixo:</p>

        <div class="tv-modal__content">
            <div class="mc-row">
                <div class="mc-label">Número da Versão:</div>
                <div class="mc-value" id="mc-versao">—</div>
            </div>

            <div class="mc-row">
                <div class="mc-label">Tipo de versão:</div>
                <div class="mc-value" id="mc-tipo">—</div>
            </div>

            <div class="mc-row">
                <div class="mc-label">Corpus:</div>
                <div class="mc-value" id="mc-corpus">—</div>
            </div>


            <!-- Autorização (aparece só quando houver) -->
            <div class="mc-row" id="mc-aut-wrap" style="display:none;">
                <div class="mc-label">Autorização:</div>
                <div class="mc-value" id="mc-aut">—</div>
            </div>

            <div class="mc-row">
                <div class="mc-label">ID da Conversa:</div>
                <div class="mc-value" id="mc-id">—</div>
            </div>

            <div class="mc-row">
                <div class="mc-label">Observação:</div>
                <div class="mc-value" id="mc-obs">—</div>
            </div>

            <div class="mc-row">
                <div class="mc-label">Tipo de arquivo:</div>
                <div class="mc-value">
                    <a id="mc-arquivo" href="#" target="_blank" rel="noopener">Arquivo.csv</a>
                </div>
            </div>
        </div>

        <div class="tv-modal__actions">
            <button type="button" class="btn-no" data-close="1">NÃO</button>
            <button type="button" class="btn-yes" id="mc-confirm">SIM</button>
        </div>
    </div>
</div>


<script>
    // ===== Estado compartilhado desta ABA =====
    let dataArray = [];

    // Elementos SOMENTE da aba "Gerar Versão"
    const dz = document.getElementById('dropzone-gerar');
    const input = document.getElementById('fileCsvGerar');
    const list = document.getElementById('uploadListGerar');

    // ===== Helpers =====
    function parseCSV(text) {
        return text.split('\n').map(r => r.split(','));
    }

    function updateButtonState() {
        const v = document.getElementById('nVersao').value.trim();
        const t = document.getElementById('tipoVersao').value.trim();
        const f = input.files.length > 0; // já está pegando do fileCsvGerar
        const a = document.getElementById('autorizacao')?.value.trim() || "";
        const precisaAut = (t === 'excepcional'); // só exige se o tipo for excepcional

        const btn = document.getElementById('btnRegistrar');
        btn.disabled = !(v && t && f && (!precisaAut || a));
    }

    // contador de observação
    (function () {
        const ta = document.getElementById('observacao');
        const cnt = document.getElementById('obsCount');
        if (!ta) return;
        const max = ta.maxLength || 500;
        const refresh = () => {
            const rest = Math.max(0, max - ta.value.length);
            cnt.textContent = `${rest} caracteres restantes`;
        };
        ta.addEventListener('input', refresh);
        refresh();
    })();

    // ===== Dropzone exclusiva desta aba =====
    (function () {
        function handleFile(file) {
            if (!file) return;

            // aceita só .csv
            if (!/\.csv$/i.test(file.name)) {
                alert('Apenas arquivos .csv são permitidos.');
                input.value = '';
                updateButtonState();
                return;
            }

            updateButtonState();

            // cria linha na lista e inicia upload
            const ui = makeUploadItem(file.name);
            list.appendChild(ui.item);
            uploadCsvGerar(file, ui);
        }

        // abre seletor via teclado
        dz.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                input.click();
            }
        });

        // clique abre o input
        dz.addEventListener('click', () => input.click());

        // drag & drop
        ['dragenter', 'dragover'].forEach(ev =>
            dz.addEventListener(ev, e => {
                e.preventDefault();
                dz.classList.add('dragover');
            })
        );
        ['dragleave', 'drop'].forEach(ev =>
            dz.addEventListener(ev, e => {
                e.preventDefault();
                dz.classList.remove('dragover');
            })
        );
        dz.addEventListener('drop', (e) => {
            const file = e.dataTransfer.files?.[0];
            if (file) {
                // opcional: refletir no input
                const dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
                handleFile(file);
            }
        });

        input.addEventListener('change', e => handleFile(e.target.files?.[0]));
    })();

    // habilita botão ao mudar campos
    ['nVersao', 'tipoVersao'].forEach(id =>
        document.getElementById(id).addEventListener('input', updateButtonState)
    );

    document.getElementById('btnRegistrar').addEventListener('click', (e) => {
        updateButtonState();
        const btn = e.currentTarget;
        if (btn.disabled) return;

        const versao = document.getElementById('nVersao').value.trim();
        const tipo = document.getElementById('tipoVersao').value.trim();
        const tipoLabel = tipo === 'excepcional' ? 'Excepcional' : 'Programada';
        const id = document.getElementById('idConversa').value.trim();
        const obs = document.getElementById('observacao').value.trim();
        const fileIn = document.getElementById('fileCsvGerar');
        const file = fileIn.files?.[0];
        const aut = document.getElementById('autorizacao')?.value.trim() || '';
        const corpusEl = document.getElementById('tx-type-gerar');
        let corpusLbl = '—';
        if (corpusEl && corpusEl.value) {
            corpusLbl = corpusEl.options[corpusEl.selectedIndex]?.text || '—';
        }


        // Preenche a modal
        document.getElementById('mc-numero').textContent = versao || '—';
        document.getElementById('mc-versao').textContent = versao || '—';
        document.getElementById('mc-tipo').textContent = tipoLabel || '—';
        document.getElementById('mc-id').textContent = id || '—';
        document.getElementById('mc-obs').textContent = obs || '—';
        document.getElementById('mc-corpus').textContent = corpusLbl;

        const autWrap = document.getElementById('mc-aut-wrap');
        if (tipo === 'excepcional' && aut) {
            autWrap.style.display = '';
            document.getElementById('mc-aut').textContent = aut;
        } else {
            autWrap.style.display = 'none';
            document.getElementById('mc-aut').textContent = '—';
        }

        const link = document.getElementById('mc-arquivo');
        if (file) {
            const url = URL.createObjectURL(file);
            link.href = url;
            link.textContent = file.name;
        } else {
            link.removeAttribute('href');
            link.textContent = '—';
        }

        openModalConfirm(); // abre a modal
    });


    // ===== Sua lógica de geração =====
    function registrar_tabela(motivo) {
        const versaoNumero = document.getElementById('nVersao').value;
        const dataHora = new Date();
        const ano = dataHora.getFullYear();
        const mes = (dataHora.getMonth() + 1).toString().padStart(2, '0');
        const dia = dataHora.getDate().toString().padStart(2, '0');
        const hora = dataHora.getHours().toString().padStart(2, '0');
        const minuto = dataHora.getMinutes().toString().padStart(2, '0');

        let dataFormatada = `${ano}-${mes}-${dia} 11:00`;
        if (motivo === 'excepcional') dataFormatada = `${ano}-${mes}-${dia} ${hora}:${minuto}`;

        const idConversa = document.getElementById('idConversa').value;
        const tabelaTarefas = dataArray.slice(1).map(row => {
            const columns = row[0].split('\t').map(item => item.replace(/"/g, ''));
            return columns.filter((_, index) => ![0, 3, 5, 6].includes(index));
        });
        if (tabelaTarefas[tabelaTarefas.length - 1].length === 0) tabelaTarefas.pop();

        const tabelaTarefasJson = tabelaTarefas.map(row => ({
            versao: versaoNumero,
            data_versao: dataFormatada,
            numero_tarefa: row[0],
            nome_tarefa: row[1],
            status: row[2],
            data_modificacao: row[3]
        }));
        console.log(tabelaTarefasJson);
    }

    // ===== UI item da lista =====
    function makeUploadItem(name) {
        const item = document.createElement('div');
        item.className = 'upload-item';

        // Ícone do arquivo (SVG)
        const icon = document.createElement('div');
        icon.className = 'upload-icon';
        icon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M15.8407 1H5.25C4.00912 1 3 1.9878 3 3.2V20.8C3 22.0133 4.00912 23 5.25 23H18.75C19.9909 23 21 22.0133 21 20.8V6.0446L15.8407 1ZM6.375 7H11.375V9.2H6.375V7ZM13.625 13.6H6.375V11.4H13.625V13.6ZM14.25 7.6V2.1L19.875 7.6H14.25ZM6.375 17.9V15.7H10.63V17.9H6.375Z"
                    fill="#4668FF"/>
            </svg>
        `;

        // Nome do arquivo
        const nm = document.createElement('div');
        nm.className = 'upload-name';
        nm.textContent = name;

        // Barra de progresso
        const track = document.createElement('div');
        track.className = 'upload-track';
        const bar = document.createElement('div');
        bar.className = 'upload-bar';
        track.appendChild(bar);

        // Porcentagem
        const pct = document.createElement('div');
        pct.className = 'upload-percent';
        pct.textContent = '0%';

        // Botão lixeira (SVG)
        const del = document.createElement('button');
        del.className = 'upload-delete';
        del.setAttribute('title', 'Remover');
        del.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M15 4.49949V2.50049H9V4.49949H5V6.49949H19V4.49949H15ZM6 7.49949V19.4995C6 20.6015 6.897 21.4995 8 21.4995H16C17.103 21.4995 18 20.6015 18 19.4995V7.49949H6ZM11 17.5005H9V11.5005H11V17.5005ZM15 17.5005H13V11.5005H15V17.5005Z"
                        fill="#888D95"/>
            </svg>
        `;

        // Monta na ordem: ícone, nome, barra, %, lixeira
        item.append(icon, nm, track, pct, del);

        return {item, bar, pct, del};
    }


    // ===== Upload exclusivo desta aba =====
    function uploadCsvGerar(file, ui) {
        // Lê localmente para sua lógica
        const reader = new FileReader();
        reader.onload = (ev) => {
            dataArray = parseCSV(ev.target?.result || '');
        };
        reader.readAsText(file);

        // URL e nome do campo vindos do label (data-*)
        const url = dz.dataset.uploadUrl;
        const name = dz.dataset.field || 'file';

        const form = new FormData();
        form.append(name, file);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', url);

        // progresso
        xhr.upload.addEventListener('progress', (e) => {
            if (!e.lengthComputable) return;
            const p = Math.round((e.loaded / e.total) * 100);
            ui.bar.style.width = p + '%';
            ui.pct.textContent = p + '%';
        });

        updateButtonState();

        // cancelar
        let aborted = false;
        ui.del.addEventListener('click', () => {
            aborted = true;
            try {
                if (xhr.readyState !== 4) xhr.abort();
            } catch {
            }
            ui.item.remove();
            input.value = '';
            updateButtonState();
        });

        // conclusão
        xhr.onreadystatechange = () => {
            if (xhr.readyState !== 4 || aborted) return;
            if (xhr.status >= 200 && xhr.status < 300) {
                ui.bar.style.width = '100%';
                ui.pct.textContent = '100%';
            } else {
                ui.item.classList.add('error');
                ui.pct.textContent = 'Erro';
            }
        };

        xhr.send(form);
    }

    // ===== valida se pode habilitar o botão =====
    function updateButtonState() {
        const nVersao = document.getElementById('nVersao')?.value.trim();
        const tipoVersao = document.getElementById('tipoVersao')?.value.trim();
        const idConversa = document.getElementById('idConversa')?.value.trim();
        const observacao = document.getElementById('observacao')?.value.trim();
        const fileInput = document.getElementById('fileCsvGerar');

        // precisa ter 1 arquivo selecionado
        const temArquivo = !!fileInput && fileInput.files && fileInput.files.length > 0;

        const tudoOK = nVersao && tipoVersao && idConversa && observacao && temArquivo;

        const btn = document.getElementById('btnRegistrar');
        if (btn) btn.disabled = !tudoOK;
    }

    function openModalConfirm() {
        const m = document.getElementById('modalConfirm');
        m.hidden = false;

        // fechar ao clicar fora/✕/NÃO
        m.querySelectorAll('[data-close]').forEach(el => {
            el.addEventListener('click', closeModalConfirm, {once: true});
        });

        // Esc para fechar
        const onEsc = (ev) => {
            if (ev.key === 'Escape') {
                closeModalConfirm();
            }
        };
        document.addEventListener('keydown', onEsc, {once: true});

        // Botão SIM
        const yes = document.getElementById('mc-confirm');
        yes.addEventListener('click', onConfirmOnce, {once: true});

        function onConfirmOnce() {
            // mantém visual de loading no botão principal (opcional)
            const tipoVal = document.getElementById('tipoVersao').value.trim();
            registrar_tabela(tipoVal);    // <- chama sua função existente
            closeModalConfirm();
        }

        function closeModalConfirm() {
            m.hidden = true;
        }
    }

    const tipoSelect = document.getElementById('tipoVersao');
    const fieldAut = document.getElementById('fieldAutorizacao');
    const inputAut = document.getElementById('autorizacao');

    tipoSelect.addEventListener('change', () => {
        if (tipoSelect.value === 'excepcional') {
            fieldAut.style.display = 'block';
        } else {
            fieldAut.style.display = 'none';
            inputAut.value = ''; // limpa se esconder
        }
        updateButtonState(); // atualiza validação do botão
    });
</script>
