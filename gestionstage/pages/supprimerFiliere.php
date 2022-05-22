<?php
require_once("identifier.php");
   require_once('coonexiondb.php');

   $idf=isset($_GET['idF'])?$_GET['idF']:0;

   $req="select count(*) countStag from stagiaire where idFiliere=$idf";
   $res=$conn->query($req);
   $countstge=$res->fetch();
   $nbstg=$countstge['countStag'];


   if($nbstge==0)
   {
    $requete="delete from filiere where idFiliere=?";
    $params=array($idf);
    $resultat=$conn->prepare($requete);
    $resultat->execute($params);
    header('location:filieres.php');

   }
   else
   {
      $msg="Suppression impossible: Vous devez supprimer tous les stagiaires inscris dans cette filière";
      header("location:alert.php?message=$msg");
   }
   
  
?>