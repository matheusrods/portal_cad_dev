<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testes Automatizados de Versionamento</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            text-align: center;
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            margin: 0;
            width: 100%;
            font-weight: 700;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        #input-section, #analysis-result {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            width: 90%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        #input-section label {
            font-weight: 500;
            margin-bottom: 10px;
        }
        #tx-type {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        #input-section button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        #input-section button:hover {
            background-color: #0056b3;
        }
        #input-section button:disabled {
            background-color: #aaa;
            cursor: not-allowed;
        }
        #result-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
        }
        .results {
            flex: 1;
            min-width: 350px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .results h2 {
            margin-top: 0;
            font-weight: 600;
            text-align: center;
        }
        .message-bubble {
            background-color: #e1ffc7;
            border-radius: 15px;
            padding: 10px 15px;
            margin: 10px 0;
            max-width: 100%;
            word-wrap: break-word;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        #analysis-result h2 {
            font-weight: 600;
        }
        #total-diferencas, #total-erros {
            font-size: 18px;
            margin: 10px 0;
            color: #333;
        }
        .error-details {
            background-color: #ffcccc;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <h1>Testes Automatizados de Versionamento</h1>
    <div id="input-section">
        <label for="tx-type">Escolha o tipo de resposta para comparar:</label>
        <select id="tx-type">
            <option value="tx_padrao">Padrão</option>
            <option value="tx_whatsapp">WhatsApp</option>
        </select>
        <button id="analyze-button" onclick="compararResultados()">Avaliar Nova Candidata</button>
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
    <div id="analysis-result">
        <h2>Resultado da Análise</h2>
        <p id="total-diferencas"></p>
        <p id="total-erros"></p>
        <div id="error-details-section"></div>
    </div>
    
    <script>
        async function compararResultados() {
            const button = document.getElementById('analyze-button');
            button.disabled = true;
            button.innerText = 'Analisando...';
            
            const endpoint = 'https://niainfra.bb.com.br/nia-cognitivo-infra/manager/rest/public/conversationRestService/v1/dialogo';
            const inputs = ["Oi", "O que você pode fazer?", "Tchau", "OP_ENCERRAMENTO_CONVERSA", "Consultar limite do cartão", "Quero enviar um pix"];
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
                const chamada1 = { input, tipo: "WSA_-_CLIENTES", origem: "wa", context: { canal: "wa" } };
                const chamada2 = { input, tipo: "WSA_-_CLIENTES_PROD", origem: "wa", context: { canal: "wa" } };
                
                try {
                    const respostaTeste = await fetch(endpoint, { ...fetchOptions, body: JSON.stringify(chamada1) }).then(res => res.json());
                    const respostaProd = await fetch(endpoint, { ...fetchOptions, body: JSON.stringify(chamada2) }).then(res => res.json());

                    const respostaTesteOutput = respostaTeste.data.output[txType] || [];
                    const respostaProdOutput = respostaProd.data.output[txType] || [];
                    respostasTeste.push({ input, resposta: respostaTesteOutput });
                    respostasProd.push({ input, resposta: respostaProdOutput });

                    if (respostaTeste.data.output.output_watson?.error) {
                        totalErros++;
                        const hash = respostaTeste.data.output.output_watson.nodes_visited.slice(-1)[0];
                        erroDetalhes.push({ input, hash, errorMessage: respostaTeste.data.output.output_watson.error });
                    }

                    if (!compararListas(respostaTesteOutput, respostaProdOutput)) {
                        totalDiferencas++;
                    }
                } catch (error) {
                    respostasTeste.push({ input, resposta: [`Erro: ${error.message}`] });
                    respostasProd.push({ input, resposta: [`Erro: ${error.message}`] });
                    totalErros++;
                }
            }

            exibirResultados(respostasTeste, respostasProd, totalDiferencas, totalErros, erroDetalhes);
            button.disabled = false;
            button.innerText = 'Avaliar Nova Candidata';
        }

        function exibirResultados(respostasTeste, respostasProd, totalDiferencas, totalErros, erroDetalhes) {
            const resultadoTeste = document.getElementById('resultado-teste');
            const resultadoProd = document.getElementById('resultado-prod');
            const erroDetalhesSection = document.getElementById('error-details-section');

            resultadoTeste.innerHTML = '';
            resultadoProd.innerHTML = '';
            erroDetalhesSection.innerHTML = '';

            respostasTeste.forEach((item, index) => {
                const input = `<div>Input: <strong>${item.input}</strong></div>`;
                resultadoTeste.innerHTML += input;
                resultadoProd.innerHTML += input;

                const maxLength = Math.max(item.resposta.length, respostasProd[index].resposta.length);
                for (let i = 0; i < maxLength; i++) {
                    const mensagemTeste = item.resposta[i] ? tratarMensagem(item.resposta[i]) : "<span style='color: red;'>Resposta ausente</span>";
                    const mensagemProd = respostasProd[index].resposta[i] ? tratarMensagem(respostasProd[index].resposta[i]) : "<span style='color: red;'>Resposta ausente</span>";
                    resultadoTeste.innerHTML += `<div class="message-bubble">${mensagemTeste}</div>`;
                    resultadoProd.innerHTML += `<div class="message-bubble">${mensagemProd}</div>`;
                    console.log(item.resposta[i])
                }
                resultadoTeste.innerHTML += '<br/>';
                resultadoProd.innerHTML += '<br/>';
            });

            document.getElementById('total-diferencas').innerText = `Total de diferenças encontradas: ${totalDiferencas}`;
            document.getElementById('total-erros').innerText = `Total de erros encontrados na versão de teste: ${totalErros}`;

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
    </script>
</body>
</html>
