// Abrir a janela do chat
document.getElementById('chat-open-button').addEventListener('click', function() {
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
        enviarMensagem();
    }
});

// Contexto da conversa
let contextoConversa = {};

// Função para enviar a mensagem
function enviarMensagem() {
    const inputElement = document.getElementById('chat-input');
    const message = inputElement.value.trim();
    if (message === '') {
        return;
    }

    exibirMensagem('Você', message, 'user');
    inputElement.value = '';

    // Enviar a mensagem para a API do servidor Flask
    fetch('https://localhost:5000/chat', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ input: message, context: contextoConversa })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Resposta do servidor:', data);
        exibirMensagem('Assistente', data.output.text, 'bot');
        contextoConversa = data.context;
        console.log('Contexto atualizado:', contextoConversa);
    })
    .catch(error => {
        console.error('Erro:', error);
    });
}

// Função para exibir a mensagem na interface do usuário
function exibirMensagem(sender, message, type) {
    const messagesElement = document.getElementById('chat-messages');
    const messageElement = document.createElement('div');
    messageElement.classList.add('message');
    messageElement.classList.add(type);
    messageElement.innerHTML = `<strong>${sender}:</strong> ${message}`;
    messagesElement.appendChild(messageElement);
    messagesElement.scrollTop = messagesElement.scrollHeight;
}
