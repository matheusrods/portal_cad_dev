<?php

// ini_set('display_startup_errors', 1);
session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

$geraLog = new geraLog();

Class funcoes {

    public $caminhoLogErro;

    // Função padrão do PHP para declaração de variáveis que serão utilizadas em outras funções
    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
        
        $caminhoLogErro = $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
        $this->mat = $_SESSION['matricula'];
    }

    // Função que consulta os Grandes Números (resumo) de Pessoa Física
    public function consultaGrandesNumerosPf($data){
        $mat = $_SESSION['matricula'];

        // if($mat == 'F0285739'){
        //     $data = '2024-04-24';
        // }

        $db = New Database('report');

        $query = "call report.consultaGrandesNumerosPf('".$data."');";
                    
        try{
            $execQuery = $db->DbGetAll($query);

            if($execQuery){
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $execQuery;
            }
        } catch(Exception $e){
            $retorno = array();
            $informacoesErro = "erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("analytics", "consultaGrandesNumerosPf", $informacoesErro, $mat);
            $retorno["status"] = 0;
            $retorno["mensagem"] = "<p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar os Grandes Números Pessoa Física. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    // Função que consulta os Grandes Números (resumo) de Pessoa Jurídica
    public function consultaGrandesNumerosPj($data){
        $mat = $_SESSION['matricula'];
        $db = New Database('report');

        $query = "call report.consultaGrandesNumerosPj('".$data."');";
                    
        try{
            $execQuery = $db->DbGetAll($query);

            if($execQuery){
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $execQuery;
            }
        } catch(Exception $e){
            $retorno = array();
            $informacoesErro = "erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("analytics", "consultaGrandesNumerosPj", $informacoesErro, $mat);
            $retorno["status"] = 0;
            $retorno["mensagem"] = "<p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar os Grandes Números Pessoa Jurídica. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    // Função que consulta os Números Acumulados
    public function consultaNumerosAcumulados($data){
        $mat = $_SESSION['matricula'];
        $db = New Database('report');

        $query = "call report.consultaNumerosAcumulados('".$data."');";
                    
        try{
            $execQuery = $db->DbGetAll($query);

            if($execQuery){
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $execQuery;
            }
        } catch(Exception $e){
            $retorno = array();
            $informacoesErro = "erro: " . $e . "\n\n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("analytics", "consultaNumerosAcumulados", $informacoesErro, $mat);
            $retorno["status"] = 0;
            $retorno["mensagem"] = "<p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar os Números Acumulados. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    // Função para atualização dos Grandes Números PF quando se altera a data
    public function atualizaGrandesNumerosPf($data){
        
        $consultaGrandesNumerosPf = $this->consultaGrandesNumerosPf($data);
        
        if($consultaGrandesNumerosPf['status'] == 0){
            $dadosGrandesNumerosPf = '<div class="erroGrandesNumeros" style="background:#002D4B; margin-top: 5%;">'.$consultaGrandesNumerosPf['mensagem'].'</div>'.$grandesNumerosErro;
        } else {
            
            if(($consultaGrandesNumerosPf['mensagem'][0]['interacoesPf']) >= '1000000'){
                $textoInteracoesPf = 'de interações';
            } else {
                $textoInteracoesPf = 'interações';
            }
        
            if(($consultaGrandesNumerosPf['mensagem'][0]['usuariosPf']) >= '1000000'){
                $textoUsuariosPf = 'de usuários';
            } else {
                $textoUsuariosPf = 'usuários';
            }
        
            if(($consultaGrandesNumerosPf['mensagem'][0]['totalIndisp']) == 1){
                $textoIndisponibilidadePf = 'indisponibilidade';
            } else {
                $textoIndisponibilidadePf = 'indisponibilidades';
            }
        
            if(($consultaGrandesNumerosPf['mensagem'][0]['totalIndisp']) == 0){
                $textoPlural = "";
                $textoDetalhadoIndisponibilidadePfLinha1 = 'Uhu!<br>';
                if($consultaGrandesNumerosPf['mensagem'][0]['maxDataFim'] > 1){
                    $textoPlural = "s";
                }
                $textoDetalhadoIndisponibilidadePf = 'Estamos há '.$consultaGrandesNumerosPf['mensagem'][0]['maxDataFim'].' dia'.$textoPlural.' sem indisponibilidade'.$textoPlural.'.';
            } else {
                $textoPlural = "";
                if(($consultaGrandesNumerosPf['mensagem'][0]['totalIndisp']) > 1){
                    $textoPlural = "s";
                }
                $textoDetalhadoIndisponibilidadePfLinha1 = 'Indisponibilidade'.$textoPlural.' em '.$consultaGrandesNumerosPf['mensagem'][0]['dataFormatada'].':';
                $textoDetalhadoIndisponibilidadePf = $consultaGrandesNumerosPf['mensagem'][0]['textoIndisp'];
            }
        
            $dadosGrandesNumerosPf = '
                <div class="efeitoAnalytics dadosTodosQuadros dadosLinha1 dadosColuna1" attr-idInfo="1">
                    <div class="resumoNumerosAnalytics1 dadosTodosQuadros overflowQuadroInterno" style="border-top-left-radius: 100px; background: #00FFE0; z-index: 2;">
                        <img style="width: 176px; height: 144.72px; top: 70.64px; position: absolute" src="/lib/img/apps/analytics/1.png" />
                        <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                            <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word;">'.$this->formataExibicao($consultaGrandesNumerosPf['mensagem'][0]['interacoesPf']).'<br/></span>
                            <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word;">'.$textoInteracoesPf.'</span>
                        </div>
                    </div>
                    <div class="detalheNumerosAnalytics1 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                        <div class="textoDetalhesAnalytics">
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Interações:<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['interacoesPf'],0,",",".").'<br/><br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['mediaInteracoesPf'],0,",",".").'<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['interacoesPfD7'],0,",",".").'</span>
                        </div>
                        <img class="imagemDetalhesAnalytics" style="width: 176px; height: 144.72px; top: 250px; position: absolute" src="/lib/img/apps/analytics/1_alt.png" />
                    </div>
                </div>
                <div class="efeitoAnalytics dadosTodosQuadros dadosLinha1 dadosColuna2" attr-idInfo="2">
                    <div class="resumoNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; background: #00FFE0; z-index: 2;">
                        <img style="width: 176px; height: 144.72px; top: 70.64px; position: absolute" src="/lib/img/apps/analytics/2.png" />
                        <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                            <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$this->formataExibicao($consultaGrandesNumerosPf['mensagem'][0]['usuariosPf']).'<br/></span>
                            <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$textoUsuariosPf.'</span>
                        </div>
                    </div>
                    <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                        <div class="textoDetalhesAnalytics">
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Usuários:<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['usuariosPf'],0,",",".").'<br/><br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['mediaUsuariosPf'],0,",",".").'<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['usuariosPfD7'],0,",",".").'</span><br>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">90 Dias: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['usuariosPf90D'],0,",",".").'</span>
                        </div>
                        <img class="imagemDetalhesAnalytics" style="width: 176px; height: 144.72px; top: 255px; position: absolute" src="/lib/img/apps/analytics/2_alt.png" />
                    </div>
                </div>
                <div class="efeitoAnalytics dadosTodosQuadros dadosLinha1 dadosColuna3" attr-idInfo="3">
                    <div class="resumoNumerosAnalytics3 dadosTodosQuadros overflowQuadroInterno" style="border-top-left-radius: 100px; border-top-right-radius: 100px; background: #00FFE0; z-index: 2;">
                        <img style="width: 176px; height: 144.72px; top: 70.64px; position: absolute" src="/lib/img/apps/analytics/3.png" />
                        <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                            <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$this->formataExibicao($consultaGrandesNumerosPf['mensagem'][0]['conversasPf']).'<br/></span>
                            <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.(($consultaGrandesNumerosPf['mensagem'][0]['conversasPf'] > 999999) ? "de " : "" ).'conversas</span>
                        </div>
                    </div>
                    <div class="detalheNumerosAnalytics3 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                        <div class="textoDetalhesAnalytics">
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Conversas:<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['conversasPf'],0,",",".").'<br/><br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['mediaConversasPf'],0,",",".").'<br/>
                            </span><span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['conversasPfD7'],0,",",".").'</span>
                        </div>
                        <img class="imagemDetalhesAnalytics" style="width: 176px; height: 144.72px; top: 250px; position: absolute" src="/lib/img/apps/analytics/3_alt.png" />
                    </div>
                </div>
                <div class="efeitoAnalytics dadosTodosQuadros dadosLinha2 dadosColuna1" attr-idInfo="4">
                    <div class="resumoNumerosAnalytics4 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-right-radius: 100px; background: #00FFFF; z-index: 2;">
                        <img style="width: 161px; height: 147px; /*left: 147.50px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/4.png" />
                        <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                            <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$consultaGrandesNumerosPf['mensagem'][0]['notaMediaPf'].' de nota<br/></span>
                            <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">na avaliação dos usuários</span>
                        </div>
                    </div>
                    <div class="detalheNumerosAnalytics4 dadosTodosQuadros overflowQuadroInterno" z-index: 1;">
                        <div class="textoDetalhesAnalytics">
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Nota Avaliações: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPf['mensagem'][0]['notaMediaPf'].'<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPf['mensagem'][0]['notaMediaPf30d'].'<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPf['mensagem'][0]['notaMediaPfD7'].'<br/><br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Qtd. Avaliações:</span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['qtdAvaliacoesPf'],0,",",".").'<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['qtdMediaAvaliacoesPf30d'],0,",",".").'<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['qtdMediaAvaliacoesPfD7'],0,",",".").'</span>
                        </div>
                        <img class="imagemDetalhesAnalytics iconeResponsivo" style="width: 133px; height: 133px;  top: 255px; position: absolute" src="/lib/img/apps/analytics/4_alt.png" />
                    </div>
                </div>
                <div class="efeitoAnalytics dadosTodosQuadros dadosLinha2 dadosColuna2" attr-idInfo="5">
                    <div class="resumoNumerosAnalytics5 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-left-radius: 100px; background: #EFF0A7; z-index: 2;">
                        <img style="width: 133px; height: 154px; /*left: 147.50px;*/ top: 71px; position: absolute;" src="/lib/img/apps/analytics/5.png" />
                        <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                            <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$this->formataExibicao($consultaGrandesNumerosPf['mensagem'][0]['totalAtivosEnviados']).'<br/></span>
                            <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">ativos enviados</span>
                        </div>
                    </div>
                    <div class="detalheNumerosAnalytics5 dadosTodosQuadros overflowQuadroInterno" style="z-index: 1;">
                        <div class="textoDetalhesAnalytics">
                            <!-- <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Ativos Enviados: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['totalAtivosEnviados'],0,",",".").'<br/></span>
                            <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Principais Ativos:<br/>42.393:</span>
                            <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word"> ativo_compra_negada_limite_2<br/></span>
                            <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">28.610:</span>
                            <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word"> ativo_inducao_opf_para_credito<br/></span>
                            <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">21.676:</span>
                            <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word"> boas_vindas_whatsapp<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">347.192<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">234.118</span> -->

                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Ativos Enviados: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['totalAtivosEnviados'],0,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Principais Ativos:<br/>'.number_format($consultaGrandesNumerosPf['mensagem'][0]['qtdEnviada1'],0,",",".").':</span>
                    <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word"> '.$consultaGrandesNumerosPf['mensagem'][0]['nomeAtivo1'].'<br/></span>
                    <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['qtdEnviada2'],0,",",".").':</span>
                    <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word"> '.$consultaGrandesNumerosPf['mensagem'][0]['nomeAtivo2'].'<br/></span>
                    <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['qtdEnviada3'],0,",",".").':</span>
                    <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word"> '.$consultaGrandesNumerosPf['mensagem'][0]['nomeAtivo3'].'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['mediaAtivosEnviados'],0,",",".").'<br/></span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                    <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPf['mensagem'][0]['ativosEnviadosD7'],0,",",".").'</span>
                        </div>
                        <img class="imagemDetalhesAnalytics iconeResponsivo" style="width: 133px; height: 154px;  top: 241px; position: absolute; display: none;" src="/lib/img/apps/analytics/5_alt.png" />
                    </div>
                </div>
                <div class="efeitoAnalytics dadosTodosQuadros dadosLinha2 dadosColuna3" attr-idInfo="6">
                    <div class="resumoNumerosAnalytics6 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-left-radius: 100px; background: #F0A7AB; z-index: 2;">
                        <img style="width: 133px; height: 154px; top: 71px; position: absolute" src="/lib/img/apps/analytics/6.png" />
                        <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                            <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word; letter-spacing: 0px !important;">'.$consultaGrandesNumerosPf['mensagem'][0]['totalIndisp'].'<br/></span>
                            <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$textoIndisponibilidadePf.'</span>
                        </div>
                    </div>
                    <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                        <div class="textoDetalhesAnalytics">
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">'.$textoDetalhadoIndisponibilidadePfLinha1.'<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$textoDetalhadoIndisponibilidadePf.'</span>
                        </div>
                        <img class="imagemDetalhesAnalytics" style="width: 133px; height: 154px; top: 241px; position: absolute" src="/lib/img/apps/analytics/6_alt.png" />
                    </div>
                </div>
                <div class="efeitoAnalytics dadosTodosQuadros dadosLinha3 dadosColuna1" attr-idInfo="7">
                    <div class="resumoNumerosAnalytics7 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-left-radius: 100px; border-top-right-radius: 100px; background: #CBA7F0; z-index: 2;">
                        <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/7.png" />
                        <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                            <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$this->formataExibicao($consultaGrandesNumerosPf['mensagem'][0]['totalRao']).'<br/></span>
                            <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em acordos RAO</span>
                        </div>
                    </div>
                    <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                        <div class="textoDetalhesAnalytics">
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ '.number_format($consultaGrandesNumerosPf['mensagem'][0]['totalRao'],0,",",".").'<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPf['mensagem'][0]['qtdRao'].' Acordos</span>
                        </div>
                        <img class="imagemDetalhesAnalytics" style="width: 136px; height: 146px; /*left: 167px;*/ top: 248px; position: absolute" src="/lib/img/apps/analytics/7_alt.png" />
                    </div>
                </div>
                <div class="efeitoAnalytics dadosTodosQuadros dadosLinha3 dadosColuna2" attr-idInfo="8">
                    <div class="resumoNumerosAnalytics8 dadosTodosQuadros overflowQuadroInterno" style="border-top-left-radius: 100px; background: #CBA7F0; z-index: 2;">
                        <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/8.png" />
                        <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                            <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$this->formataExibicao($consultaGrandesNumerosPf['mensagem'][0]['totalAtivos']).'<br/></span>
                            <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em Ativos S/A</span>
                        </div>
                    </div>
                    <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                        <div class="textoDetalhesAnalytics">
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ '.number_format($consultaGrandesNumerosPf['mensagem'][0]['totalAtivos'],0,",",".").'<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPf['mensagem'][0]['qtdAtivos'].' Acordos</span></div>
                        <img class="imagemDetalhesAnalytics" style="width: 136px; height: 146px; /*left: 167px;*/ top: 248px; position: absolute" src="/lib/img/apps/analytics/8_alt.png" />
                    </div>
                </div>
                <div class="efeitoAnalytics dadosTodosQuadros dadosLinha3 dadosColuna3" attr-idInfo="9">
                    <div class="resumoNumerosAnalytics9 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-right-radius: 100px; background: #CBA7F0; z-index: 2;">
                        <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/9.png" />
                        <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                            <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$this->formataExibicao($consultaGrandesNumerosPf['mensagem'][0]['totalCdc']).'<br/></span>
                            <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em CDC</span>
                        </div>
                    </div>
                    <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                        <div class="textoDetalhesAnalytics">
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ '.number_format($consultaGrandesNumerosPf['mensagem'][0]['totalCdc'],0,",",".").'<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPf['mensagem'][0]['qtdCdc'].' Contratações</span>
                        </div>
                        <img class="imagemDetalhesAnalytics" style="width: 136px; height: 146px; /*left: 167px;*/ top: 248px; position: absolute" src="/lib/img/apps/analytics/9_alt.png" />
                    </div>
                </div>
            ';
        }

        $retorno = array();
        $retorno["status"] = 1;
        $retorno["mensagem"] = $dadosGrandesNumerosPf;
        // $retorno = $dadosGrandesNumerosPf;
        return $retorno;
    }

    // Função para 
    public function atualizaGrandesNumerosPj($data){
        $consultaGrandesNumerosPj = $this->consultaGrandesNumerosPj($data);

        if($consultaGrandesNumerosPj['status'] == 0){
            $dadosGrandesNumerosPj = '<div class="erroGrandesNumeros" style="background:#002D4B; margin-top: 5%;">'.$consultaGrandesNumerosPj['mensagem'].'</div>'.$grandesNumerosErro;
        } else {
            if(($consultaGrandesNumerosPj['mensagem'][0]['interacoesPj']) >= '1000000'){
                $textoInteracoesPj = 'de interações';
            } else {
                $textoInteracoesPj = 'interações';
            }
        
            if(($consultaGrandesNumerosPj['mensagem'][0]['usuariosPj']) >= '1000000'){
                $textoUsuariosPj = 'de usuários';
            } else {
                $textoUsuariosPj = 'usuários';
            }
        
        
            $dadosGrandesNumerosPj = '
                <div class="efeitoAnalytics dadosTodosQuadros dadosLinha1 dadosColuna1" attr-idInfo="1">
                    <div class="resumoNumerosAnalytics1 dadosTodosQuadros overflowQuadroInterno" style="border-top-left-radius: 100px; background: #00FFE0; z-index: 2;">
                        <img style="width: 176px; height: 144.72px; top: 70.64px; position: absolute" src="/lib/img/apps/analytics/1.png" />
                        <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                            <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word;">'.$this->formataExibicao($consultaGrandesNumerosPj['mensagem'][0]['interacoesPj']).'<br/></span>
                            <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word;">'.$textoInteracoesPj.'</span>
                        </div>
                    </div>
                    <div class="detalheNumerosAnalytics1 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                        <div class="textoDetalhesAnalytics">
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Interações:<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['interacoesPj'],0,",",".").'<br/><br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['mediaInteracoesPj'],0,",",".").'<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['interacoesPjD7'],0,",",".").'</span>
                        </div>
                        <img class="imagemDetalhesAnalytics" style="width: 176px; height: 144.72px; top: 250px; position: absolute" src="/lib/img/apps/analytics/1_alt.png" />
                    </div>
                </div>
                <div class="efeitoAnalytics dadosTodosQuadros dadosLinha1 dadosColuna2" attr-idInfo="2">
                    <div class="resumoNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; background: #00FFE0; z-index: 2;">
                        <img style="width: 176px; height: 144.72px; top: 70.64px; position: absolute" src="/lib/img/apps/analytics/2.png" />
                        <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                            <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$this->formataExibicao($consultaGrandesNumerosPj['mensagem'][0]['usuariosPj']).'<br/></span>
                            <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$textoUsuariosPj.'</span>
                        </div>
                    </div>
                    <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                        <div class="textoDetalhesAnalytics">
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Usuários:<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['usuariosPj'],0,",",".").'<br/><br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['mediaUsuariosPj'],0,",",".").'<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['usuariosPjD7'],0,",",".").'</span><br>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">90 Dias: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['usuariosPj90D'],0,",",".").'</span>
                        </div>
                        <img class="imagemDetalhesAnalytics" style="width: 176px; height: 144.72px; top: 255px; position: absolute" src="/lib/img/apps/analytics/2_alt.png" />
                    </div>
                </div>
                <div class="efeitoAnalytics dadosTodosQuadros dadosLinha1 dadosColuna3" attr-idInfo="3">
                    <div class="resumoNumerosAnalytics3 dadosTodosQuadros overflowQuadroInterno" style="border-top-left-radius: 100px; border-top-right-radius: 100px; background: #00FFE0; z-index: 2;">
                        <img style="width: 176px; height: 144.72px; top: 70.64px; position: absolute" src="/lib/img/apps/analytics/3.png" />
                        <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                            <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$this->formataExibicao($consultaGrandesNumerosPj['mensagem'][0]['conversasPj']).'<br/></span>
                            <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">conversas</span>
                        </div>
                    </div>
                    <div class="detalheNumerosAnalytics3 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                        <div class="textoDetalhesAnalytics">
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Conversas:<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['conversasPj'],0,",",".").'<br/><br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['mediaConversasPj'],0,",",".").'<br/>
                            </span><span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['conversasPjD7'],0,",",".").'</span>
                        </div>
                        <img class="imagemDetalhesAnalytics" style="width: 176px; height: 144.72px; top: 250px; position: absolute" src="/lib/img/apps/analytics/3_alt.png" />
                    </div>
                </div>
                <div class="efeitoAnalytics dadosTodosQuadros dadosLinha2 dadosColuna1" attr-idInfo="4">
                    <div class="resumoNumerosAnalytics4 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-right-radius: 100px; background: #00FFFF; z-index: 2;">
                        <img style="width: 161px; height: 147px; /*left: 147.50px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/4.png" />
                        <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                            <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">'.$consultaGrandesNumerosPj['mensagem'][0]['notaMediaPj'].' de nota<br/></span>
                            <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">na avaliação dos usuários</span>
                        </div>
                    </div>
                    <div class="detalheNumerosAnalytics4 dadosTodosQuadros overflowQuadroInterno" z-index: 1;">
                        <div class="textoDetalhesAnalytics">
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Nota Avaliações: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPj['mensagem'][0]['notaMediaPj'].'<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPj['mensagem'][0]['notaMediaPj30d'].'<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.$consultaGrandesNumerosPj['mensagem'][0]['notaMediaPjD7'].'<br/><br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Qtd. Avaliações:</span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['qtdAvaliacoesPj'],0,",",".").'<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['qtdMediaAvaliacoesPj30d'],0,",",".").'<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">'.number_format($consultaGrandesNumerosPj['mensagem'][0]['qtdMediaAvaliacoesPjD7'],0,",",".").'</span>
                        </div>
                        <img class="imagemDetalhesAnalytics iconeResponsivo" style="width: 133px; height: 133px;  top: 255px; position: absolute" src="/lib/img/apps/analytics/4_alt.png" />
                    </div>
                </div>
                <div class="efeitoAnalytics dadosTodosQuadros dadosLinha2 dadosColuna2 divDesabilitada" attr-idInfo="5">
                    <div class="resumoNumerosAnalytics5 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-left-radius: 100px; background: #EFF0A7; z-index: 2;">
                        <img style="width: 133px; height: 154px; /*left: 147.50px;*/ top: 71px; position: absolute;" src="/lib/img/apps/analytics/5.png" />
                        <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                            <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                            <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">ativos enviados</span>
                        </div>
                    </div>
                    <div class="detalheNumerosAnalytics5 dadosTodosQuadros overflowQuadroInterno" style="z-index: 1;">
                        <div class="textoDetalhesAnalytics">
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Ativos Enviados: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">0 <br/></span>
                            <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Principais Ativos:<br/>0:</span>
                            <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word"> - <br/></span>
                            <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">0:</span>
                            <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word"> - <br/></span>
                            <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">0:</span>
                            <span style="color: #AAD8FF; font-size: 24px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word"> - <br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Média: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">0<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">D-7: </span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">0</span>
                        </div>
                        <img class="imagemDetalhesAnalytics iconeResponsivo" style="width: 133px; height: 154px;  top: 241px; position: absolute" src="/lib/img/apps/analytics/5_alt.png" />
                    </div>
                </div>
                <div class="efeitoAnalytics dadosTodosQuadros dadosLinha2 dadosColuna3 divDesabilitada" attr-idInfo="6">
                    <div class="resumoNumerosAnalytics6 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-left-radius: 100px; background: #F0A7AB; z-index: 2;">
                        <img style="width: 133px; height: 154px;  top: 71px; position: absolute" src="/lib/img/apps/analytics/6.png" />
                        <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                            <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                            <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">indisponibilidades</span>
                        </div>
                    </div>
                    <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                        <div class="textoDetalhesAnalytics">
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word">Uhu!<br/><br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">Estamos há 50 dias <br/>sem indisponibilidades.</span>
                        </div>
                        <img class="imagemDetalhesAnalytics" style="width: 133px; height: 154px;  top: 241px; position: absolute" src="/lib/img/apps/analytics/6_alt.png" />
                    </div>
                </div>
                <div class="efeitoAnalytics dadosTodosQuadros dadosLinha3 dadosColuna1 divDesabilitada" attr-idInfo="7">
                    <div class="resumoNumerosAnalytics7 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-left-radius: 100px; border-top-right-radius: 100px; background: #CBA7F0; z-index: 2;">
                        <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/7.png" />
                        <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                            <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                            <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em acordos RAO</span>
                        </div>
                    </div>
                    <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                        <div class="textoDetalhesAnalytics">
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ 0<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">0 Acordos</span>
                        </div>
                        <img class="imagemDetalhesAnalytics" style="width: 136px; height: 146px; /*left: 167px;*/ top: 248px; position: absolute" src="/lib/img/apps/analytics/7_alt.png" />
                    </div>
                </div>
                <div class="efeitoAnalytics dadosTodosQuadros dadosLinha3 dadosColuna2 divDesabilitada" attr-idInfo="8">
                    <div class="resumoNumerosAnalytics8 dadosTodosQuadros overflowQuadroInterno" style="border-top-left-radius: 100px; background: #CBA7F0; z-index: 2;">
                        <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/8.png" />
                        <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                            <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                            <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em Ativos S/A</span>
                        </div>
                    </div>
                    <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                        <div class="textoDetalhesAnalytics">
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ 0<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">0 Acordos</span></div>
                        <img class="imagemDetalhesAnalytics" style="width: 136px; height: 146px; /*left: 167px;*/ top: 248px; position: absolute" src="/lib/img/apps/analytics/8_alt.png" />
                    </div>
                </div>
                <div class="efeitoAnalytics dadosTodosQuadros dadosLinha3 dadosColuna3 divDesabilitada" attr-idInfo="9">
                    <div class="resumoNumerosAnalytics9 dadosTodosQuadros overflowQuadroInterno" style="border-bottom-right-radius: 100px; background: #CBA7F0; z-index: 2;">
                        <img style="width: 136px; height: 146px; /*left: 167px;*/ top: 71px; position: absolute" src="/lib/img/apps/analytics/9.png" />
                        <div style="position: absolute; text-align: center; width: 100%; margin-top: 13rem;">
                            <span class="tituloDadosResumo" style="color: #002D4B; font-size: 64px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">0<br/></span>
                            <span class="detalhesDadosResumo" style="color: #002D4B; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">em CDC</span>
                        </div>
                    </div>
                    <div class="detalheNumerosAnalytics2 dadosTodosQuadros overflowQuadroInterno" style="border-top-right-radius: 100px; z-index: 1;">
                        <div class="textoDetalhesAnalytics">
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 400; word-wrap: break-word"><br/>R$ 0<br/></span>
                            <span style="color: #AAD8FF; font-size: 32px; font-family: BancoDoBrasil Titulos; font-weight: 300; word-wrap: break-word">0 Contratações</span>
                        </div>
                        <img class="imagemDetalhesAnalytics" style="width: 136px; height: 146px; /*left: 167px;*/ top: 248px; position: absolute" src="/lib/img/apps/analytics/9_alt.png" />
                    </div>
                </div>
            ';
        }
        $retorno = array();
        $retorno["status"] = 1;
        $retorno["mensagem"] = $dadosGrandesNumerosPj;
        return $retorno;
    }


    // Função para alteração da exibição do número no card inicial
    function formataExibicao($n) {
        // tira qualquer formatação que eventualmente tenha o número
        $n = (0+str_replace(",", "", $n));
      
        // Verifica se é um número
        if (!is_numeric($n)) return false;
      
        // Filtra, altera o formato e coloca o texto do valor equivalente
        if ($n > 2000000000) return round(($n/1000000000), 2).' bilhões';
        elseif ($n > 1000000000 and $n < 2000000000) return round(($n/1000000000), 2).' bilhão';
        elseif ($n >= 1995000) return round(($n/1000000), 2).' milhões';
        elseif ($n > 1000000 and $n < 1995000) return round(($n/1000000), 2).' milhão';
        elseif ($n > 1000) return floor(($n/1000)).' mil';

        return number_format($n);
    }

    // Função para alteração da exibição do número no card inicial
    function formataExibicaoSemDecimal($n) {
        // tira qualquer formatação que eventualmente tenha o número
        $n = (0+str_replace(",", "", $n));
      
        // Verifica se é um número
        if (!is_numeric($n)) return false;
      
        // Filtra, altera o formato e coloca o texto do valor equivalente
        if ($n > 1500000000) return round(($n/1000000000), 0).' bilhões';
        elseif ($n > 1000000000 and $n < 1500000000) return round(($n/1000000000), 0).' bilhão';
        elseif ($n >= 1995000) return round(($n/1000000), 0).' milhões';
        elseif ($n > 1000000 and $n < 1995000) return round(($n/1000000), 0).' milhão';
        elseif ($n > 1000) return floor(($n/1000)).' mil';

        return number_format($n);
    }

    // Função que grava eventuais logs de erro de banco de dados em formato texto
    public function geraLogExcecao($nomeApp, $nomeFuncao, $informacoesAdicionais, $mat){
        $dateTime = date("Y-m-d")."_". date("H.i.s");
        $nomeArquivo = $dateTime . "_" . $mat . "_" . $nomeApp . "_" . $nomeFuncao .".txt";
        $caminhoArquivo = $this->caminhoLogErro . "/" . $nomeArquivo;

        $strDataHora = print_r(new DateTime(), true);
        $strRequest = print_r($_REQUEST, true);
        $strSession = print_r($_SESSION, true);
        
        $strArquivo = "data:\n" . $strDataHora . "\n\$_REQUEST:\n" . $strRequest . "\n\$_SESSION:\n" . $strSession . "\n\$informacoesAdicionais:\n" . $informacoesAdicionais;

        file_put_contents($caminhoArquivo, $strArquivo);
        chmod($caminhoArquivo, 0777);

        return $caminhoArquivo;
    }
}