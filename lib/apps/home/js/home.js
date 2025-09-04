$(document).ready(function() {

    setTimeout(function() {
        $('#menuCopilotos').click();
        setTimeout(function() {
            $('#menuRecursos').click();
            setTimeout(function() {
                $('#menuExperimentacoes').click();
                setTimeout(function() {
                    $('#menuPaineis').click();
                    setTimeout(function() {
                        $('#menuPesquisas').click();
                        setTimeout(function(){
                            $('#menuEstudos').click();
                            setTimeout(function() {
                                $('#menuCopilotos').click();
                            }, 125);
                        }, 125);
                    }, 125);
                }, 125);
            }, 125);
        }, 125);
    }, 125);

/*Menu da seção de áreas do portal*/    

function resetPesquisas(){

    $('#pesquisasIcone').attr("fill", "#000");
    $('#menuPesquisas').css("background-color", "#FEFEFE");
    $('#idSpanPesquisasMenu').css("color", "#000");
    $('#areaPesquisas').css("display", "none");
    $('#menuPesquisas').attr('attr-ativo', '0');
    $('#menuPesquisas').removeClass('itemMenuAreasEmFoco');
    $('#menuPesquisas').addClass('itemMenuAreas');

}

function resetEstudos(){

    $('#estudosIcone').attr("fill", "#000");
    $('#menuEstudos').css("background-color", "#FEFEFE");
    $('#idSpanEstudosMenu').css("color", "#000");
    $('#areaEstudos').css("display", "none");
    $('#menuEstudos').attr('attr-ativo', '0');
    $('#menuEstudos').removeClass('itemMenuAreasEmFoco');
    $('#menuEstudos').addClass('itemMenuAreas');

}

function resetExperimentacoes(){

    $('#experimentacoesIcone').attr("fill","#000");
    $('#menuExperimentacoes').css('background-color', '#FEFEFE');
    $('#idSpanExperimentacoesMenu').css("color","#000");
    $('#areaExperimentacoes').css("display", "none");
    $('#menuExperimentacoes').attr('attr-ativo', '0');
    $('#menuExperimentacoes').removeClass('itemMenuAreasEmFoco');
    $('#menuExperimentacoes').addClass('itemMenuAreas');
    
}

function resetPaineis(){

    $('#paineisIcone').attr("fill", "#000");
    $('#menuPaineis').css("background-color", "#FEFEFE");
    $('#idSpanPaineisMenu').css("color", "#000");    
    $('#areaPaineis').css("display", "none");
    $('#menuPaineis').attr('attr-ativo', '0');
    $('#menuPaineis').removeClass('itemMenuAreasEmFoco');
    $('#menuPaineis').addClass('itemMenuAreas');
}


function resetRecursos(){
    $('#recursosIcone').attr("fill", "#000");
    $('#menuRecursos').css("background-color", "#FEFEFE");
    $('#idSpanRecursosMenu').css("color", "#000");
    $('#areaRecursos').css("display", "none");
    $('#menuRecursos').attr('attr-ativo', '0');
    $('#menuRecursos').removeClass('itemMenuAreasEmFoco');
    $('#menuRecursos').addClass('itemMenuAreas');
}


function resetCopilotos(){

    $('#copilotosIcone').attr("fill", "#000");
    $('#menuCopilotos').css("background-color", "#FEFEFE");
    $('#idSpanCopilotosMenu').css("color", "#000");
    $('#areaCopilotos').css("display", "none");
    $('#menuCopilotos').attr('attr-ativo', '0');
    $('#menuCopilotos').removeClass('itemMenuAreasEmFoco');
    $('#menuCopilotos').addClass('itemMenuAreas');
}


$('#menuPesquisas').on('click', function (){
    $('#pesquisasIcone').attr("fill","white");
    $('#menuPesquisas').css("background-color","#465EFF");
    $('#idSpanPesquisasMenu').css("color","white");
    $('#areaPesquisas').css("display", "block");
    // $('#menuPesquisas').attr('attr-ativo', '1');
    // $('#idSpanPesquisasMenu').attr('attr-ativo', '1');
    $(this).removeClass('itemMenuAreas');
    $(this).addClass('itemMenuAreasEmFoco');
    
    resetExperimentacoes();
    resetPaineis();
    resetEstudos();
    resetCopilotos();
    resetRecursos();
    
});



$('#menuRecursos').on('click', function (){
    /*customização do próprio elemento*/
    $('#recursosIcone').attr("fill", "white");
    $('#menuRecursos').css("background-color","#FF7F00");
    $('#idSpanRecursosMenu').css("color","white");
    $('#areaRecursos').css("display", "block");
    $('.nestRecursos').css("display", "inline-flex");
    // $('#menuRecursos').attr('attr-ativo', '1');
    // $('#idSpanRecursosMenu').attr('attr-ativo', '1');
    $(this).removeClass('itemMenuAreas');
    $(this).addClass('itemMenuAreasEmFoco');
   
    /*alterando os outros itens do menu */ 
    resetExperimentacoes();
    resetPaineis();
    resetPesquisas();
    resetEstudos();
    resetCopilotos();

    
});

    
    
$('#menuExperimentacoes').on('click', function(){
    $('#experimentacoesIcone').attr("fill","white");
    $('#menuExperimentacoes').css("background-color","#05B6A0;");
    $('#idSpanExperimentacoesMenu').css("color","white");
    $('#areaExperimentacoes').css("display", "block");
    $('.nestExperimentacoes').css("display", "inline-flex");
    $('#menuExperimentacoes').attr('attr-ativo', '1');
    $(this).removeClass('itemMenuAreas');
    $(this).addClass('itemMenuAreasEmFoco');


    resetRecursos();
    resetPaineis();
    resetPesquisas();
    resetEstudos();
    resetCopilotos();

});

$('#menuPaineis').on('click', function(){
    $('#paineisIcone').attr("fill","white");
    $('#menuPaineis').css("background-color","#735CC6");
    $('#idSpanPaineisMenu').css("color","white");
    $('#areaPaineis').css("display", "block");
    $('#menuPaineis').attr('attr-ativo', '1');
    $('.nestPaineis').css("display", "inline-flex");
    $(this).removeClass('itemMenuAreas');
    $(this).addClass('itemMenuAreasEmFoco');


    resetExperimentacoes();
    resetRecursos();
    resetPesquisas();
    resetEstudos();
    resetCopilotos();
});

$('#menuEstudos').on('click', function(){
    $('#estudosIcone').attr("fill","white");
    $('#menuEstudos').css("background-color","#F54F58;");
    $('#idSpanEstudosMenu').css("color","white");
    $('#areaEstudos').css("display", "block");
    $('.nestEstudos').css("display", "inline-flex");
    $('#menuEstudos').attr('attr-ativo', '1');
    $(this).removeClass('itemMenuAreas');
    $(this).addClass('itemMenuAreasEmFoco');


    resetExperimentacoes();
    resetPaineis();
    resetPesquisas();
    resetRecursos();
    resetCopilotos();
});

$('#menuCopilotos').on('click', function(){
    $('#copilotosIcone').attr("fill","white");
    $('#menuCopilotos').css("background-color","#23118B;");
    $('#idSpanCopilotosMenu').css("color","white");
    $('#areaCopilotos').css("display", "inline-flex");
    $('#menuCopilotos').attr('attr-ativo', '1');
    $(this).removeClass('itemMenuAreas');
    $(this).addClass('itemMenuAreasEmFoco');

    resetExperimentacoes();
    resetPaineis();
    resetPesquisas();
    resetEstudos();
    resetRecursos();
});


$('#titMenuPlataforma').on('click', function(){
 $('.divSessaoPlataformas').css('display','block');
 $('.divSessaoDesenvolvimento').css('display','none');
 $('.divSessaoAtivo').css('display','none');
 $('.divSessaoPortais').css('display','none');
 $('#titMenuPlataforma').css('border-bottom','3px solid #019EFF');
 $('#titMenuDesenvolvimento').css('border-bottom','3px solid #C7BDBD');
 $('#titMenuAtivo').css('border-bottom','3px solid #C7BDBD');
 $('#titMenuPortais').css('border-bottom','3px solid #C7BDBD');
 /*border-bottom: 3px solid #C7BDBD;*/
});


$('#titMenuDesenvolvimento').on('click', function(){
 $('.divSessaoPlataformas').css('display','none');
 $('.divSessaoDesenvolvimento').css('display','block');
 $('.divSessaoAtivo').css('display','none');
 $('.divSessaoPortais').css('display','none');
 $('#titMenuDesenvolvimento').css('border-bottom','3px solid #FF6E91');
 $('#titMenuPlataforma').css('border-bottom','3px solid #C7BDBD');
 $('#titMenuAtivo').css('border-bottom','3px solid #C7BDBD');
 $('#titMenuPortais').css('border-bottom','3px solid #C7BDBD');
});

$('#titMenuAtivo').on('click', function(){
 $('.divSessaoPlataformas').css('display','none');
 $('.divSessaoDesenvolvimento').css('display','none');
 $('.divSessaoAtivo').css('display','block');
 $('.divSessaoPortais').css('display','none');
 $('#titMenuDesenvolvimento').css('border-bottom','3px solid #C7BDBD');
 $('#titMenuPlataforma').css('border-bottom','3px solid #C7BDBD');
 $('#titMenuAtivo').css('border-bottom','3px solid #735CC6');
 $('#titMenuPortais').css('border-bottom','3px solid #C7BDBD');

});


$('#titMenuPortais').on('click', function(){
 $('.divSessaoPlataformas').css('display','none');
 $('.divSessaoDesenvolvimento').css('display','none');
 $('.divSessaoAtivo').css('display','none');
 $('.divSessaoPortais').css('display','block');
 $('#titMenuDesenvolvimento').css('border-bottom','3px solid #C7BDBD');
 $('#titMenuPlataforma').css('border-bottom','3px solid #C7BDBD');
 $('#titMenuAtivo').css('border-bottom','3px solid #C7BDBD');
 $('#titMenuPortais').css('border-bottom','3px solid #00EBD0');

});


$(document).on('input', '#txtEventoEcoa', function(e){
    
    e.stopPropagation();
    e.stopImmediatePropagation();
    var length = $(this).val().length;
    var restante = 500 - length;
    $('#contador').text(restante + ' caracteres restantes');
    if (restante < 0) {
        $(this).val($(this).val().substring(0, maxLength));
        $('#contador').text('0 caracteres restantes');
    }

});

    /*Limpa os campos do formulário de adicionar aviso da ecoa*/
$(document).on("click", "#btnLimpaAviso", function(e){

    $("#idTituloAvisoEcoa").val('');
    $("#idDataAvisoEcoa").val('');
    $("#idHorarioAvisoEcoa").val('');
    $("#txtEventoEcoa").val('');
    $('#contador').text('500 caracteres restantes');
})

$('.verTodosAreaNest').on('click', function(){
    var linkInterno = $(this).attr('attr-linkinterno');
    var caminhoPages = 'https://cad.bb.com.br/lib/apps/'+linkInterno+'/app/'+linkInterno+'.php';
    
    $.ajax({
        aSync: true,
        url: caminhoPages,
        type: "POST",
        dataType: "HTML",
        dataSrc: "",
        success: function(data) {
            $("#container").html('');
            $("#container").html(data);
            $('html,body').animate({
                       scrollTop: 0
                   }, 250);
            $("#container").html(data);
        }
    });
});

$('#btnAdicionaAviso').click(function(){
    
    var caminhoController = 'https://cad.bb.com.br/lib/apps/home/controller/controller_home.php';
    $.ajax({
        aSync: true,
        url: caminhoController,
        data: {
            request: 'adicionaModalAvisoEcoa'
            
        },
        type: "POST",
        dataType: "JSON",
        dataSrc: "",
        success: function(retorno) {
            if (retorno.status == 1) {
                bootbox.dialog({
                    backdrop: true,
                    onEscape: function() {},
                    // closeButton: true,
                    size: 'large',
                    title: "Adicionar novo evento",
                    message: retorno.mensagem
                });

            } else {
                alert('else');
                // Se não conseguir pesquisar, exibe a mensagem de erro
                bootbox.dialog({
                    backdrop: true,
                    onEscape: function() {},
                    closeButton: true,
                    size: 'medium',
                    title: "Erro!",
                    message: "<div>"+retorno.mensagem+"</div>",
                    buttons: {
                        confirm: {
                            label: 'Fechar',
                            className: 'btn-danger',
                        }
                    }
                });
            }
        },
        error: function(erro) {
            alert("Não foi possível efetuar a operação, por favor tente novamente. L273 - home.js");
        }
    });
});



$(document).on('click', '#btnCadastraAviso', function(e){

    var caminhoController = 'https://cad.bb.com.br/lib/apps/home/controller/controller_home.php';

    var tituloAviso = $("#idTituloAvisoEcoa").val();
    var dataAviso = $("#idDataAvisoEcoa").val();
    var horarioAviso = $("#idHorarioAvisoEcoa").val();
    var descricaoAviso = $("#txtEventoEcoa").val();


    $.ajax({
        aSync: true,
        url: caminhoController,
        data: {
        
            request: "adicionaAvisoEcoa",
            tituloAviso: tituloAviso,
            dataAviso: dataAviso,
            horarioAviso: horarioAviso,
            descricaoAviso: descricaoAviso
            
        },
        type: "POST",
        dataType: "JSON",
        dataSrc: "",
        success: function(retorno) {
            if (retorno.status == 1) {
                bootbox.dialog({
                    backdrop: true,
                    onEscape: function() {},
                    size: 'large',
                    title: "Evento adicionado",
                    message: retorno.mensagem
                });

                $("#idTituloAvisoEcoa").val('');
                $("#idDataAvisoEcoa").val('');
                $("#idHorarioAvisoEcoa").val('');
                $("#txtEventoEcoa").val('');
                $('#contador').text('500 caracteres restantes');


            } else {

                bootbox.dialog({
                    backdrop: true,
                    onEscape: function() {},
                    closeButton: true,
                    size: 'medium',
                    title: "Erro!",
                    message: retorno.mensagem,
                    buttons: {
                        confirm: {
                            label: 'Fechar',
                            className: 'btn-danger',
                        }
                    }
                });
            }
        },
        error: function(erro) {
         alert("Não foi possível efetuar a operação, por favor tente novamente. L337 - home.js");
         }
    });

});

$('.btnVerMaisEcoa ').on('click', function(){
     var idAviso = $(this).attr('attr-idAvisoEcoa');
     consultaAvisoEcoa(idAviso);
    console.log(idAviso);
});

function consultaAvisoEcoa(idAviso){
    var caminhoController = 'https://cad.bb.com.br/lib/apps/home/controller/controller_home.php';
    $.ajax({
        aSync: true,
        url: caminhoController,
        data: {
            request:'consultaAvisoEcoa',
            idAviso: idAviso
        },
        type: "POST",
        dataType: 'JSON',
        dataSrc: "",
        success: function(retorno){
            if(retorno.status == 1){
                bootbox.dialog({
                    backdrop: true,
                    onEscape: function() {},
                    size: 'large',
                    message: retorno.mensagem
                });
            } else {
                bootbox.dialog({
                    backdrop: true,
                    onEscape: function() {},
                    closeButton: true,
                    size: 'medium',
                    title: "Erro!",
                    message: retorno.mensagem,
                    buttons: {
                        confirm: {
                            label: 'Fechar',
                            className: 'btn-danger',
                        }
                    }
                });

            }
        },
        error: function(erro) {
         alert("Não foi possível efetuar a operação, por favor tente novamente. L425 - home.js");
         }
    });

}

   


// titMenuPlataforma

// border-bottom: 15px solid transparent;

/*.divSessaoPlataformas{
    display: block;
    border: 3px solid #019EFF;
}

.divSessaoDesenvolvimento{
    display: none;
    border: 3px solid #FF6E91;
}

.divSessaoAtivo{
    display: none;
    border: 3px solid #735CC6;
}

.divSessaoPortais{
    display: none;
    border: 3px solid #00EBD0;
}
*/

// $('[attr-ativo = "1"]').hover(
//     function(){
//         $('.itemMenuSelecionado').css("color", "black");
//         var spanAtiva = $(this).closest('.itemMenuNaoSelecionado');
//         $(spanAtiva).css("color","black");
//     },

//     function(){
//         $('.itemMenuSelecionado').css("color", "white");
//         //$('.itemMenuNaoSelecionado').css("color", "white");
    
//     }
// );

    
    
    /*#### Carrossel ####*/


    var avisoUnico = $('.divAviso').data('avisounico');
    if(avisoUnico ==="sim"){
        $('#content').css("justify-content", "center");
        $('#next').css('display',"none");
    }

    
    const gap = 10;

    const carrossel = document.getElementById("carrossel"),
          content = document.getElementById("content"),
          next = document.getElementById("next"),
          prev = document.getElementById("prev");
    
    let width = carrossel.offsetWidth;
    
    // window.addEventListener("resize", () => {
    //     width = carrossel.offsetWidth;
    // });
    
  
     next.addEventListener("click", () => {
        carrossel.scrollBy(width+ gap, 0);
        if (carrossel.scrollLeft + width + gap >= content.scrollWidth) {
            next.style.display = "none";
        }
        if (carrossel.scrollLeft > 0) {
            prev.style.display = "flex";
        }
    });
    
    prev.addEventListener("click", () => {
        carrossel.scrollBy(-(width + gap), 0);
        if (carrossel.scrollLeft - width - gap <= content.scrollWidth) {
            prev.style.display = "none";
        }
        if (carrossel.scrollLeft < content.scrollWidth) {
            next.style.display = "flex";
        }
    });
      


//     const gap = 900;

//     const carrossel = document.getElementById("carrossel"),
//     content = document.getElementById("content"),
//     next = document.getElementById("next"),
//     prev = document.getElementById("prev");

//     next.addEventListener("click", e => {
//     carrossel.scrollBy(width + gap, 0);
//     if (carrossel.scrollWidth !== 0) {
//     prev.style.display = "flex";
//     }
//     if (content.scrollWidth - width - gap <= carrossel.scrollLeft + width) {
//     next.style.display = "none";
//     }
//     });
//     prev.addEventListener("click", e => {
//     carrossel.scrollBy(-(width + gap), 0);
//     if (carrossel.scrollLeft - width - gap <= 0) {
//         prev.style.display = "none";
//     }
//     if (!content.scrollWidth - width - gap <= carrossel.scrollLeft + width) {
//         next.style.display = "flex";
//     }
//     });

//     let width = carrossel.offsetWidth;
//     window.addEventListener("resize", e => (width = carrossel.offsetWidth));    
// });

    /*##########################*/

  
    
});
