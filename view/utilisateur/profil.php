<?php ini_set('display_errors', 'on'); ?>

<?php $title = 'Profil'; ?>


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

        <?php if (isset($_SESSION['error'])) : ?>
          <div class="alert alert-danger text-center">

            <?= $_SESSION["error"];
            unset($_SESSION['error']);
            ?>

          </div>
        <?php endif; ?>

        <?php if (isset($_SESSION["success"])) : ?>

          <div class="alert alert-success text-center">

            <?= $_SESSION["success"];
            unset($_SESSION['success']);
            ?>

          </div>

          <?php
          // Pour supprimer la persistance des données et réinitialiser le formulaire en cas de succès
          session_unset();
          ?>
        <?php endif; ?>


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

            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="d-flex flex-row align-items-center back">
                <a href="./?path=main&action=accueil" class="btn btn-outline-secondary "><i class="fas fa-angle-left mr-1 mb-1"></i>Retour</a>
              </div>
              <div>
                <img class="logo-user-profil" src="public\icon\logo.png" alt="">
              </div>
              <div class="d-flex flex-row align-items-center back">
                <a class="btn btn-outline-secondary" href="./?path=client&action=edit-profil-client&edit_id=<?= $utilisateur->getIdUtilisateur(); ?>" type="submit" name="edit_btn"><i class="fas fa-pencil-alt mr-1 mb-1"></i>Modifier</a>
              </div>
            </div>
            <hr>

            <div class="row mt-2">
              <div class="col-md-6 form-group">
                <span class="font-monospace fw-bolder">Pseudo :</span> <?= $utilisateur->getPseudo() ?>

                <hr>
              </div>
              <div class="col-md-6 form-group">
                <span class="font-monospace fw-bold">E-Mail :</span> <?= $utilisateur->getEmail() ?>
                <hr>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col-md-6 form-group">
                <span class="font-monospace fw-bold">Nom :</span> <?= $utilisateur->getNom() ?>
                <hr>
              </div>

              <div class="col-md-6 form-group">
                <span class="font-monospace fw-bold">Prenom :</span> <?= $utilisateur->getPrenom() ?>
                <hr>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col-md-6 form-group">
                <span class="font-monospace fw-bold">Télphone :</span> <?= $utilisateur->getTel() ?>
                <hr>
              </div>
              <div class="col-md-6 form-group">
                <span class="font-monospace fw-bold">Adresse :</span> <?= $utilisateur->getAdresse() ?>
                <hr>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col-md-6 form-group">
                <span class="font-monospace fw-bold">Code postale :</span> <?= $utilisateur->getCp() ?>
                <hr>
              </div>
              <div class="col-md-6 form-group">
                <span class="font-monospace fw-bold">Ville :</span> <?= $utilisateur->getVille() ?>
                <hr>
              </div>
            </div>
          </div>
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