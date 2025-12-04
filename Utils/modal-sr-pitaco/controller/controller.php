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

    /**
     * @param $nomeApp
     * @param $nomeFuncao
     * @param $informacoesAdicionais
     * @param $mat
     * @return string
     */
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

    /**
     * @param $nota
     * @param $motivos
     * @param $comentario
     * @param $tela
     * @return array|string[]
     */
    public function gravaFeedbackSrPitaco($nota, $motivos, $comentario = null, $tela = null): array
    {
        $mat = $_SESSION['matricula'];
        $db = new Database('intranet');

        try {

            $db->DbQuery("START TRANSACTION;");

            $id_item = $id_subitem = "NULL";
            if (!empty($tela) && $tela !== 'Portal') {
                $sqlBusca = "
                    SELECT i.id AS id_item, s.id AS id_subitem
                    FROM cabecalho_item i
                    LEFT JOIN cabecalho_subitem s ON s.vinculoItem = i.id and s.ativo = 1
                    WHERE i.nomePaginaInterna = '$tela' OR s.url = '$tela'
                    LIMIT 1;
                ";
                $resultado = $db->DbGetRow($sqlBusca);
                if (!empty($resultado)) {
                    $id_item = !empty($resultado['id_item']) ? (int)$resultado['id_item'] : "NULL";
                    $id_subitem = !empty($resultado['id_subitem']) ? (int)$resultado['id_subitem'] : "NULL";
                }
            } else {
                $id_item = "NULL";
                $id_subitem = "NULL";
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

    /**
     * @param $tela
     * @return array
     */
    public function getnomePaginaAtual($tela): array
    {
        $mat = $_SESSION['matricula'];
        $db = new Database('intranet');

        try {

            $queryItem = "
                SELECT ci.item 
                FROM cabecalho_item ci
                WHERE ci.tipo = 2 
                AND ci.nomePaginaInterna = '$tela' 
                AND ci.ativo = 1;
            ";

            $item = $db->DbGetRow($queryItem);

            if (!empty($item)) {
                return [
                    'status' => 1,
                    'nome' => $item['item']
                ];
            }

            $querySub = "
                SELECT cs.subitem 
                FROM cabecalho_subitem cs
                WHERE cs.ativo = 1 
                AND cs.url = '$tela';
            ";

            $subitem = $db->DbGetRow($querySub);

            if (!empty($subitem)) {
                return [
                    'status' => 1,
                    'nome' => $subitem['subitem']
                ];
            }

            return [
                'status' => 0,
                'nome' => null
            ];

        } catch (Exception $e) {

            $info = "Erro ao buscar nome da página atual.\n" .
                "Tela: $tela\n" .
                "Erro: " . $e->getMessage();

            $arquivoLog = $this->geraLogExcecao(
                "SrPitaco",
                "getnomePaginaAtual",
                $info,
                $mat
            );

            return [
                'status' => -1,
                'erro' => $e->getMessage(),
                'log' => $arquivoLog
            ];
        }
    }

    /**
     * Retorna os motivos disponíveis para a nota escolhida
     * (utilizando a tabela de relacionamento motivoNotaFeedbackPortal)
     *
     * @param int $nota
     * @return array
     */
    public function getMotivosPorNota(int $nota): array
    {
        $mat = $_SESSION['matricula'];
        $db = new Database('intranet');

        try {
            $sql = "
                SELECT m.id_motivo AS id, m.descricao
                FROM motivoNotaFeedbackPortal mn
                INNER JOIN motivoFeedbackPortal m 
                        ON m.id_motivo = mn.id_motivo
                WHERE mn.id_nota = $nota
                ORDER BY 
                CASE 
                    WHEN m.descricao = 'Outro motivo' THEN 1
                    ELSE 0
                END;
            ";

            $motivos = $db->DbGetAll($sql);

            return [
                'status' => 1,
                'motivos' => $motivos
            ];

        } catch (Exception $e) {

            $infoErro = "Erro ao buscar motivos da nota.\n" .
                "Nota: $nota\n" .
                "Erro: " . $e->getMessage();

            $arquivoLog = $this->geraLogExcecao(
                "SrPitaco",
                "getMotivosPorNota",
                $infoErro,
                $mat
            );

            return [
                'status' => 0,
                'erro' => "Erro ao buscar motivos. Log: $arquivoLog",
                'motivos' => []
            ];
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


    case "getnomePaginaAtual":
        $tela = $_REQUEST['tela'] ?? null;

        $retorno = $class->getnomePaginaAtual($tela);
        echo json_encode($retorno);
        break;


    case "getMotivosPorNota":
        $nota = intval($_REQUEST['nota'] ?? 0);
        $retorno = $class->getMotivosPorNota($nota);
        echo json_encode($retorno);
        break;


    default:
        echo json_encode([
            'status' => 0,
            'erro' => "Requisição inválida",
            'request' => $request
        ]);
        break;
}