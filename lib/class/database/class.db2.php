<?php
// Classe para conexão DB2
session_start();
//ini_set("display_errors", E_ALL);
# Build the connection string
#
$conn_string =  "DRIVER={Db2}; ".
				"DATABASE=BDB2P04; ".
				"HOSTNAME=gwdb2.bb.com.br; ".
				"PORT=50100; ".
				"PROTOCOL=TCPIP; ".
				"DB2TCPCONNMGRS=1; ".
				"UID=DB2I1F4B; ".
				"PWD=19601960;";
				
define('CONN_STRING',$conn_string);
define('BD','DB2I1F4B'); //Base do Usuário Db2

class ConnDb2{
	public $conn_str=CONN_STRING;
	public $BD=BD;
}

class Db2 extends ConnDb2{
	public $erro = "";
	function __construct($db = 'BDB2P04'){
		$this->connection = odbc_connect($this->conn_str, "", "",SQL_CUR_USE_ODBC);
		if (!$this->connection) {

			// trata erro DB por Felipe Cardim F3189193 14/05/2018

			header("Location: https://sac.intranet.bb.com.br/erroSIG.php?erroCod=".odbc_error()."&erroNome=".odbc_errormsg());
			
			exit();
		}
	}	

	function DbGetAll($csql) {
		$res = Array();
		$this->logAcesso($csql);
		if ($r1 = odbc_exec($this->connection,$csql)){
			$i = 0;
			while ($row = odbc_fetch_object($r1)) {
				$res[$i] = Array();
				foreach ($row as $k => $v) {
					$res[$i][$k] = $v;
				}
				$i++;
			}
		} else {
			$this->erro = "<p>Error performing Query: \n".odbc_error($this->connection).odbc_errormsg($this->connection);
		}
		return $res;
	}

	function DbQuery($csql) {
		if(stripos($csql,' from ')>0){
			$ini = stripos($csql,' from ') + 6;
		} else{
			$ini = stripos($csql,' ');
		}
		$bd2 = trim(substr($csql,$ini));
		$this->logAcesso($csql);
    	if(stripos($bd2,'.')>0){
        	$bd2 = trim(substr($bd2,0,(stripos($bd2,'.'))));
			if ($bd2 == $this->BD){
				if (odbc_exec($this->connection,$csql)){
					 return true;
				} else {
					$this->erro = "<p>Error performing Query: \n".odbc_error($this->connection).odbc_errormsg($this->connection);
				}
			} else{
				$this->erro = "<p>Comando permitido apenas na base $this->BD";
			}
		}
	}
	
	function logAcesso($csql){
		$sql=str_replace("'","",$csql);
		$matricula=$_SESSION['matricula'];
		$ip=$_SERVER['REMOTE_ADDR'];
		$servidor=$_SERVER['HTTP_HOST'];
		$timestamp=(new DateTime())->format('Y-m-d-H.i.s.u');
		odbc_exec($this->connection,"INSERT INTO DB2I1F4B.LOG_ACESSO (MATRICULA,IP,SERVIDOR,QUERY,DATAHORA) VALUES ('$matricula','$ip','$servidor','$sql','$timestamp');");
	}

	function __destruct() {
		if($this->erro != ""){
			echo $this->erro;
		}
		odbc_close($this->connection);
	}
}

?>