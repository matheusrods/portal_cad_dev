<?php

session_start();

if($_SESSION["nome"] == ""){
    header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=https://cad.bb.com.br/teste_versionamento/#login/");
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
    
        foreach ($logData as $key => $value) {
            $logData[$key] = addslashes($value);
        }
    
        $query = "
            INSERT INTO `logs` (`matricula`, `inputs_testados`, `total_diferencas`, `total_erros`, `diferencas`, `erros`) 
                VALUES ('".$mat."', '".$logData['inputsTestados']."', '".$logData['totalDiferencas']."', '".$logData['totalErros']."', '".$logData['diferencas']."', '".$logData['erros']."');";
        try {
            $execQuery = $db->DbQuery($query);
            if($execQuery){
                $retorno["mensagem"] = 'Sucesso';
                $retorno["id_log"] = $db->DbGetOne('SELECT id FROM testes.logs ORDER BY id DESC LIMIT 1;');
                // echo ($retorno["id_log"]);
            }
        } catch(Exception $e){
            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $query;
            $retorno = "Erro ao salvar log. Arquivo: " . $arquivoLog;
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
    default:
        $retorno = ["mensagem" => "Ação não reconhecida"];
}

echo json_encode($retorno);
exit;
?>