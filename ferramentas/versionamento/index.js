//Passo a passo

function openModal(obj) {
    obj.parentNode.querySelector('.thumbnail').style.display = 'none';
    obj.parentNode.querySelector('.modal').style.display = 'block';
}

function closeModal(obj) {
    obj.parentNode.querySelector('.thumbnail').style.display = 'block';
    obj.parentNode.querySelector('.modal').style.display = 'none';
}

function detalharPasso(el) {
    const passo = el.closest('.passoAPassoSessao');
    document.querySelectorAll('.passoAPassoSessao').forEach(p => {
        if (p !== passo) p.classList.remove('ativo');
    });
    passo.classList.toggle('ativo');
}


//Parênteses

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

function percorreNodos(nodos, dictNos) {
    nodos.forEach(nodo => {
        dictNos[nodo.uuid] = nodo;
        let filhos = nodo.filhos;
        let slots = nodo.slots;
        if (filhos.length >= 0) {
            percorreNodos(filhos, dictNos);
        }
        try {
            if (slots.length >= 0) {
                percorreNodos(slots, dictNos);
            }
        } catch (error) {
            // Continue
        }
    });
    return dictNos;
}

function contPar(string) {
    let abertos = 0;
    let fechados = 0;
    let aspas = 0;
    let aspasAberta = false;
    if (string !== null) {
        for (let char of string) {
            if (char === '(') {
                abertos += 1;
            } else if (char === ')') {
                fechados += 1;
            }
            if (char === '"' || char === "'") {
                aspasAberta = true;
            }
        }
    }
    // else{
    //     abertos = -1;
    // }
    return {abertos, fechados};
}

function acharNosProblematicosJsonLongo(dictNos, nosComProblema) {
    for (let hash in dictNos) {
        let nodo = dictNos[hash];
        let {abertos, fechados} = contPar(nodo.condicao);
        if (Object.hasOwn(nodo, 'condicaoSlots') && nodo.condicaoSlots !== null) {
            let {abertos, fechados} = contPar(nodo.condicaoSlots);
            if (abertos !== fechados) {
                nosComProblema[hash] = {abertos, fechados};
            }
        } else if (abertos !== fechados) {
            nosComProblema[hash] = {abertos, fechados};
        }
    }
    ;
    return nosComProblema;
}

function acharNosProblematicosJsonResumido(listNodos, nosComProblema) {
    for (var i = 0; i < listNodos.length; i++) {
        if (Object.hasOwn(listNodos[i], 'conditions')) {
            let {abertos, fechados} = contPar(listNodos[i].conditions);
            if (abertos !== fechados) {
                nosComProblema[(listNodos[i].dialog_node).slice(-36)] = {abertos, fechados};
            }
        }
    }
    ;
    return nosComProblema;
}

function limparContexto() {
    document.getElementById('textoResultado').innerHTML = '';
    const div = document.getElementById('resultadoAnaliseParenteses');
    const tabelas = div.getElementsByTagName('table');
    while (tabelas.length > 0) {
        tabelas[0].parentNode.removeChild(tabelas[0]);
    }
}

// async function processarJSON_old() {
//     const button = document.getElementById('botaoAnaliseJson');
//     button.disabled = true;
//     button.innerText = 'Analisando...';
//     limparContexto();
//     loadJSON(async function(response) {
//         document.getElementById('textoResultado').innerHTML = 'Analisando...'
//         let dados = JSON.parse(response);
//         let listNodos = dados.nos;
//         let dictNos = {};
//         dictNos = await percorreNodos(listNodos, dictNos);
//         let nosComProblema = {};
//         // let nosSemTag = [];
//         nosComProblema = acharNosProblematicos(dictNos, nosComProblema);
//         if (Object.keys(nosComProblema).length > 0) {
//             document.getElementById('textoResultado').innerHTML = 'Os seguintes nós apresentaram diferença na quantidade de parênteses abertos e fechados:';
//             const resultado = document.getElementById('resultadoAnaliseParenteses');
//             tbl = document.createElement('table');
//             tbl.style.width = 'auto';
//             tbl.style.borderCollapse = 'collapse';
//             const tableHeader = tbl.createTHead();
//             const headerRow = document.createElement('tr');
//             const headerTextArray = ['Hash', 'Abertos', 'Fechados'];
//             headerTextArray.forEach(text => {
//                 const headerCell = document.createElement('th');
//                 headerCell.textContent = text;
//                 headerCell.style.textAlign = 'center';
//                 headerRow.appendChild(headerCell);
//             });
//             tableHeader.appendChild(headerRow);
//             for (let id in nosComProblema) {
//                 let par = nosComProblema[id];
//                 const tr = tbl.insertRow();
//                 const td1 = tr.insertCell();
//                 td1.appendChild(document.createTextNode(`${id}`));
//                 const td2 = tr.insertCell();
//                 td2.appendChild(document.createTextNode(`${par.abertos}`));
//                 const td3 = tr.insertCell();
//                 td3.appendChild(document.createTextNode(`${par.fechados}`));
//             }
//             resultado.appendChild(tbl);
//         } else {
//             document.getElementById('textoResultado').innerHTML = 'Não foram encontrados nós com problemas de parênteses';
//         }
//         button.disabled = false;
//         button.innerText = 'Analisar';
//         // Remove o arquivo dados.json após a verificação
//         var xobj = new XMLHttpRequest();
//         xobj.open('DELETE', 'dados.json', true);
//         xobj.send(null);
//     });
// }

async function processarJSON() {
    const button = document.getElementById('botaoAnaliseJson');
    limparContexto();
    loadJSON(async function (response) {
        document.getElementById('textoResultado').innerHTML = 'Analisando...'
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
        if (Object.keys(nosComProblema).length > 0) {
            deuErro = true;
            document.getElementById('textoResultado').innerHTML = 'Os seguintes nós apresentaram diferença na quantidade de parênteses abertos e fechados:';
            const resultado = document.getElementById('resultadoAnaliseParenteses');
            tbl = document.createElement('table');
            tbl.style.width = 'auto';
            tbl.style.borderCollapse = 'collapse';
            const tableHeader = tbl.createTHead();
            const headerRow = document.createElement('tr');
            const headerTextArray = ['Hash', 'Abertos', 'Fechados'];
            headerTextArray.forEach(text => {
                const headerCell = document.createElement('th');
                headerCell.textContent = text;
                headerCell.style.textAlign = 'center';
                headerRow.appendChild(headerCell);
            });
            tableHeader.appendChild(headerRow);
            for (let id in nosComProblema) {
                let par = nosComProblema[id];
                const tr = tbl.insertRow();
                const td1 = tr.insertCell();
                td1.appendChild(document.createTextNode(`${id}`));
                const td2 = tr.insertCell();
                td2.appendChild(document.createTextNode(`${par.abertos}`));
                const td3 = tr.insertCell();
                td3.appendChild(document.createTextNode(`${par.fechados}`));
            }
            resultado.appendChild(tbl);
        } else {
            document.getElementById('textoResultado').innerHTML = 'Não foram encontrados nós com problemas de parênteses';
        }

        const logData = {
            dataHora: new Date().toISOString().slice(0, 19).replace('T', ' '),
            versao: versao,
            deuErro: deuErro,
            nosComProblema: JSON.stringify(nosComProblema).replace(/"/g, ''),
            tabela: 'logs_parenteses'
        };

        console.log(logData);
        salvarLog(logData);

        exibirMensagemTemporaria('Teste finalizado!')
        document.getElementById('arquivoJson').reset();
        document.getElementById('arquivo').textContent = 'Nenhum arquivo selecionado';
        button.innerText = 'Testar';

        // Remove o arquivo dados.json após a verificação (servidor não permite, descomentar quando alterado)
        // var xobj = new XMLHttpRequest();
        // xobj.open('DELETE', 'dados.json', true);
        // xobj.send(null);
    });
}

let dadosTesteVersionamento = [];

async function pegarLinha(versao) {
    var caminhoController = 'https://cad.bb.com.br/ferramentas/versionamento/controller.php';
    fetch(caminhoController, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            request: 'recuperarLog',
            versao: versao
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
                // console.log('Dados retornados com sucesso:', data);
                dadosTesteVersionamento = data;
            } else {
                console.warn('Erro no retorno do controller:', data);
            }
        })
        .catch((error) => {
            console.error('Erro ao salvar o log:', error);
            exibirMensagemTemporaria('Erro ao salvar o log. Tente novamente mais tarde.', 5000);
        });
}


//Versionamento{

async function compararResultados() {
    const button = document.getElementById('botaoAnaliseVersao');
    button.disabled = true;
    button.innerText = 'Analisando...';
    //const endpoint = 'https://fachadanlp.ms.nia.intranet.bb.com.br/fachadanlp/v1/dialogo';
    const endpoint = 'https://niainfra.bb.com.br/nia-cognitivo-infra/manager/rest/public/conversationRestService/v1/dialogo';
    const inputsPadrao = ["Oi", "O que você pode fazer?", "Tchau", "OP_ENCERRAMENTO_CONVERSA", "OP_LOGIN_WA", "Consultar limite do cartão", "Quero enviar um pix", "emprestimo", "#PJ_8d1e1b6a-d612-4a77-81ff-d1d559795188"];

    //const inputsPadrao = ["Oi"];

    const customInputs = document.getElementById('custom-inputs').value.split(';').map(input => input.trim()).filter(input => input !== '');
    const inputs = [...inputsPadrao, ...customInputs];
    const txType = document.getElementById('tx-type').value;

    let respostasTeste = [];
    let respostasProd = [];
    let totalErros = 0;
    let totalDiferencas = 0;
    let erroDetalhes = [];

    const fetchOptions = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    };

    for (const input of inputs) {
        const chamadaTeste = {
            input,
            tipo: "WSA_-_CLIENTES",
            origem: "tst_automatizado_versionamento",
            context: {canal: "wa"}
        };
        const chamadaProd = {
            input,
            tipo: "WSA_-_CLIENTES_PROD",
            origem: "tst_automatizado_versionamento",
            context: {canal: "wa"}
        };

        try {
            const respostaTeste = await fetch(endpoint, {
                ...fetchOptions,
                body: JSON.stringify(chamadaTeste)
            }).then(res => res.json());
            const respostaProd = await fetch(endpoint, {
                ...fetchOptions,
                body: JSON.stringify(chamadaProd)
            }).then(res => res.json());

            const respostaTesteOutput = respostaTeste.data.output[txType] || [];
            const respostaProdOutput = respostaProd.data.output[txType] || [];
            let errorMessage = null;

            if (respostaTeste.data.output?.error) {
                totalErros++;
                const regex = /(node_[\w-]+|slot_[\w-]+)/g;
                const hash = respostaTeste.data.output.error.match(regex);
                errorMessage = respostaTeste.data.output.error;
                erroDetalhes.push({input, hash, errorMessage});
            }

            respostasTeste.push({
                input,
                resposta: respostaTesteOutput,
                nodes_visited: respostaTeste.data.output.output_watson.nodes_visited,
                errorMessage
            });
            respostasProd.push({
                input,
                resposta: respostaProdOutput,
                nodes_visited: respostaProd.data.output.output_watson.nodes_visited
            });

            if (!compararListas(respostaTesteOutput, respostaProdOutput)) {
                totalDiferencas++;
            }

        } catch (error) {
            respostasTeste.push({
                input,
                resposta: ["Indisponibilidade momentânea"],
                errorMessage: "Erro ao chamar o NIA"
            });
            respostasProd.push({
                input,
                resposta: ["Indisponibilidade momentânea"],
                errorMessage: "Erro ao chamar o NIA"
            });
            totalErros++;
        }
    }

    exibirResultados(respostasTeste, respostasProd, totalDiferencas, totalErros, erroDetalhes);

    const logData = {
        dataHora: new Date().toISOString().slice(0, 19).replace('T', ' '),
        inputsTestados: inputs.join(';'),
        totalDiferencas,
        totalErros,
        diferencas: JSON.stringify(
            respostasTeste
                .map((item, index) => {
                    if (!compararListas(item.resposta, respostasProd[index].resposta)) {
                        return {
                            input: item.input,
                            rascunho: item.resposta,
                            producao: respostasProd[index].resposta
                        };
                    }
                    return null;
                })
                .filter(diff => diff !== null)
        ),
        erros: JSON.stringify(erroDetalhes),
        tabela: 'logs_versionamento'
    };

    console.log(logData);

    salvarLog(logData);
    button.disabled = false;
    button.innerText = 'Avaliar Nova Candidata';
}

function exibirMensagemTemporaria(mensagem, duracao = 3000) {
    const mensagemContainer = document.getElementById('mensagem-temporaria');
    mensagemContainer.innerText = mensagem;
    mensagemContainer.style.display = 'block';

    setTimeout(() => {
        mensagemContainer.style.display = 'none';
    }, duracao);
}

// function exibirResultados(respostasTeste, respostasProd, totalDiferencas, totalErros, erroDetalhes) {
//     const resultadoTeste = document.getElementById('resultado-teste');
//     const resultadoProd = document.getElementById('resultado-prod');

//     resultadoTeste.innerHTML = '';
//     resultadoProd.innerHTML = '';

//     respostasTeste.forEach((item, index) => {
//         let iconeStatus = compararListas(item.resposta, respostasProd[index].resposta) ? '✅' : '❌';

//         if (item.errorMessage) {
//             iconeStatus = '❌';
//         }

//         let iconeStatusProd = '✅';

//         if (respostasProd[index].errorMessage) {
//             iconeStatusProd = '❌';
//         }


//         // Painel de Respostas de Teste
//         const panelTeste = document.createElement('div');
//         panelTeste.className = 'expansion-panel';

//         const cabecalhoTeste = document.createElement('div');
//         cabecalhoTeste.className = 'expansion-header';
//         cabecalhoTeste.innerHTML = `<strong style="text-align: left;">Input:</strong> ${item.input} <span class="status-icon">${iconeStatus}</span>`;

//         const conteudoTeste = document.createElement('div');
//         conteudoTeste.className = 'expansion-content';
//         conteudoTeste.innerHTML = item.resposta.map(res => `<div class="message-bubble">${tratarMensagem(res)}</div>`).join('');

//         if (item.errorMessage) {
//             const erroDiv = document.createElement('div');
//             erroDiv.className = 'error-message';
//             erroDiv.innerHTML = `<strong>Erro:</strong> ${item.errorMessage}`;
//             conteudoTeste.appendChild(erroDiv);
//         }

//         const botaoVerNos = document.createElement('button');
//         botaoVerNos.className = 'ver-nos-button';
//         botaoVerNos.innerText = 'Ver nós visitados';
//         botaoVerNos.style.display = 'none';
//         botaoVerNos.onclick = function () {
//             alert(`Nós visitados: ${item.nodes_visited ? item.nodes_visited.join(', ') : 'Nenhum nó encontrado'}`);
//         };

//         conteudoTeste.appendChild(botaoVerNos);
//         panelTeste.appendChild(cabecalhoTeste);
//         panelTeste.appendChild(conteudoTeste);
//         resultadoTeste.appendChild(panelTeste);

//         // Painel de Respostas de Produção
//         const panelProd = document.createElement('div');
//         panelProd.className = 'expansion-panel';

//         const cabecalhoProd = document.createElement('div');
//         cabecalhoProd.className = 'expansion-header';
//         cabecalhoProd.innerHTML = `<strong style="text-align: left;">Input:</strong> ${item.input} <span class="status-icon">${iconeStatusProd}</span>`;

//         const conteudoProd = document.createElement('div');
//         conteudoProd.className = 'expansion-content';
//         conteudoProd.innerHTML = respostasProd[index].resposta.map(res => `<div class="message-bubble">${tratarMensagem(res)}</div>`).join('');

//         if (respostasProd[index].errorMessage) {
//             const erroDiv = document.createElement('div');
//             erroDiv.className = 'error-message';
//             erroDiv.innerHTML = `<strong>Erro:</strong> ${item.errorMessage}`;
//             conteudoProd.appendChild(erroDiv);
//         }

//         const botaoVerNosProd = document.createElement('button');
//         botaoVerNosProd.className = 'ver-nos-button';
//         botaoVerNosProd.innerText = 'Ver nós visitados';
//         botaoVerNosProd.style.display = 'none';
//         botaoVerNosProd.onclick = function () {
//             alert(`Nós visitados: ${respostasProd[index].nodes_visited ? respostasProd[index].nodes_visited.join(', ') : 'Nenhum nó encontrado'}`);
//         };

//         cabecalhoTeste.onclick = function () {
//             conteudoTeste.classList.toggle('open');
//             botaoVerNos.style.display = conteudoTeste.classList.contains('open') ? 'block' : 'none';
//         };

//         cabecalhoProd.onclick = function () {
//             conteudoProd.classList.toggle('open');
//             botaoVerNosProd.style.display = conteudoProd.classList.contains('open') ? 'block' : 'none';
//         };

//         conteudoProd.appendChild(botaoVerNosProd);
//         panelProd.appendChild(cabecalhoProd);
//         panelProd.appendChild(conteudoProd);
//         resultadoProd.appendChild(panelProd);
//     });

//     document.getElementById('total-diferencas').innerText = `Total de diferenças encontradas: ${totalDiferencas}`;
//     document.getElementById('total-erros').innerText = `Total de erros encontrados na versão de teste: ${totalErros}`;

//     const erroDetalhesSection = document.getElementById('error-details-section');
//     erroDetalhesSection.innerHTML = '';

//     if (erroDetalhes.length > 0) {
//         erroDetalhes.forEach(erro => {
//             erroDetalhesSection.innerHTML += `<div class="error-details">
//                 <p><strong>Input:</strong> ${erro.input}</p>
//                 <p><strong>Hash:</strong> ${erro.hash}</p>
//                 <p><strong>Erro:</strong> ${erro.errorMessage}</p>
//             </div>`;
//         });
//     }
// }

function exibirResultados(respostasTeste, respostasProd, totalDiferencas, totalErros, erroDetalhes) {
    const resultadoTeste = document.getElementById('resultado-teste');
    const resultadoProd = document.getElementById('resultado-prod');

    resultadoTeste.innerHTML = '';
    resultadoProd.innerHTML = '';

    // helper: evita quebra de layout caso venha < ou & do backend
    const esc = s => String(s).replace(/[&<>"']/g, m => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#39;'
    }[m]));

    const ICON_OK = `
    <span class="tv-ic--ok">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M10.293 9.293L11.707 10.707L15.414 7L11.707 3.293L10.293 4.707L11.586 6H6V8H11.586L10.293 9.293ZM9.707 15.293L8.414 14H14V12H8.414L9.707 10.707L8.293 9.293L4.586 13L8.293 16.707L9.707 15.293ZM18 0H2C0.896 0 0 0.896 0 2V18C0 19.102 0.896 20 2 20H18C19.104 20 20 19.102 20 18V2C20 0.896 19.104 0 18 0ZM17.997 18H2V2H18L17.997 18Z"
              fill="#4668FF"/>
      </svg>
    </span>`;

    const ICON_ERR = `
    <span class="tv-ic--err">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
        <path d="M10 0C4.47 0 0 4.47 0 10C0 15.53 4.47 20 10 20C15.53 20 20 15.53 20 10C20 4.47 15.53 0 10 0ZM15 13.59L13.59 15L10 11.41L6.41 15L5 13.59L8.59 10L5 6.41L6.41 5L10 8.59L13.59 5L15 6.41L11.41 10L15 13.59Z" fill="#FF3535"/>
      </svg>
    </span>`;

    respostasTeste.forEach((item, index) => {
        const temRespostaTeste = Array.isArray(item.resposta) && item.resposta.length > 0 && !item.errorMessage;
        const temRespostaProd = Array.isArray(respostasProd[index].resposta) && respostasProd[index].resposta.length > 0 && !respostasProd[index].errorMessage;
        const diferente = !compararListas(item.resposta || [], respostasProd[index].resposta || []);

        // ============== RASCUNHO ==============
        const panelTeste = document.createElement('div');
        panelTeste.className = 'expansion-panel';
        if (diferente) panelTeste.classList.add('has-diff');
        if (item.errorMessage) panelTeste.classList.add('has-error');

        const headerTeste = document.createElement('div');
        headerTeste.className = 'expansion-header';

        const rowTeste = document.createElement('div');
        rowTeste.className = 'tv-row';
        // >>> ALTERE ESTA PARTE <<<
        rowTeste.innerHTML = `
      <div class="tv-row__left">
        <b>Input:</b>
        <span class="tv-inputtext" title="${esc(item.input)}">${esc(item.input)}</span>
      </div>
      <button type="button" class="tv-icbtn tv-row__icbtn" title="${temRespostaTeste ? 'Com resposta' : 'Sem resposta/erro'}">
        ${temRespostaTeste ? ICON_OK : ICON_ERR}
      </button>
    `;
        // <<< FIM DA ALTERAÇÃO >>>
        headerTeste.appendChild(rowTeste);

        const conteudoTeste = document.createElement('div');
        conteudoTeste.className = 'expansion-content';
        conteudoTeste.innerHTML = (item.resposta || [])
            .map(res => `<div class="message-bubble">${tratarMensagem(res)}</div>`)
            .join('');

        if (item.errorMessage) {
            const erroDiv = document.createElement('div');
            erroDiv.className = 'error-message';
            erroDiv.innerHTML = `<strong>Erro:</strong> ${esc(item.errorMessage)}`;
            conteudoTeste.appendChild(erroDiv);
        }

        rowTeste.addEventListener('click', () => {
            conteudoTeste.classList.toggle('open');
        });

        panelTeste.appendChild(headerTeste);
        panelTeste.appendChild(conteudoTeste);
        resultadoTeste.appendChild(panelTeste);

        // ============== PRODUÇÃO ==============
        const panelProd = document.createElement('div');
        panelProd.className = 'expansion-panel';
        if (diferente) panelProd.classList.add('has-diff');
        if (respostasProd[index].errorMessage) panelProd.classList.add('has-error');

        const headerProd = document.createElement('div');
        headerProd.className = 'expansion-header';

        const rowProd = document.createElement('div');
        rowProd.className = 'tv-row';
        rowProd.innerHTML = `
      <div class="tv-row__left">
        <b>Input:</b>
        <span class="tv-inputtext" title="${esc(item.input)}">${esc(item.input)}</span>
      </div>
      <button type="button" class="tv-icbtn tv-row__icbtn" title="${temRespostaProd ? 'Com resposta' : 'Sem resposta/erro'}">
        ${temRespostaProd ? ICON_OK : ICON_ERR}
      </button>
    `;
        headerProd.appendChild(rowProd);

        const conteudoProd = document.createElement('div');
        conteudoProd.className = 'expansion-content';
        conteudoProd.innerHTML = (respostasProd[index].resposta || [])
            .map(res => `<div class="message-bubble">${tratarMensagem(res)}</div>`)
            .join('');

        if (respostasProd[index].errorMessage) {
            const erroDiv = document.createElement('div');
            erroDiv.className = 'error-message';
            erroDiv.innerHTML = `<strong>Erro:</strong> ${esc(respostasProd[index].errorMessage)}`;
            conteudoProd.appendChild(erroDiv);
        }

        rowProd.addEventListener('click', () => {
            conteudoProd.classList.toggle('open');
        });

        panelProd.appendChild(headerProd);
        panelProd.appendChild(conteudoProd);
        resultadoProd.appendChild(panelProd);
    });

    // cartões do topo (números)
    document.getElementById('total-diferencas').innerText = `${totalDiferencas}`;
    document.getElementById('total-erros').innerText = `${totalErros}`;

    // detalhes de erro
    const erroDetalhesSection = document.getElementById('error-details-section');
    erroDetalhesSection.innerHTML = '';
    if (erroDetalhes.length > 0) {
        erroDetalhes.forEach(erro => {
            erroDetalhesSection.innerHTML += `
        <div class="error-details">
          <p><strong>Input:</strong> ${esc(erro.input)}</p>
          <p><strong>Hash:</strong> ${esc(erro.hash)}</p>
          <p><strong>Erro:</strong> ${esc(erro.errorMessage)}</p>
        </div>`;
        });
    }

    // abre o acordeão
    const acc = document.getElementById('tv-accordion');
    if (acc) {
        acc.hidden = false;
        const accBtn = acc.querySelector('.tv-acc-btn');
        if (accBtn) accBtn.setAttribute('aria-expanded', 'true');
    }
}


function tratarMensagem(mensagem) {
    return mensagem
        .replace(/\\u([a-fA-F0-9]{4})/g, (match, grp) => String.fromCharCode(parseInt(grp, 16)))
        .replace(/\\n/g, '<br>')
        .replace(/\*(.*?)\*/g, '<b>$1</b>');
}

function compararListas(lista1, lista2) {
    if (lista1.length !== lista2.length) {
        return false;
    }
    return lista1.every((item, index) => item === lista2[index]);
}

function salvarLog(logData) {
    var caminhoController = 'https://cad.bb.com.br/ferramentas/versionamento/controller.php';
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
                // document.getElementById('id-log').innerText = `ID do teste: ${idLog}`;
                exibirMensagemTemporaria('Teste finalizado com sucesso e logs gravados no banco de dados!');
            } else {
                console.warn('Erro no retorno do controller:', data);
            }
        })
        .catch((error) => {
            console.error('Erro ao salvar o log:', error);
            exibirMensagemTemporaria('Erro ao salvar o log. Tente novamente mais tarde.', 5000);
        });

}

//Geral

function addEventListeners() {
    document.getElementById('file').addEventListener("change", (event) => {
        if (document.getElementById('file').files.length > 0) {
            fileName = document.getElementById('file').files[0].name;
            fileSize = document.getElementById('file').files[0].size;
            document.getElementById('arquivo').textContent = fileName;
            document.getElementById('botaoAnaliseJson').disabled = false;
        } else {
            document.getElementById('botaoAnaliseJson').disabled = true;
            exibirMensagemTemporaria('Escolha um arquivo para testar!');
            document.getElementById('arquivo').textContent = 'Nenhum arquivo selecionado';
        }
    });
    const form = document.getElementById('arquivoJson');
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        try {
            if (document.getElementById('nVersaoParenteses').value == '') {
                const erro = new Error("Preencha o número da versão!");
                erro.name = "Versão em branco";
                throw erro;
            }
            if (document.getElementById('file').value == '') {
                const erro = new Error("Escolha um arquivo para testar!");
                erro.name = "Sem arquivo";
                throw erro;
            }
        } catch (error) {
            exibirMensagemTemporaria(`${error.name}: ${error.message}`);
            console.log(`${error.name}: ${error.message}`);
            return;
        }
        const button = document.getElementById('botaoAnaliseJson');
        button.disabled = true;
        button.innerText = 'Subindo...';
        exibirMensagemTemporaria('Subindo arquivo...', 1000)
        const formData = new FormData(form);
        fetch("https://cad.bb.com.br/ferramentas/versionamento/index.php", {
            method: 'POST',
            body: formData
        })
            .then(response => {
                if (response.ok) {
                    exibirMensagemTemporaria('Testando arquivo...', 1000);
                    button.innerText = 'Testando...';
                    processarJSON();
                } else {
                    exibirMensagemTemporaria('Erro no envio do arquivo, tente novamente');
                }
            })
            .catch(error => {
                exibirMensagemTemporaria(`${error.name}: ${error.message}`);
                console.log(`${error.name}: ${error.message}`);
            });
    });
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active');
            });
            button.classList.add('active');

            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            document.getElementById(tabId).classList.add('active');
        });
    });
    document.getElementById('fileInput').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function (e) {
            csvContent = e.target.result;
            dataArray = parseCSV(csvContent);
        };
        reader.readAsText(file);
    });
    const condicaoInput = document.getElementById('condicao');
    condicaoInput.addEventListener('input', function () {
        const condicao = condicaoInput.value;
        const textoResultadoCondicao = document.getElementById('textoResultadoCondicao');
        if (condicao != null && condicao != '') {
            let {abertos, fechados} = contPar(condicao);
            if (abertos !== fechados) {
                textoResultadoCondicao.innerText = `Opa!\nParênteses abertos: ${abertos}\nParênteses fechados: ${fechados}`;
                textoResultadoCondicao.style.color = 'red';
                textoResultadoCondicao.style.display = "block";
            } else {
                textoResultadoCondicao.innerText = 'A quantidade de parênteses abertos é igual a de parênteses fechados.';
                textoResultadoCondicao.style.color = 'green';
                textoResultadoCondicao.style.display = 'block';
            }
            ;
        } else {
            textoResultadoCondicao.innerText = '';
            textoResultadoCondicao.style.display = 'none';
        }
        ;
    });
}

function parseCSV(csvContent) {
    const rows = csvContent.split('\n');
    const data = rows.map(row => row.split(','));
    return data;
}

// ===============================
// Controle do Tipo de Canal (PF / PJ)
// ===============================
document.addEventListener("DOMContentLoaded", () => {
    const chave = document.getElementById("chavePfPj");
    if (!chave) return; // se não achou o switch, não faz nada

    // sempre começa como PF
    chave.checked = false;
    aplicarTipoCanal("PF");

    // troca PF <-> PJ ao mudar o switch
    chave.addEventListener("change", () => {
        aplicarTipoCanal(chave.checked ? "PJ" : "PF");
    });
});

function aplicarTipoCanal(tipo) {
    // procura todos os selects de Corpus nas abas
    const corpusSelects = document.querySelectorAll(".corpus-select");
    corpusSelects.forEach(sel => {
        if (!sel) return;
        if (tipo === "PF") {
            sel.value = "tx_whatsapp";
            sel.disabled = true;
        } else {
            sel.value = "tx_padrao";
            sel.disabled = true;
        }
    });
}
