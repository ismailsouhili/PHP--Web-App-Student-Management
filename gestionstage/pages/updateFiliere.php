<?php
require_once("identifier.php");
    require_once('coonexiondb.php');

    $idf=isset($_POST['idF'])?$_POST['idF']:0;
    $nomf=isset($_POST['nomF'])?$_POST['nomF']:"";
    $niveau=isset($_POST['niveau'])?strtoupper($_POST['niveau']):"";
    
    $requete="UPDATE `filiere` SET `nomFiliere`=?,`niveau`=? WHERE `idFiliere`=?";
    //$requete="update filiere set nomFiliere=?, niveau=? where idFiliere=?";
    $params=array($nomf,$niveau,$idf);
    $resultat=$conn->prepare($requete);
    $resultat->execute($params);
    
    header('location:filieres.php');
?>
