<?php

// ini_set('display_startup_errors', 1);
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

        $dataAtual = new DateTime;
        $dataAtual = $dataAtual->format('Y-m-d');
        
        
        $query = " SELECT * , date_format(data, '%d/%m/%Y') as dataFormatada FROM home.avisoEcoa where data >= '$dataAtual' and ativo = '1'; " ;

        try{
            $execQuery = $db->DbGetAll($query);
            $attrAvisoUnico="";
            

            if ($execQuery > 0){    
                if(sizeof($execQuery)>0){    

                    if(sizeof($execQuery)==1){
                        $attrAvisoUnico = "attr-AvisoUnico = 1";
                    }    
                    for( $i=0; $i<sizeof($execQuery); $i++) {
                        $montaDivAviso =  $montaDivAviso.'
                            <div class="divAviso item" '.$attrAvisoUnico.'>
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
                
                } else{
                    $montaDivAviso =  $montaDivAviso.'
                            <div class="divAviso" data-avisounico ="nao">
                                <div class="divIntervaAviso">
                                    <div class="divCentralizaEcoa">
                                        <img src="/lib/img/apps/home/iconeMegafone.png" style=" padding-bottom: 2%;">
                                    </div>
                                    <p class="nomeAviso">ECOA</p>
                                    <p class="dataAvisoEcoa">Novidades em breve...</p>
                                    <div class="divCentralizaEcoa">
                                    </div>
                                </div>
                            </div>
                            <div class="divAviso" data-avisounico ="nao">
                                <div class="divIntervaAviso">
                                    <div class="divCentralizaEcoa">
                                        <img src="/lib/img/apps/home/iconeMegafone.png" style=" padding-bottom: 2%;">
                                    </div>
                                    <p class="nomeAviso">ECOA</p>
                                    <p class="dataAvisoEcoa">Novidades em breve...</p>
                                    <div class="divCentralizaEcoa">
                                    </div>
                                </div>
                            </div>
                            <div class="divAviso" data-avisounico ="nao">
                                <div class="divIntervaAviso">
                                    <div class="divCentralizaEcoa">
                                        <img src="/lib/img/apps/home/iconeMegafone.png" style=" padding-bottom: 2%;">
                                    </div>
                                    <p class="nomeAviso">ECOA</p>
                                    <p class="dataAvisoEcoa">Novidades em breve...</p>
                                    <div class="divCentralizaEcoa">
                                    </div>
                                </div>
                            </div>
                            <div class="divAviso" data-avisounico ="nao">
                                <div class="divIntervaAviso">
                                    <div class="divCentralizaEcoa">
                                        <img src="/lib/img/apps/home/iconeMegafone.png" style=" padding-bottom: 2%;">
                                    </div>
                                    <p class="nomeAviso">ECOA</p>
                                    <p class="dataAvisoEcoa">Novidades em breve...</p>
                                    <div class="divCentralizaEcoa">
                                    </div>
                                </div>
                            </div>
                            <div class="divAviso" data-avisounico ="nao">
                                <div class="divIntervaAviso">
                                    <div class="divCentralizaEcoa">
                                        <img src="/lib/img/apps/home/iconeMegafone.png" style=" padding-bottom: 2%;">
                                    </div>
                                    <p class="nomeAviso">ECOA</p>
                                    <p class="dataAvisoEcoa">Novidades em breve...</p>
                                    <div class="divCentralizaEcoa">
                                    </div>
                                </div>
                            </div>
                           ';

                    
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

    public function consultaAvisoEcoa($idAviso){
        $mat = $_SESSION['matricula'];
        $db = new Database('home');
        
        
        $query = "SELECT *, date_format(data, '%d/%m/%Y') as dataFormatada FROM home.avisoEcoa WHERE idAvisoEcoa = '$idAviso'";

        try{
            $execQuery = $db->DbGetAll($query);

            if ($execQuery > 0){
                

                for( $i=0; $i<sizeof($execQuery); $i++) {
                    $montaDivAviso =  $montaDivAviso.'
                    <div class="modalConsultaAviso">
                        <div class="divSuperiorConsultaAviso">
                            <span class="spanTituloConsultaAviso">'.$execQuery[$i]['tituloAviso'].'</span>
                            <br>
                            <div class="dataHorarioConsultaAviso">
                                <img src="https://cad.bb.com.br/lib/img/apps/home/calendarioIcone.svg"> <span class="spanTxtDataHorarioAviso">Data:</span> <span class="spanNumDataHorarioAviso">'.$execQuery[$i]['dataFormatada'].'</span>
                                <img src="https://cad.bb.com.br/lib/img/apps/home/relogioIcone.svg" style="margin-left: 1rem;"> <span class="spanTxtDataHorarioAviso">Horário: </span><span class="spanNumDataHorarioAviso">'.$execQuery[$i]['horario'].'</span>
                            </div>
                        </div>
                        <div class="divInferiorConsultaAviso">
                        '.$execQuery[$i]['descricao'].'
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
    
    // public function consultaAvisoEcoa($idAviso){
    //     $mat = $_SESSION['matricula'];
    //     $db = new Database('home');

    //     $query = "SELECT * FROM home.avisoEcoa WHERE idAvisoEcoa = 1";
       
    //     try{
    //         $execQueryAvisoEcoa = $db->DbGetAll($query);

    //         if ($execQueryAvisoEcoa > 0){
                
    //           echo "123";
    //           die;
                
    //             $retorno = array();
    //             $retorno["status"] = 1;
    //             $retorno["mensagem"] = "teste";
            
    //         } else {
    //             $retorno = array();
    //             $retorno["status"] = 0;
    //             $retorno["mensagem"] = "Não foi possível consultar o aviso nesse momento. Informe à equipe responsável. L106 - class_home.php";

    //         }

    //     } catch(Exception $e){
    //         $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
    //         $arquivoLog = $this->geraLogExcecao("home", "consultaAviso", $informacoesErro, $mat);
    //         $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar o aviso. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";

            
    //     }finally {
    //         return ($retorno);
    //     }

    // }

    public function mostraBtnCadastraAvisoEcoa(){
        $mat = $_SESSION['matricula'];
        $db = new Database('ecoa');
        
        
        $query = "SELECT * FROM ecoa.membrosEcoa WHERE matricula = '$mat'";
        $retorno = "";

        try{
            $execQuery = $db->DbGetAll($query);

            if (sizeof($execQuery)>0){
                $retorno =  '<div class="btnAzulContainer Clicar" id="btnAdicionaAviso">
                                         Adicionar Aviso
                                      </div>';
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("home", "mostraBtnCadastraAvisoEcoa", $informacoesErro, $mat);
            $retorno = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível permitir o cadastro de avisos. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return $retorno;
        }
    }

    public function adicionaModalAvisoEcoa(){
       
        $mat = $_SESSION['matricula'];
        $db = new Database('home');



        try{
            $modalAdicionaAviso = '
                <div class="modalAdicionaAviso">
                    <div class="formAdicionarAviso">
                        <div class="divTituloFormulario">
                            Adicionar Aviso ECOA
                            <p class="subtituloForm">Preencha o detalhe do aviso abaixo</p>
                            <form>
                                <span class="itemFormularioEcoa">Título</span>
                                <div class="divInputFormEcoa">
                                    <input type="text" class="inputFormEcoa" id="idTituloAvisoEcoa">
                                </div>
                                <span class="itemFormularioEcoa">Data</span>
                                <div class="divInputFormEcoa">
                                    <input type="date" class="inputFormEcoa" id="idDataAvisoEcoa" name="dataAvisoEcoa" min="'.date("Y-m-d").'"></input>
                                </div>
                                <span class="itemFormularioEcoa">Horário</span>
                                <div class="divInputFormEcoa">
                                    <input type="time" class="inputFormEcoa" id="idHorarioAvisoEcoa" name="horarioAvisoEcoa">
                                </div>
                                <span class="itemFormularioEcoa">Criação do Aviso</span>
                                <div>
                                    <textarea class="txtAreaEcoa" id="txtEventoEcoa" name="txtEventoEcoa" rows="7" cols="55" maxlength="500" placeholder="Mensagem"></textarea>
                                </div>
                                <div id="contador" class="contador">500 caracteres restantes</div>
                                <div class="areaBotoesFormEcoa">
                                    <div class="btnLimparEcoa Clicar" id="btnLimpaAviso">Limpar</div>
                                    <div class="btnCadastrarEcoa Clicar" id="btnCadastraAviso">Cadastrar</div>
                                </div>
                            </form>

                        </div>
                    </div>
                
                </div>
            
            ';

            $retorno = array();
            $retorno["status"] = 1;
            $retorno["mensagem"] = $modalAdicionaAviso;



        } catch(Exception $e){
            $retorno = array();
            $informacoesErro = "erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("home", "carregaCopilotos", $informacoesErro, $mat);
            $retorno["status"] = 0;
            $retorno["mensagem"] = "<p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar os Portais. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {

            return ($retorno);

        }  
        


    } 


    function adicionaAvisoEcoa($tituloAviso, $dataAviso, $horarioAviso, $txtAviso){
        $mat = $_SESSION['matricula'];
        $db = new Database('home');
        $retorno = array();

        $queryInsertAviso = "
            INSERT INTO `home`.`avisoEcoa` (
                `tituloAviso`, 
                `data`, 
                `horario`, 
                `descricao`

                
                ) VALUES (
                
                '".$tituloAviso."', 
                '".$dataAviso."', 
                '".$horarioAviso."' ,
                '".$txtAviso."'
                );
                
        ";
   
        
        try {
            $execQueryInsertAviso = $db->DbQuery($queryInsertAviso);

            if($execQueryInsertAviso){
                $retorno["status"] = 1;
                $retorno["mensagem"] = '<span class="avisoCadastradoSucesso">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M12 2C6.477 2 2 6.477 2 12C2 17.523 6.477 22 12 22C17.523 22 22 17.523 22 12C22 6.477 17.522 2 12 2ZM11.25 17.75L6.25 14L7.75 12L10.75 14.25L16 7.25L18 8.75L11.25 17.75Z" fill="#0C8A00"/>
                                            </svg>
                                            Aviso inserido com sucesso
                                        </span>';
            } else {
                $informacoesErro = "erro: " . $e . "\n\\n\$execQueryInsertAviso:" . $queryInsertAviso;
                $arquivoLog = $this->geraLogExcecao("home", "adicionaAvisoEcoa", $informacoesErro, $mat);
                $retorno["mensagem"] = "<p  style='font-size: 16px; font-weight: bold;'>Não foi possível registrar o aviso. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                $retorno["status"] = 0;
            }
        } catch(Exception $e) {
            $informacoesErro = "erro: " . $e . "\n\\n\$queryInsertAviso:" . $queryInsertAviso;
            $arquivoLog = $this->geraLogExcecao("home", "adicionaAvisoEcoa", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p  style='font-size: 16px; font-weight: bold;'>Não foi possível registrar o aviso. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return $retorno;
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

       
        try{

            $execQuery = $db->DbGetAll($query);

            if ($query > 0){

                for ($i = 0; $i < sizeof($execQuery) ; $i++){
                    
                    $idPesquisa = $execQuery[$i]['idEstudo'];

                    $montaPesquisas = $montaPesquisas.'
                                    <div class="hmolduraArea">
                                            <div class="hdivArea">
                                                <a href="https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idPesquisa.'.pdf" target="_blank" style="text-decoration: none;"> 
                                                    <div class="hcapaArea" style="background-image: url(https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idPesquisa.'.png);">           
                                                        <div class="hTemaTag">'.$execQuery[$i]['temas'].'</div>
                                                    </div>
                                                </a>
                                                <div class="hAreaTxt">
                                                    <div class="htituloArea">'.$execQuery[$i]['titulo'].'</div><br>
                                                    <div class="hsubtituloArea">'.$execQuery[$i]['subtitulo'].'</div>
                                                </div>
                                                <div class="rodapeDivAreas">
                                                    <a href="https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idPesquisa.'.pdf" target="_blank" style="text-decoration: none;"> 
                                                        <div class="btnAcessaDetalhe Clicar">Acessar</div>
                                                    </a>    
                                                </div>
                                            </div>
                                          
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

    public function carregaRecursos(){
        $mat = $_SESSION['matricula'];
        $db = new Database('recursos');

        $query = " SELECT * FROM recursos.recursos a 
                    LEFT JOIN recursos.recursosTemas b ON a.id = b.idRecurso
                    LEFT JOIN recursos.temas c ON b.idTema = c.id WHERE a.ativo = '1' order by a.id desc limit 3;";
        
        try{

            $execQuery = $db->DbGetAll($query);

            if ($execQuery > 0){
                
                for( $i = 0; $i < sizeof($execQuery); $i++){

                    $idRecurso = $execQuery[$i]['idRecurso'];

                    $montaRecursos = $montaRecursos.'
                                    <div class="hmolduraArea">
                                         
                                            <div class="hdivArea">
                                                <a href="'.$execQuery[$i]['nomeArquivo'].'" target="_blank" style="text-decoration: none;"> 
                                                    <div class="hcapaArea" style="background-image: url(https://cad.bb.com.br/lib/apps/recursos/arquivos/'.$execQuery[$i]['nomeCapa'].');">           
                                                        <div class="hTemaTag">'.$execQuery[$i]['tema'].'</div>
                                                    </div>
                                                </a>
                                                <div class="hAreaTxt">
                                                    <div class="htituloArea">'.$execQuery[$i]['titulo'].'</div><br>
                                                    <div class="hsubtituloArea">'.$execQuery[$i]['subtitulo'].'</div>
                                                </div>
                                                <div class="rodapeDivAreas">
                                                    <a href="'.$execQuery[$i]['nomeArquivo'].'"  target="_blank" style="text-decoration: none;"> 
                                                        <div class="btnAcessaDetalhe Clicar">Acessar</div>
                                                    </a>    
                                                </div>
                                            </div>
                                          
                                    </div>  ';

                }

                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = $montaRecursos;

            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar os Recursos nesse momento. Informe à equipe responsável. L367 - class_home.php";
            }


        } catch(Exception $e) {

            $retorno = array();
            $informacoesErro = "erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("home", "carregaRecursos", $informacoesErro, $mat);
            $retorno["status"] = 0;
            $retorno["mensagem"] = "<p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar os Recursos. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";

        } finally{

            return ($retorno);

        }


    }




    public function carregaExperimentos(){
        $mat = $_SESSION['matricula'];
        $db = new Database('experimentos');

        $query = " SELECT * FROM experimentos.experimentos a 
                    LEFT JOIN experimentos.experimentosTemas b on a.idExperimento = b.idExperimento
                    LEFT JOIN experimentos.temas c on b.idTema = c.idTema ORDER BY a.idExperimento DESC LIMIT 3 ;";
        
        try{

            $execQuery = $db->DbGetAll($query);

            if ($execQuery > 0){
                
                for( $i = 0; $i < sizeof($execQuery); $i++){

                    $idExperimento = $execQuery[$i]['idExperimento'];

                    $montaExperimento = $montaExperimento.'
                                    <div class="hmolduraArea">
                                         
                                            <div class="hdivArea">
                                                <a href="https://cad.bb.com.br/lib/apps/experimentos/arquivos'.$idExperimento.'.pdf" target="_blank" style="text-decoration: none;"> 
                                                    <div class="hcapaArea" style="background-image: url(https://cad.bb.com.br/lib/apps/experimentos/arquivos/'.$idExperimento.'.png);">           
                                                        <div class="hTemaTag">'.$execQuery[$i]['temas'].'</div>
                                                    </div>
                                                </a>
                                                <div class="hAreaTxt">
                                                    <div class="htituloArea">'.$execQuery[$i]['titulo'].'</div><br>
                                                    <div class="hsubtituloArea">'.$execQuery[$i]['subtitulo'].'</div>
                                                </div>
                                                <div class="rodapeDivAreas">
                                                    <a href="https://cad.bb.com.br/lib/apps/experimentos/arquivos/'.$idExperimento.'.pdf" target="_blank" style="text-decoration: none;"> 
                                                        <div class="btnAcessaDetalhe Clicar">Acessar</div>
                                                    </a>    
                                                </div>
                                            </div>
                                          
                                    </div>  ';

                }

                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = $montaExperimento;

            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar os Experimentos nesse momento. Informe à equipe responsável. L439 - class_home.php";
            }


        } catch(Exception $e) {

            $retorno = array();
            $informacoesErro = "erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("home", "carregaExperimentos", $informacoesErro, $mat);
            $retorno["status"] = 0;
            $retorno["mensagem"] = "<p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar os Experimentos. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";

        } finally{

            return ($retorno);

        }


    }


    public function carregaPaineis(){
        $mat = $_SESSION['matricula'];
        $db = new Database('experimentos');

        $query = " SELECT a.*, group_concat(c.nomeTag) as nomeTag 
                    FROM paineis.paineis a
                    LEFT JOIN paineis.paineis_tags b on a.idPainel = b.idPainel
                    LEFT JOIN paineis.tags c on b.idTag = c.idTag 
                    where a.ativo = 1 group by idPainel order by a.idPainel ASC limit 3;";
        
        try{

            $execQuery = $db->DbGetAll($query);

            if ($execQuery > 0){
                
                for( $i = 0; $i < sizeof($execQuery); $i++){

                    $idPainel = $execQuery[$i]['idPainel'];

                    $montaPainel = $montaPainel.'
                                    <div class="hmolduraArea">
                                            <div class="hdivArea">
                                                <a href="'.$execQuery[$i]['link'].'" target="_blank" style="text-decoration: none; ">
                                                    <div class="hcapaArea" style="background-image: url(https://cad.bb.com.br/lib/apps/paineis/img/'.$execQuery[$i]['idPainel'].'.png);">           
                                                        <div class="hTemaTag">'.$execQuery[$i]['nomeTag'].'</div>
                                                    </div>
                                                </a>
                                                <div class="hAreaTxt">
                                                    <div class="htituloArea" style ="margin-bottom:5px;" >'.$execQuery[$i]['titulo'].'</div>
                                                    <div class="hsubtituloArea">'.$execQuery[$i]['descricao'].'</div>
                                                </div>
                                                <div class="rodapeDivAreas">
                                                    <a href="'.$execQuery[$i]['link'].'" target="_blank" style="text-decoration: none; ">
                                                        <div class="btnAcessaDetalhe Clicar">Acessar</div>
                                                    </a>    
                                                </div>
                                            </div>
                                          
                                    </div>  ';

                }

                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = $montaPainel;

            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar os Paineis nesse momento. Informe à equipe responsável. L509 - class_home.php";
            }


        } catch(Exception $e) {

            $retorno = array();
            $informacoesErro = "erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("home", "carregaPesquisas", $informacoesErro, $mat);
            $retorno["status"] = 0;
            $retorno["mensagem"] = "<p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar os Paineis. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";

        } finally{

            return ($retorno);

        }


    }


    public function carregaEstudos(){
        $mat = $_SESSION['matricula'];
        $db = new Database('estudosPesquisas');
                    
                    
        $query = "SELECT * FROM estudosPesquisas.estudosPesquisas a
                    LEFT JOIN estudosPesquisas.temas b ON a.tema = b.id
                    WHERE a.tipo = 'estudos'
                    AND a.ativo = 1 
                    ORDER BY dtEstudoPesquisa DESC, idEstudo DESC limit 3;";

       
        try{

            $execQuery = $db->DbGetAll($query);

            if ($query > 0){

                for ($i = 0; $i < sizeof($execQuery) ; $i++){
                    
                    $idEstudo = $execQuery[$i]['idEstudo'];

                    $montaEstudos = $montaEstudos.'
                                    <div class="hmolduraArea">
                                            <div class="hdivArea">
                                                <a href="https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idEstudo.'.pdf" target="_blank" style="text-decoration: none;"> 
                                                    <div class="hcapaArea" style="background-image: url(https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idEstudo.'.png);">           
                                                        <div class="hTemaTag">'.$execQuery[$i]['temas'].'</div>
                                                    </div>
                                                </a>
                                                <div class="hAreaTxt">
                                                    <div class="htituloArea">'.$execQuery[$i]['titulo'].'</div><br>
                                                    <div class="hsubtituloArea">'.$execQuery[$i]['subtitulo'].'</div>
                                                </div>
                                                <div class="rodapeDivAreas">
                                                    <a href="https://cad.bb.com.br/lib/apps/estudosPesquisas/arquivos/'.$idEstudo.'.pdf" target="_blank" style="text-decoration: none;"> 
                                                        <div class="btnAcessaDetalhe Clicar">Acessar</div>
                                                    </a>    
                                                </div>
                                            </div>
                                          
                                    </div>    ';
                }
                
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = $montaEstudos;
                
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar os Estudos nesse momento. Informe à equipe responsável. L584 - class_home.php";
            }

        } catch(Exception $e){
            $retorno = array();
            $informacoesErro = "erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("home", "carregaEstudos", $informacoesErro, $mat);
            $retorno["status"] = 0;
            $retorno["mensagem"] = "<p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar os Estudos. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {

            return ($retorno);

        }

    }

    public function carregaCopilotos(){
        $mat = $_SESSION['matricula'];
        $db = new Database('copilotos');
                    
                    
        $query = "SELECT * FROM copilotos.copilotos ORDER BY  id desc limit 3;";

       
        try{

            $execQuery = $db->DbGetAll($query);

            if ($query > 0){

                for ($i = 0; $i < sizeof($execQuery) ; $i++){
                    
                    $idCopiloto = $execQuery[$i]['id'];

                    $montaCopilotos = $montaCopilotos.'
                                    <div class="hmolduraArea">
                                            <div class="hdivArea" id="hdivCopiloto">
                                                <a href="'.$execQuery[$i]['link'].'" target="_blank" style="text-decoration: none;"> 
                                                    <div class="hcapaAreaCopilotos">
                                                        <img src="https://cad.bb.com.br/lib/img/apps/home/copiloto'.$idCopiloto.'.png">           
                                                    </div>
                                                </a>
                                                <div class="hAreaTxt">
                                                    <div class="htituloArea">'.$execQuery[$i]['nome'].'</div><br>
                                                    <div class="hsubtituloArea">'.$execQuery[$i]['descricao'].'</div>
                                                </div>
                                                <div class="rodapeDivAreas">
                                                    <a href="'.$execQuery[$i]['link'].'" target="_blank" style="text-decoration: none;"> 
                                                        <div class="btnAcessaDetalhe Clicar">Acessar</div>
                                                    </a>    
                                                </div>
                                            </div>
                                    </div>    ';
                }
                
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = $montaCopilotos;
                
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar os Estudos nesse momento. Informe à equipe responsável. L584 - class_home.php";
            }

        } catch(Exception $e){
            $retorno = array();
            $informacoesErro = "erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("home", "carregaCopilotos", $informacoesErro, $mat);
            $retorno["status"] = 0;
            $retorno["mensagem"] = "<p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar os Copilotos. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {

            return ($retorno);

        }

    }

    public function carregaFerramentaPlataformas(){
        $mat = $_SESSION['matricula'];
        $db = new Database('ferramentas');
                    
                    
        $query = "SELECT * FROM ferramentas.ferramenta where categoria = 1;";

       
        try{

            $execQuery = $db->DbGetAll($query);

            if ($query > 0){

                for ($i = 0; $i < sizeof($execQuery) ; $i++){
                    
                    $idPlataforma = $execQuery[$i]['id'];

                    $nomeFerramenta = $execQuery[$i]['nome'];
                    $qtdeCharFerramenta = strlen($nomeFerramenta);

                    $widthDivDescricao="";
                    if($qtdeCharFerramenta > 15){

                        $widthDivDescricao = "style = 'width: 450px'; ";

                    }
                    

                    $montaPlataformas = $montaPlataformas.'
                                   <div class="divFerramenta divSessaoPlataformas" >
                                        <a href="'.$execQuery[$i]['link'].'" target="_blank">
                                            <div class="divTituloFerramenta">
                                                <img src="/lib/img/apps/home/ferramenta'.$idPlataforma.'.png" style=" padding-bottom: 2%;">
                                                '.$execQuery[$i]['nome'].'    
                                            </div>
                                        </a>        
                                        <div class="divNestDescricaoFerramenta">
                                            <div class="descricaoFerramenta" '.$widthDivDescricao.'>
                                                '.$execQuery[$i]['descricao'].'
                                            </div>
                                        </div>    
                                    </div> ';
                }
                
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = $montaPlataformas;
                
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar as Plataformas nesse momento. Informe à equipe responsável. L701 - class_home.php";
            }

        } catch(Exception $e){
            $retorno = array();
            $informacoesErro = "erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("home", "carregaCopilotos", $informacoesErro, $mat);
            $retorno["status"] = 0;
            $retorno["mensagem"] = "<p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar as Plataformas. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {

            return ($retorno);

        }

    }

    public function carregaFerramentaDesenvolvimento(){
        $mat = $_SESSION['matricula'];
        $db = new Database('ferramentas');
                    
                    
        $query = "SELECT * FROM ferramentas.ferramenta where categoria = 2;";

       
        try{

            $execQuery = $db->DbGetAll($query);

            if ($query > 0){

                for ($i = 0; $i < sizeof($execQuery) ; $i++){
                    
                    $idDesenvolvimento = $execQuery[$i]['id'];
                    
                    $nomeFerramenta = $execQuery[$i]['nome'];
                    $qtdeCharFerramenta = strlen($nomeFerramenta);

                    $widthDivDescricao="";
                    if($qtdeCharFerramenta > 15){

                        $widthDivDescricao = "style = 'width: 450px'; ";

                    }
                    
                   

                    $montaDesenvolvimento = $montaDesenvolvimento.'
                                   <div class="divFerramenta divSessaoDesenvolvimento" >
                                        <a href="'.$execQuery[$i]['link'].'" target="_blank">
                                            <div class="divTituloFerramenta">
                                                <img src="/lib/img/apps/home/ferramenta'.$idDesenvolvimento.'.png" style=" padding-bottom: 2%;">
                                                '.$execQuery[$i]['nome'].'   
                                            </div>
                                        </a>        
                                        <div class="divNestDescricaoFerramenta">
                                            <div class="descricaoFerramenta" '.$widthDivDescricao.'>
                                                '.$execQuery[$i]['descricao'].'
                                            </div>
                                        </div>    
                                    </div> ';
                }
                
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = $montaDesenvolvimento;
                
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar as Ferramentas de Desenvolvimento nesse momento. Informe à equipe responsável. L763 - class_home.php";
            }

        } catch(Exception $e){
            $retorno = array();
            $informacoesErro = "erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("home", "carregaCopilotos", $informacoesErro, $mat);
            $retorno["status"] = 0;
            $retorno["mensagem"] = "<p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar as Ferramentas de Desenvolvimento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {

            return ($retorno);

        }

    }

    public function carregaFerramentaAtivo(){
        $mat = $_SESSION['matricula'];
        $db = new Database('ferramentas');
                    
                    
        $query = "SELECT * FROM ferramentas.ferramenta where categoria = 3;";

       
        try{

            $execQuery = $db->DbGetAll($query);

            if ($query > 0){

                for ($i = 0; $i < sizeof($execQuery) ; $i++){
                    $nomeFerramenta = $execQuery[$i]['nome'];
                    $qtdeCharFerramenta = strlen($nomeFerramenta);

                    $widthDivDescricao="";
                    if($qtdeCharFerramenta > 15){

                        $widthDivDescricao = "style = 'width: 450px'; ";

                    }

                    
                    $idAtivo = $execQuery[$i]['id'];

                    $montaAtivo = $montaAtivo.'
                                   <div class="divFerramenta divSessaoAtivo" >
                                        <a href="'.$execQuery[$i]['link'].'" target="_blank">
                                            <div class="divTituloFerramenta">
                                                <img src="/lib/img/apps/home/ferramenta'.$idAtivo.'.png" style=" padding-bottom: 2%;">
                                                '.$execQuery[$i]['nome'].'    
                                            </div>
                                        </a>        
                                        <div class="divNestDescricaoFerramenta">
                                            <div class="descricaoFerramenta" '.$widthDivDescricao.'>
                                                '.$execQuery[$i]['descricao'].'
                                            </div>
                                        </div>    
                                    </div> ';
                }
                
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = $montaAtivo;
                
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar as Ferramentas de Ativo nesse momento. Informe à equipe responsável. L821 - class_home.php";
            }

        } catch(Exception $e){
            $retorno = array();
            $informacoesErro = "erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("home", "carregaCopilotos", $informacoesErro, $mat);
            $retorno["status"] = 0;
            $retorno["mensagem"] = "<p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar as Ferramentas de Ativo. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {

            return ($retorno);

        }

    }

     public function carregaFerramentaPortais(){
        $mat = $_SESSION['matricula'];
        $db = new Database('ferramentas');
                    
                    
        $query = "SELECT * FROM ferramentas.ferramenta where categoria = 4;";

       
        try{

            $execQuery = $db->DbGetAll($query);

            if ($query > 0){

                for ($i = 0; $i < sizeof($execQuery) ; $i++){
                    
                    $idPortais = $execQuery[$i]['id'];

                    $nomeFerramenta = $execQuery[$i]['nome'];
                    $qtdeCharFerramenta = strlen($nomeFerramenta);

                    $widthDivDescricao="";
                    if($qtdeCharFerramenta > 15){

                        $widthDivDescricao = "style = 'width: 450px'; ";

                    }
                    

                    $montaPortal = $montaPortal.'
                                   <div class="divFerramenta divSessaoPortais" >
                                        <a href="'.$execQuery[$i]['link'].'" target="_blank">
                                            <div class="divTituloFerramenta">
                                                <img src="/lib/img/apps/home/ferramenta'.$idPortais.'.png" style=" padding-bottom: 2%;">
                                                '.$execQuery[$i]['nome'].'    
                                            </div>
                                        </a>        
                                        <div class="divNestDescricaoFerramenta">
                                            <div class="descricaoFerramenta" '.$widthDivDescricao.'>
                                                '.$execQuery[$i]['descricao'].'
                                            </div>
                                        </div>    
                                    </div> ';
                }
                
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = $montaPortal;
                
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar os Portais nesse momento. Informe à equipe responsável. L879 - class_home.php";
            }

        } catch(Exception $e){
            $retorno = array();
            $informacoesErro = "erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("home", "carregaCopilotos", $informacoesErro, $mat);
            $retorno["status"] = 0;
            $retorno["mensagem"] = "<p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar os Portais. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {

            return ($retorno);

        }

    }


    public function carregaGrandesNumeros(){
        $mat = $_SESSION['matricula'];
        $db = new Database('report');


        $query = "call home.consultaGrandesNumerosBrutos();";

        try{
            $execQuery = $db->DbGetAll($query);

            if ($execQuery > 0){
                for($i=0; $i<sizeof($execQuery); $i++){
                    $totalRao = $execQuery[$i]['totalRao']; // Valor total de RAO no dia
                    $totalAtivo = $execQuery[$i]['totalAtivosSA']; // Valor total de Ativos SA no dia
                    $totalReneg = intval($totalRao + $totalAtivo); // Valor de RAO no dia e de Ativos SA no dia somados para compor o campo "Renegociações" e convertido para inteiro
                    $percentualRao = $execQuery[$i]['percentualTotalRao']; // Porcentagem dos acordos RAO em comparação com o dia anterior
                    $percentualAtivo = $execQuery[$i]['percentualTotalAtivosSA']; // Porcentagem dos acordos Ativos SA em comparação com o dia anterior                    
                    $ativoOntem = $execQuery[$i]['totalAtivosSAOntem']; // Valor total de Ativos SA no dia anterior
                    $raoOntem = $execQuery[$i]['totalRaoOntem']; // Valor total de RAO no dia anterior
                    $renegOntem = intval($ativoOntem + $raoOntem); // Valor somado de RAO do dia anterior e de Ativos SA no dia anterior para saber a diferença de percentual
                                                          
                    //Calculo do percentual entre o dia e D-1
                    if($renegOntem != 0) {
                        $percentualReneg = (($totalReneg - $renegOntem) / $renegOntem) *100;
                    } else {
                        $percentualReneg = 0;
                    }
                 
                    $valorOriginal = floatval(str_replace(['.', ','], ['', '.'], $totalReneg)); //Converte o valor para float e remove o ponto e troca virgula por ponto
                    $totalRenegString = strlen((string)intval($valorOriginal)); // Verificar o comprimento (tamanho) da variavel                 
                                           
                    if($totalRenegString > 6){
                        $totalReneg = '<span class="valorGrandesNumeros">'.number_format($totalReneg / 1000000, 1, '.', '').'M</span>';
                    } else {
                       $totalReneg = '<span class="valorGrandesNumeros">'.number_format($totalReneg / 1000, 1, '.', '').'K</span>';
                    }
                    
                                        
                    $percentualInteracoes = $execQuery[$i]['percentualInteracoes'];
                    $percentualUsuarios = $execQuery[$i]['percentualUsuarios'];
                    $percentualConversas = $execQuery[$i]['percentualConversas'];
                    $percentualNotaMedia = $execQuery[$i]['percentualNotaMedia'];
                    $percentualTotalAtivosEnviados = $execQuery[$i]['percentualTotalAtivosEnviados'];
                    $percentualTotalNegociacoes = '';
                    $percentualTotalRao = $execQuery[$i]['percentualTotalRao'];
                    $percentualTotalAtivosSA = $execQuery[$i]['percentualTotalAtivosSA'];
                    $percentualTotalCdc = $execQuery[$i]['percentualTotalCdc'];

                 

                    if($percentualInteracoes < 0){

                       $corPorcentualInteracoes = "variacaoNegativaGrandesNumeros";
                       
                    } else if ($percentualInteracoes > 0){

                        $corPorcentualInteracoes = "variacaoPositivaGrandesNumeros";
                    }

                    if($percentualUsuarios < 0){

                       $corPorcentualUsuarios = "variacaoNegativaGrandesNumeros";
                       
                    } else if ($percentualUsuarios > 0){

                        $corPorcentualUsuarios = "variacaoPositivaGrandesNumeros";
                    }

                    if($percentualConversas < 0){

                       $corPorcentualConversas = "variacaoNegativaGrandesNumeros";
                       
                    } else if ($percentualConversas > 0){

                        $corPorcentualConversas = "variacaoPositivaGrandesNumeros";
                    }

                    if($percentualNotaMedia < 0){

                       $corPorcentualNotaMedia = "variacaoNegativaGrandesNumeros";
                       
                    } else if ($percentualNotaMedia > 0){

                        $corPorcentualNotaMedia = "variacaoPositivaGrandesNumeros";
                    }

                    if($percentualTotalAtivosEnviados < 0){

                       $corPorcentualTotalAtivosEnviados = "variacaoNegativaGrandesNumeros";
                       
                    } else if ($percentualTotalAtivosEnviados > 0){

                        $corPorcentualTotalAtivosEnviados = "variacaoPositivaGrandesNumeros";
                    }

                    if($percentualReneg < 0){
                        
                       $corPorcentualReneg = "variacaoNegativaGrandesNumeros";
                       
                    } else if ($percentualReneg > 0){

                        $corPorcentualReneg = "variacaoPositivaGrandesNumeros";
                    }

                    
                    if($percentualTotalAtivosSA < 0){

                       $corPorcentualTotalAtivosSA = "variacaoNegativaGrandesNumeros";
                       
                    } else if ($percentualTotalAtivosSA > 0){

                        $corPorcentualTotalAtivosSA = "variacaoPositivaGrandesNumeros";
                    }
    
                     if($percentualTotalCdc < 0.00){

                       $corPorcentualTotalCdc = "variacaoNegativaGrandesNumeros";
                                          
                    } else if ($percentualTotalCdc >= 0.01){

                        $corPorcentualTotalCdc = "variacaoPositivaGrandesNumeros";
                    }



                    $montaGrandesNumeros = $montaGrandesNumeros.'
                    <div class="slideGrandesNumeros">
                        <span class="categoriaGrandesNumeros" style="color: #727272;" >Dados do dia</span>
                        <span class="valorGrandesNumeros">  '.$execQuery[$i]['dataFormatada'].'</span>
                    </div>
                    <div class="slideGrandesNumeros">
                        <span class="categoriaGrandesNumeros">Interações</span>
                        <span class="valorGrandesNumeros">  '.$execQuery[$i]['interacoesPf'].'</span>
                        <span class="'.$corPorcentualInteracoes.'">'.$percentualInteracoes.'</span>
                    </div>
                    <div class="slideGrandesNumeros">
                        <span class="categoriaGrandesNumeros">Usuários</span>
                        <span class="valorGrandesNumeros">  '.$execQuery[$i]['usuariosPf'].'</span>
                        <span class="'.$corPorcentualUsuarios.'">'.$execQuery[$i]['percentualUsuarios'].'</span>
                    </div>
                    <div class="slideGrandesNumeros">
                        <span class="categoriaGrandesNumeros">Conversas</span>
                        <span class="valorGrandesNumeros">  '.$execQuery[$i]['conversasPf'].'</span>
                        <span class="'.$corPorcentualConversas.'">'.$execQuery[$i]['percentualConversas'].'</span>
                    </div>
                    <div class="slideGrandesNumeros">
                        <span class="categoriaGrandesNumeros">Nota de Avaliação</span>
                        <span class="valorGrandesNumeros">  '.$execQuery[$i]['notaMediaPf'].'</span>
                        <span class="'.$corPorcentualNotaMedia.'">'.$execQuery[$i]['percentualNotaMedia'].'</span>
                    </div>
                     <div class="slideGrandesNumeros">
                        <span class="categoriaGrandesNumeros">Ativos Enviados</span>
                        <span class="valorGrandesNumeros">  '.$execQuery[$i]['totalAtivosEnviados'].'</span>
                        <span class="'.$corPorcentualTotalAtivosEnviados.'">'.$execQuery[$i]['percentualTotalAtivosEnviados'].'</span>
                    </div>
                    <div class="slideGrandesNumeros">
                        <span class="categoriaGrandesNumeros">Renegociações</span>'
                        .$totalReneg.                    
                        '<span class="'.$corPorcentualReneg.'">'.number_format($percentualReneg, 2, '.', '.').'%</span>
                    </div>                    
                    <div class="slideGrandesNumeros">
                        <span class="categoriaGrandesNumeros">Crédito</span>
                        <span class="valorGrandesNumeros">  '.$execQuery[$i]['totalCdc'].'</span>
                        <span class="'.$corPorcentualTotalCdc.'">'.$execQuery[$i]['percentualTotalCdc'].'</span>
                    </div>  
                    
                    ';

                
                }

                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaGrandesNumeros;   

            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar os Grandes números nesse momento. Informe à equipe responsável. L1134 - class_home.php";
            }

        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("home", "carregaAviso", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar  consultar os Grandes números nesse momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";

        }finally {
            return ($retorno);
        }


    }


    



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