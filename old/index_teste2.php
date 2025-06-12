<?php

ini_set("display_errors", E_ALL);
session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

// var_dump($_SESSION);
// die;

Class funcoes {

    public function consultaTemas(){

        $db = New Database('noticias');
        $query = "SELECT * FROM temas WHERE ativo = 1 ORDER BY tema;";
        // $query = "SELECT * FROM cad.squads WHERE idSetor = 4 order by squad ASC;";
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $montaBotoesTemas = '<div class="divisaoTemas">';
                $qtdTemas = sizeof($execQuery);
                $qtdTemasLinha = ceil($qtdTemas/2);
                
                for($i = 0; $i < sizeof($execQuery); $i++){
                    if($i == ($qtdTemasLinha)){
                        $montaBotoesTemas = $montaBotoesTemas.'
                            </div> <div class="divisaoTemas"><div id="temaNoticias'.$execQuery[$i]['id'].'" class="botoesFiltroTema Clicar" attr-id='.$execQuery[$i]['id'].' attr-filtroAtivo="0" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #E4ECFF; border-radius: 100px; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                                <div style="color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">'.$execQuery[$i]['tema'].'</div>
                            </div>';
                    } else {
                        $montaBotoesTemas = $montaBotoesTemas.'
                            <div id="temaNoticias'.$execQuery[$i]['id'].'" class="botoesFiltroTema Clicar" attr-id='.$execQuery[$i]['id'].' attr-filtroAtivo="0" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #E4ECFF; border-radius: 100px; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                                <div style="color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">'.$execQuery[$i]['tema'].'</div>
                            </div>';
                    }
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaBotoesTemas;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $geraLog->geraLogExcecao("noticias", "consultaTemas", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível consultar a página de Notícias. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            return ($retorno);
        }
    }
}


$class = new funcoes();
$temas = $class->consultaTemas();

echo '
<div class="divBotoesFiltroTema">
    
    '.$temas['mensagem'].'
    
</div>

';