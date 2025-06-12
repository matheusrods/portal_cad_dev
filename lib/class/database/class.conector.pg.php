<?php
class ConectorPg{
	public $conexao;
	public $erro;

	function __construct($db = "sig", $host = "localhost", $porta = "5432", $usuario = null, $senha = null, $encoding = "utf8"){
		$usuario = $usuario === null ? $_SERVER["PG_USERNAME"] : $usuario;
		$senha = $senha === null ? $_SERVER["PG_PASSWORD"] : $senha;
		$this->conexao = pg_connect("host=$host port=$porta dbname=$db user=$usuario password=$senha");

		if($this->conexao === false){
			$this->conexao = null;
			$this->erro = "Erro ao conectar com o DB, verifique o status do servidor e os parâmetros informados";
		} else {
			$this->mudaEncoding($encoding);
		}
	}



	private function executaQuery($query){
		$rs = pg_query($query);
		if($rs === false){
			$this->erro = pg_last_error($this->conexao);
		}
		return $rs;
	}

	public function mudaEncoding($encoding){
		pg_set_client_encoding($this->conexao, $encoding);
	}

	public function mudaSchema($schema){
		$rs = pg_query("set schema '$schema'");
		pg_free_result($rs);
		return $this;
	}

	/*
	Função para selects de multiplas linhas
	Retorna um array associativo em caso de sucesso ou null em caso de erro. 
	Se o resultado não tiver linhas retorna um array vazio
	*/
	public function selectN($query){
		$rs = $this->executaQuery($query);
		$retorno = null;

		if($rs !== false){
			/*
			pg_fetch_all retorna FALSE caso a query não traga resultados ou aconteça algum erro, 
			o valor retornado é jogado para uma variável temporária para poder diferenciar um resultado 
			vazio de um possível erro no retorno da função
			*/
			$retorno = array();
			$temp = pg_fetch_all($rs);
			if($temp !== false){
				$retorno = $temp;
			}
			pg_free_result($rs);
		}
		return $retorno;
	}

	/*
	Função para selects de uma única linha
	Retorna um array associativo em caso de sucesso ou null em caso de erro. 
	Se o resultado não tiver linhas retorna um array vazio
	*/
	public function select($query){
		$rs = $this->executaQuery($query);
		$retorno = null;

		if($rs !== false){
			$retorno = array();
			$temp = pg_fetch_assoc($rs);
			if($temp !== false){
				$retorno = $temp;
			}

			pg_free_result($rs);
		}
		return $retorno;
	}

	/*
	Função para inserts/updates/deletes
	Retorna verdadeiro em caso de sucesso e falso em  caso de erro
	*/
	public function dmlQuery($query){
		$rs = $this->executaQuery($query);
		pg_free_result($rs);

		return $rs !== false;
	}

	public function fecha(){
		pg_close($this->conexao);
		$this->conexao = null;
	}
}
?>