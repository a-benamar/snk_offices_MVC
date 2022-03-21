<?php ini_set('display_errors', 'on'); ?>
<?php include("view/admin/includes/header.php");?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <h6 class="m-0 fw-bold text-primary">ID Salle : <strong><?= $salles->getIdSalle();   ?></strong></h6>
            <h6 class="m-0 fw-bold text-primary">Nom Salle: <strong><?= $salles->getNomSalle(); ?></strong></h6>
            <h6 class="m-0 fw-bold text-primary">Salle De: <strong><?= $salles->getTypeSalle(); ?></strong></h6>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="col-md-12">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-row align-items-center back">
                            <a href="./?path=admin&action=listSalle" class="btn btn-outline-secondary "><i class="fas fa-angle-left mr-1 mb-1"></i>Retour</a>
                        </div>
                        <div class="d-flex flex-row align-items-center back">
                            <a class="btn btn-outline-secondary" href="./?path=admin&action=edit-salle&edit_id=<?= $salles->getIdSalle(); ?>" type="submit" name="edit_btn"><i class="fas fa-pencil-alt mr-1 mb-1"></i>Modifier</a>
                        </div>
                    </div>
                    <hr>

                    <div class="row mt-2">
                        <div class="col-md-3 form-group">
                            <span class="reservations fw-bold">Capacité Max <br></span> <?= $salles->getCapSalle() . " personnes"; ?>
                            <hr>
                        </div>
                        <div class="col-md-3 form-group">
                            <span class="reservations fw-bold">Ville De Salle <br> </span> <?= $salles->getVilleSalle(); ?>
                            <hr>
                        </div>

 
                        <div class="col-md-3 form-group">
                            <span class="reservations fw-bold">Prix De Salle <br> </span> <?= $salles->getPrixSalle() . ".00 € / Jour"; ?>
                            <hr>
                        </div>
                        <div class="col-md-3 form-group">
                            <span class="reservations fw-bold"> Status de Salle <br> </span> <?= $salles->getStatusSalle(); ?>
                            <hr>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12 form-group">
                                <span class="reservations fw-bold">Description De La Salle <br></span> <?= $salles->getDescriptionSalle(); ?>
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