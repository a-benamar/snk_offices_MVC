<?php ini_set('display_errors', 'on'); ?>
<?php include("view/admin/includes/header.php");?>

<!-- Modal -->
<div class="modal fade" id="addreservation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Une Résérvation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- modal formulaire ajoute reservation -->
      <form action="./?path=admin&action=traitement-ajouter-reservation" method="POST" class="needs-validation" novalidate>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">

              <div class="col-md-6 form-group">
                <label for="validationCustom01">Nom Client</label>
                <select class="form-select" aria-label="Default select example" name="idUtilisateur" id="validationCustom01" required>
                  <option disabled selected>-- Veuillez séléctionner un client</option>
                  <?php
                  foreach ($utilisateurs as $utilisateur) :
                  ?>
                    <?php
                    echo ("<option value='" . $utilisateur->getIdUtilisateur() . "'>" .      $utilisateur->getPrenom() . "  " . $utilisateur->getNom() . "</option>");
                    ?>

                  <?php
                  endforeach; ?>
                </select>
              </div>
              <div class="col-md-6 form-group">
                <label for="validationCustom02">Nom de salle</label>
                <select class="form-select" aria-label="Default select example" name="idSalle" id="validationCustom02" required>
                  <option selected disabled>-- Veuillez séléctionner une salle</option>
                  <?php
                  foreach ($salles as $salle) :
                  ?>

                    <?php
                    echo ("<option value='" . $salle->getIdSalle() . "'>" . $salle->getNomSalle() . "</option>");
                    ?>

                  <?php
                  endforeach; ?>
                </select>
              </div>

              <div class="col-md-6 form-group">
                <label for="validationCustom04">Evénement</label>
                <select class="form-select" aria-label="Default select example" name="evenement" id="validationCustom02" required>
                  <option selected disabled>-- Veuillez choisir la nature d'événement --</option>
                  <option value="Formation">Formation</option>
                  <option value="Réunion">Réunion</option>
                  <option value="Conférence">Conférence</option>
                  <option value="Séminaire">Séminaire</option>
                </select>
              </div>

              <div class="col-md-6 form-group">
                <label for="validationCustom3">Nombre de participants</label>
                <input type="number" class="form-control" name="nbr_participant" id="validationCustom03" min="2" placeholder="Nombre de participants" required>
              </div>

              <div class="col-md-6 form-group">
                <label for="validationCustom05">* Date début</label>
                <input type="date" id="validationCustom05" name="dateDebut" min="<?php echo date('Y-m-d'); ?>" class="form-control" required />
              </div>

              <div class="col-md-6 form-group">
                <label for="validationCustom06">* Heure début</label>
                <input type="time" id="validationCustom06" name="heureDebut" class="form-control" required />
              </div>

              <div class="col-md-6 form-group">
                <label for="validationCustom07">* Date fin</label>
                <input type="date" id="validationCustom07" name="dateFin" min="<?php echo date('Y-m-d'); ?>" class="form-control" required />
              </div>


              <div class="col-md-6 form-group">
                <label for="validationCustom08">* Heure fin</label>
                <input type="time" id="validationCustom08" name="heureFin" class="form-control" required />
              </div>

              <div class="col-md-12 form-group">
                <label for="validationCustom09"> Info supplémentaire</label>
                <textarea name="description" id="validationCustom09" rows="7" cols="10" id="validationCustom10" class="form-control" placeholder="Votre message ici..."></textarea>
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
      <h6 class="m-0 fw-bold text-primary">Gestion Résérvation
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addreservation">
          Ajouter Une Résérvation
        </button>
      </h6>
    </div>
  </div>
</div>

<?php include_once("listReservation.php"); ?>



<?php include("view/admin/includes/footer.php");?>