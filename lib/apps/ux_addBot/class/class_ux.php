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

    // Função que consulta os vídeos de UX que estão cadastrados e ativos na tabela ux.videos do MySQL do Portal
    public function consultaVideosUx($idAssunto = null){
        $mat = $_SESSION['matricula'];

        $filtroIdAssunto = "";
        if($idAssunto > 0){
            $filtroIdAssunto = "WHERE a.idCategoria in (".$idAssunto.")";
        }

        $db = New Database('ux');
        $query = "SELECT a.*, b.tagTema, b.codigoCor FROM ux.videos a LEFT JOIN ux.temaUx b ON a.idCategoria = b.id ".$filtroIdAssunto." ORDER BY RAND();";
        
        try {
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery > 0){
                $montaVideos = '';
                
                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){
                    $abreDivNestVideo = '';
                    $fechaDivNestVideo = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestVideo = '<div class="abreDivNestVideoUx" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestVideo = '</div>';
                    }

                    $montaVideos = $montaVideos.$abreDivNestVideo.'
                        <div class="divVideoUx">
                            <a href="'.$execQuery[$j]['url'].'" target="_blank" style="text-decoration: none;">
                                <div class="fotoCapaVideoUx" style="background-image: url(https://cad.bb.com.br/lib/apps/ux/img/'.$execQuery[$j]['id'].'.png);">
                                    <div class="tagVideoUx" style="background: '.$execQuery[$j]['codigoCor'].' !important">
                                        <div class="textoTagAssunto">'.$execQuery[$j]['tagTema'].'</div>
                                    </div>
                                </div>
                            </a>
                            <div class="divTituloVideoUx">
                                <div class="tituloSubtituloVideoUx">
                                    <div class="tituloVideoUx">'.$execQuery[$j]['titulo'].'</div>
                                    <div class="descricaoVideoUx">'.$execQuery[$j]['descricao'].'</div>
                                </div>
                                <!-- <div class="botaoAbrirVideoUx" style="margin-top: -1rem; margin-right: 1rem;"> -->
                                    <a href="'.$execQuery[$j]['url'].'" target="_blank" style="bottom: 0; height: 1rem; position: absolute;">
                                        <div class="abrirVideoUx" attr-idVideoUx="'.$execQuery[$j]['id'].'">
                                            <div style="text-align: center; color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">Ver vídeo</div>
                                        </div>
                                    </a>
                                <!-- </div> -->
                            </div>
                        </div>
                    '.$fechaDivNestVideo;
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaVideos;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar os vídeos de UX nesse momento. Informe à equipe responsável. L115 - class_ux.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("ux", "consultaVideosUx", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar os Vídeos de UX neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    // Função que consulta os assuntos dos vídeos de UX que estão cadastrados e ativos na tabela ux.videos do MySQL do Portal
    public function consultaAssuntosUx(){
        $mat = $_SESSION['matricula'];
        $db = New Database('ux');
        $query = "SELECT DISTINCT(tagTema), id, codigoCor FROM ux.temaUx ORDER BY tagTema ASC;";
                    
        try{
            $execQuery = $db->DbGetAll($query);

            if($execQuery){
                $montaBotoesTemas = '';
                $qtdTemas = sizeof($execQuery);
                
                for($i = 0; $i < sizeof($execQuery); $i++){
                    $montaBotoesTemas = $montaBotoesTemas.'
                        <div id="assuntoUx'.$execQuery[$i]['id'].'" class="botoesFiltroAssuntoUx Clicar" attr-id="'.$execQuery[$i]['id'].'" attr-filtroAtivo="0" attr-corFundo="'.$execQuery[$i]['codigoCor'].'" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #E4ECFF; border-radius: 100px; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                            <div class="textoBotaoAssuntoUx textoBotaoUx'.$execQuery[$i]['id'].'">'.$execQuery[$i]['tagTema'].'</div>
                        </div>';
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaBotoesTemas;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("ux", "consultaAssuntosUx", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar os Assuntos dos vídeos de UX. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    // Função que busca no banco de dados as palavras digitadas no campo de pesquisa de vídeos de UX
    public function pesquisaVideosUx($textoDigitado){
        $mat = $_SESSION['matricula'];
        $db = New Database('ux');
        $query = "  SELECT 
                        a.*, 
                        b.tagTema
                    FROM ux.videos a
                    LEFT JOIN ux.temaUx b ON a.idCategoria = b.id
                    WHERE titulo LIKE ('%".$textoDigitado."%') OR descricao LIKE ('%".$textoDigitado."%')
                    ORDER BY RAND();
        ";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if(sizeof($execQuery) == 0){
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = "<h1 style='color: white;'>Não localizamos nos títulos e descrições dos vídeos o termo '".$textoDigitado."'.</h1>";
                // $retorno["mensagem"] = $execQuery;
                return ($retorno);
            }

            if($execQuery > 0){
                $montaVideos = '';
                
                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){
                    $abreDivNestVideo = '';
                    $fechaDivNestVideo = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestVideo = '<div class="abreDivNestVideoUx" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestVideo = '</div>';
                    }

                    $montaVideos = $montaVideos.$abreDivNestVideo.'
                        <div class="divVideoUx">
                            <a href="'.$execQuery[$j]['url'].'" target="_blank" style="text-decoration: none;">
                                <div class="fotoCapaVideoUx" style="background-image: url(https://cad.bb.com.br/lib/apps/ux/img/'.$execQuery[$j]['id'].'.png);">
                                    <div class="tagVideoUx">
                                        <div class="textoTagAssunto">'.$execQuery[$j]['tagTema'].'</div>
                                    </div>
                                </div>
                            </a>
                            <div class="divTituloVideoUx">
                                <div class="tituloSubtituloVideoUx">
                                    <div class="tituloVideoUx">'.$execQuery[$j]['titulo'].'</div>
                                    <div class="descricaoVideoUx">'.$execQuery[$j]['descricao'].'</div>
                                </div>
                                <!-- <div class="botaoAbrirVideoUx" style="margin-top: -1rem; margin-right: 1rem;"> -->
                                    <a href="'.$execQuery[$j]['url'].'" target="_blank" style="bottom: 0; height: 1rem; position: absolute;">
                                        <div class="abrirVideoUx" attr-idVideoUx="'.$execQuery[$j]['id'].'">
                                            <div style="text-align: center; color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">Ver vídeo</div>
                                        </div>
                                    </a>
                                <!-- </div> -->
                            </div>
                        </div>
                    '.$fechaDivNestVideo;
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaVideos;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "<p style='color: white; font-size: 16px;'>Não foi possível consultar os vídeos nesse momento. Informe à equipe responsável. L263 - class_ux.php. Query: ".$query."</p>";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("ux", "pesquisaVideosUx", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível pesquisar os Vídeos de UX neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
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