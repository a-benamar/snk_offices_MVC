<?php ini_set('display_errors', 'on'); ?>
<?php include("view/admin/includes/header.php"); ?>


<!-- Modal -->
<div class="modal fade" id="addActualites" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Une Actualité</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- modal formulaire ajoutee une image  -->
      <form action="./?path=admin&action=traitement-ajouter-actualites" method="POST" class="needs-validation" novalidate>
        <div class="modal-body">

          <div class="form-group">
            <label for="validationCustom01">* Titre</label>
            <input type="text" name="titre" id="validationCustom01" class="form-control" placeholder="Entrez le titre" required>
          </div>


          <div class="form-group">
            <label for="validationCustom03">* Contenu</label>
            <textarea type="text" name="contenu" id="validationCustom03" cols="30" rows="7" class="form-control" required placeholder="Entrez le contenu"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-outline-primary">Ajouter</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 fw-bold text-primary">Gestion d'Actualités
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addActualites">
          Ajouter Une Actualités
        </button>
      </h6>
    </div>
  </div>
</div>

<?php include_once("listActualites.php"); ?>

<?php include "view/admin/includes/footer.php";?>