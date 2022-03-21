<?php
ini_set('display_errors', 'on'); ?>
<?php include("view/admin/includes/header.php");?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 fw-bold text-primary">Modifier Actualites</h6>
        </div>
        <div class="card-body">

            <div class="form-group">
                <!-- formulaire de modification -->

                <form action="./?path=admin&action=traitement-edit-actualites" method="POST" class="row needs-validation" novalidate>

                    <div class="col-md-10 form-group">
                        <input type="hidden" name="edit_id" value="<?= $actualites->getIdActualites(); ?>">
                        <label for="validationCustom01">* Titre</label>
                        <input type="text" id="validationCustom01" name="edit_titre" value="<?= $actualites->getTitre(); ?>" class="form-control" placeholder="Entrez un titre" required>
                    </div>

                    <div class="col-md-10 form-group">
                        <label for="validationCustom02">* Contenu</label>
                        <textarea type="text" id="validationCustom02" name="edit_contenu" cols="30" rows="10"  class="form-control" placeholder="Entrez le contenu" required><?= $actualites->getContenu(); ?></textarea>
                    </div>
                    <div class="col-12">
                        <a href="./?path=admin&action=listActualites" class="btn btn-outline-danger">Cancel</a>
                        <button type="submit" class="btn btn-outline-primary">Modifier</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<?php include "view/admin/includes/footer.php"; ?>