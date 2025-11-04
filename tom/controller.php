<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

class funcoes
{

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $caminhoLogErro = $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
        $mat = $_SESSION['matricula'];
    }

    public function consultaIdConversa()
    {
        $mat = $_SESSION['matricula'];
        $db = new Database('formacaoBots');
        $query = "SELECT idConversa FROM logsBotsCad.logGuiaLinguagem WHERE usuario = '" . $mat . "' AND CURDATE() = date(timestamp) and ativo = 1 ORDER BY timestamp DESC LIMIT 1;";
        $retorno = array();
        try {
            $execQuery = $db->DbGetAll($query);
            if ($execQuery) {
                $retorno = $execQuery[0]['idConversa'];
            }
        } catch (Exception $e) {
            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("Consulta Contexto Bot Guia Linguagem", "consultaIdConversa", $informacoesErro, $mat);
            $retorno = "Erro ao gravar log. Arquivo: " . $arquivoLog . " - Matricula: " . $mat;
        } finally {
            return ($retorno);
        }
    }

    public function gravarConversa($idConversa, $idUsuario, $tipoInput, $inputUsuario, $respostaBot, $contextoConversa)
    {
        $mat = $_SESSION['matricula'];
        $db = new Database('formacaoBots');

        $inputUsuario = addslashes($inputUsuario);
        $respostaBot = addslashes($respostaBot);
        $contextoConversa = addslashes($contextoConversa);

        $query = "
            INSERT INTO `logsBotsCad`.`logGuiaLinguagem` (`idConversa`, `usuario`, `tipoInput`, `input`, `resposta_bot`, `contexto`) 
                VALUES ('" . $idConversa . "', '" . $mat . "', '" . $tipoInput . "', '" . $inputUsuario . "', '" . $respostaBot . "', '" . $contextoConversa . "');";
        try {
            $execQuery = $db->DbQuery($query);
            if ($execQuery) {
                $retorno["mensagem"] = 'Sucesso';
            }
        } catch (Exception $e) {
            $informacoesErro = "Erro: " . $e . "\n\n\$  : " . $query;
            $arquivoLog = $this->geraLogExcecao("Log Bot Guia Linguagem", "gravaConversa", $informacoesErro, $mat);
            $retorno = "Erro ao gravar log. Arquivo: " . $arquivoLog . " - Matricula: " . $mat;
        } finally {
            return ($retorno);
        }
    }

    public function consultarContexto()
    {
        $mat = $_SESSION['matricula'];
        $db = new Database('formacaoBots');
        $query = "
            SELECT contexto FROM logsBotsCad.logGuiaLinguagem WHERE usuario = '" . $mat . "' AND CURDATE() = date(timestamp) and ativo = 1 and tipoInput in ('Texto', 'Texto e Mídia') ORDER BY timestamp DESC LIMIT 1;
        ";
        $retorno = array();
        try {
            $execQuery = $db->DbGetAll($query);
            if ($execQuery) {
                $retorno = $execQuery[0]['contexto'];
            }
        } catch (Exception $e) {
            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("Consulta Contexto Bot Guia Linguagem", "consultarContexto", $informacoesErro, $mat);
            $retorno = "Erro ao gravar log. Arquivo: " . $arquivoLog . " - Matricula: " . $mat;
        } finally {
            return ($retorno);
        }
    }

    public function zerarContexto($idConversa)
    {
        $mat = $_SESSION['matricula'];
        $db = new Database('formacaoBots');
        $query = "
            UPDATE `logsBotsCad`.`logGuiaLinguagem` SET `ativo` = '0' WHERE (`idConversa` = '" . $idConversa . "');
        ";
        try {
            $execQuery = $db->DbGetAll($query);
            if ($execQuery) {
                $retorno = $execQuery[0]['contexto'];
            }
        } catch (Exception $e) {
            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("Consulta Contexto Bot Guia Linguagem", "consultarContexto", $informacoesErro, $mat);
            $retorno = "Erro ao gravar log. Arquivo: " . $arquivoLog . " - Matricula: " . $mat;
        } finally {
            return ($retorno);
        }
    }

    public function gravaCodigoResposta($nomeBot, $inputUsuario, $codResposta)
    {
        $mat = $_SESSION['matricula'];
        $db = new Database('logsBotsCad');

        $inputUsuarioTratado = addslashes($inputUsuario);

        $query = "INSERT INTO `logsBotsCad`.`logCodigosRespostas` (`nomeBot`, `matricula`, `input`, `codResposta`, `data`)
                VALUES ('" . $nomeBot . "', '" . $mat . "', '" . $inputUsuarioTratado . "', '" . $codResposta . "', curdate());";

        try {
            $execQuery = $db->DbQuery($query);
            if ($execQuery) {
                $retorno = 'Sucesso';
            }
        } catch (Exception $e) {
            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("Log Bot Guia Linguagem", "gravaCodigoResposta", $informacoesErro, $mat);
            $retorno = "Erro ao gravar log de código de erro. Arquivo: " . $arquivoLog . " - Matricula: " . $mat;
        } finally {
            return $retorno;
        }
    }

    public function geraLogExcecao($nomeApp, $nomeFuncao, $informacoesAdicionais, $mat)
    {
        $mat = $_SESSION['matricula'];
        $dateTime = date("Y-m-d") . "_" . date("H.i.s");
        $nomeArquivo = $dateTime . "_" . $mat . "_" . $nomeApp . "_" . $nomeFuncao . ".txt";
        $caminhoArquivo = $this->caminhoLogErro . "/" . $nomeArquivo;

        $strDataHora = print_r(new DateTime(), true);
        $strRequest = print_r($_REQUEST, true);
        $strSession = print_r($_SESSION, true);

        $strArquivo = "data:\n" . $strDataHora . "\n\$_REQUEST:\n" . $strRequest . "\n\$_SESSION:\n" . $strSession . "\n\$informacoesAdicionais:\n" . $informacoesAdicionais;

        file_put_contents($caminhoArquivo, $strArquivo);
        chmod($caminhoArquivo, 0777);

        return $caminhoArquivo;
    }

    public function gravaFeedbackTom($mensagem_bot, $comentario_usuario, $avaliacao, $nota = null)
    {
        $mat = $_SESSION['matricula'];
        $db = new Database('logsBotsCad');

        $mensagemTratada = addslashes($mensagem_bot);
        $comentarioTratado = addslashes($comentario_usuario);
        $avaliacaoTratada = (empty($avaliacao) || $avaliacao === 'nota') ? null : addslashes($avaliacao);
        $avaliacaoSql = $avaliacaoTratada !== null ? "'$avaliacaoTratada'" : "NULL";
        $notaSql = (!empty($nota) && is_numeric($nota)) ? "'$nota'" : "NULL";

        $query = "
            INSERT INTO `logsBotsCad`.`logFeedbackTom`
            (`mensagem_bot`, `matricula`, `comentario_usuario`, `avaliacao`, `nota`,`timestamp`)
            VALUES (
                '" . $mensagemTratada . "',
                '" . $mat . "',
                '" . $comentarioTratado . "',
                $avaliacaoSql,
                $notaSql,
                current_timestamp()
            );
        ";

        try {
            $execQuery = $db->DbQuery($query);
            if ($execQuery) {
                $retorno = ['status' => 'Sucesso'];
            }
        } catch (Exception $e) {
            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("Log Bot Tom", "gravaFeedbackTom", $informacoesErro, $mat);
            $retorno = [
                'status' => 'Erro',
                'mensagem' => "Erro ao gravar feedback. Arquivo: " . $arquivoLog . " - Matricula: " . $mat
            ];
        } finally {
            return $retorno;
        }
    }

}

$class = new funcoes();
$request = $_REQUEST["request"] ?? null;
$idConversa = $_POST["idConversa"] ?? null;
$idUsuario = $_POST["idUsuario"] ?? null;
$tipoInput = $_POST["tipoInput"] ?? null;
$inputUsuario = $_POST["inputUsuario"] ?? null;
$respostaBot = $_POST["respostaBot"] ?? null;
$contextoConversa = $_POST["contextoConversa"] ?? null;
$codResposta = $_POST['codResposta'] ?? null;
$nomeBot = $_POST['nomeBot'] ?? null;

if (!isset($_SESSION)) {
    session_start();
}
$mat = strtolower($_SESSION['matricula']);

switch ($request) {
    case "gravarConversa":
        $retorno = $class->gravarConversa($idConversa, $idUsuario, $tipoInput, $inputUsuario, $respostaBot, $contextoConversa);
        echo($retorno);
        break;

    case "consultarContexto":
        $retorno = $class->consultarContexto();
        echo json_encode($retorno);
        break;

    case "consultaIdConversa":
        $retorno = $class->consultaIdConversa();
        echo json_encode($retorno);
        break;

    case "zerarContexto":
        $retorno = $class->zerarContexto($idConversa);
        echo json_encode($retorno);
        break;

    case "gravaCodigoResposta":
        $retorno = $class->gravaCodigoResposta($nomeBot, $inputUsuario, $codResposta);
        echo json_encode($retorno);
        break;

    case "gravaFeedback":
        $mensagem_bot = $_POST['mensagem_bot'] ?? null;
        $comentario_usuario = $_POST['comentario_usuario'] ?? null;
        $avaliacao = $_POST['avaliacao'] ?? null;
        $nota = $_POST['nota'] ?? null;

        $retorno = $class->gravaFeedbackTom($mensagem_bot, $comentario_usuario, $avaliacao, $nota);
        echo json_encode($retorno);
        break;
}

?>