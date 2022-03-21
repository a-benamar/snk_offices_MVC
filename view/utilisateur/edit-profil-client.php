<?php ini_set('display_errors', 'on'); ?>

<?php $title = 'Modification de Profil'; ?>


<?php ob_start(); ?>

<div class="container">
    <div class="main-body mt-3">

        <!-- Breadcrumb -->
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./?path=main&action=accueil">Accueil</a></li>
                <li><i class="fas fa-angle-right mx-1"></i></li>
                <li class="breadcrumb-item active" aria-current="page">Profil</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->

        <div class="container rounded bg-white my-5">
            <div class="row body-profil">
                <div class="col-md-4 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-3" src="https://www.pinclipart.com/picdir/middle/157-1578186_user-profile-default-image-png-clipart.png" width="120">
                        <span class="fw-bold mt-5"><?= $utilisateur->getPrenom() . " " . $utilisateur->getNom() ?></span>
                        <span class="text-black-50"><?= $utilisateur->getEmail() ?></span>
                        <span><?= $utilisateur->getVille() ?></span>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="p-3 py-5">

                        <form action="./?path=client&action=traitement-edit-profil-client" method="POST" novalidate>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex flex-row align-items-center back">
                                    <a href="./?path=client&action=profil-client" class="btn btn-outline-secondary "><i class="fas fa-angle-left mr-1 mb-1"></i>Retour</a>
                                </div>
                                <div>
                                    <img class="logo-user-profil" src="public\icon\logo.png" alt="">
                                </div>
                                <div class="d-flex flex-row align-items-center back">
                                    <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-check mr-1 mb-1"></i>Valider</button>
                                </div>
                            </div>
                            <hr>

                            <div class="row mt-2">
                                <div class="col-md-6 form-group">
                                    <input type="hidden" name="edit_id" value="<?= $utilisateur->getIdUtilisateur(); ?>">

                                    <label for="validationCustom01" class="form-label">Pseudo</label>
                                    <select name="edit_pseudo" id="validationCustom01" class="form-control" required>
                                        <option> <?= $utilisateur->getPseudo(); ?></option>
                                    </select>

                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="validationCustom02" class="form-label">E-mail</label>
                                    <select name="edit_email" id="validationCustom02" class="form-control" required>
                                        <option> <?= $utilisateur->getEmail(); ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6 form-group">
                                    <label for="validationCustom02" class="form-label">Nom</label>
                                    <input type="text" name="edit_nom" id="validationCustom02" value="<?= $utilisateur->getNom(); ?>" class="form-control" placeholder="Entrez votre nom" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="validationCustom02" class="form-label">Prénom</label>
                                    <input type="text" name="edit_prenom" id="validationCustom02" value="<?= $utilisateur->getPrenom(); ?>" class="form-control" placeholder="Entrez votre prenom" required>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6 form-group">

                                    <label for="validationCustom02" class="form-label">Téléphone</label>
                                    <input type="text" name="edit_tel" id="validationCustom02" value="<?= $utilisateur->getTel(); ?>" class="form-control" placeholder="Entrez téléphone" required>

                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="validationCustom02" class="form-label">Adresee</label>
                                    <input type="text" name="edit_adresse" id="validationCustom02" value="<?= $utilisateur->getAdresse(); ?>" class="form-control" placeholder="Entrez votre adresse">

                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6 form-group">
                                    <label for="validationCustom02" class="form-label">Code postale</label>
                                    <input type="text" name="edit_cp" id="validationCustom02" value="<?= $utilisateur->getCp(); ?>" class="form-control" min="5" max="5" placeholder="Entrez votre code postale">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="validationCustom02" class="form-label">Ville</label>
                                    <input type="text" name="edit_ville" id="validationCustom02" value="<?= $utilisateur->getVille(); ?>" class="form-control" placeholder="Entrez votre ville">
                                </div>

                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6 form-group">
                                    <label for="validationCustom02" class="form-label">Mot de passe</label>
                                    <input pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$" type="password" name="edit_mdp" id="validationCustom02" value="<?= $utilisateur->getmdp(); ?>" class="form-control" placeholder="Entrez votre mot de passe" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="validationCustom02" class="form-label">Confirmation mot de passe</label>
                                    <input pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$" type="password" name="edit_c_mdp" id="validationCustom02" class="form-control" placeholder="Confirmation de mot de passe" required>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>


<style>
    body {
        background: whitesmoke
    }

    .body-profil {
        box-shadow: 1px 1px 15px 1px rgb(251, 145, 31)
    }

    .breadcrumb {
        background: none
    }

    .logo-user-profil {
        width: 100px;
        height: 100px;
        position: relative
    }

    .form-control:focus {
        box-shadow: none;
        border-color: red
    }

    .profile-button {
        background: #fb911f;
        box-shadow: none;
        border: none
    }

    .profile-button:hover {
        background: #262e49;

    }

    .profile-button:focus {
        background: green;
        box-shadow: none
    }

    .profile-button:active {
        background: yellow;
        box-shadow: none
    }

    .back:hover {
        color: #fb911f;
        cursor: pointer
    }
</style>



<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>