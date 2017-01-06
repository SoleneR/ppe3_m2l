<div data-role="page" id ="pageAgendaJour" data-theme="b">
    <?php
        include "vues/entetePage.html"; 
    ?> 
    <div data-role = "content">
        
        <div class="ui-grid-a">
            
            <div class="ui-block-a" id="selectionDate"> <!-- Sélection Jour -->
                <input type="date" name="date" id="dateJour" value=""  />
            </div>

            <div class="ui-block-b"> <!-- Sélection Salle  -->
                <li class="ui-field-contain">
                    <select name="select-choice-1" id="listeSalles">
                    </select>
                </li>
            </div>
            
        </div>
        
        
        <?php
            $debut=  strtotime("8:00");
        ?>
        <table data-role="table" class="ui-responsive" id="agendaJour">
            <thead>
                <tr>
                    <th width="10%">Heure</th>
                    <th align="right">Réservation</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                for ($i = $debut ; $i <= $debut + 42600 ; $i += 1800)
                {
                    echo "<tr>";
                    echo "<td>";
                    echo date("H:i", $i);
                    echo "</td>";
                    echo "<td >";
                    echo "</td>";
                    echo "</tr>";
                }
                    
                
                
                ?>
                
                
                
            </tbody>
        </table>
        
        
        <div id='calendar'>
            
        </div>
        
        
        
        
        
        
        
    </div> <!-- /fin content --> 
        <?php 
            include "vues/piedsPage.html"; 
        ?> 
</div> <!-- /fin page -->

