// Abrir a janela do chat
window.addEventListener("DOMContentLoaded", (event) => {
    document.getElementById('divChamaBot').addEventListener('click', function() {
        document.getElementById('chat-window').classList.toggle('hidden');
    });
});

// // Fechar a janela do chat
// document.getElementById('close-chat').addEventListener('click', function() {
//     document.getElementById('chat-window').classList.add('hidden');
// });

// Enviar a mensagem ao clicar no botão
document.getElementById('send-message').addEventListener('click', function(e) {
    enviarMensagem();
    $("textarea").css("height","48px");
});

// // Enviar a mensagem ao pressionar Enter
// document.getElementById('chat-input').addEventListener('keypress', function(e) {
//     if (e.key === 'Enter') {
//         enviarMensagem();
//         $("textarea").css("height","48px");
//     }
// });

// Função para que o textarea onde é digitada a pergunta seja automaticamente aumentado quando se digita um texto maior que a altura dele
$("#chat-input").on("input", function () {
    this.style.height = "auto";
    this.style.height = this.scrollHeight + "px";
});

// Define a lista de frases dinâmicas que aparecerão ao carregar a página
var placeholders = [
    'O que você sabe fazer?', 
    'Como posso pedir para revisar um texto?',    
    'Como posso pedir para criar um texto?',    
    'Quais os tipos de mensagens você pode ajudar?',    
    'Reescreva de forma mais descontraída "O TEXTO"',    
    'Sobre emojis quais eu devo utilizar e quais não devo?',
    'Como posso escrever um texto mais acessível?'
];

// Índice do array de frases dinâmicas
var index = 0;

// Define o placeholder com o primeiro item da lista ao carregar a página
$('#chat-input').attr('placeholder', placeholders[index]);

// Soma 1 ao index do array para que não apareça a primeira frase duas vezes ao carregar a página
index = (index + 1)

// Altera o placeholder no intervalo de tempo definido na última linha deste bloco
setInterval(function() {
    $('#chat-input').addClass('fade');
    setTimeout(function() {
        $('#chat-input').attr('placeholder', placeholders[index]);
        $('#chat-input').removeClass('fade');
        index = (index + 1) % placeholders.length;
    }, 500); // Tempo da transição
}, 3000); // tempo de atualização do placeholder

// Ao apontar o seletor do mouse dentro do elemento, esconde o placeholder
$('#chat-input').focus(function() {
    $(this).attr('placeholder', '');
}).blur(function() {
    $(this).attr('placeholder', placeholders[index]);
});

// Botão para limpeza de conversa e contexto
$('#btnLimparContexto').on('click', function(){
    var idConversa = $("#btnLimparContexto").attr('attr-idConversa');
    if(idConversa.length > 0){
        zerarContexto(idConversa);
    }
});

// Função para que o textarea onde é digitada a pergunta seja automaticamente aumentado quando se digita um texto maior que a altura dele
$("textarea").each(function () {
    this.style.height = this.scrollHeight + "px";
    this.style.overflowY = "hidden";
}).on("input", function () {
    this.style.height = "auto";
    this.style.height = this.scrollHeight + "px";
});

// Função para enviar a mensagem
function enviarMensagem() {
    var caminhoController = 'https://cad.bb.com.br/tom/controller.php';
    const inputElement = document.getElementById('chat-input');
    var message = inputElement.value.trim();
    message = message.replace(/(?:\r\n|\r|\n)/g, '<br>');
    message = message.replace(/"/g, "'");
    
    var contexto ='';
    var contextoNovo = '';
    var contextoTratado = '';

    if (message === '') {
        return;
    }

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
            

            if ((retorno === null ) || (retorno.length == 0)){
                // console.log('Sem contexto');
                contextoTratado = '{}';
            } else {
                contexto = JSON.stringify(retorno);
                // console.log('contexto: '+contexto);
                contextoNovo = (contexto.replace(/\\"/g, '"'));
                contextoNovo = (contextoNovo.replace(/\\"/g, '\"'));
                
                // console.log('contextoNovo: '+contextoNovo);
                contextoTratado = contextoNovo.substring(1, contextoNovo.length - 1);
                // console.log('contexto tratado final: '+contextoTratado);
            }
            
            // const jsonBody = '{"data":{"input": "'+message+'", "context": {}}}';
            const jsonBody = '{"data":{"input": "'+message+'", "context": '+contextoTratado+'}}';
            // console.log('jsonBody: '+jsonBody);
            const jsonString = JSON.stringify(jsonBody);
            const jsonBodyParsed = JSON.parse(jsonString);
            // console.log('jsonBodyParsed >> '+jsonBodyParsed);
            exibirMensagem('Você', message, 'user');
            inputElement.value = '';

            // Enviar a mensagem para a API Produção
            fetch('https://acs-assist-bot-cad-guia.nia.servicos.bb.com.br/acs/llms/agent', {

            // Enviar a mensagem para a API Homologação
            // fetch('https://acs-assist-bot-cad-guia.nia.hm.bb.com.br/acs/llms/agent', {
                
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
                respBotPulaLinha = respBot.replace(/(?:\r\n|\r|\n)/g, '<br>');
                respBotNegrito = respBotPulaLinha.replace(/\*\*(.*?)\*\*/g, '<b>$1</b>');
                respBotItalico = respBotNegrito.replace(/\*([^*]+)\*/g, '<i>$1</i>');
                respBotItalico2 = respBotItalico.replace(/_([^_]+)_/g, '<i>$1</i>');
                respBotTachado = respBotItalico2.replace(/~~(.*?)~~/g, '<strike>$1</strike>');
                
                exibirMensagem('Assistente', respBotTachado, 'bot');
                
                contextoConversa = JSON.stringify(jsonObject.data.context);
                const idConversa = (jsonObject.data.context.conversation_id);
                const idUsuario = data.userId;
                const inputUsuario = message;
                gravarConversa(idConversa, idUsuario, inputUsuario, respBotPulaLinha, contextoConversa);
            })
            .catch(error => {
                console.error('Erro:', error);
                exibirMensagem('Assistente', 'Desculpe, não estou conseguindo consultar minha base de conhecimento agora.', 'bot');
            });
            retorno = null;
        }
    });
}

// function substituirNegrito(texto) {
//     return texto.replace(/\*\*(.*?)\*\*/g, '<b>$1</b>');
// }

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
    var caminhoController = 'https://cad.bb.com.br/tom/controller.php';
    var respostaBotTratada = respostaBot.replace(/\\+/g, '\\');
    var contextoConversaTratada = contextoConversa.replace(/\\+/g, '\\');
    var botaoLimpaContexto = $("#btnLimparContexto").attr('attr-idConversa');
    console.log('length '+botaoLimpaContexto.length);
    
    if(botaoLimpaContexto.length == 0){
        $("#btnLimparContexto").attr('attr-idConversa', idConversa);
    }
    
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

function zerarContexto(idConversa){
    var caminhoController = 'https://cad.bb.com.br/tom/controller.php';
    $("#btnLimparContexto").attr('attr-idConversa', '');
    var nomeUsuario = $("#btnLimparContexto").attr('attr-nomeUsuario');
    $.ajax({
        aSync: true,
        url: caminhoController,
        data: {
            request: 'zerarContexto',
            idConversa: idConversa
        },
        type: "POST",
        dataType: "JSON",
        dataSrc: ""
    });
    $('#chat-content').html('');
    $('#chat-content').html('<div id="chat-messages"></div><div class="message bot"><strong>Assistente:</strong> Olá, '+nomeUsuario+'! Eu sou o Tom, seu assistente virtual revisor e criador de textos do CAD BB. Como posso te ajudar?</div>');
}