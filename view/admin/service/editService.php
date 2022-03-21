<?php include("view/adminincludes/navbar.php");?>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 fw-bold text-primary">Modifier Le Service</h6>
    </div>
    <div class="card-body">

      <?php
      // update service restauration

      if (isset($_POST['edit_btn'])) {
        $id = $_POST['edit_id'];

        $afficheService = $bdd->prepare("SELECT * FROM service WHERE idService='$id'");
        $afficheService->execute();

        // if (is_array($query_run) || is_object($query_run)){       

        foreach ($afficheService as $row) { ?>

          <div class="form-group">
            <!-- formulaire de modification -->

            <form action="serviceAction.php" method="POST" class="col-8">
              <input type="hidden" name="edit_id" value="<?= $row['idService'] ?>">
              <div class="form-group">
                <label>Nom de service</label>
                <input type="text" name="edit_libelleService" class="form-control" placeholder="Entrez Service" value="<?= $row['libelleService'] ?>">
              </div>
              <!-- 
                <div class="form-group">
                    <label>Prix de service</label>
                    <input type="text" name="edit_prix" value="<?= $row['prix'] ?>" class="form-control" placeholder="Entrez le prix de service">
                </div> -->
              <a href="registerService.php" class="btn btn-danger">Cancel</a>
              <button type="submit" name="updatebtn" class="btn btn-primary">Modifier</button>


          <?php
        }
      }
          ?>
            </form>
          </div>
    </div>
  </div>
</div>


<?php include "includes/footer.php"; ?>