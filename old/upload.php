<?php

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <!-- jQuery -->
        <script type="text/javascript" src="../lib/js/jquery.3.7.1.js"></script>
        <script type="text/javascript" src="../lib/js/jquery.3.7.1.min.js"></script>
        <script type="text/javascript" src="../lib/js/jquery-ui.1.13.3.js"></script>
        <script type="text/javascript" src="../lib/js/datepicker-pt-BR.js"></script>
        

        <!-- CSS Jquery Datepicker-->
        <link href="../lib/css/jquery-ui.css" rel="stylesheet">

        <link rel="stylesheet" href="globals.css" />
        <link rel="stylesheet" href="styleguide.css" />
        <link rel="stylesheet" href="styleUpload.css" />
        <link rel="stylesheet" href="/lib/css/index.css" />

        <!-- CSS Bootstrap -->
        <link href="/lib/css/bootstrap-grid.css" rel="stylesheet">
        <link href="/lib/css/bootstrap-grid.min.css" rel="stylesheet">
        <link href="/lib/css/bootstrap-grid.rtl.css" rel="stylesheet">
        <link href="/lib/css/bootstrap-grid.rtl.min.css" rel="stylesheet">
        <link href="/lib/css/bootstrap-reboot.css" rel="stylesheet">
        <link href="/lib/css/bootstrap-reboot.min.css" rel="stylesheet">
        <link href="/lib/css/bootstrap-reboot.rtl.css" rel="stylesheet">
        <link href="/lib/css/bootstrap-reboot.rtl.min.css" rel="stylesheet">
        <link href="/lib/css/bootstrap-utilities.css" rel="stylesheet">
        <link href="/lib/css/bootstrap-utilities.min.css" rel="stylesheet">
        <link href="/lib/css/bootstrap-utilities.rtl.css" rel="stylesheet">
        <link href="/lib/css/bootstrap-utilities.rtl.min.css" rel="stylesheet">
        <link href="/lib/css/bootstrap.css" rel="stylesheet">
        <link href="/lib/css/bootstrap.min.css" rel="stylesheet">
        <link href="/lib/css/bootstrap.rtl.css" rel="stylesheet">
        <link href="/lib/css/bootstrap.rtl.min.css" rel="stylesheet">

        <!-- JS Font Awesome -->
        <script src="/lib/js/fontawesome.js"></script>

        <!-- JS Bootstrap -->
        <script src="/lib/js/bootstrap.bundle.min.js"></script>
        <script src="/lib/js/bootstrap.bundle.js"></script>
        <script src="/lib/js/bootstrap.bundle.min.js"></script>
        <script src="/lib/js/bootstrap.esm.js"></script>
        <script src="/lib/js/bootstrap.esm.min.js"></script>
        <script src="/lib/js/bootstrap.js"></script>
        <script src="/lib/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="modal-incluir-estudo">
            <form action="/lib/class/upload.php" method="post" enctype="multipart/form-data">
                <div class="divEsquerda">
                    <div class="divTextAreaTitulo">
                        <label class="labelTitulo" for="textAreaTitulo">Título</label>
                        <textarea class="textAreaTitulo" maxlength=100 placeholder="Título" type="text" onkeyup="contaCaracteresTitulo(this)"></textarea>
                        <p class="contaCaracteresTitulo">100 caracteres restantes</p>
                    </div>
                    <div class="divTextAreaDescricao">
                        <label class="labelDescricao" for="textAreaDescricao">Descrição</label>
                        <textarea id="textAreaDescricao" maxlength=500 placeholder="Descrição" type="text" onkeyup="contaCaracteresDescricao(this)"></textarea>
                        <p class="contaCaracteresDescricao">500 caracteres restantes</p>
                    </div>



                    <div class="divTags">
                        <div class="labelTags">Tags</div>
                        <div class="group-2">
                            <div class="content-wrapper">
                                <div class="content-2">
                                    <div class="tag-default">
                                        <div class="text-wrapper">Label</div>
                                        <img class="clear" src="img/clear.svg" />
                                    </div>
                                    <div class="tag-default">
                                        <div class="text-wrapper">Label</div>
                                        <img class="clear" src="img/clear.svg" />
                                    </div>
                                    <div class="cursor">
                                        <div class="cursor-2"></div>
                                        <div class="input-text">Nova tag</div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-botton-2"></div>
                        </div>
                        <p class="textDicaTag">Separe as tags por vírgula</p>
                    </div>



                    <div class="file-upload-2">
                        <div class="labelUploadDownload">Download do modelo PPT</div>
                        <div class="file-upload-button-2">
                            <i class="fa-solid fa-download" style="color: rgb(56, 83, 255,1);" aria-hidden="true"></i>
                            <div class="divTextoUploadDownload">
                                <div class="divTextoUploadDownload01">Baixar Arquivo</div>
                                <div class="hint-text-2">10mb</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="divDireita">
                    <div class="divUploadPdf">
                        <label class="labelUploadDownload">Adicionar PDF da pesquisa</label>
                        <div class="divConteudoUpload">
                            <label class="iconeUploadPdfPng" for="uploadPdf">
                                <input id="uploadPdf" type="file" accept=".pdf">
                                    <i class="fas fa-upload fa-lg Clicar" style="color: rgb(56, 83, 255,1);" aria-hidden="true"></i>
                                
                            </label>
                            <div class="divTextoUploadDownload">
                                <div class="divTextoUploadDownload01">Enviar arquivo</div>
                                <span class="textoArquivoPdf">Máximo: 100MB</span>
                            </div>
                            <i id="checkPdf" class="fa-solid fa-check" aria-hidden="true" style="color: rgb(56, 83, 255,1); display: none;"></i>
                        </div>
                    </div>

                    <div class="divUploadPng">
                        <label class="labelUploadDownload">Adicionar capa do card</label>
                        <div class="divConteudoUpload">
                            <label class="iconeUploadPdfPng" for="uploadPng">
                                <input id="uploadPng" type="file" accept=".png">
                                    <i class="fas fa-upload fa-lg Clicar" style="color: rgb(56, 83, 255,1);" aria-hidden="true"></i>
                                
                            </label>
                            <div class="divTextoUploadDownload">
                                <div class="divTextoUploadDownload01">Enviar arquivo</div>
                                <span class="textoArquivoPng">Melhor formato 16x10</span>
                            </div>
                            <i id="checkPng" class="fa-solid fa-check" aria-hidden="true" style="color: rgb(56, 83, 255,1); display: none;"></i>
                        </div>
                    </div>
                
                    <div class="divPreviewCapa">
                        <div class="textoPreview">Preview da capa</div>
                        <img id="preview" src="#" alt="Preview da capa" style="display: none; max-width: 20rem;"/>
                    </div>

                    <button class="btn btn-success btnEnviar" style="margin: 28rem 18rem;">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </body>

    <script>

        $('#uploadPdf').on('change', function(){
            const [file] = uploadPdf.files;
            console.log(uploadPdf.files);
            if (file) {
                $('#checkPdf').css('display', 'block');
                $('.textoArquivoPdf').html('');
                $('.textoArquivoPdf').html(file.name);
            }
        });

        $('#uploadPng').on('change', function(){
            const [file] = uploadPng.files;
            console.log(uploadPng.files);
            if (file) {
                preview.src = URL.createObjectURL(file)
                $('#preview').css('display', 'block');
                $('#checkPng').css('display', 'block');
                $('.textoArquivoPng').html('');
                $('.textoArquivoPng').html(file.name);
            }
        });

        function contaCaracteresTitulo(val) {
            var len = val.value.length;
            if (len > 100) {
                val.value = val.value.substring(-1, 100);
            } else {
                $('.contaCaracteresTitulo').text(100 - len+' caracteres restantes');
            }
        };

        function contaCaracteresDescricao(val) {
            var len = val.value.length;
            if (len > 500) {
                val.value = val.value.substring(-1, 500);
            } else {
                $('.contaCaracteresDescricao').text(500 - len+' caracteres restantes');
            }
        };

    </script>

</html>