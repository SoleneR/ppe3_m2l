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
            
            html += "<option value='" + id_salle + "' id='" + id_salle + "'>" + nom_salle + "</option>"
        } 
        $('#pageAgendaJour #listeSalles').append(html);
        $('#pageAgendaJour #listeSalles').listview('refresh');
    }
    
    /*-----------------------Affichage Evenements Jour ----------------------------------*/
    
    //$("#pageAgendaJour").ready(function()
    $('#pageAgendaJour #listeSalles').bind("click",function(e)
    {
        var dateJour = $('#pageAgendaJour #dateJour').val()
         var id_salle = $('#pageAgendaJour #listeSalles').val()
        $.post("ajax/traiterEvenementsJour.php",
        {"salle" : id_salle, "dateJour" :dateJour},foncRetourEvenementsJour,"json");
    });
       
    function foncRetourEvenementsJour(data)
    {
        var html="";
        
        for (var j=0; j < data.length; j++)
        {
             var nom_reservation = data[j]['name'];
             var description = data[j]['description'];
             var heure_debut = data[j]['heure_debut'];
             var heure_fin = data[j]['heure_fin'];
             
             for (var i = heure_debut; i < heure_fin; i += 1800) 
            {
              html = "strong>" + nom_reservation + "</strong>" + description;   
                $('#pageAgendaJour #agendaJour').append(html);
                $('#pageAgendaJour #agendaJour').refresh;
              
            }

                 
            
        }
        
        //$("#pageAgendaJour #9h00").append(html);
        //$("#pageAgendaJour #listeSalles").listview('refresh');
        
        //$('#pageAgendaJour #listeEvenements').listview('refresh');
    }
   
    
    
  /*----------------------------------------------------------------------------*/
 /*----------------------------Page Ajout Réservation--------------------------*/
/*----------------------------------------------------------------------------*/
    
    $('#pageAjoutReserv #btnEnregistrerAjout').bind("click",function(e) {
        var start_date = $("#pageAjoutReserv #jdebut").val();
        var end_date = $("#pageAjoutReserv #jfin").val();
        var start_time = $("#pageAjoutReserv #start_time").val();
        var end_time = $("#pageAjoutReserv #end_time").val();
        var room_id = $("#pageAjoutReserv #salle").val();
        var name = $("#pageAjoutReserv #name").val();
        var types = $("#pageAjoutReserv #types").val();
        var description = $("#pageAjoutReserv #description").val();
        var statut = $("#pageAjoutReserv #statut").val();
        $.post("ajax/traiterAjoutReservation.php", {
            "start_date" : start_date,
            "end_date" : end_date,
            "start_time" : start_time,
            "end_time" : end_time,
            "room_id" : room_id,
            "name" : name,
            "types" : types,
            "description" : description,
            "statut" : statut},
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
