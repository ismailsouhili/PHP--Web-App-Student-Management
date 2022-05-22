<?php 
require_once("identifier.php");
require_once("coonexiondb.php");  

$idU=$_SESSION['user']['iduser'];

$oldPwd=isset($_POST['oldpwd'])?$_POST['oldpwd']:"";
$newPwd=isset($_POST['newpwd'])?$_POST['newpwd']:"";

$request="select * from utilisateur where iduser=$idU and pwd=MD5('$oldPwd') ";
$resultat=$conn->prepare($request);
$resultat->execute();

$msg="";
$interval=3;
$url="login.php";

if($resultat->fetch())
{
    $request="update utilisateur set pwd=MD5(?) where iduser=?";
    $params=array($newPwd,$idU);
    $resultat=$conn->prepare($request);
    $resultat->execute($params);

    $msg="<div class='alert alert-success'>
              <strong>Félicitation!</strong> Votre mot de passe est modifié avec succés
         </div>";
}
else
{
    $msg="<div class='alert alert-danger' >
            <strong>Erreur!</strong> L'ancien mot de passe est incorrect !!!!
           </div>";
           $url=$_SERVER['HTTP_REFERER'];
}

?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Changement de Mot de Passe</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <br> <br> <br>
            <?php echo $msg;
                  header("refresh:$interval;url=$url");
            ?>
        </div>
        
    </body>
</html>