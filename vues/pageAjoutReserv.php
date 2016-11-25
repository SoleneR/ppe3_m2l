<div data-role= "page" id = "pageAjoutReserv"> 
    <?php 
        include "vues/entetePage.html"; 
    ?> 
    <div data-role = "content"> 
        <label id="ltDescr">Brève description</label>
        <input type="text" name="ltDescr" id="ltDescr" value=""/>  
        
        <label id="descrComplete">Description complète</label>
        <textarea name="descrComplete" id="descrComplete" class="required"></textarea>
        
        <label id="debut">Début</label>
        <input type="date" name="debut" id="debut" value=""/>
        
   
    </div> <!-- /fin content --> 
        <?php 
            include "vues/piedsPage.html"; 
        ?> 
</div> <!-- /fin page -->