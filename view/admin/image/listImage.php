<div class="card-body">
  <div class="table-responsive">

    <!-- affichage de message success et erreur -->

    <?php if (isset($_SESSION['success']) && $_SESSION['success'] != '') { ?>

      <div class="alert alert-success alert-dismissible fade show" role="alert">

        <?php
        echo '<h5> ' . $_SESSION['success'] . ' </h5>';
        unset($_SESSION['success']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

    <?php

    } elseif (isset($_SESSION['error']) && $_SESSION['error']) {  ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">

        <?php
        echo '<h5> ' . $_SESSION['error'] . ' </h5>';
        unset($_SESSION['error']);
        ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      <?php  } ?>
      </div>
      <!-- table  admin -->
      <table class="table table-striped table-responsive-lg table-hover text-center" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th scope="col">Référence</th>
            <th scope="col">Image</th>
            <th scope="col">Nom de salle</th>
            <th scope="col">Est principale</th>
            <th class="text-center" colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>

          <?php if (count($images) > 0) :?>

            <?php foreach ($images as $image) :  ?>
              <?php $idSalle = $image->getIdSalle(); ?>
              <?php $uneSalle = $salleManager->getSalleById($idSalle); ?>

          
              <tr>
                <td class="align-middle"><?= $image->getIdImage(); ?></td>

                <td class="align-middle"><?= '<img src="public/uploads/salles/'.$image->getImage().'"  width="120px"; height="70px" alt="">'?></td>


                <td class="align-middle"><?= $uneSalle->getNomSalle(); ?></td>

                <td class="align-middle">
                
                <?php if($image->getEstPrincipale()) : ?>
                  Oui
              
              <?php else: ?>
                  Non
                  <?php endif;?>
              </td>

                <td class="align-middle">
                  <!-- botton modifier -->
                  <!-- <a href="./?path=admin&action=edit-image&edit_id=" type="submit" name="edit_btn" class="btn btn-outline-secondary mx-2"><i class="far fa-edit"></i></a> -->

                  <!-- Button supprimer -->

                  <form action="./?path=admin&action=delete-image" method="POST">
                    <input type="hidden" name="delete_id" id="inputId" required value="<?= $image->getIdImage(); ?>">

                    <button type="submit" name="delete_btn" class="btn btn-outline-secondary">
                      <i class="far fa-trash-alt"></i>
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>

          <?php else : ?>

            <?php
            echo ' <div class="alert alert-danger" role="alert">
                  Aucune image trouvée ....
                       </div>';

            ?>
          <?php
          endif;
          ?>

        </tbody>

      </table>
  </div>

</div>