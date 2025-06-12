<?php
session_start();
// ini_set("display_errors", E_ALL);
include "classCadastro.php";

if(!isset($_SESSION)){
    session_start();
}

$class = new funcoes();
$squads = $class->consultaSquads();
$option = "<option></option>";

for($i=0; $i < sizeof($squads); $i++){
    $option = $option.'<option val="'.$squads[$i]['id'].'">'.$squads[$i]['squad'].'</option>';
}

$tipoReport = $class->consultaTiposReport();
$optionReport = "<option></option>";
for($i=0; $i < sizeof($tipoReport); $i++){
    $optionReport = $optionReport.'<option val="'.$tipoReport[$i]['values'].'">'.$tipoReport[$i]['descricao'].'</option>';
}

// Monta tabela com os dados das Indisponibilidades vigentes para edição
$indispAtivas = $class->consultaIndispAtivas();
$qtdIndisponbilidades = sizeof($indispAtivas);

if($qtdIndisponbilidades > 0){
    for($i=0; $i < sizeof($indispAtivas); $i++){
        $dadosIndisp = $dadosIndisp.'<tr val="'.$indispAtivas[$i]['id'].'"><td>'.$indispAtivas[$i]['id'].'</td><td id="tituloEditado_'.$indispAtivas[$i]['id'].'">'.$indispAtivas[$i]['titulo'].'</<td><td id="textoEditado_'.$indispAtivas[$i]['id'].'">'.$indispAtivas[$i]['texto'].'</<td><td>'.$indispAtivas[$i]['dataInicio'].'</td><td id="tdDataFim_'.$indispAtivas[$i]['id'].'">'.$indispAtivas[$i]['dataFim'].'</td><td><button val="'.$indispAtivas[$i]['id'].'" class="btn btn-success editaIndisp">Editar</button></td></tr>';
    }
} else {
    $dadosIndisp = "<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>";
}

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport">

        <!-- CSS Bootstrap -->
        <link href="../lib/css/bootstrap.min.css" rel="stylesheet">

        <!-- CSS Datatables -->
        <link href="../lib/datatables/datatables.min.css" rel="stylesheet">

        <!-- CSS da aplicação -->
        <link href="cadastro.css" rel="stylesheet">

        <!-- jQuery -->
        <script type="text/javascript" src="../lib/js/jquery.3.7.1.js"></script>
        <script type="text/javascript" src="../lib/js/jquery.3.7.1.min.js"></script>
        
        <!-- JS Bootstrap -->
        <script src="../lib/js/bootstrap.bundle.min.js"></script>

        <!-- JS Bootbox -->
        <script src="../lib/js/bootbox.all.min.js"></script>

        <!-- JS Datatables -->
        <script type="text/javascript" src="../lib/datatables/datatables.min.js"></script>
        
       
    </head>

    <body>
        <div id="container" style="margin: 20px 120px;">
            
            <div id="select">
                <label for="tipo">Tipo de Texto</label><br>
                <select id="tipoReport">
                    <?php
                        echo $optionReport;
                    ?>
                </select><br><br>
            </div>

            <div id="mesa" style="display: none">
                <div id="divDescricao">
                    <div id="divTitulo">
                        <label for="indisponibilidade">Título</label><br>
                        <input type="text" id="tituloIndisponibilidade" name="tituloIndisponibilidade" maxlength="100" placeholder="Máx. 100 caracteres" onkeyup="countChar2(this)"></input><br>
                        <p id="contaCaracteresTitulo">100</p>
                    </div>

                    <label for="indisponibilidade">Descrição</label><br>
                    <textarea type="text" id="indisponibilidade" name="indisponibilidade" maxlength="200" placeholder="Máx. 200 caracteres" onkeyup="countChar(this)"></textarea><br>
                    <p id="contaCaracteres">200</p>
                </div>
                
                <div id="divUrl">
                    <label for="url">URL</label><br>
                    <textarea type="text" id="url" name="url" placeholder="http://"></textarea><br>
                </div>
                
                <div id="divSquad">
                    <label for="squad">Squad</label><br>
                    <select id="squad" disabled>
                        <?php
                            echo $option;
                        ?>
                    </select><br>
                </div>

                <div id="divFalhaCad">
                    <label for="falhaCad">Falha CAD?</label><br>
                    <select id="falhaCad" attr-dataPreenchida="">
                        <option></option>
                        <option val="0">Não</option>
                        <option val="1">Sim</option>
                    </select><br>
                </div><br>

                <div id="divNumeroTicket" style="display: none;">
                    <input class="radioTipoTicket" type="radio" id="issue" name="ferramentaTicket" value="Issue" style=" float: left;">
                    <label for="html">Issue</label><br>
                    <input class="radioTipoTicket" type="radio" id="rdi" name="ferramentaTicket" value="RDI" style=" float: left;">
                    <label for="css">RDI</label><br>
                    <label id="labelNumeroTicket" for="numeroTicket">Número Ticket</label><br>
                    <input type="text" id="numeroTicket" name="numeroTicket" disable><br>
                </div>
                
                <div id="divDataIni">
                    <label id="labelDataIni" for="dataIni">Data Início</label><br>
                    <input type="date" id="dataIni" name="dataIni" max="<?php echo date("Y-m-d") ?>" onkeypress="return false"><br>
                </div>
                
                <div id="divVigente">
                    <label for="vigente">Vigente</label><br>
                    <select id="vigente" attr-dataPreenchida="" disabled>
                        <option></option>
                        <option val="0">Não</option>
                        <option val="1">Sim</option>
                    </select><br>
                </div>
                
                <div id="divDataFim">
                    <label for="dataFim">Data Fim</label><br>
                    <input type="date" id="dataFim" name="dataFim" max="<?php echo date("Y-m-d") ?>" onkeypress="return false"><br><br>
                </div>

                <button type="button" class="btn btn-success" id="gravar">Gravar</button>
                <button type="button" class="btn btn-primary"id="reset">Limpar</button>
            </div>
            <div id="divTableEditarIndisp">
                <table id="tableEditarIndisp">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Indisponibilidade</th>
                            <th>Data Início</th>
                            <th>Data Fim</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $dadosIndisp ?>
                    </tbody>
                </table>
            </div>
            <div id="divTableHistIndisp">
                <table id="tableHistIndisp">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Indisponibilidade</th>
                            <th>Data Início</th>
                            <th>Data Fim</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $class->consultaHistIndisp(); ?>
                    </tbody>
                </table>
            </div>
            <div id="divTableHistDestaque">
                <table id="tableHistDestaque">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Destaque</th>
                            <th>URL</th>
                            <th>Squad</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $class->consultaHistDestaques(); ?>
                    </tbody>
                </table>
            </div>
            <div id="divTableHistNoticias">
                <table id="tableHistNoticias">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Notícia</th>
                            <th>URL</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $class->consultaHistNoticias(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>

    <!-- JS da aplicação -->
    <script src="cadastro.js"></script>
</html>