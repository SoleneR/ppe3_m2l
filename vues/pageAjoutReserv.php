<div data-role= "page" id="pageAjoutReserv" data-theme="b" > 
    <?php 
        include "vues/entetePage.html"; 
    ?> 
    <div data-role = "content"> 
        <label id="lname">Brève description</label>
        <input type="text" name="name" id="name" value=""/> 
        
        <label id="ldescription">Description complète</label>
        <textarea name="description" id="description" class="required"></textarea>
        
        <label id="ldebut">Début</label>
        <input type="date" name="jdebut" id="jdebut" value=""/>
        <form>
           <select name="start_time" data-mini="true" id="start_time" data-inline="true">
            <?php
            $step  = 30 * 60;   // 15 minutes
            $limit = 19 * 60 * 60;  // 24 heures
            for($heureDebut=6*60*60; $heureDebut<$limit; $heureDebut+=$step)
            {
                $heure=date('H:i:s', $heureDebut);
                echo'<option value="'.$heure.'">'.$heure.'</option>'; 
            }  
           ?> 
        </select>
        </form>
        <label id="lfin">Fin</label>
        <input type="date" name="jfin" id="jfin" value=""/>
        <form>
           <select name="end_time" data-mini="true" id="end_time" data-inline="true">
            <?php
            $step  = 30 * 60;   // 15 minutes
            $limit = 19 * 60 * 60;  // 24 heures
            for($heureDebut=6*60*60; $heureDebut<$limit; $heureDebut+=$step)
            {
                $heure=date('H:i:s', $heureDebut);
                echo'<option value="'.$heure.'">'.$heure.'</option>'; 
            }  
           ?> 
            </select>
        </form>
                
        <label id="lsalle">Salles</label>
        <form>
            <select id="salle" name="salle" data-mini="true" data-inline="true">
                <option value="5">Multimédia</option>
                <option value="12">Salle informatique</option>
            </select>
        </form>
        
        <label id="ltypes">Types</label>
            <select id="types" name="types" data-mini="true" data-inline="true">
                <option value="I">Régulier</option>
                <option value="E">Occasionnel</option>
            </select>
        
        <label id="letat">Etat de la confirmation</label>
        <select id="statut" name="statut" data-mini="true" data-inline="true">
                <option value="1">Confirmé</option>
                <option value="0">Provisoire</option>
        </select>
        <br>
  
                        
        <a href ="#" data-role="button" id="btnEnregistrerAjout" data-inline="true" data-icon="check">Enregistrer</a>
    </div> <!-- /fin content --> 
        <?php 
            include "vues/piedsPage.html"; 
        ?> 
</div> <!-- /fin page -->
