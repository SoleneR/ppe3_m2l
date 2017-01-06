<div data-role="page" id ="pageVoirReservations" data-theme="b"> 
    <?php 
        include "vues/entetePage.html"; 
    ?> 
    <div data-role = "content"> 
    <ul id="listeReservations" data-role="listview"  data-filter-placeholder="Réservations..." data-filter="true" >
                   
    </ul>
        <textarea id="reservation" value=""  class="required"></textarea>
        
        <a href ="#" data-role="button" id="btnEffacerReservation" data-inline="true">Effacer une réservation</a>
        <a href ="#" data-role="button" id="btnCopierReservation" data-inline="true">Copier une réservation</a>
        
       </div> <!-- /fin content --> 
        <?php 
            include "vues/piedsPage.html"; 
        ?> 
</div> <!-- /fin page -->