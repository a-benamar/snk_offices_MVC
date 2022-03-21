<?php $title = 'Découvrir Salles'; ?>
<?php ob_start(); ?>


<div id="decSalles" class="decouvrir-salles">
        <!-- debut container -->
    <section class="top-section">
       <div class="container">
         <div class="row d-flex blog">
          <!-- header of section -->
            <div class="col-md-12 col-sm-12 text-start blog-head ">
                <h2 class="fs-2 fw-bold">DÉCOUVRIR LES SALLES</h2>
                <span></span>
                <h4>Vous cherchez une salle pour organiser votre événement professionnel ?</h4>
            </div>
            <div class="col-md-3 col-ms-3 titre-gras">
                <h3>Réunion
                    Formation
                    Séminaire
                    Conférence
                    Exposition
                    Tournage...</h3>
                <span></span>    
            </div>
            <div class="col-md-4 col-ms-4 present1">
                <p>A l’ <strong>Espace SNK Offices</strong>,  vous ne louez pas simplement une salle… Vous bénéficiez de l'expertise d’une équipe de professionnels qui vous écoute,<strong> vous guide, vous épaule et reste attentive au moindre petit détail</strong>tout au long de l’organisation de votre projet.<strong> Votre partenaire incontournable</strong> pour couronner de succès tous vos événements professionnels !</p>
            </div>

            <div class="col-md-4 col-ms-4 present2">
                <p>Nous vous accueillons tout au long de l’année dans nos <strong>neuf salles d’une superficie de 20 à 400 m2.</strong> Que vous ayez besoin d'un <strong>bureau pour recevoir votre client</strong>, d’un <strong>espace pour présenter un nouveau produit</strong>,  d’une <strong>salle informatisée</strong> pour former votre équipe ou d’<strong>une salle pour une assemblée générale</strong>, nous avons la salle de réunion qui vous convient !</p>
            </div>
        </div>
      </div> 
    </section>

    <section class="img-section mb-5">
        <div class="container">
          <!-- blog items -->
          <div class="row"> 
          <?php foreach($images as $image) : ?>

              <?php $idSalle = $image->getIdSalle(); ?>
              <?php $uneSalle = $salleManagerById->getSalleById($idSalle); ?>
   
            <div class="col-xs-12 col-md-6 col-lg-4 col-xl-4">
              <div class="item">
              <a href="./?path=main&action=salleAlpha">
                <img src="public/uploads/salles/<?= $image->getImage(); ?>" alt="Salle <?= $uneSalle->getNomSalle(); ?>">
                <div class="overlay">
                  <div class="text-title textee">
                      <h4>SALLE <?= $uneSalle->getNomSalle(); ?></h4>
                      <a class="btn btn-outline-warning d-flex" href="./?path=main&action=description-salle&salle=<?= $idSalle;?>">Découvrir la salle</a>
                    </div>
                </div>
              </a>
              </div>
            </div>
            <?php endforeach;?>
          </div>
        </div>
    </section>
    
    <!-- fin contenaire -->


    <?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>