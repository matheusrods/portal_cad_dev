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

        $db = New Database('noticias');
        $query = "SELECT distinct(b.id), b.tema FROM noticias.noticias_temas a
        LEFT JOIN noticias.temas b ON a.idTema = b.id
        WHERE b.ativo = 1 ORDER BY b.tema;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $montaBotoesTemas = '<div class="divisaoTemas">';
                $qtdTemas = sizeof($execQuery);
                $qtdTemasLinha = ceil($qtdTemas/2);

                for($i = 0; $i < sizeof($execQuery); $i++){
                    if($i == ($qtdTemasLinha)){
                        $montaBotoesTemas = $montaBotoesTemas.'
                            </div> <div class="divisaoTemas"><div id="temaNoticias'.$execQuery[$i]['id'].'" class="botoesFiltroTema Clicar" attr-id='.$execQuery[$i]['id'].' attr-filtroAtivo="0" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #E4ECFF; border-radius: 100px; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                                <div style="color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">'.$execQuery[$i]['tema'].'</div>
                            </div>';
                    } else {
                        $montaBotoesTemas = $montaBotoesTemas.'
                            <div id="temaNoticias'.$execQuery[$i]['id'].'" class="botoesFiltroTema Clicar" attr-id='.$execQuery[$i]['id'].' attr-filtroAtivo="0" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #E4ECFF; border-radius: 100px; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                                <div style="color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">'.$execQuery[$i]['tema'].'</div>
                            </div>';
                    }
                }
                
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaBotoesTemas.'</div>';
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("noticias", "consultaTemas", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar os temas das Notícias. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    public function consultaNoticias($idTema = null){
        $mat = $_SESSION['matricula'];

        if($idTema > 0){
            $filtroIdTema = "AND c.id in (".$idTema.")";
        }

        $db = New Database('noticias');
        $query = "SELECT a.*, c.tema, date_format(a.dataPublicacao, '%d/%m/%Y') as dtPublicacaoEdit
                    FROM noticias.noticias a
                    LEFT JOIN noticias.noticias_temas b ON a.id = b.idNoticia
                    LEFT JOIN noticias.temas c ON b.idTema = c.id
                    WHERE a.ativo = 1 ".$filtroIdTema." ORDER BY dataPublicacao DESC;";

        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery > 0){
                $montaNoticias = '';
                
                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){
                    $abreDivNestNoticia = '';
                    $fechaDivNestNoticia = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestNoticia = '<div class="abreDivNestNoticia" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestNoticia = '</div>';
                    }

                    $montaNoticias = $montaNoticias.$abreDivNestNoticia.'
                        <div class="divNoticia">
                            <a href="'.$execQuery[$j]['url'].'" target="_blank" style="text-decoration: none;">
                                <div class="fotoCapaNoticia" style="background-image: url(https://cad.bb.com.br/lib/apps/noticias/img/'.$execQuery[$j]['id'].'.png);">
                                    <div class="tagNoticia">
                                        <div class="textoTagNoticia">'.$execQuery[$j]['tema'].'</div>
                                    </div>
                                </div>
                            </a>
                            <div class="textoNoticia" style="align-self: stretch; height: 196px; padding: 32px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                                <div class="subtituloNoticia">
                                    Publicada em '.$execQuery[$j]['dtPublicacaoEdit'].'
                                </div>
                                <div class="tituloSubtituloNoticia">
                                    <div class="tituloNoticia">'.$execQuery[$j]['titulo'].'</div>
                                    <div class="subtituloNoticia">'.$execQuery[$j]['subtitulo'].'</div>
                                </div>
                                <a href="'.$execQuery[$j]['url'].'" target="_blank" style="text-decoration: none; margin-top: 2rem;">
                                    <div class="abrirNoticia" attr-idNoticia="'.$execQuery[$j]['id'].'">
                                        <div style="text-align: center; color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">Ver notícia</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    '.$fechaDivNestNoticia;
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaNoticias;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar as notícias nesse momento. Informe à equipe responsável. L85 - class_noticias.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("noticias", "consultaNoticias", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar as Notícias. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    public function filtraNoticiasTema($idTema){
        $mat = $_SESSION['matricula'];

        $db = New Database('noticias');
        $query = "SELECT 
                    a.*, 
                    c.id AS 'idTema',
                    c.tema 
                FROM noticias.noticias a
                LEFT JOIN noticias.noticias_temas b ON a.id = b.idNoticia
                LEFT JOIN noticias.temas c ON b.idTema = c.id
                WHERE a.ativo = 1 AND c.id in (".$idTema.") ORDER BY dataPublicacao DESC;";
                
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery > 0){
                $montaNoticiasFiltradas = '';

                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){

                    $abreDivNestNoticia = '';
                    $fechaDivNestNoticia = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestNoticia = '<div class="abreDivNestNoticia" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestNoticia = '</div>';
                    }

                    $montaNoticiasFiltradas = $montaNoticiasFiltradas.$abreDivNestNoticia.'
                        <div class="divNoticia">
                            <div style="align-self: stretch; height: 272.27px; padding-top: 16px; padding-bottom: 8px; padding-left: 73px; padding-right: 16px; background-image: url(https://cad.bb.com.br/lib/apps/noticias/img/'.$execQuery[$j]['id'].'.png); flex-direction: column; justify-content: flex-start; align-items: flex-end; display: flex; background-size: cover;">
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
                                <div class="abrirNoticia" attr-idNoticia="'.$execQuery[$j]['id'].'" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #FDF429; border-radius: 4px; justify-content: center; align-items: center; gap: 10px; display: inline-flex">
                                    <div style="text-align: center; color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">BUTTON LABEL</div>
                                </div>
                            </div>
                        </div>
                    ';
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaNoticiasFiltradas;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível filtrar as notícias nesse momento. Informe à equipe responsável. L141 - class_noticias.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("noticias", "filtraNoticiasTema", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p  style='font-size: 16px; font-weight: bold;'>Não foi possível filtrar a página de Notícias. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    // Função que busca no banco de dados as palavras digitadas no campo de pesquisa de notícias
    public function pesquisaNoticias($textoDigitado){
        $mat = $_SESSION['matricula'];

        $db = New Database('noticias');
        $query = "SELECT 
                    a.*, 
                    c.id AS 'idTema',
                    c.tema,
                    date_format(a.dataPublicacao, '%d/%m/%Y') as dtPublicacaoEdit
                FROM noticias.noticias a
                LEFT JOIN noticias.noticias_temas b ON a.id = b.idNoticia
                LEFT JOIN noticias.temas c ON b.idTema = c.id
                WHERE a.ativo = 1 AND (
                    a.titulo like ('%".$textoDigitado."%') OR 
                    subtitulo like ('%".$textoDigitado."%') OR 
                    conteudoNoticia like ('%".$textoDigitado."%')
                )
                ORDER BY dataPublicacao DESC;";

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
                $montaNoticias = '';
                
                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){
                    $abreDivNestNoticia = '';
                    $fechaDivNestNoticia = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestNoticia = '<div class="abreDivNestNoticia" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestNoticia = '</div>';
                    }

                    $montaNoticias = $montaNoticias.$abreDivNestNoticia.'
                        <div class="divNoticia">
                            <a href="'.$execQuery[$j]['url'].'" target="_blank" style="text-decoration: none;">
                                <div class="fotoCapaNoticia" style="background-image: url(https://cad.bb.com.br/lib/apps/noticias/img/'.$execQuery[$j]['id'].'.png);">
                                    <div class="tagNoticia">
                                        <div class="textoTagNoticia">'.$execQuery[$j]['tema'].'</div>
                                    </div>
                                </div>
                            </a>
                            <div class="textoNoticia" style="align-self: stretch; height: 196px; padding: 32px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                                <div class="subtituloNoticia">
                                    Publicada em '.$execQuery[$j]['dtPublicacaoEdit'].'
                                </div>
                                <div class="tituloSubtituloNoticia">
                                    <div class="tituloNoticia">'.$execQuery[$j]['titulo'].'</div>
                                    <div class="subtituloNoticia">'.$execQuery[$j]['subtitulo'].'</div>
                                </div>
                                <a href="'.$execQuery[$j]['url'].'" target="_blank" style="text-decoration: none; margin-top: 2rem;">
                                    <div class="abrirNoticia" attr-idNoticia="'.$execQuery[$j]['id'].'">
                                        <div style="text-align: center; color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">Ver notícia</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    '.$fechaDivNestNoticia;
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaNoticias;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível pesquisar as notícias nesse momento. Informe à equipe responsável. L266 - class_noticias.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("noticias", "pesquisaNoticias", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível pesquisar a página de Notícias. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
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