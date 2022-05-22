<?php
        try
        {
            $conn=new PDO('mysql:host=localhost;dbname=geststage;charset=utf8','root','');
        }
        catch(Exception $e)
        {
            die('Erreur de coonexion :' .$e->getMessage());
        }
?>