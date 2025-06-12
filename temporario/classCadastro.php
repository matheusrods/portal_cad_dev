<?php
// ini_set("display_errors", E_ALL);
// ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";

Class funcoes {

    public $mat;

    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
        $mat = $_SESSION['matricula'];
        $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
    }

    public function gravaTexto($titulo, $texto, $url, $squad, $dataIni, $dataFim, $vigente, $falhaCad, $ferramentaTicket, $numeroTicket, $tipoReport, $mat){
        $campos = '';
        
        $retorno = array();
        if($tipoReport == 'destaques'){
            $campos = "`texto`, `squad`, `data`, `url`";
            $valores = "'".$texto."', '".$squad."', '".$dataIni."', '".$url."'";
        }
        
        if($tipoReport == 'indisponibilidades'){
            $campos = "`titulo`, `texto`, `dataInicio`, `vigente`, `falhaCad`";
            $valores = "'".$titulo."','".$texto."', '".$dataIni."', '".$vigente."', '".$falhaCad."'";
            
            if($vigente == 0){
                $campos = $campos.", `dataFim`, `timestampEncerramento`, `matriculaEncerramento`";
                $valores = $valores.", '".$dataFim."', now(), '".$mat."'";
            }

            if($falhaCad == 1){
                $campos = $campos.", `ferramentaTicket`, `numeroTicket`";
                $valores = $valores.", '".$ferramentaTicket."', '".$numeroTicket."'";
            }
        }
        
        if($tipoReport == 'noticias'){
            $campos = "`texto`, `url`, `data`";
            $valores = "'".$texto."', '".$url."', '".$dataIni."'";
        }
        
        $db = new Database("report");
        $query = "INSERT INTO `report`.`".$tipoReport."` (".$campos.", `matricula`) VALUES (".$valores.", '".$mat."');";
        
        try{
            $insert = $db->DbQuery($query);
            if($insert){
                $retorno["status"] = 1;
                $retorno["mensagem"] = "Conteúdo do report adicionado com sucesso!";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("gravaTexto", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível adicionar o conteúdo do report. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            return json_encode($retorno);
        }
    }

    public function gravaDataFimIndisp($idIndisp, $textoTituloEditaIndisp, $textoDescricaoEditaIndisp, $dataFim, $mat){
        $db = New Database("report");
        // strlen($dataFim > 0) ? $vigente = 0 : $vigente = 1;
        // $query = "UPDATE `report`.`indisponibilidades` SET `dataFim` = '".$dataFim."', `vigente`='0', `matriculaEncerramento`='".$mat."', `timestampEncerramento` = now() WHERE (`id` = '".$idIndisp."');";
        if(strlen($dataFim > 0)){
            $campos = ", `dataFim` = '".$dataFim."', `vigente`='0', `matriculaEncerramento`='".$mat."', `timestampEncerramento` = now()";
        }
        
        $query = "UPDATE `report`.`indisponibilidades` SET `titulo` = '".$textoTituloEditaIndisp."', `texto` = '".$textoDescricaoEditaIndisp."'".$campos." WHERE (`id` = '".$idIndisp."');";
        
        try{
            $execQuery = $db->DbQuery($query);
            if($execQuery){
                $retorno["status"] = 1;
                if(strlen($dataFim > 0)){
                    $retorno["mensagem"] = "Final da indisponibilidade gravado com sucesso!";
                } else {
                    $retorno["mensagem"] = "Indisponibilidade editada com sucesso!";
                }
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("gravaDataFimIndisp", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível encerrar a indisponibilidade ativa. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            return json_encode($retorno);
        }
    }

    public function consultaIndispAtivas(){
        $db = New Database("report");
        $retorno = array();
        
        $query = "SELECT * FROM report.indisponibilidades WHERE vigente = 1 OR dataFim = CURDATE() or date(timestampEncerramento) = CURDATE();";
        
        try{
            $execQuery = $db->DbGetAll($query);
            $size = sizeof($execQuery);
            if($execQuery){
                if($size > 0){
                    $retorno = $execQuery;
                } else {
                    $retorno = 0;
                }
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("consultaIndispAtivas", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível consultar as indisponibilidades ativas. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            return $retorno;
        }
    }

    public function verificaIndisponibilidade7dias(){
        $mat = $_SESSION['matricula'];
        $db = New Database("report");
        $retorno = array();
        
        $query = "SELECT * FROM report.indisponibilidades WHERE (vigente = 1 OR dataFim = null) and datediff(CURDATE(), dataInicio) >= 7;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            $size = count($execQuery);
            if($execQuery){
                if($size > 0){
                    $retorno = 1;
                } else {
                    $retorno = 0;
                }
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("verificaIndisponibilidade7dias", $informacoesErro, $mat);
            $retorno = "Não foi possível consultar as indisponibilidades ativas há 7 dias ou mais. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            return $retorno;
        }
    }

    public function consultaHistIndisp(){
        $db = New Database("report");
        $retorno = array();
        
        $query = "SELECT * FROM report.indisponibilidades;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            $size = sizeof($execQuery);
            if($execQuery){
                if($size > 0){
                    for($i=0; $i < $size; $i++){
                        $dadosHistIndisp = $dadosHistIndisp.'<tr val="'.$execQuery[$i]['id'].'"><td>'.$execQuery[$i]['id'].'</td><td val="'.$execQuery[$i]['id'].'">'.$execQuery[$i]['titulo'].'</<td><td val="'.$execQuery[$i]['id'].'">'.$execQuery[$i]['texto'].'</<td><td>'.$execQuery[$i]['dataInicio'].'</td><td id="tdDataFim_'.$execQuery[$i]['id'].'">'.$execQuery[$i]['dataFim'].'</td></tr>';
                    }
                } else {
                    $dadosHistIndisp = "<tr><td>-</td><td>-</<td><td>-</td><td>-</td></tr>";
                }
                $retorno = $dadosHistIndisp;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("consultaHistIndisp", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível consultar o histórico de indisponibilidades. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            return ($retorno);
        }
    }

    public function consultaHistNoticias(){
        $db = New Database("report");
        $retorno = array();
        
        $query = "SELECT * FROM report.noticias;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            $size = sizeof($execQuery);
            if($execQuery){
                if($size > 0){
                    for($i=0; $i < $size; $i++){
                        $dadosHistNoticias = $dadosHistNoticias.'<tr val="'.$execQuery[$i]['id'].'"><td>'.$execQuery[$i]['id'].'</td><td val="'.$execQuery[$i]['id'].'">'.$execQuery[$i]['texto'].'</<td><td><a href="'.$execQuery[$i]['url'].'" target="_blank">'.$execQuery[$i]['url'].'</a></td><td id="tdData_'.$execQuery[$i]['id'].'">'.$execQuery[$i]['data'].'</td></tr>';
                    }
                } else {
                    $dadosHistNoticias = "<tr><td>-</td><td>-</<td><td>-</td><td>-</td></tr>";
                }
                $retorno = $dadosHistNoticias;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("consultaHistNoticias", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível consultar o histórico de Notícias. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            return ($retorno);
        }
    }

    public function consultaHistDestaques(){
        $db = New Database("report");
        $retorno = array();
        
        $query = "  SELECT 
                        a.*, 
                        b.squad as nomeSquad
                    FROM report.destaques as a
                    LEFT JOIN cad.squads b ON a.squad = b.id;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            $size = sizeof($execQuery);
            if($execQuery){
                if($size > 0){
                    // Monta tabela com o histórico dos Destaques
                    for($i=0; $i < $size; $i++){
                        $dadosHistDestaques = $dadosHistDestaques.'<tr val="'.$execQuery[$i]['id'].'"><td>'.$execQuery[$i]['id'].'</td><td val="'.$execQuery[$i]['id'].'">'.$execQuery[$i]['texto'].'</<td><td val="'.$execQuery[$i]['id'].'">'.$execQuery[$i]['url'].'</<td><td>'.$execQuery[$i]['nomeSquad'].'</td><td>'.$execQuery[$i]['data'].'</td></tr>';
                    }
                } else {
                    $dadosHistDestaques = "<tr><td>-</td><td>-</td><td>-</<td><td>-</td><td>-</td></tr>";
                }                  
                $retorno = $dadosHistDestaques;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("consultaHistDestaques", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível consultar o histórico de Destaques. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            return ($retorno);
        }
    }

    public function editarIndisponibilidade($idIndisp){
        $db = New Database("report");
        $query = "SELECT id, matricula, titulo, texto, dataInicio, DATE_FORMAT(dataInicio, '%d/%m/%Y') AS dataIniFormat, dataFim FROM report.indisponibilidades WHERE id = $idIndisp;";

        try{
            $execQuery = $db->DbGetAll($query);
            $table = '
                <table id="tableEditIndisp">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Indisponibilidade</th>
                        <th>Data Início</th>
                        <th>Data Fim</th>
                    </tr>
                    <tr>
                        <td>'.$execQuery[0]['id'].'</td>
                        <td><textarea id="textoTituloEditaIndisp" maxlength="100">'.$execQuery[0]['titulo'].'</textarea></td>
                        <td><textarea id="textoDescricaoEditaIndisp" maxlength="200">'.$execQuery[0]['texto'].'</textarea></td>
                        <td id="dataIni" attr-dataIni="'.$execQuery[0]['dataInicio'].'">'.$execQuery[0]['dataIniFormat'].'</td>
                        <td><input type="date" id="dataFimEdit" idIndisp="'.$execQuery[0]['id'].'" max="'.date("Y-m-d").'" value="'.$execQuery[0]['dataFim'].'" /></td>
                    </tr>
                </table>';
            if($execQuery){
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $table;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("editarIndisponibilidade", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível abrir a Indisponibilidade ID ".$idIndisp." para edição. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            return json_encode($retorno);
        }
    }

    public function consultaSquads(){
        $db = new Database("report");
        $query = "SELECT * FROM cad.squads WHERE ativo = 1;";
        $execQuery = $db->DbGetAll($query);

        if($db->erro != ""){
            $retorno["status"] = 0;
            $retorno["mensagem"] = "Ocorreu um erro ao consultar as Squads.\nDetalhes do erro: " . $informacoesErro;
        } else {
            $retorno = $execQuery;
        }

        return $retorno;
    }

    public function consultaTiposReport(){
        $db = new Database("report");
        $query = "SELECT * FROM report.tiposReport WHERE ativo = 1 order by ordem ASC;";
        $execQuery = $db->DbGetAll($query);

        if($db->erro != ""){
            $informacoesErro = "\n\$db->erro: " . $db->erro . "\n\$query: " . $query;
            $retorno["status"] = 0;
            $retorno["mensagem"] = "Ocorreu um erro ao consultar os tipos de texto.\nDetalhes do erro: " . $informacoesErro;
        } else {
            $retorno = $execQuery;
        }
        return $retorno;
    }

    public function geraLogExcecao($nomeFuncao, $informacoesAdicionais, $mat){
        $dateTime = date("Y-m-d")."_". date("H.i.s");
        $nomeArquivo = $dateTime . "_" . $mat . "_" . $nomeFuncao .".txt";
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