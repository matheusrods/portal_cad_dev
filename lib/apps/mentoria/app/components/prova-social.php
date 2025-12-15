<div class="provaSocial">
    <div class="passaramPorAquiMentoria">
        <div class="tituloPassaramPorAquiMentoria">
            Já passaram por aqui
        </div>
        <div class="imagensPassaramPorAquiMentoria">
            <div class="quemPassouMentoria diretoria01">
                <img class="logoBBAzulMentoria" src="/lib/img/apps/mentoria/imgLogoBancoDoBrasil.png" />
                <div class="dadosQuemPassouMentoria" >
                    Gepes - Whats BBFunci<br/>8910
                </div>
            </div>
            <div class="linhaVerticalMentoria"></div>
            <div class="quemPassouMentoria diretoria02">
                <img class="logoBBAzulMentoria" src="/lib/img/apps/mentoria/imgLogoBancoDoBrasil.png" />
                <div class="dadosQuemPassouMentoria">
                    Ditec - Gesec<br/>9905
                </div>
            </div>
            <div class="linhaVerticalMentoria"></div>
            <div class="quemPassouMentoria diretoria03">
                <img class="logoBBAzulMentoria" src="/lib/img/apps/mentoria/imgLogoBancoDoBrasil.png" />
                <div class="dadosQuemPassouMentoria">
                    Dicre - Varejo Brasil<br/>8624
                </div>
            </div>
            <div class="linhaVerticalMentoria"></div>
            <div class="quemPassouMentoria diretoria04">
                <img class="logoBBAzulMentoria" src="/lib/img/apps/mentoria/imgLogoBancoDoBrasil.png" />
                <div class="dadosQuemPassouMentoria">
                    Dicre - Análise e Informações<br/>8624
                </div>
            </div>
            <div class="linhaVerticalMentoria"></div>
            <div class="quemPassouMentoria diretoria05">
                <img class="logoBBAzulMentoria" src="/lib/img/apps/mentoria/imgLogoBancoDoBrasil.png" />
                <div class="dadosQuemPassouMentoria">
                    BB Seguros<br/>8869
                </div>
            </div>
            <div class="linhaVerticalMentoria"></div>
            <div class="quemPassouMentoria diretoria06">
                <img class="logoBBAzulMentoria" src="/lib/img/apps/mentoria/imgLogoBancoDoBrasil.png" />
                <div class="dadosQuemPassouMentoria">
                    BB Américas<br/>
                </div>
            </div>
        </div>
    </div>

    <div class="oQueDizemSobreMentoria">
        <div class="tituloOQueDizemSobreMentoria">
            O que dizem sobre a imersão
        </div>
        
        <div class="quadroOQueDizemSobreMentoria">
            <?php
                $inputDepoimentos = '';
                $depoimentos = '';
                $labelNavegacaoDepoimentos = '';
                $cssBotoes = '';

                if($consultaDepoimentosMentoria['status'] == 0){
                    $depoimentos = $consultaDepoimentosMentoria['mensagem'];
                } else {
                    // Laço que monta os botões e conteúdo de navegação do carrossel
                    for($i = 0; $i < sizeof($consultaDepoimentosMentoria['mensagem']); $i++){
                        $indiceArrayMaisUm = $i+1;
                        $checked = '';
                        $styleLabel = '';
                        if($i==0){
                            $checked = 'checked';
                            $styleLabel = 'border: 2px solid #000;';
                        }
                        $inputDepoimentos = $inputDepoimentos.'
                            <input type="radio" class = "botao_Carousel" name="carousel" id="slide'.$indiceArrayMaisUm.'" '.$checked.'>
                        ';

                        $labelNavegacaoDepoimentos = $labelNavegacaoDepoimentos.'
                            <label for="slide'.$indiceArrayMaisUm.'" style="'.$styleLabel.'"></label>
                        ';

                        $cssBotoes = $cssBotoes.'#slide'.$indiceArrayMaisUm.':checked ~ .slides .slide:nth-child('.$indiceArrayMaisUm.'),';
                    }

                    // Laço que monta o conteúdo dos depoimentos
                    for($i = 0; $i < sizeof($consultaDepoimentosMentoria['mensagem']); $i++){
                        $indiceArrayMaisUm = $i+1;
                        $fotoHumanograma = $consultaDepoimentosMentoria['mensagem'][$i]['fotoHumanograma'];

                        if($fotoHumanograma == 1){
                            $fotoHumanograma = "https://humanograma.intranet.bb.com.br/avatar/".$consultaDepoimentosMentoria['mensagem'][$i]['matricula']."";
                        } else {
                            $fotoHumanograma = getBaseUrl();"/lib/apps/mentoria/img/".$consultaDepoimentosMentoria['mensagem'][$i]['matricula'].".png";
                        }

                        $depoimentos = $depoimentos.'
                            <div class="slide">
                                <div class="detalheOQueDizem quadroDetalhe0'.$indiceArrayMaisUm.'">
                                    <div class="imagemEDadosDepoenteMentoria">
                                        <!-- <img class="imgDepoenteMentoria" src="https://humanograma.intranet.bb.com.br/avatar/'.$consultaDepoimentosMentoria['mensagem'][$i]['matricula'].'"> -->
                                        <img class="imgDepoenteMentoria" src="'.$fotoHumanograma.'">
                                        <div class="dadosDepoenteMentoria">
                                            <div class="nomeDepoimentoMentoria">'.$consultaDepoimentosMentoria['mensagem'][$i]['nome'].'</div>
                                            <div class="cargoDepoimentoMentoria">'.$consultaDepoimentosMentoria['mensagem'][$i]['cargo'].'</div>
                                            <div class="dependenciaDepoimentoMentoria">'.$consultaDepoimentosMentoria['mensagem'][$i]['dependencia'].'</div>
                                        </div>
                                    </div>
                                                
                                    <div class="quadroDepoimentoMentoria">
                                    <div class="inicioCitacaoDepoimentoMentoria">“</div>
                                        <div class="textoDepoimentoMentoria">
                                            '.$consultaDepoimentosMentoria['mensagem'][$i]['depoimento'].'
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                    $cssBotoesTratado = rtrim($cssBotoes, ',').'{display: block;}';
                    // Variável com o conteúdo completo dos depoimentos (botões de navegação, fotos, dados e depoimento em si)
                    $depoimentosCompleto = '<div class="carousel">'.$inputDepoimentos.'<div class="slides">'.$depoimentos.'</div><div class="navigation">'.$labelNavegacaoDepoimentos.'</div></div></div>';
                    echo $depoimentosCompleto;
                }
            ?>
        </div>
    </div>
</div>