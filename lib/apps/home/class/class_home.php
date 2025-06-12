<?php

ini_set('display_startup_errors', 1);
session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

$mat = $_SESSION['matricula'];

Class funcoes {
    
    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
        global $mat;
        $mat = $_SESSION['matricula'];
        $caminhoLogErro = $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
    }

    public function carregaAvisoEcoa(){
        $mat = $_SESSION['matricula'];
        $db = new Database('home');

        $query = " SELECT * , date_format(data, '%d/%m/%Y') as dataFormatada FROM home.avisoEcoa ; "
        ;

        try{
            $execQuery = $db->DbGetAll($query);

            if ($execQuery > 0){
                

                for( $i=0; $i<sizeof($execQuery); $i++) {
                    $montaDivAviso =  $montaDivAviso.'
                    <div class="divAviso">
                        <div class="divIntervaAviso">
                            <div class="divCentralizaEcoa">
                                <img src="/lib/img/apps/home/iconeMegafone.png" style=" padding-bottom: 2%;">
                            </div>
                            <p class="dataAvisoEcoa">'.$execQuery[$i]['dataFormatada'].'</p>
                            <p class="nomeAviso">'.$execQuery[$i]['tituloAviso'].'</p>
                            <div class="divCentralizaEcoa">
                                <div class="btnVerMaisEcoa clicar" attr-idAvisoEcoa = "'.$execQuery[$i]['idAvisoEcoa'].'">
                                    Ver mais
                                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                                        <path d="M1.52227 0.5L0 2.0275L4.94467 7L0 11.9725L1.52227 13.5L8 7L1.52227 0.5Z" fill="white"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>';

                         ;
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaDivAviso;

            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar os avisos nesse momento. Informe à equipe responsável. L63 - class_home.php";

            }

        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("home", "carregaAviso", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar os avisos. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";

            
        } finally {
            return ($retorno);
        }
    }
    
    public function carregaReportDestaque(){
        $mat = $_SESSION['matricula'];
        $db = new Database('report');

        $query = "SELECT * FROM destaques order by timestampInsert desc limit 1;";

        try{
            $execQuery = $db->DbGetAll($query);

            if ($execQuery > 0){
                for($i=0; $i<sizeof($execQuery); $i++){
                    
                    $urlDestaque = $execQuery[$i]['url'];
                    if($urlDestaque != NULL){
                        $linkAcessoDestaque =  '<a href="'.$urlDestaque.'" class="linkReport"> Leia Mais</a>';
                    } else {
                        $linkAcessoDestaque = "";
                    }

                    $montaDivDestaque = $montaDivDestaque.'
                    <div class="divTxtItemReport">
                            '.$execQuery[$i]['texto'].'
                            <br>
                            <br>
                            '.$linkAcessoDestaque.'
                    </div>';
                
                }

                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaDivDestaque;   

            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar os destaques nesse momento. Informe à equipe responsável. L107 - class_home.php";
            }

        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("home", "carregaAviso", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar os destaques. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";

        }finally {
            return ($retorno);
        }


    }


    public function carregaReportTrending(){
        $mat = $_SESSION['matricula'];
        $db = new Database('report');

        $query = "SELECT * FROM noticias order by timestampInsert desc limit 3;";

        try{
            $execQuery = $db->DbGetAll($query);

            if ($execQuery > 0){
                for($i=0; $i<sizeof($execQuery); $i++){
                    
                $montaDivTrending = $montaDivTrending.'
                    <div class="divTxtItemReport">
                            '.$execQuery[$i]['texto'].'
                    </div>
                    <a href="'.$execQuery[$i]['url'].'" class="linkReport" target="_blank"> Leia Mais</a>
                    <br><br>';

                
                }

                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaDivTrending;   

            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar as trending nesse momento. Informe à equipe responsável. L159 - class_home.php";
            }

        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("home", "carregaAviso", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar os destaques. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";

        }finally {
            return ($retorno);
        }


    }




    public function carregaReportIndisponibilidades(){
        $mat = $_SESSION['matricula'];
        $db = new Database('incidentes');

        $query = "SELECT COUNT(*) as registros FROM incidente where status='EM ANDAMENTO' and ambiente = 2 ;";
        // erro forçado: $query = "SELECT COUNT(*) as registros FROM incidente1 where status='EM ANDAMENTO' and ambiente = 8 ;";

        try{
            $execQuery = $db->DbGetAll($query);
            
            
            if (is_array($execQuery)){
                $valorQtdeIncidentes = $execQuery[0]['registros'];
        
                
                if ($valorQtdeIncidentes > 1){
                    

                    $montaDivIndisponibilidades = '<div class="divTxtItemReport">
                                                      Há '.$execQuery[0]['registros'].'  incidentes em andamento no ambiente de produção
                                                      <br><br>
                                                      <a href="https://pwbi.intranet.bb.com.br/reports/powerbi/PAINEL%20DE%20METRICAS/CAD/Painel%20Incidentes" class="linkReport" target="_blank"> Consultar os incidentes</a>
                                                   </div>';
                    
                    $retorno = array();
                    $retorno["status"] = 1;
                    $retorno["mensagem"] = $montaDivIndisponibilidades;
    
    
                } elseif ($valorQtdeIncidentes == 1){
                    $montaDivIndisponibilidades = '<div class="divTxtItemReport">
                                                       Há 1 incidente em andamento no ambiente de produção
                                                    </div>';
                    $retorno = array();
                    $retorno["status"] = 1;
                    $retorno["mensagem"] = $montaDivIndisponibilidades;

                } else{

                    $montaDivIndisponibilidades = '<div class="divTxtItemReport">
                                                       Não temos incidentes no momento :)
                                                    </div>';
                    $retorno = array();
                    $retorno["status"] = 1;
                    $retorno["mensagem"] = $montaDivIndisponibilidades;
                }


            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar as indisponibilidades nesse momento. Informe à equipe responsável. L217 - class_home.php";
            }
            

        } catch(Exception $e){
            
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("home", "carregaAviso", $informacoesErro, $mat);
            $retorno["status"] = 0;
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar os destaques. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        }finally {
           
            return ($retorno);

        }


    }

    public function carregaPesquisas(){
        $mat = $_SESSION['matricula'];
        $db = new Database('estudosPesquisas');
                    
                    
        $query = "SELECT * FROM estudosPesquisas.estudosPesquisas a
                    LEFT JOIN estudosPesquisas.temas b ON a.tema = b.id
                    WHERE a.tipo = 'pesquisas'
                    AND a.ativo = 1 
                    ORDER BY dtEstudoPesquisa DESC, idEstudo DESC limit 3 ;";

        // echo "okas"                    ;
        // die;

        try{

            $execQuery = $db->DbGetAll($query);

            if ($query > 0){

                for ($i = 0; $i < sizeof($execQuery) ; $i++){
                    
                    $idPesquisa = $execQuery[$i]['idEstudo'];

                    $montaPesquisas = $montaPesquisas.'
                                    <div class="hmolduraPesquisa">
                                        <a href="https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idPesquisa.'.pdf" target="_blank" style="text-decoration: none;">
                                            <div class="hdivPesquisa">
                                                <div class="hcapaPesquisa" style="background-image: url(https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idPesquisa.'.png);">           
                                                </div>
                                                <div class="hAreaTxtPesquisa">
                                                    <div class="textoTag">'.$execQuery[$i]['temas'].'</div>
                                                    <div class="htituloPesquisa">'.$execQuery[$i]['titulo'].'</div>
                                                    <div class="hsubtituloPesquisa">'.$execQuery[$i]['subtitulo'].'</div>
                                                </div>
                                            </div>
                                        </a>    
                                    </div>    ';
                }
                
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = $montaPesquisas;
                
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar as Pesquisas nesse momento. Informe à equipe responsável. L289 - class_home.php";
            }

        } catch(Exception $e){
            $retorno = array();
            $informacoesErro = "erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("home", "carregaPesquisas", $informacoesErro, $mat);
            $retorno["status"] = 0;
            $retorno["mensagem"] = "<p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar as Pesquisas. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {

            return ($retorno);

        }

    }
}