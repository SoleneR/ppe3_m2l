<div data-role="page" id ="pageModifierReservations" data-theme="b"> 
    <?php 
        include "vues/entetePage.html"; 
    ?> 
    <div data-role = "content"> 

                <label for="lblnom">Nom</label>
                <textarea name="nom" id="nom" class="required"></textarea>
                <label for="lbluser">Créée par :</label>
                <textarea name="user" id="user" class="required"></textarea>
                <label for="lbldescription">Description</label>
                <textarea name="description" id="description" class="required"></textarea>
                <label for="lbltype" >Type</label>
                <textarea name="type" id="type" class="required"></textarea>
                <label for="lblstatut" >Statut</label>
                <textarea name="statut" id="statut" class="required"></textarea>
                <label for="lblstart_datetime" >Date de début</label>
                <textarea name="start" id="start" class="required"></textarea>
                <label for="lblend_datetime" >Date de fin</label>
                <textarea name="end" id="end" class="required"></textarea>
                <label for="lblsalle" >Salle</label>
                <textarea name="salle" id="salle" class="required"></textarea>
                
                
        <a href ="#" data-role="button" id="btnModifierReservation" data-inline="true">Modifier une réservation</a>
        <a href ="#" data-role="button" id="btnEffacerReservation" data-inline="true">Effacer une réservation</a>
        <a href ="#" data-role="button" id="btnCopierReservation" data-inline="true">Copier une réservation</a>     
        
       </div> <!-- /fin content --> 
        <?php 
            include "vues/piedsPage.html"; 
        ?> 
</div> <!-- /fin page -->

