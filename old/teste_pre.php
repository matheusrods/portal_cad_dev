<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Texto para API</title>


    

    <style>

        .qualFormato {
            display: inline-flex;
            flex-direction: row;
            gap: 5%;
            margin-top: 5%;
        }

        .qualFormato input[type="radio"] {
            opacity: 0;
            position: fixed;
            width: 0;
        }

        .qualFormato label {
            display: inline-block;
            background-color: #ddd;
            padding: 10px 20px;
            font-family: sans-serif, Arial;
            font-size: 16px;
            border: 2px solid #444;
            border-radius: 4px;
        }

        .qualFormato label:hover {
            background-color: #dfd;
        }

        .qualFormato input[type="radio"]:focus+label {
            border: 2px dashed #444;
        }

        .qualFormato input[type="radio"]:checked+label {
            background-color: #bfb;
            border-color: #4c4;
        }
    </style>
</head>
<body>
    <div class="formularioImersaoPagina4">
        <div class="qualFormato" style="width: 45%;height: auto;position: relative;border: 1px #FCFC30 solid;border-radius: 14px;display: inline-flex;" attr-qualOpcao="Presencial">
            <input type="radio" name='formatoImersao' id="imersaoPresencial" value="Presencial" style="visibility:hidden;"><label for="imersaoPresencial" style="visibility:hidden;">Presencial</label>
            <img style="width: 40%; height: auto; position: relative;" src="/lib/img/apps/mentoria/minhaDependencia.png">            
            <div style="width: 60%; height: auto; align-content: center; position: relative; color: #FCFC30; font-size: 32px; font-family: 'BancoDoBrasil Textos'; font-weight: 700; word-wrap: break-word;">
                Presencial
            </div>
        </div>
        <div class="qualFormato" style="width: 45%;height: auto;position: relative;border-radius: 14px;border: 1px #FCFC30 solid;display: inline-flex;" attr-qualOpcao="Online">
            <input type="radio" name='formatoImersao' id="imersaoOnline" value="Online" style="visibility:hidden;"><label for="imersaoOnline" style="visibility:hidden;">Online</label>
            <img style="width: 169px; height: auto; position: relative;" src="/lib/img/apps/mentoria/outraDependencia.png">
            <div style="width: 190px;height: auto;align-content: center;position: relative;color: #FCFC30;font-size: 32px;font-family: 'BancoDoBrasil Textos';font-weight: 700;">
                Online
            </div>
        </div>
    </div>
</body>


<!-- jQuery -->
<script type="text/javascript" src="https://cad.bb.com.br/lib/js/jquery.3.7.1.js"></script>
<script type="text/javascript" src="https://cad.bb.com.br/lib/js/jquery.3.7.1.min.js"></script>

<script>
    $(document).ready(function() {
        $('.qualFormato').click(function(){
            // $('input[name="formatoImersao"]')..prop("checked", false);
            alert($(this).attr('attr-qualOpcao'));

            // $(this).next().addAttr('checked');
            // alert('formato 1 > '+formato);
            // var formato = '';
            // alert('formato 2 > '+formato);

            // var formato = $('input[name="formatoImersao"]:checked').val();
            // alert('formato 3 > '+formato);
        });
    });
</script>