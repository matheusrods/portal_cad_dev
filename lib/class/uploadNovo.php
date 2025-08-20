<?php 

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

session_start();

ini_set('display_startup_errors', 1);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

$geraLog = new geraLog();
$mat = $_SESSION['matricula'];

$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$idTema = $_POST['idTema'];
$dtEstudoPesquisa = $_POST['dtEstudoPesquisa'];
$tipoDocumento = $_POST['tipoDocumento'];

$db = new Database('estudosPesquisas');

$dataPorEscrito = strftime('%h/%Y', strtotime($dtEstudoPesquisa));
$dataPorEscritoEditada = ucfirst($dataPorEscrito);

$query = "INSERT INTO `estudosPesquisas`.`estudosPesquisas` (`titulo`, `subtitulo`, `tema`, `dtEstudoPesquisa`, `tipo`) VALUES ('".$titulo." - ".$dataPorEscritoEditada."', '".$descricao."', '".$idTema."', '".$dtEstudoPesquisa."-01', '".$tipoDocumento."');";

$retorno = array();

try{
    $execQuery = $db->DbQuery($query);
    
    if($execQuery){
        $queryUltimoId = "SELECT idEstudo FROM estudosPesquisas.estudosPesquisas ORDER BY idEstudo DESC LIMIT 1;";

        try {
            $execQueryUltimoId = $db->DbGetAll($queryUltimoId);

            if($execQueryUltimoId){
                $pdfName = $_FILES['pdf']['name'];
                $pdfTmpName = $_FILES['pdf']['tmp_name'];
                $pngName = $_FILES['png']['name'];
                $pngTmpName = $_FILES['png']['tmp_name'];

                // Salvando os arquivos
                $pdfDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/estudosPesquisas/arquivos/'.$execQueryUltimoId[0]['idEstudo'].'.pdf';
                $pngDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/estudosPesquisas/arquivos/'.$execQueryUltimoId[0]['idEstudo'].'.png';

                move_uploaded_file($pdfTmpName, $pdfDestination);
                move_uploaded_file($pngTmpName, $pngDestination);


                if(file_exists($pdfDestination)){
                    if(file_exists($pngDestination)){
                        if($tipoDocumento == 'estudos'){
                            $mensagemSucesso = "Seu estudo foi incluído com sucesso!";
                        }else if($tipoDocumento == 'pesquisas'){
                            $mensagemSucesso = "Sua pesquisa foi incluída com sucesso!";
                        }
                        $retorno['status'] = 1;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                    } else {
                        $informacoesErro = "Erro: Arquivo " . $execQueryUltimoId[0]["idEstudo"].".png não encontrado em ".$pngDestination."\n\nSintoma: Registrou o estudo/pesquisa no BD, subiu o arquivo PDF mas não o arquivo PNG.\n\nSolução: verificar pasta dos arquivos para confirmar ausência do arquivo PNG. Em caso positivo, incluir manualmente o arquivo ou excluir registro do banco de dados e o arquivo PDF.";
                        $arquivoLog = $geraLog->geraLogExcecao("estudosPesquisas", "paginaAdicionaEstudoPesquisa", $informacoesErro, $mat);
                        $retorno['status'] = 0;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                    }
                } else {
                    $informacoesErro = "Erro: Arquivo " . $execQueryUltimoId[0]["idEstudo"].".pdf não encontrado em ".$pdfDestination."\n\nSintoma: Registrou o estudo/pesquisa no BD, mas não subiu nenhum arquivo.\n\nSolução: verificar pasta dos arquivos para confirmar ausência dos mesmos. Em caso positivo, incluir manualmente os arquivos ou excluir registro do banco de dados.";
                    $arquivoLog = $geraLog->geraLogExcecao("estudosPesquisas", "paginaAdicionaEstudoPesquisa", $informacoesErro, $mat);
                    $retorno['status'] = 0;
                    $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                }
            } else {
                $informacoesErro = "Erro: Gravou no BD mas não capturou o último registro e não subiu nenhum arquivo. \n\n Query:" . $queryUltimoId ."\n\nSintoma: Registrou o estudo/pesquisa no BD, mas não subiu nenhum arquivo.\n\nSolução: verificar pasta dos arquivos para confirmar ausência dos mesmos. Em caso positivo, incluir manualmente os arquivos ou excluir registro do banco de dados.";;
                $arquivoLog = $geraLog->geraLogExcecao("estudosPesquisas", "paginaAdicionaEstudoPesquisa", $informacoesErro, $mat);
                $retorno['status'] = 0;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                // return json_encode($retorno);
            }

        } catch(Exception $e) {
            $informacoesErro = "Erro: " . $e . "\n\n\$query:" . $queryUltimoId . "\n\nSintoma: Gravou os dados de ".$tipoDocumento.", mas não conseguiu fazer upload dos arquivos.\n\nSolução: consultar na tabela 'estudosPesquisas.estudosPesquisas' o ID do último registro, verificar a pasta dos arquivos para confirmar ausência dos mesmos (os arquivos devem ter o nome 'nº_do_ID.pdf' e 'nº_do_ID.png' (por exemplo, para o ID 01, os arquivos são 01.pdf e 01.png). Caso os arquivos realmente não estejam na pasta, incluir manualmente os arquivos ou excluir o registro do banco de dados.";
            $arquivoLog = $geraLog->geraLogExcecao("estudosPesquisas", "paginaAdicionaEstudoPesquisa", $informacoesErro, $mat);
            $retorno['status'] = 0;
            $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            // return json_encode($retorno);
        }
    } else {
        $informacoesErro = "Erro: Não inseriu os dados da pesquisa/estudo no BD nem fez upload dos arquivos. \n\n Query:" . $query;
        $arquivoLog = $geraLog->geraLogExcecao("estudosPesquisas", "paginaAdicionaEstudoPesquisa", $informacoesErro, $mat);
        $retorno['status'] = 0;
        $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        // return json_encode($retorno);
    }
} catch(Exception $e){
    $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $query . "\n\nSintoma: Não gravou nenhuma informação: nem no Banco de Dados nem subiu os arquivos.\n\nSolução: nada específico pois a variedade de falhas que podem ocorrer neste ponto é vasta.\n\nSugestões: verificar o erro apresentado nas linhas acima (em \$informacoesAdicionais e \$query), se houve indisponibilidade temporária do servidor, tentar efetuar novo registro acompanhando o Inspetor de Rede do browser.";
    $arquivoLog = $geraLog->geraLogExcecao("estudosPesquisas", "paginaAdicionaEstudoPesquisa", $informacoesErro, $mat);
    $retorno['status'] = 0;
    $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
    // return json_encode($retorno);
} finally {
    echo json_encode($retorno);
}