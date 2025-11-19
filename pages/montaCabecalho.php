<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['matricula'] = 'F0285739';
$_SESSION['nome'] = 'Matheus Rodrigues';
$_SESSION['cargo'] = 'Analista Tec Pleno';
$_SESSION['MAIL'] = 'albert.rosa@bb.com.br';
$_SESSION['dependencia'] = '1901';
$_SESSION['ip'] = '10.10.10.10';

if ($_SESSION['matricula'] == 'F0285739') {
    $_SESSION['DEPE'] = '11111111';
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";

if (!class_exists('cabecalho')) {
    class cabecalho
    {
        public $mat;
        public $dep;

        public function __construct()
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $this->mat = $_SESSION['matricula'];
            $this->dep = $_SESSION["DEPE"];
            $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
        }

        // Função de montagem de menu do cabeçalho
        public function montaCabecalho()
        {
            $emProducao = "producao = 1";

            $dbDev = new Database("cad");
            $queryDev = "SELECT * FROM cad.desenvolvedores WHERE matricula = '" . $_SESSION['matricula'] . "' AND ativo = 1;";
            $execQueryDev = $dbDev->DbGetAll($queryDev);

            if (sizeof($execQueryDev) > 0) {
                $emProducao = "producao IN (0, 1)";
            }

            $exclusivoCad = "exclusivoCad = 0";
            if ($_SESSION["DEPE"] == "1901") {
                $exclusivoCad = "exclusivoCad IN (0, 1)";
            }

            $db = new Database('intranet');
            $_SESSION["cod_uor"] = "532286,514424,532283,514416";

            $query = "SELECT * FROM intranet.cabecalho_item 
                      WHERE ativo = 1 AND " . $emProducao . " 
                      AND (" . $exclusivoCad . " OR uorPermitida IN('" . $_SESSION["cod_uor"] . "'));";

            $execQuery = $db->DbGetAll($query);
            $cabecalho = '';

            // 🔧 correção: removido "<span"
            for ($i = 0; $i < sizeof($execQuery); $i++) {
                $classLinkInterno = '';
                $nomePaginaInterna = '';

                if ($execQuery[$i]['tipo'] == 2) {
                    $classLinkInterno = 'linkInterno';
                    $nomePaginaInterna = 'attr-linkInterno="' . $execQuery[$i]['nomePaginaInterna'] . '"';
                }

                $cabecalho .= '<div id="' . $execQuery[$i]['id'] . '" 
                    class="divCabecalho ' . $classLinkInterno . ' Clicar" ' . $nomePaginaInterna . '>
                        <span class="textoMenuCabecalho" 
                              style="color: #465EFF; font-size: 16px; font-family: BancoDoBrasil Titulos; 
                              font-weight: 500; word-wrap: break-word;">
                            ' . $execQuery[$i]['item'] . '
                        </span>
                    </div>';
            }

            return $cabecalho;
        }

        // Função de montagem dos submenus do cabeçalho
        public function montaSubMenus()
        {
            $emProducao = "a.producao = 1";

            $dbDev = new Database("cad");
            $queryDev = "SELECT * FROM cad.desenvolvedores WHERE matricula = '" . $_SESSION['matricula'] . "' AND ativo = 1;";
            $execQueryDev = $dbDev->DbGetAll($queryDev);

            if (sizeof($execQueryDev) > 0) {
                $emProducao = "a.producao IN (0, 1)";
            }

            $exclusivoCad = "a.exclusivoCad = 0 AND b.exclusivoCad = 0";
            if ($_SESSION["DEPE"] == "1901") {
                $exclusivoCad = "a.exclusivoCad IN (0, 1) AND b.exclusivoCad IN (0, 1)";
            }

            $db = new Database('intranet');
            $queryItens = "SELECT DISTINCT(vinculoItem) AS vinculoItem
                           FROM intranet.cabecalho_subitem a
                           LEFT JOIN intranet.cabecalho_item b ON a.vinculoItem = b.id
                           WHERE b.ativo = 1 AND a.ativo = 1 AND " . $exclusivoCad . " AND " . $emProducao . "
                           ORDER BY vinculoItem ASC;";

            $totalItens = $db->DbGetAll($queryItens);
            $divItemCompleta = '';

            for ($i = 0; $i < sizeof($totalItens); $i++) {
                $divItem = '';
                $queryCompleta = "
                    SELECT *
                    FROM intranet.cabecalho_subitem a
                    LEFT JOIN intranet.cabecalho_item b ON a.vinculoItem = b.id
                    WHERE b.ativo = 1 AND a.ativo = 1 
                      AND vinculoItem = " . $totalItens[$i]['vinculoItem'] . " 
                      AND " . $emProducao . " AND " . $exclusivoCad . "
                    ORDER BY vinculoItem ASC, ordem;";

                $execQuery = $db->DbGetAll($queryCompleta);

                for ($j = 0; $j < sizeof($execQuery); $j++) {
                    $larguraDiv = round(100 / (sizeof($execQuery)), 2);
                    $linhaVertical = '<div class="divisorCabecalho" 
                        style="width: 4rem; height: 0px; transform: rotate(90deg); 
                               transform-origin: 0 0; border: 1px #B4B9C1 solid"></div>';

                    if ($j == 0) {
                        $linhaVertical = '';
                    }

                    $divItem .= $linhaVertical . '
                        <div class="subItem Clicar" attr-linkInterno="' . $execQuery[$j]['url'] . '" 
                             style="width: ' . $larguraDiv . '%; height: 4.5rem; 
                             justify-content: center; align-items: center; gap: 8px; display: flex">
                            <div style="width: 56px; position: relative">
                                <i class="' . $execQuery[$j]['iconeCabecalho'] . '" 
                                   aria-hidden="true" 
                                   style="color: #07B4F2; font-size: 48px;"></i>
                            </div>
                            <div style="flex-direction: column; justify-content: center; 
                                        align-items: flex-start; display: inline-flex">
                                <div style="color: #1653FD; font-size: 20px; 
                                            font-family: BancoDoBrasil Titulos; 
                                            font-weight: 700; word-wrap: break-word">'
                                    . $execQuery[$j]['subitem'] . '
                                </div>
                                <div style="width: 262px; color: #6C7077; font-size: 11px; 
                                            font-family: BancoDoBrasil Titulos; 
                                            font-weight: 700; word-wrap: break-word">'
                                    . $execQuery[$j]['descricao'] . '
                                </div>
                            </div>
                        </div>';
                }

                $divItemCompleta .= '
                    <div id="item' . $totalItens[$i]['vinculoItem'] . '" 
                         style="display: none; margin-top: 0.5rem; background-color: #FEFEFE; 
                                border-bottom-left-radius: 30px; border-bottom-right-radius: 30px;">
                        <div style="width: 100%; height: 100%; padding: 16px 32px; opacity: 0.90; 
                                    background: #FEFEFE; border-top-left-radius: 8px; 
                                    border-top-right-radius: 8px; justify-content: flex-start; 
                                    align-items: flex-start; display: inline-flex; 
                                    border-bottom-left-radius: 30px; border-bottom-right-radius: 30px;">'
                            . $divItem .
                        '</div>
                    </div>';
            }

            return $divItemCompleta;
        }
    }
}