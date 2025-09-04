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

    // Para ESTUDOS
    $(".quadroConteudoEstudos .divEstudo").hide().slice(0, 6).show();
    if ($(".quadroConteudoEstudos .divEstudo").length <= 6) {
        $(".paginaPrincipalEstudos .botaoVerMaisEstudosPesquisas").hide();
    }
    $(".paginaPrincipalEstudos .botaoVerMaisEstudosPesquisas").click(function() {
        let hidden = $(".quadroConteudoEstudos .divEstudo:hidden").slice(0, 6);
        hidden.show();
        if ($(".quadroConteudoEstudos .divEstudo:hidden").length == 0) {
            $(this).hide();
        }
    });

    // Para PESQUISAS
    $(".quadroConteudoPesquisas .divPesquisa").hide().slice(0, 6).show();
    if ($(".quadroConteudoPesquisas .divPesquisa").length <= 6) {
        $(".paginaPrincipalPesquisas .botaoVerMaisEstudosPesquisas").hide();
    }
    $(".paginaPrincipalPesquisas .botaoVerMaisEstudosPesquisas").click(function() {
        let hidden = $(".quadroConteudoPesquisas .divPesquisa:hidden").slice(0, 6);
        hidden.show();
        if ($(".quadroConteudoPesquisas .divPesquisa:hidden").length == 0) {
            $(this).hide();
        }
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

    $('.tab-estudos').click(function(){
        $('.tab-custom').removeClass('selected');
        $(this).addClass('selected');
        $('.paginaPrincipalEstudos').show();
        $('.paginaPrincipalPesquisas').hide();
    });

    $('.tab-pesquisas').click(function(){
        $('.tab-custom').removeClass('selected');
        $(this).addClass('selected');
        $('.paginaPrincipalEstudos').hide();
        $('.paginaPrincipalPesquisas').show();
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

    function compartilharLink(link) {
        if (navigator.share) {
            navigator.share({
                title: 'Estudo CAD BB',
                url: link
            });
        } else {
            // Copia pro clipboard e avisa
            navigator.clipboard.writeText(window.location.origin + link);
            alert('Link copiado!');
        }
    }

    // FILTRO INSTANTÂNEO PARA OS CARDS DE ESTUDO E PESQUISA
    $('.inputCampoPesquisa').on('input', function() {
        var termo = $(this).val().toLowerCase().trim();

        // ESTUDOS
        if ($('#abaEstudos').is(':visible')) {
            if (termo === '') {
                $('.quadroConteudoEstudos .divEstudo').hide().slice(0, 6).show();
                $('.paginaPrincipalEstudos .botaoVerMaisEstudosPesquisas').show();
                return;
            }
            $('.quadroConteudoEstudos .divEstudo').each(function() {
                var textoCard = $(this).text().toLowerCase();
                $(this).toggle(textoCard.includes(termo));
            });
            $('.paginaPrincipalEstudos .botaoVerMaisEstudosPesquisas').hide();
        }

        // PESQUISAS
        if ($('#abaPesquisas').is(':visible')) {
            if (termo === '') {
                $('.quadroConteudoPesquisas .divPesquisa').hide().slice(0, 6).show();
                $('.paginaPrincipalPesquisas .botaoVerMaisEstudosPesquisas').show();
                return;
            }
            $('.quadroConteudoPesquisas .divPesquisa').each(function() {
                var textoCard = $(this).text().toLowerCase();
                $(this).toggle(textoCard.includes(termo));
            });
            $('.paginaPrincipalPesquisas .botaoVerMaisEstudosPesquisas').hide();
        }
    });

    $('.select-ordenar').on('change', function() {
        var ordem = $(this).val();

        // Verifica qual aba está ativa
        if ($('#abaEstudos').is(':visible')) {
            ordenarCards('.quadroConteudoEstudos .divEstudo', ordem);
        } else if ($('#abaPesquisas').is(':visible')) {
            ordenarCards('.quadroConteudoPesquisas .divPesquisa', ordem);
        }
    });

    // Função que ordena os cards
    function ordenarCards(selector, ordem) {
        var $cards = $(selector);

        $cards.sort(function(a, b) {
            var dataA = $(a).attr('data-data');
            var dataB = $(b).attr('data-data');

            // Convertendo para objeto Date para comparar
            dataA = new Date(dataA);
            dataB = new Date(dataB);

            if (ordem === 'recentes') {
                return dataB - dataA;
            } else {
                return dataA - dataB;
            }
        });

        // Coloca os cards já ordenados no container
        $cards.parent().append($cards);

        // Mostra só os 6 primeiros (mantendo lógica anterior)
        $cards.hide().slice(0, 6).show();
        $('.botaoVerMaisEstudosPesquisas').show();
    }
});