<?php

if(!isset($_SESSION)){
    session_start();
}

//ini_set("display_errors", E_ALL);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/incidentes/class/class_incidentes.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Incidentes', $_SESSION['ip']);

$class = new funcoes();
$incidentes = $class->consultaIncidentes();
$tipoIncidente = $class->consultaTipoIncidente();
$statusIncidentes = $class->consultaStatus();
$ambientes = $class->consultaAmbiente();
$dependencia = $class->consultaDepencias();

echo '<!-- CSS específico do app --><link href="/lib/apps/incidentes/css/incidentes.css" rel="stylesheet">';
echo '<!-- JS específico do app --><script type="text/javascript" src="/lib/apps/incidentes/js/incidentes.js"></script>';
echo '
    <div id="containerPaginaIncidentes">
        <div class= "capaIncidentes">
            <div class="textoCapa">
                <div class ="tituloCapa"> Ocorreu algum incidente?</div>
                <div class= "subTitulo">  Reporte e acompanhe incidentes no Bot BB com facilidade e eficiência </div>
                <div class="botoesCadastraSaibaMais">
                    <div class="botaoCadastraIncidente Clicar">
                        <div class="textoBotaoCadastraIncidente">Cadastrar Incidente</div>
                    </div>
                    <div class="botaoSaibaMaisIncidente Clicar">
                        <a href="https://cad.bb.com.br/lib/apps/recursos/arquivos/guiaEstouComUmProblema.ppsx" target="_blank" style="text-decoration: none;">
                            <div class="textoBotaoCadastraIncidente">Saiba Mais</div>
                        </a>
                    </div>
                </div>
            </div>
            <img class= "imgCapaIncidentes" src="https://cad.bb.com.br/lib/img/apps/incidentes/capaIncidentes.svg" />
        </div>
        <div class="areaIncidentes">
           <div id="tituloIncidentesCadastrados"><span>Incidentes cadastrados</span></div>
            <form> 
                <div class="areaPesquisaFiltros">
                    <div class="filtros">
                        <div class="divFiltrosPrimeiraLinha">
                            <div class="campoPesquisaInt">
                                <div style="position: relative">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </div>
                                <div style="flex: 1 1 0; height: 20px; justify-content: flex-start; align-items: center; display: flex">
                                    <input type="text" class="inputCampoPesquisa itemPesquisa" attr-campoAlterado=0 id="campoNumIntIssue" placeholder="Procure pela INT/ISSUE">
                                </div>
                            </div>
                            <div class="campoFiltroPesquisa">
                                <select name="campoTipoIncidente" id="campoTipoIncidente" class= "selectFiltroPesquisa itemPesquisa" attr-campoAlterado=0 style= "width: 90%;">
                                    <option>Tipo de incidente</option>
                                '.$tipoIncidente['mensagem'].'
                                
                                </select>
                            </div>
                            <div class="campoFiltroPesquisa">
                                <select name="campoStatusIncidente" id="campoStatusIncidente" class= "selectFiltroPesquisa itemPesquisa" attr-campoAlterado= "0" style= "width: 90%;">
                                    <option>Status</option>
                                    '.$statusIncidentes['mensagem'].'
                                </select>
                            </div>
                            <div class="divBtnPesquisa divBtnMaisFiltros">
                                <input type="button" class="btnPersonalizar maisFiltros" value="Mais filtros" id= ""> 
                            </div>
                            <div class="divBtnPesquisa divBtnLimparFiltrosPrimeiraLinha">
                                <input type="button" class="btnPersonalizar limparFiltros" value="Limpar" id=""> 
                            </div>
                            <div class="divOcultaBtnFiltros" style="display: none; width: 29%;"></div>
                        </div> <!--Final da div da primeira linhas-->
                        <div class="divFiltrosSegundaLinha"> <!--Área de filtros que inicialmente ficará oculta-->
                           <div class="campoFiltroPesquisaSegundaLinha">
                                <select name="campoAmbiente" id="campoAmbiente" class= "selectFiltroPesquisa itemPesquisa" attr-campoAlterado= "0" style= "width: 90%;">
                                    <option>Ambiente</option>
                                    '.$ambientes['mensagem'].'
                                </select>
                            </div>
                            <div class="campoFiltroPesquisaSegundaLinha">
                                <select name="campoDependencia" id="campoDependencia" class= "selectFiltroPesquisa itemPesquisa" attr-campoAlterado= "0" style= "width: 90%;">
                                    <option>Dependência Abertura</option>
                                    '.$dependencia['mensagem'].'
                                </select>
                            </div>
                            <div class="campoFiltroPesquisaSegundaLinha">
                                <input type="text" 
                                       onfocus= this.type="date" 
                                       onblur= this.type="text"
                                       class="inputCampoPesquisa itemPesquisa" 
                                       attr-campoAlterado= "0"
                                       id="dataAbertura" 
                                       placeholder="Data Abertura" 
                                       style= "width: 90%;"
                                       max="'.date("Y-m-d").'">
                            </div>
                            <div class="campoFiltroPesquisaSegundaLinha">
                                <input type="text" 
                                       onfocus= this.type="date" 
                                       onblur= this.type="text"
                                       class="inputCampoPesquisa itemPesquisa" 
                                       attr-campoAlterado= "0"
                                       id="dataEncerramento" 
                                       placeholder="Data Encerramento" 
                                       style= "width: 90%;"
                                       max="'.date("Y-m-d").'">
                            </div>
                            <div class="divBtnPesquisa divBtnMenosFiltros">
                                <input type="button" class="btnPersonalizar menosFiltros" value="Menos filtros" id=" "> 
                            </div>
                            <div class="divBtnPesquisa divBtnLimparFiltrosSegundaLinha">
                                <input type="button" class="btnPersonalizar limparFiltros" value="Limpar" id=" "> 
                            </div>
                        </div>
                    </div>
                </div> 
            </form>

            <div class="areaTabelaIncidentes">
                '.$incidentes['mensagem'].'
            </div>
        </div>
    </div>
    <script>
        function datatable(){
            $("#tabelaIncidentes").DataTable({
                dom: "Brtip",
                buttons: [ "excelHtml5" ],
                order: [[0, "desc"]],
                language: {
                    url:"https://cad.bb.com.br/lib/datatables/pt_br.json"
                },
                "initComplete": function(){ 
                    $("#tabelaIncidentes").show(); 
                }
            });
        }
    </script>
';

include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php";