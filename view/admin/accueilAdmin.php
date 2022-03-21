<?php ini_set('display_errors', 'on'); ?>
<?php include("includes/header.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-start justify-content-center mb-2">
        <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
        <p class="text-center"> <img src="./public/img/logo.png" style="width:100px; height:95px;" alt=""></p>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-power-off fa-sm text-white-50"></i> Déconnexion</a> -->
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Nombre d'Admin -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a style="text-decoration:none" href="./?path=admin&action=listAdmin">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Nombre d'Admin</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= '<h1 class="text-center text-primary"> ' . count($AllAdmins) . ' </h1>'; ?>

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-cog fa-2x text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Nombre d'utilisateur -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a style="text-decoration:none" href="./?path=admin&action=listUser">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Nombre d'Utilisateurs</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    <?= '<h1 class="text-center text-primary"> ' . count($AllUtilisateurs) . ' </h1>'; ?>

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users-cog fa-2x text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Salles count -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a style="text-decoration:none" href="./?path=admin&action=listSalle">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Nombre de Salles</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    <?= '<h1 class="text-center text-primary"> ' . count($AllSalles) . ' </h1>'; ?>

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-building fa-2x text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- reservation count -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a style="text-decoration:none" href="./?path=admin&action=listReservation">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Nombre de Résérvations</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    <?= '<h1 class="text-center text-primary"> ' . count($AllReservations) . ' </h1>';  ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-newspaper fa-2x text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- images count -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a style="text-decoration:none" href="./?path=admin&action=listImage">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Nombre d'Images</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    <?= '<h1 class="text-center text-primary"> ' . count($AllImages) . ' </h1>';  ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-images fa-2x text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <!-- actualites count -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a style="text-decoration:none" href="./?path=admin&action=listActualites">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Nombre d'actualités</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                <?= '<h1 class="text-center text-primary"> ' . count($AllActualites) . ' </h1>';  ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book-reader fa-2x text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- AboutUs-->
        <div class="col-xl-3 col-md-6 mb-4">
            <a style="text-decoration:none" href="./?path=admin&action=listAboutUs">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Nombre d'About Us</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    <?= '<h1 class="text-center text-primary"> ' . count($AllAboutUS) . ' </h1>';  ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-address-card fa-2x text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- AboutUs-->
        <div class="col-xl-3 col-md-6 mb-4">
            <a style="text-decoration:none" href="#">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Autres Services</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    <h1 class="text-center text-primary"> 0 </h1>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-signature fa-2x text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



<?php include("includes/footer.php"); ?>