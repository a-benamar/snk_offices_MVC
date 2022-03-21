<?php ini_set('display_errors', 'on'); ?>
<?php include("view/admin/includes/header.php");?>

<!-- Modal -->
<div class="modal fade" id="addImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Images</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- modal formulaire ajoutee une image  -->
      <form action="./?path=admin&action=traitement-ajouter-image" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        <div class="modal-body">

          <div class="form-group">
                <label for="validationCustom02">* Nom de salle</label>
                <select class="form-select" aria-label="Default select example" name="idSalle" id="validationCustom02" required>
                  <option disabled selected>-- Veuillez séléctionner une salle --</option>
                  <?php
                    foreach ($salles as $salle) : 
                  ?>

                  <?php
                   echo ("<option value='" . $salle->getIdSalle() . "'>" . $salle->getNomSalle() . "</option>"); 
                  ?>

                  <?php
                     endforeach 
                  ; ?>
                </select>
              </div>


          <div class="form-group">
            <label for="validationCustom02">* Image</label>
            <input type="file" name="image" id="validationCustom02" class="form-control" required accept="image/*">
          </div>

          <div class="custom-control custom-switch">
            <input type="checkbox" name="estPrincipale" value="1" id="validationCustom03" class="custom-control-input" >
            <label class="custom-control-label" for="validationCustom03">Est principale</label>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-outline-primary">Ajouter</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 fw-bold text-primary">Gestion d'images
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addImage">
          Ajouter Une Image
        </button>
      </h6>
    </div>
  </div>
</div>

<?php include_once("listImage.php"); ?>

<?php
include "view/admin/includes/scripts.php";
include "view/admin/includes/footer.php";
?>