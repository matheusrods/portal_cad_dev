<?php

// ini_set('display_startup_errors', 1);
session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

$geraLog = new geraLog();

Class funcoes {

    public $caminhoLogErro;

    // Função padrão do PHP para declaração de variáveis que serão utilizadas em outras funções
    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
        
        $caminhoLogErro = $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
        $this->mat = $_SESSION['matricula'];
    }

    public function consultaEstudos(){
        $mat = $_SESSION['matricula'];
        $db = New Database('estudosPesquisas');
        $query = "SELECT * FROM estudosPesquisas.estudosPesquisas a
                    LEFT JOIN estudosPesquisas.temas b ON a.tema = b.id
                    WHERE a.tipo = 'estudos'
                    AND a.ativo = 1 
                    ORDER BY dtEstudoPesquisa DESC, idEstudo DESC;";

        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery > 0){
                $montaEstudos = '';
                $sequencia = 0;
                
                for($j = 0; $j < sizeof($execQuery); $j++){
                    $abreDivNestEstudos = '';
                    $fechaDivNestEstudos = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestEstudos = '<div class="abreDivNestEstudos" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestEstudos = '</div>';
                    }

                    $idEstudo = $execQuery[$j]['idEstudo'];
                    if($idEstudo < 10){
                        $idEstudo = '0'.$idEstudo;
                    }

                    $montaEstudos = $montaEstudos.$abreDivNestEstudos.'
                        <div class="divEstudo">
                            <a href="https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idEstudo.'.pdf" target="_blank" style="text-decoration: none;">
                                <div class="fotoCapaEstudo" style="background-image: url(https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idEstudo.'.png);">
                                    <div class="tagEstudo">
                                        <div class="textoTagEstudo">'.$execQuery[$j]['temas'].'</div>
                                    </div>
                                </div>
                            </a>
                            <div class="textoEstudo" style="align-self: stretch; height: 196px; padding: 32px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                                <div class="tituloSubtituloEstudo">
                                    <div class="tituloEstudo">'.$execQuery[$j]['titulo'].'</div>
                                    <div class="subtituloEstudo">'.$execQuery[$j]['subtitulo'].'</div>
                                </div>
                                <a href="https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idEstudo.'.pdf" target="_blank" style="text-decoration: none; margin-top: 4rem;">
                                    <div class="abrirEstudo" attr-idEstudo="'.$execQuery[$j]['idEstudo'].'">
                                        <div style="text-align: center; color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">Ver Estudo</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    '.$fechaDivNestEstudos;
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaEstudos;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar os Estudos nesse momento. Informe à equipe responsável. L99 - class_estudosPesquisa.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("estudosPesquisas", "consultaEstudos", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar os Estudos. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    // Função que consulta as Pesquisas
    public function consultaPesquisas(){
        $mat = $_SESSION['matricula'];
        $db = New Database('estudosPesquisas');
        $query = "SELECT * FROM estudosPesquisas.estudosPesquisas a
                    LEFT JOIN estudosPesquisas.temas b ON a.tema = b.id
                    WHERE a.tipo = 'pesquisas'
                    AND a.ativo = 1 
                    ORDER BY dtEstudoPesquisa DESC, idEstudo DESC;";

        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery > 0){
                $montaPesquisas = '';
                
                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){
                    $abreDivNestPesquisas = '';
                    $fechaDivNestPesquisas = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestPesquisas = '<div class="abreDivNestPesquisas" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestPesquisas = '</div>';
                    }

                    $idPesquisa = $execQuery[$j]['idEstudo'];
                    if($idPesquisa < 10){
                        $idPesquisa = '0'.$idPesquisa;
                    }

                    $montaPesquisas = $montaPesquisas.$abreDivNestPesquisas.'
                        <div class="divPesquisa">
                            <a href="https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idPesquisa.'.pdf" target="_blank" style="text-decoration: none;">
                                <div class="fotoCapaPesquisa" style="background-image: url(https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idPesquisa.'.png);">
                                    <div class="tagPesquisa">
                                        <div class="textoTagPesquisa">'.$execQuery[$j]['temas'].'</div>
                                    </div>
                                </div>
                            </a>
                            <div class="textoPesquisa" style="align-self: stretch; height: 196px; padding: 32px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                                <div class="tituloSubtituloPesquisa">
                                    <div class="tituloPesquisa">'.$execQuery[$j]['titulo'].'</div>
                                    <div class="subtituloPesquisa">'.$execQuery[$j]['subtitulo'].'</div>
                                </div>
                                <a href="https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idPesquisa.'.pdf" target="_blank" style="text-decoration: none; margin-top: 4rem;">
                                    <div class="abrirPesquisa" attr-idPesquisa="'.$execQuery[$j]['idPesquisa'].'">
                                        <div style="text-align: center; color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">Ver Pesquisa</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    '.$fechaDivNestPesquisas;
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaPesquisas;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar as Pesquisas nesse momento. Informe à equipe responsável. L99 - class_estudosPesquisa.php";
            }
        } catch(Exception $e){
            $retorno = array();
            $informacoesErro = "erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("estudosPesquisas", "consultaPesquisas", $informacoesErro, $mat);
            $retorno["status"] = 0;
            $retorno["mensagem"] = "<p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar as Pesquisas. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    public function consultaTemas($tipoTema){
        $mat = $_SESSION['matricula'];

        $db = New Database('estudosPesquisas');
        $query = "SELECT * FROM estudosPesquisas.temas WHERE temaEstudoPesquisa = '".$tipoTema."' AND ativo = 1;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $montaBotoesTemas = '<div class="divisaoTemas">';
                $qtdTemas = sizeof($execQuery);
                $qtdTemasLinha = ceil($qtdTemas/2);

                for($i = 0; $i < sizeof($execQuery); $i++){
                    if($i == ($qtdTemasLinha)){
                        $montaBotoesTemas = $montaBotoesTemas.'
                            </div> <div class="divisaoTemas"><div id="tema'.$tipoTema . $execQuery[$i]['id'].'" class="botoesFiltroTema'.$tipoTema.' Clicar" attr-id='.$execQuery[$i]['id'].' attr-filtroAtivo'.$tipoTema.'="0" attr-qualOpcao="'.$tipoTema.'" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #E4ECFF; border-radius: 100px; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                                <div style="color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">'.$execQuery[$i]['temas'].'</div>
                            </div>';
                    } else {
                        $montaBotoesTemas = $montaBotoesTemas.'
                            <div id="tema'.$tipoTema . $execQuery[$i]['id'].'" class="botoesFiltroTema'.$tipoTema.' Clicar" attr-id='.$execQuery[$i]['id'].' attr-filtroAtivo'.$tipoTema.'="0" attr-qualOpcao="'.$tipoTema.'" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #E4ECFF; border-radius: 100px; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                                <div style="color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">'.$execQuery[$i]['temas'].'</div>
                            </div>';
                    }
                }
                
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaBotoesTemas.'</div>';
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("estudosPesquisas", "consultaTemas", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar os temas de ".$tipoTema.". Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    public function paginaAdicionaEstudoPesquisa($tipoUpload){
        $db = new Database('estudosPesquisas');
        $queryMontaSelect = "SELECT id, temas FROM estudosPesquisas.temas WHERE temaEstudoPesquisa = '".$tipoUpload."' AND ativo = 1 ORDER BY temas ASC;";
        $tipoUploadMaiuscula = rtrim(ucfirst($tipoUpload), "s");

        try{
            $execQueryMontaSelect = $db->DbGetAll($queryMontaSelect);
            
            if($execQueryMontaSelect){
                $montaSelect = '<div class="selectTemas"><select id="temaSelecionadoSelect" tabindex=3><option value="0">Selecione o tema:</option>';
                
                for($i = 0; $i < sizeof($execQueryMontaSelect); $i++){
                    $montaSelect = $montaSelect.'<option value="'.$execQueryMontaSelect[$i]["id"].'">'.$execQueryMontaSelect[$i]["temas"].'</option>';
                }
                
                $retornoSelect = $montaSelect.'</select></div>';
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $queryMontaSelect;
            $arquivoLog = $this->geraLogExcecao("estudosPesquisas", "paginaAdicionaEstudoPesquisa", $informacoesErro, $mat);
            $retornoSelect = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar os temas de ".$tipoUpload.". Não será possível gravar sua solicitação neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        }

        $resposta = array();
        $resposta['status'] = 1;
        $resposta['mensagem'] = '
            <div class="modal-incluir-estudo" attr-tipoUpload="'.$tipoUpload.'">
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
                        <div class="divSelectTemas" style="display: inline-flex; flex-direction: column;">
                            <div class="labelTags">Temas</div>
                                '.$retornoSelect.'
                        </div>
                        <div class="divInputPeríodo" style="display: inline-flex; flex-direction: column;">
                            <label for="periodoEstudoPesquisa">Mês de referência:</label>
                            <input type="month" id="periodoEstudoPesquisa" name="periodoEstudoPesquisa" max="'.date("Y-m").'" style="height: 1.4rem;" tabindex=4>
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
                        <!-- <img id="preview" src="#" alt="Preview da capa" style="display: none; max-width: 20rem; min-width: 20rem; max-height: 12rem;"/> -->
                        <img id="preview" src="/lib/apps/estudosPesquisas/arquivos/capaPreview.png" alt="Preview da capa" style="display: none; max-width: 19.9rem; min-width: 19.9rem; max-height: 12rem;"/>
                    </div>
                    <div class="divBotoesAdicionarEstudosPesquisas" style="display: flex; justify-content: flex-end; gap: 1rem; width: 100%; z-index: 3;">
                        <button class="btn btnLimpar" style="margin: 28rem 1rem 28rem -13rem; background-color: rgb(56, 83, 255, 1); color: white; width: 5rem; height: 3rem;" tabindex="8">
                            Limpar
                        </button>
                        <button class="btn btn-success btnEnviar" attr-qualBotao="'.$tipoUpload.'" style="margin: 28rem 2rem 28rem 0rem; width: 5rem; height: 3rem;" tabindex=7>
                            Enviar
                        </button>
                    </div>

                </div>
            </div>
            
            <script>
                var isFirefox = typeof InstallTrigger !== "undefined";
                
                if(isFirefox === true){
                    $("#periodoEstudoPesquisa").datepicker({
                        maxDate: "-1D",
                        dateFormat: "yy-mm"
                    });
                }
                
                $(".btnLimpar").on("click", function(){
                    $("#textAreaTitulo").val("");
                    $("#textAreaDescricao").val("");
                    $("#temaSelecionadoSelect").val("0");
                    $("#periodoEstudoPesquisa").val("");
                    $("#uploadPdf").val("");
                    $("#uploadPng").val("");
                    $(".textoArquivoPdf").text("Máximo: 100MB");
                    $(".textoArquivoPng").text("Melhor formato 16x10");
                    $("#checkPdf").css("display","none");
                    $("#checkPng").css("display","none");
                    $("#preview").css("display","none");
                    $("#preview").attr("src","/lib/apps/estudosPesquisas/arquivos/capaPreview.png");
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
                    // console.log(uploadPng.files);
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
                    
                    formData.append("titulo", ($("#textAreaTitulo").val().replace(/[\\\']/g, \'"\')));
                    formData.append("descricao", ($("#textAreaDescricao").val().replace(/[\\\']/g, \'"\')));
                    formData.append("idTema", $("#temaSelecionadoSelect").val());
                    formData.append("dtEstudoPesquisa", $("#periodoEstudoPesquisa").val());
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

                    if(($("#periodoEstudoPesquisa").val()).length == 0){
                        mensagemErro = mensagemErro+"-Preencher mês de referência;<br>";
                        contaErros = ++contaErros;
                    }

                    if($("#uploadPdf")[0].files.length == 0){
                        mensagemErro = mensagemErro+"-Anexar arquivo PDF de '.$tipoUpload.';<br>";
                        contaErros = ++contaErros;
                    } else {
                        var ehFormatoPdf = ($("#uploadPdf")[0].files[0].name).slice(-3);
                        var ehFormatoPdfMinusculo = ehFormatoPdf.toLowerCase();

                        if(ehFormatoPdfMinusculo != "pdf" || ehFormatoPdfMinusculo == undefined){
                            mensagemErro = mensagemErro+"-Selecionar o arquivo de '.$tipoUpload.' no formato correto (PDF);<br>";
                            contaErros = ++contaErros;
                        }
                    }
                    
                    if($("#uploadPng")[0].files.length == 0){
                        mensagemErro = mensagemErro+"-Anexar arquivo PNG da capa;<br>";
                        contaErros = ++contaErros;
                    } else {
                        var ehFormatoPng = ($("#uploadPng")[0].files[0].name).slice(-3);
                        var ehFormatoPngMinusculo = ehFormatoPng.toLowerCase();
                    
                        if(ehFormatoPngMinusculo != "png" || ehFormatoPngMinusculo == undefined){
                            mensagemErro = mensagemErro+"-Selecionar o arquivo da capa no formato correto (PNG);<br>";
                            contaErros = ++contaErros;
                        }
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
                            error: function (retorno) {
                                bootbox.dialog({
                                    backdrop: true,
                                    onEscape: function() {},
                                    closeButton: true,
                                    size: "medium",
                                    title: "Erro!",
                                    message: "<div><p>"+retorno.mensagem+"<br><br> Erro: L429 - class_estudosPesquisas.php</p></div>",
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
            </script>
        ';
        return $resposta;
    }

    public function consultaEstudosPesquisas($idTema, $qualOpcao){
        $mat = $_SESSION['matricula'];
        $db = New Database('estudosPesquisas');
        $query = "SELECT * FROM estudosPesquisas.estudosPesquisas a LEFT JOIN estudosPesquisas.temas b ON a.tema = b.id WHERE b.temaEstudoPesquisa like '%".$qualOpcao."%' and a.tema in (".$idTema.") AND a.ativo = 1 ORDER BY dtEstudoPesquisa DESC, idEstudo DESC;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery > 0){
                $montaEstudos = '';
                $qualOpcao == 'Pesquisas' ? $nomeElemento = 'Pesquisa' : $nomeElemento = 'Estudo';
                
                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){
                    $abreDivNestEstudos = '';
                    $fechaDivNestEstudos = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestEstudos = '<div class="abreDivNest'.$qualOpcao.'" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestEstudos = '</div>';
                    }

                    $idEstudo = $execQuery[$j]['idEstudo'];
                    if($idEstudo < 10){
                        $idEstudo = '0'.$idEstudo;
                    }

                    $montaEstudos = $montaEstudos.$abreDivNestEstudos.'
                        <div class="div'.$nomeElemento.'">
                            <a href="https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idEstudo.'.pdf" target="_blank" style="text-decoration: none;">
                                <div class="fotoCapa'.$nomeElemento.'" style="background-image: url(https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idEstudo.'.png);">
                                    <div class="tag'.$nomeElemento.'">
                                        <div class="textoTag'.$nomeElemento.'">'.$execQuery[$j]['temas'].'</div>
                                    </div>
                                </div>
                            </a>
                            <div class="texto'.$nomeElemento.'" style="align-self: stretch; height: 196px; padding: 32px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                                <div class="tituloSubtitulo'.$nomeElemento.'">
                                    <div class="titulo'.$nomeElemento.'">'.$execQuery[$j]['titulo'].'</div>
                                    <div class="subtitulo'.$nomeElemento.'">'.$execQuery[$j]['subtitulo'].'</div>
                                </div>
                                <a href="https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idEstudo.'.pdf" target="_blank" style="text-decoration: none; margin-top: 4rem;">
                                    <div class="abrir'.$nomeElemento.'" attr-id'.$nomeElemento.'="'.$execQuery[$j]['idEstudo'].'">
                                        <div style="text-align: center; color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">Ver '.$nomeElemento.'</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    '.$fechaDivNestEstudos;
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaEstudos;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível efetuar a buscas de ".$qualOpcao." nesse momento. Informe à equipe responsável. L288 - class_estudosPesquisa.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("estudosPesquisas", "consultaEstudosPesquisas", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar ".$qualOpcao." nomomento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }

    }

    // Pesquisa estudos e pesquisas através de termos digitados na barra de pesquisa
    public function pesquisaTextoDigitado($textoDigitado, $qualOpcao){
        $mat = $_SESSION['matricula'];
        $db = New Database('estudosPesquisas');
        $query = "SELECT * FROM estudosPesquisas.estudosPesquisas a LEFT JOIN estudosPesquisas.temas b ON a.tema = b.id WHERE (titulo like '%".$textoDigitado."%' OR subtitulo like '%".$textoDigitado."%') and tipo like '%".$qualOpcao."%' AND a.ativo = 1 ORDER BY dtEstudoPesquisa DESC, idEstudo DESC;";

        try{
            $execQuery = $db->DbGetAll($query);
            
            if(sizeof($execQuery) == 0){
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = "
                    <h1>Não localizamos '".$qualOpcao."' com o termo '".$textoDigitado."'.</h1>";
                return ($retorno);
            }

            if($execQuery > 0){
                $montaEstudos = '';
                $qualOpcao == 'Pesquisas' ? $nomeElemento = 'Pesquisa' : $nomeElemento = 'Estudo';
                
                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){
                    $abreDivNestEstudos = '';
                    $fechaDivNestEstudos = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestEstudos = '<div class="abreDivNest'.$qualOpcao.'" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestEstudos = '</div>';
                    }

                    $idEstudo = $execQuery[$j]['idEstudo'];
                    if($idEstudo < 10){
                        $idEstudo = '0'.$idEstudo;
                    }

                    $montaEstudos = $montaEstudos.$abreDivNestEstudos.'
                        <div class="div'.$nomeElemento.'">
                            <a href="https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idEstudo.'.pdf" target="_blank" style="text-decoration: none;">
                                <div class="fotoCapa'.$nomeElemento.'" style="background-image: url(https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idEstudo.'.png);">
                                    <div class="tag'.$nomeElemento.'">
                                        <div class="textoTag'.$nomeElemento.'">'.$execQuery[$j]['temas'].'</div>
                                    </div>
                                </div>
                            </a>
                            <div class="texto'.$nomeElemento.'" style="align-self: stretch; height: 196px; padding: 32px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                                <div class="tituloSubtitulo'.$nomeElemento.'">
                                    <div class="titulo'.$nomeElemento.'">'.$execQuery[$j]['titulo'].'</div>
                                    <div class="subtitulo'.$nomeElemento.'">'.$execQuery[$j]['subtitulo'].'</div>
                                </div>
                                <a href="https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idEstudo.'.pdf" target="_blank" style="text-decoration: none; margin-top: 4rem;">
                                    <div class="abrir'.$nomeElemento.'" attr-id'.$nomeElemento.'="'.$execQuery[$j]['idEstudo'].'">
                                        <div style="text-align: center; color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">Ver '.$nomeElemento.'</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    '.$fechaDivNestEstudos;
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaEstudos;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível efetuar a buscas de ".$qualOpcao." nesse momento. Informe à equipe responsável. L379 - class_estudosPesquisa.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("estudosPesquisas", "pesquisaTextoDigitado", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível buscar pelo termo '".$textoDigitado."' na aba de ".$qualOpcao.". Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            return ($retorno);
        }
    }

    // Função que grava eventuais logs de erro de banco de dados em formato texto
    public function geraLogExcecao($nomeApp, $nomeFuncao, $informacoesAdicionais, $mat){
        $dateTime = date("Y-m-d")."_". date("H.i.s");
        $nomeArquivo = $dateTime . "_" . $mat . "_" . $nomeApp . "_" . $nomeFuncao .".txt";
        $caminhoArquivo = $this->caminhoLogErro . "/" . $nomeArquivo;

        $strDataHora = print_r(new DateTime(), true);
        $strRequest = print_r($_REQUEST, true);
        $strSession = print_r($_SESSION, true);
        
        $strArquivo = "data:\n" . $strDataHora . "\n\$_REQUEST:\n" . $strRequest . "\n\$_SESSION:\n" . $strSession . "\n\$informacoesAdicionais:\n" . $informacoesAdicionais;

        file_put_contents($caminhoArquivo, $strArquivo);
        chmod($caminhoArquivo, 0777);

        return $caminhoArquivo;
    }
}





?>