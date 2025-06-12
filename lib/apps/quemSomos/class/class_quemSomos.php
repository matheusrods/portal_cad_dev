<?php

// ini_set('display_startup_errors', 1);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

Class funcoes {

    public $mat;

    // Função padrão do PHP para declaração de variáveis que serão utilizadas em outras funções
    public function __construct(){
        // if(!isset($_SESSION)){
        //     session_start();
        // }
        $mat = $_SESSION['matricula'];
        $caminhoLogErro = $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
    }

    // Função que consulta os Setores ativos da CAD
    public function consultaSetores(){

        $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];
        
        $mat = $_SESSION['matricula'];

        $db = New Database('cad');
        $query = "SELECT * FROM cad.setores WHERE ativo = 1 ORDER BY id ASC;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("quemSomos", "consultaSetores", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os Setores para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    // Função que consulta as Squads de cada Setor
    public function consultaSquads($idSetor){
         $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];

        $mat = $_SESSION['matricula'];

        $db = New Database('cad');
        $query = "
            SELECT 
                a.id,
                e.id as 'idSetor',
                e.setor,
                squad,
                b.matricula as 'matGerente',
                c.nomeGuerra as 'nomeGerente',
                d.nomeFuncao as nomeFuncao,
                a.descricaoSquad
            FROM cad.squads a
            LEFT JOIN cad.squads_gerentes b ON a.id = b.idSquad
            LEFT JOIN cad.funcionarios c ON b.matricula = c.matricula
            LEFT JOIN cad.funcoes d ON d.idFuncao = c.idComissao
            LEFT JOIN cad.setores e ON a.idSetor= e.id
            WHERE a.ativo = 1 and e.id = ".$idSetor."
            ORDER BY squad asc;
        ";

        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno['mensagem'] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("quemSomos", "consultaSquads", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar as Squads para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    // Função que consulta os Funcis de cada Squad
    public function consultaFuncisSquads($idSquad){

         $retorno = [
           'mensagem' => '',  // ou string vazia, conforme sua convenção
            'status'   => 0,
        ];
        $mat = $_SESSION['matricula'];

        $db = New Database('cad');
        $query = "
            SELECT 
                c.id,
                c.squad,
                a.matricula,
                b.nome,
                b.nomeGuerra,
                b.comissao,
                d.nomeFuncao
            FROM cad.squads_funcionarios a
            LEFT JOIN cad.funcionarios b ON a.matricula = b.matricula
            LEFT JOIN cad.squads c ON a.idSquad = c.id
            LEFT JOIN cad.funcoes d ON b.idComissao = d.idFuncao
            WHERE c.ativo = 1 AND c.id = ".$idSquad."
            ORDER BY c.squad asc;
        ";
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno['mensagem'] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("quemSomos", "consultaFuncisSquads", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os funcionários para exibiçãoa página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    // Função que consulta as vagas disponíveis na CAD
    public function consultaVagas(){

         $retorno = [
            'mensagem' => '',  // ou string vazia, conforme sua convenção
            'status'   => 0,
        ];
        $mat = $_SESSION['matricula'];

        $db = New Database('cad');
        $query = 'SELECT * FROM cad.vagas WHERE ativo = 1 order by ordem;';

        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno['mensagem'] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("quemSomos", "consultaVagas", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar as vagas disponíveis.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog;
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
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