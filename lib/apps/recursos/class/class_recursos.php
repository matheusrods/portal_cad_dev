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

        $db = New Database('recursos');
        $query = "SELECT distinct(b.id), b.tema FROM recursos.recursosTemas a
        LEFT JOIN recursos.temas b ON a.idTema = b.id
        WHERE b.ativo = 1 ORDER BY b.tema;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $montaBotoesTemas = '<div class="divisaoTemas">';
                $qtdTemas = sizeof($execQuery);
                // $qtdTemasLinha = ceil($qtdTemas/2);

                for($i = 0; $i < sizeof($execQuery); $i++){
                    // if($i == ($qtdTemasLinha)){
                    //     $montaBotoesTemas = $montaBotoesTemas.'
                    //         </div> <div class="divisaoTemas"><div id="temaRecursos'.$execQuery[$i]['id'].'" class="botoesFiltroTema Clicar" attr-id='.$execQuery[$i]['id'].' attr-filtroAtivo="0" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #E4ECFF; border-radius: 100px; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                    //             <div style="color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">'.$execQuery[$i]['tema'].'</div>
                    //         </div>';
                    // } else {
                        $montaBotoesTemas = $montaBotoesTemas.'
                            <div id="temaRecursos'.$execQuery[$i]['id'].'" class="botoesFiltroTema Clicar" attr-id="'.$execQuery[$i]['id'].'" attr-filtroAtivo="0" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #E4ECFF; border-radius: 100px; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                                <div style="color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">'.$execQuery[$i]['tema'].'</div>
                            </div>';
                    // }
                }
                
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaBotoesTemas.'</div>';
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("recursos", "consultaTemas", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar os temas das Recursos. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    public function consultaRecursos($idTema = null){
        $mat = $_SESSION['matricula'];
        $uorDep = $_SESSION['cod_uor'];

        if($idTema > 0){
            $filtroIdTema = "AND c.id in (".$idTema.")";
        }

        $whereAtivo = 'WHERE a.ativo IN (1)';
        // if(($_SESSION['dependencia']) == '1901'){
        if($uorDep == '486362' || $uorDep == '486361'){
            $whereAtivo = 'WHERE a.ativo IN (0, 1)';
        }

        $db = New Database('recursos');
        $query = "SELECT a.*, c.tema, a.ativo as 'recursoAtivo'
                    FROM recursos.recursos a
                    LEFT JOIN recursos.recursosTemas b ON a.id = b.idRecurso
                    LEFT JOIN recursos.temas c ON b.idTema = c.id
                    -- WHERE a.ativo = 1 ".$filtroIdTema."
                    ".$whereAtivo." ".$filtroIdTema."
                    ORDER BY a.ativo DESC, a.id DESC;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery > 0){
                $montaRecursos = '';
                
                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){
                    $abreDivNestRecurso = '';
                    $fechaDivNestRecurso = '';
                    $stylePrimeiraDiv = '';
                    $caminhoRecurso = '';
                    $textoBotaoAcessar = '';
                    $estiloRecursoInativo = '';
                    $avisoRecursoInativo = '';

                    $botaoEditarRecurso = '';
        
                    if($uorDep == '486362' || $uorDep == '486361'){
                        $botaoEditarRecurso = '<i class="fa-solid fa-pen Clicar editarRecurso" aria-hidden="true" style="display: flex; align-items: center;" attr-idRecursoEditar="'.$execQuery[$j]['id'].'"></i>';
                    }

                    if(($execQuery[$j]['recursoAtivo']) == 0){
                        $estiloRecursoInativo = 'style="opacity: 0.4;"';
                        $avisoRecursoInativo = "<b>Recurso inativo </b>- ";
                    }

                    if($execQuery[$j]['linkExterno'] == 0){
                        $caminhoRecurso = "https://cad.bb.com.br/lib/apps/recursos/arquivos/".$execQuery[$j]['nomeArquivo'];
                        $textoBotaoAcessar = 'Ver documento';
                    } else {
                        $caminhoRecurso = $execQuery[$j]['nomeArquivo'];
                        $textoBotaoAcessar = 'Acessar link';
                    }

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestRecurso = '<div class="abreDivNestRecurso" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestRecurso = '</div>';
                    }
                    // $nomeArquivoCapaComTimestamp = $execQuery[$j]['nomeCapa'].'?v='.time();
                    $montaRecursos = $montaRecursos.$abreDivNestRecurso.'
                        <div class="divRecurso" '.$estiloRecursoInativo.'>
                            <a href="'.$caminhoRecurso.'?t='.time().'" target="_blank" style="text-decoration: none;">
                                <div class="fotoCapaRecurso" style="background-image: url(https://cad.bb.com.br/lib/apps/recursos/arquivos/'.$execQuery[$j]['nomeCapa'].'?t='.time().'); background-repeat: no-repeat; background-position: center; background-color: #465eff;">
                                    <div class="tagRecurso">
                                        <div class="textoTagRecurso">'.$execQuery[$j]['tema'].'</div>
                                    </div>
                                </div>
                            </a>
                            <div class="textoRecurso" style="align-self: stretch; height: 196px; padding: 32px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                                <div class="tituloSubtituloRecurso">
                                    <div class="tituloRecurso">'.$avisoRecursoInativo.''.$execQuery[$j]['titulo'].'</div>
                                    <div class="subtituloRecurso">'.$execQuery[$j]['subtitulo'].'</div>
                                </div>
                                <div class="divEditarVerDocumento" style="width: 100%; display: inline-flex; flex-direction: row; margin-top: 2rem;">
                                    '.$botaoEditarRecurso.'
                                    <a href="'.$caminhoRecurso.'?t='.time().'" target="_blank" style="width: 50%;text-decoration: none;/* margin-top: 2rem; */">
                                        <div class="abrirRecurso" attr-idrecurso="5">
                                            <div style="text-align: center; color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">'.$textoBotaoAcessar.'</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    '.$fechaDivNestRecurso;
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaRecursos;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar as notícias nesse momento. Informe à equipe responsável. L85 - class_recursos.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("recursos", "consultaRecursos", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar as Recursos. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    public function filtraRecursosTema($idTema){
        $mat = $_SESSION['matricula'];

        $db = New Database('recursos');
        $query = "SELECT 
                    a.*, 
                    c.id AS 'idTema',
                    c.tema 
                FROM recursos.recursos a
                LEFT JOIN recursos.recursosTemas b ON a.id = b.idRecurso
                LEFT JOIN recursos.temas c ON b.idTema = c.id
                WHERE a.ativo = 1 AND c.id in (".$idTema.");";
                
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery > 0){
                $montaRecursosFiltradas = '';

                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){

                    $abreDivNestRecurso = '';
                    $fechaDivNestRecurso = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestRecurso = '<div class="abreDivNestRecurso" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestRecurso = '</div>';
                    }

                    $montaRecursosFiltradas = $montaRecursosFiltradas.$abreDivNestRecurso.'
                        <div class="divRecurso">
                            <div style="align-self: stretch; height: 272.27px; padding-top: 16px; padding-bottom: 8px; padding-left: 73px; padding-right: 16px; background-image: url(https://cad.bb.com.br/lib/apps/recursos/arquivos/'.$execQuery[$j]['nomeCapa'].'); background-repeat: no-repeat; background-position: center; background-color: #465eff;">
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
                                <div class="abrirRecurso" attr-idRecurso="'.$execQuery[$j]['id'].'" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #FDF429; border-radius: 4px; justify-content: center; align-items: center; gap: 10px; display: inline-flex">
                                    <div style="text-align: center; color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">BUTTON LABEL</div>
                                </div>
                            </div>
                        </div>
                    ';
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaRecursosFiltradas;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível filtrar as notícias nesse momento. Informe à equipe responsável. L141 - class_recursos.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("recursos", "filtraRecursosTema", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p  style='font-size: 16px; font-weight: bold;'>Não foi possível filtrar a página de Recursos. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    // Função que busca no banco de dados as palavras digitadas no campo de pesquisa de notícias
    public function pesquisaRecursos($textoDigitado){
        $mat = $_SESSION['matricula'];
        $uorDep = $_SESSION['cod_uor'];

        $whereAtivo = 'WHERE a.ativo = 1';
        // if(($_SESSION['dependencia']) == '1901'){
        if($uorDep == '486362' || $uorDep == '486361'){
            $whereAtivo = 'WHERE a.ativo IN (0, 1)';
        }

        $db = New Database('recursos');
        $query = "SELECT 
                    a.*, 
                    c.id AS 'idTema',
                    c.tema,
                    a.ativo as 'recursoAtivo'
                FROM recursos.recursos a
                LEFT JOIN recursos.recursosTemas b ON a.id = b.idRecurso
                LEFT JOIN recursos.temas c ON b.idTema = c.id
                -- WHERE a.ativo = 1 AND (
                ".$whereAtivo." AND (
                    a.titulo like ('%".$textoDigitado."%') OR 
                    subtitulo like ('%".$textoDigitado."%')
                )
                ORDER BY a.ativo DESC, a.id ASC;";

        try{
            $execQuery = $db->DbGetAll($query);
            
            if(sizeof($execQuery) == 0){
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = "
                    <h1>Não localizamos notícias com o termo '".$textoDigitado."'.</h1>";
                
                    // $retorno["mensagem"] = $execQuery;
                return ($retorno);
            }

            if($execQuery > 0){
                $montaRecursos = '';
                
                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){
                    $abreDivNestRecurso = '';
                    $fechaDivNestRecurso = '';
                    $stylePrimeiraDiv = '';
                    $caminhoRecurso = '';
                    $textoBotaoAcessar = '';
                    $estiloRecursoInativo = '';
                    $avisoRecursoInativo = '';
                    $botaoEditarRecurso = '';
        
                    if($uorDep == '486362' || $uorDep == '486361'){
                        $botaoEditarRecurso = '<i class="fa-solid fa-pen Clicar editarRecurso" aria-hidden="true" style="display: flex; align-items: center;" attr-idRecursoEditar="'.$execQuery[$j]['id'].'"></i>';
                    }

                    if(($execQuery[$j]['recursoAtivo']) == 0){
                        $estiloRecursoInativo = 'style="opacity: 0.4;"';
                        $avisoRecursoInativo = "<b>Recurso inativo </b>- ";
                    }

                    if($execQuery[$j]['linkExterno'] == 0){
                        $caminhoRecurso = "https://cad.bb.com.br/lib/apps/recursos/arquivos/".$execQuery[$j]['nomeArquivo'];
                        $textoBotaoAcessar = 'Ver documento';
                    } else {
                        $caminhoRecurso = $execQuery[$j]['nomeArquivo'];
                        $textoBotaoAcessar = 'Acessar link';
                    }

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestRecurso = '<div class="abreDivNestRecurso" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestRecurso = '</div>';
                    }

                    $montaRecursos = $montaRecursos.$abreDivNestRecurso.'
                        <div class="divRecurso" '.$estiloRecursoInativo.'>
                            <a href="'.$caminhoRecurso.'" target="_blank" style="text-decoration: none;">
                                <div class="fotoCapaRecurso" style="background-image: url(https://cad.bb.com.br/lib/apps/recursos/arquivos/'.$execQuery[$j]['nomeCapa'].'?t='.time().'); background-repeat: no-repeat; background-position: center; background-color: #465eff;">
                                    <div class="tagRecurso">
                                        <div class="textoTagRecurso">'.$execQuery[$j]['tema'].'</div>
                                    </div>
                                </div>
                            </a>
                            <div class="textoRecurso" style="align-self: stretch; height: 196px; padding: 32px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                                <div class="tituloSubtituloRecurso">
                                    <div class="tituloRecurso">'.$avisoRecursoInativo.' '.$execQuery[$j]['titulo'].'</div>
                                    <div class="subtituloRecurso">'.$execQuery[$j]['subtitulo'].'</div>
                                </div>
                                <div class="divEditarVerDocumento" style="width: 100%; display: inline-flex; flex-direction: row; margin-top: 2rem;">
                                    '.$botaoEditarRecurso.'
                                    <a href="'.$caminhoRecurso.'" target="_blank" style="width: 50%;text-decoration: none;/* margin-top: 2rem; */">
                                        <div class="abrirRecurso" attr-idrecurso="5">
                                            <div style="text-align: center; color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">'.$textoBotaoAcessar.'</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    '.$fechaDivNestRecurso;
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaRecursos;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível pesquisar as notícias nesse momento. Informe à equipe responsável. L266 - class_recursos.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("recursos", "pesquisaRecursos", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível pesquisar a página de Recursos. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            return ($retorno);
        }
    }

    // Função que carrega um recurso e o exibe para edição
    public function editaRecurso($idRecurso){
        $mat = $_SESSION['matricula'];
        $db = New Database("recursos");
        $query = "SELECT *, a.ativo as recursoAtivo FROM recursos.recursos a
                    LEFT JOIN recursos.recursosTemas b ON a.id = b.idRecurso
                    LEFT JOIN recursos.temas c ON b.idTema = c.id
                    WHERE a.id = ".$idRecurso.";";
        $retorno = array();

        try {
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $checkBotaoAtivaDesativa = ($execQuery[0]['recursoAtivo']==1)?' checked':'';

                $queryTags = "SELECT *, '#465EFF' as corFundoChip, '#FFFFFF' as corFonteChip, '1' as 'selected' FROM recursos.temas WHERE ativo = 1 and id = ".$execQuery[0]['idTema']."
                        UNION ALL
                        SELECT *, '#e5e5e5' as corFundoChip, '#000000' as corFonteChip, '0' as 'selected' FROM recursos.temas WHERE ativo = 1 and id <> ".$execQuery[0]['idTema'].";";
                $execQueryTags = $db->DbGetAll($queryTags);
                
                if($execQueryTags){
                    $montaChipsTemas = '<div class="selectTemas" attr-alteracao="0">';
    
                    for($i = 0; $i < sizeof($execQueryTags); $i++){
                        $montaChipsTemas = $montaChipsTemas.'
                            <div class="chip Clicar" attr-selected="'.$execQueryTags[$i]["selected"].'" attr-idTema="'.$execQueryTags[$i]["id"].'" style="background-color:'.$execQueryTags[$i]["corFundoChip"].'; color:'.$execQueryTags[$i]["corFonteChip"].';">
                                <div class="chip-content">'.$execQueryTags[$i]["tema"].'</div>
                            </div>
                        ';
                    }
                    $retornoSelect = $montaChipsTemas.'</div>';
                }

                if($execQuery[0]['linkExterno'] == 1){
                    $conteudoDivArquivo = 
                        '<label class="labelUploadDownloadEditarRecurso">Alterar link do recurso</label>
                        <textarea id="textAreaDescricaoEditarRecursoLink" type="text" attr-alteracao="0" onkeyup="removeDisable(\'textAreaDescricaoEditarRecursoLink\');">'.$execQuery[0]['nomeArquivo'].'</textarea>
                        <i id="checkPdf" class="fa-solid fa-check" style="color: rgb(56, 83, 255,1); display: none;"></i>
                    ';
                } else {
                    $conteudoDivArquivo = 
                        '<div class="divUploadPdfEditarRecurso">
                            <label class="labelUploadDownloadEditarRecurso">Alterar arquivo do recurso</label>
                            <div class="divConteudoUploadEditarRecurso">
                                <label class="iconeUploadPdfPngEditarRecurso" for="uploadPdfEditarRecurso">
                                    <input id="uploadPdfEditarRecurso" type="file" attr-alteracao="0">
                                    <i class="fas fa-upload fa-lg Clicar" style="color: rgb(56, 83, 255,1);" tabindex=3></i>
                                </label>
                                <div class="divTextoUploadDownloadEditarRecurso">
                                    <div class="divTextoUploadDownloadEditarRecurso01">Enviar arquivo</div>
                                    <span class="textoArquivoPdfEditarRecurso">'.$execQuery[0]['nomeArquivo'].'</span>
                                </div>
                                <i id="checkPdf" class="fa-solid fa-check" style="color: rgb(56, 83, 255,1); display: none;"></i>
                            </div>
                        </div>
                    ';
                }
                
                $retorno["status"] = 1;
                $retorno["mensagem"] = '
                    <div class="modalEditarRecurso">
                        <div class="divEsquerdaEditarRecurso">
                            <div class="divTextAreaTituloEditarRecurso">
                                <label class="labelTituloEditarRecurso" for="textAreaTituloEditarRecurso">Título</label>
                                <textarea id="textAreaTituloEditarRecurso" maxlength=50 placeholder="Título" type="text" onkeyup="contaCaracteresTitulo(this); removeDisable(\'textAreaTituloEditarRecurso\');" tabindex=1 attr-alteracao="0">'.$execQuery[0]['titulo'].'</textarea>
                                <p class="contaCaracteresTitulo">'.(50 - (mb_strlen($execQuery[0]['titulo']))).' caracteres restantes</p>
                            </div>
                            <div class="divTextAreaDescricaoEditarRecurso">
                                <label class="label" for="textAreaDescricaoEditarRecurso">Subtítulo</label>
                                <textarea id="textAreaDescricaoEditarRecurso" maxlength=120 placeholder="Descrição" type="text" onkeyup="contaCaracteresDescricao(this); removeDisable(\'textAreaDescricaoEditarRecurso\');" tabindex=2 attr-alteracao="0">'.$execQuery[0]['subtitulo'].'</textarea>
                                <p class="contaCaracteresDescricao">'.(120 - (mb_strlen($execQuery[0]['subtitulo']))).' caracteres restantes</p>
                            </div>
                            
                                '.$conteudoDivArquivo.'
                            
                            <div class="ativaDesativaRecursoEditarRecurso">
                                <label class="labelTituloEditarRecurso" for="textAreaTituloEditarRecurso">Recurso ativo?</label>
                                <!-- <div style="color: #00FFE0; font-size: 32px; font-family: BancoDoBrasil Textos; font-weight: 500; line-height: 36px; letter-spacing: 0.16px; word-wrap: break-word">
                                    Recurso ativo?
                                </div> -->

                                <label class="switchAtivaDesativaRecurso">
                                    <input id="chaveAtivaDesativaRecurso" type="checkbox" attr-alteracao="0" attr-recursoAtivoInativo="'.$execQuery[0]['recursoAtivo'].'" '.$checkBotaoAtivaDesativa.' onchange="removeDisable(\'chaveAtivaDesativaRecurso\');">
                                    <span class="sliderAtivaDesativaRecurso round"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="divDireitaEditarRecurso">
                            <div class="divTagsEditarRecurso">
                                <div class="divSelectTemasEditarRecurso" style="display: inline-flex; flex-direction: column;">
                                    <div class="labelTags">Temas</div>
                                        '.$retornoSelect.'
                                </div>
                            </div>

                            <div class="divUploadPngEditarRecurso">
                                <label class="labelUploadDownloadEditarRecurso">Alterar capa do card</label>
                                <div class="divConteudoUploadEditarRecurso">
                                    <label class="iconeUploadPdfPngEditarRecurso" for="uploadPngEditarRecurso">
                                        <input id="uploadPngEditarRecurso" type="file" accept=".png" attr-alteracao="0">
                                        <i class="fas fa-upload fa-lg Clicar" style="color: rgb(56, 83, 255,1);" tabindex=7></i>
                                    </label>
                                    <div class="divTextoUploadDownloadEditarRecurso">
                                        <div class="divTextoUploadDownloadEditarRecurso01">Enviar arquivo PNG</div>
                                        <span class="textoArquivoPngEditarRecurso">'.$execQuery[0]['nomeCapa'].'</span>
                                    </div>
                                    <i id="checkPng" class="fa-solid fa-check" style="color: rgb(56, 83, 255,1); display: none;"></i>
                                </div>
                            </div>
                        
                            <div class="divPreviewCapaEditarRecurso" style="margin-top: 1rem;">
                                <div class="textoPreview">Preview da capa</div>
                                <img id="previewEditarRecurso" src="/lib/apps/recursos/arquivos/'.$execQuery[0]['nomeCapa'].'?t='.time().'" alt="Preview da capa" style="/*display: none;*/ width: 19.9rem; min-width: 19.9rem; height: 12rem; object-fit: contain;"/>
                            </div>
                        </div>
                    </div>
                    
                    <script>
                        $(".btnGravaEdicaoRecurso").attr("disabled", "disabled");
                        $(".btnGravaEdicaoRecurso").css("opacity", "0.4");
                        $(".btnGravaEdicaoRecurso").attr("attr-idRecurso", "'.$idRecurso.'");

                        function removeDisable(campoEditado){
                            $(".btnGravaEdicaoRecurso").removeAttr("disabled");
                            $(".btnGravaEdicaoRecurso").css("cursor", "pointer");
                            $(".btnGravaEdicaoRecurso").css("opacity", "1");
                            $("#"+campoEditado).attr("attr-alteracao", 1);
                        };
                        
                        $(".chip").on("click", function(){
                            $(".selectTemas").attr("attr-alteracao", 1);
                            var selecionado = $(this).attr("attr-selected");
                            if(selecionado == 0){
                                $(".chip").attr("attr-selected", 0);
                                $(".chip").css("background-color", "#e5e5e5");
                                $(".chip").css("color", "#000000");
                                $(this).attr("attr-selected", 1);
                                $(this).css("background-color", "#465eff");
                                $(this).css("color", "#ffffff");
                            } else {
                                $(this).attr("attr-selected", 0);
                                $(this).css("background-color", "#e5e5e5");
                                $(this).css("color", "#000000");
                            }
                            $(".btnGravaEdicaoRecurso").removeAttr("disabled");
                            $(".btnGravaEdicaoRecurso").css("opacity", "1");
                        })

                        // Upload PDF de recurso
                        $("#uploadPdfEditarRecurso").on("change", function(){
                            const [file] = uploadPdfEditarRecurso.files;
                            // console.log(uploadPdfEditarRecurso.files);
                            
                            if (file) {
                                $("#checkPdf").css("display", "block");
                                $(".textoArquivoPdfEditarRecurso").html("");
                                $(".textoArquivoPdfEditarRecurso").html(file.name);
                                $(".btnGravaEdicaoRecurso").removeAttr("disabled");
                                $(".btnGravaEdicaoRecurso").css("opacity", "1");
                                $(this).attr("attr-alteracao", 1);
                            }
                        });

                        // Upload PNG da capa de recurso
                        $("#uploadPngEditarRecurso").on("change", function(){
                            const [file] = uploadPngEditarRecurso.files;
                            // console.log(uploadPngEditarRecurso.files);
                            // Mostrar a miniatura do arquivo selecionado
                            if (file) {
                                previewEditarRecurso.src = URL.createObjectURL(file)
                                $("#previewEditarRecurso").css("display", "block");
                                $("#checkPng").css("display", "block");
                                $(".textoArquivoPngEditarRecurso").html("");
                                $(".textoArquivoPngEditarRecurso").html(file.name);
                                $(".btnGravaEdicaoRecurso").removeAttr("disabled");
                                $(".btnGravaEdicaoRecurso").css("opacity", "1");
                                $(this).attr("attr-alteracao", 1);
                            }
                        });

                        // alteração de arquivo quando é link
                        $("#uploadPdfEditarRecursoLink").on("change", function(){

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

                        // Altera o attr referente ao novo status do recurso
                        $("#chaveAtivaDesativaRecurso").on("change", function(){
                            if($("#chaveAtivaDesativaRecurso").attr("attr-recursoAtivoInativo") == 0){
                                $("#chaveAtivaDesativaRecurso").attr("attr-recursoAtivoInativo", "1");
                            } else {
                                $("#chaveAtivaDesativaRecurso").attr("attr-recursoAtivoInativo", "0");
                            }
                        });

                        $(".btnGravaEdicaoRecurso").click(function () {
                            var caminhoupload = "https://cad.bb.com.br/lib/apps/recursos/class/editarRecursos.php";
                            var idRecurso = $(this).attr("attr-idRecurso");
                            var formData = new FormData();
                            var validaAlteracaoTitulo = $("#textAreaTituloEditarRecurso").attr("attr-alteracao");
                            var validaAlteracaoDescricao = $("#textAreaDescricaoEditarRecurso").attr("attr-alteracao");
                            var validaAlteracaoStatus = $("#chaveAtivaDesativaRecurso").attr("attr-alteracao");
                            var validaAlteracaoTemas = $(".selectTemas").attr("attr-alteracao");
                            // var validaAlteracaoDocumento = $("#uploadPdfEditarRecurso").attr("attr-alteracao");
                            var validaAlteracaoCapa = $("#uploadPngEditarRecurso").attr("attr-alteracao");

                            var validaAlteracaoDocumento = "";
                            var tipoDocumentoAlteradoEditaRecurso = "";

                            if(($("#uploadPdfEditarRecurso").length) == 0){
                                var validaAlteracaoDocumento = $("#textAreaDescricaoEditarRecursoLink").attr("attr-alteracao");
                                var tipoDocumentoAlteradoEditaRecurso = "linkExterno";
                            } else if (($("#textAreaDescricaoEditarRecursoLink").length) == 0){
                                var validaAlteracaoDocumento = $("#uploadPdfEditarRecurso").attr("attr-alteracao");
                                var tipoDocumentoAlteradoEditaRecurso = "arquivo";
                            }

                            formData.append("idRecurso", '.$idRecurso.');

                            var arr=[];
                            $("div[attr-selected=\'1\']").each(function(){
                                arr.push($(this).attr("attr-idTema"));
                            });
                            
                            var arrCamposEditar = [];

                            if(validaAlteracaoTitulo == 1){
                                formData.append("titulo", ($("#textAreaTituloEditarRecurso").val().replace(/[\\\']/g, \'"\')));
                                arrCamposEditar.push("titulo");
                            }
                            
                            if(validaAlteracaoDescricao == 1){
                                formData.append("descricao", ($("#textAreaDescricaoEditarRecurso").val().replace(/[\\\']/g, \'"\')));
                                arrCamposEditar.push("descricao");
                            }

                            if(validaAlteracaoStatus == 1){
                                formData.append("novoStatus", ($("#chaveAtivaDesativaRecurso").attr("attr-recursoAtivoInativo")));
                                arrCamposEditar.push("status");
                            }
                            
                            if(validaAlteracaoTemas == 1){
                                formData.append("idTema", arr);
                                arrCamposEditar.push("idTema");
                            }

                            if(validaAlteracaoDocumento == 1){
                                if(tipoDocumentoAlteradoEditaRecurso == "arquivo"){
                                    formData.append("pdf", $("#uploadPdfEditarRecurso")[0].files[0]);
                                    formData.append("tipoArquivo", tipoDocumentoAlteradoEditaRecurso);
                                    arrCamposEditar.push("nomeArquivo");
                                }
                                
                                if(tipoDocumentoAlteradoEditaRecurso == "linkExterno"){
                                    formData.append("pdf", ($("#textAreaDescricaoEditarRecursoLink").val().replace(/[\\\']/g, \'"\')));
                                    formData.append("tipoArquivo", tipoDocumentoAlteradoEditaRecurso);
                                    arrCamposEditar.push("nomeArquivo");
                                }
                            }

                            if(validaAlteracaoCapa == 1){
                                formData.append("png", $("#uploadPngEditarRecurso")[0].files[0]);
                                arrCamposEditar.push("nomeCapa");
                            }
                            
                            formData.append("camposParaEditar", arrCamposEditar);

                            var mensagemErro = "Necessário: <br><br>";
                            var contaErros = 0;
                            
                            if(($("#textAreaTituloEditarRecurso").val()).length == 0){
                                mensagemErro = mensagemErro+"-Preencher Título;<br>";
                                contaErros = ++contaErros;
                            }

                            if(($("#textAreaDescricaoEditarRecurso").val()).length == 0){
                                mensagemErro = mensagemErro+"-Preencher Descrição;<br>";
                                contaErros = ++contaErros;
                            }
                            
                            if(arr == "" || arr == undefined || arr.length == 0){
                                mensagemErro = mensagemErro+"-Selecionar Tema;<br>";
                                contaErros = ++contaErros;
                            }

                            // for (var pair of formData.entries()) {
                            //     console.log(pair[0]+ ": " + pair[1]); 
                            // }
                            // return;
                            
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
                                        } else {
                                            // Se não conseguir pesquisar, exibe a mensagem de erro
                                            bootbox.hideAll();
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
                                            message: "<div><p>"+retorno.mensagem+"<br><br> Erro: L622 - class_recursos.php</p></div>",
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
                    </script>';
            } else {
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível editar o recurso neste momento. Informe à equipe responsável. Erro L651 - class_recursos.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query ."\n\$queryTags:" . $queryTags;
            $arquivoLog = $this->geraLogExcecao("recursos", "editaRecurso", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível carregar a edição de Recurso. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            return ($retorno);
        }
    }

    public function paginaAdicionaRecurso(){
        $db = New Database("recursos");
        $queryMontaSelect = "SELECT * FROM recursos.temas WHERE ativo = 1 ORDER BY tema ASC;";
        
        try{
            $execQueryMontaSelect = $db->DbGetAll($queryMontaSelect);
            
            if($execQueryMontaSelect){
                $montaSelect = '<div class="selectTemas"><select id="temaSelecionadoSelect" tabindex=3><option value="0">Selecione o tema:</option>';
                
                for($i = 0; $i < sizeof($execQueryMontaSelect); $i++){
                    $montaSelect = $montaSelect.'<option value="'.$execQueryMontaSelect[$i]["id"].'">'.$execQueryMontaSelect[$i]["tema"].'</option>';
                }
                
                $retornoSelect = $montaSelect.'</select></div>';
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $queryMontaSelect;
            $arquivoLog = $this->geraLogExcecao("recursos", "paginaAdicionaRecurso", $informacoesErro, $mat);
            $retornoSelect = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar os temas de recursos. Não será possível gravar sua solicitação neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        }
        
        $resposta = array();
        $resposta['status'] = 1;
        $resposta['mensagem'] = '
            <div class="modalIncluirRecurso">
                <div class="divEsquerdaAdicionarRecurso">
                    <div class="divTextAreaTituloAdicionaRecurso">
                        <label class="labelTitulo" for="textAreaTituloAdicionaRecurso">Título</label>
                        <textarea id="textAreaTituloAdicionaRecurso" maxlength=50 placeholder="Título" type="text" onkeyup="contaCaracteresTitulo(this)" tabindex=1></textarea>
                        <p class="contaCaracteresTitulo">50 caracteres restantes</p>
                    </div>
                    <div class="divTextAreaDescricaoAdicionaRecurso">
                        <label class="label" for="textAreaDescricaoAdicionaRecurso">Descrição</label>
                        <textarea id="textAreaDescricaoAdicionaRecurso" maxlength=120 placeholder="Descrição" type="text" onkeyup="contaCaracteresDescricao(this)" tabindex=2></textarea>
                        <p class="contaCaracteresDescricao">120 caracteres restantes</p>
                    </div>
                    <div class="divTags">
                        <div class="divSelectTemas" style="display: inline-flex; flex-direction: column;">
                            <div class="labelTags">Temas</div>
                                '.$retornoSelect.'
                        </div>
                    </div>
                </div>
                
                <div class="divDireitaAdicionarRecurso">
                    <div class="divUploadPdf">
                        <!-- <label class="labelUploadDownloadAdicionarRecurso">Adicionar arquivo do Recurso</label> -->

                        <div style="display: inline-flex;width: 100%;gap: 10px;">
                            <label class="labelUploadDownloadAdicionarRecurso Clicar" style="font-weight: bold;" attr-botaoTipoArquivo="arquivo">Adicionar arquivo</label>
                            <label class="labelUploadDownloadAdicionarRecurso Clicar" attr-botaoTipoArquivo="linkExterno">Adicionar link externo</label>
                        </div>
                        <div class="divConteudoUpload divConteudoUploadPdfAdicionarRecurso">
                            <label class="iconeUploadPdfPng" for="uploadPdf">
                                <input id="uploadPdf" type="file">
                                <i class="fas fa-upload fa-lg Clicar" style="color: rgb(56, 83, 255,1);" tabindex=5></i>
                            </label>
                            <div class="divTextoUploadDownload">
                                <div class="divTextoUploadDownload01">Enviar arquivo</div>
                                <span class="textoArquivoPdf">Máximo: 100MB</span>
                            </div>
                            <i id="checkPdf" class="fa-solid fa-check" style="color: rgb(56, 83, 255,1); display: none;"></i>
                        </div>
                        <div class="divConteudoLinkExterno">
                            <textarea id="textAreaDescricaoAdicionarRecursoLink" type="text" attr-alteracao="0" onkeyup="contaCaracteresLinkExterno(this)"></textarea>
                            <p class="contaCaracteresLinkExterno">2500 caracteres restantes</p>
                        </div>
                    </div>

                    <div class="divUploadPng">
                        <label class="labelUploadDownloadAdicionarRecurso">Adicionar capa do card</label>
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
                        <img id="preview" src="/lib/apps/recursos/arquivos/capaPreview.png" alt="Preview da capa" style="width: 19.9rem; min-width: 19.9rem; height: 12rem; object-fit: contain;"/>
                    </div>
                    <div class="divBotoesAdicionarRecursos">
                        <button class="btn btnLimpar" style="/*margin: 28rem 1rem 28rem -13rem;*/ background-color: rgb(56, 83, 255, 1); color: white; width: 5rem; height: 3rem;" tabindex="8">
                            Limpar
                        </button>
                        <button class="btn btn-success btnEnviarRecurso" style="width: 5rem; height: 3rem;" attr-tipoArquivoBtnEnviar="arquivo" tabindex=7>
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
                
                $(".labelUploadDownloadAdicionarRecurso").on("click", function(){
                    var tipoArquivo = $(this).attr("attr-botaoTipoArquivo");
                    if(tipoArquivo == "arquivo"){
                        $(".divConteudoLinkExterno").css("display", "none");
                        $(".divConteudoUploadPdfAdicionarRecurso").css("display", "flex");
                        $(this).css("font-weight", "bold");
                        $("label[attr-botaoTipoArquivo=\'linkExterno\']").css("font-weight", "normal");
                        $("#textAreaDescricaoAdicionarRecursoLink").val("");
                        $(".btnEnviarRecurso").attr("attr-tipoArquivoBtnEnviar","arquivo");
                    }
                    if(tipoArquivo == "linkExterno"){
                        $(".divConteudoUploadPdfAdicionarRecurso").css("display", "none");
                        $(".divConteudoLinkExterno").css("display", "flex");
                        $(this).css("font-weight", "bold");
                        $("label[attr-botaoTipoArquivo=\'arquivo\']").css("font-weight", "normal");
                        $("#uploadPdf").val("");
                        $(".textoArquivoPdf").text("Máximo: 100MB");
                        $("#checkPdf").css("display","none");
                        $(".btnEnviarRecurso").attr("attr-tipoArquivoBtnEnviar", "linkExterno");
                    }
                });
                
                $(".btnLimpar").on("click", function(){
                    $("#textAreaTituloAdicionaRecurso").val("");
                    $("#textAreaDescricaoAdicionaRecurso").val("");
                    $("#textAreaDescricaoAdicionarRecursoLink").val("");
                    $("#temaSelecionadoSelect").val("0");
                    $("#periodoEstudoPesquisa").val("");
                    $("#uploadPdf").val("");
                    $("#uploadPng").val("");
                    $(".textoArquivoPdf").text("Máximo: 100MB");
                    $(".textoArquivoPng").text("Melhor formato 16x10");
                    $("#checkPdf").css("display","none");
                    $("#checkPng").css("display","none");
                    // $("#preview").css("display","none");
                    $("#preview").attr("src","/lib/apps/recursos/arquivos/capaPreview.png");
                    $(".contaCaracteresTitulo").text("50 caracteres restantes");
                    $(".contaCaracteresDescricao").text("120 caracteres restantes");
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

                // Conta caracteres faltantes do link externo
                function contaCaracteresLinkExterno(val) {
                    var len = val.value.length;
                    if (len > 2500) {
                        val.value = val.value.substring(-1, 2500);
                    } else {
                        $(".contaCaracteresLinkExterno").text(2500 - len+" caracteres restantes");
                    }
                };

                $(".btnEnviarRecurso").click(function () {
                    var caminhoupload = "https://cad.bb.com.br/lib/apps/recursos/class/adicionarRecurso.php";
                    var formData = new FormData();
                    var tipoArquivoEnvio = $(this).attr("attr-tipoArquivoBtnEnviar");
                    
                    var mensagemErro = "Necessário: <br><br>";
                    var contaErros = 0;

                    formData.append("titulo", ($("#textAreaTituloAdicionaRecurso").val().replace(/[\\\']/g, \'"\')));
                    formData.append("descricao", ($("#textAreaDescricaoAdicionaRecurso").val().replace(/[\\\']/g, \'"\')));
                    formData.append("idTema", $("#temaSelecionadoSelect").val());
                    
                    if(tipoArquivoEnvio == "arquivo"){
                        formData.append("pdf", $("#uploadPdf")[0].files[0]);
                        
                        if($("#uploadPdf")[0].files.length == 0){
                            mensagemErro = mensagemErro+"-Anexar arquivo ou link externo do Recurso;<br>";
                            contaErros = ++contaErros;
                        }
                    }
                    
                    if(tipoArquivoEnvio == "linkExterno"){
                        formData.append("pdf", ($("#textAreaDescricaoAdicionarRecursoLink").val()));
                        
                        if(($("#textAreaDescricaoAdicionarRecursoLink").val()).length == 0){
                            mensagemErro = mensagemErro+"-Anexar arquivo ou link externo do Recurso;<br>";
                            contaErros = ++contaErros;
                        }
                    }
                    
                    formData.append("png", $("#uploadPng")[0].files[0]);
                    formData.append("tipoArquivo", tipoArquivoEnvio);


                    if(($("#textAreaTituloAdicionaRecurso").val()).length == 0){
                        mensagemErro = mensagemErro+"-Preencher Título;<br>";
                        contaErros = ++contaErros;
                    }

                    if(($("#textAreaDescricaoAdicionaRecurso").val()).length == 0){
                        mensagemErro = mensagemErro+"-Preencher Descrição;<br>";
                        contaErros = ++contaErros;
                    }
                    
                    if(($("#temaSelecionadoSelect").val()) == 0){
                        mensagemErro = mensagemErro+"-Selecionar Tema;<br>";
                        contaErros = ++contaErros;
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
                                    $(".botaoLimpaPesquisa").click();
                                } else {
                                    // Se não conseguir inserir, exibe a mensagem de erro
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
                                    message: "<div><p>"+retorno.mensagem+"<br><br> Erro: L925 - class_recursos.php</p></div>",
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


    public function gravaEdicaoRecurso($idRecurso){
        $mat = $_SESSION['matricula'];
        $db = New Database("recursos");
        $query = "SELECT * FROM recursos.recursos a
                    LEFT JOIN recursos.recursosTemas b ON a.id = b.idRecurso
                    LEFT JOIN recursos.temas c ON b.idTema = c.id
                    WHERE a.id = ".$idRecurso.";";
        $retorno = array();
        
        try {
            $execQuery = $db->DbGetAll($query);
        
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query ."\n\$queryTags:" . $queryTags;
            $arquivoLog = $this->geraLogExcecao("recursos", "gravaEdicaoRecurso", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível gravar a edição de Recurso. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {

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