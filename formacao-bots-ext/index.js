$(document).ready(function() {
    function scrollToSection(sectionId) {
        document.getElementById(sectionId).scrollIntoView({ behavior: 'smooth' });
    }
    // $(".vaiParaDiv").click(function() {
    //     var qualDiv = $(this).attr('attr-qualDiv');
    //     $('html, body').animate({
    //         scrollTop: $("#"+qualDiv).position().top
    //     });
    // });
    document.getElementById('divChamaBot').addEventListener('click', function() {
        document.getElementById('chat-window').classList.toggle('hidden');
    });

    $('.aulaIndisponivel').text('Em breve');
    
});