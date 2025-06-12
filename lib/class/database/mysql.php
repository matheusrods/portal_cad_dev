<?php

session_start();

define('HOST',$_SERVER['DB_HOSTNAME']);
define('USER',$_SERVER['DB_USERNAME']);
define('PASS',$_SERVER['DB_PASSWORD']);

class MySQL{
	public $erro="";
	function __construct($hostName=HOST, $username=USER, $password=PASS){
		$this->connection = new mysqli($hostName, $username, $password);
		$this->connection->set_charset("utf8mb4");
		if (mysqli_connect_errno()) {
			$this->erro = "<p>Erro: %d (%s) %s\n".mysqli_errno($this->connection).mysqli_sqlstate($this->connection).mysqli_connect_error($this->connection);
			exit();
		}
	}
	
	function DbClean($array, $index, $maxlength, $connection) {
		if (isset($array["{$index}"])) {
			$input = substr($array["{$index}"], 0, $maxlength);
			$input = $this->connection->real_escape_string($input);
			return ($input);
		} else {
			$this->erro = "<p>Erro: %d (%s) %s\n".mysqli_errno($this->connection).mysqli_sqlstate($this->connection).mysqli_error($this->connection);
			exit();	
		}
		return NULL;
	}
	
	function DbShellClean($array, $index, $maxlength) {
		if (isset($array["{$index}"])) {
			$input = substr($array["{$index}"], 0, $maxlength);
			$input = EscapeShellArg($input);
			return ($input);
		} 
		return NULL;
	}
	
	function DbGetOne($csql) {
		if ($r1 = $this->connection->query($csql)){
			return $r1->fetch_assoc();
		} else {
			$this->erro = "<p>Erro :%d (%s) %s\n". mysqli_errno($this->connection).mysqli_sqlstate($this->connection).mysqli_error($this->connection);
		}
	}
	
	function DbGetAll($csql) {
		$res = Array();
		if ($r1 = $this->connection->query($csql)){
			$i = 0;
			while ($row = $r1->fetch_object()) {
				$res[$i] = Array();
				foreach ($row as $k => $v) {
					$res[$i][$k] = $v;
				}
				$i++;
			}
		} else {
			$this->erro = "<p>Erro :%d (%s) %s\n".mysqli_errno($this->connection).mysqli_sqlstate($this->connection).mysqli_error($this->connection);
		}
		return $res;
	}
	
	function DbGetRow($csql) {
		$res = Array();
		if ($r1 = $this->connection->query($csql)){
			$res = mysqli_fetch_assoc($r1);
			return $res;
		} else {
			$this->erro = "<p>Erro :%d (%s) %s\n".mysqli_errno($this->connection).mysqli_sqlstate($this->connection).mysqli_error($this->connection);
		}
	}
	
	function DbQuery($csql) {
		if ($this->connection->query($csql)) return true; else 	$this->erro = "<p>Erro :%d (%s) %s\n".mysqli_errno($this->connection).mysqli_sqlstate($this->connection).mysqli_error($this->connection);
	}
	
	function DbCall($csql) {
		$res = Array();
		if ($r1 = $this->connection->query($csql)){
			$resultMulti[] = mysqli_fetch_assoc($r1);
			do {
				
				if (($result = $this->connection->store_result()) == true)
				{
					$resultMulti[] = mysqli_fetch_assoc($result);
					$errnoMulti[] = $this->connection->errno;
					
					if(is_object($result)) {
						$result->free_result();
					}
				}
			} while($this->connection->next_result());
			$res = $resultMulti;
			return $res;
		} else {
			$this->erro = "<p>Erro :%d (%s) %s\n".mysqli_errno($this->connection).mysqli_sqlstate($this->connection).mysqli_error($this->connection);
		}	
	}
	
	function __destruct() {
		if($this->erro != ""){
			echo $this->erro;
		}
		mysqli_close($this->connection);
	}
}

?>
