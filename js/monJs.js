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
        var start_time = $("#pageAjoutReserv #start_time").val();
        var end_time = $("#pageAjoutReserv #end_time").val();
        var name = $("#pageAjoutReserv #name").val();
        var description = $("#pageAjoutReserv #description").val();
        $.post("ajax/traiterAjoutReservation.php", {
            "start_time" : start_time,
            "end_time" : end_time,
            "name" : name,
            "description" : description},
            foncRetourArgument,"json");
        });
        
        function foncRetourArgument(data){
            if(data == 1)
            {
                alert("Enregistrement effectué");
            }
            else
            {
                alert("NOPE");
            }
            
        }
    
    
    
});
