<?php $title = 'Formulaire de Reservation'; ?>

<?php ob_start(); ?>
<div id="reservation" class="reservation">

      <form  action="./?path=client&action=traitement-reservation-client" method="POST" class="form-reserv">
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

            <div class="form-reserv-titre">
                  <h4>RESERVATION<span> salle</span></h4>

                  <h5>Formulaire de résérvation</h5>
            </div>

            <div class="formulaire-reser">
                  <div class="row justify-content-center minput">

                        <div class="col-10 col-md-10 evenement">
                              <label for="validationCustom01">Nature d'événement</label>
                              <select name="evenement" id="validationCustom02" class="form-control" required>
                                    <option selected disabled>-- Veuillez choisir type d'événement --</option>
                                    <option value="Formation">Formation</option>
                                    <option value="Réunion">Réunion</option>
                                    <option value="Conférence">Conférence</option>
                                    <option value="Séminaire">Séminaire</option>
                              </select>
                        </div>

                        <div class="col-10 col-md-5 nom-salle">
                              <label for="validationCustom02">Nom de salle</label>
                              <select name="idSalle" id="validationCustom02" class="form-control" required>
                                    <option selected disabled>-- Veuillez choisir une salle --</option>

                                    <?php foreach ($salles as $salle) {

                                          echo ("<option value='" . $salle->getIdSalle() . "'>" . $salle->getNomSalle() . "</option>");
                                    }
                                    ?>
                              </select>
                        </div>


                        <div class="col-10 col-md-5 participant">
                              <label for="validationCustom02">Nombre de participant</label>
                              <input type="number" id="validationCustom03" name="nbr_participant" class="form-control" placeholder="Nombre de partcipant (*)" min="2" max="100" required />
                        </div>

                        <div class="col-10 col-md-5 date1">
                              <label for="validationCustom04">* Date début</label>
                              <input type="date" id="validationCustom04" name="dateDebut" class="form-control" min="<?php echo date('Y-m-d'); ?>" required />
                        </div>

                        <div class="col-10 col-md-5 heur1">
                              <label for="validationCustom05">* Heure début</label>
                              <input type="time" id="validationCustom05" name="heureDebut" class="form-control" required />
                        </div>

                        <div class="col-10 col-md-5 date2">
                              <label for="validationCustom06">* Date fin</label>
                              <input type="date" id="validationCustom06" name="dateFin" class="form-control" min="<?php echo date('Y-m-d'); ?>" required />
                        </div>

                        <div class="col-10 col-md-5 heur2">
                              <label for="validationCustom07">* Heure fin</label>
                              <input type="time" id="validationCustom07" name="heureFin" class="form-control" required />
                        </div>

                        <div class="col-10 col-md-10 msg">
                              <label for="validationCustom10"> Info supplémentaire</label>
                              <textarea name="description" id="validationCustom10" rows="10" cols="10" id="validationCustom10" class="form-control" placeholder="Votre message ici..."></textarea>
                        </div>
                  </div>

            </div>
            <div class="row m-4 button">
                  <div class="col-md-4 m-1 reset">
                        <button type="reset" class="btn-reset">Réinitialiser</button>
                  </div>
                  <div class="col-md-4 m-1 submit">
                        <button type="submit" class="btn-submit">Résérver</button>
                  </div>
            </div>
      </form>
</div>



<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>