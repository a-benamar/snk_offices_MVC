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

        } elseif (isset($_SESSION['error']) && !empty($_SESSION['error'])) {  ?>

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                echo '<h5> ' . $_SESSION['error'] . ' </h5>';
                unset($_SESSION['error']);
                ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <?php  } ?>
            </div>

            <!-- table  Salle -->
            <table class="table table-ordered table-responsive-lg table-striped table-hover text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Capacité</th>
                        <th>Ville</th>
                        <th>Prix</th>
                        <th class="text-center" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if (count($salles) > 0) : ?>
                        <?php foreach ($salles as $salle) : ?>

                            <tr>
                                <td><?= $salle->getIdSalle();  ?></td>
                                <td><?= $salle->getNomSalle();  ?></td>
                                <td><?= 'Salle de ' . $salle->getTypeSalle();  ?></td>
                                <td><?= $salle->getCapSalle();
                                    ?> Personnes max </td>
                                <td><?= $salle->getVilleSalle(); ?></td>
                                <td><?= $salle->getPrixSalle() . '.00 €'; ?> / Jour</td>

                                <td class=" d-flex justify-content-center">
                                    <!-- botton view salle -->
                                    <a href="./?path=admin&action=viewSalle&id=<?= $salle->getIdSalle(); ?>" type="submit" name="view_btn" class="btn btn-outline-secondary"><i class="far fa-eye"></i></i></a>

                                    <!-- botton modifier -->
                                    <a href="./?path=admin&action=edit-salle&edit_id=<?= $salle->getIdSalle(); ?>" type="submit" name="edit_btn" class="btn btn-outline-secondary mx-1"><i class="far fa-edit"></i></a>

                                    <!-- Button supprimer -->

                                    <form action="./?path=admin&action=delete-salle" method="POST">
                                        <input type="hidden" name="delete_id" id="inputId" required value="<?= $salle->getIdSalle(); ?>">

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
              Aucune salle trouvée ....
              </div>';

                        ?>
                    <?php endif; ?>

                </tbody>

            </table>
    </div>

</div>