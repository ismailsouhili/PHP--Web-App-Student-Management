<?php
require_once("identifier.php");
    require_once('coonexiondb.php');

    $idU=isset($_GET['idU'])?$_GET['idU']:0;
    $requeteS="select * from utilisateur where iduser=$idU";
    $resultatS=$conn->query($requeteS);
    $stagiaire=$resultatS->fetch();

    $login=$stagiaire['login'];
    $email=$stagiaire['email'];


?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Edition d'un stagiaire</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>
        
        <div class="container">
                       
             <div class="panel panel-primary margetop60">
                <div class="panel-heading">Edition du Utilisateur :</div>
                <div class="panel-body">

                    <form method="post" action="updateUtilisateur.php" class="form" >
						<div class="form-group">
                             <label for="idS">ID du Utilisateur: <?php echo $idU ?></label>
                            <input type="hidden"  name="idU" class="form-control" value="<?php echo $idU ?>"/>
                        </div>

                        <div class="form-group">
                             <label for="nom">Login :</label>
                            <input type="text" name="login" placeholder="Nom" class="form-control" value="<?php echo $login ?>"/>
                        </div>

                        <div class="form-group">
                             <label for="prenom">Email :</label>
                            <input type="text" name="email" placeholder="Prénom" class="form-control"
                                   value="<?php echo $email ?>"/>
                        </div>
                      
				        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-save"></span>
                            Enregistrer
                        </button> 

                        &nbsp;&nbsp;&nbsp;
                        <a href="editPwd.php">Changer le mot de passe</a>

                      
					</form>
                </div>
            </div>   
        </div>      
    </body>
</HTML>