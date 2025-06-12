// Abrir a janela do chat
document.getElementById('divChamaBot').addEventListener('click', function() {
    document.getElementById('chat-window').classList.toggle('hidden');
});

// Fechar a janela do chat
document.getElementById('close-chat').addEventListener('click', function() {
    document.getElementById('chat-window').classList.add('hidden');
});

// Enviar a mensagem ao clicar no botão
document.getElementById('send-message').addEventListener('click', enviarMensagem);

// Enviar a mensagem ao pressionar Enter
document.getElementById('chat-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        var novoContexto = consultarContexto();
        console.log('novoContexto: '+novoContexto);
        enviarMensagem(novoContexto);
    }
});

// Contexto da conversa
// let contextoConversa = {};

function consultarContexto(){
    var caminhoController = 'https://cad.bb.com.br/formacao-bots/controller.php';
    $.ajax({
        aSync: false,
        url: caminhoController,
        data: {
            request: 'consultarContexto'
        },
        type: "GET",
        dataType: "JSON",
        dataSrc: "",
        success: function(retorno) {
            // console.log('retorno: '+retorno);
            return(retorno);
        }
    });
    
}

// Função para enviar a mensagem
function enviarMensagem(novoContexto) {
    // const novoContexto = consultarContexto();
    // console.log('novoContexto: '+novoContexto);
    console.log('novoContexto no enviarMensagem: '+novoContexto);

    const inputElement = document.getElementById('chat-input');
    const message = inputElement.value.trim();
    if (message === '') {
        return;
    }

    const jsonBody = '{"data":{"input": "'+message+'", "context": {}}}';
    const jsonString = JSON.stringify(jsonBody);
    const jsonBodyParsed = JSON.parse(jsonString);

    exibirMensagem('Você', message, 'user');
    inputElement.value = '';

    // Enviar a mensagem para a API
    fetch('https://acs-assist-bot-cad-form.nia.servicos.bb.com.br/acs/llms/agent', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        mode: 'cors',
        body: jsonBodyParsed
    })
    .then(response => response.json())
    .then(data => {
        // console.log('Resposta do servidor:', data);
        
        const jsonString = (JSON.stringify(data));
        const jsonObject = JSON.parse(jsonString);
        const respBot = (jsonObject.data.output.text[0]);
        
        exibirMensagem('Assistente', respBot, 'bot');
        
        contextoConversa = JSON.stringify(jsonObject.data.context);
        // console.log('Contexto atualizado:', contextoConversa);
        // contextoConversa = '';
        const idConversa = (jsonObject.data.context.conversation_id);
        const idUsuario = data.userId;
        const inputUsuario = message;
        gravarConversa(idConversa, idUsuario, inputUsuario, respBot, contextoConversa);
    })
    .catch(error => {
        console.error('Erro:', error);
        exibirMensagem('Assistente', 'Desculpe, não estou conseguindo consultar minha base de conhecimento agora', 'bot');
    });
}

// Função para exibir a mensagem na interface do usuário
function exibirMensagem(sender, message, type) {
    const messagesElement = document.getElementById('chat-content');
    const messageElement = document.createElement('div');
    messageElement.classList.add('message');
    messageElement.classList.add(type);
    messageElement.innerHTML = `<strong>${sender}:</strong> ${message}`;
    messagesElement.appendChild(messageElement);
    messagesElement.scrollTop = messagesElement.scrollHeight;
}

// Função para gravar as conversas em BD
function gravarConversa(idConversa, idUsuario, inputUsuario, respostaBot, contextoConversa){
    var caminhoController = 'https://cad.bb.com.br/formacao-bots/controller.php';

    $.ajax({
        aSync: true,
        url: caminhoController,
        data: {
            request: 'gravarConversa',
            idConversa: idConversa,
            idUsuario: idUsuario,
            inputUsuario:  inputUsuario,
            respostaBot: respostaBot,
            contextoConversa: contextoConversa
        },
        type: "POST",
        dataType: "JSON",
        dataSrc: ""
    });
}