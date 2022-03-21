<?php ini_set('display_errors', 'on'); ?>
<?php include("view/admin/includes/header.php");?>

<!-- Modal -->
<div class="modal fade" id="addsalle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Une Salle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- modal formulaire ajoute salle -->
      <form action="./?path=admin&action=traitement-ajouter-salle" method="POST" class="row needs-validation" novalidate>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 form-group">
                <labe for="validationCustom01" l>Nom de salle</label>
                  <input type="text" name="nomSalle" id="validationCustom01" class="form-control" required placeholder="Entrez le nom de salle">
              </div>

              <div class="col-md-6 form-group">
                <label for="validationCustom02">Type de salle</label>
                <Select name="typeSalle" id="validationCustom03" class="form-select" aria-label="Default select example" required>
                  <option selected disabled>-- Choisissez le type de salle --</option>
                  <option value="Formation">Formation</option>
                  <option value="Réunion">Réunion</option>
                  <option value="Conférence">Conférence</option>
                  <option value="Séminaire">Séminaire</option>

                </select>
              </div>

              <div class="col-md-6 form-group">
                <label for="validationCustom02">Status de la salle</label>
                <Select name="statusSalle" id="validationCustom03" class="form-select" aria-label="Default select example" required>
                  <option selected disabled>-- Choisissez le status de la salle --</option>
                  <option value="disponible">Disponible</option>
                  <option value="indisponible">Indisponible</option>
                </select>
              </div>

              <div class="col-md-6 form-group">
                <label for="validationCustom03">Capacité de salle</label>
                <input type="number" name="capSalle" id="validationCustom03" class="form-control" min="2" required placeholder="Entrez la capacité Max">
              </div>

              <div class="col-md-6 form-group">
                <label for="validationCustom04">Ville de salle</label>
                <input type="text" name="villeSalle" id="validationCustom04" class="form-control" required placeholder="Entrez la ville de salle">
              </div>

              <div class="col-md-6 form-group">
                <label for="validationCustom05">Prix de salle</label>
                <input type="text" name="prixSalle" id="validationCustom05" class="form-control" required placeholder="Entrez le prix de salle">
              </div>

              <div class="col-md-12 form-group">
                <label for="validationCustom06"> Description du salle</label>
                <textarea name="descriptionSalle" id="validationCustom06" rows="7" cols="10" id="validationCustom6" class="form-control" placeholder="Description du salle..."></textarea>
              </div>

            </div>
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
      <h6 class="m-0 fw-bold text-primary">Gestion Salles
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addsalle">
          Ajouter Une Salle
        </button>
      </h6>
    </div>
  </div>
</div>

<?php include_once("listSalle.php"); ?>



<?php include_once("view/admin/includes/footer.php");?>