<?php ini_set('display_errors', 'on'); ?>
<?php include("view/admin/includes/header.php");?>

<div id="login-page">
  <div class="login">

     <!-- affichage de message success et erreur -->

     <?php
         if (isset($_SESSION['error']) && $_SESSION['error'] !=''){ ?>
           <div class="alert alert-danger" role="alert">

          <?php
            echo '<h5> '.$_SESSION['error'].' </h5>';
            unset($_SESSION['error']);
             }
           ?>


    <h2 class="login-title">CONNEXION</h2>
    <p class="notice">Merci d'identifier pour accéder au système</p>

    <form class="form-login" action="index.php?page=admin" method="POST">
      <label for="email">E-mail</label>
      <div class="input-email">
        <i class="fas fa-envelope icon"></i>
        <input type="email" name="email" class="form-control-user" placeholder="Entez votre Email">
      </div>
      <label for="password">Mot de passe</label>
      <div class="input-password">
        <i class="fas fa-lock icon"></i>
        <input type="password" name="mdp" class="form-control-user" placeholder="entrez votre Mot de passe">
      </div>
      <button type="submit" name="login_btn"><i class="fas fa-door-open"></i> Se connecter</button>
      <img src="../public/icon/logo.png" alt="">
    </form>


  </div>
  <div class="background">
    <h1>ESPACE ADMIN</h1>
  </div>

</div>

<?php include "view/admin/includes/footer.php"; ?>







<style>
  * {
    box-sizing: border-box;
  }
  body {
    margin: 0;
    font-family: sans-serif;
  }
  
  img{
  position:relative;
  bottom:0px;
  left:35px;
  width:230px;
  height:210px;
  /* align-items: flex-end;
  justify-content: center;
  align-content: flex-end; */
  
  
  }
  a {
    color: #666;
    font-size: 14px;
    display: block;
  }
  .login-title {
    text-align: center;
  }
  #login-page {
    display: flex;
  }
  .notice {
    font-size: 13px;
    text-align: center;
    color: #666;
  }
  .login {
    width: 35%;
    height: 100vh;
    background: #FFF;
    padding: 70px;
  }
  .login a {
    margin-top: 25px;
    text-align: center;
  }
  .form-login {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    align-content: center;
  }
  .form-login label {
    text-align: left;
    font-size: 13px;
    margin-top: 10px;
    margin-left: 20px;
    display: block;
    color: #666;
  }
  .input-email,
  .input-password {
    width: 100%;
    background: #DDD;
    border-radius: 25px;
    margin: 4px 0 10px 0;
    padding: 10px;
    display: flex;
  }
  .icon {
    padding: 4px;
    color: #666;
    min-width: 30px;
    text-align: center;
  }
  
  input[type="email"],
  input[type="password"] {
    width: 100%;
    border: 0;
    background: none;
    font-size: 16px;
    padding: 4px 0;
    outline: none;
  }
  button[type="submit"] {
    width: 100%;
    border: 0;
    border-radius: 25px;
    padding: 14px;
    background: #008552;
    color: #FFF;
    display: inline-block;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    margin-top: 10px;
    transition: ease all 0.3s;
  }
  button[type="submit"]:hover {
    opacity: 0.9;
  }
  .background {
    width: 65%;
    padding: 90px;
    height: 100vh;
    background: linear-gradient(60deg, rgba(158, 189, 19, 0.5), rgba(0, 133, 82, 0.7)), url('https://cdn.pixabay.com/photo/2016/12/01/09/12/discussion-1874792_960_720.jpg') center no-repeat;
    background-size: cover;
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    justify-content: flex-start;
    align-content: start;
    flex-direction: row;
  
  }
  .background h1 {
    max-width: 420px;
    color: #809436;
    text-align: left;
    padding: 0;
    margin: 0;
  }
  
</style>