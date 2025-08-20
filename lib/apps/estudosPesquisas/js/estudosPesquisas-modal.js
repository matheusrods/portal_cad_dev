$(function() {

    // Firefox: datepicker fallback (opcional, pode remover se não usa jQuery UI)
    var isFirefox = typeof InstallTrigger !== "undefined";
    if(isFirefox === true && $.fn.datepicker) {
        $("#periodoEstudoPesquisa").datepicker({
            maxDate: "-1D",
            dateFormat: "yy-mm"
        });
    }

    // Limpar campos da modal
    $(".btnLimpar").on("click", function(){
        $("#textAreaTitulo").val("");
        $("#textAreaDescricao").val("");
        $("#temaSelecionadoSelect").val("0");
        $("#periodoEstudoPesquisa").val("");
        $("#uploadPdf").val("");
        $("#uploadPng").val("");
        $(".textoArquivoPdf").text("Máximo: 100MB");
        $(".textoArquivoPng").text("Melhor formato 16x10");
        $("#checkPdf").hide();
        $("#checkPng").hide();
        $("#preview").hide().attr("src","/lib/apps/estudosPesquisas/arquivos/capaPreview.png");
    });

    // Upload PDF de estudo/pesquisa
    $("#uploadPdf").on("change", function(){
        const [file] = this.files;
        if (file) {
            $("#checkPdf").show();
            $(".textoArquivoPdf").html(file.name);
        } else {
            $("#checkPdf").hide();
            $(".textoArquivoPdf").text("Máximo: 100MB");
        }
    });

    // Upload PNG da capa de estudo/pesquisa
    $("#uploadPng").on("change", function(){
        const [file] = this.files;
        if (file) {
            $("#preview").attr("src", URL.createObjectURL(file)).show();
            $("#checkPng").show();
            $(".textoArquivoPng").html(file.name);
        } else {
            $("#preview").hide().attr("src","/lib/apps/estudosPesquisas/arquivos/capaPreview.png");
            $("#checkPng").hide();
            $(".textoArquivoPng").text("Melhor formato 16x10");
        }
    });

    // Conta caracteres do título
    window.contaCaracteresTitulo = function(val) {
        var len = val.value.length;
        if (len > 50) {
            val.value = val.value.substring(0, 50);
        }
        $(".contaCaracteresTitulo").text(50 - val.value.length + " caracteres restantes");
    };

    // Conta caracteres da descrição
    window.contaCaracteresDescricao = function(val) {
        var len = val.value.length;
        if (len > 120) {
            val.value = val.value.substring(0, 120);
        }
        $(".contaCaracteresDescricao").text(120 - val.value.length + " caracteres restantes");
    };

    // Enviar formulário
    $(".btnEnviar").click(function () {
        var caminhoupload = "/lib/class/uploadNovo.php"; // coloque o caminho correto aqui
        var formData = new FormData();

        // Use let para pegar o tipoUpload se necessário (vindo via atributo)
        var tipoUpload = $(this).attr("attr-qualBotao") || "estudo";

        formData.append("titulo", $("#textAreaTitulo").val().replace(/[\\\']/g, '"'));
        formData.append("descricao", $("#textAreaDescricao").val().replace(/[\\\']/g, '"'));
        formData.append("idTema", $("#temaSelecionadoSelect").val());
        formData.append("dtEstudoPesquisa", $("#periodoEstudoPesquisa").val());
        formData.append("tipoDocumento", tipoUpload);
        formData.append("pdf", $("#uploadPdf")[0].files[0]);
        formData.append("png", $("#uploadPng")[0].files[0]);

        var mensagemErro = "Necessário: <br><br>";
        var contaErros = 0;

        if(!$("#textAreaTitulo").val().trim()){
            mensagemErro += "-Preencher Título;<br>";
            contaErros++;
        }
        if(!$("#textAreaDescricao").val().trim()){
            mensagemErro += "-Preencher Descrição;<br>";
            contaErros++;
        }
        if($("#temaSelecionadoSelect").val() == "0"){
            mensagemErro += "-Selecionar Tema;<br>";
            contaErros++;
        }
        if(!$("#periodoEstudoPesquisa").val()){
            mensagemErro += "-Preencher mês de referência;<br>";
            contaErros++;
        }

        // Validação PDF
        var pdfInput = $("#uploadPdf")[0];
        if(!pdfInput.files.length){
            mensagemErro += "-Anexar arquivo PDF de " + tipoUpload + ";<br>";
            contaErros++;
        } else {
            var pdfName = pdfInput.files[0].name;
            if(!pdfName.toLowerCase().endsWith(".pdf")){
                mensagemErro += "-Selecionar o arquivo de " + tipoUpload + " no formato correto (PDF);<br>";
                contaErros++;
            }
        }

        // Validação PNG
        var pngInput = $("#uploadPng")[0];
        if(!pngInput.files.length){
            mensagemErro += "-Anexar arquivo PNG da capa;<br>";
            contaErros++;
        } else {
            var pngName = pngInput.files[0].name;
            if(!pngName.toLowerCase().endsWith(".png")){
                mensagemErro += "-Selecionar o arquivo da capa no formato correto (PNG);<br>";
                contaErros++;
            }
        }

        mensagemErro = mensagemErro.replace(/<br>$/, "") + ".";

        if(contaErros == 0){
            $.ajax({
                url: caminhoupload,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(retorno) {
                    bootbox.hideAll();
                    var retornoJson = {};
                    try {
                        retornoJson = typeof retorno === 'string' ? JSON.parse(retorno) : retorno;
                    } catch(e) {
                        retornoJson = {status: 0, mensagem: "Erro ao processar resposta do servidor."};
                    }

                    if (retornoJson.status == 1) {
                        bootbox.dialog({
                            backdrop: true,
                            onEscape: function() {},
                            closeButton: true,
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
                        // Atualize aqui se quiser limpar os campos novamente, ex:
                        $(".btnLimpar").trigger("click");
                    } else {
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
                error: function (retorno) {
                    bootbox.dialog({
                        backdrop: true,
                        onEscape: function() {},
                        closeButton: true,
                        size: "medium",
                        title: "Erro!",
                        message: "<div><p>Ocorreu um erro ao enviar. <br><br> Erro: L429 - class_estudosPesquisas.php</p></div>",
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
        }
    });
});