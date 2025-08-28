<!-- TESTE DE CONDIÇÃO -->
<div class="condicao-wrap">

    <!-- Número da versão -->
    <div class="field">
        <label class="tv-label"  for="nVersaoParenteses">Número da Versão</label>
        <input type="text" id="nVersaoParenteses" class="tv-label" placeholder="Ex: 0123">
        <div id="erroVersao" class="mensagem-erro" style="display:none;">
            Preencha o número da versão!
        </div>
    </div>

    <div class="field">
        <label class="tv-label" for="tx-type">Corpus:</label>
        <select id="tx-type" class="tv-select">
            <option value="" selected disabled>Selecione</option>
            <option value="tx_whatsapp">PF</option>
            <option value="tx_padrao">PJ</option>
        </select>
    </div>

    <!-- Dropzone -->
    <form action="" method="post" enctype="multipart/form-data" id="formUploadJson">
        <label class="dropzone" id="dropzone" for="fileJson">
            <div class="dropzone-inner">
                <div class="upload-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M14.2767 7.92458V21.0918H16.9433V7.92458L21.334 12.4478L23.2193 10.5055L15.61 2.6665L8.00065 10.5055L9.88598 12.4478L14.2767 7.92458Z"
                              fill="#4668FF"/>
                        <path d="M24.0007 23.8388V26.586H8.00065V23.8388H5.33398V26.586C5.33398 28.0997 6.52865 29.3332 8.00065 29.3332H24.0007C25.4727 29.3332 26.6673 28.0997 26.6673 26.586V23.8388H24.0007Z"
                              fill="#4668FF"/>
                    </svg>
                </div>
                <div class="dropzone-title">Escolha o arquivo JSON da versão</div>
                <div class="dropzone-sub">Solte seus arquivos aqui ou clique para selecionar</div>
            </div>
            <input type="file" name="file" id="fileJson" accept=".json" hidden>
        </label>

        <div id="uploadList">
            <span class="file-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M15.8407 1H5.25C4.00912 1 3 1.9878 3 3.2V20.8C3 22.0133 4.00912 23 5.25 23H18.75C19.9909 23 21 22.0133 21 20.8V6.0446L15.8407 1ZM6.375 7H11.375V9.2H6.375V7ZM13.625 13.6H6.375V11.4H13.625V13.6ZM14.25 7.6V2.1L19.875 7.6H14.25ZM6.375 17.9V15.7H10.63V17.9H6.375Z"
                      fill="#4668FF"/>
                </svg>
            </span>
            <span id="uploadName">Arquivo.json</span>
            <div class="progress">
                <div id="progressBar"></div>
            </div>
            <span class="percent">0%</span>
            <button type="button" id="btnRemover" class="delete-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M15 4.49949V2.50049H9V4.49949H5V6.49949H19V4.49949H15ZM6 7.49949V19.4995C6 20.6015 6.897 21.4995 8 21.4995H16C17.103 21.4995 18 20.6015 18 19.4995V7.49949H6ZM11 17.5005H9V11.5005H11V17.5005ZM15 17.5005H13V11.5005H15V17.5005Z"
                          fill="#888D95"/>
                </svg>
            </button>
        </div>

        <button id="btnAvaliar">AVALIAR TESTE</button>

        <!-- mantém seu PHP existente -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['file'])) {
                $file = $_FILES['file'];
                if ($file['type'] == 'application/json' || pathinfo($file['name'], PATHINFO_EXTENSION) === 'json') {
                    $uploadDir = dirname(__DIR__) . '/';
                    $uploadFile = $uploadDir . 'dados.json';
                    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                        chmod($uploadFile, 0777);
                    } else {
                        echo "<p>Erro ao enviar o arquivo.</p>";
                    }
                } else {
                    echo "<p>Por favor, envie um arquivo JSON.</p>";
                }
            } else {
                echo "<p>Nenhum arquivo enviado.</p>";
            }
        }
        ?>
    </form>

    <section id="resultadoPanel" class="result-card" hidden>
        <div class="result-title">
            <span class="result-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M5 19V3H3V20C3 20.553 3.448 21 4 21H21V19H5Z" fill="#4668FF"/>
                <path d="M11 12.415L13.293 14.708C13.684 15.099 14.316 15.099 14.707 14.708L20.707 8.708L19.293 7.294L14 12.586L11.707 10.293C11.316 9.903 10.684 9.903 10.293 10.293L6.293 14.293L7.707 15.707L11 12.415Z"
                      fill="#4668FF"/>
                </svg>
            </span>
            Resultado da Análise
        </div>

        <div id="resultadoLoading" class="ring-wrap">
            <span class="ring-dot"></span>
            <span class="ring"></span>
        </div>

        <p id="resultadoStatus" class="result-muted">Analisando...</p>

        <!-- aqui entra a tabela/mensagem final -->
        <div id="resultadoConteudo"></div>
    </section>


    <!-- Analisar Condição -->
    <div class="field mt32">
        <label class="tv-label" for="condicao">Analisar Condição</label>
        <textarea id="condicao" class="field-textarea" placeholder="Cole aqui a condição de entrada"></textarea>
        <p id="textoResultadoCondicao" style="display:none"></p>
    </div>

</div>

<script>
    /* ========= Teste de Condição (novo front) ========= */
    (function initCondicao() {
        const form = document.getElementById('formUploadJson');
        const fileInput = document.getElementById('fileJson');
        const btnAvaliar = document.getElementById('btnAvaliar');
        const versaoInput = document.getElementById('nVersaoParenteses');

        const dropzone = document.getElementById('dropzone');
        const uploadList = document.getElementById('uploadList');
        const uploadName = document.getElementById('uploadName');
        const progressBar = document.getElementById('progressBar');
        const btnRemover = document.getElementById('btnRemover');
        const erroVersao = document.getElementById('erroVersao');

        let jsonFileSize = 0;

        // drag & drop
        ['dragenter', 'dragover'].forEach(ev =>
            dropzone.addEventListener(ev, e => {
                e.preventDefault();
                dropzone.classList.add('dragover');
            })
        );
        ['dragleave', 'drop'].forEach(ev =>
            dropzone.addEventListener(ev, e => {
                e.preventDefault();
                dropzone.classList.remove('dragover');
            })
        );
        dropzone.addEventListener('drop', e => {
            const f = e.dataTransfer.files?.[0];
            if (f) setFile(f);
        });
        dropzone.addEventListener('click', () => fileInput.click());

        // input file
        fileInput.addEventListener('change', () => {
            const f = fileInput.files?.[0];
            if (f) setFile(f); else resetFileUI();
        });

        // remover
        btnRemover.addEventListener('click', () => {
            fileInput.value = '';
            resetFileUI();
        });

        // submit
        form.addEventListener('submit', event => {
            event.preventDefault();

            try {
                if (!versaoInput.value.trim()) {
                    const erro = new Error("Preencha o número da versão!");
                    erro.name = "Versão em branco";
                    erroVersao.style.display = 'block';
                    versaoInput.focus();
                    throw erro;
                }
                if (!fileInput.files || !fileInput.files.length) {
                    const erro = new Error("Escolha um arquivo para testar!");
                    erro.name = "Sem arquivo";
                    throw erro;
                }
            } catch (error) {
                console.log(`${error.name}: ${error.message}`);
                return;
            }

            // agora sim: mostra o card com spinner
            showResultadoLoading();

            btnAvaliar.disabled = true;
            btnAvaliar.innerText = 'Subindo...';

            const formData = new FormData(form);
            fetch(form.action, {method: 'POST', body: formData})
                .then(response => {
                    if (response.ok) {
                        btnAvaliar.innerText = 'Testando...';
                        processarJSON_New(jsonFileSize);
                    } else {
                        btnAvaliar.disabled = false;
                        btnAvaliar.innerText = 'AVALIAR TESTE';
                        showResultadoContent('<div style="text-align:center;color:#b91c1c;background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:12px 14px;display:inline-block;">Erro no envio do arquivo</div>', 'Falha na análise');
                    }
                })
                .catch(error => {
                    console.log(`${error.name}: ${error.message}`);
                    btnAvaliar.disabled = false;
                    btnAvaliar.innerText = 'AVALIAR TESTE';
                    showResultadoContent('<div style="text-align:center;color:#b91c1c;background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:12px 14px;display:inline-block;">Falha de rede</div>', 'Falha na análise');
                });
        });

        // validação dinâmica da condição
        const condicaoInput = document.getElementById('condicao');
        const textoResultadoCondicao = document.getElementById('textoResultadoCondicao');
        condicaoInput.addEventListener('input', function () {
            const condicao = condicaoInput.value;
            if (condicao) {
                const {abertos, fechados} = contPar(condicao);
                if (abertos !== fechados) {
                    textoResultadoCondicao.innerText = `Opa!\nParênteses abertos: ${abertos}\nParênteses fechados: ${fechados}`;
                    textoResultadoCondicao.style.color = 'red';
                    textoResultadoCondicao.style.display = "block";
                } else {
                    textoResultadoCondicao.innerText = 'A quantidade de parênteses abertos é igual a de parênteses fechados.';
                    textoResultadoCondicao.style.color = 'green';
                    textoResultadoCondicao.style.display = 'block';
                }
            } else {
                textoResultadoCondicao.innerText = '';
                textoResultadoCondicao.style.display = 'none';
            }
        });

        // helpers UI
        function setFile(file) {
            if (!/\.json$/i.test(file.name)) {
                return;
            }
            jsonFileSize = file.size;
            uploadName.innerHTML = `<span class="file-badge">📄</span> ${file.name}`;
            uploadList.hidden = false;

            progressBar.style.width = '0%';
            let p = 0;
            const timer = setInterval(() => {
                p += 15;
                progressBar.style.width = Math.min(p, 100) + '%';
                if (p >= 100) {
                    clearInterval(timer);
                    btnAvaliar.disabled = false;
                }
            }, 80);
        }

        function resetFileUI() {
            uploadList.hidden = true;
            uploadName.textContent = '';
            progressBar.style.width = '0%';
            btnAvaliar.disabled = true;
        }

        window.__setFileSizeForCondicao = s => jsonFileSize = s;
    })();

    /* ========= processarJSON usando o card de resultado ========= */
    async function processarJSON_New(fileSize) {
        const button = document.getElementById('btnAvaliar');
        const form = document.getElementById('formUploadJson');

        limparContexto();

        loadJSON(async function (response) {
            // spinner já está ativo por showResultadoLoading()

            let dados = JSON.parse(response);
            let listNodos;
            let nosComProblema = {};
            let dictNos = {};
            let deuErro = false;

            const versao = document.getElementById('nVersaoParenteses').value;

            if (fileSize < 50000000) {
                listNodos = dados.dialog_nodes;
                nosComProblema = acharNosProblematicosJsonResumido(listNodos, nosComProblema);
            } else {
                listNodos = dados.nos;
                dictNos = await percorreNodos(listNodos, dictNos);
                nosComProblema = acharNosProblematicosJsonLongo(dictNos, nosComProblema);
            }

            // ===== monta o painel de resultados no layout novo =====
            const wrap = document.createElement('div');

            const hint = document.createElement('p');
            hint.className = 'result-hint';
            hint.textContent = 'Os seguintes nós apresentaram diferenças na quantidade de condições';
            wrap.appendChild(hint);

            const list = document.createElement('div');
            list.className = 'result-list';

            // Cabeçalho
            const header = document.createElement('div');
            header.className = 'result-col-title';
            header.innerHTML = `
            <div>Hash:</div>
            <div style="text-align:center">Parênteses</div>
            <div style="text-align:center">Aspas</div>
            <div style="text-align:center">Variáveis de Contexto</div>
            `;
            list.appendChild(header);

            // Função util pra montar cada status
            const statusNode = (status, label) => {
                const div = document.createElement('div');
                div.className = `status ${status}`;
                div.innerHTML = `<span class="dot"></span><span class="txt">${label}</span>`;
                return div;
            };

            // Lista de hashes com problemas de parênteses
            const idsComProblema = Object.keys(nosComProblema);

            if (idsComProblema.length > 0) {
                deuErro = true;

                idsComProblema.forEach(id => {
                    const item = document.createElement('div');
                    item.className = 'result-item';

                    const row = document.createElement('div');
                    row.className = 'result-row';

                    // Hash
                    const colHash = document.createElement('div');
                    colHash.innerHTML = `<span class="badge-hash">${id}</span>`;
                    row.appendChild(colHash);

                    // Parênteses -> vermelho (bad) porque está em nosComProblema
                    row.appendChild(statusNode('bad', ''));
                    // Aspas -> não verificado (na) por enquanto
                    row.appendChild(statusNode('na', ''));
                    // Variáveis -> não verificado (na) por enquanto
                    row.appendChild(statusNode('na', ''));

                    item.appendChild(row);
                    list.appendChild(item);
                });

                wrap.appendChild(list);
                showResultadoContent(wrap, 'Problemas encontrados');
            } else {
                // Sem problemas
                showResultadoContent(
                    '<div style="text-align:center;color:#166534;background:#ecfdf5;border:1px solid #bbf7d0;border-radius:8px;padding:12px 14px;display:inline-block;">Não foram encontrados nós com problemas</div>',
                    'Análise concluída'
                );
            }

            // ===== LOG mantém igual =====
            const logData = {
                dataHora: new Date().toISOString().slice(0, 19).replace('T', ' '),
                versao: versao,
                deuErro: deuErro,
                nosComProblema: JSON.stringify(nosComProblema).replace(/"/g, ''),
                tabela: 'logs_parenteses'
            };
            salvarLog(logData);

            // Reset
            form.reset();
            document.getElementById('uploadList').hidden = true;
            document.getElementById('progressBar').style.width = '0%';
            document.getElementById('uploadName').textContent = '';
            button.innerText = 'AVALIAR TESTE';
            button.disabled = true;
        });
    }

    /* ===== helpers do card ===== */
    function showResultadoLoading() {
        const panel = document.getElementById('resultadoPanel');
        const load = document.getElementById('resultadoLoading');
        const status = document.getElementById('resultadoStatus');
        const cont = document.getElementById('resultadoConteudo');

        cont.innerHTML = '';
        status.textContent = 'Analisando...';
        load.style.display = 'block';
        panel.hidden = false;
    }

    function showResultadoContent(htmlOrNode, statusText) {
        const load = document.getElementById('resultadoLoading');
        const status = document.getElementById('resultadoStatus');
        const cont = document.getElementById('resultadoConteudo');

        load.style.display = 'none';
        if (statusText) status.textContent = statusText;
        if (typeof htmlOrNode === 'string') cont.innerHTML = htmlOrNode;
        else {
            cont.innerHTML = '';
            cont.appendChild(htmlOrNode);
        }
    }

    async function loadJSON(callback) {
        var xobj = new XMLHttpRequest();
        xobj.overrideMimeType('application/json');
        xobj.open('GET', 'dados.json', true);
        xobj.onreadystatechange = function () {
            if (xobj.readyState == 4 && xobj.status == '200') {
                callback(xobj.responseText);
            }
        };
        xobj.send(null);
    }

    function limparContexto() {
        document.getElementById('textoResultadoCondicao').innerHTML = '';
    }

    function salvarLog(logData) {
        var caminhoController = '/ferramentas/versionamento/controller.php';
        fetch(caminhoController, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                request: 'salvarLog',
                ...logData
            })
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.mensagem === "Sucesso") {
                    console.log('Log salvo com sucesso:', data);
                    const idLog = data.id_log || "Desculpe, não foi possível consultar";
                    // exibirMensagemTemporaria('Teste finalizado com sucesso e logs gravados no banco de dados!');
                } else {
                    console.warn('Erro no retorno do controller:', data);
                }
            })
            .catch((error) => {
                // exibirMensagemTemporaria('Erro ao salvar o log. Tente novamente mais tarde.', 5000);
            });

    }

    const fileInput = document.getElementById('fileJson');
    const uploadName = document.getElementById('uploadName');
    const progressBar = document.getElementById('progressBar');
    const percentText = document.querySelector('#uploadList .percent');

    fileInput.addEventListener('change', function () {
        if (this.files.length > 0) {
            const file = this.files[0];
            uploadName.textContent = file.name;
            progressBar.style.width = '0%';
            percentText.textContent = '100%';
        } else {
            // volta para padrão
            uploadName.textContent = 'Arquivo.json';
            progressBar.style.width = '0%';
            percentText.textContent = '0%';
        }
    });

</script>

