<?php 

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

session_start();

ini_set('display_startup_errors', 1);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

$geraLog = new geraLog();
$funcoes = new funcoes();
$mat = $_SESSION['matricula'];

$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$idTema = $_POST['idTema'];
$tipoArquivo = $_POST['tipoArquivo'];

$db = new Database('recursos');

// $dataPorEscrito = strftime('%h/%Y', strtotime($dtEstudoPesquisa));
// $dataPorEscritoEditada = ucfirst($dataPorEscrito);

if($tipoArquivo == 'arquivo'){
    $query = "INSERT INTO `recursos`.`recursos` (`titulo`, `subtitulo`, `ativo`) VALUES ('".$titulo."', '".$descricao."', '1');";
}

if($tipoArquivo == 'linkExterno'){
    $textoLinkExterno = $_POST['pdf'];
    $query = "INSERT INTO `recursos`.`recursos` (`titulo`, `subtitulo`, `nomeArquivo`, `linkExterno`, `ativo`) VALUES ('".$titulo."', '".$descricao."', '".$textoLinkExterno."', '1', '1');";
}
 
$retorno = array();

try{
    $execQuery = $db->DbQuery($query);
    
    if($execQuery){
        $queryUltimoId = "SELECT id FROM recursos.recursos ORDER BY id DESC LIMIT 1;";
        
        try {
            $execQueryUltimoId = $db->DbGetAll($queryUltimoId);

            if($execQueryUltimoId){
                $queryInsertTema = "INSERT INTO `recursos`.`recursosTemas` (`idRecurso`, `idTema`) VALUES ('".$execQueryUltimoId[0]['id']."', '".$idTema."');";

                try {
                    $execQueryInsertTema = $db->DbQuery($queryInsertTema);
                    
                    if($execQueryInsertTema){
                        if($tipoArquivo == 'arquivo'){

                            $pdfName = $_FILES['pdf']['name'];
                            $pdfTmpName = $_FILES['pdf']['tmp_name'];
                            $pngName = $_FILES['png']['name'];
                            $pngTmpName = $_FILES['png']['tmp_name'];

                            $pdfName = $funcoes->mudaNomeArquivo(($_FILES['pdf']['name']));
                            $pngName = $funcoes->mudaNomeArquivo(($_FILES['png']['name']));

                            // Expressão regular para remover parênteses
                            $pdfNameSemParenteses = preg_replace("/[()]/", "", $pdfName);
                            $pngNameSemParenteses = preg_replace("/[()]/", "", $pngName);

                            // Salvando os arquivos
                            $pdfDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$pdfNameSemParenteses;
                            $pngDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$pngNameSemParenteses;

                            move_uploaded_file($pdfTmpName, $pdfDestination);
                            move_uploaded_file($pngTmpName, $pngDestination);

                            if(file_exists($pdfDestination)){
                                if(file_exists($pngDestination)){
                                    
                                    $queryInsereNomeArquivos = "UPDATE `recursos`.`recursos` SET `nomeArquivo` = '".$pdfNameSemParenteses."', `nomeCapa` = '".$pngNameSemParenteses."' WHERE (`id` = '".$execQueryUltimoId[0]["id"]."');";
                                    $execQueryInsereNomeArquivos = $db->DbQuery($queryInsereNomeArquivos);

                                    if($execQueryInsereNomeArquivos){
                                        $mensagemSucesso = "Recurso inserido com sucesso!";
                                        $retorno['status'] = 1;
                                        $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                    }
                                    
                                } else {
                                    $informacoesErro = "Erro: Arquivo ".$pngNameSemParenteses." não encontrado em ".$pngDestination."\n\nSintoma: Registrou o recurso no BD, subiu o arquivo PDF do recurso mas não o arquivo PNG.\n\nSolução: verificar pasta dos arquivos para confirmar ausência do arquivo PNG. Em caso positivo, incluir manualmente o arquivo ou excluir registro do banco de dados e o arquivo PDF.";
                                    $arquivoLog = $geraLog->geraLogExcecao("recursos", "paginaAdicionaEstudoPesquisa", $informacoesErro, $mat);
                                    $retorno['status'] = 0;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                }
                            } else {
                                $informacoesErro = "Erro: Arquivo ".$pdfNameSemParenteses." não encontrado em ".$pdfDestination."\n\nSintoma: Registrou o estudo/pesquisa no BD, mas não subiu nenhum arquivo.\n\nSolução: verificar pasta dos arquivos para confirmar ausência dos mesmos. Em caso positivo, incluir manualmente os arquivos ou excluir registro do banco de dados.";
                                $arquivoLog = $geraLog->geraLogExcecao("recursos", "paginaAdicionaEstudoPesquisa", $informacoesErro, $mat);
                                $retorno['status'] = 0;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                            }
                        }

                        if($tipoArquivo == 'linkExterno'){
                            $pngName = $_FILES['png']['name'];
                            $pngTmpName = $_FILES['png']['tmp_name'];
                            $pngName = $funcoes->mudaNomeArquivo(($_FILES['png']['name']));

                            // Salvando os arquivos
                            $pngDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$pngName;
                            move_uploaded_file($pngTmpName, $pngDestination);

                            if(file_exists($pngDestination)){
                                    
                                $queryInsereNomeArquivos = "UPDATE `recursos`.`recursos` SET `nomeCapa` = '".$pngName."' WHERE (`id` = '".$execQueryUltimoId[0]["id"]."');";
                                $execQueryInsereNomeArquivos = $db->DbQuery($queryInsereNomeArquivos);

                                if($execQueryInsereNomeArquivos){
                                    $mensagemSucesso = "Recurso inserido com sucesso!";
                                    $retorno['status'] = 1;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                }
                                
                            } else {
                                $informacoesErro = "Erro: Arquivo ".$pngName." não encontrado em ".$pngDestination."\n\nSintoma: Registrou o recurso no BD, subiu o link externo do recurso mas não o arquivo PNG.\n\nSolução: verificar pasta dos arquivos para confirmar ausência do arquivo PNG. Em caso positivo, incluir manualmente o arquivo ou excluir registro do banco de dados e o arquivo PDF.";
                                $arquivoLog = $geraLog->geraLogExcecao("recursos", "paginaAdicionaEstudoPesquisa", $informacoesErro, $mat);
                                $retorno['status'] = 0;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                            }
                        }
                    } else {
                        $informacoesErro = "Erro: Gravou na tabela recursos.recursos, mas não gravou o tema e não subiu nenhum arquivo. \n\nVariável queryInsertTema:" . $queryInsertTema ."\n\nSolução: verificar a sintaxe da query de insert tema. Verificar a tabela recursosTemas e os arquivos pasta dos arquivos para confirmar ausência dos mesmos. Em caso positivo, incluir manualmente o tema e os arquivos, ou excluir o registro da tabela recursos.recursos.";
                        $arquivoLog = $geraLog->geraLogExcecao("recursos", "paginaAdicionaEstudoPesquisa", $informacoesErro, $mat);
                        $retorno['status'] = 0;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                    }
                } catch(Exception $e){
                    $informacoesErro = "Erro: Gravou na tabela recursos.recursos, mas não gravou o tema e não subiu nenhum arquivo. \n\nVariável queryInsertTema:" . $queryInsertTema ."\n\nSolução: verificar a sintaxe da query de insert tema. Verificar a tabela recursosTemas e os arquivos pasta dos arquivos para confirmar ausência dos mesmos. Em caso positivo, incluir manualmente o tema e os arquivos, ou excluir o registro da tabela recursos.recursos.";
                    $arquivoLog = $geraLog->geraLogExcecao("recursos", "paginaAdicionaEstudoPesquisa", $informacoesErro, $mat);
                    $retorno['status'] = 0;
                    $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                }
            } else {
                $informacoesErro = "Erro: Gravou na tabela recursos.recursos, mas não gravou o tema e não subiu nenhum arquivo. \n\nVariável queryUltimoId:" . $queryUltimoId ."\n\nSolução: verificar a sintaxe da query de insert tema. Verificar a tabela recursosTemas e os arquivos pasta dos arquivos para confirmar ausência dos mesmos. Em caso positivo, incluir manualmente o tema e os arquivos, ou excluir o registro da tabela recursos.recursos.";
                $arquivoLog = $geraLog->geraLogExcecao("recursos", "paginaAdicionaEstudoPesquisa", $informacoesErro, $mat);
                $retorno['status'] = 0;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            }

        } catch(Exception $e) {
            $informacoesErro = "Erro: " . $e . "\n\n\$queryUltimoId:" . $queryUltimoId . "\n\nSintoma: Gravou os dados de recurso, mas não conseguiu gravar o tema e fazer upload dos arquivos.\n\nSolução: consultar na tabela 'recursos.recursos' o ID do último registro, verificar a pasta dos arquivos para confirmar ausência dos mesmos. Caso os arquivos realmente não estejam na pasta, incluir manualmente os arquivos ou excluir o registro do banco de dados.";
            $arquivoLog = $geraLog->geraLogExcecao("recursos", "paginaAdicionaEstudoPesquisa", $informacoesErro, $mat);
            $retorno['status'] = 0;
            $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            // return json_encode($retorno);
        }
    } else {
        $informacoesErro = "Erro: Não inseriu os dados do recurso no BD (tabelas recursos.recursos e recursos.recursosTemas) nem fez upload dos arquivos. \n\n Query:" . $query;
        $arquivoLog = $geraLog->geraLogExcecao("recursos", "paginaAdicionaEstudoPesquisa", $informacoesErro, $mat);
        $retorno['status'] = 0;
        $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        // return json_encode($retorno);
    }
} catch(Exception $e){
    $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $query . "\n\nSintoma: Não gravou nenhuma informação: nem no Banco de Dados nem subiu os arquivos.\n\nSolução: nada específico pois a variedade de falhas que podem ocorrer neste ponto é vasta.\n\nSugestões: verificar o erro apresentado nas linhas acima (em \$informacoesAdicionais e \$query), se houve indisponibilidade temporária do servidor, tentar efetuar novo registro acompanhando o Inspetor de Rede do browser.";
    $arquivoLog = $geraLog->geraLogExcecao("recursos", "paginaAdicionaEstudoPesquisa", $informacoesErro, $mat);
    $retorno['status'] = 0;
    $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível gravar as informações neste momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
    // return json_encode($retorno);
} finally {
    echo json_encode($retorno);
}

class funcoes {
    // public function mudaNomeArquivo($nomeAntigo){
    //     // Converte tudo para minúsculas
    //     $novoNome = strtolower($nomeAntigo);
    //     $novoNome = preg_replace_callback ('/(^|[^a-z0-9.]+?)[a-z0-9]/i', function ($matches) {
    //         if (strlen($matches[0]) === 1) {
    //             // O primeiro caractere
    //             return strtoupper($matches[0]);
    //         }
    //         // Caractere após caractere especial
    //         return strtoupper($matches[0][1]);
    //     }, $novoNome);

    //     return $novoNome;
    // }

    // public function mudaNomeArquivo($nomeAntigo) {
    //     // Mapeamento de caracteres acentuados para não acentuados
    //     $mapaAcentos = array(
    //         'á' => 'a', 'à' => 'a', 'ã' => 'a', 'â' => 'a', 'ä' => 'a',
    //         'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
    //         'í' => 'i', 'ì' => 'i', 'î' => 'i', 'ï' => 'i',
    //         'ó' => 'o', 'ò' => 'o', 'õ' => 'o', 'ô' => 'o', 'ö' => 'o',
    //         'ú' => 'u', 'ù' => 'u', 'û' => 'u', 'ü' => 'u',
    //         'ç' => 'c', 'ñ' => 'n'
    //     );
    
    //     // Converte tudo para minúsculas
    //     $novoNome = strtolower($nomeAntigo);
    
    //     // Substitui caracteres acentuados
    //     $novoNome = strtr($novoNome, $mapaAcentos);
    
    //     // Capitaliza o primeiro caractere de cada palavra
    //     $novoNome = preg_replace_callback('/(^|[^a-z0-9.]+?)[a-z0-9]/i', function ($matches) {
    //         if (strlen($matches[0]) === 1) {
    //             // O primeiro caractere é ignorado
    //             return $matches[0];
    //         }
    //         // Caractere após caractere especial
    //         return strtoupper($matches[0][1]);
    //     }, $novoNome);
    
    //     return $novoNome;
    // }


    public function mudaNomeArquivo($nomeAntigo) {
        // Mapeamento de caracteres acentuados para não acentuados
        $mapaAcentos = array(
            'á' => 'a', 'à' => 'a', 'ã' => 'a', 'â' => 'a', 'ä' => 'a',
            'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
            'í' => 'i', 'ì' => 'i', 'î' => 'i', 'ï' => 'i',
            'ó' => 'o', 'ò' => 'o', 'õ' => 'o', 'ô' => 'o', 'ö' => 'o',
            'ú' => 'u', 'ù' => 'u', 'û' => 'u', 'ü' => 'u',
            'ç' => 'c', 'ñ' => 'n'
        );
    
        // Converte tudo para minúsculas
        $novoNome = strtolower($nomeAntigo);
    
        // Substitui caracteres acentuados
        $novoNome = strtr($novoNome, $mapaAcentos);
    
        // Capitaliza o primeiro caractere de cada palavra, exceto o primeiro caractere da string, e remove hífens
        $novoNome = preg_replace_callback('/(^|[^a-z0-9.]+)([a-z0-9])/i', function ($matches) {
            if ($matches[1] === '') {
                // O primeiro caractere da string
                return $matches[2];
            }
            // Caractere após caractere especial ou hífen
            return strtoupper($matches[2]);
        }, $novoNome);
    
        // Remove hífens
        $novoNome = str_replace('-', '', $novoNome);
    
        return $novoNome;
    }
    
}