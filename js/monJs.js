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
    /*----------------------------------------------------------------------------*/
 /*----------------------------Page AgendaJour --------------------------------*/
/*----------------------------------------------------------------------------*/

    /*-----------------------Maj automatique de la date du jour----------------------------------*/
var date = new Date();

var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();

if (month < 10) month = "0" + month;
if (day < 10) day = "0" + day;

var today = year + "-" + month + "-" + day;

document.getElementById('dateJour').value = today;

window.dateJour = today;

    /*-----------------------Lister Salles----------------------------------*/
$("#pageAgendaJour").ready(function()
    {
        $.post("./ajax/traiterListeSalles.php", foncRetourListeSalles,"json" );
    });
    
    function foncRetourListeSalles(data)
    {
        var html ="";
        for ( var i = 0; i < data.length; i++)
        {
            var id_salle = data[i]['id'];
            var nom_salle = data[i]['room_name'];
            window.nom_salle = nom_salle;
            window.id_salle = id_salle;
            
            html += "<option value='standard' id='" + id_salle + "'>" + nom_salle + "</option>"
        } 
        $('#pageAgendaJour #listeSalles').append(html);
        $('#pageAgendaJour #listeSalles').listview('refresh');
    }
    
    /*-----------------------Affichage Evenements Test ----------------------------------*/
    // Test de conversion et d'affichage d'une dateTime de format TimeStamp en date format Y-M-d h-m
    //Transmission de la salle et de la date pour sélectionner l'évènement
    
    //$("#pageAgendaJour").ready(function()
    $('#pageAgendaJour #listeSalles').bind("click",function(e)
    {
        $.post("ajax/traiterEvenementsJour.php",
        {"salle" : window.id_salle, "date" : window.dateJour},foncRetourEvenementsJour,"json");
    });
       
    function foncRetourEvenementsJour(data)
    {
        var html="";
        for (var i=0; i < data.length; i++)
        {
             //var id = data[i]['id'];
             var nom_reservation = data[i]['name'];
             //var description = data[i]['description'];
             //var start_time = data[i]['start_datetime'];
             //var end_time = data[i]['end_datetime'];
                 
            //html += "<strong>" + name + "</strong>";
            html += "<option value='standard'>" + nom_reservation + "</option>"
        }
        
        //$("#pageAgendaJour #9h00").append(html);
        //$("#pageAgendaJour #listeSalles").listview('refresh');
        $('#pageAgendaJour #listeEvenements').append(html);
        //$('#pageAgendaJour #listeEvenements').listview('refresh');
    }
   
    
    
  /*----------------------------------------------------------------------------*/
 /*----------------------------Page Ajout Réservation--------------------------*/
/*----------------------------------------------------------------------------*/
    
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
                alert("erreur");
            }
            
        }
        
      /*----------------------------------------------------------------------------*/
 /*----------------------------Page Recherche Réservation----------------------*/
/*----------------------------------------------------------------------------*/        
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
        
        
         $("#pageVoirReservations #listeReservations").on("click","li", function(e) { 
             var idReservation = $(this).prop('id'); 
             window.idReservation = idReservation;
             var $reservation =  $("#pageVoirReservations #reservation");
             $reservation.val($(this).text()); 
             $("#pageVoirReservations #listeReservations").empty();
           
         });
    
        $("#pageVoirReservations").on( "pagebeforeshow", function (event, ui) {
            $("#pageVoirReservations #reservation").val(""); 
            $("#pageVoirReservations #listeReservations").val(""); 
         } );

       
        
       
        
   
    
    
    
    
    
});
