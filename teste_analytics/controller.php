<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

Class funcoes {

    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
        
        $caminhoLogErro = $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
        $mat = $_SESSION['matricula'];
    }

    public function gravarConversa($idConversa, $idUsuario, $inputUsuario, $respostaBot, $contextoConversa){
        $mat = $_SESSION['matricula'];
        $db = New Database('formacaoBots');

        $inputUsuario = addslashes($inputUsuario);
        $respostaBot = addslashes($respostaBot);
        $contextoConversa = addslashes($contextoConversa);

        $query = "
            INSERT INTO `formacaoBots`.`logConversas_testeAnalytics` (`idConversa`, `usuario`, `input`, `resposta_bot`, `contexto`) 
                VALUES ('".$idConversa."', '".$mat."', '".$inputUsuario."', '".$respostaBot."', '".$contextoConversa."');";
        try{
            $execQuery = $db->DbQuery($query);
            if($execQuery){
                $retorno["mensagem"] = 'Sucesso';
            }
        } catch(Exception $e){
            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("Log Conversa Bot Formação - Aula Analytics", "gravaConversa", $informacoesErro, $mat);
            $retorno = "Erro ao gravar log. Arquivo: " . $arquivoLog." - Matricula: ".$mat;
        } finally {
            return ($retorno);
        }
    }

    public function consultarContexto(){
        $mat = $_SESSION['matricula'];
        $db = New Database('formacaoBots');
        $query = "
            SELECT contexto FROM formacaoBots.logConversas_testeAnalytics WHERE usuario = '".$mat."' AND CURDATE() = date(timestamp) ORDER BY timestamp DESC LIMIT 1;
        ";
        try{
            $execQuery = $db->DbGetAll($query);
            if($execQuery){
                $retorno = $execQuery[0]['contexto'];
            }
        } catch(Exception $e){
            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("Consulta Contexto Bot Formação - Aula Analytics", "consultarContexto", $informacoesErro, $mat);
            $retorno = "Erro ao gravar log. Arquivo: " . $arquivoLog." - Matricula: ".$mat;
        } finally {
            return ($retorno);
        }
    }

    public function geraLogExcecao($nomeApp, $nomeFuncao, $informacoesAdicionais, $mat){
        $mat = $_SESSION['matricula'];
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

$class = new funcoes();
$request = $_REQUEST["request"];
$idConversa = $_POST["idConversa"];
$idUsuario = $_POST["idUsuario"];
$inputUsuario = $_POST["inputUsuario"];
$respostaBot = $_POST["respostaBot"];
$contextoConversa = $_POST["contextoConversa"];

if(!isset($_SESSION)){
    session_start();
}
$mat = strtolower($_SESSION['matricula']);

switch($request){
    case "gravarConversa":
        $retorno = $class->gravarConversa($idConversa, $idUsuario, $inputUsuario, $respostaBot, $contextoConversa);
        echo ($retorno);
    break;

    case "consultarContexto":
        $retorno = $class->consultarContexto();
        echo json_encode($retorno);
    break;
}

?>