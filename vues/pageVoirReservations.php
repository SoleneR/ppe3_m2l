<div data-role="page" id ="pageVoirReservations" data-theme="b"> 
    <?php 
        include "vues/entetePage.html"; 
    ?> 
    <div data-role = "content"> 
    <ul id="listeReservations" data-role="listview"  data-filter-placeholder="Réservations..." data-filter="true" >
                   
    </ul>
        <textarea id="reservation" value=""  class="required" />
       </div> <!-- /fin content --> 
        <?php 
            include "vues/piedsPage.html"; 
        ?> 
</div> <!-- /fin page -->