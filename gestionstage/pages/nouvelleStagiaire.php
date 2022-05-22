<?php
require_once("identifier.php");
    require_once('coonexiondb.php');
   
    $requeteF="select * from filiere";
    $resultatF=$conn->query($requeteF);

?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nouvelle Stagiaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    </head>
    <body>
        <?php include("menu.php")?>

        <div class="container">
                       
                                <div class="panel panel-primary margetop60">
                                    <div class="panel-heading">Veuillez saisir les données de la nouvelle Stagiaire</div>
                                    <div class="panel-body">
                                        <form method="post" action="insertStagiaire.php" class="form"  enctype="multipart/form-data">
                                            
                                                
                                    <div class="form-group">
                                        <label for="nom">Nom :</label>
                                        <input type="text" name="nom" placeholder="Nom" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="prenom">Prénom :</label>
                                        <input type="text" name="prenom" placeholder="Prénom" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="civilite">Civilité :</label>
                                        <div class="radio">
                                            <label><input type="radio" name="civilite" value="F" checked/> F </label><br>
                                            <label><input type="radio" name="civilite" value="M"/> M </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="idFiliere">Filière:</label>
                                        <select name="idFiliere" class="form-control" id="idFiliere">
                                        <?php while($filiere=$resultatF->fetch()) { ?>
                                            <option value="<?php echo $filiere['idFiliere'] ?>"> 
                                                <?php echo $filiere['nomFiliere'] ?>
                                            </option>
                                        <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Photo :</label>
                                        <input type="file" name="photo" />
                                    </div>
                                  
                                  <button type="submit" class="btn btn-success">
                                      <span class="glyphicon glyphicon-save"></span>
                                      Enregistrer
                                  </button> 
                                
                              </form>
                     </div>
             </div>
                      
        </div> 


    </body>
</html>