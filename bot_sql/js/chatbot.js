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
    .then(response => response.json())
    .then(data => {
        const content = data.data.context.messages[1].content;
        const formattedContent = replaceBold(content);

        const delimitadores = [
            { tipo: 'SQL', inicio: '```sql', fim: '\n```\n\n' },
            { tipo: 'PySpark', inicio: '```python', fim: '\n```\n\n' }
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
                    formattedCode = sqlFormatter.format(parteEntre); // Formatar SQL
                }

                // Adicionar o conteúdo dividido aos elementos correspondentes
                document.getElementById('outputAntes').innerHTML = parteAntes;
                document.getElementById('outputEntre').textContent = formattedCode;
                document.getElementById('outputDepois').innerHTML = parteDepois;
                encontrouCodigo = true;
                // Mostrar o contêiner do código após receber a resposta
                document.querySelector('.code-container').style.display = 'block';
                document.querySelector('.resposta').style.display = 'block';

                respostaBot = parteEntre;
            }
        });

        if (!encontrouCodigo) {
            // Se nenhum código for encontrado, exibir a resposta completa
            document.getElementById('outputAntes').innerHTML = formattedContent;
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
        // Ocultar o indicador de carregamento mesmo se houver um erro
        document.getElementById('loadingIndicator').style.display = 'none';
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