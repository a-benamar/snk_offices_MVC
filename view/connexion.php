<?php ini_set('display_errors', 'on'); ?>

<?php $title = 'Connexion'; ?>

<?php ob_start(); ?>


<div id="seConnecter" class="connecter">
  <!-- <span class="error animated tada" id="msg"></span> -->
  <form action="./?path=main&action=traitement-connexion" method="POST" class="formConnecter">
    <?php if (isset($_SESSION["error"]) && $_SESSION['error'] != '') : ?>

      <div class="alert alert-danger">

        <?= $_SESSION["error"];
        unset($_SESSION['error']);
        ?>

      </div>

      <?php session_unset(); ?>
    <?php endif;?>
    <div class="row justify-content-center">
      <div class="col-12 col-ms-12">
        <h4>CONNEXION<span> compte</span></h4>
        <h5>Connecter à votre compte</h5>
      </div>
      <div class="col-10 col-lg-7 col-md-8">
        <input type="email" name="email" id="validationServer01" aria-describedby="validationServer01Feedback" value="<?php if (isset($_POST['email'])){echo $_POST['email'];} ?>" placeholder="Adresse e-mail" required class="form-control">
      </div>

      <div class="col-10 col-lg-7 col-md-8">
        <input type="password" name="mdp" aria-describedby="validationServer04Feedback" placeholder="Mot de passe" id="validationServer02" minlength="6" required class="form-control">
      </div>
      <!-- <div>
                  <label>
                    <input type="checkbox">
                    <span></span>
                    <small class="rmb">Remember me</small>
                  </label>
                 </div> -->
      <div class="col-7 text-end forgetpass">
        <a href="#">Mot de passe oublie?</a>
      </div>
      <div class="col-7 mt-4">
        <input type="submit" value="Se connecter" class="btn-seConnecter">
      </div>
      <div class="col-10 m-4 dnthave">
        Vous n'avez pas de compte? <a href="./?path=main&action=inscription"> <span>S'inscrire</span></a>
      </div>
    </div>
  </form>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>