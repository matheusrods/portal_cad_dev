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

        // case "carregaAvisoEcoa":
        
        //     $retorno = $class->carregaAvisoEcoa();
        //     echo json_encode($retorno);
        // break; 

        // case "carregaReportDestaque":
        //     $retorno = $class->carregaReportDestaque();
        //     echo json_encode($retorno);
        // break; 

        // case "carregaReportIndisponibilidades":
        //     $retorno = $class->carregaReportIndisponibilidades();
        //     echo json_encode($retorno);
        // break;
        
    }
?>