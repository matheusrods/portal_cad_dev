// Função para substituir palavras entre ** por <strong>
function replaceBold(text) {
    return text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
}

// Função para limpar campos de entrada e saída
document.getElementById('limparButoon').addEventListener('click', function () {
    // Limpa os campos de entrada e saída
    document.getElementById('inputField').value = ''; 
    document.getElementById('outputAntes').textContent = ''; 
    document.getElementById('outputEntre').textContent = ''; 
    document.getElementById('outputDepois').textContent = ''; 

    // Oculta os elementos de resposta
    document.querySelector('.code-container').style.display = 'none';
    document.querySelector('.resposta').style.display = 'none';
    console.log('Os campos foram limpos!');
});

// Enviar requisição POST
document.addEventListener('keydown', function(event) {
    // Verifica se as teclas Alt e Enter foram pressionadas
    if (event.altKey && event.key === 'Enter') {
        // Simula o clique no botão com id 'sendButton'
        document.getElementById('sendButton').click();
    }
    // Verifica se as teclas Alt e L foram pressionadas
    if (event.altKey && (event.key === 'l' || event.key === 'L')) {
        document.getElementById('limparButoon').click();
    }
});
document.getElementById('sendButton').addEventListener('click', function () {
    $.ajax({
        url: 'https://cad.bb.com.br/bot_sql/controller.php?request=validaSessao',
        method: 'GET',
        dataType: 'json',
        success: function(dadosSessao) {
            if (!dadosSessao.session_valid) {
                window.location.href = 'https://login.intranet.bb.com.br/sso/XUI/?goto=https://cad.bb.com.br/bot_sql/#login/';
                return false;
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Erro:', textStatus, errorThrown);
        }
    });
    
    // Mostrar o spinner de carregamento
    document.getElementById('loadingIndicator').style.display = 'block';
    //document.getElementById('customSpinnerFade').style.display = 'block';

    // Limpar resposta anterior
    document.getElementById('outputAntes').textContent = '';
    document.getElementById('outputEntre').textContent = '';
    document.getElementById('outputDepois').textContent = '';
    // Ocultar o contêiner do código ao enviar uma nova pergunta
    document.querySelector('.code-container').style.display = 'none';
    document.querySelector('.resposta').style.display = 'none';

    const input = document.getElementById('inputField').value;
    const data = {
        data: {
            input: input,
            context: {}
        }
    };

    fetch('https://acs-assist-bot-cad-sql.nia.hm.bb.com.br/acs/llms/agent', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        console.log('Data:', data); 
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
        })
    
    .then(data => {
        // função format dax
        function formatDAX(code) {
        let formattedCode = code.replace(/(\bFILTER\b|\bCALCULATE\b|\bVAR\b|\bRETURN\b)/g, '\n$1');
        formattedCode = formattedCode.replace(/\n/g, '\n');
        formattedCode = formattedCode.trim();
        return formattedCode;
        }
        
        function formatSAS(code) {
        // Formatação para SAS
        let formattedCode = code.replace(/;/g, ';\n'); 
        formattedCode = code.replace(/\s+/g, ' '); 
        formattedCode = code.trim(); 
        return formattedCode;
        }

        function formatBASH(code) {
        let formattedCode = parteEntre.replace(/^\s+/gm, '');
        formattedCode = code.trim(); 
        return formattedCode;
        }

        function formatText(text) {
            // Adiciona quebra de linha após ponto final seguido de espaço
            let formatted = text.replace(/\. (\w)/g, '.<br><br>$1');
            // Adiciona quebra de linha antes de tópicos (ex: "- ", "* ", "1. ")
            formatted = formatted.replace(/(\n|^)([-*]|\d+\.) /g, '<br>$2 ');
             // Substitui quebras de linha por <br>
            formatted = formatted.replace(/\n/g, '<br>');
            // Substitui '###' por um padrão de título (ex: <h3>)
            formatted = formatted.replace(/### (.*?)(<br>|$)/g, '<b>$1</b>$2');
            
            return formatted;
        }
        
        const content = data.data.context.messages[1].content;
        const formattedContent = replaceBold(content);
        //console.log(content);
        const delimitadores = [
            { tipo: 'SQL', inicio: '```sql', fim: '\n```\n\n' },
            { tipo: 'PySpark', inicio: '```python', fim: '\n```\n\n' },
            { tipo: 'HTML', inicio: '```html', fim: '\n```\n\n' },
            { tipo: 'CSS', inicio: '```css', fim: '\n```\n\n' },
            { tipo: 'AJAX', inicio: '```ajax', fim: '\n```\n\n' },
            { tipo: 'PHP', inicio: '```php\n', fim: '\n```\n\n' },
            { tipo: 'JavaScript', inicio: '```javascript', fim: '\n```\n\n' },
            { tipo: 'DAX', inicio: '```DAX', fim: '\n```\n\n' },
            { tipo: 'BASH', inicio: '```bash', fim: '\n```\n\n' },
            { tipo: 'SAS', inicio: '```sas', fim: '\n```\n\n' },
            { tipo: 'JSON', inicio: '```json', fim: '\n```\n\n' }
        ];

        let encontrouCodigo = false;

        var respostaBot;

        delimitadores.forEach(delimitador => {
            if (formattedContent.includes(delimitador.inicio) && formattedContent.includes(delimitador.fim)) {
                const parteAntes = formattedContent.split(delimitador.inicio)[0];
                const parteEntre = formattedContent.split(delimitador.inicio)[1].split(delimitador.fim)[0];
                const parteDepois = formattedContent.split(delimitador.fim)[1];
                                    
                // Formatar o código baseado no tipo
                let formattedCode = parteEntre;
                if (delimitador.tipo === 'SQL') {
                    formattedCode = sqlFormatter.format(parteEntre); 
                } else if (delimitador.tipo === 'PySpark') {
                    formattedCode = parteEntre; 
                } else if (delimitador.tipo === 'HTML') {
                    formattedCode = html_beautify(parteEntre);  
                } else if (delimitador.tipo === 'CSS') {
                    formattedCode = css_beautify(parteEntre); 
                } else if (delimitador.tipo === 'AJAX') {
                    formattedCode = ajaxFormatter.format(parteEntre);  
                } else if (delimitador.tipo === 'PHP') {
                    formattedCode = js_beautify(parteEntre);   
                } else if (delimitador.tipo === 'JavaScript') {
                    formattedCode = js_beautify(parteEntre); 
                } else if (delimitador.tipo === 'DAX') {
                    formattedCode = formatDAX(parteEntre); 
                }  else if (delimitador.tipo === 'JSON') {
                    formattedCode = js_beautify(parteEntre, { indent_size: 2 }); 
                } else if (delimitador.tipo === 'SAS') {
                    formattedCode = formatSAS(parteEntre);
                } else if (delimitador.tipo === 'Bash') {
                    formattedCode = formatBASH(parteEntre); 
                }
                // Formata os textos antes de exibir
                const formattedAntes = formatText(parteAntes);
                const formattedDepois = formatText(parteDepois);

                // Adicionar o conteúdo dividido nos elementos correspondentes
                document.getElementById('outputAntes').innerHTML = formattedAntes;
                document.getElementById('outputEntre').textContent = formattedCode;
                document.getElementById('outputDepois').innerHTML = formattedDepois;
                encontrouCodigo = true;
                // Mostrar o contêiner do código após receber a resposta
                document.querySelector('.code-container').style.display = 'block';
                document.querySelector('.resposta').style.display = 'block';

                respostaBot = parteEntre;
            }
        });

        if (!encontrouCodigo) {
            // Se nenhum código for encontrado, exibir a resposta completa
            const formattedAntes = formatText(formattedContent);
            document.getElementById('outputAntes').innerHTML = formattedAntes;
            document.querySelector('.code-container').style.display = 'none';
            document.querySelector('.resposta').style.display = 'block';
            respostaBot = formattedContent;
        }

        // Copiar conteúdo de outputEntre
        document.getElementById('copyButton').addEventListener('click', function () {
            const outputEntreText = document.getElementById('outputEntre').textContent;
            navigator.clipboard.writeText(outputEntreText).then(() => {
                console.log('Conteúdo copiado!');
            }).catch(err => {
                console.error('Erro ao copiar:', err);
            });
        });

        // Ocultar o spinner de carregamento
        document.getElementById('loadingIndicator').style.display = 'none';
        //document.getElementById('customSpinnerFade').style.display = 'none';

        const jsonString = (JSON.stringify(data));
        const jsonObject = JSON.parse(jsonString);
        const contextoConversa = JSON.stringify(jsonObject.data.context);
        const idConversa = (jsonObject.data.context.conversation_id);
        const idUsuario = (jsonObject.data.context.metadata.user_id);
        const inputUsuario = input;
        // const respostaBot = respostaBot;
        // console.log('tipo contexto: '+typeof contextoConversa);
        // console.log('contextoConversa: '+jsonString);
        // console.log('idConversa: '+idConversa);
        // console.log('idUsuario: '+idUsuario);
        // console.log('inputUsuario: '+inputUsuario);
        // console.log('respostaBot: '+respostaBot);
        
        gravarConversa(idConversa, idUsuario, inputUsuario, respostaBot, contextoConversa);
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('outputAntes').innerText += `\nError: ${error.message}`;
        document.querySelector('.code-container').style.display = 'none';
        document.querySelector('.resposta').style.display = 'block';
        // Ocultar o indicador de carregamento mesmo se houver um erro
        document.getElementById('loadingIndicator').style.display = 'none';
        //document.getElementById('customSpinnerFade').style.display = 'none';
    });
});

// Função para gravar as conversas em BD
function gravarConversa(idConversa, idUsuario, inputUsuario, respostaBot, contextoConversa){
    var caminhoController = 'https://cad.bb.com.br/bot_sql/controller.php';
    var respostaBotTratada = respostaBot.replace(/\\+/g, '\\');
    var contextoConversaTratada = contextoConversa.replace(/\\+/g, '\\');
    // var botaoLimpaContexto = $("#btnLimparContexto").attr('attr-idConversa');
    // console.log('length '+botaoLimpaContexto.length);
    
    // if(botaoLimpaContexto.length == 0){
    //     $("#btnLimparContexto").attr('attr-idConversa', idConversa);
    // }
    
    $.ajax({
        aSync: true,
        url: caminhoController,
        data: {
            request: 'gravarConversa',
            idConversa: idConversa,
            idUsuario: idUsuario,
            inputUsuario:  inputUsuario,
            respostaBot: respostaBotTratada,
            contextoConversa: contextoConversaTratada
        },
        type: "POST",
        dataType: "JSON",
        dataSrc: ""
    });
}