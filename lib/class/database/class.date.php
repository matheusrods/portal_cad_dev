<?php

class clsData {

    public static function adicionarDias($data, $quantidade, $strIntervalo = "d", $bolRetornaDiaUtil = false, $bolSabadoDiaUtil = false) {

        $dia = null;
        $mes = null;
        $ano = null;
        $hora = null;
        $minuto = null;
        $segundo = null;
        $vetor = explode("/", $data);

        if (count($vetor) == 3) {
            /* dd/mm/aaaa */
            $dia = $vetor[0];
            $mes = $vetor[1];
            $ano = $vetor[2];
        } else {
            /* aaaa-mm-dd */
            $vetor = explode("-", $data);
            $dia = $vetor[2];
            $mes = $vetor[1];
            $ano = $vetor[0];
        }
        /* Hora */
        if (strlen($data) > 10) {

            $horaData = substr($data, 10);
            $vetorHora = explode(":", $horaData);

            $hora = $vetorHora['0'];
            $minuto = $vetorHora['1'];
            $segundo = $vetorHora['2'];
        }

        switch ($strIntervalo) {
            case "y": {
                    $ano += $quantidade;
                    break;
                }
            case "m": {
                    $mes += $quantidade;
                    break;
                }
            case "h": {
                    $hora += $quantidade;
                    break;
                }
            case "i": {
                    $minuto += $quantidade;
                    break;
                }
            case "s": {
                    $segundo += $quantidade;
                    break;
                }
            case "d":
            default: {
                    $dia += $quantidade;
                    break;
                }
        }
        $novaData = mktime($hora, $minuto, $segundo, $mes, $dia, $ano);

        if ($bolRetornaDiaUtil) {

            $diaSemana = date("w", $novaData);
            if ($diaSemana == 0) {
                $novaData = mktime($hora, $minuto, $segundo, $mes, $dia + 1, $ano);
            }
            if (!$bolSabadoDiaUtil) {
                if ($diaSemana == 6) {
                    $novaData = mktime($hora, $minuto, $segundo, $mes, $dia + 2, $ano);
                }
            }
        }

        $dataFormatada = null;

        if (in_array($strIntervalo, array("h", "i", "s"))) {
            $dataFormatada = strftime("%Y-%m-%d %H:%M:%S", $novaData);
        } else {
            $dataFormatada = strftime("%Y-%m-%d", $novaData);
        }

        return $dataFormatada;
    }

    public static function adicionarHoras($hora, $quantidade, $strIntervalo = "h", $bolRetornaSegundos = false) {

        $vetor = explode(":", $hora);

        $hora = $vetor[0];
        $minuto = $vetor[1];
        $segundo = (count($vetor) == 3) ? $vetor[2] : 0;

        switch ($strIntervalo) {

            case "h": {
                    $hora += $quantidade;
                    break;
                }

            case "m": {
                    $minuto += $quantidade;
                    break;
                }

            case "s": {
                    $segundo += $quantidade;
                    break;
                }
        }

        $novaHora = mktime($hora, $minuto, $segundo, 0, 0, 0);

        if ($bolRetornaSegundos) {
            return strftime("%H:%M:%S", $novaHora);
        } else {
            return strftime("%H:%M", $novaHora);
        }
    }

    public static function adicionarDiasUteis($data, $dias, $bolSabadoDiaUtil = false) {
        /* Caso seja informado uma data do MySQL do tipo DATETIME - aaaa-mm-dd 00:00:00
          Transforma para DATE - aaaa-mm-dd */
        $data = substr($data, 0, 10);

        /* Se a data estiver no formato brasileiro: dd/mm/aaaa
          Converte-a para o padrão americano: aaaa-mm-dd */
        if (preg_match("@/@", $data) == 1) {
            $data = implode("-", array_reverse(explode("/", $data)));
        }

        $array_data = explode('-', $data);
        $intContador = 1;
        $intContadorDiasUteis = 1;
        $intDias = abs($dias);
        while ($intContadorDiasUteis < $intDias) {
            $dia_da_semana = date('w', strtotime('+' . $intContador . ' day', mktime(0, 0, 0, $array_data[1], $array_data[2], $array_data[0])));

            if ($dia_da_semana == '6') {
                if ($bolSabadoDiaUtil) {
                    $intContadorDiasUteis++;
                }
            } else if ($dia_da_semana != '0') {
                $intContadorDiasUteis++;
            }
            $intContador++;
        }

        $strSinal = ($dias >= 0) ? "+" : "-";

        return date('Y-m-d', strtotime($strSinal . $intContador . ' day', strtotime($data)));
    }

}
////Carregamos a classe
//require_once("class.date.php");
// 
//$data = "17/01/2016"; //Pode ser no formato aaaa-mm-dd também
// 
////Vamos somar 15 dias
//echo clsData::adicionarDias($data, 15, "d"); //Vai exibir na tela a data 21/06/2014
//echo '<br>';
////Vamos subtrair 6 dias
//echo clsData::adicionarDias($data, -6, "d"); //Vai exibir na tela a data 31/05/2014
//echo '<br>'; 
////Vamos adicionar 1 dia, mas retornar apenas uma data que seja dia útil
//echo clsData::adicionarDias($data, 1, "d", true, false); //Vai exibir na tela a data 09/06/2014, pois dia 07/06 é sábado e 08/06 é domingo. O próximo dia útil é dia 09/06.
//echo '<br>';
////Vamos adicionar 1 dia, mas retornar apenas uma data que seja dia útil, considerando sábado como dia útil
//echo clsData::adicionarDias($data, 1, "d", true, true); //Vai exibir na tela a data 07/06/2014
//echo '<br>'; 
////Vamos adicionar 2 meses
//echo clsData::adicionarDias($data, 2, "m"); //Vai exibir na tela a data 06/08/2014
//
//echo '<br><br><br>';
//$hora = "02:57:22";
////Vamos adicionar 2 horas
//echo clsData::adicionarHoras($hora, 2, "h", true); //Vai exibir na tela 04:57:22
//echo '<br>';
////Vamos adicionar 90 minutos e ignorar os segundos
//echo clsData::adicionarHoras($hora, 90, "m", false); //Vai exibir na tela 06:27
//
//
////Carregamos a classe
//echo '<br><br><br>';
// 
//$data = "06/01/2016";
// 
////Vamos adicionar 22 dias úteis
//echo clsData::adicionarDiasUteis($data, 5); //Vai imprimir 08/07/2014
?>