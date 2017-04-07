function clearBox(elementClass)
{
    document.getElementsByClassName(elementClass).innerHTML = "";
}

$(function(){
    window.dateJour     = "";
    window.nom_salle    = "";
    window.id_salle     = "";
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

//var today = year + "-" + month + "-" + day;
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
    
    
    $('#pageAgendaJour #listeSalles').bind("click",function(e)
    {
        var dateJour = $('#pageAgendaJour #dateJour').val()
        var id_salle = $('#pageAgendaJour #listeSalles').val()
        
        console.log(dateJour);
        
        $.post("ajax/traiterEvenementsJour.php",
        {"salle" : id_salle, "dateJour" :dateJour},foncRetourEvenementsJour,"json");
    });
       
    function foncRetourEvenementsJour(data)
    {
        var html="";
        //console.log(data[0]["name"]);

            for (z = 28800 ; z <= 77400; z += 1800) //On parcours le tableau pour effacer les cellules
            {
                //console.log(z);
                html = "";
                $('#pageAgendaJour #agendaJour #'+ z).html("");
                $('#pageAgendaJour #agendaJour').refresh;
            }
            
            for (var j=0; j < data.length; j++) //Pour chaque donnée reçu de la requête...
            {   
                var nom_reservation = data[j]['name'];
                var description = data[j]['description'];
                var heure_debut = parseInt(data[j]['heure_debut_stamp']);
                var heure_fin = parseInt(data[j]['heure_fin_stamp']);

                for (hi = heure_debut ; hi < heure_fin ; hi += 1800) // ... on parcours depuis l'heure_debut jusqu'à heure_fin de l'évènement et on ajoute le titre aux id du tableau correspondant
                {
                    //console.log(hi);
                    html = "<span style='display: block; text-align: center;'><strong>" + nom_reservation + " </strong>" + "</span>";
                    $('#pageAgendaJour #agendaJour #'+ hi).append(html);
                    $('#pageAgendaJour #agendaJour').refresh;
                }
                    //console.log(heure_debut);
                    //console.log(heure_fin);
        }
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
                 html +="<li id=" + id +"><input type='hidden' value ="+name+"><a href ='#' >Nom " + name + "  Description: " + description;
                 html +="</a></li>";    
            }
        $("#pageVoirReservations #listeReservations").html( html );
        $("#pageVoirReservations #listeReservations").listview( "refresh" );      
    }

        
    $("#pageVoirReservations #listeReservations").on("click","li", function(e) { 
        var idReservation = $(this).attr('id'); 
        window.idReservation = idReservation;
        $.post("ajax/traiterReservation.php",{
             "idReservation" : window.idReservation },
             foncRetourChoixRapport,"json" );
    });
    
    function foncRetourChoixRapport(data)
    {
       
        $.mobile.changePage("#pageModifierReservations");
        var nom = data['name'];
        var user = data['create_by'];
        var description = data['description'];
        var type = data["type"];
        var statut = data["status"];
        var start = data["start"];
        var end = data["end"];
        var room_name = data["room_name"];
            if(type=='E'){
                type = 'Occasionnel';
            }
            else{
                 type = 'Régulier';
            }
            if(statut=='1'){
                statut = 'Confirmé';
            }
            else{
                statut = 'Provisoire';
            }
                  
        
        $("#pageModifierReservations #nom").val(nom);
        $("#pageModifierReservations #user").val(user);
        $("#pageModifierReservations #description").val(description);
        $("#pageModifierReservations #type").val(type);
        $("#pageModifierReservations #statut").val(statut);
        $("#pageModifierReservations #start").val(start);
        $("#pageModifierReservations #end").val(end);
        $("#pageModifierReservations #salle").val(room_name);

    }
         
          /*----------------------------------------------------------------------------*/
 /*----------------------------Supprimer une réservation----------------------*/
/*----------------------------------------------------------------------------*/           
         $('#pageModifierReservations #btnEffacerReservation').bind("click",function(e) {
             $.post("ajax/traiterEffacerReservation.php",{
             "idReservation" : window.idReservation        
              },foncRetourEffacer,"json" );
             
         });
         function foncRetourEffacer(data)
         {
             if(data==1)
             {
                 alert('Reservation effacée')
             }
             else
             {
                 alert('Erreur pour effacer la réservation');
             }
         }
         
           /*----------------------------------------------------------------------------*/
 /*----------------------------Copier une réservation----------------------*/
/*----------------------------------------------------------------------------*/          
          $('#pageModifierReservations #btnCopierReservation').bind("click",function(e) {
             $.post("ajax/traiterCopierReservation.php",{
             "idReservation" : window.idReservation        
              },foncRetourCopier,"json" );
             
         });
         
         function foncRetourCopier(data)
         {
             if(data==1)
             {
                 alert('Réservation copiée')
             }
             else
             {
                 alert('Erreur pour copier la réservation');
             }
         }


             /*----------------------------------------------------------------------------*/
 /*----------------------------Modifier une réservation----------------------*/
/*----------------------------------------------------------------------------*/   
     $("#pageModifierReservations #btnModifierReservation").on("click",function(e){
        var start = $("#pageModifierReservations #start").val(); 
        var end = $("#pageModifierReservations #end").val(); 
        var nom = $("#pageModifierReservations #nom").val(); 
        var user = $("#pageModifierReservations #user").val();
        var description = $("#pageModifierReservations #description").val();
        var type = $("#pageModifierReservations #type").val();
        var statut = $("#pageModifierReservations #statut").val();
            if(type=='Occasionnel'){
                type = 'E';
            }
            else if (type=="Régulier"){
                 type = 'I';
            }
            if(statut=='Confirmé'){
                statut = '1';
            }
            else if(statut=="Provisoire"){
                statut = '0';
            }
        $.post("ajax/traiterModifierReservation.php",{
                        "idReservation" : window.idReservation,
                        "start" : start,
                        "end" : end,
                        "nom" : nom,
                        "user" : user,
                        "description" : description,
                        "type" : type,
                        "statut" : statut
                        },
                        foncRetourModifRapport,"json" );     
    });

    function foncRetourModifRapport(data)
    {
       if(data==1)
       {
           alert("Mise à jour effectuée");
       }
       else
       {
           alert("Mise à jour échouée");
       }
        
        $.mobile.changePage("#pageAgendaJour");
        
    }
        
});
