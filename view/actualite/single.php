<?php $title = 'Domiciliation'; ?>
<?php ob_start(); ?>


<div class="container mt-4 -1">

	<div class="row">

		<div class="col">

			<h1 class="text-center mb-4 p-1"><?= $actualites->getTitre(); ?></h1>
			<img src="<?= $actualites->getImage();?>" class="card-img-top" alt="...">

			<div class="mb-1 text-muted p-1">
							 Publié le <?= date("d/m/Y à H:i", strtotime($actualites->getDatePub())); ?>
						</div>

			<hr>
			<p class="card-text mb-auto text-justify p-1"><?= $actualites->getContenu(); ?></p>
			<hr>


		</div>

	</div>

</div>



<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>



