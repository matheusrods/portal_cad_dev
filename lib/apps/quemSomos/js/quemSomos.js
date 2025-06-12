$(document).ready(function() {
    $('.divSquad a').click(function(e) {
        e.stopPropagation();
    });
    
    $('.divSquad').click(function(){
        var idSquadClicada = $(this).attr('id');
        var idSquadAberta = $('.squadsFuncionarios').attr('attr-squadaberta');

        if(idSquadAberta == idSquadClicada){

            $('.squadsFuncionarios').attr('attr-squadaberta', '0');
            $('.divSquad').attr('attr-squadaberta', '0');
            $('.squad'+idSquadAberta).slideToggle(150);

            $('.iconeSetaSquad'+idSquadAberta).removeClass('fa-chevron-up');
            $('.iconeSetaSquad'+idSquadAberta).addClass('fa-chevron-down');
            
            $('.botaoSetaSquad'+idSquadAberta).removeClass('btn-dark');
            $('.botaoSetaSquad'+idSquadAberta).addClass('btn-outline-dark');
            
        } else {

            $('.squad'+idSquadAberta).slideToggle(150);
            $('.squad'+idSquadClicada).slideToggle(150);
            
            $('.squad'+idSquadClicada).css('display', 'flex');
            $('.squadsFuncionarios').attr('attr-squadaberta', idSquadClicada);
            $('.divSquad').attr('attr-squadaberta', idSquadClicada);

            $('.iconeSetaSquad'+idSquadAberta).removeClass('fa-chevron-up');
            $('.iconeSetaSquad'+idSquadAberta).addClass('fa-chevron-down');

            $('.iconeSetaSquad'+idSquadClicada).removeClass('fa-chevron-down');
            $('.iconeSetaSquad'+idSquadClicada).addClass('fa-chevron-up');

            $('.botaoSetaSquad'+idSquadAberta).removeClass('btn-dark');
            $('.botaoSetaSquad'+idSquadAberta).addClass('btn-outline-dark');

            $('.botaoSetaSquad'+idSquadClicada).removeClass('btn-outline-dark');
            $('.botaoSetaSquad'+idSquadClicada).addClass('btn-dark');

        }
    });
});
