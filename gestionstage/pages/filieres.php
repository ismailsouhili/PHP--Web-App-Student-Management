<?php
        require_once("identifier.php");  
        require_once("coonexiondb.php");

        $req="select * from filiere";
       

        $nam=isset($_GET['nomF'])?$_GET['nomF']:"";
        $niveau=isset($_GET['niveau'])?$_GET['niveau']:"all";


        $size=isset($_GET['size']) ? $_GET['size']:6;
        $page=isset($_GET['page']) ? $_GET['page']:1;

        $offset=($page-1)*$size;


        if($niveau=="all"){
            $req="select * from filiere
                    where nomFiliere like '%$nam%' limit $size offset $offset ";
            $reqtot="select count(*) contf from filiere where nomFiliere like '%$nam%' ";
        }else{
             $req="select * from filiere
                    where nomFiliere like '%$nam%'
                    and niveau='$niveau'";
             $reqtot="select count(*) contf from filiere where nomFiliere like '%$nam%' and niveau='$niveau' ";          
        
        }

        $res=$conn->query($req);

        $restot=$conn->query($reqtot);
        $tot=$restot->fetch();
        $nbtot=$tot['contf'];

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
    <title>Gestion Stagiaires</title>
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
            <div class="panel-heading">Rechercher des filieres</div>
            <div class="panel-body">
                 <form action="filieres.php" method="get" class="form-inline">
                     <div class="form-group">
                     <input type="text" name="nomF" id="" placeholder="Tapez le nom de filiere" value="<?php echo $nam ?>"  class="form-control">
                     </div>

                     
                     <label for="">Niveaux :</label>
                     <select name="niveau" id="niveau"  class="form-control" onchange="this.form.submit()">
                            <option value="all" <?php if($niveau==="all") echo "selected" ?>>Tous les niveaux</option>
                            <option value="q"   <?php if($niveau==="q")   echo "selected" ?>>Qualification</option>
                            <option value="t"   <?php if($niveau==="t")   echo "selected" ?>>Technicien</option>
                            <option value="ts"  <?php if($niveau==="ts")  echo "selected" ?>>Technicien Spécialisé</option>
                            <option value="l"   <?php if($niveau==="l")   echo "selected" ?>>Licence</option>
                            <option value="m"   <?php if($niveau==="m")   echo "selected" ?>>Master</option> 
                     </select>
                     <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Rechercher</button>
                     &nbsp;&nbsp;&nbsp;

                     <?php if($_SESSION['user']['role']=='ADMIN') {?>
                     <a href="nouvellefiliere.php"><span class="glyphicon glyphicon-plus"></span> Nouvelle Filière</a>
                     <?php } ?>

                 </form>
            </div>
            </div>
        

            <div class="panel panel-primary">
            <div class="panel-heading">Liste des filieres (<?php echo $nbtot ?>) filieres </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">ID </th>
                        <th scope="col"> Nom </th>
                        <th scope="col"> Niveau </th>
                        <?php if($_SESSION['user']['role']=='ADMIN') {?>
                        <th scope="col"> Action </th>
                        <?php } ?>
                        </tr>                        
                    </thead>
                    <tbody>
                               <?php while($filiere=$res->fetch()) {?>
                        <tr>
                        <th scope="col"> <?php echo $filiere['idFiliere'] ?> </th>
                        <th scope="col"> <?php echo $filiere['nomFiliere'] ?>  </th>
                        <th scope="col"> <?php echo $filiere['niveau'] ?>  </th>
                        <?php if($_SESSION['user']['role']=='ADMIN') {?>
                        <th scope="col">  
                            <a class="btn btn-success btn-edit-delete"  href="editerFiliere.php?idF=<?php echo $filiere['idFiliere']?>"><span class="glyphicon glyphicon-edit"></span></a> 
                            &nbsp;&nbsp;&nbsp;  
                            <a class="btn btn-danger btn-edit-delete" href="supprimerFiliere.php?idF=<?php echo $filiere['idFiliere']?>" onclick="return confirm('etes vous sur de vouloir supprimer')"><span class="glyphicon glyphicon-trash"></span></a> </th>
                        </tr>
                        <?php } ?>

                               <?php } ?>
                    </tbody>
                </table>

                <div>
                    <ul class="pagination">
                        <?php for($i=1;$i<=$nbrPage;$i++){ ?>
                            <li class="<?php if($i==$page) echo 'active' ?>"> 
                                  <a href="filieres.php?page=<?php echo $i;?>&nomF=<?php echo $nam ?>&niveau=<?php echo $niveau ?>"> <?php echo $i; ?> </a> 
                             </li>
                        <?php } ?>
                    </ul>
                </div>


            </div>
            </div>
        </div>


    </body>
</html>