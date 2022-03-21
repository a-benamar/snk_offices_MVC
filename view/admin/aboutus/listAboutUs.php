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
            <th scope="col">Référence</th>
            <th scope="col">Titre</th>
            <th scope="col">Contenu</th>
            <!-- <th scope="col">Lien</th> -->
            <th scope="col">Date de creation</th>
            <th class="text-center" colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>

          <?php if (count($aboutUs) > 0) :  ?>

            <?php foreach ($aboutUs as $unAboutUs) :  ?>

              <tr>
                <td><?= $unAboutUs->getIdAboutUs(); ?></td>

                <td><?= $unAboutUs->getTitre(); ?></td>

                <td class="text-justify"><?= $unAboutUs->getContenu(); ?></td>

                <!-- <td><?= $unAboutUs->getLien(); ?></td> -->

                <td><?= date("d-m-Y", strtotime($unAboutUs->getDateCreation())); ?></td>



                <td class="d-flex justify-content-center align-middle">
                  <!-- botton modifier -->
                  <a href="./?path=admin&action=edit-AboutUs&edit_id=<?= $unAboutUs->getIdAboutUs(); ?>" type="submit" name="edit_btn" class="btn btn-outline-secondary mx-2"><i class="far fa-edit"></i></a>

                  <!-- Button supprimer -->

                  <form action="./?path=admin&action=delete-AboutUs" method="POST">
                    <input type="hidden" name="delete_id" id="inputId" required value="<?= $unAboutUs->getIdAboutUs(); ?>">

                    <button type="submit" name="delete_btn" class="btn btn-outline-secondary">
                      <i class="far fa-trash-alt"></i>
                    </button>
                  </form>
              </tr>
            <?php endforeach; ?>

          <?php else : ?>

            <?php
            echo ' <div class="alert alert-danger" role="alert">
Aucune image trouvée ....
                        </div>';

            ?>
          <?php endif; ?>

        </tbody>

      </table>
  </div>

</div>