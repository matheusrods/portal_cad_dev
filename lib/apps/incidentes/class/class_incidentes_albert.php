<?php

ini_set('display_startup_errors', 1);
session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

Class funcoes{

    public $mat;

    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
        $mat = $_SESSION['matricula'];
        $caminhoLogErro = $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
    }

    //consulta os incidentes cadastrados e os exibe em uma tabela
    public function consultaIncidentes(){
        $mat = $_SESSION['matricula'];

        $db = new Database('incidentes');
        $query = "SELECT a.*, a.numIntIssue, b.tipo, a.status, c.ambiente 
                  FROM incidentes.incidente a
                  LEFT JOIN incidentes.tipoIncidentes b on a.tipo = b.codigo
                  LEFT JOIN incidentes.ambiente c on a.ambiente = c.codigo 
            
        ;" ;
        try{

            $execQuery = $db->DbGetAll($query);
            
            if ($execQuery > 0){
               
                $inicioTabelaIncidentes = '<table class="table" id="tabelaIncidentes" style="width:70%; line-height:30px;">
                                                
                                                    <tr id="cabecalhoTabela" style="background-color:red;">                                          
                                                        <th id="cabecalhoTabela">Nº INT/Issue</th> 
                                                        <th id="cabecalhoTabela">Tipo</th> 
                                                        <th id="cabecalhoTabela">Status</th> 
                                                        <th id="cabecalhoTabela">Ambiente</th> 
                                                        <th id="cabecalhoTabela"> </th> 
                                                    </tr>
                                                
                                                <tbody>    

                                            '; 
                                            
                                            
                                            
                $fechaTabelaIncidentes = '</tbody></table>'; 
                $tabelaIncidentes = "";
                    for( $i=0; $i<sizeof($execQuery); $i++) {
                        $tabelaIncidentes = $tabelaIncidentes.'  
                        <tr>
                        <td>'.$execQuery[$i]['numIntIssue'].'</td>
                        <td>'.$execQuery[$i]['tipo'].'</td>
                        <td>'.$execQuery[$i]['status'].'</td>
                        <td>'.$execQuery[$i]['ambiente'].'</td>
                        <td>
                            <img src="https://cad.bb.com.br/lib/apps/incidentes/img/iconeEditar.png" attr-idIntIssue ="'.$execQuery[$i]['numIntIssue'].'" class = "editaIncidente">
                            <img src="https://cad.bb.com.br/lib/apps/incidentes/img/iconeDeletar.png" attr-idIntIssue ="'.$execQuery[$i]['numIntIssue'].'" class= "deletaIncidente">
                            
                        </td>
                        <td><img src="https://cad.bb.com.br/lib/apps/incidentes/img/navegacaoBtn.png" attr-idIntIssue ="'.$execQuery[$i]['numIntIssue'].'" class= "acessaIncidente"></td>
                        </tr>';
                    }

                    $montaTabelaIncidentes = $inicioTabelaIncidentes.$tabelaIncidentes.$fechaTabelaIncidentes;
                   
                   $retorno = array();
                   $retorno["status"] = 1;
                   $retorno["mensagem"] = $montaTabelaIncidentes;   

            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar os incidentes nesse momento. Informe à equipe responsável. L60 - class_incidentes.php";
            }
            }catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("incidentes", "consultaIncidentes", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar os incidentes. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }          

    }

    public function consultaTipoIncidente(){
        $mat = $_SESSION['matricula'];

        $db = new Database('incidentes');

        $query = "SELECT DISTINCT * FROM tipoIncidentes
        ;";

        try{
            $execQuery = $db->DbGetAll($query);

            if($execQuery > 0){
                $selectTipoIncidentes = "";

                for ($i=0; $i < sizeof($execQuery); $i++){
                    $selectTipoIncidentes = $selectTipoIncidentes.'
                    <option value="'.$execQuery[$i]['tipo'].'">'.$execQuery[$i]['tipo'].'</option>';
                    
                }

                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $selectTipoIncidentes;   

            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar os tipos de incidentes nesse momento. Informe à equipe responsável. L114 - class_incidentes.php";
            }

        }catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("incidentes", "consultaIncidentes", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar os incidentes. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }   


    }


    public function consultaStatus(){
        $mat = $_SESSION['matricula'];

        $db = new Database('incidentes');

        $query = "SELECT distinct status FROM incidente
        ;";

        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery > 0){
                $selectStatusIncidentes = "";

                for ($i=0; $i < sizeof($execQuery); $i++){
                    $selectStatusIncidentes = $selectStatusIncidentes.'
                    <option value="'.$execQuery[$i]['status'].'">'.$execQuery[$i]['status'].'</option>';
                    
                   
                    
                }
                
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $selectStatusIncidentes;   
                
                
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar os status dos incidentes nesse momento. Informe à equipe responsável. L156 - class_incidentes.php";
                
            }

        }catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("incidentes", "consultaStatus", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar os status. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }   


    }


    public function consultaAmbiente(){
        $mat = $_SESSION['matricula'];

        $db = new Database('incidentes');

        $query = "SELECT * FROM ambiente
        ;";

        try{
            $execQuery = $db->DbGetAll($query);

            if($execQuery > 0){
                $selectAmbiente = "";

                for ($i=0; $i < sizeof($execQuery); $i++){
                    $selectAmbiente = $selectAmbiente.'
                    <option value="'.$execQuery[$i]['ambiente'].'">'.$execQuery[$i]['ambiente'].'</option>';
                    
                }

                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $selectAmbiente;   

            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar os ambientes nesse momento. Informe à equipe responsável. L202 - class_incidentes.php";
            }

        }catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("incidentes", "consultaAmbiente", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar os ambientes. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }   


    }


    public function consultaDepencias(){
        $mat = $_SESSION['matricula'];

        $db = new Database('incidentes');

        $query = "SELECT DISTINCT dependencia FROM incidente
        ;";

        try{
            $execQuery = $db->DbGetAll($query);

            if($execQuery > 0){
                $selectDependencias = "";

                for ($i=0; $i < sizeof($execQuery); $i++){
                    $selectDependencias = $selectDependencias.'
                    <option value="'.$execQuery[$i]['dependencia'].'">'.$execQuery[$i]['dependencia'].'</option>';
                    
                }

                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $selectDependencias;   

            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar as dependências nesse momento. Informe à equipe responsável. L244 - class_incidentes.php";
            }

        }catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("incidentes", "consultaDependencias", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar as dependências. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }   


    }

    public function pesquisaIncidentes($dadosPesquisa){
        $mat = $_SESSION['matricula'];

        $dadosPesquisaDecode = json_decode($dadosPesquisa,true);         
       
        $where = "where ";

        $numIntIssueExiste = FALSE;
        $tipoExiste = FALSE;
        $statusExiste = FALSE;
        $ambienteExiste = FALSE;
        $dependenciaExiste = FALSE;
        $dataHoraAberturaExiste = FALSE;
        $dataHoraEncerramentoExiste = FALSE;


        if (array_key_exists('numIntIssue', $dadosPesquisaDecode)){
            
            $numIntIssue = $dadosPesquisaDecode["numIntIssue"];
            $where = $where."a.numIntIssue like ('%".$numIntIssue."%')";
            $numIntIssueExiste = TRUE;
            
        } 


        if (array_key_exists('tipo', $dadosPesquisaDecode)){
            $tipo = $dadosPesquisaDecode["tipo"];
            $tipoExiste = TRUE;
            if( $numIntIssueExiste == FALSE){ 
                $where = $where." b.tipo = '".$tipo."'";
            } else {
                $where = $where." AND b.tipo ='".$tipo."'";    
            }
        }

        if (array_key_exists('status', $dadosPesquisaDecode)){
            $status = $dadosPesquisaDecode["status"];
            $statusExiste = TRUE;

            if ($tipoExiste == TRUE || $numIntIssueExiste == TRUE){
                $where = $where." AND a.status ='".$status."'";
            } else {
                $where = $where." a.status ='".$status."'";
            }
        }

        if (array_key_exists('ambiente', $dadosPesquisaDecode)){
            $ambiente = $dadosPesquisaDecode["ambiente"];
            $ambienteExiste = TRUE;

            if($statusExiste == TRUE || $tipoExiste == TRUE || $numIntIssueExiste == TRUE){
                $where = $where." AND c.ambiente = '".$ambiente."'";
            } else {
                $where = $where." c.ambiente = '".$ambiente."'";
            }
        }

        if (array_key_exists('dependencia', $dadosPesquisaDecode)){
            $dependencia = $dadosPesquisaDecode["dependencia"];
            $dependenciaExiste = TRUE;

            if($ambienteExiste == TRUE || $statusExiste == TRUE || $tipoExiste == TRUE || $numIntIssueExiste == TRUE){
                $where = $where." AND a.dependencia = '".$dependencia."'";
            } else {
                $where = $where." a.dependencia = '".$dependencia."'";
            }
        }


        if (array_key_exists('dataHoraAbertura', $dadosPesquisaDecode)){
            $dataHoraAbertura = $dadosPesquisaDecode["dataHoraAbertura"];
            $dataHoraAberturaExiste = TRUE;

            if ($dependenciaExiste == TRUE || $ambienteExiste == TRUE || $statusExiste == TRUE || $tipoExiste == TRUE || $numIntIssueExiste == TRUE){
                $where = $where." AND a.dataHoraAbertura like ('%".$dataHoraAbertura."%')";
            } else {
                $where = $where." a.dataHoraAbertura like ('%".$dataHoraAbertura."%')";
            }
        }

        if (array_key_exists('dataHoraEncerramento', $dadosPesquisaDecode)){
            $dataHoraEncerramento = $dadosPesquisaDecode["dataHoraEncerramento"];
            $dataHoraEncerramentoExiste = TRUE;
            
            if ($dataHoraAberturaExiste == TRUE || $dependenciaExiste == TRUE || $ambienteExiste == TRUE || $statusExiste == TRUE || $tipoExiste == TRUE || $numIntIssueExiste == TRUE){
                $where = $where." AND a.dataHoraEncerramento like ('%".$dataHoraEncerramento."%')";
            } else {
                $where = $where."a.dataHoraEncerramento like ('%".$dataHoraEncerramento."%')";
            }                   
        }

        $db = new Database('incidentes');
        $query = "SELECT  a.*, b.tipo as tipoNome, c.ambiente as ambienteNome
                   FROM incidentes.incidente a
                   LEFT JOIN incidentes.tipoIncidentes b on a.tipo = b.codigo
                   LEFT JOIN incidentes.ambiente c on a.ambiente = c.codigo 

        " ;

        $queryFinal = $query.$where.';'; 
        $montaTabelaIncidentesFiltrada = "";

        try{ 

            $execQueryFiltro = $db->DbGetAll($queryFinal);
            $retorno = array();
            if ($execQueryFiltro > 0){
                
                $inicioTabelaIncidentesFiltrada = 
                
                '<table class="table" id="tabelaIncidentes" style="width:70%; line-height:30px;">
                                                
                    <tr id="cabecalhoTabela" style="background-color:red;">                                          
                        <th id="cabecalhoTabela">Nº INT/Issue</th> 
                        <th id="cabecalhoTabela">Tipo</th> 
                        <th id="cabecalhoTabela">Status</th> 
                        <th id="cabecalhoTabela">Ambiente</th> 
                    </tr>
                    <tbody>
                '; 

                $fechaTabelaIncidentesFiltrada = '</tbody></table>'; 
                $tabelaIncidentesFiltrada = "";

                for($i = 0; $i < sizeof($execQueryFiltro); $i++) {
                    $tabelaIncidentesFiltrada = $tabelaIncidentesFiltrada.'  
                    <tr>
                        <td>'.$execQueryFiltro[$i]['numIntIssue'].'</td>
                        <td>'.$execQueryFiltro[$i]['tipoNome'].'</td>
                        <td>'.$execQueryFiltro[$i]['status'].'</td>
                        <td>'.$execQueryFiltro[$i]['ambienteNome'].'</td>
                    </tr>';
                }

                $montaTabelaIncidentesFiltrada = $inicioTabelaIncidentesFiltrada.$tabelaIncidentesFiltrada.$fechaTabelaIncidentesFiltrada;
                
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaTabelaIncidentesFiltrada;
            } else {
                $retorno["status"] = 1;
                $retorno["mensagem"] = "Não foram localizados incidentes com os dados informados.";
            }
    
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("incidentes", "pesquisaIncidentes", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p  style='font-size: 16px; font-weight: bold;'>Não foi possível pesquisar os incidentes. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            $retorno["status"] = 0;
        }finally {
             return ($retorno);
        }
    }

    function montaTelaCadastraIncidente(){
        $db = New Database('incidentes');
        
        $queryConsultaTipoIncidente = "SELECT * FROM incidentes.tipoIncidentes;";
        $execQueryConsultaTipoIncidentes = $db->DbGetAll($queryConsultaTipoIncidente);
        
        if($execQueryConsultaTipoIncidentes){
            $selectTipoIncidente = '<option value="0">Tipo Incidente</option>';
            for($i = 0; $i < sizeof($execQueryConsultaTipoIncidentes); $i++){
                $selectTipoIncidente = $selectTipoIncidente.'<option value="'.$execQueryConsultaTipoIncidentes[$i]['codigo'].'">'.$execQueryConsultaTipoIncidentes[$i]['tipo'].'</option>';
            }
        }
        $selectTipoIncidente = '<label for="tipoIncidenteCadastraIncidente">Tipo Incidente</label><select name="tipoIncidenteCadastraIncidente" id="tipoIncidenteCadastraIncidente">'.$selectTipoIncidente.'</select>';

        $queryConsultaStatus = "SELECT * FROM incidentes.status;";
        $execQueryConsultaStatus = $db->DbGetAll($queryConsultaStatus);

        if($execQueryConsultaStatus){
            $selectStatus= '<option value="0">Status</option>';
            for($i = 0; $i < sizeof($execQueryConsultaStatus); $i++){
                $selectStatus = $selectStatus.'<option value="'.$execQueryConsultaStatus[$i]['codigo'].'">'.$execQueryConsultaStatus[$i]['descricao'].'</option>';
            }
        }
        $selectStatus = '<label for="selectStatusCadastraIncidente">Status</label><select name="selectStatusCadastraIncidente" id="selectStatusCadastraIncidente">'.$selectStatus.'</select>';

        $queryConsultaAmbientes = "SELECT * FROM incidentes.ambiente;";
        $execQueryConsultaAmbientes = $db->DbGetAll($queryConsultaAmbientes);

        if($execQueryConsultaAmbientes){
            $selectAmbiente= '<option value="0">Ambiente</option>';
            for($i = 0; $i < sizeof($execQueryConsultaAmbientes); $i++){
                $selectAmbiente = $selectAmbiente.'<option value="'.$execQueryConsultaAmbientes[$i]['codigo'].'">'.$execQueryConsultaAmbientes[$i]['ambiente'].'</option>';
            }
        }
        $selectAmbiente = '<label for="selectAmbienteCadastraIncidente">Ambiente</label><select name="selectAmbienteCadastraIncidente" id="selectAmbienteCadastraIncidente">'.$selectAmbiente.'</select>';
        
        $montaPaginaRegistraIncidente = '
            <div class="modalRegistraIncidente">
                <div class="divEsquerdaRegistraIncidente">
                    <div class="divSelectIncidenteRegistraIncidente">
                        '.$selectTipoIncidente.'
                    </div>
                    <div class="divInputIntIssueRegistraIncidente">
                        <label for="numIntIssueRegistraIncidente">Número INT ou ISSUE</label>
                        <input type="text" id="numIntIssueRegistraIncidente" style="height: 1.4rem;"></input>
                    </div>
                    <div class="divInputDataAberturaIncidente">
                        <label for="dataAberturaRegistraIncidente">Data Abertura</label>
                        <input type="date" id="dataAberturaRegistraIncidente" name="dataAberturaRegistraIncidente" max="today()" style="height: 1.4rem;"></input>
                    </div>
                    <div class="divInputHoraAberturaIncidente">    
                        <label for="horarioAberturaRegistraIncidente">Horário Abertura</label>
                        <input type="time" id="horarioAberturaRegistraIncidente" name="horarioAberturaRegistraIncidente" style="height: 1.4rem;"></input>
                    </div>
                    <div class="divTextAreaMotivoRegistraIncidente">
                        <label for="motivoRegistraIncidente">Motivo</label>
                        <textarea id="motivoRegistraIncidente"></textarea>
                    </div>
                    <div class="divSelectAmbienteRegistraIncidente">
                        '.$selectAmbiente.'
                    </div>
                </div>

                <div class="divDireitaRegistraIncidente">
                    <div class="divSelectStatusRegistraIncidente">
                        '.$selectStatus.'
                    </div>
                    <div class="divNumDependenciaRegistraIncidente">
                        <label for="numDependenciaRegistraIncidente">Dependência</label>
                        <input type="text" id="numDependenciaRegistraIncidente"style="height: 1.4rem;"></input>
                    </div>
                    <div class="divInputDataEncerramentoIncidente">
                        <label for="dataEncerramentoRegistraIncidente">Data Encerramento</label>
                        <input type="date" id="dataEncerramentoRegistraIncidente" name="dataEncerramentoRegistraIncidente" max="today()" style="height: 1.4rem;"></input>
                    </div>
                    <div class="divInputHoraEncerramentoIncidente">
                        <label for="horarioEncerramentoRegistraIncidente">Horário Encerramento</label>
                        <input type="time" id="horarioEncerramentoRegistraIncidente" name="horarioEncerramentoRegistraIncidente" style="height: 1.4rem;"></input>
                    </div>
                    <div class="divTextAreaObservacaoRegistraIncidente">
                        <label for="observacaoRegistraIncidente">Observação</label>
                        <textarea id="observacaoRegistraIncidente"></textarea>
                    </div>
                    <div class="divInputResponsavelRegistraIncidente">
                        <label for="inputResponsavelRegistraIncidente">Responsável</label>
                        <textarea id="inputResponsavelRegistraIncidente"></textarea>
                    </div>
                </div>
            </div>
        ';

        $retorno = array();
        $retorno["status"] = 1;
        $retorno["mensagem"] = $montaPaginaRegistraIncidente;

        return json_encode($retorno);
    }

    function montaTelaEditaIncidente($numIntIssue){
        $db = New Database('incidentes');
        
        $queryConsultaIncidente = "
            SELECT a.*, 
                b.codigo as 'idTipo', 
                b.tipo as 'tipoIncidente', 
                c.codigo as 'idAmbiente', 
                c.ambiente as 'nomeAmbiente', 
                d.codigo as 'codStatus', 
                date_format(a.dataHoraAbertura, '%Y-%m-%d') as dataAberturaFormatada,
                date_format(a.dataHoraAbertura, '%H:%i') as horaAberturaFormatada,
                date_format(a.dataHoraEncerramento, '%Y-%m-%d') as dataEncerramentoFormatada,
                date_format(a.dataHoraEncerramento, '%H:%i') as horaEncerramentoFormatada
                
                FROM incidentes.incidente a 
                LEFT JOIN incidentes.tipoIncidentes b ON a.tipo = b.codigo
                LEFT JOIN incidentes.ambiente c ON a.ambiente = c.codigo
                LEFT JOIN incidentes.status d ON a.status = d.descricao
                WHERE numIntIssue = '".$numIntIssue."';";

        $execQueryConsultaIncidentes = $db->DbGetAll($queryConsultaIncidente);
        
        if($execQueryConsultaIncidentes){
            // monta select de tipo de incidente
            $selectTipoIncidente = '<option value="'.$execQueryConsultaIncidentes[0]['idTipo'].'">'.$execQueryConsultaIncidentes[0]['tipoIncidente'].'</option>';
            
            $queryConsultaTipoNaoSelecionado = "SELECT * FROM incidentes.tipoIncidentes WHERE codigo <> ".$execQueryConsultaIncidentes[0]['idTipo'].";";
            $execQueryTipoNaoSelecionado = $db->DbGetAll($queryConsultaTipoNaoSelecionado);

            for($i = 0; $i < sizeof($execQueryTipoNaoSelecionado); $i++){
                $selectTipoIncidente = $selectTipoIncidente.'<option value="'.$execQueryTipoNaoSelecionado[$i]['codigo'].'">'.$execQueryTipoNaoSelecionado[$i]['tipo'].'</option>';
            }

            // monta select de status
            $selectStatus= '<option value="'.$execQueryConsultaIncidentes[0]['codStatus'].'">'.$execQueryConsultaIncidentes[0]['status'].'</option>';
            
            $queryConsultaStatusNaoSelecionado = "SELECT * FROM incidentes.status WHERE descricao <> '".$execQueryConsultaIncidentes[0]['status']."';";
            $execQueryStatusNaoSelecionado = $db->DbGetAll($queryConsultaStatusNaoSelecionado);

            for($i = 0; $i < sizeof($execQueryStatusNaoSelecionado); $i++){
                $selectStatus = $selectStatus.'<option value="'.$execQueryStatusNaoSelecionado[$i]['codigo'].'">'.$execQueryStatusNaoSelecionado[$i]['descricao'].'</option>';
            }

            // monta select de ambiente
            $selectAmbiente= '<option value="'.$execQueryConsultaIncidentes[0]['idAmbiente'].'">'.$execQueryConsultaIncidentes[0]['nomeAmbiente'].'</option>';

            $queryConsultaAmbienteNaoSelecionado = "SELECT * FROM incidentes.ambiente WHERE codigo <> ".$execQueryConsultaIncidentes[0]['idAmbiente'].";";
            $execQueryAmbienteNaoSelecionado = $db->DbGetAll($queryConsultaAmbienteNaoSelecionado);

            for($i = 0; $i < sizeof($execQueryAmbienteNaoSelecionado); $i++){
                $selectAmbiente = $selectAmbiente.'<option value="'.$execQueryAmbienteNaoSelecionado[$i]['codigo'].'">'.$execQueryAmbienteNaoSelecionado[$i]['ambiente'].'</option>';
            }

        }
        $selectTipoIncidente = '<label for="tipoIncidenteEditaIncidente">Tipo Incidente</label><select name="tipoIncidenteEditaIncidente" id="tipoIncidenteEditaIncidente">'.$selectTipoIncidente.'</select>';
        $selectStatus = '<label for="selectStatusEditaIncidente">Status</label><select name="selectStatusEditaIncidente" id="selectStatusEditaIncidente">'.$selectStatus.'</select>';
        $selectAmbiente = '<label for="selectAmbienteEditaIncidente">Ambiente</label><select name="selectAmbienteEditaIncidente" id="selectAmbienteEditaIncidente">'.$selectAmbiente.'</select>';

        
        $montaPaginaRegistraIncidente = '
            <div class="modalRegistraIncidente">
                <div class="divEsquerdaRegistraIncidente">
                    <div class="divSelectIncidenteRegistraIncidente">
                        '.$selectTipoIncidente.'
                    </div>
                    <div class="divInputIntIssueRegistraIncidente">
                        <label for="numIntIssueEditaIncidente">Número INT ou ISSUE</label>
                        <input type="text" id="numIntIssueEditaIncidente" style="height: 1.4rem;" value="'.$execQueryConsultaIncidentes[0]['numIntIssue'].'" attr-idIncidente = "'.$execQueryConsultaIncidentes[0]['id'].'" disabled></input>
                    </div>
                    <div class="divInputDataAberturaIncidente">
                        <label for="dataAberturaEditaIncidente">Data Abertura</label>
                        <input type="date" id="dataAberturaEditaIncidente" name="dataAberturaEditaIncidente" max="today()" style="height: 1.4rem;" value="'.$execQueryConsultaIncidentes[0]['dataAberturaFormatada'].'"></input>
                    </div>
                    <div class="divInputHoraAberturaIncidente">    
                        <label for="horarioAberturaEditaIncidente">Horário Abertura</label>
                        <input type="time" id="horarioAberturaEditaIncidente" name="horarioAberturaEditaIncidente" style="height: 1.4rem;" value="'.$execQueryConsultaIncidentes[0]['horaAberturaFormatada'].'"></input>
                    </div>
                    <div class="divTextAreaMotivoEditaIncidente">
                        <label for="motivoEditaIncidente">Motivo</label>
                        <textarea id="motivoEditaIncidente">'.$execQueryConsultaIncidentes[0]['motivo'].'</textarea>
                    </div>
                    <div class="divSelectAmbienteEditaIncidente">
                        '.$selectAmbiente.'
                    </div>
                </div>

                <div class="divDireitaRegistraIncidente">
                    <div class="divSelectStatusRegistraIncidente">
                        '.$selectStatus.'
                    </div>
                    <div class="divNumDependenciaEditaIncidente">
                        <label for="numDependenciaEditaIncidente">Dependência</label>
                        <input type="text" id="numDependenciaEditaIncidente"style="height: 1.4rem;" value="'.$execQueryConsultaIncidentes[0]['dependencia'].'"></input>
                    </div>
                    <div class="divInputDataEncerramentoIncidente">
                        <label for="dataEncerramentoEditaIncidente">Data Encerramento</label>
                        <input type="date" id="dataEncerramentoEditaIncidente" name="dataEncerramentoEditaIncidente" max="today()" style="height: 1.4rem;" value="'.$execQueryConsultaIncidentes[0]['dataEncerramentoFormatada'].'"></input>
                    </div>
                    <div class="divInputHoraEncerramentoIncidente">
                        <label for="horarioEncerramentoEditaIncidente">Horário Encerramento</label>
                        <input type="time" id="horarioEncerramentoEditaIncidente" name="horarioEncerramentoEditaIncidente" style="height: 1.4rem;" value="'.$execQueryConsultaIncidentes[0]['horaEncerramentoFormatada'].'"></input>
                    </div>
                    <div class="divTextAreaObservacaoEditaIncidente">
                        <label for="observacaoEditaIncidente">Observação</label>
                        <textarea id="observacaoEditaIncidente">'.$execQueryConsultaIncidentes[0]['observacao'].'</textarea>
                    </div>
                    <div class="divInputResponsavelEditaIncidente">
                        <label for="inputResponsavelEditaIncidente">Responsável</label>
                        <textarea id="inputResponsavelEditaIncidente">'.$execQueryConsultaIncidentes[0]['responsavel'].'</textarea>
                    </div>
                </div>
            </div>
        ';

        $retorno = array();
        $retorno["status"] = 1;
        $retorno["mensagem"] = $montaPaginaRegistraIncidente;

        return json_encode($retorno);
    }

    function gravaIncidente($tipoIncidente, $numIntIssue, $dataAbertura, $horaAbertura, $motivo, $ambiente, $status, $dependencia, $dataEncerramento, $horaEncerramento, $observacao, $responsavel){
        $mat = $_SESSION['matricula'];
        $db = new Database('incidentes');
        $retorno = array();

        if($motivo == ''){
            $motivo = "NULL";
        } else {
            $motivo = "'".$motivo."'";
        }

        if($dataEncerramento == '' || $horaEncerramento == ''){
            $matEncerramento = "NULL";
            $dataHoraEncerramento = "NULL";
        } else {
            $dataHoraEncerramento = "'".$dataEncerramento." ".$horaEncerramento.":00'";
            $matEncerramento = "'".$mat."'";
        }

        if($observacao == ''){
            $observacao = "NULL";
        } else {
            $observacao = "'".$observacao."'";
        }

        if($responsavel == ''){
            $responsavel = "NULL";
        } else {
            $responsavel = "'".$responsavel."'";
        }

        $queryInsertIncidente = "
            INSERT INTO `incidentes`.`incidente` (
                `numIntIssue`, 
                `matriculaAbertura`, 
                `dataHoraAbertura`, 
                `matriculaEncerramento`, 
                `dataHoraEncerramento`, 
                `motivo`, 
                `ambiente`, 
                `dependencia`, 
                `observacao`, 
                `responsavel`, 
                `status`, 
                `tipo`
                
                ) VALUES (
                
                '".$numIntIssue."', 
                '".$mat."', 
                '".$dataAbertura." ".$horaAbertura.":00', 
                ".$matEncerramento.", 
                ".$dataHoraEncerramento.", 
                ".$motivo.", 
                '".$ambiente."', 
                '".$dependencia."', 
                ".$observacao.", 
                ".$responsavel.", 
                '".$status."', 
                '".$tipoIncidente."');
        ";

        try {
            $execQueryInsertIncidente = $db->DbQuery($queryInsertIncidente);

            if($execQueryInsertIncidente){
                $retorno["status"] = 1;
                $retorno["mensagem"] = 'Incidente '.$numIntIssue.' registrado com sucesso!';
            } else {
                $informacoesErro = "erro: " . $e . "\n\\n\$queryInsertIncidente:" . $queryInsertIncidente;
                $arquivoLog = $this->geraLogExcecao("incidentes", "gravaIncidente", $informacoesErro, $mat);
                $retorno["mensagem"] = "<p  style='font-size: 16px; font-weight: bold;'>Não foi possível registrar o incidente. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                $retorno["status"] = 0;
            }
        } catch(Exception $e) {
            $informacoesErro = "erro: " . $e . "\n\\n\$queryInsertIncidente:" . $queryInsertIncidente;
            $arquivoLog = $this->geraLogExcecao("incidentes", "gravaIncidente", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p  style='font-size: 16px; font-weight: bold;'>Não foi possível registrar o incidente. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return json_encode($retorno);
        }
    }

    function editaIncidente($idIncidenteBd, $tipoIncidente, $numIntIssue, $dataAbertura, $horaAbertura, $motivo, $ambiente, $status, $dependencia, $dataEncerramento, $horaEncerramento, $observacao, $responsavel){
        $mat = $_SESSION['matricula'];
        $db = new Database('incidentes');
        $retorno = array();

        if($motivo == ''){
            $motivo = "NULL";
        } else {
            $motivo = "'".$motivo."'";
        }

        if($dataEncerramento == '' || $horaEncerramento == ''){
            $matEncerramento = "NULL";
            $dataHoraEncerramento = "NULL";
        } else {
            $dataHoraEncerramento = "'".$dataEncerramento." ".$horaEncerramento.":00'";
            $matEncerramento = "'".$mat."'";
        }

        if($observacao == ''){
            $observacao = "NULL";
        } else {
            $observacao = "'".$observacao."'";
        }

        if($responsavel == ''){
            $responsavel = "NULL";
        } else {
            $responsavel = "'".$responsavel."'";
        }

        $queryUpdateIncidente = "
            UPDATE `incidentes`.`incidente` SET 
                `dataHoraAbertura` = '".$dataAbertura." ".$horaAbertura.":00', 
                `matriculaEncerramento` = ".$matEncerramento.", 
                `dataHoraEncerramento` = ".$dataHoraEncerramento.",
                `motivo` = ".$motivo.",
                `ambiente` = '".$ambiente."',
                `dependencia` = '".$dependencia."',
                `observacao` = ".$observacao.",
                `responsavel` = ".$responsavel.",
                `status` = '".$status."',
                `tipo` = '".$tipoIncidente."'
            WHERE (`id` = '".$idIncidenteBd."');
        ";

        try {
            $execQueryUpdateIncidente = $db->DbQuery($queryUpdateIncidente);

            if($execQueryUpdateIncidente){
                $retorno["status"] = 1;
                $retorno["mensagem"] = 'Incidente '.$numIntIssue.' atualizado com sucesso!';
            } else {
                $informacoesErro = "erro: " . $e . "\n\\n\$queryUpdateIncidente:" . $queryUpdateIncidente;
                $arquivoLog = $this->geraLogExcecao("incidentes", "gravaIncidente", $informacoesErro, $mat);
                $retorno["mensagem"] = "<p  style='font-size: 16px; font-weight: bold;'>Não foi possível registrar o incidente. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                $retorno["status"] = 0;
            }
        } catch(Exception $e) {
            $informacoesErro = "erro: " . $e . "\n\\n\$queryUpdateIncidente:" . $queryUpdateIncidente;
            $arquivoLog = $this->geraLogExcecao("incidentes", "gravaIncidente", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p  style='font-size: 16px; font-weight: bold;'>Não foi possível registrar o incidente. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return json_encode($retorno);
        }
    }

    function deletaIncidente($numIntIssue) {
        $mat = $_SESSION['matricula'];
        $db = new Database('incidentes');
        $retorno = array();

        $queryConsultaId = "SELECT id FROM incidentes.incidente WHERE numIntIssue = '".$numIntIssue."'";
        $execQueryConsultaId = $db->DbGetAll($queryConsultaId);

        $queryDeletaIncidente = "UPDATE `incidentes`.`incidente` SET `matriculaDeleteIncidente` = '".$mat."', `dataHoraDelete` = current_timestamp(), `ativo` = '0' WHERE (`id` = '".$execQueryConsultaId[0]['id']."');";
        
        try {
            $execQueryDeletaIncidente = $db->DbQuery($queryDeletaIncidente);

            if($execQueryDeletaIncidente){
                $retorno["status"] = 1;
                $retorno["mensagem"] = 'Incidente '.$numIntIssue.' deletado com sucesso!';
            } else {
                $informacoesErro = "erro: " . $e . "\n\\n\$queryDeletaIncidente:" . $queryDeletaIncidente;
                $arquivoLog = $this->geraLogExcecao("incidentes", "deletaIncidente", $informacoesErro, $mat);
                $retorno["mensagem"] = "<p  style='font-size: 16px; font-weight: bold;'>Não foi possível deletar o incidente ".$numIntIssue.". Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                $retorno["status"] = 0;
            }
        } catch(Exception $e) {
            $informacoesErro = "erro: " . $e . "\n\\n\$queryDeletaIncidente:" . $queryDeletaIncidente;
            $arquivoLog = $this->geraLogExcecao("incidentes", "deletaIncidente", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p  style='font-size: 16px; font-weight: bold;'>Não foi possível deletar o incidente ".$numIntIssue.". Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return json_encode($retorno);
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