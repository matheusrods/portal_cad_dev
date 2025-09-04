<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

Class funcoes{
    public $mat;

    public function consultaTrends($textoPesquisa = null){
        $mat = $_SESSION['matricula'];
        
        if($textoPesquisa != null){
            $varWhere = "where texto like '%".$textoPesquisa."%'";
        }
               
        $db = new Database('report');

        $query = "SELECT a.*, 
            DATE_FORMAT(a.data, '%d/%m/%Y') AS dataPublicacao,
            SUBSTRING_INDEX(
                REPLACE(
                    REPLACE(
                        REPLACE(a.url, 'https://', ''), 
                        'http://', ''
                    ),
                    'www.', ''
                ),
                '/', 
                1
            ) AS fonte,
            SUBSTRING(a.texto, 1, 120) AS textoMax
        FROM report.noticias AS a
        ".$varWhere." ORDER BY a.data DESC;";
        
        try{
            $execQuery = $db->DbGetAll($query);

            if(sizeof($execQuery) <= 0){
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = "<h1 style = 'font-family: BancoDoBrasil Titulos'>Nenhum resultado encontrado.</h1>
                                        <p style='text-align: center; font-size: 20px; font-family: BancoDoBrasil Textos'>Sua pesquisa por '$textoPesquisa' não encontrou nenhum resultado.<br>Tente novamente com outro termo.</p>";
                return ($retorno);
            }
           
            if($execQuery > 0) {
                $montaQuery = '';
                $seqQuery = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){
                    $abreDivTrends = '';
                    $fechaDivTrends = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    if((fmod($j, 5) == 0)){
                        $seqQuery++;
                        $abreDivTrends = '<div class="abreDivTrends" attr-sequencia="'.$seqQuery.'" '.$stylePrimeiraDiv.'>';                    
                    }
                    if((fmod($j, 5) == 4) || $j == (sizeof($execQuery)-1)){
                        $fechaDivTrends = '</div>';
                    }
                    
                    $textoCortado = '';
                    $palavras = explode(' ', $execQuery[$j]['textoMax']);
                    
                    // Limita os titulos das trends que são muito grandes
                    if (count($palavras) <= 17) {
                        $textoCortado = $execQuery[$j]['textoMax'];
                    } else {
                        $textoCortado = implode(' ', array_slice($palavras, 0, 17)).'...';
                    }                    
                    
                    $montaQuery = $montaQuery.$abreDivTrends.'
                        <div class="divTrends">
                            <div class="textoNoticiaTrends">
                                <div class="dataNoticia">Publicado em '.$execQuery[$j]['dataPublicacao'].'</div>
                                <div class="textoTituloTrends" style="align-self": stretch; height: 196px; padding: 32px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">'.$textoCortado.'</div>
                                <!-- <div class="textoTituloTrends" style="align-self": stretch; height: 196px; padding: 32px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">'.$execQuery[$j]['textoMax'].'</div> -->                                                           
                                                           
                            </div>
                            <div class="fonteTrends">Fonte: '.$execQuery[$j]['fonte'].'<br>
                                <a href="'.$execQuery[$j]['url'].'" target="_blank" style="text-decoration: none; margin-right: 8rem;">                                                                                 
                                    <div class="abrirTrends" attr-idnoticia="'.$execQuery[$j]['id'].'">
                                        <i class="fa fa-external-link" aria-hidden="true"></i>
                                        <div style="text-align: center; color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">Ver Notícia</div>                                    
                                    </div>  
                                </a>
                            </div>                                              
                        </div>'
                    .$fechaDivTrends;

                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaQuery; // Colocar aqui o conteúdo da variável que vc gererá no for(), que corresponderá a todas as notícas no trends
            }else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "<h1 style = 'font-family: BancoDoBrasil Titulos'>Nenhum resultado encontrado.</h1>
                                        <p style='text-align: center; font-size: 20px; font-family: BancoDoBrasil Textos'>Sua pesquisa por '$textoPesquisa' não encontrou nenhum resultado.<br>Tente novamente com outro termo.</p>";
            }
            
        }catch(Exception $e){
                $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
                $arquivoLog = $this->geraLogExcecao("noticias", "consultaNoticias", $informacoesErro, $mat);
                $retorno["status"] = 0;
                $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar as Notícias. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }   
                   
}
