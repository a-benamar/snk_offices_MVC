<?php $title = 'Mes réservations'; ?>

<?php ob_start(); ?>

<div class="card-body">
  <div class="table-responsive">

    <!-- affichage de message success et erreur -->

    <?php if (isset($_SESSION['success']) && $_SESSION['success'] != '') { ?>

      <div class="alert alert-success alert-dismissible fade show" role="alert">

        <?php
        echo $_SESSION['success'];
        unset($_SESSION['success']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

    <?php

    } elseif (isset($_SESSION['error']) && $_SESSION['error']) {  ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">

        <?php
        echo  $_SESSION['error'];
        unset($_SESSION['error']);
        ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      <?php  } ?>

      </div>



      <!-- table  admin -->
      <table class="table table-ordered table-striped table-hover text-center" id="dataTable" width="100%" cellspacing="0">

        <thead>
          <tr class="align-middle">
            <th scope="col">ID Résérvation</th>
            <th scope="col">Nom de Salle</th>
            <th scope="col">Date Debut</th>
            <th scope="col">Date Fin</th>
            <th scope="col">Nombre Participant</th>
            <th scope="col">Date Résérvation</th>
            <th class="text-center" colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>

          <?php if (count($reservations) > 0) : ?>
            <?php foreach ($reservations as $reservation) : ?>

              <?php
              $idSalle = $reservation->getIdSalle();
              $uneSalle = $salleManager->getSalleById($idSalle);
              $date_debut = strtotime($reservation->getDateDebut());
              $date_fin = strtotime($reservation->getDateFin());
              $date_reser = strtotime($reservation->getDateReservation());
              ?>
              <tr>
                <td class="align-middle"><?= "RES00" . $reservation->getIdReservation() . "/" . date('Y');  ?></td>
                <td class="align-middle"><?= $uneSalle->getNomSalle(); ?></td>
                <td><?= date("d m Y", $date_debut) . '<br>' . date("H:i", $date_debut); ?></td>
                <td><?= date("d m Y", $date_fin) . '<br>' . date("H:i", $date_fin);  ?></td>
                <td><?= $reservation->getNbreParticipant() . '<br>' . "Personnes"; ?></td>
                <td><?= date("d m Y", $date_reser) . '<br>' . date("H:i", $date_reser);; ?></td>
                <td class="d-flex justify-content-center align-middle">
                  <!-- botton modifier -->
                  <a href="./?path=client&action=edit-reservation-client&edit_id=<?= $reservation->getIdReservation(); ?>" type="submit" name="edit_btn" class="btn btn-outline-success mx-2"><i class="far fa-edit"></i></a>
                  <!-- Button supprimer -->
                  <form action="./?path=client&action=delete-reservation-client" method="POST">
                    <input type="hidden" name="delete_id" id="inputId" required value="<?= $reservation->getIdReservation(); ?>">

                    <button type="submit" name="delete_btn" class="btn btn-outline-danger">
                      <i class="far fa-trash-alt"></i>
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>

          <?php else : ?>

            <div class="alert alert-danger alert-dismissible fade show" role="alert">

              <?php
              echo  "Aucune reservation trouvée ...";
              ?>

            <?php endif; ?>
            <a href="./?path=client&action=form-reservation" class=" btn btn-success mb-2">Réserver une salle</a>

        </tbody>

      </table>
  </div>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>