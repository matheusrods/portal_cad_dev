$(document).ready(function() {

    // Insere novo estudo
    $('.botaoAdicionaEstudo').click(function(){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/estudosPesquisas/controller/controller_estudosPesquisas.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'paginaAdicionaEstudoPesquisa',
                tipoUpload: 'estudos'
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    bootbox.dialog({
                        className: 'limitaAltura',
                        backdrop: true,
                        onEscape: function() {},
                        // closeButton: true,
                        size: 'large',
                        title: "Adicionar novo estudo",
                        message: retorno.mensagem
                    });

                } else {
                    // Se não conseguir pesquisar, exibe a mensagem de erro
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L47 - estudosPesquisas.js");
            }
        });
    });

    // Insere nova pesquisa
    $('.botaoAdicionaPesquisa').click(function(){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/estudosPesquisas/controller/controller_estudosPesquisas.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'paginaAdicionaEstudoPesquisa',
                tipoUpload: 'pesquisas'
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    bootbox.dialog({
                        className: 'limitaAltura',
                        backdrop: true,
                        onEscape: function() {},
                        // closeButton: true,
                        size: 'large',
                        title: "Adicionar nova pesquisa",
                        message: retorno.mensagem
                    });

                } else {
                    // Se não conseguir pesquisar, exibe a mensagem de erro
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L96 - estudosPesquisas.js");
            }
        });
    });

    // A class abreDivNestEstudos contém 4 notícias lado a lado. A linha abaixo faz com que apareça apenas uma linha com 4 notícias ao carregar a página
    $(".abreDivNestEstudos").slice(0, 1).show();
    $(".abreDivNestPesquisas").slice(0, 1).show();
    
    // Funções ao clicar no botão "Ver Mais"
    $(".botaoVerMaisEstudosPesquisas").on('click', function (event) {
        
        var qualOpcao = ($(this).attr('attr-qualBotao'));
        var qtasDivsOcultas = ($(".abreDivNest"+qualOpcao+":hidden").length);
        
        if(qtasDivsOcultas == 1){
            $('.botaoVerMaisEstudosPesquisas.Clicar.botao'+primeiraLetraMaiuscula(qualOpcao)).css('display', 'none');
        }
        // Verifica o atributo "Número Sequencial" do botão, que é utilizado para fazer mostrar a próxima linha de notícias (cada linha possui um atributo que é sua sequência)
        var numeroSequencial = Number($(this).attr('attr-sequencia'));
        var novoSequencial = numeroSequencial + 1;
        
        $(this).attr('attr-sequencia', novoSequencial);
        $("div.abreDivNest"+qualOpcao+":hidden").slice(0, 1).show();
        $(".abreDivNest"+qualOpcao+"[attr-sequencia="+novoSequencial+"]").css('display', 'inline-flex');
        
        target_offset = $(".abreDivNest"+qualOpcao+"[attr-sequencia="+novoSequencial+"]").offset(),
        target_top = target_offset.top;
        
        $('html,body').animate({
            scrollTop: target_top-80
        }, 250);
    });
    
    // Alterar entre as abas de estudos e pesquisas
    $('.pesquisas').click(function(){
        $('.paginaPrincipalPesquisas').css('display', 'block');
        $('.paginaPrincipalEstudos').css('display', 'none');
    });

    $('.estudos').click(function(){
        $('.paginaPrincipalPesquisas').css('display', 'none');
        $('.paginaPrincipalEstudos').css('display', 'block');
    });

    $('.botaoCampoPesquisaEstudo').on('click', function(){
        var textoDigitado = $('.inputCampoPesquisaEstudos').val();
        if(textoDigitado.length == 0){
            bootbox.dialog({
                backdrop: true,
                onEscape: function() {},
                // closeButton: true,
                size: 'small',
                title: "Atenção",
                message: 'Digite um texto válido.',
                buttons: {
                    confirm: {
                        label: 'OK',
                        className: 'btn-success',
                    }
                }
            });
            return false;
        }
        
        if($('.botaoVerMaisEstudosPesquisas.Clicar.botaoEstudos:hidden')){
            $(".botaoVerMaisEstudosPesquisas.Clicar.botaoEstudos").fadeIn('fast');
        }
        
        pesquisaTextoDigitado(textoDigitado, 'estudos');
    });

    // Executa a pesquisa para o termo digitado apertando o enter no teclado
    $('.inputCampoPesquisaEstudos').keydown(function (e) {
        if (e.keyCode == 13) {
            var textoDigitado = $('.inputCampoPesquisaEstudos').val();
            if(textoDigitado.length == 0){
                bootbox.dialog({
                    backdrop: true,
                    onEscape: function() {},
                    // closeButton: true,
                    size: 'small',
                    title: "Atenção",
                    message: 'Digite um texto válido.',
                    buttons: {
                        confirm: {
                            label: 'OK',
                            className: 'btn-success',
                        }
                    }
                });
                return false;
            }
            
            if($('.botaoVerMaisEstudosPesquisas.Clicar.botaoEstudos:hidden')){
                $(".botaoVerMaisEstudosPesquisas.Clicar.botaoEstudos").fadeIn('fast');
            }
            
            pesquisaTextoDigitado(textoDigitado, 'estudos');
        }
    });

    $('.botaoCampoPesquisaPesquisa').on('click', function(){
        var textoDigitado = $('.inputCampoPesquisaPesquisas').val();
        if(textoDigitado.length == 0){
            bootbox.dialog({
                backdrop: true,
                onEscape: function() {},
                // closeButton: true,
                size: 'small',
                title: "Atenção",
                message: 'Digite um texto válido.',
                buttons: {
                    confirm: {
                        label: 'OK',
                        className: 'btn-success',
                    }
                }
            });
            return false;
        }
        
        if($('.botaoVerMaisEstudosPesquisas.Clicar.botaoEstudos:hidden')){
            $(".botaoVerMaisEstudosPesquisas.Clicar.botaoEstudos").fadeIn('fast');
        }
        
        pesquisaTextoDigitado(textoDigitado, 'pesquisas');
    });

    // Executa a pesquisa para o termo digitado apertando o enter no teclado
    $('.inputCampoPesquisaPesquisas').keydown(function (e) {
        if (e.keyCode == 13) {
            var textoDigitado = $('.inputCampoPesquisaPesquisas').val();
            if(textoDigitado.length == 0){
                bootbox.dialog({
                    backdrop: true,
                    onEscape: function() {},
                    // closeButton: true,
                    size: 'small',
                    title: "Atenção",
                    message: 'Digite um texto válido.',
                    buttons: {
                        confirm: {
                            label: 'OK',
                            className: 'btn-success',
                        }
                    }
                });
                return false;
            }
            
            if($('.botaoVerMaisEstudosPesquisas.Clicar.botaoEstudos:hidden')){
                $(".botaoVerMaisEstudosPesquisas.Clicar.botaoEstudos").fadeIn('fast');
            }
            
            pesquisaTextoDigitado(textoDigitado, 'pesquisas');
        }
    });

    // Botão de limpar a barra de pesquisa de estudos
    $('.botaoLimpaPesquisaEstudo').on('click', function(){
        if($('.botaoVerMaisEstudosPesquisas.Clicar.botaoEstudos:hidden')){
            $(".botaoVerMaisEstudosPesquisas.Clicar.botaoEstudos").fadeIn('fast');
        }
        
        $('.inputCampoPesquisaEstudos').val('');
        $('.botaoVerMaisEstudosPesquisas.Clicar.botaoEstudos').attr('attr-sequencia', '1');
        $('.botoesFiltroTemaestudos').val('');
        $('.botoesFiltroTemaestudos').css('background', '#E4ECFF');
        $('.botoesFiltroTemaestudos').attr('attr-filtroativoestudos', '0');
        consultaEstudos('estudos');
    });

    // Botão de limpar a barra de pesquisa de pesquisas (desculpe a redundância)
    $('.botaoLimpaPesquisaPesquisa').on('click', function(){
        if($('.botaoVerMaisEstudosPesquisas.Clicar.botaoPesquisas:hidden')){
            $(".botaoVerMaisEstudosPesquisas.Clicar.botaoPesquisas").fadeIn('fast');
        }
        
        $('.inputCampoPesquisaPesquisas').val('');
        $('.botaoVerMaisEstudosPesquisas.Clicar.botaoPesquisas').attr('attr-sequencia', '1');
        $('.botoesFiltroTemapesquisas').css('background', '#E4ECFF');
        $('.botoesFiltroTemapesquisas').val('');
        $('.botoesFiltroTemapesquisas').attr('attr-filtroativopesquisas', '0');
        consultaPesquisas('pesquisas');
    });


    // Interações dos botões de filtros de tema dos estudos
    $('.botoesFiltroTemaestudos').click(function(e){
        
        $('.inputCampoPesquisaEstudos').val('');
        var idTema = $(this).attr('attr-id');
        var qualOpcao = $(this).attr('attr-qualOpcao');
        var filtroAtivo = $(this).attr('attr-filtroAtivo'+qualOpcao);
        
        if($('.botaoVerMaisEstudosPesquisas.Clicar.botao'+primeiraLetraMaiuscula(qualOpcao)+':hidden')){
            $('.botaoVerMaisEstudosPesquisas.Clicar.botao'+primeiraLetraMaiuscula(qualOpcao)).fadeIn('fast');
        }
        
        if(filtroAtivo == '0'){
            $('#temaestudos'+idTema).css('background', '#FDF429');
            $('#temaestudos'+idTema).attr('attr-filtroAtivo'+qualOpcao, '1');
            $('.botaoVerMaisEstudosPesquisas.Clicar.botao'+primeiraLetraMaiuscula(qualOpcao)).attr('attr-sequencia', '1');
        } else{
            $('#temaestudos'+idTema).css('background', '#E4ECFF');
            $('#temaestudos'+idTema).attr('attr-filtroAtivo'+qualOpcao, '0');
            $('.botaoVerMaisEstudosPesquisas.Clicar.botao'+primeiraLetraMaiuscula(qualOpcao)).attr('attr-sequencia', '1');
        }
        
        var arr=[];

        $("div[attr-filtroAtivo"+qualOpcao+"='1']").each(function(){
            arr.push($(this).attr('attr-id'));
        });

        if(arr.length > 0){
            // filtraNoticiasTema(arr);
            consultaEstudosPesquisas(arr, qualOpcao);
            console.log("if > arr.length = "+arr.length);
        } else {
            var idTema = [];
            console.log("else > arr.length = "+arr.length);
            if(qualOpcao == 'estudos'){
                consultaEstudos(qualOpcao);
            } else {
                consultaPesquisas(qualOpcao);
            }

            if($('.botaoVerMaisEstudosPesquisas.Clicar.botao'+primeiraLetraMaiuscula(qualOpcao)).css('display') == 'none'){
                $('.botaoVerMaisEstudosPesquisas.Clicar.botao'+primeiraLetraMaiuscula(qualOpcao)).fadeIn('fast');
            }
        }
    });

    // Interações dos botões de filtros de tema das pesquisas
    $('.botoesFiltroTemapesquisas').click(function(e){
        $('.inputCampoPesquisaPesquisas').val('');
        var idTema = $(this).attr('attr-id');
        var qualOpcao = $(this).attr('attr-qualOpcao');
        var filtroAtivo = $(this).attr('attr-filtroAtivo'+qualOpcao);
        
        if($('.botaoVerMaisEstudosPesquisas.Clicar.botao'+primeiraLetraMaiuscula(qualOpcao)+':hidden')){
            $('.botaoVerMaisEstudosPesquisas.Clicar.botao'+primeiraLetraMaiuscula(qualOpcao)).fadeIn('fast');
        }
        
        if(filtroAtivo == '0'){
            $('#temapesquisas'+idTema).css('background', '#FDF429');
            $('#temapesquisas'+idTema).attr('attr-filtroAtivo'+qualOpcao, '1');
            $('.botaoVerMaisEstudosPesquisas.Clicar.botao'+primeiraLetraMaiuscula(qualOpcao)).attr('attr-sequencia', '1');
        } else{
            $('#temapesquisas'+idTema).css('background', '#E4ECFF');
            $('#temapesquisas'+idTema).attr('attr-filtroAtivo'+qualOpcao, '0');
            $('.botaoVerMaisEstudosPesquisas.Clicar.botao'+primeiraLetraMaiuscula(qualOpcao)).attr('attr-sequencia', '1');
        }

        var arr=[];

        $("div[attr-filtroAtivo"+qualOpcao+"='1']").each(function(){
            arr.push($(this).attr('attr-id'));
        });

        if(arr.length > 0){
            // filtraNoticiasTema(arr);
            consultaEstudosPesquisas(arr, qualOpcao);
            console.log("if > arr.length = "+arr.length);
        } else {
            var idTema = [];
            console.log("else > arr.length = "+arr.length);
            if(qualOpcao == 'estudos'){
                consultaEstudos(qualOpcao);
            } else {
                consultaPesquisas(qualOpcao);
            }

            if($('.botaoVerMaisEstudosPesquisas.Clicar.botao'+primeiraLetraMaiuscula(qualOpcao)).css('display') == 'none'){
                $('.botaoVerMaisEstudosPesquisas.Clicar.botao'+primeiraLetraMaiuscula(qualOpcao)).fadeIn('fast');
            }
        }
    });

    function primeiraLetraMaiuscula(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    // Função ajax que consulta os estudos e pesquisas quando utilizados os botões dos temas
    function consultaEstudosPesquisas(idTema, qualOpcao){
        var qualOpcaoMaiuscula = primeiraLetraMaiuscula(qualOpcao);
        var caminhoController = 'https://cad.bb.com.br/lib/apps/estudosPesquisas/controller/controller_estudosPesquisas.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'consultaEstudosPesquisas',
                idTema: idTema,
                qualOpcao: qualOpcaoMaiuscula
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    
                    $(".quadroConteudo"+qualOpcaoMaiuscula+" .quadroConteudos").html('');
                    $("div.quadroConteudo"+qualOpcaoMaiuscula+" .quadroConteudos").html(retorno.mensagem);
                    $(".abreDivNest"+qualOpcaoMaiuscula).css("justify-content","center");

                    var qtasDivsOcultas = ($(".abreDivNest"+qualOpcaoMaiuscula+":hidden").length);
                    if(qtasDivsOcultas == 0){
                        $('.botaoVerMaisEstudosPesquisas.Clicar.botao'+qualOpcaoMaiuscula).css('display','none');
                    }
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L426 - estudosPesquisas.js");
            }
        });
    }

    function consultaEstudos(qualOpcao){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/estudosPesquisas/controller/controller_estudosPesquisas.php';
        var qualOpcaoMaiuscula = primeiraLetraMaiuscula(qualOpcao);
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'consultaEstudos'
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    $(".quadroConteudo"+qualOpcaoMaiuscula+" .quadroConteudos").html('');
                    $("div.quadroConteudo"+qualOpcaoMaiuscula+" .quadroConteudos").html(retorno.mensagem);
                    // $("div.quadroConteudo"+qualOpcaoMaiuscula).append('<div class="botaoVerMaisEstudosPesquisas Clicar botaoEstudos" attr-sequencia="1" attr-qualBotao="Estudos" style="padding-left: 32px; padding-right: 32px; padding-top: 15px; padding-bottom: 15px; background: #FDF429; border-radius: 4px; justify-content: center; align-items: center; gap: 10px; display: inline-flex">                            <div style="text-align: center; color: #3354FD; font-size: 16px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 18px; letter-spacing: 0.08px; word-wrap: break-word">Ver mais</div></div>');
                    
                    var qtasDivsOcultas = ($(".abreDivNest"+qualOpcaoMaiuscula+":hidden").length);
                    if(qtasDivsOcultas == 0){
                        $('.botaoVerMaisEstudosPesquisas.Clicar.botao'+qualOpcaoMaiuscula).css('display','none');
                    }
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L472 - mentoria.js");
            }
        });
    }

    function consultaPesquisas(qualOpcao){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/estudosPesquisas/controller/controller_estudosPesquisas.php';
        var qualOpcaoMaiuscula = primeiraLetraMaiuscula(qualOpcao);
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'consultaPesquisas'
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    $(".quadroConteudo"+qualOpcaoMaiuscula+" .quadroConteudos").html('');
                    $("div.quadroConteudo"+qualOpcaoMaiuscula+" .quadroConteudos").html(retorno.mensagem);
                    var qtasDivsOcultas = ($(".abreDivNest"+qualOpcaoMaiuscula+":hidden").length);
                    if(qtasDivsOcultas == 0){
                        $('.botaoVerMaisEstudosPesquisas.Clicar.botao'+qualOpcaoMaiuscula).css('display','none');
                    }
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L516 - mentoria.js");
            }
        });
    }

    function pesquisaTextoDigitado(textoDigitado, qualOpcao){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/estudosPesquisas/controller/controller_estudosPesquisas.php';
        var qualOpcaoMaiuscula = primeiraLetraMaiuscula(qualOpcao);
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'pesquisaTextoDigitado',
                textoDigitado: textoDigitado,
                qualOpcao: qualOpcao
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    $('.botoesFiltroTema'+qualOpcao).val('');
                    $('.botoesFiltroTema'+qualOpcao).css('background', '#E4ECFF');
                    $('.botoesFiltroTema'+qualOpcao).attr('attr-filtroativo'+qualOpcao, '0');
                    $(".quadroConteudo"+qualOpcaoMaiuscula+" .quadroConteudos").html('');
                    $("div.quadroConteudo"+qualOpcaoMaiuscula+" .quadroConteudos").html(retorno.mensagem);
                    $('.botaoVerMaisEstudosPesquisas.Clicar.botaoEstudos').attr('attr-sequencia', '1');
                    
                    var qtasDivsOcultas = ($(".abreDivNest"+qualOpcaoMaiuscula+":hidden").length);
                    if(qtasDivsOcultas == 0){
                        $('.botaoVerMaisEstudosPesquisas.Clicar.botao'+qualOpcaoMaiuscula).css('display','none');
                    }


                } else {
                    // Se não conseguir pesquisar, exibe a mensagem de erro
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L569 - estudosPesquisas.js");
            }
        });
    }
});