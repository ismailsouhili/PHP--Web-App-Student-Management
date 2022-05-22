<?php
require_once("identifier.php");
        require_once("coonexiondb.php");   
        $login=isset($_GET['login'])?$_GET['login']:"";

        $size=isset($_GET['size']) ? $_GET['size']:6;
        $page=isset($_GET['page']) ? $_GET['page']:1;
        $offset=($page-1)*$size;

        $requeteUser="select * from utilisateur where login like '%$login%'";
        $requeteCount="select count(*) counUser from utilisateur";

        $resUser=$conn->query($requeteUser);
        $resCount=$conn->query($requeteCount);

        
        $tot=$resCount->fetch();
        $nbtot=$tot['counUser'];

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
    <title>Gestion des Utilisateur</title>
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
            <div class="panel-heading">Rechercher des Utilisateur</div>
            <div class="panel-body">
                 <form action="utilisateurs.php" method="get" class="form-inline">
                     <div class="form-group">
                     <input type="text" name="login" id="login" placeholder="Tapez le nom de Utilisateur" value="<?php echo $login ?>"  class="form-control">
                     </div>


                     <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Rechercher</button>
                     &nbsp;&nbsp;&nbsp;
                     <a href="nouvelleUtilisateur.php"><span class="glyphicon glyphicon-plus"></span> Nouvelle Utilisateur</a>
                 </form>
            </div>
            </div>
        

            <div class="panel panel-primary">
            <div class="panel-heading">Liste des Utilisateur (<?php echo $nbtot ?>) Utilisateurs </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">ID </th>
                        <th scope="col"> Login </th>
                        <th scope="col"> Email </th>
                        <th scope="col"> Role </th>
                        <th scope="col"> Actions </th>
                        </tr>                        
                    </thead>
                    <tbody>
                            <?php while($utilisat=$resUser->fetch()){ ?>
                                <tr class="<?php echo $utilisat['etat']==1?'success':'danger'?>">
                                    <td><?php echo $utilisat['iduser'] ?> </td>
                                    <td><?php echo $utilisat['login'] ?> </td>
                                    <td><?php echo $utilisat['email'] ?> </td> 
                                    <td><?php echo $utilisat['role'] ?> </td>
                                    
                                        <td>
                                            <a class="btn btn-success btn-edit-delete" href="editerUtilisateur.php?idU=<?php echo $utilisat['iduser'] ?>">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                            &nbsp;&nbsp;
                                            <a class="btn btn-danger btn-edit-delete" onclick="return confirm('Etes vous sur de vouloir supprimer le stagiaire')"
                                            href="supprimerUtilisateur.php?idU=<?php echo $utilisat['iduser'] ?>">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>
                                            &nbsp;&nbsp;
                                            <a class="btn btn-info btn-edit-delete" href="activeUser.php?idU=<?php echo $utilisat['iduser'] ?>&etat=<?php echo $utilisat['etat']  ?>">
                                               <?php 
                                                  if($utilisat['etat']==1)
                                                   echo '<span class="glyphicon glyphicon-remove"> </span>';
                                                  else
                                                   echo '<span class="glyphicon glyphicon-ok"> </span>';
                                               ?>
                                            </a>
                                        </td>
                                    
                                 </tr>
                             <?php } ?>
                        </tbody>
                </table>

                <div>
                <ul class="pagination">
                        <?php for($i=1;$i<=$nbrPage;$i++){ ?>
                            <li class="<?php if($i==$page) echo 'active' ?>"> 
                                <a href="utilisateurs.php?page=<?php echo $i;?>&login=<?php echo $login ?>">  <?php echo $i; ?>   </a> 
                             </li>
                        <?php } ?>
                    </ul>
                </div>


            </div>
            </div>
        </div>


    </body>
</html>