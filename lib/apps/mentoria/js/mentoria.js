$(document).ready(function () {
    $('.subtituloTemaMentoria').on('click', function () {
        var divAtiva = $(this).attr('attr-divAtiva');
        var divClicada = $(this).attr('attr-div');

        $('.subtituloTemaMentoria').attr('attr-divAtiva', divClicada);
        $('.subtituloTemaMentoria').removeClass('temaClicadoMentoria');

        $(this).addClass('temaClicadoMentoria');
        $('.' + divAtiva + '').removeClass('visible');
        $('.' + divAtiva + '').addClass('hidden');
        $('.' + divClicada + '').removeClass('hidden');
        $('.' + divClicada + '').addClass('visible');
    });

    $('.abrirModalBioMentoria').on('click', function (e) {
        e.stopPropagation();
        var matricula = $(this).attr('attr-matricula');
        consultaBio(matricula);
    });

    var modal = $("#modalBioMentoria");
    var abreModal = $("#abrirModalBioMentoria");

    abreModal.on("click", function () {
        modal.show();
    });

    $(".close").on("click", function () {
        $('.carrossel-track').css('animation-play-state', 'running');

        var matriculaParaFechar = $(this).attr('attr-matriculaClose');
        $('.' + matriculaParaFechar + '').css('display', 'none');
    });

    $('.navigation label').click(function () {
        $('.navigation label').css('border', '');
        $(this).css('border-width', '2px');
        $(this).css('border-color', '#000');
        $(this).css('border-style', 'solid');
    });

    $('.qualDependenciaImersao').click(function () {
        var dependenciaClicada = $(this).attr('attr-dependencia');
        $('#codDependencia').val(dependenciaClicada);
        $('.qualDependenciaImersao').removeClass('botaoSelecionado');
        $(this).addClass('botaoSelecionado');

    });

    $('.voltar').click(function () {
        var divExibida = $(this).attr('attr-qualDiv');
    });

    $('.qualFormato').click(function () {
        $('.qualFormato').attr('attr-opcaoEscolhida', '0');
        $(this).attr('attr-opcaoEscolhida', '1');
        $('.qualFormato').removeClass('botaoSelecionado');
        $(this).addClass('botaoSelecionado');
    });

    $('#finalizar').click(function () {
        var focoTemas = [];
        $(':checkbox:checked').each(function (i) {
            focoTemas[i] = ' ' + $(this).val();
        });

        var dependenciaMentoria = $("#codDependencia").val();
        var necessidadeMentoria = $("#necessidadeForm").val();
        var publicoAlvo = $("#publicoAlvoForm").val();
        var canais = $("#canalDisponibilzaBotForm").val();
        var conteudos = $('input[name="sabeConteudoImportanteForm"]:checked').val();
        var experienciaEquipe = $('input[name="experienciaDevBotForm"]:checked').val();
        var totalPessoas = $("#qtdePessoasEquipeForm").val();
        var escalaConhecimento = $('input[name="nivelConhecimentoBotForm"]:checked').val();
        var formato = $('.qualFormato[attr-opcaoEscolhida="1"]').attr('attr-qualOpcao');
        var matricula = $('.formularioSolicitacaoMentoria').attr('attr-matricula');
        var nome = $('.formularioSolicitacaoMentoria').attr('attr-nome');
        var email = $('.formularioSolicitacaoMentoria').attr('attr-email');

        var mensagemErro = 'Necessário: <br><br>';
        var contaErros = 0;

        if (dependenciaMentoria.length == 0) {
            mensagemErro = mensagemErro + "-Preencher Dependência;<br>";
            contaErros = ++contaErros;
        }
        if (necessidadeMentoria.length == 0) {
            mensagemErro = mensagemErro + "-Informar qual a necessidade;<br>";
            contaErros = ++contaErros;
        }
        if (publicoAlvo.length == 0) {
            mensagemErro = mensagemErro + "-Qual o Público Alvo;<br>";
            contaErros = ++contaErros;
        }
        if (canais.length == 0) {
            mensagemErro = mensagemErro + "-Informar o canal onde o assistente será disponibilizado;<br>";
            contaErros = ++contaErros;
        }
        if (conteudos === undefined) {
            mensagemErro = mensagemErro + "-Informar se já sabe os conteúdos do assistente;<br>";
            contaErros = ++contaErros;
        }
        if (experienciaEquipe === undefined) {
            mensagemErro = mensagemErro + "-Informar se a Equipe tem conhecimento com desenvolvimento de assistentes virtuais;<br>";
            contaErros = ++contaErros;
        }
        if (totalPessoas.length == 0) {
            mensagemErro = mensagemErro + "-Preencher o total de pessoas que participarão da equipe;<br>";
            contaErros = ++contaErros;
        }
        if (escalaConhecimento === undefined) {
            mensagemErro = mensagemErro + "-Informar o grau de conhecimento;<br>";
            contaErros = ++contaErros;
        }
        if (focoTemas.length == 0) {
            mensagemErro = mensagemErro + "-Informar os temas que deverão ser abordados;<br>";
            contaErros = ++contaErros;
        }
        if (formato === undefined) {
            mensagemErro = mensagemErro + "-Informar o formato desejado;<br>";
            contaErros = ++contaErros;
        }

        mensagemErro = mensagemErro.substring(0, mensagemErro.length - 5) + '.';

        if (contaErros == 0) {
            gravaSolicitacao(matricula, nome, email, dependenciaMentoria, necessidadeMentoria, publicoAlvo, canais, conteudos, experienciaEquipe, totalPessoas, escalaConhecimento, focoTemas, formato);
        } else {
            bootbox.dialog({
                backdrop: true,
                onEscape: function () {
                },
                size: 'medium',
                title: "Atenção",
                message: '<div>' + mensagemErro + '</div>',
                buttons: {
                    confirm: {
                        label: 'Fechar',
                        className: 'btn-warning',
                    }
                }
            });
            return false;
        }
    });

    function gravaSolicitacao(matricula, nome, email, dependenciaMentoria, necessidadeMentoria, publicoAlvo, canais, conteudos, experienciaEquipe, totalPessoas, escalaConhecimento, focoTemas, formato) {
        var caminhoController = BASE_URL + '/lib/apps/mentoria/controller/controller_mentoria.php';
        var focoTemasTratado = focoTemas.toString();

        matricula = matricula.replace(/'/g, '"');
        matricula = matricula.replace(/`/g, '"');

        nome = nome.replace(/'/g, '"');
        nome = nome.replace(/`/g, '"');

        email = email.replace(/'/g, '"');
        email = email.replace(/`/g, '"');

        dependenciaMentoria = dependenciaMentoria.replace(/'/g, '"');
        dependenciaMentoria = dependenciaMentoria.replace(/`/g, '"');

        necessidadeMentoria = necessidadeMentoria.replace(/'/g, '"');
        necessidadeMentoria = necessidadeMentoria.replace(/`/g, '"');

        publicoAlvo = publicoAlvo.replace(/'/g, '"');
        publicoAlvo = publicoAlvo.replace(/`/g, '"');

        canais = canais.replace(/'/g, '"');
        canais = canais.replace(/`/g, '"');

        conteudos = conteudos.replace(/'/g, '"');
        conteudos = conteudos.replace(/`/g, '"');

        totalPessoas = totalPessoas.replace(/'/g, '"');
        totalPessoas = totalPessoas.replace(/`/g, '"');


        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'gravaSolicitacao',
                matricula: matricula,
                nome: nome,
                email: email,
                dependenciaMentoria: dependenciaMentoria,
                necessidadeMentoria: necessidadeMentoria,
                publicoAlvo: publicoAlvo,
                canais: canais,
                conteudos: conteudos,
                experienciaEquipe: experienciaEquipe,
                totalPessoas: totalPessoas,
                escalaConhecimento: escalaConhecimento,
                focoTemas: focoTemasTratado,
                formato: formato
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function (retorno) {
                if (retorno.status == 1) {
                    consultaRegistro(matricula);
                } else {
                    bootbox.dialog({
                        backdrop: true,
                        onEscape: function () {
                        },
                        closeButton: true,
                        size: 'medium',
                        title: "Erro!",
                        message: "<div>" + retorno.mensagem + "</div>",
                        buttons: {
                            confirm: {
                                label: 'Fechar',
                                className: 'btn-danger',
                            }
                        }
                    });
                    return false;
                }
            },
            error: function (erro) {
                alert("Não foi possível efetuar a operação, por favor tente novamente. L226 - mentoria.js");
            }
        });
    }

    function consultaBio(matricula) {
        var caminhoController = BASE_URL + '/lib/apps/mentoria/controller/controller_mentoria.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'consultaBio',
                matricula: matricula
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function (retorno) {
                if (retorno.status != '0') {
                    $('.' + matricula + '').css('display', 'block');
                    $('.carrossel-track').css('animation-play-state', 'paused');
                } else {
                    bootbox.dialog({
                        backdrop: true,
                        onEscape: function () {
                        },
                        closeButton: true,
                        size: 'medium',
                        title: "Erro!",
                        message: "<div>" + retorno.mensagem + "</div>",
                        buttons: {
                            confirm: {
                                label: 'Fechar',
                                className: 'btn-danger',
                            }
                        }
                    });
                }
            },
            error: function (erro) {
                alert("Não foi possível efetuar a operação, por favor tente novamente. L267 - mentoria.js");
            }
        });
    }

    function consultaRegistro(matricula) {
        var caminhoController = BASE_URL + '/lib/apps/mentoria/controller/controller_mentoria.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'consultaRegistro',
                matricula: matricula
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function (retorno) {
                if (retorno.status == 1) {
                    $('#formularioImersaoPagina0').css('display', 'none');
                    $('#formularioImersaoPagina1').css('display', 'none');
                    $('#formularioImersaoPagina2').css('display', 'none');
                    $('#formularioImersaoPagina3').css('display', 'none');
                    $('#formularioImersaoPagina4').css('display', 'none');
                    $('#formularioImersaoPagina5').css('display', 'block');
                    $('#barraPorcentagem90').css('display', 'none');
                    $('#barraPorcentagem100').css('display', 'block');
                } else {
                    bootbox.dialog({
                        backdrop: true,
                        onEscape: function () {
                        },
                        closeButton: true,
                        size: 'medium',
                        title: "Erro!",
                        message: "<div>" + retorno.mensagem + "</div>",
                        buttons: {
                            confirm: {
                                label: 'Fechar',
                                className: 'btn-danger',
                            }
                        }
                    });
                }
            },
            error: function (erro) {
                alert("Não foi possível efetuar a operação, por favor tente novamente. L312 - mentoria.js");
            }
        });
    }

    document.querySelectorAll(".trilha-header").forEach(header => {
        header.addEventListener("click", () => {
            const id = header.getAttribute("data-card");
            const content = document.getElementById(`trilha-content-${id}`);
            const plus = header.querySelector(".trilha-plus");
            const card = header.closest(".trilha-card");

            plus.classList.toggle("open");
            if (plus.classList.contains("open")) {
                plus.classList.remove("fa-circle-plus");
                plus.classList.add("fa-circle-minus");
            } else {
                plus.classList.remove("fa-circle-minus");
                plus.classList.add("fa-circle-plus");
            }

            content.classList.toggle("open");
            card.classList.toggle("open-card");
        });
    });

    document.querySelectorAll('.texto-depoimento').forEach(el => {
        const limite = 250;

        const aspas = el.querySelector('.aspas');
        const textoNode = [...el.childNodes].find(
            node => node.nodeType === Node.TEXT_NODE && node.textContent.trim() !== ''
        );

        if (!textoNode) return;

        const textoOriginal = textoNode.textContent.trim();

        if (textoOriginal.length > limite) {
            textoNode.textContent = textoOriginal.substring(0, limite) + '...';
        }
    });

    const $track = $('.depoimentos-track');

    let isDown = false;
    let startX = 0;
    let scrollLeft = 0;

    $track.on('mousedown', function (e) {
        isDown = true;
        startX = e.pageX;
        scrollLeft = this.scrollLeft;
        $(this).addClass('dragging');
        e.preventDefault();
    });

    $(document).on('mouseup mouseleave', function () {
        isDown = false;
        $track.removeClass('dragging');
    });

    $(document).on('mousemove', function (e) {
        if (!isDown) return;
        const walk = (e.pageX - startX) * 1.5;
        $track[0].scrollLeft = scrollLeft - walk;
    });

    $track.on('touchstart', function (e) {
        startX = e.originalEvent.touches[0].pageX;
        scrollLeft = this.scrollLeft;
    });

    $track.on('touchmove', function (e) {
        const x = e.originalEvent.touches[0].pageX;
        const walk = (x - startX) * 1.5;
        this.scrollLeft = scrollLeft - walk;
    });
});