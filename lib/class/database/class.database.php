<?php

class Database extends Conexao {

	 /** @var mysqli */
    public $connection;
    public $erro = "";
	// function __construct($database = "cad"){

	// 	$hostName = $this->server;
	// 	$username = $this->user;
	// 	$password = $this->pass;
	// 	$this->connection = new mysqli($hostName, $username, $password, $database);
	// 	// $this->connection->set_charset("utf8");
	// 	$this->connection->set_charset("utf8mb4");
	// 	if (mysqli_connect_errno()) {
			
	// 		$erroCod = mysqli_errno();
	// 		$erroName = mysqli_connect_error();

	// 		header("Location: https://cad.bb.com.br/erroDB.php?erroCod=".$erroCod."&erroNome=".$erroName);

			
	// 		exit();
	// 	}
	// }

	/**
     * Constrói a conexão TCP usando host + porta.
     *
     * @param string $database
     * @throws mysqli_sql_exception
     */
    public function __construct($database = null) {
        // Se foi passado outro DB, use; senão use o default da Conexao
        $dbName = $database ?: $this->database;

        // Conecta via TCP (host diferente de "localhost" força TCP)
        $this->connection = new mysqli(
            $this->server,
            $this->user,
            $this->pass,
            $dbName,
            $this->port
        );

        // Charset
        $this->connection->set_charset(CHARSET);

        // Tratamento de erro
        if ($this->connection->connect_errno) {
            // opcional: log, header redirect, etc
            throw new \mysqli_sql_exception(
                $this->connection->connect_error,
                $this->connection->connect_errno
            );
        }
    }
	
	
	
	function DbClean($array, $index, $maxlength, $connection) {
		if (isset($array["{$index}"])) {
			$input = substr($array["{$index}"], 0, $maxlength);
			$input = $this->connection->real_escape_string($input);
			return ($input);
		} else {
			printf("<p>Error retrieving stored procedure result set:%d (%s) %s\n",   mysqli_errno($this->connection),mysqli_sqlstate($this->connection),mysqli_error($this->connection));
			$this->connection->close();
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
			$row = mysqli_fetch_assoc($r1);
			if (count($row) > 0){
				foreach($row as $k => $v){
					$res = $v;
				}
			}
			if (!isset($res))
				$res = 0;
			return $res;
		} else {
                        echo $csql;
			$this->erro = "<p>Error retrieving stored procedure result set:%d (%s) %s\n". mysqli_errno($this->connection).mysqli_sqlstate($this->connection).mysqli_error($this->connection);
			$this->connection->close();
			//exit();	
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
			$r1->close();
		} else {
			$this->erro = "<p>Error retrieving stored procedure result set: \n".mysqli_errno($this->connection).mysqli_sqlstate($this->connection).mysqli_error($this->connection);
			$this->connection->close();
			//exit();	
		}
		return $res;
	}
	
	function DbGetRow($csql) {
		$res = Array();
		if ($r1 = $this->connection->query($csql)){
			$res = mysqli_fetch_assoc($r1);
			$r1->close();
			return $res;
		} else {
			//printf("<p>Error retrieving stored procedure result set:%d (%s) %s\n",   mysqli_errno($this->connection),mysqli_sqlstate($this->connection),mysqli_error($this->connection));
			$this->erro = "Error retrieving stored procedure result set: \n".mysqli_errno($this->connection).mysqli_sqlstate($this->connection).mysqli_error($this->connection);
			$this->connection->close();
			//exit();	
		}
	}
	
	function DbQuery($csql) {
		// if ($this->connection->query($csql)) return true; else 	$this->erro = "<p>Error performing Query: \n".mysqli_errno($this->connection).mysqli_sqlstate($this->connection).mysqli_error($this->connection);
		// 	$this->connection->close();
		if ($this->connection->query($csql)){
			return true;
		} else {
			$this->erro = "Error performing Query: ".mysqli_errno($this->connection).mysqli_sqlstate($this->connection).mysqli_error($this->connection);
			$this->connection->close();
		}
		//exit();
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
			$this->erro = "<p>Error retrieving stored procedure result set: \n".mysqli_errno($this->connection).mysqli_sqlstate($this->connection).mysqli_error($this->connection);
			$this->connection->close();
			exit();	
		}	
	}
	
	function DbDisconnect() {
		if(isset($this->connection)){
			mysqli_close($this->connection);
		}	
	}

}

?>