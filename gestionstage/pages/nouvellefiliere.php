<?php 
require_once("identifier.php");
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nouvelle Filiere</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    </head>
    <body>
        <?php include("menu.php")?>

        <div class="container">
                       
                       <div class="panel panel-primary margetop60">
                          <div class="panel-heading">Veuillez saisir les données de la nouvelle filère</div>
                          <div class="panel-body">
                              <form method="post" action="insertFiliere.php" class="form">
                                  
                                  <div class="form-group">
                                       <label for="niveau">Nom de la filière:</label>
                                      <input type="text" name="nom" 
                                             placeholder="Nom de la filière"
                                             class="form-control"/>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="niveau">Niveau:</label>
                                      <select name="niveau" class="form-control" id="niveau">
                                          <option value="q">Qualification</option>
                                          <option value="t">Technicien</option>
                                          <option value="ts" selected>Technicien Spécialisé</option>
                                          <option value="l">Licence</option>
                                          <option value="m">Master</option> 
                                      </select>
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