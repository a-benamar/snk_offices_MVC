<?php ini_set('display_errors', 'on'); ?>
<?php include("view/admin/includes/header.php"); ?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 fw-bold text-primary">Modifier profil de User</h6>
        </div>
        <div class="card-body">

            <!-- Form update user -->

                    <div class=" form-group">
                        <!-- formulaire de modification -->

                        <form action="./?path=admin&action=traitement-edit-user" method="POST" class=" row needs-validation" novalidate>
                            <input type="hidden" name="edit_id" value="<?= $utilisateur->getIdUtilisateur(); ?>">
                            <div class="col-md-12 form-group">
                                <label for="validationCustom01" class="form-label">Pseudo</label>
                                <input type="text" name="edit_pseudo"  id="validationCustom01" value="<?= $utilisateur->getPseudo(); ?>" class="form-control" placeholder="Entrez pseudo" required>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="validationCustom03" class="form-label" >Nom</label>
                                <input type="text" name="edit_nom"  id="validationCustom03" value="<?= $utilisateur->getNom(); ?>" class="form-control" placeholder="Entrez Nom" required>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="validationCustom04" class="form-label">Prénom</label>
                                <input type="text" name="edit_prenom"  id="validationCustom04" value="<?=  $utilisateur->getPrenom(); ?>" class="form-control" placeholder="Entrez Prénom" required>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="validationCustom07" class="form-label">Adresse</label>
                                <input type="text" name="edit_adresse"  id="validationCustom07" value="<?=  $utilisateur->getAdresse(); ?>" class="form-control" placeholder="Entrez l'adresse">
                           </div>

                           <div class="col-md-4 form-group">
                                <label for="validationCustom08" class="form-label">Code postale</label>
                                <input type="text" name="edit_cp"  id="validationCustom08" value="<?=  $utilisateur->getCp(); ?>" class="form-control" placeholder="Entrez le code postale">
                           </div>

                           <div class="col-md-4 form-group">
                                <label for="validationCustom09" class="form-label">Ville</label>
                                <input type="text" name="edit_ville"  id="validationCustom09" value="<?=  $utilisateur->getVille(); ?>" class="form-control" placeholder="Entrez la ville">
                           </div>

                            <div class="col-md-6 form-group">
                                <label for="validationCustom05" class="form-label">Téléphone</label>
                                <input type="text" name="edit_tel"  id="validationCustom05" value="<?=  $utilisateur->getTel(); ?>" class="form-control" placeholder="Entrez téléphone" minlength="10" required>
                           </div>

                           <div class="col-md-6 form-group">
                                <label for="validationCustom02" class="form-label">E-mail</label>
                                <input type="email" name="edit_email"  id="validationCustom02"value="<?=  $utilisateur->getEmail(); ?>" class="form-control" placeholder="Entrez l'Email" required>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="validationCustom06" class="form-label">Mot de passe</label>
                                <input type="password" name="edit_mdp"  id="validationCustom0" value="<?=  $utilisateur->getMdp(); ?>" class="form-control" placeholder="Entrez le mot de passe" required>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="validationCustom06" class="form-label">Confirmation</label>
                                <input type="password" name="edit_c_mdp"  id="validationCustom0" value="" class="form-control" placeholder="Confirmation de mot de passe" required>
                            </div>

                            
                            <div class="col-12">
                                <a href="./?path=admin&action=listUser" class="btn btn-outline-danger">Cancel</a>
                                <button type="submit" class="btn btn-outline-primary">Modifier</button>
                            </div>


                        </form>
                    </div>
        </div>
    </div>
</div>




<?php include "view/admin/includes/footer.php";?>