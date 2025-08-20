<div class="modal-incluir-estudo" attr-tipoUpload="<?= $tipoUpload ?>">
    <div class="divEsquerda">
        <div class="divTextAreaTitulo">
            <label class="labelTitulo" for="textAreaTitulo">Título</label>
            <textarea id="textAreaTitulo" maxlength=50 placeholder="Título" type="text" onkeyup="contaCaracteresTitulo(this)" tabindex=1></textarea>
            <p class="contaCaracteresTitulo">50 caracteres restantes</p>
        </div>
        <div class="divTextAreaDescricao">
            <label class="label" for="textAreaDescricao">Descrição</label>
            <textarea id="textAreaDescricao" maxlength=120 placeholder="Descrição" type="text" onkeyup="contaCaracteresDescricao(this)" tabindex=2></textarea>
            <p class="contaCaracteresDescricao">120 caracteres restantes</p>
        </div>
        <div class="divTags">
            <div class="divInputPeríodo" style="display: inline-flex; flex-direction: column;">
                <label for="periodoEstudoPesquisa">Data de publicação:</label>
                <input type="month" id="periodoEstudoPesquisa" name="periodoEstudoPesquisa"max="<?= date("Y-m") ?>" style="height: 1.4rem;" tabindex=4>
            </div>
            <div class="divSelectTemas" style="display: inline-flex; flex-direction: column;">
                <div class="labelTags">Temas</div>
                     <?= $retornoSelect ?>
            </div>
        </div>
        <div class="divDownloadPpt">
            <div class="labelUploadDownload">Download do modelo PPT</div>
            <div class="divBotaoDownloadPpt">
                <a href="https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/templateEstudosPesquisas.pptx">
                    <i class="fa-solid fa-download" style="color: rgb(56, 83, 255,1);"></i>
                </a>
                <div class="divTextoUploadDownload">
                    <div class="divTextoUploadDownload01">Baixar Arquivo</div>
                    <div class="textoArquivoPpt">2MB</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="divDireita">
        <div class="divUploadPdf">
            <label class="labelUploadDownload">Adicionar PDF</label>
            <div class="divConteudoUpload">
                <label class="iconeUploadPdfPng" for="uploadPdf">
                    <input id="uploadPdf" type="file" accept=".pdf">
                    <i class="fas fa-upload fa-lg Clicar" style="color: rgb(56, 83, 255,1);" tabindex=5></i>
                </label>
                <div class="divTextoUploadDownload">
                    <div class="divTextoUploadDownload01">Enviar arquivo PDF</div>
                    <span class="textoArquivoPdf">Máximo: 100MB</span>
                </div>
                <i id="checkPdf" class="fa-solid fa-check" style="color: rgb(56, 83, 255,1); display: none;"></i>
            </div>
        </div>

        <div class="divUploadPng">
            <label class="labelUploadDownload">Adicionar capa do card</label>
            <div class="divConteudoUpload">
                <label class="iconeUploadPdfPng" for="uploadPng">
                    <input id="uploadPng" type="file" accept=".png">
                    <i class="fas fa-upload fa-lg Clicar" style="color: rgb(56, 83, 255,1);" tabindex=6></i>
                </label>
                <div class="divTextoUploadDownload">
                    <div class="divTextoUploadDownload01">Enviar arquivo PNG</div>
                    <span class="textoArquivoPng">Melhor formato 16x10</span>
                </div>
                <i id="checkPng" class="fa-solid fa-check" style="color: rgb(56, 83, 255,1); display: none;"></i>
            </div>
        </div>
    
        <div class="divPreviewCapa">
            <div class="textoPreview">Preview da capa</div>
            <img id="preview" src="/lib/apps/estudosPesquisas/arquivos/capaPreview.png" alt="Preview da capa" style="max-width: 19.9rem; min-width: 19.9rem; max-height: 12rem;"/>
        </div>
    </div>
    <div class="modal-actions">
        <button class="btn btnLimpar" tabindex="8">Limpar</button>
        <button class="btn btn-success btnEnviar" attr-qualBotao="<?= $tipoUpload ?>" tabindex=7>Enviar</button>
    </div>
</div>

<script>
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
</script>
