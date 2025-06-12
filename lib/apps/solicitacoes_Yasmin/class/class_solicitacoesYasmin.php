<?php

ini_set('display_startup_errors', 1);
session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

$mat = $_SESSION['matricula'];

Class funcoesYasmin {

    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
        global $mat;
        // $mat = $_SESSION['matricula'];
        $caminhoLogErro = $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
    }

    // Função que conta o total de novas solicitações, para que exiba o alerta no cabeçalho da tabela na visão CAD
    public function contaNovasSolicitacoes(){
        global $mat;
        $db = New Database('solicitacoes');
        $queryContaNovasSolicitacoes = "SELECT * FROM solicitacoes.solicitacoes WHERE codStatus = 1;";
        $retorno = array();
        try {
            $execQueryContaNovasSolicitacoes = $db->DbGetAll($queryContaNovasSolicitacoes);
            if(sizeof($execQueryContaNovasSolicitacoes) > 0){
                $retorno["mensagem"] = sizeof($execQueryContaNovasSolicitacoes);
                $retorno["status"] = '1';
            } else if(sizeof($execQueryContaNovasSolicitacoes) == 0){
                $retorno["mensagem"] = sizeof($execQueryContaNovasSolicitacoes);
                $retorno["status"] = '1';
            }
        } catch(Exception $e) {
            $informacoesErro = "erro: " . $e . "\n\\n\$queryContaNovasSolicitacoes:" . $queryContaNovasSolicitacoes;
            $arquivoLog = $this->geraLogExcecao("solicitacoes", "contaNovasSolicitacoes", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível verificar se há novas solicitações. Log " . $arquivoLog;
            $retorno["status"] = '0';
        } finally {
            return $retorno;
        }
    }

    // Função que traz as informações de todas as solicitações gravadas
    public function consultaSolicitacoes(){
        global $mat;
        $db = New Database("solicitacoes");
        $queryConsultaSolicitacoes = "SELECT a.*, b.status FROM solicitacoes.solicitacoes a LEFT JOIN solicitacoes.status b ON a.codStatus = b.id  ORDER BY a.id;";
        
        $retorno = array();
        try {
            $execQueryConsultaSolicitacoes = $db->DbGetAll($queryConsultaSolicitacoes); 

            if(sizeof($execQueryConsultaSolicitacoes) > 0){
                $dadosTabelaSolicitacoes = '';
                for($i = 0; $i < (sizeof($execQueryConsultaSolicitacoes)); $i++){
                    $dadosTabelaSolicitacoes = $dadosTabelaSolicitacoes.'
                    <tr>
                        <td>#'.$execQueryConsultaSolicitacoes[$i]['id'].'</td>
                        <td>'.$execQueryConsultaSolicitacoes[$i]['tema'].'</td>
                        <td>'.$execQueryConsultaSolicitacoes[$i]['dependencia'].'</td>
                        <td>'.$execQueryConsultaSolicitacoes[$i]['status'].'</td>
                        <td class="Clicar" >
                            <img src="https://cad.bb.com.br/lib/apps/solicitacoes/img/navegacaoBtn.png" attr-idSolicitacao="'.$execQueryConsultaSolicitacoes[$i]['id'].'" class="acessarSolicitacao">
                        </td>
                    </tr>';
                }
                $retorno['status'] = '1';
                $retorno['mensagem'] = $dadosTabelaSolicitacoes;
            }
        } catch(Exception $e) {
            $informacoesErro = "erro: " . $e . "\n\\n\$queryConsultaSolicitacoes:" . $queryConsultaSolicitacoes;
            $arquivoLog = $this->geraLogExcecao("solicitacoes", "contaNovasSolicitacoes", $informacoesErro, $mat);
            $retorno = "Não foi possível verificar se há novas solicitações. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            return $retorno;
        }
    }

    public function filtrarSolicitacoes($camposSelecionados){
        global $mat;
        $retorno = array();
        $db = New Database("solicitacoes");

        $tamanhoArray = sizeof($camposSelecionados);
        $whereSolicitacoes = "WHERE ";
        $mensagemErro = '';

        for($i = 0; $i < $tamanhoArray; $i++){
            $indices = array_keys($camposSelecionados);
            $valores = array_values($camposSelecionados);
            $whereSolicitacoes = $whereSolicitacoes .$indices[$i] .' LIKE "%'.$valores[$i].'%" AND ';
            
            switch($indices[$i]){
                case "a.id":
                    $mensagemErro = $mensagemErro."-ID Solicitação: ".$valores[$i].'<br>';
                break; 
                
                case "a.tema":
                    $mensagemErro = $mensagemErro."-Tema/Produto: ".$valores[$i].'<br>';
                break;

                case "a.dependencia":
                    $mensagemErro = $mensagemErro."-Dependencia: ".$valores[$i].'<br>';
                break;

                case "a.codStatus":
                    $statusErro = $db->DbGetAll("select status from solicitacoes.status WHERE id = '".$valores[$i]."'; ");
                    // $mensagemErro = $mensagemErro."-Status: ".$valores[$i].'<br>';
                    $mensagemErro = $mensagemErro."-Status: ".$statusErro[0]['status'].'<br>';
                break;
            }
        }
        $whereSolicitacoes = rtrim($whereSolicitacoes, "' AND '");

        $queryFiltraSolicitacoes = "SELECT a.*, b.status FROM solicitacoes.solicitacoes a LEFT JOIN solicitacoes.status b ON a.codStatus = b.id ".$whereSolicitacoes." ORDER BY a.id;";
        
        try {
            $execQueryFiltraSolicitacoes = $db->DbGetAll($queryFiltraSolicitacoes);
            if(sizeof($execQueryFiltraSolicitacoes) > 0){
                $dadosTabelaSolicitacoes = '';
                for($i = 0; $i < (sizeof($execQueryFiltraSolicitacoes)); $i++){
                    $dadosTabelaSolicitacoes = $dadosTabelaSolicitacoes.'
                    <tr>
                        <td>#'.$execQueryFiltraSolicitacoes[$i]['id'].'</td>
                        <td>'.$execQueryFiltraSolicitacoes[$i]['tema'].'</td>
                        <td>'.$execQueryFiltraSolicitacoes[$i]['dependencia'].'</td>
                        <td>'.$execQueryFiltraSolicitacoes[$i]['status'].'</td>
                        <td class="Clicar" >
                            <img src="https://cad.bb.com.br/lib/apps/solicitacoes/img/navegacaoBtn.png" attr-idSolicitacao="'.$execQueryFiltraSolicitacoes[$i]['id'].'" class="acessarSolicitacao">
                        </td>
                    </tr>';
                } 
                $retorno['status'] = '1';
                $retorno['mensagem'] = $dadosTabelaSolicitacoes;
            } else {
                $retorno['status'] = '0';
                $retorno['mensagem'] = "Não localizamos nenhuma solicitação com os termos digitados:<br><br>".$mensagemErro;
            }
        } catch(Exception $e) {
            $informacoesErro = "erro: " . $e . "\n\\n\$queryConsultaSolicitacoes:" . $queryFiltraSolicitacoes;
            $arquivoLog = $this->geraLogExcecao("solicitacoes", "contaNovasSolicitacoes", $informacoesErro, $mat);
            $retorno['status'] = '0';
            $retorno['mensagem'] = "Não foi possível verificar se há novas solicitações. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            
            return $retorno;
        }        
    }

    // Função que grava eventuais logs de erro de banco de dados em formato texto
    public function geraLogExcecao($nomeApp, $nomeFuncao, $informacoesAdicionais, $mat){
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