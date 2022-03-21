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

      <!-- table  Reservation  -->
      <table class="table table-ordered table-responsive-lg table-striped table-hover text-center" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th scope="col">Référence</th>
            <th scope="col">Client</th>
            <th scope="col">Salle</th>
            <th scope="col">Date Debut</th>
            <th scope="col">Date Fin</th>
            <th scope="col">Date Résérvation</th>
            <th class="text-center" colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>

          <?php if (count($reservations) > 0) : ?>
            <?php foreach ($reservations as $reservation) :  ?>

              <?php $idSalle = $reservation->getIdSalle(); ?>
              <?php $uneSalle = $salleManager->getSalleById($idSalle); ?>

              <?php $idClient = $reservation->getIdUtilisateur();?>
              <?php $unClient = $utilisateurManager->getUtilisateurById($idClient); ?>


              <tr>
                <td class="align-middle"><?= "RES00" . $reservation->getIdReservation() . "/" . date('Y');   ?></td>

                <td class="align-middle"><?= $unClient->getPrenom() . " " .$unClient->getNom(); ?></td>

                <td class="align-middle"><?= $uneSalle->getNomSalle();   ?></td>

                <td class="align-middle"><?= date("d m Y H:i",  strtotime($reservation->getDateDebut())); ?></td>

                <td class="align-middle"><?= date("d m Y H:i",  strtotime($reservation->getDateFin())); ?></td>

                <td class="align-middle"><?= date("d m Y H:i", strtotime($reservation->getDateReservation())); ?></td>

                <td class="d-flex justify-content-center align-middle">

                  <!-- button view reservation -->

                  <a href="./?path=admin&action=view-reservation&id=<?= $reservation->getIdReservation(); ?>" type="submit" class="btn btn-outline-secondary"><i class="far fa-eye"></i></a>

                  <!-- botton modifier -->
                  <a href="./?path=admin&action=edit-reservation&edit_id=<?= $reservation->getIdReservation(); ?>" type="submit" name="edit_btn" class="btn btn-outline-secondary mx-1"><i class="far fa-edit"></i></a>

                  <!-- Button supprimer -->

                  <form action="./?path=admin&action=delete-reservation" method="POST">
                    <input type="hidden" name="delete_id" id="inputId" required value="<?= $reservation->getIdReservation(); ?>">

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
                        Aucune reservation trouvée ....
                        </div>';

            ?>
          <?php endif; ?>

        </tbody>

      </table>
  </div>

</div>