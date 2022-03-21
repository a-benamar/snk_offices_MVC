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
            <th scope="col">Titre</th>
            <th scope="col">Contenu</th>
            <th scope="col">Publié</th>
            <th class="text-center" colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>

          <?php if (count($actualites) > 0) :?>

            <?php foreach ($actualites as $uneActualite) : ?>
          
              <tr>
              <td><?= $uneActualite->getidActualites(); ?></td>

                <td><?= $uneActualite->getTitre(); ?></td>

                <td class="text-justify"><?= $uneActualite->getContenu(); ?></td>


                <td><?= $uneActualite->getDatePub(); ?></td>


                <td class="d-flex justify-content-center">
                  <!-- botton modifier -->
                  <a href="./?path=admin&action=edit-actualites&edit_id=<?= $uneActualite->getIdActualites();?>" type="submit" name="edit_btn" class="btn btn-outline-secondary mx-2"><i class="far fa-edit"></i></a>

                  <!-- Button supprimer -->

                  <form action="./?path=admin&action=delete-actualites" method="POST">
                    <input type="hidden" name="delete_id" id="inputId" required value="<?= $uneActualite->getIdActualites(); ?>">

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
                  Aucune actualité trouvée ....
                       </div>';

            ?>
          <?php
          endif;
          ?>

        </tbody>

      </table>
  </div>

</div>