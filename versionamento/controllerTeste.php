<?php

session_start();

if($_SESSION["nome"] == ""){
    header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=https://cad.bb.com.br/ferramentas/versionamento/#login/");
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

class Funcoes {

    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
        
        $caminhoLogErro = $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
        $mat = $_SESSION['matricula'];
    }

    public function salvarLog($logData) {

        $db = new Database('testes');
        $mat = $_SESSION['matricula'];
        $tabela = $logData['tabela'];
        $query = "";
    
        foreach ($logData as $key => $value) {
            $logData[$key] = addslashes($value);
        }

        switch($tabela){
            case "logs_parenteses":
                $query = "
                INSERT INTO `logs_parenteses` (`matricula`, `versao`, `deu_erro`, `nos_com_problema`) 
                    VALUES ('".$mat."', '".$logData['versao']."', '".$logData['deuErro']."', '".$logData['nosComProblema']."');";
                break;
            case "logs_versionamento":
                $query = "
                INSERT INTO `logs` (`matricula`, `inputs_testados`, `total_diferencas`, `total_erros`, `diferencas`, `erros`) 
                    VALUES ('".$mat."', '".$logData['inputsTestados']."', '".$logData['totalDiferencas']."', '".$logData['totalErros']."', '".$logData['diferencas']."', '".$logData['erros']."');";
                break;
            default:
                $retorno = ["mensagem" => "Ação não reconhecida"];
                return ($retorno);
        }

        try {
            $execQuery = $db->DbQuery($query);
            if($execQuery){
                $retorno["mensagem"] = 'Sucesso';
                // $retorno["id_log"] = $db->DbGetOne('SELECT id FROM testes.logs ORDER BY id DESC LIMIT 1;');
                // echo ($retorno["id_log"]);
            }
        } catch(Exception $e){
            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $query;
            $retorno = "Erro ao salvar log. Arquivo: " . $arquivoLog;
        } finally {
            return ($retorno);
        }
    }

    public function recuperarLog($logData) {

        $db = new Database('testes');
        $mat = $_SESSION['matricula'];
        $tabela = $logData['tabela'];
        $query = ""

        switch($tabela){
            case "logs_parenteses":
                $query = "SELECT * FROM testes.logs_parenteses WHERE versao ='".$logData["versao"]."' ORDER BY data_hora DESC LIMIT 1;";
                break;
            case "logs_versionamento":
                $query = "SELECT * FROM testes.logs WHERE versao ='".$logData["versao"]."' ORDER BY data_hora DESC LIMIT 1;";
                break;
            default:
                $retorno = ["mensagem" => "Ação não reconhecida"];
                return ($retorno);
        }
    
        try {
            $execQuery = $db->DbGetRow($query);
            if($execQuery){
                $retorno = ['dados' => $execQuery];
                $retorno["mensagem"] = 'Sucesso';
            }
        } catch(Exception $e){
            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $query;
            $retorno = "Erro ao recuperar log. Arquivo: " . $arquivoLog;
        } finally {
            return ($retorno);
        }
    }
}

$inputJSON = file_get_contents("php://input");
$logData = json_decode($inputJSON, true);

if (!$logData) {
    echo json_encode(["mensagem" => "Dados inválidos"]);
    exit;
}

$request = $logData["request"] ?? null;

$class = new Funcoes();
$retorno = ["mensagem" => "Nenhuma ação realizada"];

switch ($request) {
    case "salvarLog":
        $retorno = $class->salvarLog($logData);
        break;
    case "recuperarLog":
        $retorno = $class->recuperarLog($logData);
        break;
    default:
        $retorno = ["mensagem" => "Ação não reconhecida"];
}

echo json_encode($retorno);
exit;
?>