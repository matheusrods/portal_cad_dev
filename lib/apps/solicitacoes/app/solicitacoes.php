<?php

if(!isset($_SESSION)){
    session_start();
}

if($_SESSION["nome"] == ""){
    header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=https://cad.bb.com.br/#login/");
}

//ini_set("display_errors", E_ALL);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/solicitacoes/class/class_solicitacoes.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$classFuncoes = new funcoes();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Solicitações', $_SESSION['ip']);
$paginaEscolhida = $classFuncoes-> escolhePaginaGestorOuCad(1);

?>

<!-- CSS específico do app -->
<link href="/lib/apps/solicitacoes/css/solicitacoes.css" rel="stylesheet">
<!-- JS específico do app -->
<script type="text/javascript" src="/lib/apps/solicitacoes/js/solicitacoes.js"></script>

<div id="paginaSolicitacoes">
    <!-- <input id="visaoGestor" type="button" value = "Visão Gestor" />
    <input id="visaoCad" type="button" value = "Visão Cad"/> -->
    <?php

        $db = New Database("solicitacoes");
        $execQueryDev = $db->DbGetAll('SELECT * FROM cad.desenvolvedores WHERE matricula = "'.$_SESSION['matricula'].'" AND ativo = 3; ');

        if(strtoupper($_SESSION['matricula']) == "F02857391" || strtoupper($_SESSION['matricula']) == "F9256904" || strtoupper($_SESSION['matricula']) == "F9934829" || strtoupper($_SESSION['matricula']) == "F7149356"){
            include_once 'solicitacoes_visaoCad.php';
        } else if(strtoupper($_SESSION['matricula']) == "F0285739"){
            include_once 'solicitacoes_visaoGestor.php';
        } else if ($_SESSION['dependencia'] == 1901){
            include_once 'solicitacoes_visaoCad.php';
        } else{
            include_once 'solicitacoes_visaoGestor.php';
        }
        
        //include_once $paginaEscolhida;
        // if($execQueryDev){
        //     include_once 'solicitacoes_desenvolvedores.php';
        // } else {
        //     if($_SESSION['dependencia'] == '19011'){
        //         include_once 'solicitacoes_visaoCad.php';
        //     } else {
        //         include_once 'solicitacoes_visaoGestor.php';
        //     }
        // }
        
       
    ?>
</div>
<script>
    function datatableVisaoCad(){

        $("#tabelaDadosSolicitacoes").DataTable({
            dom: "Brtip",
            buttons: [
            {
                extend: "excelHtml5",
                className: "btn-excel"
            }
        ],
            order: [[0, "desc"]],
            language: {
                url:"https://cad.bb.com.br/lib/datatables/pt_br.json"
            },
            "initComplete": function(){ 
                $("#tabelaDadosSolicitacoes").show(); 
            },
            columnDefs: [{ type: 'num', targets: 0 }]
        });
    }

    function datatableVisaoGestor(){

        $("#tabelaConsultaSolicitacao").DataTable({
            dom: "Brtip",
            buttons: [
            {
                extend: "excelHtml5",
                className: "btn-excel"
            }
        ],
            // pageLength: [ "10" ],
            // order: [[0, "desc"]],
            language: {
                url:"https://cad.bb.com.br/lib/datatables/pt_br.json"
            },
            "initComplete": function(){ 
                $("#tabelaConsultaSolicitacao").show(); 
            },
            columnDefs: [{ type: 'num', targets: 0 }]
        });
    }

    // function datatableVisaoGestor() {
    //     // setTimeout(function() {
    //         $("#tabelaConsultaSolicitacao").DataTable({
    //             dom: "Brtip",
    //             buttons: ["excelHtml5"],
    //             // pageLength: [ "10" ],
    //             // order: [[0, "desc"]],
    //             language: {
    //                 url: "https://cad.bb.com.br/lib/datatables/pt_br.json"
    //             },
    //             "initComplete": function() {
    //                 $("#tabelaConsultaSolicitacao").css("display", "table");
    //             }
    //         });
    //     // }, 2000);
    // }

</script>
<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php";