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

    public function geraLogExcecao($nomeApp, $nomeFuncao, $informacoesAdicionais, $mat)
    {
        $mat = $_SESSION['matricula'];
        $dateTime = date("Y-m-d") . "_" . date("H.i.s");
        $nomeArquivo = $dateTime . "_" . $mat . "_" . ($nomeApp ?? '') . "_" . ($nomeFuncao ?? '') . ".txt";
        $caminhoArquivo = $this->caminhoLogErro . "/" . $nomeArquivo;

        $strDataHora = print_r(new DateTime(), true);
        $strRequest = print_r($_REQUEST, true);
        $strSession = print_r($_SESSION, true);

        $strArquivo = "data:\n" . $strDataHora . "\n\$_REQUEST:\n" . $strRequest . "\n\$_SESSION:\n" . $strSession . "\n\$informacoesAdicionais:\n" . $informacoesAdicionais;

        file_put_contents($caminhoArquivo, $strArquivo);
        chmod($caminhoArquivo, 0777);

        return $caminhoArquivo;
    }

   public function gravaFeedbackSrPitaco($nota, $motivos, $comentario = null, $tela = null)
    {
        $mat = $_SESSION['matricula'];
        $db = new Database('intranet');

        try {
            
            $db->DbQuery("START TRANSACTION;");

            $id_item = $id_subitem = "NULL";
            if (!empty($tela)) {
                $sqlBusca = "
                    SELECT i.id AS id_item, s.id AS id_subitem
                    FROM cabecalho_item i
                    LEFT JOIN cabecalho_subitem s ON s.vinculoItem = i.id
                    WHERE i.nomePaginaInterna = '$tela' OR s.url = '$tela'
                    LIMIT 1;
                ";
                $resultado = $db->DbGetRow($sqlBusca);
                if (!empty($resultado)) {
                    $id_item = !empty($resultado['id_item']) ? (int)$resultado['id_item'] : "NULL";
                    $id_subitem = !empty($resultado['id_subitem']) ? (int)$resultado['id_subitem'] : "NULL";
                }
            }

            $sqlFeedback = sprintf(
                "INSERT INTO logFeedbackPortal (matricula, id_nota, comentario, id_item, id_subitem, timestamp)
                 VALUES ('%s', %d, %s, %s, %s, CURRENT_TIMESTAMP);",
                $mat,
                (int)($nota ?? 0),
                !empty($comentario) ? ("'" . addslashes($comentario) . "'") : "NULL",
                $id_item,
                $id_subitem
            );
            $db->DbQuery($sqlFeedback);

            $idFeedback = $db->DbInsertId();

            if (!empty($motivos) && is_array($motivos)) {
                foreach ($motivos as $idMotivo) {
                    $sqlMotivo = sprintf(
                        "INSERT INTO logFeedbackMotivo (id_feedback, id_motivo)
                         VALUES (%d, %d);",
                        $idFeedback,
                        (int)$idMotivo
                    );
                    $db->DbQuery($sqlMotivo);
                }
            }

            $db->DbQuery("COMMIT;");
            return ['status' => 'sucesso', 'id_feedback' => $idFeedback];

        } catch (Exception $e) {
            $db->DbQuery("ROLLBACK;");
            $arquivo = $this->geraLogExcecao("FeedbackPortal", "gravaFeedbackSrPitaco", $e->getMessage());
            return ['status' => 'erro', 'mensagem' => "Erro ao gravar feedback. Log: $arquivo"];
        }
    }

}

$class = new funcoes();
$request = $_REQUEST["request"] ?? null;

if (!isset($_SESSION)) {
    session_start();
}
$mat = strtolower($_SESSION['matricula']);

switch ($request) {
    case "gravaFeedbackSrPitaco":
        $comentario = $_POST['comentario'] ?? null;
        $motivos = $_POST['motivos'] ?? null;
        $nota = $_POST['nota'] ?? null;
        $tela = $_POST['tela'] ?? null;

        $retorno = $class->gravaFeedbackSrPitaco($nota, $motivos, $comentario, $tela);
        echo json_encode($retorno);
        break;
}

?>