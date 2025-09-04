<?php 

    include "../class/class_home.php";

    $class = new funcoes();
    $request = $_REQUEST["request"];

    if(!isset($_SESSION)){
        session_start();
    }

    $mat = strtolower($_SESSION['matricula']);
    $data = $_POST['data'];

    switch($request){

    case "adicionaModalAvisoEcoa":
        $retorno = $class->adicionaModalAvisoEcoa();
        echo json_encode($retorno);
    break;   

    case "adicionaAvisoEcoa":
        $tituloAviso = $_POST['tituloAviso'];
        $dataAviso = $_POST['dataAviso'];
        $horarioAviso = $_POST['horarioAviso'];
        $txtAviso = $_POST['descricaoAviso'];

        $retorno = $class->adicionaAvisoEcoa($tituloAviso, $dataAviso, $horarioAviso, $txtAviso);
        echo json_encode($retorno);
    break;

    case "consultaAvisoEcoa":
       $idAviso = $_POST['idAviso'];
       $retorno = $class->consultaAvisoEcoa($idAviso);

       echo json_encode($retorno); 
    break;
    
    
    }
?>