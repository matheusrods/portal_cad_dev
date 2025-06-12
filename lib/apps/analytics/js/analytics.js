$(document).ready(function() {
    $(function(){
        // Formatação do calendário/datepicker
        $("#selecionaData").datepicker({
            minDate: "01/01/2024",
            maxDate: "-1D"
        });

        // Carrega o datepicker
        $(".calendarioTrocaData").on("click", function(){
            $("#selecionaData").focus();
            $('#selecionaData').datepicker('widget').css({top:"498px", left: "835px"});
        });

        // Recebe a data selecionada e trata o formato
        $('#selecionaData').on('change', function(){
            // alert('16h12: '+$('#selecionaData').val());
            var data = $('#selecionaData').val();
            const formataNovaData = data.split("/");
            var novaData = formataNovaData[2]+'-'+formataNovaData[1]+'-'+formataNovaData[0];
            var mesEscrito = formataNovaData[1]-1;
            var meses= ["JANEIRO", "FEVEREIRO", "MARÇO", "ABRIL", "MAIO", "JUNHO", "JULHO", "AGOSTO", "SETEMBRO", "OUTUBRO", "NOVEMBRO","DEZEMBRO"];
            var mesPorEscrito = meses[mesEscrito];
            var diaSelecionado = formataNovaData[0];
            
            atualizaGrandesNumerosPf(novaData, diaSelecionado, mesPorEscrito);
        });

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
    function atualizaGrandesNumerosPf(novaData, diaSelecionado, mesPorEscrito){
        $.ajax({
            aSync: true,
            url: 'https://cad.bb.com.br/lib/apps/analytics/controller/controller_analytics_V2.php',
            data: {
                request: 'atualizaGrandesNumerosPf',
                data: novaData
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    $.ajax({
                        aSync: true,
                        url: 'https://cad.bb.com.br/lib/apps/analytics/controller/controller_analytics_V2.php',
                        data: {
                            request: 'atualizaGrandesNumerosPj',
                            data: novaData
                        },
                        type: "POST",
                        dataType: "JSON",
                        dataSrc: "",
                        success: function(retorno2) {
                            if (retorno2.status == 1) {
                                $(".diaSelecionado").text(diaSelecionado);
                                $(".mesSelecionado").text(mesPorEscrito);
                                // $(".overflowQuadroInterno").fadeOut(100);
                                // $(".quadroGrandesNumerosPf").fadeIn(500).delay(1000).fadeOut("fast");
                                $(".quadroGrandesNumerosPf").html(retorno.mensagem);
                                $(".quadroGrandesNumerosPj").html(retorno2.mensagem);
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