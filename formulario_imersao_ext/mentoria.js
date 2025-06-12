$(document).ready(function() {
    
    var $track = $('.carrossel-track');
    var $items = $track.children();

    $items.each(function() {
        var $clone = $(this).clone();
        $track.append($clone);
    });

    $('.subtituloTemaMentoria').on('click', function(){
        /* identifica a variável que deverá aparecer e qual deverá desaparecer */
        var divAtiva = $(this).attr('attr-divAtiva');
        var divClicada = $(this).attr('attr-div');

        /* atribui a todos elementos no atributo "attr-divAtiva" qual div está ativa */
        $('.subtituloTemaMentoria').attr('attr-divAtiva', divClicada);

        /* remove a linha verde abaixo do item que estava selecionado */
        $('.subtituloTemaMentoria').removeClass('temaClicadoMentoria');
        
        /* adiciona ao elemento clicado a linha verde, indicando que ali está a seleção */
        $(this).addClass('temaClicadoMentoria');

        /* atribui e remove classes CSS referentes à visibilidade dos elementos */
        $('.'+divAtiva+'').removeClass('visible');
        $('.'+divAtiva+'').addClass('hidden');
        $('.'+divClicada+'').removeClass('hidden');
        $('.'+divClicada+'').addClass('visible');
    });

    $('.abrirModalBioMentoria').on('click', function(e){
        e.stopPropagation();
        var matricula = $(this).attr('attr-matricula');
        consultaBio(matricula);
    });

    // Seta a variável modal com o ID da DIV desejada
    var modal = $("#modalBioMentoria");

    // Determina o elemento clicável que fará abrir o modal
    var abreModal = $("#abrirModalBioMentoria");

    // função que abre o moal
    abreModal.on("click", function() {
        modal.show();
    });

    // Quando clicar no X fecha o modal
    $(".close").on("click", function() {
        $('.carrossel-track').css('animation-play-state', 'running');
        
        var matriculaParaFechar = $(this).attr('attr-matriculaClose');
        $('.'+matriculaParaFechar+'').css('display', 'none');
    });

    // // Quando clicar fora do modal, fecha o mesmo
    // $(window).on("click", function(event) {
    //     if ($(event.target).is(modal)) {
    //         modal.hide();
    //     }
    // });

    $('.navigation label').click(function(){
        $('.navigation label').css('border', '');
        $(this).css('border-width', '2px');
        $(this).css('border-color', '#000');
        $(this).css('border-style', 'solid');
    });

    $('.qualDependenciaImersao').click(function(){
        var dependenciaClicada = $(this).attr('attr-dependencia');
        $('#codDependencia').val(dependenciaClicada);
        // $('.qualDependenciaImersao').css('border-width', '1px');
        // $(this).css('border-width', '4px');
        $('.qualDependenciaImersao').removeClass('botaoSelecionado');
        $(this).addClass('botaoSelecionado');
        
    });

    $('.voltar').click(function(){
        var divExibida = $(this).attr('attr-qualDiv');
    });

    $('.qualFormato').click(function(){
        $('.qualFormato').attr('attr-opcaoEscolhida', '0');
        $(this).attr('attr-opcaoEscolhida', '1');
        // $('.qualFormato').css('border-width', '1px');
        // $(this).css('border-width', '4px');
        $('.qualFormato').removeClass('botaoSelecionado');
        $(this).addClass('botaoSelecionado');
    });

    
    $('#finalizar').click(function(){
        // var divExibida = $(this).attr('attr-qualDiv');
        // if(divExibida == 5){
            var focoTemas = [];
            $(':checkbox:checked').each(function(i){
                focoTemas[i] = ' '+$(this).val();
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
            var matricula = $('#matriculaForm').val();
            var nome = $('#nomeForm').val();
            var email = $('#emailForm').val();
            
            var mensagemErro = 'Necessário: <br><br>';
            var contaErros = 0;
            

            if(dependenciaMentoria.length == 0){
                mensagemErro = mensagemErro+"-Preencher Dependência;<br>";
                contaErros = ++contaErros;
               
            }
            if(necessidadeMentoria.length == 0){
                mensagemErro = mensagemErro+"-Informar qual a necessidade;<br>";
                contaErros = ++contaErros;
                
            }
            if(publicoAlvo.length == 0){
                mensagemErro = mensagemErro+"-Qual o Público Alvo;<br>";
                contaErros = ++contaErros;
               
            }
            if(canais.length == 0){
                mensagemErro = mensagemErro+"-Informar o canal onde o assistente será disponibilizado;<br>";
                contaErros = ++contaErros;
                
            }
            if(conteudos === undefined){
                mensagemErro = mensagemErro+"-Informar se já sabe os conteúdos do assistente;<br>";
                contaErros = ++contaErros;
               
                             
            }
            if(experienciaEquipe === undefined){
                mensagemErro = mensagemErro+"-Informar se a Equipe tem conhecimento com desenvolvimento de assistentes virtuais;<br>";
                contaErros = ++contaErros;
                
             }
            if(totalPessoas.length == 0){
                mensagemErro = mensagemErro+"-Preencher o total de pessoas que participarão da equipe;<br>";
                contaErros = ++contaErros;
            
            }   
            if(escalaConhecimento === undefined){
                mensagemErro = mensagemErro+"-Informar o grau de conhecimento;<br>";
                contaErros = ++contaErros;
             }
            if(focoTemas.length == 0){
                mensagemErro = mensagemErro+"-Informar os temas que deverão ser abordados;<br>";
                contaErros = ++contaErros;     
                
             }
            if(formato === undefined){
                mensagemErro = mensagemErro+"-Informar o formato desejado;<br>";
                contaErros = ++contaErros;
            }
             
            mensagemErro = mensagemErro.substring(0, mensagemErro.length-5)+'.'; 

            if(contaErros == 0){
                gravaSolicitacao(matricula, nome, email, dependenciaMentoria, necessidadeMentoria, publicoAlvo, canais, conteudos, experienciaEquipe, totalPessoas, escalaConhecimento, focoTemas, formato);
                mostraDiv5();
                
            } else{ 
                alert("Por favor preencha todos os dados");
                // bootbox.dialog({
                //     backdrop: true,
                //     onEscape: function() {},
                //     // closeButton: true,
                //     size: 'medium',
                //     title: "Atenção",
                //     message: '<div>'+mensagemErro+'</div>',
                //     buttons: {
                //         confirm: {
                //             label: 'Fechar',
                //             className: 'btn-warning',
                //         }
                //     }
                // });
                return false;
                // alert(mensagemErro);
                // return false;
            }
            
        // }
    });

    // Função ajax que grava a solicitação em Banco de dados
    function gravaSolicitacao(matricula, nome, email, dependenciaMentoria, necessidadeMentoria, publicoAlvo, canais, conteudos, experienciaEquipe, totalPessoas, escalaConhecimento, focoTemas, formato){
        var caminhoController = 'https://cad.bb.com.br/formulario_imersao_ext/controller/controller_mentoria.php';
        
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
            success: function(retorno) {
                if (retorno.status == 1) {
                    consultaRegistro(matricula);
                } else {
                    // Se não conseguir executar, exibe a mensagem de erro
                    bootbox.dialog({
                        backdrop: true,
                        onEscape: function() {},
                        closeButton: true,
                        size: 'medium',
                        title: "Erro!",
                        message: "<div>"+retorno.mensagem+"</div>",
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
            error: function(erro) {
                alert("Não foi possível efetuar a operação, por favor tente novamente. L226 - mentoria.js");
            }
        });
    }

    // Função ajax que consulta a Bio do Professor clicado
    function consultaBio(matricula){
        var caminhoController = 'https://cad.bb.com.br/formulario_imersao_ext/controller/controller_mentoria.php';
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
            success: function(retorno) {
                if (retorno.status != '0') {
                    $('.'+matricula+'').css('display', 'block');
                    $('.carrossel-track').css('animation-play-state', 'paused');
                } else {
                    // Se não conseguir executar, exibe a mensagem de erro
                    bootbox.dialog({
                        backdrop: true,
                        onEscape: function() {},
                        closeButton: true,
                        size: 'medium',
                        title: "Erro!",
                        message: "<div>"+retorno.mensagem+"</div>",
                        buttons: {
                            confirm: {
                                label: 'Fechar',
                                className: 'btn-danger',
                            }
                        }
                    });
                }
            },
            error: function(erro) {
                alert("Não foi possível efetuar a operação, por favor tente novamente. L267 - mentoria.js");
            }
        });
    }

    function consultaRegistro(matricula){
        var caminhoController = 'https://cad.bb.com.br/formulario_imersao_ext/controller/controller_mentoria.php';
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
            success: function(retorno) {
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
                    // Se não conseguir executar, exibe a mensagem de erro
                    bootbox.dialog({
                        backdrop: true,
                        onEscape: function() {},
                        closeButton: true,
                        size: 'medium',
                        title: "Erro!",
                        message: "<div>"+retorno.mensagem+"</div>",
                        buttons: {
                            confirm: {
                                label: 'Fechar',
                                className: 'btn-danger',
                            }
                        }
                    });
                }
            },
            error: function(erro) {
                alert("Não foi possível efetuar a operação, por favor tente novamente. L312 - mentoria.js");
            }
        });
    }
});