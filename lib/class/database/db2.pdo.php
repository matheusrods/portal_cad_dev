<?php
// Classe para conexão DB2 por Octávio Santos F7651201 2024
// Abre session para incluir a matricula que iniciou a query no log
session_start();
//ini_set("display_errors", E_ALL);
// String de conexão utilizando variaveis definidas no servidor.
$conn_string =  "odbc:DRIVER={DB2}; ".
				"DATABASE=BDB2P04; ".
				"HOSTNAME=gwdb2.bb.com.br; ".
				"PORT=50100; ".
				"PROTOCOL=TCPIP; ".
				"DB2TCPCONNMGRS=1; ".
				"UID=".getenv('DB2_USER')."; ".
				"PWD=".getenv('DB2_PASS').";";
				
define('DSN',$conn_string);
define('DB',getenv('DB2_USER'));

class Db2 {
	private $dsn=DSN;
	private $conn;
	private $erro;
	private $DB=DB;
	function __construct(){
		try {
            $options=Array(
				PDO::ODBC_ATTR_USE_CURSOR_LIBRARY=>PDO::ODBC_SQL_USE_DRIVER
			);
            $this->conn = new PDO($this->dsn, '', '',$options);
        } catch (PDOException $e) {
            $this->erro = "Erro: ".$e->getCode()." - ".$e->errorInfo;
			die;
        }
	}

	function DbGetOne($csql){
        try {
            $stmt=$this->conn->query($csql);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
            if (is_array($row)){
				if (count($row) == 1){
					foreach($row as $k=>$v){
						$res = $v;
					}
				} else {
					$res=$row;
				}
			} else {
				$res = NULL;
			}
            return $res;
        } catch (PDOException $e) {
            $this->erro = "Erro: ".$e->getCode()." - ".$e->errorInfo;
        }
    }

	function DbGetAll($csql) {
		$this->logAcesso($csql);
		if(substr(trim($csql),0,6)=="SELECT"){
			try {
				$res = Array();
				$stmt=$this->conn->query($csql);
				$r1=$stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach ($r1 as $i=>$row) {
					$res[$i] = Array();
					foreach ($row as $k => $v) {
						$res[$i][$k] = trim($v,"  \t\n\r\0\x0B");
					}
				}
			} catch (PDOException $e) {
				$this->erro = "Erro: ".$e->getCode()." - ".$e->errorInfo;
			}
			return $r1;
		}
	}

	function DbQuery($csql) {
		$this->logAcesso($csql);
    	if(strpos($csql,$this->DB)>0){
			try{
				$this->conn->exec($csql);
			} catch (PDOException $e) {
				$this->erro = "Erro: ".$e->getCode()." - ".$e->errorInfo;
			}
		} else{
			$this->erro = "<p>Comando permitido apenas na base $this->DB";
		}
	}
	
	function logAcesso($csql){
		$sql=str_replace("'","`",$csql);
		$sql=str_replace('"',"`",$sql);
		$matricula=$_SESSION['matricula'];
		$ip=$_SERVER['REMOTE_ADDR'];
		$servidor=$_SERVER['HTTP_HOST'];
		$timestamp=(new DateTime())->format('Y-m-d-H.i.s.u');
		try{
			$stmt=$this->conn->prepare("INSERT INTO DB2I1F4B.LOG_ACESSO (MATRICULA,IP,SERVIDOR,QUERY,DATAHORA) VALUES (?, ?, ?, ?, ?);");
			$stmt->execute([$matricula, $ip, $servidor, $sql, $timestamp]);
		} catch (PDOException $e) {
			$this->erro = "Erro: ".$e->getCode()." - ".$e->errorInfo;
		}
	}

	function __destruct() {
		if($this->erro != ""){
			echo $this->erro;
		}
		$this->conn=null;
	}
}

?>