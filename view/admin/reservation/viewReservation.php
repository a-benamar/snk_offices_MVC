<?php ini_set('display_errors', 'on'); ?>
<?php include("view/admin/includes/header.php");?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <h6 class="m-0 fw-bold text-primary">ID Résérvation : <strong><?= "RES00" . $reservations->getIdReservation() . "/" . date('Y');   ?></strong></h6>
            <h6 class="m-0 fw-bold text-primary">Client : <strong><?= $utilisateur->getPrenom() . " " . $utilisateur->getNom() ?></strong></h6>
            <h6 class="m-0 fw-bold text-primary">Date Résérvation : <strong><?= date("d m Y", strtotime($reservations->getDateReservation())) ?></strong></h6>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="col-md-12">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-row align-items-center back">
                            <a href="./?path=admin&action=listReservation" class="btn btn-outline-secondary "><i class="fas fa-angle-left mr-1 mb-1"></i>Retour</a>
                        </div>
                        <div class="d-flex flex-row align-items-center back">
                            <a class="btn btn-outline-secondary" href="./?path=admin&action=edit-reservation&edit_id=<?= $reservations->getIdReservation(); ?>" type="submit" name="edit_btn"><i class="fas fa-pencil-alt mr-1 mb-1"></i>Modifier</a>
                        </div>
                    </div>
                    <hr>

                    <div class="row mt-2">
                        <div class="col-md-3 form-group">
                            <span class="reservations fw-bold">Nom De Salle / Evénement <br></span> <?= $salle->getNomSalle() . " / " . $reservations->getEvenement()  ?>
                            <hr>
                        </div>
                        <div class="col-md-3 form-group">
                        <span class="reservations fw-bold"> Nombre Participant <br></span> <?= $reservations->getNbreParticipant() . " personnes" ?>
                            <hr>
                        </div>

           
                        <div class="col-md-3 form-group">
                            <span class="reservations fw-bold">Date Début <br></span> <?= date("d/m/Y à H:i",  strtotime($reservations->getDateDebut())); ?>
                            <hr>
                        </div>
                        <div class="col-md-3 form-group">
                            <span class="reservations fw-bold"> Date Fin <br></span> <?= date("d/m/Y à H:i",  strtotime($reservations->getDateFin())); ?>
                            <hr>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12 form-group">
                                <span class="reservations fw-bold">Informations Suplémentaire <br></span> <?= $reservations->getDescription(); ?>
                                <hr>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>


    </div>
</div>



<?php include("view/admin/includes/footer.php");?>