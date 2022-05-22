<?php
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion Stagiaires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    </head>
    <body>

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../index.php">Gestion Stagiaires</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarNav">
        <ul class="navbar-nav nav justify-content-center ">
        <li class="nav-item active ">
            <a class="nav-link" href="stagiaires.php"><i class="fa fa-address-book" aria-hidden="true"></i> Les Stagiaires</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="filieres.php"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;Les Filières</a>
        </li>
        <?php if($_SESSION['user']['role']=='ADMIN') {?>
        <li class="nav-item">
            <a class="nav-link" href="utilisateurs.php"><i class="fa fa-users" aria-hidden="true"></i>&nbsp; Les Utilisateurs</a>
        </li>
        <?php } ?>
        </ul>

        <ul class="navbar-nav navbar-right nav justify-content-center">
        <li class="nav-item active">
            <a class="nav-link" href="editerUtilisateur.php?idU=<?php echo $_SESSION['user']['iduser'] ?>"> <i class="fa fa-user-circle-o" aria-hidden="true"></i> &nbsp; <?php echo $_SESSION['user']['login']?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="seDeconnecter.php" ><i class="fa fa-sign-out"></i> &nbsp; Deconnecter</a>
        </li>
        
        </ul>
    </div>
    
    </nav>
    <!--End-Navbar-->
        
    </body>
</html>