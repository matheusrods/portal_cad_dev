<?php

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
        $mat = $_SESSION['matricula'];
        $caminhoLogErro = $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
    }

    public function consultaCursos(){

        $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];
        
        $mat = $_SESSION['matricula'];

        $db = New Database('cad');
        $query = "SELECT id, titulo, url, ordem FROM cad.cursos_alura;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("consultaCursos", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os Setores para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    public function consultaPowerBi(){

        $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];
        
        $mat = $_SESSION['matricula'];

        $db = New Database('cad');
        $query = "SELECT id, titulo, url, ordem, criado_em FROM cad.cursos_powerbi;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("consultaPowerBi", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os Setores para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    public function consultaCursosSpotfire(){

        $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];
        
        $mat = $_SESSION['matricula'];

        $db = New Database('cad');
        $query = "SELECT id, titulo, url, ordem, criado_em FROM cad.cursos_spotfire;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("consultaPowerBi", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os Setores para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    public function consultaRecursos(string $panelSlug){

        $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];
        $mat = $_SESSION['matricula'];

        $db = New Database('cad');
        $query = "SELECT r.name, r.id, r.url
                FROM recursos r
                JOIN painel_recursos pr ON pr.recurso_id = r.id
                JOIN painel p          ON p.id = pr.painel_id
                WHERE p.slug = '".$panelSlug."'
                ORDER BY pr.recurso_id;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("consultaRecursos", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os Setores para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    public function ConsultaCursosPython(){

        $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];
        
        $mat = $_SESSION['matricula'];

        $db = New Database('cad');
        $query = "SELECT id, titulo, url, ordem FROM cad.cursos_python;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("ConsultaCursosPython", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os Setores para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    public function ConsultaCursosSpark(){

        $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];
        
        $mat = $_SESSION['matricula'];

        $db = New Database('cad');
        $query = "SELECT id, titulo, url, ordem FROM cad.cursos_spark;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("ConsultaCursosSpark", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os Setores para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    public function consultaResponsabilidades(){

        $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];
        
        $mat = $_SESSION['matricula'];

        $db = New Database('cad');
        $query = "SELECT id, ordem, titulo, descricao FROM cad.responsabilidades_eng_dados;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("consultaResponsabilidades", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os Setores para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    public function consultaWorkshops(){

        $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];
        
        $mat = $_SESSION['matricula'];

        $db = New Database('cad');
        $query = "SELECT id, ordem, titulo, descricao, created_at, updated_at, url FROM cad.workshops;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("consultaWorkshops", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os Setores para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

     public function consultaCards(string $panelSlug){

        $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];
        $mat = $_SESSION['matricula'];

        $db = New Database('cad');
        $query = "SELECT c.name, c.id, c.url, c.url_img
                FROM cards c
                JOIN painel p          ON p.id = c.painel_id
                WHERE p.slug = '".$panelSlug."'
                ORDER BY c.id;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("consultaCards", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os Setores para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }
}