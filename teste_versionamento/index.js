async function compararResultados() {
    const button = document.getElementById('analyze-button');
    button.disabled = true;
    button.innerText = 'Analisando...';
    //const endpoint = 'http://fachadanlp.ms.nia.hm.bb.com.br/fachadanlp/v1/dialogo';
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
        const chamadaTeste = { input, tipo: "WSA_-_CLIENTES", origem: "tst_automatizado_versionamento", context: { canal: "wa" } };
        const chamadaProd = { input, tipo: "WSA_-_CLIENTES_PROD", origem: "tst_automatizado_versionamento", context: { canal: "wa" } };
       
        try {
            const respostaTeste = await fetch(endpoint, { ...fetchOptions, body: JSON.stringify(chamadaTeste) }).then(res => res.json());
            const respostaProd = await fetch(endpoint, { ...fetchOptions, body: JSON.stringify(chamadaProd) }).then(res => res.json());

            const respostaTesteOutput = respostaTeste.data.output[txType] || [];
            const respostaProdOutput = respostaProd.data.output[txType] || [];
            let errorMessage = null;

            if (respostaTeste.data.output?.error) {
                totalErros++;
                const regex = /(node_[\w-]+|slot_[\w-]+)/g;
                const hash = respostaTeste.data.output.error.match(regex);
                errorMessage = respostaTeste.data.output.error;
                erroDetalhes.push({ input, hash, errorMessage });
            }

            respostasTeste.push({ input, resposta: respostaTesteOutput, nodes_visited: respostaTeste.data.output.output_watson.nodes_visited, errorMessage });
            respostasProd.push({ input, resposta: respostaProdOutput, nodes_visited: respostaProd.data.output.output_watson.nodes_visited });

            if (!compararListas(respostaTesteOutput, respostaProdOutput)) {
                totalDiferencas++;
            }

        } catch (error) {
            respostasTeste.push({ input, resposta: ["Indisponibilidade momentânea"], errorMessage: "Erro ao chamar o NIA" });
            respostasProd.push({ input, resposta: ["Indisponibilidade momentânea"], errorMessage: "Erro ao chamar o NIA"});
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
        erros: JSON.stringify(erroDetalhes)
    };

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

function exibirResultados(respostasTeste, respostasProd, totalDiferencas, totalErros, erroDetalhes) {
    const resultadoTeste = document.getElementById('resultado-teste');
    const resultadoProd = document.getElementById('resultado-prod');

    resultadoTeste.innerHTML = '';
    resultadoProd.innerHTML = '';

    respostasTeste.forEach((item, index) => {
        let iconeStatus = compararListas(item.resposta, respostasProd[index].resposta) ? '✅' : '❌';

        if (item.errorMessage) {
            iconeStatus = '❌';
        }

        let iconeStatusProd = '✅';

        if (respostasProd[index].errorMessage) {
            iconeStatusProd = '❌';
        }


        // Painel de Respostas de Teste
        const panelTeste = document.createElement('div');
        panelTeste.className = 'expansion-panel';

        const cabecalhoTeste = document.createElement('div');
        cabecalhoTeste.className = 'expansion-header';
        cabecalhoTeste.innerHTML = `<strong style="text-align: left;">Input:</strong> ${item.input} <span class="status-icon">${iconeStatus}</span>`;

        const conteudoTeste = document.createElement('div');
        conteudoTeste.className = 'expansion-content';
        conteudoTeste.innerHTML = item.resposta.map(res => `<div class="message-bubble">${tratarMensagem(res)}</div>`).join('');

        if (item.errorMessage) {
            const erroDiv = document.createElement('div');
            erroDiv.className = 'error-message';
            erroDiv.innerHTML = `<strong>Erro:</strong> ${item.errorMessage}`;
            conteudoTeste.appendChild(erroDiv);
        }

        const botaoVerNos = document.createElement('button');
        botaoVerNos.className = 'ver-nos-button';
        botaoVerNos.innerText = 'Ver nós visitados';
        botaoVerNos.style.display = 'none';
        botaoVerNos.onclick = function () {
            alert(`Nós visitados: ${item.nodes_visited ? item.nodes_visited.join(', ') : 'Nenhum nó encontrado'}`);
        };

        conteudoTeste.appendChild(botaoVerNos);
        panelTeste.appendChild(cabecalhoTeste);
        panelTeste.appendChild(conteudoTeste);
        resultadoTeste.appendChild(panelTeste);

        // Painel de Respostas de Produção
        const panelProd = document.createElement('div');
        panelProd.className = 'expansion-panel';

        const cabecalhoProd = document.createElement('div');
        cabecalhoProd.className = 'expansion-header';
        cabecalhoProd.innerHTML = `<strong style="text-align: left;">Input:</strong> ${item.input} <span class="status-icon">${iconeStatusProd}</span>`;

        const conteudoProd = document.createElement('div');
        conteudoProd.className = 'expansion-content';
        conteudoProd.innerHTML = respostasProd[index].resposta.map(res => `<div class="message-bubble">${tratarMensagem(res)}</div>`).join('');

        if (respostasProd[index].errorMessage) {
            const erroDiv = document.createElement('div');
            erroDiv.className = 'error-message';
            erroDiv.innerHTML = `<strong>Erro:</strong> ${item.errorMessage}`;
            conteudoProd.appendChild(erroDiv);
        }

        const botaoVerNosProd = document.createElement('button');
        botaoVerNosProd.className = 'ver-nos-button';
        botaoVerNosProd.innerText = 'Ver nós visitados';
        botaoVerNosProd.style.display = 'none';
        botaoVerNosProd.onclick = function () {
            alert(`Nós visitados: ${respostasProd[index].nodes_visited ? respostasProd[index].nodes_visited.join(', ') : 'Nenhum nó encontrado'}`);
        };

        cabecalhoTeste.onclick = function () {
            conteudoTeste.classList.toggle('open');
            botaoVerNos.style.display = conteudoTeste.classList.contains('open') ? 'block' : 'none';
        };

        cabecalhoProd.onclick = function () {
            conteudoProd.classList.toggle('open');
            botaoVerNosProd.style.display = conteudoProd.classList.contains('open') ? 'block' : 'none';
        };

        conteudoProd.appendChild(botaoVerNosProd);
        panelProd.appendChild(cabecalhoProd);
        panelProd.appendChild(conteudoProd);
        resultadoProd.appendChild(panelProd);
    });

    document.getElementById('total-diferencas').innerText = `Total de diferenças encontradas: ${totalDiferencas}`;
    document.getElementById('total-erros').innerText = `Total de erros encontrados na versão de teste: ${totalErros}`;

    const erroDetalhesSection = document.getElementById('error-details-section');
    erroDetalhesSection.innerHTML = '';

    if (erroDetalhes.length > 0) {
        erroDetalhes.forEach(erro => {
            erroDetalhesSection.innerHTML += `<div class="error-details">
                <p><strong>Input:</strong> ${erro.input}</p>
                <p><strong>Hash:</strong> ${erro.hash}</p>
                <p><strong>Erro:</strong> ${erro.errorMessage}</p>
            </div>`;
        });
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

function salvarLog(logData){
    var caminhoController = 'https://cad.bb.com.br/teste_versionamento/controller.php';
    console.log(logData);
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
            document.getElementById('id-log').innerText = `ID do teste: ${idLog}`;
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