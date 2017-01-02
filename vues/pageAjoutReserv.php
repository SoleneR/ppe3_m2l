<div data-role= "page" id="pageAjoutReserv" data-theme="b" > 
    <?php 
        include "vues/entetePage.html"; 
    ?> 
    <div data-role = "content"> 
        <label id="name">Brève description</label>
        <input type="text" id="name" value=""/>  
        
        <label id="description">Description complète</label>
        <textarea name="description" id="description" class="required"></textarea>
        
        <label id="debut">Début</label>
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
        <label id="fin">Fin</label>
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
        <label id="domaine">Domaine</label>
        <form>
            <select id="domaine" name="domaine" data-mini="true" data-inline="true">
                <option value="">Informatique - multimédia</option>
                <option value="">Salle de réception</option>
                <option value="">Salle de réunion</option>
            </select>
        </form>
        
        <label id="salle">Salles</label>
        <form>
            <select id="salle" name="salle" data-mini="true" data-inline="true">
                <option value="">Multimédia</option>
                <option value="">Salle informatique</option>
            </select>
        </form>
        
        <label id="types">Types</label>
        <form>
            <select id="types" name="types" data-mini="true" data-inline="true">
                <option value="">Régulier</option>
                <option value="">Occasionnel</option>
            </select>
        </form>
        
        <label id="etat">Etat de la confirmation</label>
        <form>
            <fieldset data-role="controlgroup" data-type="horizontal">
                <input type="radio" name="radioChoix" id="radioChoixC" value="Confirmé"  checked="checked">
                <label for="radioChoixC">Confirmé</label>
                <input type="radio" name="radioChoix" id="radioChoixP" value="Provisoire">
		<label for="radioChoixP">Provisoire</label>
            </fieldset>
        </form>
        
        <label id="typePeriod">Type de périodicité</label>
        <form>
            <fieldset data-role="controlgroup" data-type="horizontal">
                <input type="radio" name="typePeriod" id="choixNone" value="Aucune"  checked="checked">
                <label for="choixNone">Aucune</label>
                <input type="radio" name="typePeriod" id="choixJ" value="Jour">
		<label for="choixJ">Jour</label>
                <input type="radio" name="typePeriod" id="choixS" value="Semaine">
		<label for="choixS">Semaine</label>
		<input type="radio" name="typePeriod" id="choixM" value="Mois">
		<label for="choixM">Mois</label>
                <input type="radio" name="typePeriod" id="choixA" value="Annee">
		<label for="choixA">Année</label>
                <input type="radio" name="typePeriod" id="choixNS" value="nSemaines">
		<label for="choixNS">Toutes les n semaines</label>
            </fieldset>
        </form>
                
        <label id="fin">Date de fin de périodicité</label>
            <input type="date" name="dateFinPeriod" id="dateFinPeriod" value=""/>
        
            	<label id="Jour">Jour (pour n semaines)</label>
        <form>
            <fieldset data-role="controlgroup" data-type="horizontal">
                <input type="checkbox" name="Jour" id="dimanche" value="dimanche"  checked="checked">
                <label for="dimanche">dimanche</label>
                <input type="checkbox" name="Jour" id="lundi" value="lundi">
		<label for="lundi">lundi</label>
                <input type="checkbox" name="Jour" id="mardi" value="mardi">
		<label for="mardi">mardi</label>
		<input type="checkbox" name="Jour" id="mercredi" value="mercredi">
		<label for="mercredi">mercredi</label>
                <input type="checkbox" name="jeudi" id="jeudi" value="jeudi">
		<label for="jeudi">jeudi</label>
                <input type="checkbox" name="vendredi" id="vendredi" value="vendredi">
		<label for="vendredi">vendredi</label>
                <input type="checkbox" name="samedi" id="samedi" value="samedi">
		<label for="samedi">samedi</label>
            </fieldset>
        </form>
                
        <label id="intervalle">Intervalle de semaines (pour n semaines)</label>
            <input type="text" name="intervalle" id="intervalle" value=""/>
        
        <a href ="#" data-role="button" id="btnEnregistrerAjout" data-inline="true">Enregistrer</a>
    </div> <!-- /fin content --> 
        <?php 
            include "vues/piedsPage.html"; 
        ?> 
</div> <!-- /fin page -->
