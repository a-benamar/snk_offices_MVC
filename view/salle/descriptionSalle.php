<?php $title = 'Description salle'; ?>

<?php ob_start(); ?>

<div id="description-salle" class="descript-de-salles">
    <!-- debut container -->
    <div class="container">
        <section class="diapo-images py-4">
            <div class="row row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-2 gy-1 gx-2">

                <?php $imageSalle = $imageManager->getImageByIdSalle($idSalle); ?>
                <?php $uneSalle = $salleManager->getSalleById($idSalle); ?>
                <?php foreach ($imageSalle as $uneImageSalle) : ?>

                    <div class="col">
                        <a href="public/uploads/salles/<?= $uneImageSalle->getImage(); ?>" data-caption="Salle <?= $uneSalle->getnomSalle(); ?>" class="fancybox" data-fancybox="diapo2">
                            <img src="public/uploads/salles/<?= $uneImageSalle->getImage(); ?>" class="p-1 img-salle" alt="Salle <?= $uneSalle->getnomSalle(); ?>"></a>
                        <!-- <span>
                            <i class="fas fa-search-plus"></i>
                        </span> -->
                    </div>
                <?php endforeach; ?>

            </div>
        </section>

        <section class="descrip-salles">
            <div class="row">
                <?php $uneSalle = $salleManager->getSalleById($idSalle); ?>
                <div class="col-md-12 title">
                    <h3>Description de la salle <?= $uneSalle->getnomSalle(); ?></h3>
                    <h4>Espace SNK Offices : location de salles de réunion, formation, séminaire...</h4>
                </div>
                <div class="col-md-8 text-justify parag">
                    <?= $uneSalle->getDescriptionSalle(); ?>
                </div>
                <div class="col-md-4 col-sm-12 img-droit">
                    <div class="text-center mt-4">
                        <a class="btn btn-primary btn-lg " href="./?path=client&action=form-reservation">Réserver Maintenant</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- fin contenaire -->
    </div>


    <?php $content = ob_get_clean(); ?>

    <?php require('view/template.php'); ?>