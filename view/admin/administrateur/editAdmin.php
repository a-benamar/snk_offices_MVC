<?php
ini_set('display_errors', 'on');
include("view/admin/includes/header.php");
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 fw-bold text-primary">Modifier profil d'admin</h6>
        </div>
        <div class="card-body">

            <div class="form-group">
                <!-- formulaire de modification -->

                <form action="./?path=admin&action=traitement-edit-admin" method="POST" class="row needs-validation" novalidate>

                    <div class="col-md-5 form-group">
                        <input type="hidden" name="edit_id" value="<?= $admin->getidAdmin(); ?>">
                        <label for="validationCustom01">* Pseudo</label>
                        <input type="text" id="validationCustom01" name="edit_pseudo" value="<?= $admin->getPseudo(); ?>" class="form-control" placeholder="Entrez pseudo" required>
                    </div>

                    <div class="col-md-5 form-group">
                        <label for="validationCustom04">* Email</label>
                        <input type="email" id="validationCustom04" name="edit_email" value="<?= $admin->getEmail(); ?>" class="form-control" placeholder="Entrez Email" required>
                    </div>

                    <div class="col-md-5 form-group">
                        <label for="validationCustom02">* Nom</label>
                        <input type="text" id="validationCustom02" name="edit_nom" value="<?= $admin->getNom(); ?>" class="form-control" placeholder="Entrez Nom" required>
                    </div>
                    <div class="col-md-5 form-group">
                        <label for="validationCustom03">* Prénom</label>
                        <input type="text" id="validationCustom03" name="edit_prenom" value="<?= $admin->getPrenom(); ?>" class="form-control" placeholder="Entrez Prénom" required>
                    </div>
 
                    <div class="col-md-5 form-group">
                        <label for="validationCustom05">* Mot de passe</label>
                        <input type="password" id="validationCustom05" name="edit_mdp" value="<?= $admin->getMdp(); ?>" class="form-control" placeholder="Entrez le mot de passe" required>
                    </div>
                    <div class="col-md-5 form-group">
                        <label for="validationCustom05">* Confirmation</label>
                        <input type="password" id="validationCustom05" name="edit_c_mdp" value="" class="form-control" placeholder="Entrez le mot de passe" required>
                    </div>
                    <div class="col-12">
                        <a href="./?path=admin&action=listAdmin" class="btn btn-outline-danger">Cancel</a>
                        <button type="submit" class="btn btn-outline-primary">Modifier</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<?php include "view/admin/includes/footer.php";?>