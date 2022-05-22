<?php
require_once('coonexiondb.php');
require_once('../Founctions/fonction.php');

$validationErrors=array();

if($_SERVER['REQUEST_METHOD']=='POST')
{
    $login=$_POST['login'];
    $pwd1=$_POST['pwd1'];
    $pwd2=$_POST['pwd2'];
    $email=$_POST['email'];

    if(isset($login))
    {
        $filtrdlogin=filter_var($login,FILTER_SANITIZE_STRING);
        if(strlen($filtrdlogin)< 4)
        {
            $validationErrors[]="Erreur!!! Le login doit contenir au moins 4 caratères";
        }
    }

    if(isset($pwd1) && isset($pwd2))
    {
        if(empty($pwd1))
        {
            $validationErrors[]="Erreur!!! Le mot ne doit pas etre vide";
        }
        if(md5($pwd1) !== md5($pwd2))
        {
            $validationErrors[]="Erreur!!! les deux mot de passe ne sont pas identiques";
        }
    }

    if(isset($email))
    {
        $filtredemail=filter_var($email,FILTER_SANITIZE_EMAIL);
        if($filtredemail != true)
        {$validationErrors[]="Erreur!!! Email  non valid";
        }
    }

    if(empty($validationErrors))
    {
        if(rechercher_par_login($login)==0 && rechercher_par_email($email)==0)
        {
            $requete=$conn->prepare("insert into utilisateur(login,email,pwd,role,etat) values(:plogin,:pemail,:ppwd,:prole,:petat)");

            $requete->execute(array(
                'plogin'=>$login,
                'pemail'=>$email,
                'ppwd'=>md5($pwd1),
                'prole'=>'VISITEUR',
                'petat'=>0 ));
                
                $success_msg="Félicitation, votre compte est crée, mais temporairement inactif jusqu'a activation par l'admin";
                header('location:login.php');
        }
        else
        {
            if(rechercher_par_login($login)>0)
            {
                $validationErrors[]='Désolé le login exsite deja';
            }
            if(rechercher_par_email($email)>0)
            {
                $validationErrors[]='Désolé cet email exsite deja';
            }
        }
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8"/>

    <title> Nouvel utilisateur </title>

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">

</head>
<body>

<div class="container col-md-6 col-md-offset-3">
    <h1 class="text-center"> Création d'un nouveau compte utilisateur</h1>

    <form class="form" method="post">

        <div class="input-container">

            <input type="text"
                   required="required"
                   minlength="4"
                   title="Le login doit contenir au moins 4 caractères..."
                   name="login"
                   placeholder="Taper votre nom d'utilisateur"
                   autocomplete="off"
                   class="form-control">
        </div>

        <div class="input-container">
            <input type="password"
                   required="required"
                   minlength="3"
                   title="Le Mot de passe doit contenir au moins 3 caractères..."
                   name="pwd1"
                   placeholder="Taper votre mot de passe"
                   autocomplete="new-password"
                   class="form-control">
        </div>

        <div class="input-container">
            <input type="password"
                   required="required"
                   minlength="3"
                   name="pwd2"
                   placeholder="retaper votre mot de passe pour le confirmer"
                   autocomplete="new-password"
                   class="form-control">
        </div>

        <div class="input-container">

            <input type="email"
                   required="required"
                   name="email"
                   placeholder="Taper votre email"
                   autocomplete="off"
                   class="form-control">
        </div>

        <input type="submit" class="btn btn-primary" value="Enregistrer">
    </form>
    <br>


</div>

</body>

</html>