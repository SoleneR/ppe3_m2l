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
        
        <table data-role="table" class="ui-responsive" id="agendaJour">
            <thead>
                <tr>
                    <th width="10%">Heure</th>
                    <th align="right"><span style="display: block; text-align: center;">Réservation</span></th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                    $debut=  strtotime("8:00") - strtotime("0:00"); //Création d'une variable comprenant l'heure de début de journée (8h00 - 1h00 d'heure d'été)

                    for ($i = $debut ; $i <= $debut + 42600 ; $i += 1800)
                    {
                        echo "<tr>";
                            echo "<td>";
                                echo date("H:i", $i - 3600); //On affiche l'heure qui s'auto-incrémente d'une demi-heure dans la première colonne du tableau
                            echo "</td>";
                            
                            echo "<td  class='cellData' id=$i>"; //On attribue comme id à la deuxième colonne l'heure  qui s'auto-incrémente correspondant à la première.
                                
                            echo "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        
    </div> <!-- /fin content --> 
        <?php 
            include "vues/piedsPage.html"; 
        ?> 
</div> <!-- /fin page -->

