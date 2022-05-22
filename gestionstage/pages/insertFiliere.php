<?php
require_once("identifier.php");
require_once('coonexiondb.php');

$nom=isset($_POST['nom'])?$_POST['nom']:"";
$niveau=isset($_POST['niveau'])?strtoupper($_POST['niveau']):"";

$requete="insert into filiere(nomFiliere,niveau) values(?,?)";
$params=array($nom,$niveau);
$resul=$conn->prepare($requete);
$resul->execute($params);

header('location:filieres.php');

?>