<?php
require_once("identifier.php");
require_once('coonexiondb.php');
            
$idU=isset($_GET['idU'])?$_GET['idU']:0;     
$etat=isset($_GET['etat'])?$_GET['etat']:0;

if($etat==1)
    $newEtat=0;
else
    $newEtat=1;

$requete="update utilisateur set etat=? where iduser=?";

$params=array($newEtat,$idU);

$resultat=$conn->prepare($requete);
$resultat->execute($params);

header('location:utilisateurs.php');

?>