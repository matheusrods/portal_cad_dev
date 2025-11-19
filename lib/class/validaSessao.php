<?php

Class funcoes {
    public function validaSessao(){
        session_start();
        $retorno = array('session_valid' => !empty($_SESSION['matricula']));
        return $retorno;

    }
}

$class = new funcoes();

switch ($_GET['request']) {
    case "validaSessao":
        $retorno = $class->validaSessao();
        echo json_encode($retorno);
    break;
}
?>