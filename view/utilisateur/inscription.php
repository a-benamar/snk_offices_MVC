<?php
ini_set('display_errors', 'on');

$title = "S'inscrire"; ?>

<?php ob_start(); ?>



<div id="inscription" class="form-inscrip">
    <form action="./?path=main&action=traitement-inscription" method="POST" class="formInscrip">

        <?php if (isset($_SESSION['error'])) : ?>
            <div class="alert alert-danger">

                <?= $_SESSION["error"];
                unset($_SESSION['error']);
                ?>

            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION["success"])) : ?>

            <div class="alert alert-success">

                <?= $_SESSION["success"];
                unset($_SESSION['success']);
                ?>

            </div>

            <?php
            // Pour supprimer la persistance des données et réinitialiser le formulaire en cas de succès
            session_unset();
            ?>

        <?php endif; ?>

        <h4>CREATION<span> compte</span></h4>

        <h5>Formulaire d'inscription</h5>

        <div class=" row formulaire-inscription">

            <div class="col-10 col-md-5 col-ms-12 inscr-input">
                <label for="pseudo">Pseudo</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Entrez votre pseudo(*)" maxlength="255" required value="">
            </div>
            <div class="col-10 col-md-5 col-ms-12 inscr-input">
                <label for="nom">Nom</label>
                <input pattern="[a-zA-Z]{2,50}" type="text" class="form-control" id="nom" name="nom" placeholder="Nom(*)" minlength="2" maxlength="255" required value="">
            </div>

            <div class="col-10 col-md-5 col-ms-12 inscr-input">
                <label for="prenom">Prénom</label>
                <input pattern="[a-zA-Z]{2,50}" type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom(*)" minlength="2" maxlength="255" required value="">
            </div>


            <div class="col-10 col-md-5 col-ms-12 inscr-input">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" maxlength="255" value="">
            </div>


            <div class="col-10 col-md-5 col-ms-12 inscr-input">
                <label for="ville">Ville</label>
                <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville(*)" maxlength="255" required value="">
            </div>


            <div class="col-10 col-md-5 col-ms-12  inscr-input">
                <label for="cp">Code Postale</label>
                <input type="text" class="form-control" id="cp" name="cp" placeholder="Code postal(*)" maxlength="5" required value="">
            </div>


            <div class="col-10 col-md-5 col-ms-12 inscr-input">
                <label for="tel">Téléphone</label>
                <input type="text" class="form-control" id="tel" name="tel" placeholder="Numéro sans espace(*)" maxlength="11" required value="">
            </div>


            <div class="col-10 col-md-5 col-ms-12 inscr-input">
                <label for="email">Adresse Mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail(*)" maxlength="255" required value="">
            </div>


            <div class="col-10 col-md-5 col-ms-12 inscr-input">
                <label for="mdp">Mot de Passe</label>
                <input pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$" type="password" class="form-control" id="mdp" name="mdp" placeholder="Mot de passe(*) (8 car min)" minlength="8" maxlength="255" required value="">
            </div>

            <div class="col-10 col-md-5 col-ms-12 inscr-input">
                <label for="c_mdp">Confirmation</label>
                <input type="password" class="form-control" id="c_mdp" name="c_mdp" placeholder="Confirmation mot de passe(*)" minlength="8" maxlength="255" required value="">
            </div>

            <div class="col-10 col-md-5 col-ms-12 inscr-input">
                <input type="submit" name="valider" value="S'inscrire" class="btn-inscrire">

            </div>

        </div>

    </form>
    <?php

    // On détruit $_SESSION pour le réinitialiser afin de gérer d'éventuelles nouvelles erreurs
    // à la prochaine soumission
    session_unset();
    session_destroy();

    ?>

</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>