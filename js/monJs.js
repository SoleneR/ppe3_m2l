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
        
            
        $("#pageVoirReservations #listeReservations").on( "filterablebeforefilter", function (e, data ){
        var name = data.input.val();// on récupère la saisie
        if(name && name.length >=1){
        $.post("ajax/traiterRechercheReservation.php",{
             "name" : name        
              },foncRetourRechercheReservations,"json" );
              }
        });
        
        function foncRetourRechercheReservations(data){
        var html ="";
            for(i=0; i < data.length;i++){
                 var reservation = data[i];
                 var id = reservation['id'];
                 var name = reservation['name'];
                 var description = reservation['description'];
                 var start_time = reservation['start_datetime'];
                 var end_time = reservation['end_datetime'];
                 var room_name = reservation['room_name'];
                 html +="<li id=" + id +"><input type='hidden' value ="+name+"><a href ='#' >" + name + "  Description: " + description + "  Début: " + start_time +"  Fin: "+end_time+"  Salle: "+room_name ;
                 html +="</a></li>";
        }
        $("#pageVoirReservations #listeReservations").html( html );
        $("#pageVoirReservations #listeReservations").listview( "refresh" );
        } 
        
         // pour abonner un élément HTML générer dynamiquement, il faut utiliser cette syntaxe et on
         $("#pageVoirReservations #listeReservations").on("click","li", function(e) { 
             var idReservation = $(this).prop('id'); // attr déprécié
             window.idReservation = idReservation;
             // l'usage veut que les variables de type sélecteur commence par $
             var $reservation =  $("#pageVoirReservations #reservation");
             $reservation.val($(this).text()); //charge les données du médecin
             $("#pageVoirReservations #listeReservations").empty();
           
         });
    
        $("#pageVoirReservations").on( "pagebeforeshow", function (event, ui) {
            $("#pageVoirReservations #reservation").val(""); 
            $("#pageVoirReservations #listeReservations").val(""); 
         } );

       
        
       
        
   
    
    
    
    
    
});
