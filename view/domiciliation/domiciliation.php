<?php $title = 'Domiciliation'; ?>

<?php ob_start(); ?>


<!-- debut de container -->
<!-- titre -->
<div id="domiciliation" class="domicil_entrep">
      <div class="col-sm-8 col-lg-12 titre">
          <h6 class="pt-5 mb-2">développez votre présence rapidement là où ça compte</h6>
          <h2 class="p-2">DOMICILIATION <span>d'entreprise</span></h2>

      <div class="pt-3 sous-titre">
      <p>Vous êtes un créateur d’entreprise ou une société à la recherche d’une 
      adresse pour localiser son siège social ou son établissement secondaire ?</p>
      <p>Nous vous offrons une adresse professionnelle valorisante. C’est un signal fort envoyé à vos interlocuteurs. Les sites Newton Offices sont situés au cœur de l’énergie des affaires et de l’effervescence urbaine.</p>
      <p>Profitez-en !</p>
      </div>
      </div>

  <section>

  <!-- card> -->

    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-lg-6 p-4">
          <!-- Card FLIP 1 -->
          <div class="card-flip">
            <div class="flip">
              <div class="front">
                <!-- front content -->
                <div class="card pb-4">
                  <img class="card-img-top p-3" src="public/images/domiciliation/dom2.jpg" alt="">
                  <div class="card-block">
                    <h3 class="card-title">Domiciliation simple</h3>
                    <h4 class="p-4">39€<span>HT par mois</span></h4>
                    <p class="card-text p-2">Réception de votre courrier et notification une fois par semaine. Notre équipe vous accueille tous les jours de 9h à 18h pour vous permettre de le récupérer quand bon vous semble.</p>
                    <a href="./contact.php" class="btn btn-outline btn-savoir">En savoir plus</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Card FLIP 1 -->
        </div>
        <div class="col-sm-6 col-lg-6 p-4">
          <!-- Card FLIP 2 -->
          <div class="card-flip">
            <div class="flip">
              <div class="front">
                <!-- front content -->
                <div class="card pb-4">
                  <img class="card-img-top p-3" src="public/images/domiciliation/dom1.jpg" alt="">
                  <div class="card-block">
                    <h3 class="card-title">Domiciliation avec renvoi de courrier</h3>
                    <h4 class="p-4">59€<span>HT par mois</span></h4>
                    <p class="p-2 card-text">Nous réceptionnons votre courrier et effectuons un renvoi hebdomadaire par scan (inclus) ou courrier postal (coûts d'affranchissement en supplément).</p>
                    <a href="./contact.php" class="btn btn-outline">En savoir plus</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Card FLIP 2 -->
        </div>
      </div>
    </div>
  </section>

  <!-- overlay image -->
    <div class="grand-img-domic">
      <div class="overlay-img-domic">
        <h6>DOMICILIATION</h6>
        <h2>Une adresse professionnelle <br>
          valorisante, c’est un signal fort <br>
            envoyé à vos interlocuteurs.</h2>
      </div>
    </div>


<!-- fin countainer -->


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>