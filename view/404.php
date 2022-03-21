<?php 
    $title = 'Erreur 404'; 
    ob_start(); 
 ?>

<div class="container">
    <div class="row">
        <div class="col-md-12 mr-auto ml-auto text-center py-5 mt-3">
            <div class="card justify">
                <div class="card-body">
                    <h1 class="card-title alert alert-danger" role="alert">Error Page</h1>
                    <h2 class="card-title">404 Error</h2>
                    <p class="card-text">
                        The page you are searching for is Not Available :(
                    </p>
                    <a href="./?path=main&action=accueil" class="btn btn-primary">Go Back to Home Page</a>
                </div>
            </div>

        </div>
    </div>
</div>


<?php 
    $content = ob_get_clean(); 
    require('template.php'); 
?>