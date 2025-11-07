$(document).ready(function () {
    window.addEventListener("DOMContentLoaded", (event) => {
        document.getElementById('divChamaBot').addEventListener('click', function () {
            document.getElementById('chat-window').classList.toggle('hidden');
        });
    });

    let base64 = '';

    $('#send-message').on('click', function () {
        var temTexto = $('#chat-input').attr('attr-conteudoTexto') === '1';
        var temImagem = $('#file-input').attr('attr-conteudoImagem') === '1';

        setInterval(verificarLoader, 250);

        switch (true) {
            case temTexto && temImagem:
                enviarMidiaMensagem(base64);
                base64 = '';

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

        $('textarea').css('height', '88px');
        $('#chat-input').attr('attr-conteudoTexto', '0');
        $('#file-input').attr('attr-conteudoImagem', '0');
        $('#file-input').val('');
        $('#chat-input').val('');
        $('#chat-input').text('');
        $('#preview').attr('src', `${BASE_URL}/tom/img/capaPreview.png`);
        $('#preview').css('display', 'none');
        $('#contadorInputTom').text('2000 caracteres restantes');
    });

    $("#chat-input").on("input", function (e) {
        this.style.height = "auto";
        atualizarContador();
    });

    var placeholders = [
        'O que você sabe fazer?',
        'Como posso pedir para revisar um texto?',
        'Como posso pedir para criar um texto?',
        'Quais os tipos de mensagens você pode ajudar?',
        'Reescreva de forma mais descontraída "O TEXTO"',
        'Sobre emojis quais eu devo utilizar e quais não devo?',
        'Como posso escrever um texto mais acessível?'
    ];

    var index = 0;

    $('#chat-input').attr('placeholder', placeholders[index]);

    index = (index + 1)

    setInterval(function () {
        $('#chat-input').addClass('fade');
        setTimeout(function () {
            $('#chat-input').attr('placeholder', placeholders[index]);
            $('#chat-input').removeClass('fade');
            index = (index + 1) % placeholders.length;
        }, 500); 
    }, 3000);

    $('#chat-input').focus(function () {
        $(this).attr('placeholder', '');
    }).blur(function () {
        $(this).attr('placeholder', placeholders[index]);
    });

    $('#btnLimparContexto').on('click', function () {
        $('textarea').css('height', '108px');
        $('#chat-input').attr('attr-conteudoTexto', '0');
        $('#file-input').attr('attr-conteudoImagem', '0');
        $('#file-input').val('');
        $('#chat-input').val('');
        $('#preview').attr('src', `${BASE_URL}/tom/img/capaPreview.png`);
        $('#preview').css('display', 'none');
        atualizarContador();
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

    $("#chat-input").on('focus', function () {
        $("#chat-input-container").css("border-bottom", "2px solid #4668FF");
    });

    $(document).on('click', function (e) {
        const cliqueInput = document.activeElement === document.getElementById('chat-input');
        const cliqueForaInput = !$(e.target).is('#chat-input');
        const CliqueForaSugestao = !$(e.target).closest('.sugestao').length;


        if (cliqueForaInput && CliqueForaSugestao && !cliqueInput) {
            $("#chat-input-container").css('border-bottom', 'none');
        }
    });

    function enviarMensagem() {
        var caminhoController = `${BASE_URL}/tom/controller.php`;

        const inputElement = document.getElementById('chat-input');
        var message = inputElement.value.trim();
        message = message.replace(/(?:\r\n|\r|\n)/g, '<br>');
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
            data: {
                request: 'consultarContexto'
            },
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
                exibirMensagem('Tom', '<div class="loader" attr-dataHora="' + Date.now() + '"><span></span><span></span><span></span></div>', 'bot');
                verificarElemento(60000);
                inputElement.value = '';

                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 60000);

                //MOCK 
                setTimeout(() => {

                    $('.message.bot').last().remove();

                    const hora = new Date().toLocaleTimeString('pt-BR', {hour: '2-digit', minute: '2-digit'});
                    const respBotMock = `
                            Aqui está uma sugestão pra você:<br><br>
                            "Os cartões do BB são pensados pra facilitar sua vida e oferecer vantagens incríveis.
                            Com eles, você pode fazer compras no Brasil e no exterior, parcelar suas despesas e ainda
                            acumular pontos pra trocar por produtos, serviços ou milhas. Além disso, tem opções de cartões
                            com anuidade zero e benefícios exclusivos, como seguros e assistências."<br><br>
                            Esta mensagem é uma sugestão. Antes de utilizar, analise o conteúdo 😉
                            <span class="hora-msg" style="float: right; font-size: 12px; color: #777;">${hora}</span>
                        `;

                    exibirFeedbackTom(respBotMock);

                }, 1200);

                return;
                //FIM MOCK


                fetch('https://acs-assist-bot-cad-guia.nia.servicos.bb.com.br/acs/llms/agent', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    mode: 'cors',
                    body: jsonBodyParsed,
                    signal: controller.signal
                })
                    .then(response => {
                        clearTimeout(timeoutId);
                        if (!response.ok) {
                            $('.message.bot').last().remove();
                            gravaCodigoResposta('Tom Textual', message, response.status);
                            exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                            throw new Error(`Erro ${response.status}: ${response.statusText}`);
                        }

                        return response.json();
                    })

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
                        exibirMensagem('Tom', respBotTachado, 'bot');
                        $('.message.bot').last().append('<br><button id="copiarTexto" title="Copiar texto no formato WhatsApp" style="background-color: #465eff;color: white;border: none;padding: 8px 12px;border-radius: 5px;cursor: pointer;font-size: 16px;float: right;" class=""><i class="fa fa-copy" style="color: #FFFFFF;" aria-hidden="true"></i></button>');
                        setTimeout(function () {
                            $('#chat-content').animate({scrollTop: $('#chat-content')[0].scrollHeight}, 'fast');
                        }, 150);

                        contextoConversa = JSON.stringify(jsonObject.data.context);
                        const idConversa = (jsonObject.data.context.conversation_id);
                        const idUsuario = data.userId;
                        const inputUsuario = message;
                        const codResposta = data.status;

                        gravaCodigoResposta('Tom Textual', inputUsuario, codResposta);
                        gravarConversa(idConversa, idUsuario, 'Texto', inputUsuario, respBotPulaLinha, contextoConversa);
                    })
                    .catch(error => {
                        console.error('Erro enviarMensagem:', error);
                        if (error.name === 'AbortError') {
                            console.error('Erro 1: ', error);
                            gravaCodigoResposta('Tom Textual', message, '0');
                            $('.message.bot').last().remove();
                            exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                        } else {
                            console.error('Erro 2:', error);
                            gravaCodigoResposta('Tom Textual', message, '0');
                            $('.message.bot').last().remove();
                            exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                        }
                    });
                retorno = null;
            }
        });
    }

    function exibirFeedbackTom(mensagemBot) {
        console.log('💬 exibirFeedbackTom chamado com:', mensagemBot?.substring(0, 60));

        const messageHtml = `
        <div class="message bot" style="position: relative;">
            <strong>Tom:</strong> ${mensagemBot}
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

        $('#chat-content').animate({scrollTop: $('#chat-content')[0].scrollHeight}, 'fast');

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
                    "Vamos usar seu feedback para melhorar ainda mais o Tom"
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
                    "Vamos usar seu feedback para melhorar ainda mais o Tom"
                );
            });
    }

    function enviarMidiaMensagem(dadosBase64) {
        var caminhoController = `${BASE_URL}/tom/controller.php`;

        var midia = dadosBase64;

        const inputElement = document.getElementById('chat-input');
        var message = inputElement.value.trim();
        message = message.replace(/(?:\r\n|\r|\n)/g, '<br>');
        message = message.replace(/"/g, "'");

        exibirMensagem('Você', message + '<br><br><img src="' + midia + '" style="width: 200px; float: right;" />', 'user');
        exibirMensagem('Tom', '<div class="loader" attr-dataHora="' + Date.now() + '"><span></span><span></span><span></span></div>', 'bot');
        verificarElemento(120000);

        var contexto = '';
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
            success: function (retorno) {
                if ((retorno === null) || (retorno.length == 0)) {
                    contextoTratado = '{"system": {"dialog_turn_counter": 0},"messages": []}';
                } else {
                    contexto = JSON.stringify(retorno);
                    contextoNovo = (contexto.replace(/\\"/g, '"'));
                    contextoNovo = (contextoNovo.replace(/\\"/g, '\"'));
                    contextoTratado = contextoNovo.substring(1, contextoNovo.length - 1);
                }

                const jsonBody = '{"data":{"input": "Extraia o conteúdo da imagem e resuma as principais informações", "images":["' + midia + '"],"context": ' + contextoTratado + '}}';
                const jsonString = JSON.stringify(jsonBody);
                const jsonBodyParsed = JSON.parse(jsonString);
                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 60000);

                fetch('https://acs-assist-mdl-cad-tom.nia.hm.bb.com.br/acs/llms/agent', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    mode: 'cors',
                    body: jsonBodyParsed,
                    signal: controller.signal
                })
                    .then(response => {
                        clearTimeout(timeoutId);
                        if (!response.ok) {
                            $('.message.bot').last().remove();
                            gravaCodigoResposta('Tom Mídias', message + '<br><br><img src="' + midia + '" style="width: 200px; float: right;" />', response.status);
                            exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                            throw new Error(`Erro ${response.status}: ${response.statusText}`);
                        }

                        return response.json();
                    })
                    .catch(error => {
                        if (error.name === 'AbortError') {
                            console.error('Erro: ', error);
                            gravaCodigoResposta('Tom Mídias', message + '<br><br><img src="' + midia + '" style="width: 200px; float: right;" />', error.status);
                            $('.message.bot').last().remove();
                            exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                        } else {
                            console.error('Erro:', error);
                            gravaCodigoResposta('Tom Mídias', message + '<br><br><img src="' + midia + '" style="width: 200px; float: right;" />', error.status);
                            $('.message.bot').last().remove();
                            exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                        }
                    })
                    .then(data => {
                        const jsonString = (JSON.stringify(data));
                        const jsonObject = JSON.parse(jsonString);
                        const respBotMidia = (jsonObject.data.output.text[0]);
                        respBotMidiaPulaLinha = respBotMidia.replace(/(?:\r\n|\r|\n)/g, '<br>');
                        respBotMidiaNegrito = respBotMidiaPulaLinha.replace(/\*\*(.*?)\*\*/g, '<b>$1</b>');
                        respBotMidiaItalico = respBotMidiaNegrito.replace(/\*([^*]+)\*/g, '<i>$1</i>');
                        respBotMidiaItalico2 = respBotMidiaItalico.replace(/_([^_]+)_/g, '<i>$1</i>');
                        respBotMidiaTachado = respBotMidiaItalico2.replace(/~~(.*?)~~/g, '<strike>$1</strike>');

                        $.ajax({
                            aSync: false,
                            url: caminhoController,
                            data: {
                                request: 'consultarContexto'
                            },
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

                                const jsonBody = '{"data":{"input": "' + message + ' ' + respBotMidiaTachado + '", "context": ' + contextoTratado + '}}';
                                const jsonString = JSON.stringify(jsonBody);
                                const jsonBodyParsed = JSON.parse(jsonString);
                                inputElement.value = '';
                                let inputUsuario = '';

                                const controller = new AbortController();
                                const timeoutId = setTimeout(() => controller.abort(), 60000);

                                fetch('https://acs-assist-bot-cad-guia.nia.servicos.bb.com.br/acs/llms/agent', {
                                    method: 'POST',
                                    headers: {
                                        'Accept': 'application/json',
                                        'Content-Type': 'application/json'
                                    },
                                    mode: 'cors',
                                    body: jsonBodyParsed,
                                    signal: controller.signal
                                })
                                    .then(response => {
                                        clearTimeout(timeoutId);
                                        if (!response.ok) {
                                            $('.message.bot').last().remove();
                                            gravaCodigoResposta('Tom Texto acionado pós Mídia 1', message + ' ' + respBotMidiaTachado, response.status);
                                            exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                                            return false;
                                        }

                                        return response.json();
                                    })
                                    .catch(error => {
                                        if (error.name === 'AbortError') {
                                            console.error('Erro: ', error);
                                            gravaCodigoResposta('Tom Texto acionado pós Mídia 2', message + '<br><br><img src="' + midia + '" style="width: 200px; float: right;" />', error.status);
                                            $('.message.bot').last().remove();
                                            exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                                        } else {
                                            console.error('Erro:', error);
                                            gravaCodigoResposta('Tom Texto acionado pós Mídia 3', message + '<br><br><img src="' + midia + '" style="width: 200px; float: right;" />', error.status);
                                            $('.message.bot').last().remove();
                                            exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                                        }
                                    })
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
                                        exibirMensagem('Tom', respBotTachado, 'bot');
                                        $('.message.bot').last().append('<br><button id="copiarTexto" title="Copiar texto no formato WhatsApp" style="background-color: #465eff;color: white;border: none;padding: 8px 12px;border-radius: 5px;cursor: pointer;font-size: 16px;float: right;" class=""><i class="fa fa-copy" style="color: #FFFFFF;" aria-hidden="true"></i></button>');
                                        setTimeout(function () {
                                            $('#chat-content').animate({scrollTop: $('#chat-content')[0].scrollHeight}, 'fast');
                                        }, 150);

                                        contextoConversa = JSON.stringify(jsonObject.data.context);
                                        const idConversa = (jsonObject.data.context.conversation_id);
                                        const idUsuario = data.userId;
                                        inputUsuario = message + ' ' + respBotMidiaTachado;
                                        const codResposta = data.status;

                                        gravarConversa(idConversa, idUsuario, 'Texto e Mídia', inputUsuario, respBotPulaLinha, contextoConversa);
                                        gravaCodigoResposta('Tom Texto acionado pós Mídia 4', inputUsuario, codResposta);
                                    })
                                    .catch(error => {
                                        console.error('Erro:', error);
                                        const codResposta = data.status;

                                        gravaCodigoResposta('Tom Texto acionado pós Mídia 5', inputUsuario, codResposta);
                                        $('.message.bot').last().remove();
                                        exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                                    });
                                retorno = null;
                            }
                        });
                    })
                    .catch(error => {
                        const statusMatch = error.message.match(/Erro (\d+):/);
                        const codResposta = statusMatch ? parseInt(statusMatch[1]) : 0;

                        gravaCodigoResposta('Tom Mídias antes do Texto', message + '<br><br><img src="' + midia + '" style="width: 200px; float: right;" />', codResposta);
                        $('.message.bot').last().remove();
                        exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                    });
                retorno = null;
            }
        });
    }

    function enviarImagem(dadosBase64) {
        var caminhoController = `${BASE_URL}/tom/controller.php`;

        var message = dadosBase64;

        var contexto = '';
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
            success: function (retorno) {
                if ((retorno === null) || (retorno.length == 0)) {
                    contextoTratado = '{"system": {"dialog_turn_counter": 0},"messages": []}';
                } else {
                    contexto = JSON.stringify(retorno);
                    contextoNovo = (contexto.replace(/\\"/g, '"'));
                    contextoNovo = (contextoNovo.replace(/\\"/g, '\"'));
                    contextoTratado = contextoNovo.substring(1, contextoNovo.length - 1);
                }

                const jsonBody = '{"data":{"input": "Extraia o conteúdo da imagem e resuma as principais informações", "images":["' + message + '"],"context": ' + contextoTratado + '}}';
                const jsonString = JSON.stringify(jsonBody);
                const jsonBodyParsed = JSON.parse(jsonString);
                exibirMensagem('Você', 'Analise a imagem selecionada <br><br> <img src="' + message + '" style="width: 200px; float: right;" />', 'user');
                exibirMensagem('Tom', '<div class="loader" attr-dataHora="' + Date.now() + '"><span></span><span></span><span></span></div>', 'bot');
                verificarElemento(60000);

                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 60000);

                fetch('https://acs-assist-mdl-cad-tom.nia.hm.bb.com.br/acs/llms/agent', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    mode: 'cors',
                    body: jsonBodyParsed,
                    signal: controller.signal
                })
                    .then(response => {
                        clearTimeout(timeoutId);
                        if (!response.ok) {
                            $('.message.bot').last().remove();
                            gravaCodigoResposta('Tom Mídias', message + '<br><br><img src="' + base64 + '" style="width: 200px; float: right;" />', response.status);
                            exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                            throw new Error(`Erro ${response.status}: ${response.statusText}`);
                        }

                        return response.json();
                    })
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
                        exibirMensagem('Tom', respBotTachado, 'bot');
                        $('.message.bot').last().append('<br><button id="copiarTexto" title="Copiar texto no formato WhatsApp" style="background-color: #465eff;color: white;border: none;padding: 8px 12px;border-radius: 5px;cursor: pointer;font-size: 16px;float: right;" class=""><i class="fa fa-copy" style="color: #FFFFFF;" aria-hidden="true"></i></button>');
                        setTimeout(function () {
                            $('#chat-content').animate({scrollTop: $('#chat-content')[0].scrollHeight}, 'fast');
                        }, 150);

                        contextoConversa = JSON.stringify(jsonObject.data.context);
                        const idConversa = (jsonObject.data.context.conversation_id);
                        const idUsuario = data.userId;
                        const inputUsuario = message;
                        const codResposta = data.status;

                        gravarConversa(idConversa, idUsuario, 'Mídia', inputUsuario, respBotPulaLinha, '');
                        gravaCodigoResposta('Tom Mídias', inputUsuario, codResposta);
                    })
                    .catch(error => {
                        if (error.name === 'AbortError') {
                            console.error('Erro: ', error);
                            gravaCodigoResposta('Tom Mídias', message + '<br><br><img src="' + base64 + '" style="width: 200px; float: right;" />', '0');
                            $('.message.bot').last().remove();
                            exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                        } else {
                            console.error('Erro:', error);
                            gravaCodigoResposta('Tom Mídias', message + '<br><br><img src="' + base64 + '" style="width: 200px; float: right;" />', error.status);
                            $('.message.bot').last().remove();
                            exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                        }
                    })

                retorno = null;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Erro na requisição AJAX:");
                console.error("Status: " + textStatus);
                console.error("Código HTTP: " + jqXHR.status);
                console.error("Mensagem: " + errorThrown);

                const codResposta = jqXHR.status;
                gravaCodigoResposta('Tom Mídias', inputUsuario, codResposta);
            }
        });


        $.ajax({
            aSync: false,
            url: caminhoController,
            data: {
                request: 'consultarContexto'
            },
            type: "GET",
            dataType: "JSON",
            dataSrc: "",
            success: function (retorno) {},
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Erro na requisição AJAX:");
                console.error("Status: " + textStatus);
                console.error("Código HTTP: " + jqXHR.status);
                console.error("Mensagem: " + errorThrown);
            }
        });

    }

    $(document).on('click', '.sugestao', function () {
        const textoBotao = $(this).text();
        const textArea = $('#chat-input');
        var valorAtual = textArea.val();

        const regex = /\b(Resumir texto|Criar texto|Revisar texto|Criar Jornada)\b\s*$/;

        if (regex.test(valorAtual)) {
            valorAtual = valorAtual.trim().replace(regex, '');
            textArea.val(valorAtual.trim() + ' ' + textoBotao.trim());
        } else {
            textArea.val(valorAtual.trim() + ' ' + textoBotao.trim());
        }
        valorAtual = textArea.val();
        atualizarContador();
    });

    $('.anexarArquivo').on('click', function () {
        $('#file-input').click();
    });

    $('#file-input').on('change', function () {
        $(this).attr('attr-conteudoImagem', '1');
        const file = this.files[0];
        if (file) {
            const leitor = new FileReader();
            leitor.onload = function (e) {
                base64 = e.target.result;
            };
            leitor.readAsDataURL(file);
            preview.src = URL.createObjectURL(file)
            $("#preview").css("display", "block");
        }
    });

    function exibirMensagem(sender, message, type) {
        const messagesElement = document.getElementById('chat-content');
        const messageElement = document.createElement('div');
        messageElement.classList.add('message');
        messageElement.classList.add(type);
        if (sender != 'Você') {
            messageElement.innerHTML = `<strong>${sender}: </strong>${message}`;
        } else {
            messageElement.innerHTML = message;
        }
        messagesElement.appendChild(messageElement);
        setTimeout(() => {
            messagesElement.scrollTop = messagesElement.scrollHeight;
        }, 100);

    }

    function gravarConversa(idConversa, idUsuario, tipoInput, inputUsuario, respostaBot, contextoConversa) {
        var caminhoController = `${BASE_URL}/tom/controller.php`;
        var respostaBotTratada = respostaBot.replace(/\\+/g, '\\');
        var contextoConversaTratada = contextoConversa.replace(/\\+/g, '\\');
        var botaoLimpaContexto = $("#btnLimparContexto").attr('attr-idConversa');

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
                tipoInput: tipoInput,
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
        var caminhoController = `${BASE_URL}/tom/controller.php`;
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
        $('#chat-content').html('<div id="chat-messages"></div><div class="message bot"><strong></strong> Olá, ' + nomeUsuario + '! Eu sou o Tom, seu assistente virtual revisor e criador de textos do CAD BB. Como posso te ajudar?</div>');
    }

    async function gravaCodigoResposta(nomeBot, inputUsuario, codResposta) {
        var caminhoController = `${BASE_URL}/tom/controller.php`;
        var inputUsuario = String(inputUsuario || '').replace(/\\+/g, '\\');

        $.ajax({
            async: true,
            url: caminhoController,
            data: {
                request: 'gravaCodigoResposta',
                nomeBot: nomeBot,
                inputUsuario: inputUsuario,
                codResposta: codResposta
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",

            success: function (retorno) {},
            error: function (xhr, status, error) {
                console.error('Log erro grava código:', error);
            }

        });
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
            .replace(/<[^>]+>/g, '')
            .trim();
    }

    function decodeHtmlEntities(text) {
        const textarea = document.createElement('textarea');
        textarea.innerHTML = text;
        return textarea.value;
    }

    function verificarElemento(tempoEspera) {
        const target = $('.loader');
        setInterval(function () {
            if (target.is(':visible')) {
                const startTime = target.attr('attr-dataHora');
                const currentTime = Date.now();
                const elapsed = currentTime - startTime;

                if (elapsed > tempoEspera) {
                    $('.message.bot').last().remove();
                    exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                }
            }
        }, 5000);
    }

    $(document).on('click', '#copiarTexto', function () {
        const $button = $(this);
        const $botMessage = $button.closest('.message.bot');
        const htmlContent = $botMessage.html();
        const decodedHtml = decodeHtmlEntities(htmlContent);
        const whatsappText = htmlWhatsapp(decodedHtml);

        navigator.clipboard.writeText(whatsappText).then(function () {
            $button.addClass('flash');
            setTimeout(() => $button.removeClass('flash'), 150);
        }).catch(function (err) {
            console.error('Erro ao copiar:', err);
        });
    });

    $(document).on('click', '#btnLimparContextoConversa', function () {
        $('#btnLimparContexto').trigger('click');
        location.reload();
    });

    function atualizarContador() {
        maxLength = 2000;
        const textArea = $('#chat-input');
        let length = textArea.val().length;
        let restante = maxLength - length;
        if (restante === maxLength) {
            textArea.attr('attr-conteudoTexto', '0');
        } else {
            textArea.attr('attr-conteudoTexto', '1');
        }

        if (restante < 0) {
            textArea.val(textArea.val().substring(0, maxLength));
            restante = 0;
        }

        $('#contadorInputTom').text(restante + ' caracteres restantes');
    }

    function verificarLoader() {
        const loader = $('.loader');
        const botaoEnviar = $('#send-message');
        const botaoLimparContexto = $('#btnLimparContexto');

        if (loader.length && loader.is(':visible')) {
            botaoEnviar.prop('disabled', true).css({
                'opacity': '0.5',
                'cursor': 'not-allowed'
            });
            botaoLimparContexto.prop('disabled', true).css({
                'opacity': '0.5',
                'cursor': 'not-allowed'
            });
        } else {
            botaoEnviar.prop('disabled', false).css({
                'opacity': '1',
                'cursor': 'pointer'
            });
            botaoLimparContexto.prop('disabled', false).css({
                'opacity': '1',
                'cursor': 'pointer'
            });
        }
    }

    function processFile(file) {
        if (!file.type.startsWith('image/')) {
            alert('Desculpe, eu sei ler apenas arquivos de imagens 😿.');
            return;
        }

        $('#file-input').attr('attr-conteudoImagem', '1');

        const leitor = new FileReader();
        leitor.onload = function (e) {
            base64 = e.target.result;
        };
        leitor.readAsDataURL(file);

        const $previewImg = $('#preview');
        if ($previewImg.length) {
            $previewImg.attr('src', URL.createObjectURL(file));
            $('#preview').css('display', 'block');
        } else {
            console.warn('Elemento #preview não encontrado no DOM.');
        }
    }

    $('#file-input').on('change', function () {
        const file = this.files[0];
        if (file) {
            processFile(file);
        }
    });

    $('#chat-input-container').on('dragenter dragover', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).css('opacity', '0.5');

    });

    $('#chat-input-container').on('dragleave drop', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).css('opacity', '1');
    });

    $('#chat-input-container').on('drop', function (e) {
        const files = e.originalEvent.dataTransfer.files;
        if (files.length > 0) {
            processFile(files[0]);
        }
    });
});

window.gravaFeedback = function (mensagemBot, comentarioUsuario, avaliacao, rating = null) {
    var caminhoController = `${BASE_URL}/tom/controller.php`;
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
            console.log('✅ Feedback Tom gravado:', retorno);
        },
        error: function (xhr, status, error) {
            console.error('❌ Erro ao gravar feedback Tom:', error);
        }
    });
};
