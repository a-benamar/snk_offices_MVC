<?php ini_set('display_errors', 'on'); ?>
<?php include("view/admin/includes/header.php");?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 fw-bold text-primary">Modifier la Salle</h6>
        </div>
        <div class="card-body">

            <div class="form-group">
                <!-- formulaire de modification -->

                <form action="./?path=admin&action=traitement-edit-salle" method="POST" class="row needs-validation" novalidate>
                    <input type="hidden" name="edit_id" value="<?= $salles->getIdSalle(); ?>">

                    <div class="col-md-6 form-group">
                        <label for="validationCustom01" l>Nom de salle</label>
                        <Select type="text" name="edit_nomSalle" id="validationCustom01" class="form-control" required>
                            <option selected><?= $salles->getNomSalle(); ?></option>

                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="validationCustom02">Type de salle</label>
                        <Select name="edit_typeSalle" id="validationCustom03" class="form-select" aria-label="Default select example" required>
                        <option selected value="<?= $salles->getTypeSalle() ?>"><?= $salles->getTypeSalle() ?></option>
                            <option disabled>-- Choisissez le type de la salle --</option>
                            <option value="formation">Formation</option>
                            <option value="séminaire">Séminaire</option>
                            <option value="réunion">Réunion</option>
                            <option value="conférence">Conférence</option>

                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="validationCustom02">Status de la salle</label>
                        <Select name="edit_statusSalle" id="validationCustom03" class="form-select" aria-label="Default select example" required>
                            <option disabled>-- Choisissez le status de la salle --</option>
                            <option selected value="disponible">Disponible</option>
                            <option value="indisponible">Indisponible</option>

                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="validationCustom03">Capacité de salle</label>
                        <input type="number" name="edit_capSalle" id="validationCustom03" min="2" value="<?= $salles->getCapSalle(); ?>" class="form-control" min="1" required placeholder="Entrez la capacité Max">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="validationCustom04">Ville de salle</label>

                        <Select type="text" name="edit_villeSalle" id="validationCustom04" class="form-control" required>
                            <option selected><?= $salles->getVilleSalle(); ?></option>

                        </select>

                    </div>

                    <div class="col-md-6 form-group">
                        <label for="validationCustom05">Prix de salle</label>
                        <input type="text" name="edit_prixSalle" id="validationCustom05" value="<?= $salles->getPrixSalle(); ?>" class="form-control" required placeholder="Entrez le prix de salle">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="validationCustom06"> Description du salle</label>
                        <textarea name="edit_descriptionSalle" id="validationCustom06" rows="7" cols="10" id="validationCustom6" class="form-control" placeholder="Description du salle..."><?= $salles->getDescriptionSalle(); ?></textarea>
                    </div>

                    <div class="col-12">
                        <a href="./?path=admin&action=listSalle" class="btn btn-outline-danger">Cancel</a>
                        <button type="submit" class="btn btn-outline-primary">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include("view/admin/includes/footer.php"); ?>