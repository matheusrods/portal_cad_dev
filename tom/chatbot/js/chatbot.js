$(document).ready(function () {
    
    // Abrir a janela do chat
    window.addEventListener("DOMContentLoaded", (event) => {
        document.getElementById('divChamaBot').addEventListener('click', function() {
            document.getElementById('chat-window').classList.toggle('hidden');
        });
    });

    let base64 = '';

    $('#send-message').on('click', function() {
        // Converte os atributos para booleanos
        var temTexto = $('#chat-input').attr('attr-conteudoTexto') === '1';
        var temImagem = $('#file-input').attr('attr-conteudoImagem') === '1';

        // Verifica a cada 250ms
        setInterval(verificarLoader, 250);

        switch (true) {
            case temTexto && temImagem:
                enviarMidiaMensagem(base64);
                base64 = '';

                break;

        
            case temTexto && !temImagem:
                // console.log('enviarMensagem');
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

    // Função para que o textarea onde é digitada a pergunta seja automaticamente aumentado quando se digita um texto maior que a altura dele
    $("#chat-input").on("input", function (e) {
        this.style.height = "auto";
        // this.style.height = this.scrollHeight + "px";

        // var maxLength = 2000;
        // //e.stopPropagation();
        // //e.stopImmediatePropagation();
        // var length = $(this).val().length;
        // var restante = maxLength - length;

        // if(restante == maxLength){
        //     $(this).attr('attr-conteudoTexto', '0');
        // } else {
        //     $(this).attr('attr-conteudoTexto', '1');
        // }

        // $('#contadorInputTom').text(restante + ' caracteres restantes');
        // if (restante < 0) {
        //     $(this).val($(this).val().substring(0, maxLength));
        //     $('#contadorInputTom').text('0 caracteres restantes');
        // }

        atualizarContador();
        
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
        $('textarea').css('height', '108px');
        $('#chat-input').attr('attr-conteudoTexto', '0');
        $('#file-input').attr('attr-conteudoImagem', '0');
        $('#file-input').val('');
        $('#chat-input').val('');
        $('#preview').attr('src', `${BASE_URL}/tom/img/capaPreview.png`);
        $('#preview').css('display', 'none');
        atualizarContador();
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

    // Função para que seja incluida a borda azul abaixo do textarea quando está selecionada
    $("#chat-input").on('focus', function(){
        $("#chat-input-container").css("border-bottom", "2px solid #4668FF");
    });

    $(document).on('click', function(e) {
        // Se o clique NÃO foi dentro do input
        const cliqueInput = document.activeElement === document.getElementById('chat-input');    
        const cliqueForaInput = !$(e.target).is('#chat-input');
        const CliqueForaSugestao = !$(e.target).closest('.sugestao').length;

        
        if (cliqueForaInput && CliqueForaSugestao && !cliqueInput) {
        $("#chat-input-container").css('border-bottom', 'none');
        }
    });

    // Função para enviar a mensagem
    function enviarMensagem() {
        var caminhoController = `${BASE_URL}/tom/controller.php`;
        
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
                // console.log(jsonBodyParsed);
                exibirMensagem('Você', message, 'user');
                exibirMensagem('Tom', '<div class="loader" attr-dataHora="'+Date.now()+'"><span></span><span></span><span></span></div>', 'bot');
                verificarElemento(60000);
                inputElement.value = '';

                // Enviar a mensagem para a API Produção
                // fetch('https://acs-assist-bot-cad-guia.nia.servicos.bb.com.br/acs/llms/agent', {
                //     method: 'POST',
                //     headers: {
                //         'Accept': 'application/json',
                //         'Content-Type': 'application/json'
                //     },
                //     mode: 'cors',
                //     body: jsonBodyParsed
                // })
                // // .then(response => response.json())

                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 60000); // 60 segundos

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
                        // Lança erro com o status e statusText
                        throw new Error(`Erro ${response.status}: ${response.statusText}`);
                    }
                    
                    return response.json();

                    // if (!response.ok) {
                    //     $('.message.bot').last().remove();
                    //     gravaCodigoResposta('Tom Textual', message, response.status);
                    //     exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                    //     // Lança erro com o status e statusText
                    //     throw new Error(`Erro ${response.status}: ${response.statusText}`);
                    // }
                    
                    // return response.json();
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
                    setTimeout(function(){
                        $('#chat-content').animate({ scrollTop: $('#chat-content')[0].scrollHeight }, 'fast');
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
                    // gravaCodigoResposta('Tom Textual', message, codResposta);
                    // $('.message.bot').last().remove();
                    // exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');

                    if (error.name === 'AbortError') {
                        console.error('Erro 1: ',error);
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

    function enviarMidiaMensagem(dadosBase64) {
        var caminhoController = `${BASE_URL}/tom/controller.php`;
        
        var midia = dadosBase64;

        const inputElement = document.getElementById('chat-input');
        var message = inputElement.value.trim();
        message = message.replace(/(?:\r\n|\r|\n)/g, '<br>');
        message = message.replace(/"/g, "'");

        exibirMensagem('Você', message+'<br><br><img src="'+midia+'" style="width: 200px; float: right;" />', 'user');
        exibirMensagem('Tom', '<div class="loader" attr-dataHora="'+Date.now()+'"><span></span><span></span><span></span></div>', 'bot');
        verificarElemento(120000);
        
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

                // Variáveis de controle de timeout
                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 60000); // 60 segundos

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
                    // console.log('then(response)');
                    clearTimeout(timeoutId);
                    if (!response.ok) {
                        $('.message.bot').last().remove();
                        gravaCodigoResposta('Tom Mídias', message+'<br><br><img src="'+midia+'" style="width: 200px; float: right;" />', response.status);
                        exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                        // Lança erro com o status e statusText
                        throw new Error(`Erro ${response.status}: ${response.statusText}`);
                    }
                    
                    return response.json();
                })
                .catch(error => {
                    if (error.name === 'AbortError') {
                        console.error('Erro: ',error);
                        gravaCodigoResposta('Tom Mídias', message+'<br><br><img src="'+midia+'" style="width: 200px; float: right;" />', error.status);
                        $('.message.bot').last().remove();
                        exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                    } else {
                        console.error('Erro:', error);
                        gravaCodigoResposta('Tom Mídias', message+'<br><br><img src="'+midia+'" style="width: 200px; float: right;" />', error.status);
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
                            inputElement.value = '';
                            let inputUsuario = '';

                            const controller = new AbortController();
                            const timeoutId = setTimeout(() => controller.abort(), 60000); // 60 segundos

                            // Enviar a mensagem para a API Produção
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
                                    gravaCodigoResposta('Tom Texto acionado pós Mídia 1', message+' '+respBotMidiaTachado, response.status);
                                    exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                                    // Lança erro com o status e statusText
                                    // throw new Error(`Erro ${response.status}: ${response.statusText}`);
                                    return false;
                                }
                                
                                return response.json();
                            })
                            .catch(error => {
                                if (error.name === 'AbortError') {
                                    console.error('Erro: ',error);
                                    gravaCodigoResposta('Tom Texto acionado pós Mídia 2', message+'<br><br><img src="'+midia+'" style="width: 200px; float: right;" />', error.status);
                                    $('.message.bot').last().remove();
                                    exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                                } else {
                                    console.error('Erro:', error);
                                    gravaCodigoResposta('Tom Texto acionado pós Mídia 3', message+'<br><br><img src="'+midia+'" style="width: 200px; float: right;" />', error.status);
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
                                setTimeout(function(){
                                    $('#chat-content').animate({ scrollTop: $('#chat-content')[0].scrollHeight }, 'fast');
                                }, 150);
                                
                                contextoConversa = JSON.stringify(jsonObject.data.context);
                                const idConversa = (jsonObject.data.context.conversation_id);
                                const idUsuario = data.userId;
                                inputUsuario = message+' '+respBotMidiaTachado;
                                const codResposta = data.status;
                                
                                gravarConversa(idConversa, idUsuario, 'Texto e Mídia', inputUsuario, respBotPulaLinha, contextoConversa);
                                gravaCodigoResposta('Tom Texto acionado pós Mídia 4', inputUsuario, codResposta);
                            })
                            .catch(error => {
                                console.error('Erro:', error);
                                const codResposta = data.status;
                                
                                gravaCodigoResposta('Tom Texto acionado pós Mídia 5',  inputUsuario, codResposta);
                                $('.message.bot').last().remove();
                                exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                            });
                            retorno = null;
                        }
                    });
                })
                .catch(error => {
                    // Captura o código de status do erro, se estiver na mensagem
                    const statusMatch = error.message.match(/Erro (\d+):/);
                    const codResposta = statusMatch ? parseInt(statusMatch[1]) : 0;

                    gravaCodigoResposta('Tom Mídias antes do Texto', message+'<br><br><img src="' + midia + '" style="width: 200px; float: right;" />', codResposta);
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
                exibirMensagem('Tom', '<div class="loader" attr-dataHora="'+Date.now()+'"><span></span><span></span><span></span></div>', 'bot');
                verificarElemento(60000);

                // Enviar a mensagem para a API de Mídia - Produção
                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 60000); // 60 segundos

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
                        gravaCodigoResposta('Tom Mídias', message+'<br><br><img src="'+base64+'" style="width: 200px; float: right;" />', response.status);
                        exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                        // Lança erro com o status e statusText
                        throw new Error(`Erro ${response.status}: ${response.statusText}`);
                    }
                    
                    return response.json();
                })
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
                    exibirMensagem('Tom', respBotTachado, 'bot');
                    $('.message.bot').last().append('<br><button id="copiarTexto" title="Copiar texto no formato WhatsApp" style="background-color: #465eff;color: white;border: none;padding: 8px 12px;border-radius: 5px;cursor: pointer;font-size: 16px;float: right;" class=""><i class="fa fa-copy" style="color: #FFFFFF;" aria-hidden="true"></i></button>');
                    setTimeout(function(){
                        $('#chat-content').animate({ scrollTop: $('#chat-content')[0].scrollHeight }, 'fast');
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
                        console.error('Erro: ',error);
                        gravaCodigoResposta('Tom Mídias', message+'<br><br><img src="'+base64+'" style="width: 200px; float: right;" />', '0');
                        $('.message.bot').last().remove();
                        exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                    } else {
                        console.error('Erro:', error);
                        gravaCodigoResposta('Tom Mídias', message+'<br><br><img src="'+base64+'" style="width: 200px; float: right;" />', error.status);
                        $('.message.bot').last().remove();
                        exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                    }
                })

                // fetch('https://acs-assist-mdl-cad-tom.nia.hm.bb.com.br/acs/llms/agent', {
                //     method: 'POST',
                //     headers: {
                //         'Accept': 'application/json',
                //         'Content-Type': 'application/json'
                //     },
                //     mode: 'cors',
                //     body: jsonBodyParsed
                // })
                // .then(response => response.json())
                // .then(data => {
                //     // console.log('Resposta do servidor:', data);
                    
                //     const jsonString = (JSON.stringify(data));
                //     const jsonObject = JSON.parse(jsonString);
                //     const respBot = (jsonObject.data.output.text[0]);
                //     respBotPulaLinha = respBot.replace(/(?:\r\n|\r|\n)/g, '<br>');
                //     respBotNegrito = respBotPulaLinha.replace(/\*\*(.*?)\*\*/g, '<b>$1</b>');
                //     respBotItalico = respBotNegrito.replace(/\*([^*]+)\*/g, '<i>$1</i>');
                //     respBotItalico2 = respBotItalico.replace(/_([^_]+)_/g, '<i>$1</i>');
                //     respBotTachado = respBotItalico2.replace(/~~(.*?)~~/g, '<strike>$1</strike>');

                //     $('.message.bot').last().remove();
                //     exibirMensagem('Tom', respBotTachado, 'bot');
                //     $('.message.bot').last().append('<br><button id="copiarTexto" title="Copiar texto no formato WhatsApp" style="background-color: #465eff;color: white;border: none;padding: 8px 12px;border-radius: 5px;cursor: pointer;font-size: 16px;float: right;" class=""><i class="fa fa-copy" style="color: #FFFFFF;" aria-hidden="true"></i></button>');
                    
                //     contextoConversa = JSON.stringify(jsonObject.data.context);
                //     const idConversa = (jsonObject.data.context.conversation_id);
                //     const idUsuario = data.userId;
                //     const inputUsuario = message;
                //     const codResposta = data.status;

                //     gravarConversa(idConversa, idUsuario, 'Mídia', inputUsuario, respBotPulaLinha, '');
                //     gravaCodigoResposta('Tom Mídias', inputUsuario, codResposta);
                // })
                // .catch(error => {
                //     // console.error('Erro:', error);
                //     $('.message.bot').last().remove();
                //     exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                // });
                
                retorno = null;
            },
            error: function(jqXHR, textStatus, errorThrown) {
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
            success: function(retorno) {
                // ... seu código existente ...
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Erro na requisição AJAX:");
                console.error("Status: " + textStatus);
                console.error("Código HTTP: " + jqXHR.status);
                console.error("Mensagem: " + errorThrown);
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
        atualizarContador();
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
        if(sender != 'Você'){
            messageElement.innerHTML = `<strong>${sender}: </strong>${message}`;
        } else {
            messageElement.innerHTML = message;
        }
                messagesElement.appendChild(messageElement);
        // messagesElement.scrollTop = messagesElement.scrollHeight;
        setTimeout(() => {
            messagesElement.scrollTop = messagesElement.scrollHeight;
        }, 100);

    }

    // Função para gravar as conversas em BD
    function gravarConversa(idConversa, idUsuario, tipoInput, inputUsuario, respostaBot, contextoConversa){
        var caminhoController = `${BASE_URL}/tom/controller.php`;
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
                tipoInput: tipoInput,
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
        $('#chat-content').html('<div id="chat-messages"></div><div class="message bot"><strong></strong> Olá, '+nomeUsuario+'! Eu sou o Tom, seu assistente virtual revisor e criador de textos do CAD BB. Como posso te ajudar?</div>');
    }

    // Função para gravar os códigos de resposta da LLM em BD
    async function gravaCodigoResposta(nomeBot, inputUsuario, codResposta){
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
            
            success: function(retorno) {
                // console.log('Retorno gravaCodigoResposta:', retorno);
            },
            error: function(xhr, status, error) {
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
            .replace(/<[^>]+>/g, '') // remove outras tags
            .trim();
    }

    function decodeHtmlEntities(text) {
        const textarea = document.createElement('textarea');
        textarea.innerHTML = text;
        return textarea.value;
    }

    function verificarElemento(tempoEspera){
        // console.log(tempoEspera);
        const target = $('.loader');

        // Verifica a cada 5 segundos se já passou o tempo de espera que o loader está exibido
        setInterval(function () {
            if(target.is(':visible')) {
                const startTime = target.attr('attr-dataHora');
                const currentTime = Date.now();
                const elapsed = currentTime - startTime;

                if(elapsed > tempoEspera){
                    $('.message.bot').last().remove();
                    exibirMensagem('Tom', 'Desculpe, estou enfrentando problemas técnicos e não estou conseguindo consultar minha base de conhecimento 😿.<br>Você pode recarregar a página no botão abaixo ou retornar em alguns instantes.<br><button id="btnLimparContextoConversa">Recarregar página</button>', 'bot');
                }
            }
        }, 5000); // verifica a cada 5 segundos (5000ms)
    }

    $(document).on('click', '#copiarTexto', function () {
        const $button = $(this);
        const $botMessage = $button.closest('.message.bot');
        const htmlContent = $botMessage.html();

        // Decodifica entidades como &lt; e &gt; para < e >
        const decodedHtml = decodeHtmlEntities(htmlContent);

        // Aplica formatação para WhatsApp
        const whatsappText = htmlWhatsapp(decodedHtml);

        navigator.clipboard.writeText(whatsappText).then(function () {
            $button.addClass('flash');
            setTimeout(() => $button.removeClass('flash'), 150);
        }).catch(function (err) {
            console.error('Erro ao copiar:', err);
        });
    });

    $(document).on('click','#btnLimparContextoConversa', function () {
        $('#btnLimparContexto').trigger('click');
        location.reload();
    });

    // Função para atualizar o contador de caracteres
    function atualizarContador() {
        maxLength = 2000;
        const textArea = $('#chat-input');
        let length = textArea.val().length;
        let restante = maxLength - length;

        // Define atributo personalizado para indicar se há conteúdo
        if (restante === maxLength) {
            textArea.attr('attr-conteudoTexto', '0');
        } else {
            textArea.attr('attr-conteudoTexto', '1');
        }

        // Se ultrapassar o limite, corta o texto
        if (restante < 0) {
            textArea.val(textArea.val().substring(0, maxLength));
            restante = 0;
        }

        // Atualiza o contador na tela
        $('#contadorInputTom').text(restante + ' caracteres restantes');
    }

    function verificarLoader() {
        const loader = $('.loader');
        const botaoEnviar = $('#send-message');
        const botaoLimparContexto = $('#btnLimparContexto');

        // Verifica se o loader está sendo exibido e, caso sim, bloqueia o envio de novas mensagens
        if (loader.length && loader.is(':visible')) {
            // Loader está visível
            botaoEnviar.prop('disabled', true).css({
                'opacity': '0.5',
                'cursor': 'not-allowed'
            });
            botaoLimparContexto.prop('disabled', true).css({
                'opacity': '0.5',
                'cursor': 'not-allowed'
            });
        } else {
            // Loader não está visível
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

    /* Trecho de código para funcionar o drag and drop de imagens no textarea */
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

    // Evento do input file
    $('#file-input').on('change', function () {
        const file = this.files[0];
        if (file) {
            processFile(file);
        }
    });

    // Drag and Drop
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