<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Montagem do Componente Carrossel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f5;
            color: #333;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #0056b3;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        fieldset {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        legend {
            font-weight: bold;
            color: #0056b3;
        }
        label {
            font-weight: bold;
            font-size: 0.9em;
        }
        input[type="text"], input[type="url"], select, textarea {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #0056b3;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }
        button:hover {
            background-color: #004494;
        }
        pre {
            background-color: #f8f8f8;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            overflow: auto;
            height: 300px;
        }
        .hidden {
            display: none;
        }
        small.contador-caracteres {
            font-size: 0.8em;
            color: #666;
            display: block;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        small.contador-caracteres.quase-limite {
            color: orange;
        }
        small.contador-caracteres.limite-excedido {
            color: red;
        }
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            border-radius: 5px 5px 0 0;
        }
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            color: black;
        }
        .tab button:hover {
            background-color: #ddd;
        }
        .tab button.active {
            background-color: #0056b3;
            color: white;
        }
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
            border-radius: 0 0 5px 5px;
            background-color: white;
        }
        .button-group {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .copy-buttons {
            margin-top: 10px;
        }
        #resultado-midia {
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <h1>Montagem do Componente Carrossel</h1>
    <form onsubmit="event.preventDefault(); montarJsons();">
        <fieldset>
            <legend>Informações Gerais</legend>
            <label for="nome-template">Nome do Template:</label>
            <input type="text" id="nome-template" required><br>
            <label for="texto-pre-body">Texto do Pré Body:</label>
            <textarea id="texto-pre-body" rows="4" required></textarea><br>
            <label for="quantidade-botoes">Quantidade de Botões:</label>
            <select id="quantidade-botoes" onchange="atualizarQuantidadeBotoes()" required>
                <option value="">Escolha a opção</option>
                <option value="1">1 Botão</option>
                <option value="2">2 Botões</option>
            </select><br>
            <div id="container-tipo-botao"></div>
            <label for="quantidade-itens">Quantidade de Itens no Carrossel:</label>
            <select id="quantidade-itens" onchange="atualizarQuantidadeItens()" required>
                <option value="">Escolha a opção</option>
                <option value="3">3 Itens</option>
                <option value="4">4 Itens</option>
                <option value="5">5 Itens</option>
                <option value="6">6 Itens</option>
                <option value="7">7 Itens</option>
                <option value="8">8 Itens</option>
                <option value="9">9 Itens</option>
                <option value="10">10 Itens</option>
            </select><br>
        </fieldset>

        <div id="container-itens"></div>

        <div class="button-group">
            <button type="submit">Montar JSONs</button>
            <button type="button" onclick="limparCampos()" style="background-color: #dc3545;">Limpar Campos</button>
        </div>
    </form>

    <h2>Resultados:</h2>
    <div class="tab">
        <button class="tablinks active" onclick="openTab(event, 'jsonOriginal')">JSON Template</button>
        <button class="tablinks" onclick="openTab(event, 'jsonMidia')">JSON Diálogo</button>
    </div>

    <div id="jsonOriginal" class="tabcontent" style="display: block;">
        <button onclick="copiarResultado('resultado-original')" class="copy-button" style="background-color: #28a745;">Copiar JSON Template</button>
        <pre id="resultado-original"></pre>
    </div>

    <div id="jsonMidia" class="tabcontent">
        <button onclick="copiarResultado('resultado-midia')" class="copy-button" style="background-color: #28a745;">Copiar JSON Diálogo</button>
        <pre id="resultado-midia"></pre>
    </div>

    <script>
        let quantidadeBotoesGlobal = 0;
        let quantidadeItensGlobal = 0;
        let tipoBotao1Global = "";
        let tipoBotao2Global = "";

        function montarJsons() {
            const nomeTemplate = document.getElementById('nome-template').value;
            const textoPreBody = document.getElementById('texto-pre-body').value;

            if (!validarCampos(nomeTemplate, textoPreBody)) {
                return;
            }

            const itens = [];
            const midias = [];

            if (quantidadeBotoesGlobal === 0 || quantidadeItensGlobal === 0) {
                alert("Por favor, selecione uma opção válida para Quantidade de Botões e Quantidade de Itens.");
                return;
            }

            for (let i = 1; i <= quantidadeItensGlobal; i++) {
                const tipoCarrossel = document.getElementById(`tipo-carrossel-${i}`).value;
                if (!tipoCarrossel) {
                    alert(`Por favor, selecione o Tipo de Carrossel para o Item ${i}`);
                    return;
                }
                
                const idMidia = (tipoCarrossel === "image" || tipoCarrossel === "video") 
                    ? document.getElementById(`id-midia-${i}`).value 
                    : null;

                if ((tipoCarrossel === "image" || tipoCarrossel === "video") && (!idMidia || idMidia.length > 10)) {
                    alert(`O ID da mídia no item ${i} é inválido ou excede o limite de 10 caracteres.`);
                    return;
                }

                // Adiciona ao array de mídias para o JSON de Mídia
                if (idMidia) {
                    const tipoMidia = tipoCarrossel === "image" ? "imagem" : "video";
                    // midias.push(`{'tipo':'${tipoMidia}','id':'${idMidia}'}`);
                    midias.push({
                        tipo: tipoMidia,
                        id: idMidia
                    });
                }

                const bodyItem = document.getElementById(`body-item-${i}`).value;
                const buttons = [];

                if (bodyItem.length > 160) {
                    alert(`O texto do item ${i} excede o limite de 160 caracteres (${bodyItem.length}/160). Reduza o texto em ${bodyItem.length - 160} caracteres.`);
                    return;
                }

                for (let j = 1; j <= quantidadeBotoesGlobal; j++) {
                    const botaoTexto = document.getElementById(`botao${j}-texto-${i}`).value;
                    const tipoBotao = j === 1 ? tipoBotao1Global : tipoBotao2Global;
                    const botaoUrl = tipoBotao === "link" ? document.getElementById(`botao${j}-url-${i}`).value : null;

                    if (botaoTexto.length > 25) {
                        alert(`O texto do botão ${j} no item ${i} excede o limite de 25 caracteres (${botaoTexto.length}/25). Reduza o texto em ${botaoTexto.length - 25} caracteres.`);
                        return;
                    }

                    if (tipoBotao === "link" && botaoUrl.length > 2000) {
                        alert(`A URL do botão ${j} no item ${i} excede o limite de 2000 caracteres.`);
                        return;
                    }

                    if (botaoTexto) {
                        const tipoBtn = tipoBotao === "link" ? "url" : "quick_reply";
                        buttons.push({
                            type: tipoBtn,
                            text: botaoTexto,
                            ...(tipoBotao === "link" && { url: botaoUrl })
                        });
                    }
                }

                itens.push({
                    components: [
                        {
                            type: "header",
                            format: tipoCarrossel,
                            example: {
                                header_handle: ["Essa propriedade será preenchida por quem for criar o template do time DITEC"]
                            }
                        },
                        {
                            type: "body",
                            text: bodyItem
                        },
                        {
                            type: "buttons",
                            buttons: buttons.length > 0 ? buttons : [{ type: "quick_reply", text: "Botão Padrão" }]
                        }
                    ]
                });
            }

            // JSON Original (formatado)
            document.getElementById('resultado-original').textContent = JSON.stringify({
                name: nomeTemplate,
                language: "pt_BR",
                category: "marketing",
                components: [
                    {
                        type: "body",
                        text: textoPreBody
                    },
                    {
                        type: "carousel",
                        cards: itens
                    }
                ]
            }, null, 4);

            // JSON Mídia (sem formatação, em uma linha)
            document.getElementById('resultado-midia').textContent = JSON.stringify({
                nomeTemplate: nomeTemplate,
                idTipoComponente: 13,
                nomeTipoComponente: "Carousel",
                midia: midias
                // tipoBotoes: getTiposBotoesArray()
            });
        }

        function getTiposBotoesArray() {
            const tipos = [];
            
            if (quantidadeBotoesGlobal >= 1 && tipoBotao1Global) {
                tipos.push(tipoBotao1Global === "texto" ? "quick_reply" : "url");
            }
            
            if (quantidadeBotoesGlobal >= 2 && tipoBotao2Global) {
                tipos.push(tipoBotao2Global === "texto" ? "quick_reply" : "url");
            }
            
            return tipos;
        }

        function openTab(evt, tabName) {
            const tabcontent = document.getElementsByClassName("tabcontent");
            for (let i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            const tablinks = document.getElementsByClassName("tablinks");
            for (let i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        function atualizarContador(input, contadorId) {
            const maxLength = input.id.includes('body-item') ? 160 : 
                            input.id.includes('id-midia') ? 10 : 25;
            const contador = document.getElementById(contadorId);
            const caracteresRestantes = maxLength - input.value.length;
            
            contador.textContent = `${caracteresRestantes} caracteres restantes (máximo: ${maxLength})`;
            contador.className = 'contador-caracteres';
            
            if (caracteresRestantes < 0) {
                contador.classList.add('limite-excedido');
            } else if (caracteresRestantes < 5) {
                contador.classList.add('quase-limite');
            }
        }

        function mostrarCampoMidia(itemIndex) {
            const tipoCarrossel = document.getElementById(`tipo-carrossel-${itemIndex}`).value;
            const containerMidia = document.getElementById(`container-midia-${itemIndex}`);
            
            if (tipoCarrossel === "image" || tipoCarrossel === "video") {
                containerMidia.classList.remove('hidden');
                document.getElementById(`id-midia-${itemIndex}`).required = true;
            } else {
                containerMidia.classList.add('hidden');
                document.getElementById(`id-midia-${itemIndex}`).required = false;
            }
        }

        function validarCampos(nomeTemplate, textoPreBody) {
            if (nomeTemplate.length > 512) {
                alert("O nome do template excede o limite de 512 caracteres.");
                return false;
            }

            if (textoPreBody.length > 1024) {
                alert("O texto do pré-body excede o limite de 1024 caracteres.");
                return false;
            }

            return true;
        }

        function adicionarItens() {
            const containerItens = document.getElementById('container-itens');
            containerItens.innerHTML = '';

            for (let i = 1; i <= quantidadeItensGlobal; i++) {
                const itemHTML = `
                    <fieldset>
                        <legend>Item ${i}</legend>
                        <label for="tipo-carrossel-${i}">Tipo de Carrossel:</label>
                        <select id="tipo-carrossel-${i}" onchange="mostrarCampoMidia(${i})" required>
                            <option value="">Escolha a opção</option>
                            <option value="image">Imagem</option>
                            <option value="video">Vídeo</option>
                        </select><br>
                        <div id="container-midia-${i}" class="hidden">
                            <label for="id-midia-${i}">ID da Mídia:</label>
                            <input type="text" id="id-midia-${i}" maxlength="10" 
                                   oninput="atualizarContador(this, 'contador-midia-${i}')">
                            <small id="contador-midia-${i}" class="contador-caracteres">10 caracteres restantes (máximo: 10)</small>
                        </div>
                        <label for="body-item-${i}">Texto do Item ${i}:</label>
                        <textarea id="body-item-${i}" rows="4" maxlength="160" oninput="atualizarContador(this, 'contador-item-${i}')" required></textarea>
                        <small id="contador-item-${i}" class="contador-caracteres">160 caracteres restantes (máximo: 160)</small>
                        ${gerarCamposBotoes(i)}
                    </fieldset>
                `;
                containerItens.insertAdjacentHTML('beforeend', itemHTML);
            }
        }

        function gerarCamposBotoes(itemIndex) {
            let campos = '';
            for (let j = 1; j <= quantidadeBotoesGlobal; j++) {
                const tipoBotao = j === 1 ? tipoBotao1Global : tipoBotao2Global;
                campos += `
                    <label for="botao${j}-texto-${itemIndex}">Texto do Botão ${j}:</label>
                    <input type="text" id="botao${j}-texto-${itemIndex}" maxlength="25" 
                           oninput="atualizarContador(this, 'contador-botao${j}-${itemIndex}')" required>
                    <small id="contador-botao${j}-${itemIndex}" class="contador-caracteres">25 caracteres restantes (máximo: 25)</small>
                    ${tipoBotao === "link" ? `
                        <label for="botao${j}-url-${itemIndex}">URL do Botão ${j}:</label>
                        <input type="url" id="botao${j}-url-${itemIndex}" required><br>
                    ` : ''}
                `;
            }
            return campos;
        }

        function atualizarQuantidadeBotoes() {
            const quantidadeBotoes = parseInt(document.getElementById('quantidade-botoes').value);
            if (quantidadeBotoes === 0) {
                alert("Por favor, selecione uma opção válida para Quantidade de Botões.");
                return;
            }
            quantidadeBotoesGlobal = quantidadeBotoes;
            atualizarCamposTipoBotao();
            adicionarItens();
        }

        function atualizarQuantidadeItens() {
            const quantidadeItens = parseInt(document.getElementById('quantidade-itens').value);
            if (quantidadeItens === 0) {
                alert("Por favor, selecione uma opção válida para Quantidade de Itens.");
                return;
            }
            quantidadeItensGlobal = quantidadeItens;
            adicionarItens();
        }

        function atualizarCamposTipoBotao() {
            const containerTipoBotao = document.getElementById('container-tipo-botao');
            containerTipoBotao.innerHTML = '';

            if (quantidadeBotoesGlobal === 1) {
                containerTipoBotao.innerHTML = `
                    <label for="tipo-botao-1">Tipo do Botão 1:</label>
                    <select id="tipo-botao-1" onchange="atualizarTipoBotao1()" required>
                        <option value="">Escolha a opção</option>
                        <option value="texto">Texto</option>
                        <option value="link">Link</option>
                    </select><br>
                `;
            } else if (quantidadeBotoesGlobal === 2) {
                containerTipoBotao.innerHTML = `
                    <label for="tipo-botao-1">Tipo do Botão 1:</label>
                    <select id="tipo-botao-1" onchange="atualizarTipoBotao1()" required>
                        <option value="">Escolha a opção</option>
                        <option value="texto">Texto</option>
                        <option value="link">Link</option>
                    </select><br>
                    <label for="tipo-botao-2">Tipo do Botão 2:</label>
                    <select id="tipo-botao-2" onchange="atualizarTipoBotao2()" required>
                        <option value="">Escolha a opção</option>
                        <option value="texto">Texto</option>
                        <option value="link">Link</option>
                    </select><br>
                `;
            }
        }

        function atualizarTipoBotao1() {
            tipoBotao1Global = document.getElementById('tipo-botao-1').value;
            adicionarItens();
        }

        function atualizarTipoBotao2() {
            tipoBotao2Global = document.getElementById('tipo-botao-2').value;
            adicionarItens();
        }

        function copiarResultado(elementId) {
            const resultado = document.getElementById(elementId).textContent;
            if (resultado) {
                navigator.clipboard.writeText(resultado).then(() => {
                    alert('JSON copiado para a área de transferência!');
                }).catch(err => {
                    console.error('Erro ao copiar o texto: ', err);
                });
            } else {
                alert('Não há nada para copiar!');
            }
        }

        function limparCampos() {
            document.getElementById('nome-template').value = '';
            document.getElementById('texto-pre-body').value = '';
            document.getElementById('quantidade-botoes').value = '';
            document.getElementById('quantidade-itens').value = '';
            quantidadeBotoesGlobal = 0;
            quantidadeItensGlobal = 0;
            tipoBotao1Global = "";
            tipoBotao2Global = "";
            document.getElementById('container-tipo-botao').innerHTML = '';
            document.getElementById('container-itens').innerHTML = '';
            document.getElementById('resultado-original').textContent = '';
            document.getElementById('resultado-midia').textContent = '';
            document.querySelectorAll('[id^="container-midia-"]').forEach(el => {
                el.classList.add('hidden');
            });
            document.querySelectorAll('[id^="id-midia-"]').forEach(el => {
                el.value = '';
                el.required = false;
            });
        }
    </script>
</body>
</html>