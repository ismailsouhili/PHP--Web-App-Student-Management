<?php

require_once("identifier.php");
    require_once('coonexiondb.php');

    $idU=isset($_POST['idU'])?$_POST['idU']:0;
    $login=isset($_POST['login'])?$_POST['login']:"";
    $email=isset($_POST['email'])?$_POST['email']:"";
    
    $requete="UPDATE `utilisateur` SET `login`=?,`email`=? WHERE `iduser`=?";
    $params=array($login,$email,$idU);
    $resultat=$conn->prepare($requete);
    $resultat->execute($params);
    
    header('location:login.php');
?>
