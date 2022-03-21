<?php ini_set('display_errors', 'on'); ?>
<?php $title = 'Modifier la résérvation'; ?>

<?php ob_start(); ?>

<div class="container">
    <div class="main-body mt-3">
        <div class=" text-center text-warning my-3 lead">
            <h4 style="color:#fb911f">Modifier Ma Résérvation</h4>
        </div>

        <div class="container rounded bg-white my-5">
            <div class="row body-profil">


                <div class="row col-md-12  px-5 py-3">
                    <form action="./?path=client&action=traitement-edit-reservation-client" method="POST" novalidate>

                        <div class="row mt-1">
                            <div class="col-md-6 form-group">
                                <input type="hidden" name="edit_id" value="<?= $reservations->getIdReservation(); ?>">

                                <label for="validationCustom01">* Nom Client</label>
                                <select class="form-select" aria-label="Default select example" id="validationCustom01" name="edit_idClient" required>

                                    <?php
                                    echo ("<option selected value='" . $utilisateur->getIdUtilisateur() . "'>" . $utilisateur->getPrenom() . " " . $utilisateur->getNom() . "</option>");
                                    ?>
                                </select>

                            </div>
                            <div class="col-md-6 form-group">
                                <label for="validationCustom02">* Nom de salle</label>
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
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-6 form-group">
                                <label for="validationCustom03">* Nombre de participants</label>
                                <input type="number" class="form-control" name="edit_nbr_participant" value="<?= $reservations->getNbreParticipant(); ?>" id="validationCustom03" min="2" placeholder="Nombre de participants" required>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="validationCustom02">* Type d'événement</label>
                                <select class="form-select" aria-label="Default select example" id="validationCustom02" name="edit_evenement" id="validationCustom05" required>
                                    <option selected value="<?= $reservations->getEvenement() ?>"><?= $reservations->getEvenement() ?></option>
                                    <option disabled>-- Veuillez choisir la nature d'événement --</option>
                                    <option value="Formation">Formation</option>
                                    <option value="Réunion">Réunion</option>
                                    <option value="Conférence">Conférence</option>
                                    <option value="Séminaire">Séminaire</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-6 form-group">
                                <label for="validationCustom05">* Date début</label>
                                <input type="date" id="validationCustom05" name="edit_dateDebut" value="<?= date("d/m/Y",  strtotime($reservations->getDateDebut())); ?>" class="form-control" required />
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="validationCustom06">* Heure début</label>
                                <input type="time" id="validationCustom06" name="edit_heureDebut" value="<?= date("H:i",  strtotime($reservations->getDateDebut())); ?>" class="form-control" required />
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-6 form-group">
                                <label for="validationCustom07">* Date fin</label>
                                <input type="date" id="validationCustom07" name="edit_dateFin" value="<?= date("d/m/Y",  strtotime($reservations->getDateFin())); ?>" class="form-control" required />
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="validationCustom08">* Heure fin</label>
                                <input type="time" id="validationCustom08" name="edit_heureFin" value="<?= date("H:i",  strtotime($reservations->getDateFin())); ?>" class="form-control" required />
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-12 form-group">
                                <label for="validationCustom09">Description</label>
                                <textarea type="text" id="validationCustom09" name="edit_description" cols="10" rows="7" class="form-control mt-0" required><?= $reservations->getDescription(); ?></textarea>
                            </div>
                            <div class="col-12">
                                <a href="./?path=client&action=viewReservation" class="btn btn-outline-danger">Cancel</a>
                                <button type="submit" class="btn btn-outline-primary">Valider</button>
                            </div>
                        </div>

                    </form>
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