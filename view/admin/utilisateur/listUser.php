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

      <!-- table  user -->

      <table class="table table-ordered table-responsive-lg table-striped table-hover text-center" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Pseudo</th>
            <th>Nom & Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Date inscription</th>
            <th class="text-center" colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>

          <?php if (count($utilisateurs) > 0) : ?>
            <?php foreach ($utilisateurs as $utilisateur) : ?>
              <tr>
                <td><?= $utilisateur->getIdUtilisateur(); ?></td>
                <td><?= $utilisateur->getPseudo();  ?></td>
                <td><?= $utilisateur->getNom() . ' ' . $utilisateur->getPrenom();  ?></td>
                <td><?= $utilisateur->getEmail();  ?></td>
                <td><?= $utilisateur->getTel(); ?></td>
                <td><?= $utilisateur->getDate_inscription();   ?></td>

                <td class="d-flex justify-content-center">
                  <!-- botton modifier -->
                  <a href="./?path=admin&action=edit-user&edit_id=<?= $utilisateur->getIdUtilisateur(); ?>" type="submit" name="edit_btn" class="btn btn-outline-secondary mx-2"><i class="far fa-edit"></i></a>

                  <!-- Button supprimer -->

                  <form action="./?path=admin&action=delete-user" method="POST">
                    <input type="hidden" name="delete_id" id="inputId" value="<?= $utilisateur->getIdUtilisateur(); ?>">

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
                                Aucun utilisateur trouvé ....
                                </div>';

            ?>
          <?php endif; ?>

        </tbody>

      </table>
  </div>

</div>