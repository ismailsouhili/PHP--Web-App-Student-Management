<?php
require_once("coonexiondb.php");
require('../fpdf/fpdf.php');

$idS=isset($_GET['idS'])?$_GET['idS']:0;
$requete="select * from stagiaire where idStagiaire=$idS";
$res=$conn->query($requete);
//$tot=$res->fetch();
$stagiaire=$res->fetch();

    $id=$stagiaire["idStagiaire"];
    $nom=$stagiaire["nom"];
    $pren=$stagiaire["prenom"];
    $idf=$stagiaire["idFiliere"];



$pdf = new FPDF();
$pdf->AddPage();

// Début en police Arial normale taille 10
$pdf->SetFont('Arial','B',16);
$h = 7;
$retrait = "      ";

$pdf->SetTitle('Liste des Stagiaires / PDF');
// Saut de ligne
$pdf->Ln(18);

// Titre
$pdf->Cell(0, 10,'LISTE DES STAGIAIRES','TB',1,'C');

// Saut de ligne
$pdf->Ln(5);

$pdf->Write($h, "Je soussigne, Directeur de l'etablissement CLEVER SCHOOL 2 PRIVEE SOUHILI Certifie que : . $nom $pren . \n\n\n");
$pdf->Write($h, $retrait . "Ne (e) Le : 05.06.1998 A : Nador \n\n\n");
$pdf->Write($h, $retrait . "CIN N- : " . $id . " \n\n\n");
$pdf->Write($h, $retrait . "ID-Filiere :  " . $idf . " \n\n\n");
$pdf->Write($h, "La presente attestation est delivree a l'interesse Pour servir et valoir ce que de droit. \n\n\n");

$pdf->Cell(0, 5, 'Fait a Souhihili Le :' . date('d/m/Y'), 0, 1, 'C');




//Afficher le pdf
$pdf->Output();
?>