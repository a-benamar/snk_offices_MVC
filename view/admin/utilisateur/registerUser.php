<?php ini_set('display_errors', 'on'); ?>
<?php include("view/admin/includes/header.php"); ?>


<!-- Modal -->
<div class="modal fade" id="adduserprofile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter User Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- modal formulaire ajoute user -->
      <form action="./?path=admin&action=traitement-inscription-utilisateur" method="POST" class="row needs-validation" novalidate>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">

              <div class="col-md-6 form-group">
                <label for="validationCustom01">* Pseudo</label>
                <input type="text" id="validationCustom01" name="pseudo" class="form-control" placeholder="Entrez pseudo" required>
              </div>

              <div class="col-md-6 form-group">
                <label for="validationCustom02">* Nom</label>
                <input type="text" id="validationCustom02" name="nom" class="form-control" placeholder="Entrez Nom" required>
              </div>

              <div class="col-md-6 form-group">
                <label for="validationCustom02">* Prénom</label>
                <input type="text" id="validationCustom03" name="prenom" class="form-control" placeholder="Entrez Prénom" required>
              </div>

              <div class="col-md-6 form-group">
                <label for="validationCustom08">Adresse</label>
                <input type="text" id="validationCustom08" name="adresse" class="form-control" placeholder="Entrez l'adresse" >
              </div>

              <div class="col-md-6 form-group">
                <label for="validationCustom0">Code Postale</label>
                <input type="text" id="validationCustom09" name="cp" class="form-control" placeholder="Entrez le code postale" >
              </div>

              <div class="col-md-6 form-group">
                <label for="validationCustom10">Ville</label>
                <input type="text" id="validationCustom10" name="ville" class="form-control" placeholder="Entrez la ville">
              </div>
              
              <div class="col-md-6 form-group">
                <label for="validationCustom04">* Téléphone</label>
                <input type="text" id="validationCustom03" name="tel" class="form-control" placeholder="Entrez téléphone" minlength="10" required>
              </div>

              <div class="col-md-6 form-group">
                <label for="validationCustom05">* Email</label>
                <input type="email" id="validationCustom04" name="email" class="form-control" placeholder="Entrez Email" required>
              </div>

              <div class="col-md-6 form-group">
                <label for="validationCustom06">* Mot de passe</label>
                <input type="password" id="validationCustom05" name="mdp" class="form-control" placeholder="Entrez le mot de passe" required>
              </div>

              <div class="col-md-6 form-group">
                <label for="validationCustom07">* Confirmation</label>
                <input type="password" id="validationCustom06" name="c_mdp" class="form-control" placeholder="Entrez confirmation mot de passe" required>
              </div>

            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-outline-primary">S'inscrire</button>
        </div>

      </form>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 fw-bold text-primary">Profil User
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adduserprofile">
          Ajouter User
        </button>
      </h6>
    </div>
  </div>
</div>

<?php include_once("listUser.php"); ?>



<?php include("view/admin/includes/footer.php");?>