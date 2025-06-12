<?php

//ini_set('display_startup_errors', 1);
session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

Class funcoes {

    public $mat;
    public $caminhoLogErro;

    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
        $mat = $_SESSION['matricula'];
        $caminhoLogErro = $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
    }

//Funções referentes a página inicial de Analytics

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
                // $retorno["mensagem"] = "<p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar os Grandes Números Pessoa Física. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                $retorno["mensagem"] = "<div style='display: flex; justify-content: center; align-items: center;'><p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar os Grandes Números - Pessoa Física.<br>Você pode verificá-los <a href='https://cad.desenv.bb.com.br/contingencia_analytics' target='_blank'>aqui</a>.<br> Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p></div>";
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
                // $retorno["mensagem"] = "<p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar os Grandes Números Pessoa Jurídica. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                $retorno["mensagem"] = "<div style='display: flex; justify-content: center; align-items: center;'><p style='color: white; font-size: 16px; font-weight: bold;'>Não foi possível consultar os Grandes Números - Pessoa Jurídica.<br>Você pode verificá-los <a href='https://cad.desenv.bb.com.br/contingencia_analytics' target='_blank'>aqui</a>.<br> Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p></div>";
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
  
    
//Funções referentes à area dos painéis

    public function consultaTags(){
        $mat = $_SESSION['matricula'];

        $db = New Database('paineis');
        $query = "SELECT distinct(b.idTag), b.nomeTag FROM paineis.paineis_tags a
        LEFT JOIN paineis.tags b ON a.idTag = b.idTag
        WHERE b.ativo = 1 ORDER BY b.nomeTag;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $montaBotoesTags = '<div class="divisaoTags">';
                $qtdTags = sizeof($execQuery);
                $qtdTagsLinha = ceil($qtdTags/2);

                for($i = 0; $i < sizeof($execQuery); $i++){
                    if($i == ($qtdTagsLinha)){
                        $montaBotoesTags = $montaBotoesTags.'
                            </div> <div class="divisaoTags"><div id="tagPaineis'.$execQuery[$i]['idTag'].'" class="divbotoesFiltroTag Clicar" attr-id='.$execQuery[$i]['idTag'].' attr-filtroAtivo="0" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #E4ECFF; border-radius: 100px; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                                <div style="color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">'.$execQuery[$i]['nomeTag'].'</div>
                            </div>';
                    } else {
                        $montaBotoesTags = $montaBotoesTags.'
                            <div id="tagPaineis'.$execQuery[$i]['idTag'].'" class="divbotoesFiltroTag Clicar" attr-id='.$execQuery[$i]['idTag'].' attr-filtroAtivo="0" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #E4ECFF; border-radius: 100px; flex-direction: column; justify-content: center; align-items: center; display: inline-flex">
                                <div style="color: #3354FD; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">'.$execQuery[$i]['nomeTag'].'</div>
                            </div>';
                    }
                }
                
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaBotoesTags.'</div>';
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("paineis", "consultaTags", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar as tags dos Painéis. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    public function consultaPaineis($idTag = null){
        $mat = $_SESSION['matricula'];

        if($idTag > 0){
            $filtroIdTag = "AND c.idTag in (".$idTag.")";
        }

        $db = New Database('paineis');
        $query = "SELECT a.*, group_concat(c.nomeTag)as nomeTag
                    FROM paineis.paineis a
                    LEFT JOIN paineis.paineis_tags b ON a.idPainel = b.idPainel
                    LEFT JOIN paineis.tags c ON b.idTag = c.idTag
                    WHERE a.ativo = 1 ".$filtroIdTag." 
                    group by idPainel
                    ORDER BY idPainel ASC;";
        
                 

        try{
            $execQuery = $db->DbGetAll($query);
            
            
            if($execQuery > 0){
                $montaPaineis = '';
                
                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){

                    $query2 = "SELECT a.idPainel, b.idTag, c.nomeTag
                    FROM paineis.paineis a
                     LEFT JOIN paineis.paineis_tags b ON a.idPainel = b.idPainel
                     LEFT JOIN paineis.tags c ON b.idTag = c.idTag
                     WHERE a.ativo = 1 AND a.idPainel = ".$execQuery[$j]['idPainel']." ;" ;


                    $abreDivNestPainel = '';
                    $fechaDivNestPainel = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestPainel = '<div class="abreDivNestPainel" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                        
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestPainel = '</div>';
                    }

                    $execQuery2 = $db->DbGetAll($query2);
                    $montaTags = "";
                    
                    for($i = 0; $i<  sizeof($execQuery2); $i++){
                        $montaTags = $montaTags.'<div class="tagPainel"><div class="textoTagPainel">'.$execQuery2[$i]['nomeTag'].'</div></div>';
                    }

                    $montaPaineis = $montaPaineis.$abreDivNestPainel.'
                        <div class="divPainel">
                            <a href="'.$execQuery[$j]['link'].'" target="_blank" style="text-decoration: none;">
                                <div class="fotoCapaPainel" style="background-image: url(https://cad.bb.com.br/lib/apps/analytics/img/'.$execQuery[$j]['idPainel'].'.png); background-position: bottom;">
                                   '.$montaTags.' 
                                </div>
                            </a>
                            <div class="textoPainel" style="align-self: stretch; height: 196px; padding: 32px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                                <div class="tituloDescricaoPainel">
                                    <div class="tituloPainel">'.$execQuery[$j]['titulo'].'</div>
                                    <div class="descricaoPainel">'.$execQuery[$j]['descricao'].'</div>
                                </div>
                            </div>    
                                <a href="'.$execQuery[$j]['link'].'" target="_blank" style="text-decoration: none; margin-top: 2.5rem;">
                                    <div class="abrirPainel" attr-idPainel="'.$execQuery[$j]['idPainel'].'">
                                        <div style="text-align: center; color: #ffffff; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">Ver painel</div>
                                    </div>
                                </a>
                            
                        </div>
                    '.$fechaDivNestPainel;
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaPaineis;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível consultar os painéis nesse momento. Informe à equipe responsável. L132 - class_paineis.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("paineis", "consultaPaineis", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 16px; font-weight: bold;'>Não foi possível consultar os painéis. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    public function filtraPaineisTag($idTag){
        $mat = $_SESSION['matricula'];

        $db = New Database('paineis');
        $query = "SELECT 
                    a.*, 
                    c.idTag AS 'idTag',
                    c.nomeTag 
                FROM paineis.paineis a
                LEFT JOIN paineis.paineis_tags b ON a.idPainel = b.idPainel
                LEFT JOIN paineis.tags c ON b.idTag = c.idTag
                WHERE a.ativo = 1 AND c.idTag in (".$idTag.") ORDER BY idPainel ASC;";
                
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery > 0){
                $montaPaineisFiltrados = '';

                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){

                    $query2 = "SELECT a.idPainel, b.idTag, c.nomeTag
                    FROM paineis.paineis a
                     LEFT JOIN paineis.paineis_tags b ON a.idPainel = b.idPainel
                     LEFT JOIN paineis.tags c ON b.idTag = c.idTag
                     WHERE a.ativo = 1 AND a.idPainel = ".$execQuery[$j]['idPainel']." ;" ;

                    $abreDivNestPainel = '';
                    $fechaDivNestPainel = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestPainel = '<div class="abreDivNestPainel" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestPainel = '</div>';
                    }

                    $execQuery2 = $db->DbGetAll($query2);
                    $montaTags = "";

                      
                    for($i = 0; $i<  sizeof($execQuery2); $i++){
                        $montaTags = $montaTags.'<div class="tagPainel"><div class="textoTagPainel">'.$execQuery2[$i]['nomeTag'].'</div></div>';
                    }

                    $montaPaineisFiltrados = $montaPaineisFiltrados.$abreDivNestPainel.'
                        <div class="divPainel">
                            <div style="align-self: stretch; height: 272.27px; padding-top: 16px; padding-bottom: 8px; padding-left: 73px; padding-right: 16px; background-image: url(https://cad.bb.com.br/lib/apps/analytics/img/'.$execQuery[$j]['idPainel'].'.png);flex-direction: column; justify-content: flex-start; align-items: flex-end; display: flex; background-size: cover;">
                                <div style="padding-left: 8px; padding-right: 8px; background: #FDF429; border-radius: 999px; flex-direction: column; justify-content: center; align-items: center; display: flex; flex-wrap: wrap;">
                                     '.$montaTags.' 
                                </div>
                                <div></div>
                            </div>
                            <div style="align-self: stretch; height: 196px; padding: 32px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                                <div style="align-self: stretch; height: 84px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 4px; display: flex">
                                    <div style="align-self: stretch; color: #111214; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px; word-wrap: break-word">'.$execQuery[$j]['titulo'].'</div>
                                    <div style="align-self: stretch; color: #6C7077; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: 25.60px; word-wrap: break-word">'.$execQuery[$j]['descricao'].'</div>
                                </div>
                                <div class="abrirPainel" attr-idPainel="'.$execQuery[$j]['idPainel'].'" style="padding-left: 16px; padding-right: 16px; padding-top: 9px; padding-bottom: 9px; background: #FDF429; border-radius: 4px; justify-content: center; align-items: center; gap: 10px; display: inline-flex">
                                    <div style="text-align: center; color: #ffffff; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">BUTTON LABEL</div>
                                </div>
                            </div>
                        </div>
                    ';
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaPaineisFiltrados;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível filtrar os paineis nesse momento. Informe à equipe responsável. L835 - class_paineis.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("paineis", "filtraPaineisTag", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p  style='font-size: 16px; font-weight: bold;'>Não foi possível filtrar a página de Painéis. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            return ($retorno);
        }
    }

    // Função que busca no banco de dados as palavras digitadas no campo de pesquisa de paineis
    public function pesquisaPaineis($textoDigitado){
        $mat = $_SESSION['matricula'];

        $db = New Database('paineis');
        $query = "SELECT 
                    a.*, 
                    c.idTag AS 'idTag',
                    group_concat(c.nomeTag) AS nomeTag
                    
                FROM paineis.paineis a
                LEFT JOIN paineis.paineis_tags b ON a.idPainel = b.idPainel
                LEFT JOIN paineis.tags c ON b.idTag = c.idTag
                WHERE a.ativo = 1 AND (
                    a.titulo like ('%".$textoDigitado."%') OR 
                    descricao like ('%".$textoDigitado."%') OR 
                    palavras_chave like ('%".$textoDigitado."%')
                )
                    group by idPainel
                ORDER BY idPainel ASC;";
        try{
            $execQuery = $db->DbGetAll($query);

            if(sizeof($execQuery) == 0){
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = "
                    <h1>Não localizamos painéis com o termo '".$textoDigitado."'.</h1>
                                        ";
                // $retorno["mensagem"] = $execQuery;
                return ($retorno);
            }

            if($execQuery > 0){
                $montaPaineis = '';
                
                $sequencia = 0;
                for($j = 0; $j < sizeof($execQuery); $j++){

                    $query2 = "SELECT a.idPainel, b.idTag, c.nomeTag
                    FROM paineis.paineis a
                     LEFT JOIN paineis.paineis_tags b ON a.idPainel = b.idPainel
                     LEFT JOIN paineis.tags c ON b.idTag = c.idTag
                     WHERE a.ativo = 1 AND a.idPainel = ".$execQuery[$j]['idPainel']." ;" ;

                    $abreDivNestPainel = '';
                    $fechaDivNestPainel = '';
                    $stylePrimeiraDiv = '';

                    if($j == 0){
                        $stylePrimeiraDiv = 'style="display: inline-flex;"';
                    }
                    if((fmod($j, 4) == 0)){
                        $sequencia = $sequencia + 1;
                        $abreDivNestPainel = '<div class="abreDivNestPainel" attr-sequencia="'.$sequencia.'" '.$stylePrimeiraDiv.'>';
                    }
                    
                    if((fmod($j, 4) == 3) || $j == (sizeof($execQuery)-1)){
                        $fechaDivNestPainel = '</div>';
                    }

                    $execQuery2 = $db->DbGetAll($query2);
                    $montaTags = "";
                    
                    for($i = 0; $i<  sizeof($execQuery2); $i++){
                        $montaTags = $montaTags.'<div class="tagPainel"><div class="textoTagPainel">'.$execQuery2[$i]['nomeTag'].'</div></div>';
                    }
                    
                    // aqui que fiz as alterações, Yasmin - 04/11/2024
                    $montaPaineis = $montaPaineis.$abreDivNestPainel.'
                        
                        <div class="divPainel">
                            <a href="'.$execQuery[$j]['link'].'" target="_blank" style="text-decoration: none;" attr-contador="'.$j.'">
                                <div class="fotoCapaPainel" style="background-image:  url(https://cad.bb.com.br/lib/apps/analytics/img/'.$execQuery[$j]['idPainel'].'.png); background-position: bottom;">
                                    '.$montaTags.'
                                </div>
                            </a>
                            <div class="textoPainel" style="align-self: stretch; height: 196px; padding: 32px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex;  line-height: 1.3rem;">
                                <div class="tituloDescricaoPainel">
                                    <div class="tituloPainel" style="align-self: stretch; color: #111214; font-size: 22px; font-family: BancoDoBrasil Titulos; font-weight: 700; line-height: 27.50px;  word-wrap: break-word;  margin-top: -1rem; margin-bottom: 1.05rem; ">
                                    '.$execQuery[$j]['titulo'].'
                                    </div>
                                    <div class="descricaoPainel">'.$execQuery[$j]['descricao'].'</div>
                                </div>
                            </div>
                            <a href="'.$execQuery[$j]['link'].'" target="_blank" style="text-decoration: none; margin-top: 2rem;">
                                <div class="abrirPainel" style= "padding: 9px 16px 9px 16px; background: #9747FF;  border-radius: 4px; justify-content: center;  align-items: center;  gap: 10px;  display: inline-flex; margin-left: 1.8rem; margin-top: 0.25rem;" attr-idPainel="'.$execQuery[$j]['idPainel'].'">
                                    <div style="text-align: center; color: #ffffff; font-size: 12px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 13.50px; letter-spacing: 0.06px; word-wrap: break-word">Ver painel</div>
                                </div>
                            </a>
                        </div>
                    '.$fechaDivNestPainel;
                }
                $retorno = array();
                $retorno["status"] = 1;
                $retorno["mensagem"] = $montaPaineis;
            } else {
                $retorno = array();
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Não foi possível pesquisar os painéis nesse momento. Informe à equipe responsável. L299 - class_paineis.php";
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n\\n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("paineis", "pesquisaPaineis", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível pesquisar a página de painéis. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            return ($retorno);
        }
    }

    // Função que grava eventuais logs de erro de banco de dados em formato texto
    // public function geraLogExcecao($nomeApp, $nomeFuncao, $informacoesAdicionais, $mat){
    //     $dateTime = date("Y-m-d")."_". date("H.i.s");
    //     $nomeArquivo = $dateTime . "_" . $mat . "_" . $nomeApp . "_" . $nomeFuncao .".txt";
    //     $caminhoArquivo = $this->caminhoLogErro . "/" . $nomeArquivo;

    //     $strDataHora = print_r(new DateTime(), true);
    //     $strRequest = print_r($_REQUEST, true);
    //     $strSession = print_r($_SESSION, true);
        
    //     $strArquivo = "data:\n" . $strDataHora . "\n\$_REQUEST:\n" . $strRequest . "\n\$_SESSION:\n" . $strSession . "\n\$informacoesAdicionais:\n" . $informacoesAdicionais;

    //     file_put_contents($caminhoArquivo, $strArquivo);
    //     chmod($caminhoArquivo, 0777);

    //     return $caminhoArquivo;
    // }
}