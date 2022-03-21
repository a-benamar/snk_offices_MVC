<?php include("view/adminincludes/navbar.php");?>

<!-- Modal -->
<div class="modal fade" id="addservice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Un service de restauration</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- modal formulaire ajoutee un  service  -->
      <form action="serviceAction.php" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>Nom de service</label>
            <input type="text" name="libelleService" class="form-control" placeholder="Entrez Service">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" name="ajouter" class="btn btn-primary">Ajouter</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 fw-bold text-primary">Gestion Services Restauration
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addservice">
          Ajouter Un Service
        </button>
      </h6>
    </div>

    <div class="card-body">
      <div class="table-responsive">

        <!-- affichage de message success et erreur -->

        <?php if (isset($_SESSION['success']) && $_SESSION['success'] != '') { ?>
          <div class="alert alert-success" role="alert">

            <?php echo '<h3> ' . $_SESSION['success'] . ' </h3>';
            unset($_SESSION['success']);
            ?>
          </div>

        <?php
        } elseif (isset($_SESSION['error']) && $_SESSION['error'] != '') { ?>
          <div class="alert alert-danger" role="alert">

          <?php
          echo '<h3> ' . $_SESSION['error'] . ' </h3>';
          unset($_SESSION['error']);
        }
          ?>
          </div>

          <!-- table  services -->
          <?php
          $con = mysqli_connect("localhost", "root", "root", "loc_salles");
          $query = ("SELECT * FROM service");
          $query_run = mysqli_query($con, $query);
          ?>
          <table class="table table-ordered table-striped table-hover text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nom De Service</th>
                <!-- <th>Photo</th> -->
                <th class="text-center" colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>

              <?php
              if (mysqli_num_rows($query_run) > 0) {  // affichage de tous les services
                while ($row = mysqli_fetch_assoc($query_run)) {  ?>

                  <tr>
                    <td><?= $row['idService']; ?></td>
                    <td><?= $row['libelleService'];  ?></td>

                    <td>
                      <!-- botton modifier -->
                      <form action="editService.php" method="POST">
                        <input type="hidden" name="edit_id" value="<?= $row['idService']; ?>">
                        <button type="submit" name="edit_btn" class="btn btn-outline-success"><i class="far fa-edit"></i></button>
                      </form>
                    </td>

                    <td>
                      <!-- botton supprimer -->
                      <form action="serviceAction.php" method="POST">
                        <input type="hidden" name="delete_id" value="<?= $row['idService']; ?>">
                        <button type="submit" name="delete_btn" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></button>
                      </form>
                    </td>
                  </tr>

              <?php
                }
              } else {
                echo '
                <div class="alert alert-danger" role="alert">
                Aucun service trouvé ...
                </div>';
              }
              ?>

            </tbody>

          </table>
      </div>

    </div>

  </div>
</div>



<?php include("view/adminincludes/footer.php"); ?>