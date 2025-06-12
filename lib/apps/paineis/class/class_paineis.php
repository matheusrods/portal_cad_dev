<?php

//ini_set('display_startup_errors', 1);
session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

Class funcoes {

    public $mat;
    public $caminhoLogErro;

    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
        $mat = $_SESSION['matricula'];
        $caminhoLogErro = $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
    }
 
               
//Funções referentes à area dos painéis

    public function consultaTags(){
        $mat = $_SESSION['matricula'];

        $db = New Database('paineis');
        // $query = "SELECT distinct(b.idTag), b.nomeTag FROM paineis.paineis_tags a
        // LEFT JOIN paineis.tags b ON a.idTag = b.idTag
        // WHERE b.ativo = 1 ORDER BY b.nomeTag;";

        # Query alterada por Albert para aparecer apenas tags que possuam relatórios vinculados - 03/12/2024
        $query = "SELECT distinct(b.idTag), b.nomeTag FROM paineis.paineis_tags a
        LEFT JOIN paineis.tags b ON a.idTag = b.idTag
        LEFT JOIN paineis.paineis c ON a.idPainel = c.idPainel
        WHERE b.ativo = 1 and c.ativo = 1 ORDER BY b.nomeTag;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $montaBotoesTags = '<div class="divisaoTags">';
                $qtdTags = sizeof($execQuery);
                $qtdTagsLinha = ceil($qtdTags/2);

                for($i = 0; $i < sizeof($execQuery); $i++){
                    if($i == ($qtdTagsLinha)){
                        $montaBotoesTags = $montaBotoesTags.'
                            </div> <div class="divisaoTags"><div id="tagPaineis'.$execQuery[$i]['idTag'].'" class="divbotoesFiltroTag Clicar" attr-id='.$execQuery[$i]['idTag'].' attr-filtroAtivo="0" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #E4ECFF; border-radius: 100px; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                                <div style="color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">'.$execQuery[$i]['nomeTag'].'</div>
                            </div>';
                    } else {
                        $montaBotoesTags = $montaBotoesTags.'
                            <div id="tagPaineis'.$execQuery[$i]['idTag'].'" class="divbotoesFiltroTag Clicar" attr-id='.$execQuery[$i]['idTag'].' attr-filtroAtivo="0" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #E4ECFF; border-radius: 100px; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                                <div style="color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">'.$execQuery[$i]['nomeTag'].'</div>
                            </div>';
                    }
                }
                
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaBotoesTags.'</div>';
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("paineis", "consultaTags", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar as tags dos Painéis. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    public function consultaPaineis($idTag = null){
        $mat = $_SESSION['matricula'];

        if($idTag > 0){
            $filtroIdTag = "AND c.idTag in (".$idTag.")";
        }

        $db = New Database('paineis');
        $query = "SELECT a.*, group_concat(c.nomeTag)as nomeTag
                    FROM paineis.paineis a
                    LEFT JOIN paineis.paineis_tags b ON a.idPainel = b.idPainel
                    LEFT JOIN paineis.tags c ON b.idTag = c.idTag
                    WHERE a.ativo = 1 ".$filtroIdTag." 
                    group by idPainel
                    ORDER BY idPainel ASC;";
        
                 

        try{
            $execQuery = $db->DbGetAll($query);
            
            
            if($execQuery > 0){
                $montaPaineis = '';
                
                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){

                    $query2 = "SELECT a.idPainel, b.idTag, c.nomeTag
                    FROM paineis.paineis a
                     LEFT JOIN paineis.paineis_tags b ON a.idPainel = b.idPainel
                     LEFT JOIN paineis.tags c ON b.idTag = c.idTag
                     WHERE a.ativo = 1 AND a.idPainel = ".$execQuery[$j]['idPainel']." ;" ;


                    $abreDivNestPainel = '';
                    $fechaDivNestPainel = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestPainel = '<div class="abreDivNestPainel" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                        
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestPainel = '</div>';
                    }

                    $execQuery2 = $db->DbGetAll($query2);
                    $montaTags = "";
                    
                    for($i = 0; $i<  sizeof($execQuery2); $i++){
                        $montaTags = $montaTags.'<div class="tagPainel"><div class="textoTagPainel">'.$execQuery2[$i]['nomeTag'].'</div></div>';
                    }

                    $montaPaineis = $montaPaineis.$abreDivNestPainel.'
                        <div class="divPainel">
                            <a href="'.$execQuery[$j]['link'].'" target="_blank" style="text-decoration: none;">
                                <div class="fotoCapaPainel" style="background-image: url(https://cad.bb.com.br/lib/apps/paineis/img/'.$execQuery[$j]['idPainel'].'.png); background-position: bottom;">
                                   '.$montaTags.' 
                                </div>
                            </a>
                            <div class="textoPainel" style="align-self: stretch; height: 196px; padding: 32px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                                <div class="tituloDescricaoPainel">
                                    <div class="tituloPainel">'.$execQuery[$j]['titulo'].'</div>
                                    <div class="descricaoPainel">'.$execQuery[$j]['descricao'].'</div>
                                </div>
                            </div>    
                                <a href="'.$execQuery[$j]['link'].'" target="_blank" style="text-decoration: none; margin-top: 2.5rem;">
                                    <div class="abrirPainel" attr-idPainel="'.$execQuery[$j]['idPainel'].'">
                                        <div style="text-align: center; color: #ffffff; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">Ver painel</div>
                                    </div>
                                </a>
                            
                        </div>
                    '.$fechaDivNestPainel;
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaPaineis;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar os painéis nesse momento. Informe à equipe responsável. L132 - class_paineis.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("paineis", "consultaPaineis", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar os painéis. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }


    public function filtraPaineisTag($idTag){
        $mat = $_SESSION['matricula'];

        $db = New Database('paineis');
        $query = "SELECT 
                    a.*, 
                    c.idTag AS 'idTag',
                    c.nomeTag 
                FROM paineis.paineis a
                LEFT JOIN paineis.paineis_tags b ON a.idPainel = b.idPainel
                LEFT JOIN paineis.tags c ON b.idTag = c.idTag
                WHERE a.ativo = 1 AND c.idTag in (".$idTag.") ORDER BY idPainel ASC;";
                
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery > 0){
                $montaPaineisFiltrados = '';

                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){

                    $query2 = "SELECT a.idPainel, b.idTag, c.nomeTag
                    FROM paineis.paineis a
                     LEFT JOIN paineis.paineis_tags b ON a.idPainel = b.idPainel
                     LEFT JOIN paineis.tags c ON b.idTag = c.idTag
                     WHERE a.ativo = 1 AND a.idPainel = ".$execQuery[$j]['idPainel']." ;" ;

                    $abreDivNestPainel = '';
                    $fechaDivNestPainel = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestPainel = '<div class="abreDivNestPainel" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestPainel = '</div>';
                    }

                    $execQuery2 = $db->DbGetAll($query2);
                    $montaTags = "";

                      
                    for($i = 0; $i<  sizeof($execQuery2); $i++){
                        $montaTags = $montaTags.'<div class="tagPainel"><div class="textoTagPainel">'.$execQuery2[$i]['nomeTag'].'</div></div>';
                    }

                    $montaPaineisFiltrados = $montaPaineisFiltrados.$abreDivNestPainel.'
                        <div class="divPainel">
                            <div style="align-self: stretch; height: 272.27px; padding-top: 16px; padding-bottom: 8px; padding-left: 73px; padding-right: 16px; background-image: url(https://cad.bb.com.br/lib/apps/paineis/img/'.$execQuery[$j]['idPainel'].'.png);flex-direction: column; justify-content: flex-start; align-items: flex-end; display: flex; background-size: cover;">
                                <div style="padding-left: 8px; padding-right: 8px; background: #FDF429; border-radius: 999px; flex-direction: column; justify-content: center; align-items: center; display: flex; flex-wrap: wrap;">
                                     '.$montaTags.' 
                                </div>
                                <div></div>
                            </div>
                            <div style="align-self: stretch; height: 196px; padding: 32px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                                <div style="align-self: stretch; height: 84px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">
                                    <div style="align-self: stretch; color: #111214; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">'.$execQuery[$j]['titulo'].'</div>
                                    <div style="align-self: stretch; color: #6C7077; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: 25.60px; word-wrap: break-word">'.$execQuery[$j]['descricao'].'</div>
                                </div>
                                <div class="abrirPainel" attr-idPainel="'.$execQuery[$j]['idPainel'].'" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #FDF429; border-radius: 4px; justify-content: center; align-items: center; gap: 10px; display: inline-flex">
                                    <div style="text-align: center; color: #ffffff; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">BUTTON LABEL</div>
                                </div>
                            </div>
                        </div>
                    ';
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaPaineisFiltrados;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível filtrar os paineis nesse momento. Informe à equipe responsável. L835 - class_paineis.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("paineis", "filtraPaineisTag", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p  style='font-size: 16px; font-weight: bold;'>Não foi possível filtrar a página de Painéis. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }


    // Função que busca no banco de dados as palavras digitadas no campo de pesquisa de paineis
    public function pesquisaPaineis($textoDigitado){
        $mat = $_SESSION['matricula'];

        $db = New Database('paineis');
        $query = "SELECT 
                    a.*, 
                    c.idTag AS 'idTag',
                    group_concat(c.nomeTag) AS nomeTag
                    
                FROM paineis.paineis a
                LEFT JOIN paineis.paineis_tags b ON a.idPainel = b.idPainel
                LEFT JOIN paineis.tags c ON b.idTag = c.idTag
                WHERE a.ativo = 1 AND (
                    a.titulo like ('%".$textoDigitado."%') OR 
                    descricao like ('%".$textoDigitado."%') OR 
                    palavras_chave like ('%".$textoDigitado."%')
                )
                    group by idPainel
                ORDER BY idPainel ASC;";
        try{
            $execQuery = $db->DbGetAll($query);

            if(sizeof($execQuery) == 0){
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = "
                    <h1>Não localizamos painéis com o termo '".$textoDigitado."'.</h1>
                                        ";
                // $retorno["mensagem"] = $execQuery;
                return ($retorno);
            }

            if($execQuery > 0){
                $montaPaineis = '';
                
                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){

                    $query2 = "SELECT a.idPainel, b.idTag, c.nomeTag
                    FROM paineis.paineis a
                     LEFT JOIN paineis.paineis_tags b ON a.idPainel = b.idPainel
                     LEFT JOIN paineis.tags c ON b.idTag = c.idTag
                     WHERE a.ativo = 1 AND a.idPainel = ".$execQuery[$j]['idPainel']." ;" ;

                    $abreDivNestPainel = '';
                    $fechaDivNestPainel = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestPainel = '<div class="abreDivNestPainel" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestPainel = '</div>';
                    }

                    $execQuery2 = $db->DbGetAll($query2);
                    $montaTags = "";
                    
                    for($i = 0; $i<  sizeof($execQuery2); $i++){
                        $montaTags = $montaTags.'<div class="tagPainel"><div class="textoTagPainel">'.$execQuery2[$i]['nomeTag'].'</div></div>';
                    }
                    
                    // aqui que fiz as alterações, Yasmin - 04/11/2024
                    $montaPaineis = $montaPaineis.$abreDivNestPainel.'
                        
                        <div class="divPainel">
                            <a href="'.$execQuery[$j]['link'].'" target="_blank" style="text-decoration: none;" attr-contador="'.$j.'">
                                <div class="fotoCapaPainel" style="background-image:  url(https://cad.bb.com.br/lib/apps/paineis/img/'.$execQuery[$j]['idPainel'].'.png); background-position: bottom;">
                                    '.$montaTags.'
                                </div>
                            </a>
                            <div class="textoPainel" style="align-self: stretch; height: 196px; padding: 32px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex;  line-height: 1.3rem;">
                                <div class="tituloDescricaoPainel">
                                    <div class="tituloPainel" style="align-self: stretch; color: #111214; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px;  word-wrap: break-word;  margin-top: -1rem; margin-bottom: 1.05rem; ">
                                    '.$execQuery[$j]['titulo'].'
                                    </div>
                                    <div class="descricaoPainel">'.$execQuery[$j]['descricao'].'</div>
                                </div>
                            </div>
                            <a href="'.$execQuery[$j]['link'].'" target="_blank" style="text-decoration: none; margin-top: 2rem;">
                                <div class="abrirPainel" style= "padding: 9px 16px 9px 16px; background: #9747FF;  border-radius: 4px; justify-content: center;  align-items: center;  gap: 10px;  display: inline-flex; margin-left: 1.8rem; margin-top: 0.25rem;" attr-idPainel="'.$execQuery[$j]['idPainel'].'">
                                    <div style="text-align: center; color: #ffffff; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">Ver painel</div>
                                </div>
                            </a>
                        </div>
                    '.$fechaDivNestPainel;
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaPaineis;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível pesquisar os painéis nesse momento. Informe à equipe responsável. L299 - class_paineis.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("paineis", "pesquisaPaineis", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível pesquisar a página de painéis. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            return ($retorno);
        }
    }

    // Função que grava eventuais logs de erro de banco de dados em formato texto
    // public function geraLogExcecao($nomeApp, $nomeFuncao, $informacoesAdicionais, $mat){
    //     $dateTime = date("Y-m-d")."_". date("H.i.s");
    //     $nomeArquivo = $dateTime . "_" . $mat . "_" . $nomeApp . "_" . $nomeFuncao .".txt";
    //     $caminhoArquivo = $this->caminhoLogErro . "/" . $nomeArquivo;

    //     $strDataHora = print_r(new DateTime(), true);
    //     $strRequest = print_r($_REQUEST, true);
    //     $strSession = print_r($_SESSION, true);
        
    //     $strArquivo = "data:\n" . $strDataHora . "\n\$_REQUEST:\n" . $strRequest . "\n\$_SESSION:\n" . $strSession . "\n\$informacoesAdicionais:\n" . $informacoesAdicionais;

    //     file_put_contents($caminhoArquivo, $strArquivo);
    //     chmod($caminhoArquivo, 0777);

    //     return $caminhoArquivo;
    // }
}