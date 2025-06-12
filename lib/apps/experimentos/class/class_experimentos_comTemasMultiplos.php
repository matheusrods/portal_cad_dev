<?php

// ini_set('display_startup_errors', 1);
session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

Class funcoes {

    public $mat;

    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
        $mat = $_SESSION['matricula'];
        $caminhoLogErro = $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
    }

    public function consultaTemas(){
        $mat = $_SESSION['matricula'];

        $db = New Database('experimentos');
        $query = "SELECT * FROM experimentos.temas WHERE ativo = 1;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $montaBotoesTemas = '<div class="divisaoTemas">';
                $qtdTemas = sizeof($execQuery);
                $qtdTemasLinha = ceil($qtdTemas/2);

                for($i = 0; $i < sizeof($execQuery); $i++){
                    if($i == ($qtdTemasLinha)){
                        $montaBotoesTemas = $montaBotoesTemas.'
                            </div> <div class="divisaoTemas"><div id="temaExperimentos'.$execQuery[$i]['idTema'].'" class="botoesFiltroTema Clicar" attr-id='.$execQuery[$i]['idTema'].' attr-filtroAtivo="0" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #E4ECFF; border-radius: 100px; flex-direction: column; justify-content: center; align-items: center; display: inline-flex; margin-top: 5%;">
                                <div style="color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">'.$execQuery[$i]['temas'].'</div>
                            </div>';
                    } else {
                        $montaBotoesTemas = $montaBotoesTemas.'
                            <div id="temaExperimentos'.$execQuery[$i]['idTema'].'" class="botoesFiltroTema Clicar" attr-id='.$execQuery[$i]['idTema'].' attr-filtroAtivo="0" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #E4ECFF; border-radius: 100px; flex-direction: column; justify-content: center; align-items: center; display: inline-flex; margin-top: 4%;">
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
            $arquivoLog = $this->geraLogExcecao("experimentos", "consultaTemas", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar os temas dos Experimentos. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    public function consultaExperimentos($idTema = null){
        $mat = $_SESSION['matricula'];

        if($idTema > 0){
            $filtroIdTema = "AND b.idTema in (".$idTema.")";
        }

        $db = New Database('experimentos');
        $query = "SELECT *
                    FROM experimentos.experimentos a
                    LEFT JOIN experimentos.experimentosTemas b ON a.idExperimento = b.idExperimento
                    LEFT JOIN experimentos.temas c ON b.idTema = c.idTema
                    WHERE a.ativo = 1 AND b.idTema ".$filtroIdTema." ORDER BY dtExperimento DESC;";

        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery > 0){
                $montaExperimentos = '';
                
                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){
                    $abreDivNestExperimento = '';
                    $fechaDivNestExperimento = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestExperimento = '<div class="abreDivNestExperimento" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestExperimento = '</div>';
                    }

                    $idExperimento = $execQuery[$j]['idExperimento'];
                    if($idExperimento < 10){
                        $idExperimento = '0'.$idExperimento;
                    }

                    $montaExperimentos = $montaExperimentos.$abreDivNestExperimento.'
                        <div class="divExperimento">
                            <a href="https://cad.bb.com.br/lib/apps/experimentos/arquivos/'.$idExperimento.'.pdf" target="_blank" style="text-decoration: none;">
                                <div class="fotoCapaExperimento" style="background-image: url(https://cad.bb.com.br/lib/apps/experimentos/arquivos/'.$idExperimento.'.png); background-position: bottom;">
                                    <div class="tagExperimento">
                                        <div class="textoTagExperimento">'.$execQuery[$j]['temas'].'</div>
                                    </div>
                                </div>
                            </a>
                            <div class="textoExperimento" style="align-self: stretch; height: 196px; padding: 32px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                                <div class="tituloSubtituloExperimento">
                                    <div class="tituloExperimento">'.$execQuery[$j]['titulo'].'</div>
                                    <div class="subtituloExperimento">'.$execQuery[$j]['subtitulo'].'</div>
                                </div>
                                <a href="https://cad.bb.com.br/lib/apps/experimentos/arquivos/'.$idExperimento.'.pdf" target="_blank" style="text-decoration: none; margin-top: 2rem;">
                                    <div class="abrirExperimento" attr-idExperimento="'.$execQuery[$j]['id'].'">
                                        <div style="text-align: center; color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">Ver experimento</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    '.$fechaDivNestExperimento;
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaExperimentos;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar os experimentos nesse momento. Informe à equipe responsável. L85 - class_experimentos.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("experimentos", "consultaExperimentos", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar os experimentos. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    public function filtraExperimentosTema($idTema){
        $mat = $_SESSION['matricula'];

        $db = New Database('experimentos');
        $query = "SELECT 
                        *
                    FROM experimentos.experimentos a
                    LEFT JOIN experimentos.temas b ON a.idExperimento = b.idTema
                    WHERE a.ativo = 1 AND b.idTema in (".$idTema.") ORDER BY dtExperimento DESC;";
                
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery > 0){
                $montaExperimentosFiltradas = '';

                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){

                    $abreDivNestExperimento = '';
                    $fechaDivNestExperimento = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestExperimento = '<div class="abreDivNestExperimento" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestExperimento = '</div>';
                    }

                    $idExperimento = $execQuery[$j]['idExperimento'];
                    if($idExperimento < 10){
                        $idExperimento = '0'.$idExperimento;
                    }

                    $montaExperimentosFiltradas = $montaExperimentosFiltradas.$abreDivNestExperimento.'
                        <div class="divExperimento">
                            <div style="align-self: stretch; height: 272.27px; padding-top: 16px; padding-bottom: 8px; padding-left: 73px; padding-right: 16px; background-image: url(https://cad.bb.com.br/lib/apps/experimentos/arquivos/'.$idExperimento.'.png); background-position: bottom; flex-direction: column; justify-content: flex-start; align-items: flex-end; display: flex; background-size: cover;">
                                <div style="padding-left: 8px; padding-right: 8px; background: #FDF429; border-radius: 999px; flex-direction: column; justify-content: center; align-items: center; display: flex; flex-wrap: wrap;">
                                    <div style="text-align: center; color: #111214; font-size: 12px; font-family: BancoDoBrasil Textos; font-weight: 500; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">'.$execQuery[$j]['tema'].'</div>
                                </div>
                                <div></div>
                            </div>
                            <div style="align-self: stretch; height: 196px; padding: 32px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                                <div style="align-self: stretch; height: 84px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">
                                    <div style="align-self: stretch; color: #111214; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">'.$execQuery[$j]['titulo'].'</div>
                                    <div style="align-self: stretch; color: #6C7077; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: 25.60px; word-wrap: break-word">'.$execQuery[$j]['subtitulo'].'</div>
                                </div>
                                <div class="abrirExperimento" attr-idExperimento="'.$execQuery[$j]['id'].'" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #FDF429; border-radius: 4px; justify-content: center; align-items: center; gap: 10px; display: inline-flex">
                                    <div style="text-align: center; color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">BUTTON LABEL</div>
                                </div>
                            </div>
                        </div>
                    ';
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaExperimentosFiltradas;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível filtrar os experimentos nesse momento. Informe à equipe responsável. L141 - class_experimentos.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("experimentos", "filtraExperimentosTema", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p  style='font-size: 16px; font-weight: bold;'>Não foi possível filtrar a página de Experimentos. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    // Função que busca no banco de dados as palavras digitadas no campo de pesquisa de experimentos
    public function pesquisaExperimentos($textoDigitado){
        $mat = $_SESSION['matricula'];

        $db = New Database('experimentos');
        $query = "SELECT 
                        *
                    FROM experimentos.experimentos a
                    LEFT JOIN experimentos.experimentosTemas b ON a.idExperimento = b.idExperimento
                    LEFT JOIN experimentos.temas c ON b.idTema = c.idTema
                    WHERE a.ativo = 1 AND (
                        a.titulo like ('%".$textoDigitado."%') OR 
                        subtitulo like ('%".$textoDigitado."%')
                    )
                    ORDER BY dtExperimento DESC;";

        try{
            $execQuery = $db->DbGetAll($query);
            
            if(sizeof($execQuery) == 0){
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = "
                    <h1>Não localizamos experimentos com o termo '".$textoDigitado."'.</h1>";
                
                    // $retorno["mensagem"] = $execQuery;
                return ($retorno);
            }

            if($execQuery > 0){
                $montaExperimentos = '';
                
                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){
                    $abreDivNestExperimento = '';
                    $fechaDivNestExperimento = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestExperimento = '<div class="abreDivNestExperimento" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestExperimento = '</div>';
                    }

                    $idExperimento = $execQuery[$j]['idExperimento'];
                    if($idExperimento < 10){
                        $idExperimento = '0'.$idExperimento;
                    }

                    $montaExperimentos = $montaExperimentos.$abreDivNestExperimento.'
                        <div class="divExperimento">
                            <a href="'.$execQuery[$j]['url'].'" target="_blank" style="text-decoration: none;">
                                <div class="fotoCapaExperimento" style="background-image: url(https://cad.bb.com.br/lib/apps/experimentos/arquivos/'.$idExperimento.'.png); background-position: bottom;">
                                    <div class="tagExperimento">
                                        <div class="textoTagExperimento">'.$execQuery[$j]['temas'].'</div>
                                    </div>
                                </div>
                            </a>
                            <div class="textoExperimento" style="align-self: stretch; height: 196px; padding: 32px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                                <div class="tituloSubtituloExperimento">
                                    <div class="tituloExperimento">'.$execQuery[$j]['titulo'].'</div>
                                    <div class="subtituloExperimento">'.$execQuery[$j]['subtitulo'].'</div>
                                </div>
                                <a href="'.$execQuery[$j]['url'].'" target="_blank" style="text-decoration: none; margin-top: 2rem;">
                                    <div class="abrirExperimento" attr-idExperimento="'.$execQuery[$j]['id'].'">
                                        <div style="text-align: center; color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">Ver experimento</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    '.$fechaDivNestExperimento;
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaExperimentos;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível pesquisar os experimentos nesse momento. Informe à equipe responsável. L294 - class_experimentos.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("experimentos", "pesquisaExperimentos", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível pesquisar a página de Experimentos. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            return ($retorno);
        }
    }

    public function adicionaExperimento(){
        $db = new Database('estudosPesquisas');
        $queryMontaSelect = "SELECT idTema, temas FROM experimentos.temas WHERE ativo = 1 ORDER BY temas ASC;";

        try{
            $execQueryMontaSelect = $db->DbGetAll($queryMontaSelect);
            
            if($execQueryMontaSelect){
                $montaSelect = '<div class="selectTemas">';

                for($i = 0; $i < sizeof($execQueryMontaSelect); $i++){
                    $montaSelect = $montaSelect.'
                        <div class="chip Clicar" attr-selected="0" attr-idTema="'.$execQueryMontaSelect[$i]["idTema"].'">
                            <div class="chip-content">'.$execQueryMontaSelect[$i]["temas"].'</div>
                        </div>
                    ';
                }
                $retornoSelect = $montaSelect.'</div>';
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $queryMontaSelect;
            $arquivoLog = $this->geraLogExcecao("experimentos", "adicionaExperimento", $informacoesErro, $mat);
            $retornoSelect = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar os temas dos experimentos. Não será possível gravar sua solicitação neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        }

        $resposta = array();
        $resposta['status'] = 1;
        $resposta['mensagem'] = '
            <div class="modal-incluir-experimento" attr-tipoUpload="'.$tipoUpload.'">
                <div class="divEsquerdaExperimentos">
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
                    <div class="divUploadPdfExperimentos">
                        <label class="labelUploadDownloadExperimentos">Adicionar PDF</label>
                        <div class="divConteudoUploadExperimentos">
                            <label class="iconeUploadPdfPng" for="uploadPdfExperimento">
                                <input id="uploadPdfExperimento" type="file" accept=".pdf">
                                <i class="fas fa-upload fa-lg Clicar" style="color: rgb(56, 83, 255,1);" tabindex=3></i>
                            </label>
                            <div class="divTextoUploadDownload">
                                <div class="divTextoUploadDownload01">Enviar arquivo PDF</div>
                                <span class="textoArquivoPdfExperimentos">Máximo: 100MB</span>
                            </div>
                            <i id="checkPdf" class="fa-solid fa-check" style="color: rgb(56, 83, 255,1); display: none;"></i>
                        </div>
                    </div>
                    <div class="checkboxResultadoExperimento">
                        <label class="labelUploadDownloadExperimentos">Resultado do experimento</label>
                        <div style="align-self: stretch;/* height: 104px; */flex-direction: column;justify-content: flex-start;align-items: flex-start;gap: 8px;display: flex">
                            <div class="divResultadoExperimentoPositivo">
                                <input type="checkbox" id="resultadoExperimentoPositivo" class="selectResultadoExperimento" name="resultadoExperimento" value="positivo" tabindex=4>
                                <label for="resultadoExperimento"> Positivo</label><br>  
                            </div>
                            <div class="divResultadoExperimentoNegativo">
                                <input type="checkbox" id="resultadoExperimentoNegativo" class="selectResultadoExperimento" name="resultadoExperimento" value="negativo" tabindex=5>
                                <label for="resultadoExperimento"> Negativo</label><br>  
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="divDireitaExperimentos">
                    <div class="divTagsExperimentos">
                        <div class="divSelectTemasExperimentos" style="display: inline-flex; flex-direction: column;">
                            <div class="labelTags">Temas</div>
                                '.$retornoSelect.'
                        </div>
                    </div>

                    <div class="divUploadPngExperimentos">
                        <label class="labelUploadDownloadlabelUploadDownloadExperimentos">Adicionar capa do card</label>
                        <div class="divConteudoUploadExperimentos">
                            <label class="iconeUploadPdfPng" for="uploadPngExperimentos">
                                <input id="uploadPngExperimentos" type="file" accept=".png">
                                <i class="fas fa-upload fa-lg Clicar" style="color: rgb(56, 83, 255,1);" tabindex=7></i>
                            </label>
                            <div class="divTextoUploadDownload">
                                <div class="divTextoUploadDownload01">Enviar arquivo PNG</div>
                                <span class="textoArquivoPng">Melhor formato 16x10</span>
                            </div>
                            <i id="checkPng" class="fa-solid fa-check" style="color: rgb(56, 83, 255,1); display: none;"></i>
                        </div>
                    </div>
                
                    <div class="divPreviewCapaExperimentos">
                        <div class="textoPreview">Preview da capa</div>
                        <!-- <img id="previewExperimentos" src="#" alt="Preview da capa" style="display: none; max-width: 20rem; min-width: 20rem; max-height: 12rem;"/> -->
                        <img id="previewExperimentos" src="/lib/apps/estudosPesquisas/arquivos/capaPreview.png" alt="Preview da capa" style="/*display: none;*/ width: 19.9rem; min-width: 19.9rem; height: 12rem; object-fit: contain;"/>
                    </div>
                    <div class="divBotoesAdicionarEstudosPesquisas">
                        <button class="btn btnLimparExperimentos" tabindex=9>
                            Limpar
                        </button>
                        <button class="btn btn-success btnEnviarExperimentos" tabindex=8>
                            Enviar
                        </button>
                    </div>

                </div>
            </div>
            
            <script>
                $(".chip").on("click", function(){
                    var selecionado = $(this).attr("attr-selected");
                    if(selecionado == 0){
                        $(this).attr("attr-selected", 1);
                        $(this).css("background-color", "#465eff");
                        $(this).css("color", "#ffffff");
                    } else {
                        $(this).attr("attr-selected", 0);
                        $(this).css("background-color", "#e5e5e5");
                        $(this).css("color", "#000000");
                    }
                })
                
                $("#resultadoExperimentoPositivo").on("change", function() {
                    var positivoCheck = $("#resultadoExperimentoPositivo").prop("checked");
                    var negativoCheck = $("#resultadoExperimentoNegativo").prop("checked");
                    if(negativoCheck === true){
                        $("#resultadoExperimentoNegativo").prop("checked", false);
                        $(".divResultadoExperimentoNegativo").css("border-color", "#B4B9C1");
                    }
                    if(positivoCheck === true){
                        $(".divResultadoExperimentoPositivo").css("border-color", "#2D37F5");
                    }
                    if(positivoCheck === false && negativoCheck === false){
                        $(".divResultadoExperimentoNegativo").css("border-color", "#B4B9C1");
                        $(".divResultadoExperimentoPositivo").css("border-color", "#B4B9C1");
                    }
                });

                $("#resultadoExperimentoNegativo").on("change", function() {
                    var positivoCheck = $("#resultadoExperimentoPositivo").prop("checked");
                    var negativoCheck = $("#resultadoExperimentoNegativo").prop("checked");
                    if(positivoCheck === true){
                        $("#resultadoExperimentoPositivo").prop("checked", false);
                        $(".divResultadoExperimentoPositivo").css("border-color", "#B4B9C1");
                    }
                    if(negativoCheck === true){
                        $(".divResultadoExperimentoNegativo").css("border-color", "#2D37F5");
                    }
                    if(positivoCheck === false && negativoCheck === false){
                        $(".divResultadoExperimentoNegativo").css("border-color", "#B4B9C1");
                        $(".divResultadoExperimentoPositivo").css("border-color", "#B4B9C1");
                    }
                });

                $(".btnLimparExperimentos").on("click", function(){
                    $("#textAreaTitulo").val("");
                    $("#textAreaDescricao").val("");
                    $("#temaSelecionadoSelect").val("0");
                    $("#periodoEstudoPesquisa").val("");
                    $("#uploadPdfExperimento").val("");
                    $("#uploadPngExperimentos").val("");
                    $(".textoArquivoPdfExperimentos").text("Máximo: 100MB");
                    $(".textoArquivoPng").text("Melhor formato 16x10");
                    $("#checkPdf").css("display","none");
                    $("#checkPng").css("display","none");
                    // $("#previewExperimentos").css("display","none");
                    $("#previewExperimentos").attr("src","/lib/apps/experimentos/arquivos/capaPreview.png");
                    $(".selectResultadoExperimento").prop("checked", false);
                    $(".divResultadoExperimentoNegativo").css("border-color", "#B4B9C1");
                    $(".divResultadoExperimentoPositivo").css("border-color", "#B4B9C1");
                    $(".contaCaracteresTitulo").text("50 caracteres restantes");
                    $(".contaCaracteresDescricao").text("120 caracteres restantes");
                });

                // Upload PDF de estudo/pesquisa
                $("#uploadPdfExperimento").on("change", function(){
                    const [file] = uploadPdfExperimento.files;
                    console.log(uploadPdfExperimento.files);
                    if (file) {
                        $("#checkPdf").css("display", "block");
                        $(".textoArquivoPdfExperimentos").html("");
                        $(".textoArquivoPdfExperimentos").html(file.name);
                    }
                });

                // Upload PNG da capa de estudo/pesquisa
                $("#uploadPngExperimentos").on("change", function(){
                    const [file] = uploadPngExperimentos.files;
                    // console.log(uploadPngExperimentos.files);
                    // Mostrar a miniatura do arquivo selecionado
                    if (file) {
                        previewExperimentos.src = URL.createObjectURL(file)
                        $("#previewExperimentos").css("display", "block");
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

                $(".btnEnviarExperimentos").click(function () {
                    var caminhoupload = "https://cad.bb.com.br/lib/class/uploadExperimento.php";
                    var formData = new FormData();

                    var resultadoExperimento = $(".selectResultadoExperimento:checked").val();

                    var arr=[];
                    $("div[attr-selected=\'1\']").each(function(){
                        arr.push($(this).attr("attr-idTema"));
                    });

                    
                    formData.append("titulo", ($("#textAreaTitulo").val().replace(/[\\\']/g, \'"\')));
                    formData.append("descricao", ($("#textAreaDescricao").val().replace(/[\\\']/g, \'"\')));
                    // formData.append("idTema", $("#temaSelecionadoSelect").val());
                    formData.append("idTema", arr);
                    formData.append("resultadoExperimento", $(".selectResultadoExperimento:checked").val());
                    formData.append("pdf", $("#uploadPdfExperimento")[0].files[0]);
                    formData.append("png", $("#uploadPngExperimentos")[0].files[0]);
                    
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
                    
                    if($("#uploadPdfExperimento")[0].files.length == 0){
                        mensagemErro = mensagemErro+"-Anexar arquivo PDF de Experimento;<br>";
                        contaErros = ++contaErros;
                    } else {
                        var ehFormatoPdf = ($("#uploadPdfExperimento")[0].files[0].name).slice(-3);
                        var ehFormatoPdfMinusculo = ehFormatoPdf.toLowerCase();

                        if(ehFormatoPdfMinusculo != "pdf" || ehFormatoPdfMinusculo == undefined){
                            mensagemErro = mensagemErro+"-Selecionar o arquivo de Experimento no formato correto (PDF);<br>";
                            contaErros = ++contaErros;
                        }
                    }

                    if(resultadoExperimento === undefined || resultadoExperimento == ""){
                        mensagemErro = mensagemErro+"-Selecionar o resultado do experimento;<br>";
                        contaErros = ++contaErros;
                    }
                    
                    if(($("#temaSelecionadoSelect").val()) == 0){
                        mensagemErro = mensagemErro+"-Selecionar Tema;<br>";
                        contaErros = ++contaErros;
                    }

                    if(arr == "" || arr == undefined || arr.length == 0){
                        mensagemErro = mensagemErro+"-Selecionar Tema;<br>";
                        contaErros = ++contaErros;
                    }

                    if($("#uploadPngExperimentos")[0].files.length == 0){
                        mensagemErro = mensagemErro+"-Anexar arquivo PNG da capa;<br>";
                        contaErros = ++contaErros;
                    } else {
                        var ehFormatoPng = ($("#uploadPngExperimentos")[0].files[0].name).slice(-3);
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
                                    $(".botaoLimpaPesquisa").click();
                                    $(".divConsultarExperimentos").click();
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