<div data-role="page" id="pageConnexion">
    <?php
        include "vues/entetehtml.html";
    ?>
        <div data-role="content" id="divconnexion">
            <?php
                include "vues/logo.html";
            ?>
            <div class="ui-field-contain">
                <label for="login">Nom</label>
                <input type="text" name="login" id="login" value=""/>
                <label for="mdp">Mot de passe</label>
                <input type="password" name="mdp" id="mdp" value=""/>
            </div>
            <div id="message">  </div>
                <p>
                    <a href="#" data-role="button" id="btnconnexion" data-line="true">
                        S'identifier
                    </a>
                </p>
          
        </div><!-- /content -->
        <?php
            //include "vues/piedpage.html";
        ?>
</div><!-- /page 1 -->