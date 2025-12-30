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
     * @param string $titulo
     * @param string $url
     * @return array|string[]
     */
    public function gravarFavorito(string $titulo, string $url): array
    {
        $mat = $_SESSION['matricula'] ?? null;
        $db = new Database('intranet');

        try {
            $db->DbQuery("START TRANSACTION;");

            $sql = sprintf(
                "INSERT INTO favoritos (matricula, titulo, url)
                VALUES ('%s', '%s', '%s');",
                addslashes($mat),
                addslashes($titulo),
                addslashes($url)
            );

            $db->DbQuery($sql);

            $id = $db->DbInsertId();

            $db->DbQuery("COMMIT;");

            return [
                'status' => 'sucesso',
                'id' => $id
            ];

        } catch (Exception $e) {
            $db->DbQuery("ROLLBACK;");

            $arquivo = $this->geraLogExcecao(
                "Favoritos",
                "gravarFavorito",
                $e->getMessage(),
                $mat
            );

            return [
                'status' => 'erro',
                'mensagem' => 'Erro ao salvar favorito',
                'log' => $arquivo
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

    case "gravarFavorito":

        $titulo = $_POST['titulo'] ?? null;
        $url = $_POST['url'] ?? null;

        $retorno = $class->gravarFavorito($titulo, $url);
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