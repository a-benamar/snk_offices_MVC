<?php ini_set('display_errors', 'on'); ?>
<?php include("view/admin/includes/header.php"); ?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 fw-bold text-primary">Modifier la résérvation</h6>
        </div>
        <div class="card-body">
            <div class="form-group">
                <!-- formulaire de modification -->

                <form action="./?path=admin&action=traitement-edit-reservation" method="POST" class="row needs-validation" novalidate>

                    <div class="col-md-6 form-group">
                        <input type="hidden" name="edit_id" value="<?= $reservations->getIdReservation(); ?>">

                        <label for="validationCustom01">Nom Client</label>
                        <select class="form-select" aria-label="Default select example" id="validationCustom01" name="edit_idClient" required>

                            <?php
                            echo ("<option selected value='" . $utilisateur->getIdUtilisateur() . "'>" . $utilisateur->getPrenom() . " " . $utilisateur->getNom() . "</option>");
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="validationCustom02">Nom de salle</label>
                        <select class="form-select" aria-label="Default select example" id="validationCustom02" name="edit_idSalle" id="validationCustom05" required>
                        <?=  ("<option value='" . $salle->getIdSalle() . "'>" . $salle->getNomSalle() . "</option>"); ?>
                        <option disabled>-- Veuillez séléctionner une salle --</option>
                            <?php
                            foreach ($salles as $salle) : ?>

                                <?php
                                echo ("<option value='" . $salle->getIdSalle() . "'>" . $salle->getNomSalle() . "</option>");
                                ?>

                            <?php endforeach;
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="validationCustom03">Nombre de participants</label>
                        <input type="number" class="form-control" name="edit_nbr_participant" value="<?= $reservations->getNbreParticipant(); ?>" id="validationCustom03" min="2" placeholder="Nombre de participants" required>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="validationCustom02">Type d'événement</label>
                        <select class="form-select" aria-label="Default select example" id="validationCustom02" name="edit_evenement" id="validationCustom05" required>
                            <option selected><?=$reservations->getEvenement()?></option>    
                            <option disabled>-- Veuillez choisir la nature d'événement --</option>
                            <option value="Formation">Formation</option>
                            <option value="Réunion">Réunion</option>
                            <option value="Conférence">Conférence</option>
                            <option value="Séminaire">Séminaire</option>
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="validationCustom05">* Date début</label>
                        <input type="date" id="validationCustom05" name="edit_dateDebut" value="<?= date("d/m/Y",  strtotime($reservations->getDateDebut())); ?>" min="<?php echo date('Y-m-d'); ?>" class="form-control" required />
                    </div>


                    <div class="col-md-6 form-group">
                        <label for="validationCustom06">* Heure début</label>
                        <input type="time" id="validationCustom06" name="edit_heureDebut" value="<?= date("H:i",  strtotime($reservations->getDateDebut())); ?>" class="form-control" required />
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="validationCustom07">* Date fin</label>
                        <input type="date" id="validationCustom07" name="edit_dateFin" min="<?php echo date('Y-m-d'); ?>" value="<?= date("d/m/Y",  strtotime($reservations->getDateFin())); ?>" class="form-control" required />
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="validationCustom08">* Heure fin</label>
                        <input type="time" id="validationCustom08" name="edit_heureFin" value="<?= date("H:i",  strtotime($reservations->getDateFin())); ?>" class="form-control" required />
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="validationCustom09">* Description</label>
                        <textarea type="text" id="validationCustom09" name="edit_description" cols="10" rows="7" class="form-control" required><?= $reservations->getDescription(); ?></textarea>
                    </div>

                    <div class="col-12">
                        <a href="./?path=admin&action=listReservation" class="btn btn-outline-danger">Cancel</a>
                        <button type="submit" class="btn btn-outline-primary">Modifier</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
</div>



<?php include("view/admin/includes/footer.php"); ?>