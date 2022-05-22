<?php 
require_once('identifier.php');
?>

<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Changer Mot de Passe</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <script src="../js/jquery-3.3.1.js"></script>
        <script src="../java/monjava.js"></script>
    </head>
    <body>
        <div class="container editpwd-page">
            <h2 class="text-center">Changer de Mot de Passe</h2>
            <h3 class="text-center">Compte : <?php echo $_SESSION['user']['login']?></h3>

            <form action="updatePwd.php" method="post" class="form-horizontal">

            <div class="input-container">
            <input class="form-control oldpwd"
                   type="password"
                   name="oldpwd"
                   autocomplete="new-password"
                   placeholder="Taper votre Ancien Mot de passe"
                   required>
            <i class="fa fa-eye fa-2x show-old-pwd clickable"></i>
           </div>

           <div class="input-container">
            <input minlength=4
                    class="form-control newpwd"
                    type="password"
                    name="newpwd"
                    autocomplete="new-password"
                    placeholder="Taper votre Nouveau Mot de passe"
                    required>
            <i class="fa fa-eye fa-2x show-new-pwd clickable"></i>

           </div>


           <input
                type="submit"
                value="Enregistrer"
                class="btn btn-primary btn-block"/>
                
            </form>

        </div>

    </body>
</HTML>