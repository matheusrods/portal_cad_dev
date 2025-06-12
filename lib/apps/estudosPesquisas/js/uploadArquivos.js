$(document).ready(function() {

    $(".btnLimpar").on("click", function(){
        $("#textAreaTitulo").val("");
        $("#textAreaDescricao").val("");
        $("#temaSelecionadoSelect").val("0");
        $("#uploadPdf").val("");
        $("#uploadPng").val("");
        $(".textoArquivoPdf").text("Máximo: 100MB");
        $(".textoArquivoPng").text("Melhor formato 16x10");
        $("#checkPdf").css("display","none");
        $("#checkPng").css("display","none");
        $("#preview").css("display","none");
    });

    // Upload PDF de estudo/pesquisa
    $("#uploadPdf").on("change", function(){
        const [file] = uploadPdf.files;
        console.log(uploadPdf.files);
        if (file) {
            $("#checkPdf").css("display", "block");
            $(".textoArquivoPdf").html("");
            $(".textoArquivoPdf").html(file.name);
        }
    });

    // Upload PNG da capa de estudo/pesquisa
    $("#uploadPng").on("change", function(){
        const [file] = uploadPng.files;
        console.log(uploadPng.files);
        // Mostrar a miniatura do arquivo selecionado
        if (file) {
            preview.src = URL.createObjectURL(file)
            $("#preview").css("display", "block");
            $("#checkPng").css("display", "block");
            $(".textoArquivoPng").html("");
            $(".textoArquivoPng").html(file.name);
        }
    });

    // Conta caracteres faltantes do título
    function contaCaracteresTitulo(val) {
        var len = val.value.length;
        if (len > 50) {
            val.value = val.value.substring(-1, 50);
        } else {
            $(".contaCaracteresTitulo").text(50 - len+" caracteres restantes");
        }
    };

    // Conta caracteres faltantes da descrição
    function contaCaracteresDescricao(val) {
        var len = val.value.length;
        if (len > 120) {
            val.value = val.value.substring(-1, 120);
        } else {
            $(".contaCaracteresDescricao").text(120 - len+" caracteres restantes");
        }
    };

    $(".btnEnviar").click(function () {
        var caminhoupload = "https://cad.bb.com.br/lib/class/uploadNovo.php";
        var formData = new FormData();
        
        formData.append("titulo", $("#textAreaTitulo").val());
        formData.append("descricao", $("#textAreaDescricao").val());
        formData.append("idTema", $("#temaSelecionadoSelect").val());
        formData.append("tipoDocumento", $(".btnEnviar").attr("attr-qualBotao"));
        formData.append("pdf", $("#uploadPdf")[0].files[0]);
        formData.append("png", $("#uploadPng")[0].files[0]);
        
        var mensagemErro = "Necessário: <br><br>";
        var contaErros = 0;

        if(($("#textAreaTitulo").val()).length == 0){
            mensagemErro = mensagemErro+"-Preencher Título;<br>";
            contaErros = ++contaErros;
        }

        if(($("#textAreaDescricao").val()).length == 0){
            mensagemErro = mensagemErro+"-Preencher Descrição;<br>";
            contaErros = ++contaErros;
        }
        
        if(($("#temaSelecionadoSelect").val()) == 0){
            mensagemErro = mensagemErro+"-Selecionar Tema;<br>";
            contaErros = ++contaErros;
        }
        
        if($("#uploadPdf")[0].files.length == 0){
            mensagemErro = mensagemErro+"-Anexar arquivo PDF;<br>";
            contaErros = ++contaErros;
        }
        
        if($("#uploadPng")[0].files.length == 0){
            mensagemErro = mensagemErro+"-Anexar arquivo PNG da capa;<br>";
            contaErros = ++contaErros;
        }

        mensagemErro = mensagemErro.substring(0, mensagemErro.length-5)+".";

        if(contaErros == 0){
            $.ajax({
                url: caminhoupload,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(retorno) {
                bootbox.hideAll();
                var retornoJson = JSON.parse(retorno);
                    if (retornoJson.status == 1) {
                        bootbox.dialog({
                            backdrop: true,
                            onEscape: function() {},
                            // closeButton: true,
                            size: "medium",
                            title: "Sucesso!",
                            message: "<div>"+retornoJson.mensagem+"</div>",
                            buttons: {
                                confirm: {
                                    label: "Fechar",
                                    className: "btn-success",
                                }
                            },
                        });
                        $(".botaoLimpaPesquisa'.$tipoUploadMaiuscula.'").click();
                    } else {
                        // Se não conseguir pesquisar, exibe a mensagem de erro
                        bootbox.dialog({
                            backdrop: true,
                            onEscape: function() {},
                            closeButton: true,
                            size: "medium",
                            title: "Erro!",
                            message: "<div>"+retornoJson.mensagem+"</div>",
                            buttons: {
                                confirm: {
                                    label: "Fechar",
                                    className: "btn-danger",
                                }
                            }
                        });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    bootbox.dialog({
                        backdrop: true,
                        onEscape: function() {},
                        closeButton: true,
                        size: "medium",
                        title: "Erro!",
                        message: "<div><p>Não foi possível efetuar a operação neste momento, por favor tente novamente. L429 - class_estudosPesquisas.php</p></div>",
                        buttons: {
                            confirm: {
                                label: "Fechar",
                                className: "btn-danger",
                            }
                        }
                    });
                }
            });
        } else {
            bootbox.dialog({
                backdrop: true,
                onEscape: function() {},
                // closeButton: true,
                size: "medium",
                title: "Atenção",
                message: "<div>"+mensagemErro+"</div>",
                buttons: {
                    confirm: {
                        label: "Fechar",
                        className: "btn-warning",
                    }
                }
            });
            return false;
        }
    });
});