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

let base64 = '';

$('#send-message').on('click', function(e) {
    // Converte os atributos para booleanos
    var temTexto = $('#chat-input').attr('attr-conteudoTexto') === '1';
    var temImagem = $('#file-input').attr('attr-conteudoImagem') === '1';
    
    switch (true) {
        case temTexto && temImagem:
            enviarMidiaMensagem(base64);
            break;

        case temTexto && !temImagem:
            enviarMensagem();
            break;

        case !temTexto && temImagem:
            enviarImagem(base64);
            base64 = '';
            break;

        default:
            return false;
    }
    // Reset de campos
    $('textarea').css('height', '48px');
    $('#chat-input').attr('attr-conteudoTexto', '0');
    $('#file-input').attr('attr-conteudoImagem', '0');
    $('#file-input').val('');
    $('#chat-input').text('');
    $('#preview').attr('src', 'https://cad.desenv.bb.com.br/tom_v2/img/capaPreview.png');
    $('#preview').css('display', 'none');
    $('#contadorInputTom').text('2000 caracteres restantes');
});

// Função para que o textarea onde é digitada a pergunta seja automaticamente aumentado quando se digita um texto maior que a altura dele
$("#chat-input").on("input", function (e) {
    this.style.height = "auto";
    this.style.height = this.scrollHeight + "px";

    var maxLength = 2000;
    //e.stopPropagation();
    //e.stopImmediatePropagation();
    var length = $(this).val().length;
    var restante = maxLength - length;

    if(restante == maxLength){
        $(this).attr('attr-conteudoTexto', '0');
    } else {
        $(this).attr('attr-conteudoTexto', '1');
    }

    $('#contadorInputTom').text(restante + ' caracteres restantes');
    if (restante < 0) {
        $(this).val($(this).val().substring(0, maxLength));
        $('#contadorInputTom').text('0 caracteres restantes');
    }
    
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
    var caminhoController = 'https://cad.desenv.bb.com.br/tom_v2/controller.php';
    
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
                contextoTratado = '{}';
            } else {
                contexto = JSON.stringify(retorno);
                contextoNovo = (contexto.replace(/\\"/g, '"'));
                contextoNovo = (contextoNovo.replace(/\\"/g, '\"'));
                contextoTratado = contextoNovo.substring(1, contextoNovo.length - 1);
            }
            
            const jsonBody = '{"data":{"input": "'+message+'", "context": '+contextoTratado+'}}';
            const jsonString = JSON.stringify(jsonBody);
            const jsonBodyParsed = JSON.parse(jsonString);
            // console.log('jsonBodyParsed >> '+jsonBodyParsed);
            exibirMensagem('Você', message, 'user');
            exibirMensagem('Assistente', '<div class="loader"></div>', 'bot');
            inputElement.value = '';

            // Enviar a mensagem para a API Produção
            fetch('https://acs-assist-bot-cad-guia.nia.servicos.bb.com.br/acs/llms/agent', {
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
                const jsonString = (JSON.stringify(data));
                const jsonObject = JSON.parse(jsonString);
                const respBot = (jsonObject.data.output.text[0]);
                respBotPulaLinha = respBot.replace(/(?:\r\n|\r|\n)/g, '<br>');
                respBotNegrito = respBotPulaLinha.replace(/\*\*(.*?)\*\*/g, '<b>$1</b>');
                respBotItalico = respBotNegrito.replace(/\*([^*]+)\*/g, '<i>$1</i>');
                respBotItalico2 = respBotItalico.replace(/_([^_]+)_/g, '<i>$1</i>');
                respBotTachado = respBotItalico2.replace(/~~(.*?)~~/g, '<strike>$1</strike>');
                
                $('.message.bot').last().remove();
                exibirMensagem('Assistente', respBotTachado, 'bot');
                $('.message.bot').last().append('<br><button id="copiarTexto" title="Copiar texto para WhatsApp" style="background-color: #25D366;color: white;border: none;padding: 8px 12px;border-radius: 5px;cursor: pointer;font-size: 16px;"><i class="fab fa-whatsapp" style="color: #FFFFFF;" aria-hidden="true"></i></button>');
                
                contextoConversa = JSON.stringify(jsonObject.data.context);
                const idConversa = (jsonObject.data.context.conversation_id);
                const idUsuario = data.userId;
                const inputUsuario = message;
                gravarConversa(idConversa, idUsuario, inputUsuario, respBotPulaLinha, contextoConversa);
            })
            .catch(error => {
                console.error('Erro:', error);
                $('.message.bot').last().remove();
                exibirMensagem('Assistente', 'Desculpe, não estou conseguindo consultar minha base de conhecimento agora.', 'bot');
            });
            retorno = null;
        }
    });
}

function enviarMidiaMensagem(dadosBase64) {
    var caminhoController = 'https://cad.desenv.bb.com.br/tom_v2/controller.php';
    
    var midia = dadosBase64;

    const inputElement = document.getElementById('chat-input');
    var message = inputElement.value.trim();
    message = message.replace(/(?:\r\n|\r|\n)/g, '<br>');
    message = message.replace(/"/g, "'");

    exibirMensagem('Você', message+'<br><br><img src="'+midia+'" style="width: 200px; float: right;" />', 'user');
    exibirMensagem('Assistente', '<div class="loader"></div>', 'bot');
    
    var contexto ='';
    var contextoNovo = '';
    var contextoTratado = '';

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
                contextoTratado = '{"system": {"dialog_turn_counter": 0},"messages": []}';
            } else {
                contexto = JSON.stringify(retorno);
                contextoNovo = (contexto.replace(/\\"/g, '"'));
                contextoNovo = (contextoNovo.replace(/\\"/g, '\"'));
                contextoTratado = contextoNovo.substring(1, contextoNovo.length - 1);
            }

            const jsonBody = '{"data":{"input": "Extraia o conteúdo da imagem e resuma as principais informações", "images":["'+midia+'"],"context": '+contextoTratado+'}}';
            const jsonString = JSON.stringify(jsonBody);
            const jsonBodyParsed = JSON.parse(jsonString);
            // console.log(jsonBodyParsed);
            
            // Enviar a mensagem para a API de Mídia - Produção
            fetch('https://acs-assist-mdl-cad-tom.nia.hm.bb.com.br/acs/llms/agent', {
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
                const respBotMidia = (jsonObject.data.output.text[0]);
                respBotMidiaPulaLinha = respBotMidia.replace(/(?:\r\n|\r|\n)/g, '<br>');
                respBotMidiaNegrito = respBotMidiaPulaLinha.replace(/\*\*(.*?)\*\*/g, '<b>$1</b>');
                respBotMidiaItalico = respBotMidiaNegrito.replace(/\*([^*]+)\*/g, '<i>$1</i>');
                respBotMidiaItalico2 = respBotMidiaItalico.replace(/_([^_]+)_/g, '<i>$1</i>');
                respBotMidiaTachado = respBotMidiaItalico2.replace(/~~(.*?)~~/g, '<strike>$1</strike>');
                
                /* FAZER A PARTIR DAQUI O ENVIO DA MSG DE TEXTO */
                
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
                            contextoTratado = '{}';
                        } else {
                            contexto = JSON.stringify(retorno);
                            contextoNovo = (contexto.replace(/\\"/g, '"'));
                            contextoNovo = (contextoNovo.replace(/\\"/g, '\"'));
                            contextoTratado = contextoNovo.substring(1, contextoNovo.length - 1);
                        }
                        
                        const jsonBody = '{"data":{"input": "'+message+' '+respBotMidiaTachado+'", "context": '+contextoTratado+'}}';
                        const jsonString = JSON.stringify(jsonBody);
                        const jsonBodyParsed = JSON.parse(jsonString);
                        // console.log(jsonBodyParsed);
                        // exibirMensagem('Você', +'<br>'+respBotMidiaTachado, 'user');
                        // exibirMensagem('Você', message+'<br><img src="'+midia+'" style="width: 200px; float: right;" />', 'user');
                        inputElement.value = '';

                        // Enviar a mensagem para a API Produção
                        fetch('https://acs-assist-bot-cad-guia.nia.servicos.bb.com.br/acs/llms/agent', {
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
                            const jsonString = (JSON.stringify(data));
                            const jsonObject = JSON.parse(jsonString);
                            const respBot = (jsonObject.data.output.text[0]);
                            respBotPulaLinha = respBot.replace(/(?:\r\n|\r|\n)/g, '<br>');
                            respBotNegrito = respBotPulaLinha.replace(/\*\*(.*?)\*\*/g, '<b>$1</b>');
                            respBotItalico = respBotNegrito.replace(/\*([^*]+)\*/g, '<i>$1</i>');
                            respBotItalico2 = respBotItalico.replace(/_([^_]+)_/g, '<i>$1</i>');
                            respBotTachado = respBotItalico2.replace(/~~(.*?)~~/g, '<strike>$1</strike>');
                            
                            $('.message.bot').last().remove();
                            exibirMensagem('Assistente', respBotTachado, 'bot');
                            $('.message.bot').last().append('<br><button id="copiarTexto" title="Copiar para WhatsApp" style="background-color: #25D366;color: white;border: none;padding: 8px 12px;border-radius: 5px;cursor: pointer;font-size: 16px;"><i class="fab fa-whatsapp" style="color: #FFFFFF;" aria-hidden="true"></i></button>');
                            
                            contextoConversa = JSON.stringify(jsonObject.data.context);
                            const idConversa = (jsonObject.data.context.conversation_id);
                            const idUsuario = data.userId;
                            const inputUsuario = message;
                            gravarConversa(idConversa, idUsuario, inputUsuario, respBotPulaLinha, contextoConversa);
                        })
                        .catch(error => {
                            console.error('Erro:', error);
                            $('.message.bot').last().remove();
                            exibirMensagem('Assistente', 'Desculpe, não estou conseguindo consultar minha base de conhecimento textual neste momento.', 'bot');
                        });
                        retorno = null;
                    }
                });
            })
            .catch(error => {
                console.error('Erro:', error);
                $('.message.bot').last().remove();
                exibirMensagem('Assistente', 'Desculpe, não estou conseguindo consultar minha base de conhecimento de mídias neste momento.', 'bot');
            });
            retorno = null;
        }
    });
}

function enviarImagem(dadosBase64) {
    var caminhoController = 'https://cad.desenv.bb.com.br/tom_v2/controller.php';
    
    var message = dadosBase64;
    
    var contexto ='';
    var contextoNovo = '';
    var contextoTratado = '';

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
                contextoTratado = '{"system": {"dialog_turn_counter": 0},"messages": []}';
            } else {
                contexto = JSON.stringify(retorno);
                contextoNovo = (contexto.replace(/\\"/g, '"'));
                contextoNovo = (contextoNovo.replace(/\\"/g, '\"'));
                contextoTratado = contextoNovo.substring(1, contextoNovo.length - 1);
            }

            const jsonBody = '{"data":{"input": "Extraia o conteúdo da imagem e resuma as principais informações", "images":["'+message+'"],"context": '+contextoTratado+'}}';
            const jsonString = JSON.stringify(jsonBody);
            const jsonBodyParsed = JSON.parse(jsonString);
            // console.log(jsonBodyParsed);
            exibirMensagem('Você', 'Analise a imagem selecionada <br><br> <img src="'+message+'" style="width: 200px; float: right;" />', 'user');
            exibirMensagem('Assistente', '<div class="loader"></div>', 'bot');
            
            // Enviar a mensagem para a API de Mídia - Produção
            fetch('https://acs-assist-mdl-cad-tom.nia.hm.bb.com.br/acs/llms/agent', {
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

                $('.message.bot').last().remove();
                exibirMensagem('Assistente', respBotTachado, 'bot');
                $('.message.bot').last().append('<br><button id="copiarTexto" title="Copiar para WhatsApp" style="background-color: #25D366;color: white;border: none;padding: 8px 12px;border-radius: 5px;cursor: pointer;font-size: 16px;"><i class="fab fa-whatsapp" style="color: #FFFFFF;" aria-hidden="true"></i></button>');
                
                contextoConversa = JSON.stringify(jsonObject.data.context);
                const idConversa = (jsonObject.data.context.conversation_id);
                const idUsuario = data.userId;
                const inputUsuario = message;
                gravarConversa(idConversa, idUsuario, inputUsuario, respBotPulaLinha, contextoConversa);
            })
            .catch(error => {
                console.error('Erro:', error);
                $('.message.bot').last().remove();
                exibirMensagem('Assistente', 'Desculpe, não estou conseguindo consultar minha base de conhecimento de mídias neste momento.', 'bot');
            });
            retorno = null;
        }
    });
}

$(document).on('click', '.sugestao', function(){
    const textoBotao = $(this).text();
    const textArea = $('#chat-input');
    var valorAtual = textArea.val();
    
    // Regex para verificar as duas últimas palavras
    const regex = /\b(Resumir texto|Criar texto|Revisar texto|Criar Jornada)\b\s*$/;
    
    // Verifica se as duas últimas palavras correspondem a uma das palavras especificadas
    if (regex.test(valorAtual)) {
        // Remove as duas últimas palavras
        valorAtual = valorAtual.trim().replace(regex, '');
        // Adiciona o valor da variável textoBotao
        textArea.val(valorAtual.trim() + ' ' + textoBotao.trim());
    } else {
        // Adiciona o valor da variável textoBotao sem remover nada
        textArea.val(valorAtual.trim() + ' ' + textoBotao.trim());
    }
    valorAtual = textArea.val();
});

// funcão para enviar Imagem
$('.anexarArquivo').on('click', function() {
    $('#file-input').click();
});

$('#file-input').on('change', function () {
    $(this).attr('attr-conteudoImagem', '1');
    const file = this.files[0];
    if (file) {         
        // alert("Arquivo selecionado: " + file.name);
        // Adicionar lógica para enviar o arquivo
        const leitor = new FileReader();
        leitor.onload = function (e) {
            base64 = e.target.result;
            // console.log('Imagem em Base64:', base64);
        };
        leitor.readAsDataURL(file);
        preview.src = URL.createObjectURL(file)
        $("#preview").css("display", "block");
    }
});

// Função para exibir a mensagem na interface do usuário
function exibirMensagem(sender, message, type) {
    const messagesElement = document.getElementById('chat-content');
    const messageElement = document.createElement('div');
    messageElement.classList.add('message');
    messageElement.classList.add(type);
    messageElement.innerHTML = `<strong>${sender}: </strong>${message}`;
    messagesElement.appendChild(messageElement);
    // messagesElement.scrollTop = messagesElement.scrollHeight;
    setTimeout(() => {
        messagesElement.scrollTop = messagesElement.scrollHeight;
    }, 100);

}

// Função para gravar as conversas em BD
function gravarConversa(idConversa, idUsuario, inputUsuario, respostaBot, contextoConversa){
    var caminhoController = 'https://cad.desenv.bb.com.br/tom/controller.php';
    var respostaBotTratada = respostaBot.replace(/\\+/g, '\\');
    var contextoConversaTratada = contextoConversa.replace(/\\+/g, '\\');
    var botaoLimpaContexto = $("#btnLimparContexto").attr('attr-idConversa');
    // console.log('length '+botaoLimpaContexto.length);
    
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
    var caminhoController = 'https://cad.desenv.bb.com.br/tom/controller.php';
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

function htmlWhatsapp(html) {
    return html
        .replace(/<strong>(.*?)<\/strong>/gi, '*$1*')
        .replace(/<b>(.*?)<\/b>/gi, '*$1*')
        .replace(/<em>(.*?)<\/em>/gi, '_$1_')
        .replace(/<i>(.*?)<\/i>/gi, '_$1_')
        .replace(/<s>(.*?)<\/s>/gi, '~$1~')
        .replace(/<del>(.*?)<\/del>/gi, '~$1~')
        .replace(/<code>(.*?)<\/code>/gi, '```$1```')
        .replace(/<br\s*\/?>/gi, '\n')
        .replace(/<\/p>\s*<p>/gi, '\n\n')
        .replace(/<p>(.*?)<\/p>/gi, '$1\n')
        .replace(/&nbsp;/gi, ' ')
        .replace(/<[^>]+>/g, '') // remove outras tags
        .trim();
}

// $(document).on('click', '#copiarTexto', function () {
//     const $button = $(this);
//     const $botMessage = $button.closest('.message.bot');
//     const htmlContent = $botMessage.text();
//     const whatsappText = htmlWhatsapp(htmlContent);
//     const copiaTextoTratado = decodeHtml(whatsappText);

//     navigator.clipboard.writeText(copiaTextoTratado).then(function () {
//         $button.addClass('flash');
//         setTimeout(() => $button.removeClass('flash'), 500);
//     }).catch(function (err) {
//         console.error('Erro ao copiar:', err);
//     });
// });

$(document).on('click', '#copiarTexto', function () {
    const $button = $(this);
    const $botMessage = $button.closest('.message.bot');
    const htmlContent = $botMessage.text();
    const whatsappText = htmlWhatsapp(htmlContent);

    // Função para decodificar entidades HTML
    function decodeHtml(html) {
        const txt = document.createElement("textarea");
        txt.innerHTML = html;
        return txt.value;
    }

    const copiaTextoTratado = decodeHtml(whatsappText);

    navigator.clipboard.writeText(copiaTextoTratado).then(function () {
        $button.addClass('flash');
        setTimeout(() => $button.removeClass('flash'), 500);
    }).catch(function (err) {
        console.error('Erro ao copiar:', err);
    });
});



function decodeHtml(html) {
    const txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
}