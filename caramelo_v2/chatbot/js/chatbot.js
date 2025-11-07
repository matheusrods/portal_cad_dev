window.addEventListener("DOMContentLoaded", (event) => {
    document.getElementById('divChamaBot').addEventListener('click', function () {
        document.getElementById('chat-window').classList.toggle('hidden');
    });
});

document.getElementById('send-message').addEventListener('click', function (e) {
    enviarMensagem();
    $("textarea").css("height", "48px");
});

$("#chat-input").on("input", function () {
    this.style.height = "auto";
    this.style.height = this.scrollHeight + "px";
    var maxLength = 2000;
    var length = $(this).val().length;
    var restante = maxLength - length;
    if (restante == maxLength) {
        $(this).attr('attr-conteudoTexto', '0');
    } else {
        $(this).attr('attr-conteudoTexto', '1');
    }
    $('#contadorInputCaramelo').text(restante + ' caracteres restantes');
    if (restante < 0) {
        $(this).val($(this).val().substring(0, maxLength));
        $('#contadorInputCaramelo').text('0 caracteres restantes');
    }
});

$('#btnLimparContexto').on('click', function () {
    var idConversa = $("#btnLimparContexto").attr('attr-idConversa');
    if (idConversa.length > 0) {
        zerarContexto(idConversa);
    }
});

$("textarea").each(function () {
    this.style.height = this.scrollHeight + "px";
    this.style.overflowY = "hidden";
}).on("input", function () {
    this.style.height = "auto";
    this.style.height = this.scrollHeight + "px";
});

function enviarMensagem() {
    var caminhoController = `${BASE_URL}/bot_dev/controller.php`;
    const inputElement = document.getElementById('chat-input');
    var message = inputElement.value.trim();
    message = message.replace(/"/g, "'");
    var contexto = '';
    var contextoNovo = '';
    var contextoTratado = '';
    if (message === '') {
        return;
    }
    $.ajax({
        aSync: false,
        url: caminhoController,
        data: { request: 'consultarContexto' },
        type: "GET",
        dataType: "JSON",
        dataSrc: "",
        success: function (retorno) {
            if ((retorno === null) || (retorno.length == 0)) {
                contextoTratado = '{}';
            } else {
                contexto = JSON.stringify(retorno);
                contextoNovo = (contexto.replace(/\\"/g, '"'));
                contextoNovo = (contextoNovo.replace(/\\"/g, '\"'));
                contextoTratado = contextoNovo.substring(1, contextoNovo.length - 1);
            }
            const jsonBody = '{"data":{"input": "' + message + '", "context": ' + contextoTratado + '}}';
            const jsonString = JSON.stringify(jsonBody);
            const jsonBodyParsed = JSON.parse(jsonString);
            exibirMensagem('Você', message, 'user');
            inputElement.value = '';

            //mock
            setTimeout(() => {
                const hora = new Date().toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
                const respBotMock = `
                        Aqui está uma sugestão pra você:<br><br>
                        "Os cartões do BB são pensados pra facilitar sua vida e oferecer vantagens incríveis.
                        Com eles, você pode fazer compras no Brasil e no exterior, parcelar suas despesas e ainda
                        acumular pontos pra trocar por produtos, serviços ou milhas. Além disso, tem opções de cartões
                        com anuidade zero e benefícios exclusivos, como seguros e assistências."<br><br>
                        Esta mensagem é uma sugestão. Antes de utilizar, analise o conteúdo 😉
                        <span class="hora-msg" style="float: right; font-size: 12px; color: #777;">${hora}</span>
                    `;
                exibirFeedbackCaramelo(respBotMock);
            }, 1200);
            return;
            //fim mock

            fetch('https://acs-assist-bot-cad-dev.nia.servicos.bb.com.br/acs/llms/agent', {
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
                    respBotEscapaTag = respBotPulaLinha.replace(/<\?/g, '&lt;?').replace(/\?>/g, '?&gt;');
                    exibirMensagem('CarameloDev', respBotEscapaTag, 'bot');
                    contextoConversa = JSON.stringify(jsonObject.data.context);
                    const idConversa = (jsonObject.data.context.conversation_id);
                    const idUsuario = data.userId;
                    const inputUsuario = message;
                    gravarConversa(idConversa, idUsuario, inputUsuario, respBotPulaLinha, contextoConversa);
                })
                .catch(error => {
                    console.error('Erro:', error);
                    exibirMensagem('CarameloDev', 'Desculpe, não estou <i>cão</i>seguindo consultar minha base de conhecimento agora.', 'bot');
                });
            retorno = null;
        }
    });
}

$(document).ready(function () {
    let textoDigitado = '';
    let textoBotaoAnterior = '';
    $('.sugestao').on('click', function () {
        const textoBotao = $(this).text();
        const textArea = $('#chat-input');
        const valorAtual = textArea.val();
        if (!valorAtual.includes(textoBotaoAnterior)) {
            textoDigitado = valorAtual;
        }
        textArea.val(textoDigitado + ' ' + textoBotao);
        textoBotaoAnterior = textoBotao;
    });
});

function exibirMensagem(sender, message, type) {
    const messagesElement = document.getElementById('chat-content');
    const messageElement = document.createElement('div');
    messageElement.classList.add('message');
    messageElement.classList.add(type);
    messageElement.innerHTML = `<strong>${sender}:</strong> ${message}`;
    messagesElement.appendChild(messageElement);
    messagesElement.scrollTop = messagesElement.scrollHeight;
}

function gravarConversa(idConversa, idUsuario, inputUsuario, respostaBot, contextoConversa) {
    var caminhoController = `${BASE_URL}/bot_dev/controller.php`;
    var respostaBotTratada = respostaBot.replace(/\\+/g, '\\');
    var contextoConversaTratada = contextoConversa.replace(/\\+/g, '\\');
    var botaoLimpaContexto = $("#btnLimparContexto").attr('attr-idConversa');
    console.log('length ' + botaoLimpaContexto.length);
    if (botaoLimpaContexto.length == 0) {
        $("#btnLimparContexto").attr('attr-idConversa', idConversa);
    }
    $.ajax({
        aSync: true,
        url: caminhoController,
        data: {
            request: 'gravarConversa',
            idConversa: idConversa,
            idUsuario: idUsuario,
            inputUsuario: inputUsuario,
            respostaBot: respostaBotTratada,
            contextoConversa: contextoConversaTratada
        },
        type: "POST",
        dataType: "JSON",
        dataSrc: ""
    });
}

function zerarContexto(idConversa) {
    var caminhoController = `${BASE_URL}/bot_dev/controller.php`;
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
    $('#chat-content').html('<div id="chat-messages"></div><div class="message bot"><strong>CarameloDEV:</strong>Olá, ' + nomeUsuario + ', aqui eu tento ajudar na construção dos bots da escola de robôs.<br><br>Pode me perguntar sobre:<br>-<b>regras e lógica</b> do Watson Assistant;<br>-métodos de linguagem pra <b>tratamento de informações</b> no formato JSON.<br><br>Também pode pedir que eu:<br>-<b>verifique</b> uma condição de entrada de nó de diálogo;<br>-<b>sugira</b> alguma entidade ou intenção pra algum tipo de input.</div>');
}

function exibirFeedbackCaramelo(mensagemBot) {
    console.log('💬 exibirFeedbackCaramelo chamado com:', mensagemBot?.substring(0, 60));
    const messageHtml = `
        <div class="message bot" style="position: relative;">
            <strong>CarameloDev:</strong> ${mensagemBot}
        </div>
    `;
    const feedbackHtml = `
        <div class="feedback-container">
            <span>Essa resposta te ajudou?</span>
            <button class="feedback-like" title="Sim">
                <i class="fa-regular fa-thumbs-up"></i>
            </button>
            <button class="feedback-dislike" title="Não">
                <i class="fa-regular fa-thumbs-down"></i>
            </button>
        </div>
    `;
    $('#chat-content').append(messageHtml);
    const $ultimaMensagem = $('#chat-content .message.bot').last();
    if ($ultimaMensagem.length) {
        $ultimaMensagem.after(`<div class="feedback-wrapper">${feedbackHtml}</div>`);
    }
    $('#chat-content').animate({ scrollTop: $('#chat-content')[0].scrollHeight }, 'fast');
    $(document)
        .off('click', '.feedback-like, .feedback-dislike')
        .on('click', '.feedback-like, .feedback-dislike', function () {
            const isLike = $(this).hasClass('feedback-like');
            if (isLike) {
                const $wrapper = $(this).closest('.feedback-wrapper');
                $wrapper.find('.feedback-dislike i')
                    .removeClass('fa-solid text-dislike')
                    .addClass('fa-regular');
                $(this).find('i')
                    .removeClass('fa-regular')
                    .addClass('fa-solid text-like');
                mostrarToastFeedback(
                    "Obrigado pelo seu feedback 😊",
                    "Fico feliz que a resposta te ajudou!<br>Estou aqui para o que precisar."
                );
                gravaFeedback(mensagemBot, '', 'like');
            } else {
                const $wrapper = $(this).closest('.feedback-wrapper');
                $wrapper.find('.feedback-like i')
                    .removeClass('fa-solid text-like')
                    .addClass('fa-regular');
                $(this).find('i')
                    .removeClass('fa-regular')
                    .addClass('fa-solid text-dislike');
                $('#modal-feedback').removeClass('hidden');
                $('#feedback-text').val('');
                $('.char-count').text('500 caracteres restantes');
            }
        });
    $(document)
        .off('click', '.close-modal-feedback')
        .on('click', '.close-modal-feedback', function () {
            $('#modal-feedback').addClass('hidden');
        });
    $(document)
        .off('click', '.btn-skip')
        .on('click', '.btn-skip', function () {
            $('#modal-feedback').addClass('hidden');
            gravaFeedback(mensagemBot, '', 'dislike');
            mostrarToastFeedback(
                "Obrigado pelo seu feedback 😊",
                "Vamos usar seu feedback para melhorar ainda mais o Caramelo"
            );
        });
    $(document)
        .off('input', '#feedback-text')
        .on('input', '#feedback-text', function () {
            const restante = 500 - $(this).val().length;
            $('.char-count').text(`${restante} caracteres restantes`);
        });
    $(document)
        .off('click', '.btn-send')
        .on('click', '.btn-send', function () {
            const comentario = $('#feedback-text').val().trim();
            $('#modal-feedback').addClass('hidden');
            gravaFeedback(mensagemBot, comentario, 'dislike');
            mostrarToastFeedback(
                "Obrigado pelo seu feedback 😊",
                "Vamos usar seu feedback para melhorar ainda mais o Caramelo"
            );
        });
}

function gravaFeedback(mensagemBot, comentarioUsuario, avaliacao, rating = null) {
    var caminhoController = `${BASE_URL}/caramelo_v2/controller.php`;
    var mensagemBotTratada = String(mensagemBot || '').replace(/\\+/g, '\\');
    var comentarioUsuarioTratado = String(comentarioUsuario || '').replace(/\\+/g, '\\');
    var dados = {
        request: 'gravaFeedback',
        mensagem_bot: mensagemBotTratada,
        comentario_usuario: comentarioUsuarioTratado,
        avaliacao: avaliacao || null
    };
    if (avaliacao === '' && typeof rating !== 'undefined' && rating > 0) {
        dados.nota = rating;
    }
    $.ajax({
        async: true,
        url: caminhoController,
        type: "POST",
        dataType: "JSON",
        data: dados,
        success: function (retorno) {
            console.log('✅ Feedback Caramelo gravado:', retorno);
        },
        error: function (xhr, status, error) {
            console.error('❌ Erro ao gravar feedback Caramelo:', error);
        }
    });
}