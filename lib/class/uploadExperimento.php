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
$resultadoExperimento = $_POST['resultadoExperimento'];
$idTema = $_POST['idTema'];
$idTemaArray = explode(",", $idTema);
$qtdTemas = sizeof($idTemaArray);

$db = new Database('experimentos');

$query = "INSERT INTO `experimentos`.`experimentos` (`titulo`, `subtitulo`, `resultado`, `dtExperimento`) VALUES ('".$titulo."', '".$descricao."', '".$resultadoExperimento."', CURDATE());";

$retorno = array();

try{
    $execQuery = $db->DbQuery($query);
    
    if($execQuery){
        $queryUltimoId = "SELECT idExperimento FROM experimentos.experimentos ORDER BY idExperimento DESC LIMIT 1;";

        try {
            $execQueryUltimoId = $db->DbGetAll($queryUltimoId);

            if($execQueryUltimoId){
                $sucessoInsertTema = 0;

                for($i = 0; $i < $qtdTemas; $i++){

                    $queryInsertTema = "INSERT INTO `experimentos`.`experimentosTemas` (`idExperimento`, `idTema`) VALUES ('".$execQueryUltimoId[0]['idExperimento']."', '".$idTemaArray[$i]."');";
                    
                    try {
                        $execQueryInsertTema = $db->DbQuery($queryInsertTema);
                        if($execQueryInsertTema){
                            $sucessoInsertTema = $sucessoInsertTema+1;
                        }

                    } catch(Exception $e){
                        $informacoesErro = "Erro: " . $e . "\n\n\$query:" . $queryUltimoId . "\n\nSintoma: Gravou os dados do experimento, mas não conseguiu gravar o id do tema.\n\nSolução: consultar na tabela 'experimentos.experimentos' o ID do último registro, verificar a tabela 'experimentos.experimentosTemas' se realmente não há temas vinculado ao último ID de experimento. Incluir os temas e posteriormente salvar os arquivos na pasta correspondente, renomeando os mesmos com o ID do experimento (por exemplo, 01.png e 01.pdf).";
                        $arquivoLog = $geraLog->geraLogExcecao("experimentos", "adicionaExperimento", $informacoesErro, $mat);
                        $retorno['status'] = 0;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                        // return json_encode($retorno);
                    }
                }

                if($sucessoInsertTema = $qtdTemas){
                    $pdfName = $_FILES['pdf']['name'];
                    $pdfTmpName = $_FILES['pdf']['tmp_name'];
                    $pngName = $_FILES['png']['name'];
                    $pngTmpName = $_FILES['png']['tmp_name'];

                    // Salvando os arquivos
                    $pdfDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/experimentos/arquivos/'.$execQueryUltimoId[0]['idExperimento'].'.pdf';
                    $pngDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/experimentos/arquivos/'.$execQueryUltimoId[0]['idExperimento'].'.png';

                    move_uploaded_file($pdfTmpName, $pdfDestination);
                    move_uploaded_file($pngTmpName, $pngDestination);


                    if(file_exists($pdfDestination)){
                        if(file_exists($pngDestination)){
                            $mensagemSucesso = "Seu experimento foi incluído com sucesso!";
                            $retorno['status'] = 1;
                            $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                        } else {
                            $informacoesErro = "Erro: Arquivo " . $execQueryUltimoId[0]["idExperimento"].".png não encontrado em ".$pngDestination."\n\nSintoma: Registrou o experimento no BD, subiu o arquivo PDF mas não o arquivo PNG.\n\nSolução: verificar pasta dos arquivos para confirmar ausência do arquivo PNG. Em caso positivo, incluir manualmente o arquivo ou excluir registro do banco de dados e o arquivo PDF.";
                            $arquivoLog = $geraLog->geraLogExcecao("experimentos", "adicionaExperimento", $informacoesErro, $mat);
                            $retorno['status'] = 0;
                            $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                        }
                    } else {
                        $informacoesErro = "Erro: Arquivo " . $execQueryUltimoId[0]["idExperimento"].".pdf não encontrado em ".$pdfDestination."\n\nSintoma: Registrou o experimento no BD, mas não subiu nenhum arquivo.\n\nSolução: verificar pasta dos arquivos para confirmar ausência dos mesmos. Em caso positivo, incluir manualmente os arquivos ou excluir registro do banco de dados.";
                        $arquivoLog = $geraLog->geraLogExcecao("experimentos", "adicionaExperimento", $informacoesErro, $mat);
                        $retorno['status'] = 0;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                    }
                } else {
                    $informacoesErro = "Erro: Arquivo " . $execQueryUltimoId[0]["idExperimento"].".pdf não encontrado em ".$pdfDestination."\n\nSintoma: Registrou o experimento no BD, mas não subiu nenhum arquivo.\n\nSolução: verificar pasta dos arquivos para confirmar ausência dos mesmos. Em caso positivo, incluir manualmente os arquivos ou excluir registro do banco de dados.";
                    $arquivoLog = $geraLog->geraLogExcecao("experimentos", "adicionaExperimento", $informacoesErro, $mat);
                    $retorno['status'] = 0;
                    $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                }

            } else {
                $informacoesErro = "Erro: Gravou no BD mas não capturou o último registro e não subiu nenhum arquivo na pasta. \n\n Query:" . $queryUltimoId ."\n\nSintoma: Registrou o experimento no BD, mas não subiu nenhum arquivo.\n\nSolução: verificar pasta dos arquivos para confirmar ausência dos mesmos. Em caso positivo, incluir manualmente os arquivos ou excluir registro do banco de dados.";
                $arquivoLog = $geraLog->geraLogExcecao("experimentos", "adicionaExperimento", $informacoesErro, $mat);
                $retorno['status'] = 0;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                // return json_encode($retorno);
            }

        } catch(Exception $e) {
            $informacoesErro = "Erro: " . $e . "\n\n\$query:" . $queryUltimoId . "\n\nSintoma: Gravou os dados do experimento, mas não conseguiu fazer upload dos arquivos.\n\nSolução: consultar na tabela 'experimentos.experimentos' o ID do último registro, verificar a pasta dos arquivos para confirmar ausência dos mesmos (os arquivos devem ter o nome 'nº_do_ID.pdf' e 'nº_do_ID.png' (por exemplo, para o ID 01, os arquivos são 01.pdf e 01.png)). Caso os arquivos realmente não estejam na pasta, incluir manualmente os arquivos ou excluir o registro do banco de dados.";
            $arquivoLog = $geraLog->geraLogExcecao("experimentos", "adicionaExperimento", $informacoesErro, $mat);
            $retorno['status'] = 0;
            $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            // return json_encode($retorno);
        }
    } else {
        $informacoesErro = "Erro: Não inseriu os dados da pesquisa/estudo no BD nem fez upload dos arquivos. \n\n Query:" . $query;
        $arquivoLog = $geraLog->geraLogExcecao("experimentos", "adicionaExperimento", $informacoesErro, $mat);
        $retorno['status'] = 0;
        $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        // return json_encode($retorno);
    }
} catch(Exception $e){
    $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $query . "\n\nSintoma: Não gravou nenhuma informação: nem no Banco de Dados nem subiu os arquivos.\n\nSolução: nada específico pois a variedade de falhas que podem ocorrer neste ponto é vasta.\n\nSugestões: verificar o erro apresentado nas linhas acima (em \$informacoesAdicionais e \$query), se houve indisponibilidade temporária do servidor, tentar efetuar novo registro acompanhando o Inspetor de Rede do browser.";
    $arquivoLog = $geraLog->geraLogExcecao("experimentos", "adicionaExperimento", $informacoesErro, $mat);
    $retorno['status'] = 0;
    $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
    // return json_encode($retorno);
} finally {
    echo json_encode($retorno);
}