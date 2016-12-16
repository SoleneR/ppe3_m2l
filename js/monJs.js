$(function(){
    
    /*-----------------------Page connexion----------------------------------*/
    $('#pageConnexion #btnconnexion').bind("click", function(e) {
            e.preventDefault();
            var login = $("#pageConnexion #login").val();
            window.login = login;
            var mdp = $("#pageConnexion #mdp").val();
            $.post("ajax/traiterConnexion.php",{
                        "login" : window.login ,        
                        "mdp" : mdp },
                        foncRetourConnexion,"json" );
    });
    
    function foncRetourConnexion(data){
            if(data != null){
                $.mobile.changePage("#pageAgendaJour");
             }
             else{
                $("#pageConnexion #message").css({color:'red'});
                $("#pageConnexion #message").html("erreur de login et/ou mdp");
             }
    }
    
    $('#pageAjoutReserv #btnEnregistrerAjout').bind("click",function(e) {
        var start_time = $("#pageAjoutReserv #hdebut").val();
        var end_time = $("#pageAjoutReserv #hfin").val();
        var name = $("#pageAjoutReserv #ltDescr").val();
        var description = $("#pageAjoutReserv #descrComplete").val();
        var start_time = $("#pageAjoutReserv #hdebut").val();
        $.post("ajax/traiterAjoutReservation.php", {
            "hdebut" : start_time,
            "hfin" : end_time,
            "ltDescr" : name,
            "descrComplete" : description,
        },
            foncRetourArgument, "json");
        });
        
        function foncRetourArgument(data){
            
        }
    
    
    
});
