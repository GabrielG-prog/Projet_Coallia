<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="images/coallia-squarelogo-1408465071664.png">

  <title>GUCCI</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="css/styles.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">GUCCI</a>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="#">
          <span data-feather="x"></span>
        </a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="../index.php">
                <span data-feather="users"></span>
                Les comptes <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="history.php">
                <span data-feather="file-text"></span>
                L'historique
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="log.php">
                <span data-feather="bar-chart-2"></span>
                Les logs
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Modifier un compte BAP</h1>
        </div>
        <?php
        require 'database.php';

        $mat='';
        if(isset($_GET["mat"])) {

          $mat = $_GET["mat"];
          $date = '20200101';
            $heure = '1556';
            $nom = '';
            $prenom = '';
            $unite = ''; 
            $qualif = '';
            $email = '';
            $password = '1725456010';
            $titre = ''; 
            $droitG = ''; 
            $droitValide = '';
            $droitConsulte = '';
            $societe = ''; 
            $commentaire = '';
            $totcO = 0; 
            $preValide = 0; 
            $validation = 0;

          if(!empty($_POST)) {
                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];
                    $unite = $_POST['unite']; 
                    $qualif = $_POST['qualif'];
                    $email = $_POST['email'];
                    $titre = $_POST['titre']; 
                    $droitG = $_POST['droitG']; 
                    $droitValide = $_POST['droitValide'];
                    $droitConsulte = $_POST['droitConsulte'];
                    $societe = $_POST['societe']; 
                    $commentaire = $_POST['commentaire'];
                    $totcO = $_POST['totcO']; 
                    $preValide = (isset($_POST['preValide'])) ? 1 : 0; 
                    $validation = (isset($_POST['validation'])) ? 1 : 0;

            $request = "UPDATE BAP_COMPTE_CONNECTION 
            SET  BAP_CONNECTION_MATRICULE ='".$mat."', BAP_CONNECTION_DTE_LAST_CONN ='".$mat."', BAP_CONNECTION_HR_LAST_CONN '".$mat."', BAP_CONNECTION_Nom '".$mat."', BAP_CONNECTION_PRENOM '".$mat."', BAP_CONNECTION_NoUnite ='".$mat."', 
                    BAP_CONNECTION_Qualif ='".$mat."', BAP_CONNECTION_Mail ='".$mat."', BAP_CONNECTION_Passeword ='".$mat."', BAP_CONNECTION_TITRE ='".$mat."', BAP_CONNECTION_DROIT_GENERAL ='".$mat."', BAP_CONNECTION_DROIT_VALIDER ='".$mat."', BAP_CONNECTION_DROIT_CONSULTER ='".$mat."', 
                    BAP_CONNECTION_SOCIETE ='".$mat."', BAP_CONNECTION_COMMENTAIRES ='".$mat."', BAP_CONNECTION_TOT_CONNEXION ='".$mat."', BAP_CONNECTION_PRE_VALIDATION ='".$mat."', BAP_CONNECTION_VALIDATION ='".$mat."'
            WHERE GRAAL.Matricule ='".$mat."' ";
             $result = odbc_exec($connection, $request);

             if($result) {
                 echo 'Compte ajouté';
             } else {
                 echo 'Erreur INSERT';
             }

          } else {

            $request = "SELECT BAP_CONNECTION_MATRICULE, BAP_CONNECTION_DTE_LAST_CONN, BAP_CONNECTION_HR_LAST_CONN, BAP_CONNECTION_Nom, BAP_CONNECTION_PRENOM, BAP_CONNECTION_NoUnite, 
            BAP_CONNECTION_Qualif, BAP_CONNECTION_Mail, BAP_CONNECTION_Passeword, BAP_CONNECTION_TITRE, BAP_CONNECTION_DROIT_GENERAL, BAP_CONNECTION_DROIT_VALIDER, BAP_CONNECTION_DROIT_CONSULTER, 
            BAP_CONNECTION_SOCIETE, BAP_CONNECTION_COMMENTAIRES, BAP_CONNECTION_TOT_CONNEXION, BAP_CONNECTION_PRE_VALIDATION, BAP_CONNECTION_VALIDATION 
            FROM BAP_COMPTE_CONNECTION
            WHERE BAP_CONNECTION_MATRICULE='".$mat."'";
            $result = odbc_exec($connection, $request);

            if($result){
              while(odbc_fetch_row($result)) {
                $nom = odbc_result($result, 4);
                $prenom = odbc_result($result, 5);
                $unite = odbc_result($result, 6); 
                $qualif = odbc_result($result, 7);
                $email = odbc_result($result, 8);
                $titre = odbc_result($result, 10);
                $droitG = odbc_result($result, 11); 
                $droitValide =odbc_result($result, 12);
                $droitConsulte = odbc_result($result, 13);
                $societe = odbc_result($result, 14); 
                $commentaire = odbc_result($result, 15);
                $totcO = odbc_result($result, 16); 
                $preValide = odbc_result($result, 17); 
                $validation = odbc_result($result, 18);
              }
            } else {
                echo'Erreur SQL';
            }
          }
          ?>

          <form action="<?php echo 'update.php?mat='.$mat;?>" method="post">
            <div class="form-group">
                <label for="name">Matricule:
                <input type="text" class="form-control" name="matricule" value="<?php echo $mat;?>">                
            </div>
            <div class="form-group">
                <label for="description">Nom:
                <input type="text" class="form-control" name="nom" value="<?php echo $nom;?>">
            </div>
            <div class="form-group">
                <label for="name">Prenom:
                <input type="text" class="form-control" name="prenom" value="<?php echo $prenom;?>">                
            </div>
            <div class="form-group">
                <label for="description">Unite:
                <input type="text" class="form-control" name="unite" value="<?php echo $unite;?>">
            </div>
            <div class="form-group">
                <label for="name">Qualification:
                <input type="text" class="form-control" name="qualif" value="<?php echo $qualif;?>">                
            </div>
            <div class="form-group">
                <label for="description">Email:
                <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
            </div>
            <div class="form-group">
                <label for="description">Titre:
                <input type="text" class="form-control" name="titre" value="<?php echo $titre;?>">
            </div>
            <div class="form-group">
                <label for="name">Droit général:
                <input type="text" class="form-control" name="droitG" value="<?php echo $droitG;?>">                
            </div>
            <div class="form-group">
                <label for="description">Droit valider:
                <input type="text" class="form-control" name="droitValide" value="<?php echo $droitValide;?>">
            </div>
            <div class="form-group">
                <label for="name">Droit consulter:
                <input type="text" class="form-control" name="droitConsulte" value="<?php echo $droitConsulte;?>">                
            </div>
            <div class="form-group">
                <label for="description">Société:
                <input type="text" class="form-control" name="societe" value="<?php echo $societe;?>">
            </div>
            <div class="form-group">
                <label for="name">Commentaire:
                <input type="text" class="form-control" name="commentaire" value="<?php echo $commentaire;?>">                
            </div>
            <div class="form-group">
                <label for="description">Tot Connexion:
                <input type="text" class="form-control" name="totcO" value="<?php echo $totcO;?>">
            </div>
            <div class="form-group">
                <label for="name">Pré validation:
                <input type="text" class="form-control" name="preValide" value="<?php echo $preValide;?>">                
            </div>
            <div class="form-group">
                <label for="description">Validation:
                <input type="text" class="form-control" name="validation" value="<?php echo $validation;?>">
            </div>
            <br>
            <div class="form-actions">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
            </div>
          </form>
        <?php

        }else {
          echo'erreur URL';
        }  
        ?>
      </main>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->

  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>

  <!-- Icons -->
  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace()
  </script>

</body>

</html>