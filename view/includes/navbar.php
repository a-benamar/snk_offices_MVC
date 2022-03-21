<nav class="nav-bar">
    <div class="content-nav-bar">
      <div class="logo">
        <a href="./?path=main&action=accueil"><span>S</span>NK <span>O</span>ffices</a>
      </div>
      <ul class="menu-list m-0">
        <div class="icon cancel-btn">
          <i class="fas fa-times"></i>
        </div>
        <li>
            <a href="./?path=main&action=accueil">accueil</a>
        </li>
        <li>
            <a href="./?path=main&action=decSalles">Découvrir salles</a>
        </li>
        <li>
            <a href="./?path=main&action=domiciliation">domiciliation</a>
        </li>

        <?php if(isset($_SESSION["role"])):
             if($_SESSION["role"]=="user"):?>
        <li>
            <a href="./?path=client&action=viewReservation">mes résérvation</a>
        </li>
        <?php endif; endif;?>

        <li>
            <a href="./?path=main&action=contact">contact</a>
        </li>

        <?php if(isset($_SESSION["role"])):
             if($_SESSION["role"]=="user"):?>
        <li>
            <a class="border border-2 border-warning rounded-pill px-3"href="./?path=client&action=profil-client">Profil</a>
        </li>
        <?php endif; endif;?>
        
      

        <?php if(isset($_SESSION["role"])):
             if($_SESSION["role"]=="admin"):?>
        <li>
            <a class="border border-2 border-warning rounded-pill px-4" href="./?path=admin&action=accueilAdmin">ADMIN</a>
        </li>
        
        <?php endif;endif;?>


        <?php if(!isset($_SESSION["email"])) :?>
        <li>
            <a class="border border-2 border-warning rounded-pill px-3"href="./?path=main&action=connexion">CONNEXION</a>
        </li>

        <?php else: ?>

        <li>
            <a class="border border-2 border-warning rounded-pill px-3" href="./?path=main&action=deconnexion">DECONNEXION</a>
        </li>
        <?php endif;?>

      </ul>

      <div class="icon menu-btn">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </nav>

