<?php
require_once("identifier.php");
   if(isset($_SESSION['user']))
   {
    require_once('coonexiondb.php');

    $idS=isset($_GET['idS'])?$_GET['idS']:0;
 
     $requete="delete from stagiaire where idStagiaire=?";
     $params=array($idS);
     $resultat=$conn->prepare($requete);
     $resultat->execute($params);
     
     header('location:stagiaires.php');
   }
   else
   {
    header('location:login.php');
   }

   
  
?>