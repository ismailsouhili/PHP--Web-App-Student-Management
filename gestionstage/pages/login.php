<?php
session_start();
if(isset($_SESSION['erreurLogin']))
{
    $erreurLogin=$_SESSION['erreurLogin'];
}
else
{
    $erreurLogin="";
}

session_destroy();

?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    </head>
    <body>

    <div class="container col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
        <br> <br><br><br>
    <div class="panel panel-primary margetop60">
        <div class="panel-heading">Se connecter :</div>
            <div class="panel-body">

                                    <form method="post" action="seConnecter.php" class="form"  > 
                                        
                                    <?php if(!empty($erreurLogin)) {?>
                                        <div class="alert alert-danger">
                                            <?php echo $erreurLogin ?>
                                        </div>
                                    <?php  } ?>
                                                    
                                    <div class="form-group">
                                            <label for="login">Login :</label>
                                            <input type="text" name="login" placeholder="Login"
                                                class="form-control" autocomplete="off"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="pwd">Mot de passe :</label>
                                            <input type="password" name="pwd"
                                                placeholder="Mot de passe" class="form-control"/>
                                        </div>

                                        <button type="submit" class="btn btn-success">
                                            <span class="glyphicon glyphicon-log-in"></span>
                                            Se connecter
                                        </button>
                                        <p class="text-right">
                                            <a href="InitialiserPwd.php">Mot de passe Oublié</a>

                                            &nbsp &nbsp

                                            <a href="nouvelleUtilisateur.php">Créer un compte</a>
                                        </p>
                                    </form>
            </div>
        </div>
  </div>
</body>
</HTML>