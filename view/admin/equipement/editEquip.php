<?php ini_set('display_errors', 'on'); ?>
<?php include("view/admin/includes/header.php");?>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 fw-bold text-primary">Modifier L'équipement</h6>
    </div>
    <div class="card-body">

        <?php
            // update équipement 

            if(isset($_POST['edit_btn']))
            {
                $id = $_POST['edit_id'];

                $afficheService = $bdd->prepare("SELECT * FROM equipement WHERE idEquipement='$id'");
                $afficheService->execute();
                
               // if (is_array($query_run) || is_object($query_run)){       

                foreach ($afficheService as $row) { ?>

    <div class="form-group">
        <!-- formulaire de modification -->
        
         <form action="equipAction.php" method="POST" class="col-8">
                 <input type="hidden" name="edit_id" value="<?= $row['idEquipement'] ?>">              
                <div class="form-group">
                <label>Nom d'équipement</label>
                <input type="text" name="edit_intituleEquipement" class="form-control" placeholder="Entrez le nom d'équipement" value="<?=$row['intituleEquipement']?>">
               </div>
<!-- 
                <div class="form-group">
                    <label>Prix d'équipement</label>
                    <input type="text" name="edit_prix" value="<?= $row['prix'] ?>" class="form-control" placeholder="Entrez le prix d'équipement">
                </div> -->
                <a href="registerEquip.php" class="btn btn-danger">Cancel</a>
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


<?php include "view/admin/includes/footer.php"; ?>  