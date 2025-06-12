$(document).ready(function() {


/*Menu da seção de áreas do portal*/    

function resetPesquisas(){

    $('#pesquisasIcone').attr("fill", "#000");
    $('#menuPesquisas').css("background-color", "#FEFEFE");
    $('#idSpanPesquisasMenu').css("color", "#000");
    $('#areaPesquisas').css("display", "none");

}

function resetEstudos(){

    $('#estudosIcone').attr("fill", "#000");
    $('#menuEstudos').css("background-color", "#FEFEFE");
    $('#idSpanEstudosMenu').css("color", "#000");
    $('#areaEstudos').css("display", "none");

}

function resetExperimentacoes(){

    $('#experimentacoesIcone').attr("fill","#000");
    $('#menuExperimentacoes').css('background-color', '#FEFEFE');
    $('#idSpanExperimentacoesMenu').css("color","#000");
    $('#areaExperimentacoes').css("display", "none");
    
}

function resetPaineis(){

    $('#paineisIcone').attr("fill", "#000");
    $('#menuPaineis').css("background-color", "#FEFEFE");
    $('#idSpanPaineisMenu').css("color", "#000");    
    $('#areaPaineis').css("display", "none");
}


function resetRecursos(){
    $('#recursosIcone').attr("fill", "#000");
    $('#menuRecursos').css("background-color", "#FEFEFE");
    $('#idSpanRecursosMenu').css("color", "#000");
    $('#areaRecursos').css("display", "none");
}


function resetCopilotos(){

    $('#copilotosIcone').attr("fill", "#000");
    $('#menuCopilotos').css("background-color", "#FEFEFE");
    $('#idSpanCopilotosMenu').css("color", "#000");
    $('#areaCopilotos').css("display", "none");
}


$('#menuPesquisas').on('click', function (){
    $('#pesquisasIcone').attr("fill","white");
    $('#menuPesquisas').css("background-color","#465EFF");
    $('#idSpanPesquisasMenu').css("color","white");
    $('#areaPesquisas').css("display", "inline-flex");
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
    $('#areaCopilotos').css("display", "block");

    resetExperimentacoes();
    resetPaineis();
    resetPesquisas();
    resetEstudos();
    resetRecursos();
});




    
    
    /*#### Carrossel ####*/
    const gap = 900;

    const carrossel = document.getElementById("carrossel"),
          content = document.getElementById("content"),
          next = document.getElementById("next"),
          prev = document.getElementById("prev");
    
    let width = carrossel.offsetWidth;
    
    window.addEventListener("resize", () => {
        width = carrossel.offsetWidth;
    });
    
    next.addEventListener("click", () => {
        carrossel.scrollBy(width + gap, 0);
        if (carrossel.scrollLeft + width + gap >= content.scrollWidth) {
            next.style.display = "none";
        }
        if (carrossel.scrollLeft > 0) {
            prev.style.display = "flex";
        }
    });
    
    prev.addEventListener("click", () => {
        carrossel.scrollBy(-(width + gap), 0);
        if (carrossel.scrollLeft - width - gap <= 0) {
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
