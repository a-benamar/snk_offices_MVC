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
      <table class="table table-ordered table-responsive-lg table-striped table-hover text-center" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Pseudo</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Date d'inscription</th>

            <th class="text-center" colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>


          <?php if (count($admins) > 0) : ?>

            <?php foreach ($admins as $admin) :
              //  var_dump( $admin);
              // exit;
            ?>

              <tr>
                <td><?= $admin->getIdAdmin(); ?></td>
                <td><?= $admin->getPseudo();  ?></td>
                <td><?= $admin->getNom();     ?></td>
                <td><?= $admin->getPrenom();  ?></td>
                <td><?= $admin->getEmail();  ?></td>
                <td><?= $admin->getDate_inscription(); ?></td>

                <td class="d-flex justify-content-center">
                  <!-- botton modifier -->
                  <a href="./?path=admin&action=edit-admin&edit_id=<?= $admin->getIdAdmin(); ?>" type="submit" name="edit_btn" class="btn btn-outline-secondary mx-2"><i class="far fa-edit"></i></a>

                   <!-- Button supprimer -->

                   <form action="./?path=admin&action=delete-admin" method="POST">
                    <input type="hidden" name="delete_id" id="inputId" required value="<?= $admin->getIdAdmin(); ?>">

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
                          Aucun Admin trouvé ....
                          </div>';

            ?>
          <?php endif; ?>

        </tbody>

      </table>
  </div>

</div>