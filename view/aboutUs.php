<?php $title = "A propos de nous"; ?>

<?php ob_start(); ?>




<div class="container">
    <div class="row">
        <div class="col-md-12 mr-auto ml-auto py-5 mt-3">
            <h2 class="text-start fs-3 fw-bolder"><?= $aboutUs->getTitre(); ?></h2><br>
            <p claas="text-justify"><?= $aboutUs->getContenu() ?></p>
        </div>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>




Espace SNK Offices :<br>
Un espace privilégié au cœur de Paris<br>
pour tous vos événements professionnels !








