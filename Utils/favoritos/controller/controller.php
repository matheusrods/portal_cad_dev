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
            $sqlExiste = sprintf(
                "SELECT 1 
                FROM favoritos 
                WHERE matricula = '%s' 
                AND LOWER(titulo) = LOWER('%s')
                LIMIT 1;",
                addslashes($mat),
                addslashes($titulo)
            );

            $existe = $db->DbGetRow($sqlExiste);

            if ($existe) {
                return [
                    'status' => 'erro',
                    'mensagem' => 'Já existe um favorito com esse título.'
                ];
            }

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

    public function listarFavoritos(int $pagina = 1, int $limite = 10, ?string $busca = null): array
    {
        $mat = $_SESSION['matricula'] ?? null;
        $db = new Database('intranet');

        $offset = ($pagina - 1) * $limite;

        $whereBusca = '';
        if ($busca) {
            $busca = addslashes($busca);
            $whereBusca = "AND (titulo LIKE '%$busca%' OR url LIKE '%$busca%')";
        }

        $sqlTotal = sprintf(
            "SELECT COUNT(*) AS total 
            FROM favoritos 
            WHERE matricula = '%s' %s",
            addslashes($mat),
            $whereBusca
        );

        $total = (int)$db->DbGetRow($sqlTotal)['total'];

        $sql = sprintf(
            "SELECT id, titulo, url
            FROM favoritos
            WHERE matricula = '%s' %s
            ORDER BY timestamp DESC
            LIMIT %d OFFSET %d",
            addslashes($mat),
            $whereBusca,
            $limite,
            $offset
        );

        $dados = $db->DbGetAll($sql);

        return [
            'status' => 'sucesso',
            'dados' => $dados,
            'total' => $total,
            'pagina' => $pagina,
            'limite' => $limite
        ];
    }

    /**
     * @param int $id
     * @param string $titulo
     * @param string $url
     * @return array
     */
    public function editarFavorito(int $id, string $titulo, string $url): array
    {
        $mat = $_SESSION['matricula'] ?? null;
        $db = new Database('intranet');

        try {

            $sqlExiste = sprintf(
                "SELECT 1 
                FROM favoritos 
                WHERE matricula = '%s'
                AND LOWER(titulo) = LOWER('%s')
                AND id <> %d
                LIMIT 1;",
                addslashes($mat),
                addslashes($titulo),
                (int)$id
            );

            $existe = $db->DbGetRow($sqlExiste);

            if ($existe) {
                return [
                    'status' => 'erro',
                    'mensagem' => 'Já existe um favorito com esse título.'
                ];
            }

            $db->DbQuery("START TRANSACTION;");

            $sql = sprintf(
                "UPDATE favoritos
                SET titulo = '%s',
                    url = '%s'
                WHERE id = %d
                AND matricula = '%s';",
                addslashes($titulo),
                addslashes($url),
                (int)$id,
                addslashes($mat)
            );

            $db->DbQuery($sql);

            $db->DbQuery("COMMIT;");

            return [
                'status' => 'sucesso'
            ];

        } catch (Exception $e) {
            $db->DbQuery("ROLLBACK;");

            $arquivo = $this->geraLogExcecao(
                "Favoritos",
                "editarFavorito",
                $e->getMessage(),
                $mat
            );

            return [
                'status' => 'erro',
                'mensagem' => 'Erro ao atualizar favorito',
                'log' => $arquivo
            ];
        }
    }

    /**
     * @param int $id
     * @return array
     */
    public function excluirFavorito(int $id): array
    {
        $mat = $_SESSION['matricula'] ?? null;
        $db = new Database('intranet');

        try {
            $db->DbQuery("START TRANSACTION;");

            $sql = sprintf(
                "DELETE FROM favoritos
                WHERE id = %d
                AND matricula = '%s';",
                (int)$id,
                addslashes($mat)
            );

            $db->DbQuery($sql);

            $db->DbQuery("COMMIT;");

            return [
                'status' => 'sucesso'
            ];

        } catch (Exception $e) {
            $db->DbQuery("ROLLBACK;");

            $arquivo = $this->geraLogExcecao(
                "Favoritos",
                "excluirFavorito",
                $e->getMessage(),
                $mat
            );

            return [
                'status' => 'erro',
                'mensagem' => 'Erro ao excluir favorito',
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

    case "listarFavoritos":
        $pagina = intval($_POST['pagina'] ?? 1);
        $limite = intval($_POST['limite'] ?? 10);
        $busca = $_POST['busca'] ?? null;

        echo json_encode(
            $class->listarFavoritos($pagina, $limite, $busca)
        );
        break;

    case 'editarFavorito':
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $url = $_POST['url'];
        echo json_encode($class->editarFavorito($id, $titulo, $url));
        break;

    case 'excluirFavorito':
        $id = intval($_POST['id'] ?? 0);
        echo json_encode($class->excluirFavorito($id));
        break;


    default:
        echo json_encode([
            'status' => 0,
            'erro' => "Requisição inválida",
            'request' => $request
        ]);
        break;
}