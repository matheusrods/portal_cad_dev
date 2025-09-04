$(document).ready(function() {
    $(function(){
        // Formatação do calendário/datepicker
        $("#dataInicio, #dataFim").datepicker({
            minDate: "01/01/2024",
            maxDate: "-1D",            
            showAnim: "fadeIn", // animação suave
            position: {
                my: "left bottom",
                at: "left top",
                collision: "none"
            }

        });


        // Carrega o datepicker
        
        $(".camposDataPesquisaInicio, .camposDataPesquisaFim").on("click", function(){
            if ($(this).hasClass("camposDataPesquisaInicio")) {
                $("#dataInicio").datepicker("show");
                //$('#dataInicio').datepicker('widget').css({top:"450px", left: "750px"});
            } else {
                $("#dataFim").datepicker("show");
                //$('#dataFim').datepicker('widget').css({top:"450px", left: "650px"});
            }

        });


        //Função dos botões de periodos pré-selecionados
        $(".botaoPeriodo").on("click", function(){
            $(".botaoPeriodo").removeClass("ativo");
            $(this).addClass("ativo");

            const hoje = new Date();
            let inicio, fim = hoje;
            hoje.setDate(hoje.getDate() - 1); // considera ontem como "hoje"

            const tipo = $(this).text().toLowerCase();

            switch (tipo) {
                case 'ontem':
                    inicio = new Date(hoje);
                    inicio.setDate(hoje.getDate());
                    fim = inicio;
                    break;
                case 'últimos 7 dias':
                    inicio = new Date(hoje);
                    inicio.setDate(hoje.getDate()- 7);
                    fim = hoje;
                    break;
                case 'últimos 30 dias':
                    inicio = new Date(hoje);
                    inicio.setDate(hoje.getDate()- 30);
                    fim = hoje;
                    break;
                case '1 ano':
                    inicio = new Date(hoje);
                    inicio.setFullYear(hoje.getFullYear()- 1);
                    fim = hoje;
                    break;
            }

            const formatar = d => `${String(d.getDate()).padStart(2, '0')}/${String(d.getMonth()+1).padStart(2, '0')}/${d.getFullYear()}`;

            $("#dataInicio").val(formatar(inicio));
            $("#dataFim").val(formatar(fim)).trigger('change');
        });

        
             // Recebe a data selecionada e trata o formato
        $('#dataInicio, #dataFim').on('change', function(){
            var dataInicio = $('#dataInicio').val();
            const formataDataInicio = dataInicio.split("/");
            var novaDataInicio = formataDataInicio[2]+'-'+formataDataInicio[1]+'-'+formataDataInicio[0];

            var dataFim = $('#dataFim').val();
            const formataDataFim = dataFim.split("/");
            var novaDataFim = formataDataFim[2]+'-'+formataDataFim[1]+'-'+formataDataFim[0];

            //alert(novaDataInicio);
            //alert(novaDataFim);

            atualizaGrandesNumerosPf(novaDataInicio, novaDataFim);
        });

        // // Recebe a data selecionada e trata o formato
        // $('#selecionaData').on('change', function(){
        //     // alert('16h12: '+$('#selecionaData').val());
        //     var data = $('#selecionaData').val();
        //     const formataNovaData = data.split("/");
        //     var novaData = formataNovaData[2]+'-'+formataNovaData[1]+'-'+formataNovaData[0];
        //     var mesEscrito = formataNovaData[1]-1;
        //     var meses= ["JANEIRO", "FEVEREIRO", "MARÇO", "ABRIL", "MAIO", "JUNHO", "JULHO", "AGOSTO", "SETEMBRO", "OUTUBRO", "NOVEMBRO","DEZEMBRO"];
        //     var mesPorEscrito = meses[mesEscrito];
        //     var diaSelecionado = formataNovaData[0];
            
        //     atualizaGrandesNumerosPf(novaData, diaSelecionado, mesPorEscrito);
        // });

        // Realiza o efeito de descer os dados resumidos onde o mouse está apontando
        $('.efeitoAnalytics').on("mouseenter",function() {
            var idInfo = $(this).attr('attr-idInfo');
            $(".resumoNumerosAnalytics"+idInfo).addClass('efeitoAnalyticsEfeitos');
        });

        // Realiza o efeito de subir novamente os dados resumidos onde o mouse estava apontando
        $('.efeitoAnalytics').on("mouseleave",function() {
            var idInfo = $(this).attr('attr-idInfo');
            $(".resumoNumerosAnalytics"+idInfo).removeClass('efeitoAnalyticsEfeitos');
            $(".resumoNumerosAnalytics"+idInfo).addClass('efeitoAnalyticsEfeitoSobe');
            setTimeout(function () {
                $(".resumoNumerosAnalytics"+idInfo).removeClass('efeitoAnalyticsEfeitoSobe');
            }, 400);
        });

        $(document).ajaxStop(function(){
            // Realiza o efeito de descer os dados resumidos onde o mouse está apontando
            $('.efeitoAnalytics').on("mouseenter",function() {
                var idInfo = $(this).attr('attr-idInfo');
                $(".resumoNumerosAnalytics"+idInfo).addClass('efeitoAnalyticsEfeitos');
            });

            // Realiza o efeito de subir novamente os dados resumidos onde o mouse estava apontando
            $('.efeitoAnalytics').on("mouseleave",function() {
                var idInfo = $(this).attr('attr-idInfo');
                $(".resumoNumerosAnalytics"+idInfo).removeClass('efeitoAnalyticsEfeitos');
                $(".resumoNumerosAnalytics"+idInfo).addClass('efeitoAnalyticsEfeitoSobe');
                setTimeout(function () {
                    $(".resumoNumerosAnalytics"+idInfo).removeClass('efeitoAnalyticsEfeitoSobe');
                }, 400);
            });
        });

        // Realiza a mudança de dados PF e PJ ao alterar o lado da "Chave" PF e PJ
        $('#chavePfPj').on('change', function(){
            var check = $('#chavePfPj').is(":checked");
            if(check == true){
                $(".quadroGrandesNumerosPf").fadeOut(500);
                $(".quadroGrandesNumerosPj").fadeIn(1000);
                $(".dadosAcumuladosAnalytics").fadeOut(500);
                $(".conteudoAnalytics").css('height', '1500px');
            } else {
                $(".quadroGrandesNumerosPj").fadeOut(500);
                $(".quadroGrandesNumerosPf").fadeIn(1000);
                $(".dadosAcumuladosAnalytics").fadeIn(1000);
                $(".conteudoAnalytics").css('height', '2272px');
            }
        });

    });

    // Função Ajax para carregar os dados da data selecionada no datepicker
    function atualizaGrandesNumerosPf(novaDataInicio, novaDataFim){
        $.ajax({
            aSync: true,
            url: 'https://cad.desenv.bb.com.br/lib/apps/analytics_v2/controller/controller_analytics_V2.php',
            data: {
                request: 'atualizaGrandesNumerosPf',
                dataInicio: novaDataInicio,
                dataFim: novaDataFim
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    $.ajax({
                        aSync: true,
                        url: 'https://cad.desenv.bb.com.br/lib/apps/analytics_v2/controller/controller_analytics_V2.php',
                        data: {
                            request: 'atualizaGrandesNumerosPj',
                            dataInicio: novaDataInicio,
                            dataFim: novaDataFim
                        },
                        type: "POST",
                        dataType: "JSON",
                        dataSrc: "",
                        success: function(retorno2) {
                            if (retorno2.status == 1) {
                                //$(".diaSelecionado").text(diaSelecionado);
                                //$(".mesSelecionado").text(mesPorEscrito);
                                // $(".overflowQuadroInterno").fadeOut(100);
                                // $(".quadroGrandesNumerosPf").fadeIn(500).delay(1000).fadeOut("fast");
                                $(".quadroGrandesNumerosPf").html(retorno.mensagem);
                                $(".quadroGrandesNumerosPj").html(retorno2.mensagem);

                                if($(dataInicio) != $(dataFim)){
                                    $('.mediaTrinta, .mediaSete').each(function() {
                                        this.style.setProperty('display', 'none', 'important');
                                    });
                                }
                                
                                if($(dataInicio) === $(dataFim)){
                                    $('.mediaTrinta, .mediaSete').each(function() {
                                        this.style.setProperty('display', 'block', 'important');
                                    })
                                }

                                // $(".overflowQuadroInterno").fadeIn(500);
                            } else {
                                // Se não conseguir executar, exibe a mensagem de erro
                                bootbox.dialog({
                                    backdrop: true,
                                    onEscape: function() {},
                                    closeButton: true,
                                    size: 'medium',
                                    title: "Erro!",
                                    message: "<div>"+retorno2.mensagem+"</div>",
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
                            alert("Não foi possível efetuar a operação, por favor tente novamente. L126 - analytics.js");
                        }
                    });
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L145 - analytics.js");
            }
        });
    }

});