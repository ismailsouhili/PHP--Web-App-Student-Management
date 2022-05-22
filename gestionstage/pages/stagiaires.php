<?php
require_once("identifier.php");
        require_once("coonexiondb.php");

        //$req="select * from stagiaire";
       
        $nomPrenom=isset($_GET['nomPrenom'])?$_GET['nomPrenom']:"";
        $filiere=isset($_GET['idFiliere'])?$_GET['idFiliere']:0;

        $size=isset($_GET['size']) ? $_GET['size']:6;
        $page=isset($_GET['page']) ? $_GET['page']:1;
        $offset=($page-1)*$size;

        $requete="select * from filiere";


        if($filiere==0){
            $req="SELECT idStagiaire,nom,prenom,nomFiliere,photo FROM stagiaire INNER JOIN filiere ON stagiaire.idFiliere = filiere.idFiliere 
                 and (nom like '%$nomPrenom%' or prenom like '%$nomPrenom%') order by idStagiaire   
                 limit $size offset $offset ";
            $reqtot="select count(*) contS from stagiaire where (nom like '%$nomPrenom%' or prenom like '%$nomPrenom%') ";
        }else{
             $req="SELECT idStagiaire,nom,prenom,nomFiliere,photo FROM stagiaire INNER JOIN filiere ON stagiaire.idFiliere = filiere.idFiliere 
                and (nom like '%$nomPrenom%' or prenom like '%$nomPrenom%') order by idStagiaire  and filiere.idFiliere=$filiere 
                 limit $size offset $offset ";
             $reqtot="select count(*) contS from stagiaire where (nom like '%$nomPrenom%' or prenom like '%$nomPrenom%')  and idFiliere='$filiere' ";
        
        }

        $res=$conn->query($req);
        $restot=$conn->query($reqtot);
        $resfil=$conn->query($requete);

        
        $tot=$restot->fetch();
        $nbtot=$tot['contS'];

        $rest=$nbtot % $size;
        if($rest===0)
         $nbrPage=$nbtot/$size;
        else
         $nbrPage=floor($nbtot/$size)+1;



?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Stagiaires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    </head>
    <body>
        <?php include("menu.php")?>

        <div class="container">
            <div class="panel panel-success">
            <div class="panel-heading">Rechercher des Stagiaires</div>
            <div class="panel-body">
                 <form action="stagiaires.php" method="get" class="form-inline">
                     <div class="form-group">
                     <input type="text" name="nomPrenom" id="nomPrenom" placeholder="Tapez le nom de Stagiaires" value="<?php echo $nomPrenom ?>"  class="form-control">
                     </div>

                     
                     <label for="">Filiere :</label>
                     <select name="idFiliere" id="idFiliere" class="form-control" onchange="this.form.submit()">
                           <option value=0>Toutes les filières</option>
                           <?php while($filiere=$resfil->fetch()) {?> 
                            <option value="<?php echo $filiere['idFiliere']?>">

                            <?php if($filiere['idFiliere']===$filiere) echo "selected"?>
                            <?php echo $filiere['nomFiliere']?>

                            </option>
                           <?php } ?>
                     </select>

                     <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Rechercher</button>
                     &nbsp;&nbsp;&nbsp;
                     &nbsp;&nbsp;&nbsp;
                     <?php if($_SESSION['user']['role']=='ADMIN') {?>
                     <a href="nouvelleStagiaire.php" class="btn btn-primary btn-edit-delete"><span class="glyphicon glyphicon-plus"></span> Nouvelle Stagiaire</a>
                     &nbsp;&nbsp;&nbsp;
                     &nbsp;&nbsp;&nbsp;

                     <?php } ?>
                 </form>
                 
            </div>
            </div>
        

            <div class="panel panel-primary">
            <div class="panel-heading">Liste des Stagiaires (<?php echo $nbtot ?>) Stagiaires </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">ID </th>
                        <th scope="col"> Nom </th>
                        <th scope="col"> Prenom </th>
                        <th scope="col"> Filiere </th>
                        <th scope="col"> Photo </th>
                        <?php if($_SESSION['user']['role']=='ADMIN') {?>
                        <th scope="col"> Action </th>
                        <?php } ?>
                        </tr>                        
                    </thead>
                    <tbody>
                            <?php while($stagiaire=$res->fetch()){ ?>
                                <tr>
                                    <td><?php echo $stagiaire['idStagiaire'] ?> </td>
                                    <td><?php echo $stagiaire['nom'] ?> </td>
                                    <td><?php echo $stagiaire['prenom'] ?> </td> 
                                    <td><?php echo $stagiaire['nomFiliere'] ?> </td>
                                    <td>
                                        <img src="../images/<?php echo $stagiaire['photo']?>"
                                        width="50px" height="50px" class="img-circle">
                                    </td> 
                                       <?php if($_SESSION['user']['role']=='ADMIN') {?>
                                        <td>
                                            <a class="btn btn-success btn-edit-delete" href="editerStagiaire.php?idS=<?php echo $stagiaire['idStagiaire'] ?>">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                            &nbsp; &nbsp;
                                            <a class="btn btn-danger btn-edit-delete" onclick="return confirm('Etes vous sur de vouloir supprimer le stagiaire')"
                                            href="supprimerStagiaire.php?idS=<?php echo $stagiaire['idStagiaire'] ?>">
                                                <span class="fa fa-trash"></span>
                                            </a>
                                            &nbsp; &nbsp;
                                            <a class="btn btn-info btn-edit-delete" href="attestation.php?idS=<?php echo $stagiaire['idStagiaire'] ?>"> 
                                                    <span class="fa fa-print"> Imprimer PDF</span>
                                            </a>
                                            
                                        </td>
                                        <?php } ?>
                                 </tr>
                             <?php } ?>
                        </tbody>
                </table>

                <div>
                <ul class="pagination">
                        <?php for($i=1;$i<=$nbrPage;$i++){ ?>
                            <li class="<?php if($i==$page) echo 'active' ?>"> 
                                <a href="stagiaires.php?page=<?php echo $i;?>&nomPrenom=<?php echo $nomPrenom ?>&idfiliere=<?php echo $filiere ?>">
                                    <?php echo $i; ?>
                                </a> 
                             </li>
                        <?php } ?>
                    </ul>
                </div>

               


            </div>
            </div>
        </div>


    </body>
</html>