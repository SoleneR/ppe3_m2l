<div data-role="page" id ="pageAgendaJour" data-theme="b">
    <?php
        include "vues/entetePage.html"; 
    ?> 
    <div data-role = "content">
        
        <div class="ui-grid-a"> <!-- Grille entête Calendrier -->
            
            <div class="ui-block-a" id="selectionDate"> <!-- Bouton Jour Précédent -->
                <input type="date" name="date" id="dateJour" value=""  />
            </div>

            <div class="ui-block-b"> <!-- Liste Sélection Jour -->
                <li class="ui-field-contain" id="truc">
                    <select name="select-choice-1" id="listeSalles">
                    </select>
                </li>
            </div>
            
        </div>
        
        
        
        <table data-role="table" class="ui-responsive" id="agendaJour">
            <thead>
                <tr>
                    <th width="10%">Heure</th>
                    <th align="right">Réservation</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td>8h00</td>
                    <td>Exo-Conférence Alexandre Astier</td>
                </tr>
                <tr>
                    <td>8h30</td>
                    <td></td>
                </tr>
                <tr>
                    <td>9h00</td>
                    <td id="9h00"><!-- Test affichage evenement-->
            <li class="ui-field-contain">
                    <select name="select-choice-1" id="listeEvenements">
                    </select>
                </li></td>
                </tr>
                <tr>
                    <td>9h30</td>
                    <td></td>
                </tr>
                <tr>
                    <td>10h00</td>
                    <td></td>
                </tr>
                <tr>
                    <td>10h30</td>
                    <td></td>
                </tr>
                <tr>
                    <td>11h00</td>
                    <td></td>
                </tr>
                <tr>
                    <td>11h30</td>
                    <td></td>
                </tr>
                <tr>
                    <td>12h00</td>
                    <td></td>
                </tr>
                <tr>
                    <td>12h30</td>
                    <td></td>
                </tr>
                <tr>
                    <td>13h00</td>
                    <td></td>
                </tr>
                <tr>
                    <td>13h30</td>
                    <td></td>
                </tr>
                <tr>
                    <td>14h00</td>
                    <td></td>
                </tr>
                <tr>
                    <td>14h30</td>
                    <td></td>
                </tr>
                <tr>
                    <td>15h00</td>
                    <td></td>
                </tr>
                <tr>
                    <td>15h30</td>
                    <td></td>
                </tr>
                <tr>
                    <td>16h00</td>
                    <td></td>
                </tr>
                <tr>
                    <td>16h30</td>
                    <td></td>
                </tr>
                <tr>
                    <td>17h00</td>
                    <td></td>
                </tr>
                <tr>
                    <td>17h30</td>
                    <td></td>
                </tr>
                <tr>
                    <td>18h00</td>
                    <td></td>
                </tr>
                <tr>
                    <td>18h30</td>
                    <td></td>
                </tr>
                <tr>
                    <td>19h00</td>
                    <td></td>
                </tr>
                <tr>
                    <td>19h30</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        
        
        <div id='calendar'>
            
        </div>
        
        
        
        
        
        
        
    </div> <!-- /fin content --> 
        <?php 
            include "vues/piedsPage.html"; 
        ?> 
</div> <!-- /fin page -->

