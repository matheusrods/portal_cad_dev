<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/lib/class/database/Conexao.php';

class UsePDO {

    private $banco;
    private $host = DB_HOSTNAME;
    private $user = DB_USERNAME;
    private $pass = DB_PASSWORD;
    private $connection;
    public $erroConexao;
    public $table;
    public $key;
    public $query;
    public $result;
    public $qtd;
    public $id;
    public $statusAtualiza;
    public $statusInsere;
    public $statusConsulta;
    public $statusExecute;
    public $numColls; #Incluído em 01/11/2012 por Márcio Santos <F6791993>
    public $namesColls = array(); #Incluído em 01/11/2012 por Márcio Santos <F6791993>
    private $rootX = null; #Incluído em 01/11/2012 por Márcio Santos <F6791993>
    public $xml; #Incluído em 01/11/2012 por Márcio Santos <F6791993>

    public function __construct($banco = null, $rootX = null) {

        //echo "$banco , $rootX";
        if (isset($banco)) {
            $this->banco = $banco;
        } else {
            $this->banco = "sig_db";
        }
        /**
         * Incluído em 01/11/2012 por Márcio Santos <F6791993>
         */
        if (isset($rootX)) {
            $this->rootX = $rootX;
        } else {
            $this->rootX = "root";
        }
        ######################################################
    }

    private function openConn() {
        $host = "mysql:host=" . $this->host . ";dbname=" . $this->banco;
        try {
            $this->connection = $pdo = new PDO($host, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (PDOException $e) {
            echo $e->getMessage();
            $this->erroConexao = $e->getMessage();
        }
    }

    /*     * *************************************************************************
     * Função para consulta ao banco de dados. 
     * ************************************************************************** */

    public function consulta() {

        if (!isset($this->connection)) {
            $this->openConn();
        }
        $stmt = $this->connection->prepare($this->query);
        $this->statusConsulta = $stmt->execute();
        $this->result = $stmt->fetchAll();
        $this->qtd = sizeof($this->result);
        $this->numColls = $stmt->columnCount(); #Incluído em 01/11/2012 por Márcio Santos <F6791993>
        $this->setCollsNames(); #Incluído em 01/11/2012 por Márcio Santos <F6791993>
        $this->close();
    }

    /**
     * @author Márcio Santos <F6791993>
     * Incluído em 01/11/2012
     * Atribui o nome das colunas em um array;
     */
    private function setCollsNames() {
        $i = 0;
        foreach ($this->result as $key => $value) {
            foreach ($value as $key1 => $value1) {
                if (!is_numeric($key1)) {
                    if ($i < $this->numColls) {
                        $this->namesColls[$i] = $key1;
                        #echo $key1 . " = $i <br>";
                        $i++;
                    } else {
                        break;
                    }
                }
            }
        }
        $this->XML();
    }

    /**
     * @author Márcio Santos <F6791993>
     * Incluído em 01/11/2012
     * Coloca o resultado em XML
     */
    private function XML() {
        ///include_once 'AdapConex.php';
        $id = uniqid($this->rootX);
        $this->xml = "<?xml version='1.0' encoding='utf-8'?>";
        $this->xml.="<$this->rootX>";
        $this->xml.="<unit qtd='" . $this->qtd . "'>$id";
        $this->xml.="</unit>";
        $this->xml.="<colls>";
        foreach ($this->namesColls as $value) {
            $this->xml.="<field>$value";
            $this->xml.="</field>";
        }
        $this->xml.="</colls>";
        $this->xml.="<results>";
        foreach ($this->result as $value) {
            $this->xml.="<row>";
            foreach ($this->namesColls as $value1) {
                $this->xml.="<$value1>" . trim($value[$value1]);
                $this->xml.="</$value1>";
            }
            $this->xml.="</row>";
        }
        $this->xml.="</results>";
        $this->xml.="</$this->rootX>";
    }

    /*     * *************************************************************************
     * Função para execução de querys. 
     * ************************************************************************** */

    public function execute() {
        if (!isset($this->connection)) {
            $this->openConn();
        }
        $stmt = $this->connection->prepare($this->query);
        $this->statusExecute = $stmt->execute();
        $this->close();
    }

    /*     * *************************************************************************
     * Função para inserção no banco de dados.
     * **************************c************************************************ */

    public function insere(Array $dados) {
        include_once 'AdapConex.php';
        if (!isset($this->connection)) {
            $this->openConn();
        }
        if (strlen($this->table) < 1) {
            echo "É necessário informar o atributo tabela.";
        } else {
            $i = 0;
            $a = 0;
            foreach ($dados as $key => $value) {
                $key = trim($key);
                $value = trim($value);
                $valor = mysql_escape_string($valor);
                if (ereg("([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})", $value, $regs)) {
                    $value = "$regs[3]-$regs[2]-$regs[1]";
                } else {
                    $value = mysql_escape_string($value);
                    $value = str_replace(';', '.', $value);
                }
                if ($i == 0) {
                    $campos = $key;
                    $i++;
                } else {
                    $campos .= ", " . $key;
                    $i++;
                }
                if ($a == 0) {
                    $valores = "'" . $value . "'";
                    $a++;
                } else {
                    $valores .= ", '" . $value . "'";
                    $a++;
                }
            }
            $this->query = "INSERT INTO $this->table ($campos) VALUES ($valores)";
            $stmt = $this->connection->prepare($this->query);
            $this->statusInsere = $stmt->execute();
            return $this->id = $this->connection->lastInsertId();
        }
        $this->close();
    }

    /*     * *************************************************************************
     * Função para update do banco de dados.
     * Sintaxe UPDATE, conforme Manual MySQL:
     * UPDATE nome_tabela [, nome_tabela ...]              - varredura de tabelas (não será realizada nessa função)
     * SET nome_coluna1=expr1 [, nome_coluna2=expr2 ...]   - varredura de campos 
     * [WHERE definição_where]                             - varredura de definições
     * 
     * Nesta função:
     * UPDATE $tabela SET $campos WHERE $definicoes
     * ************************************************************************** */

    public function atualiza(Array $dados) {
        if (!isset($this->connection)) {
            $this->openConn();
        }
        if (strlen($this->table) < 1) {
            //Verifica se a tabela, atributo obrigatório, foi informado
            echo "É necessário informar o atributo tabela.";
        } else {
            //Verifica se foi informado qual (ou quais) é a chave primária, para a construção das definições
            if ($this->key == "") {
                echo "É necessário informar qual é a chave primária, para que possamos localizar o item a ser atualizado.";
            } else {
                $definicoes;
                $campos;
                //Efetua a varredura dos dados recebidos, para construção dos campos e das definições
                foreach ($dados as $campo => $valor) {
                    //Retira eventuais espaços no início e fim de cada chave
                    $key = trim($key);
                    //Retira eventuais espaços no início e fim de cada valor
                    $valor = trim($valor);
                    $valor = mysql_escape_string($valor);
                    if (strlen($valor) == 10) {
                        if (ereg("([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})", $valor, $regs)) {
                            $valor = "$regs[3]-$regs[2]-$regs[1]";
                        }
                    }
                    //Cria campos e definições
                    $campos .= $campo . ' = "' . $valor . '", ';

                    for ($k = 0; $k < sizeof($this->key); $k++) {
                        if ($campo == $this->key[$k]) {
                            $definicoes .= $campo . '="' . $valor . '" AND ';
                        }
                    }
                }
                //Corrige os finais das variáveis campos e definições
                $campos = substr($campos, 0, strlen($campos) - 2);             //Retira o último ", "


                $definicoes = substr($definicoes, 0, strlen($definicoes) - 5); //Retira o último " AND "
                //Efetua conexão e atualiza os dados:
                $this->query = "UPDATE " . $this->table . " SET " . $campos . " WHERE " . $this->table . "." . $definicoes;
                $stmt = $this->connection->prepare($this->query);
                $this->statusAtualiza = $stmt->execute();
            }
        }
        $this->close();
    }

    /*     * *************************************************************************
     * Função para verificação da construção da query
     * ************************************************************************** */

    public function getQuery() {
        return $this->query;
    }

    /*     * *************************************************************************
     * Função para fechamento da conexão com o banco de dados.
     * ************************************************************************** */

    public

    function close() {
        $this->connection = null;
    }

}

?>
