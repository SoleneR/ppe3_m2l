<div data-role="page" id ="pageAgendaJour" data-theme="b"> 
    <?php 
        include "vues/entetePage.html"; 
    ?> 
    <div data-role = "content"> 
        
        <div class="ui-grid-solo">
            <div class="ui-block-a"><ul data-role="listview"><li>One</li></ul></div>
        </div>
        <div class="ui-grid-a">
            <div class="ui-block-a"><button type="button" data-theme="c">Previous</button></div>
            <div class="ui-block-b"><button type="button" data-theme="c">Next</button></div>	   
        </div>
        
        
        
        <!--
        <table data-role="table" class="ui-responsive">
            <thead>
                <tr>
                    <th>Heure</th>
                    <th>Salle de Réunion</th>
                </tr>
            </thead>
            <tr>
                <td>8h00</td>
                <td>Exo-Conférence Alexandre Astier</td>
            </tr>
            <tr>
                <td>8h30</td>
            </tr>
            <tr>
                <td>9h00</td>
            </tr>
            
        </table>
        -->
        
        <div id='calendar'>
            
        </div>
        
        
        
        
        
        
        
    </div> <!-- /fin content --> 
        <?php 
            include "vues/piedsPage.html"; 
        ?> 
</div> <!-- /fin page -->

