<?php $title = 'Contact'; ?>

<?php ob_start(); ?>

    <div class="contact-maps">

    </div><div id="contact" class="page-contact">
    <?php if (isset($_SESSION['error'])) : ?>
                  <div class="alert alert-danger">

                        <?= $_SESSION["error"];
                        unset($_SESSION['error']);
                        ?>

                  </div>
            <?php endif; ?>

            <?php if (isset($_SESSION["success"])) : ?>

                  <div class="alert alert-success">

                        <?= $_SESSION["success"];
                        unset($_SESSION['success']);
                        ?>

                  </div>

                  <?php
                  // Pour supprimer la persistance des données et réinitialiser le formulaire en cas de succès
                  session_unset();
                  ?>
            <?php endif; ?>

    <div class="container">
       <form action="./?path=main&action=traitement-contact" method="POST" class="form-contact">
                <div class="contact-titre">
                  <h4>CONTACTEZ<span> nous</span></h4>
                  <h5>Formulaire de contact</h5>
                </div>

                              <div class="row minput-contact">

                      <div class="col-10 col-md-5 col-ms-12 nom">
                            <label for="nom">* Nom</label>
                            <input pattern="[a-z]{2,50}" type="text" id="nom" name="nom" placeholder="Entrez votre nom" minlength="2" maxlength="255" required/>
                      </div>    

                      <div class="col-10 col-md-5 col-ms-12 email">
                          <label for="email">* Email</label>
                          <input type="mail" id="email" name="email"  placeholder="Votre email" maxlength="255" required />
                      </div> 
                      <div class="col-10 col-md-10 col-ms-12 sujet">
                        <label for="sujet">* Sujet</label>
                        <input pattern="[a-z]{2,50}" type="text" id="sujet" name="sujet" placeholder="Sujet" minlength="2" maxlength="255" required/>
                      </div>           

                      <div class="col-10 col-md-10 col-ms-12 msg">
                        <label for="msg">Message</label>
                        <textarea type="text" min="10" rows="10"cols="80" id="msg" name="message" placeholder="Ecrivez votre message..." required></textarea>
                      </div>  
                      <div class="col-10 col-md-10 col-sm-10 button"> 
                        <input type="submit" value="Envoyer" class="btn-conta-submit">    
                      </div> 
                </div>


      </form>
                 <!-- <div class="col-4 col-md-4 cord-contact">
                      <h3>CONTACT</h3>

                      <h4>
                          Paris Offices
                          <br>
                          15 Rue Marcel Pangol
                          <br>
                          75015 Paris
                      </h4>

                      <p>
                        Tel : 01 02 03 04 05
                        <br>
                        Fax :09 08 07 06 05
                      </p>
                      <p>
                        <a href="www.parisoffices.fr">www.snkoffices.fr</a>
                      </p>
                </div> -->
            
      </div>

      
    </div>
    <iframe class="mb-4" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2619.358737203904!2d2.341986815053673!3d48.965695201100246!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e669106ab631c5%3A0xf9d531a7e51cea6b!2s85%20Rue%20Maurice%20Grandcoing%2C%2093430%20Villetaneuse!5e0!3m2!1sfr!2sfr!4v1629019600964!5m2!1sfr!2sfr" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>
   

 <?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>