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
          <h1 class="h2">Modifier un compte GRAAL</h1>
        </div>
        <?php
        require 'database.php';

        $mat='';
        if(isset($_GET["mat"])) {

          $mat = $_GET["mat"];
          $nom = '';
            $prenom = '';
            $email = '';
            $noUt = '';
            $role = '';

          if(!empty($_POST)) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $noUt = $_POST['noUt'];
            $role = $_POST['role'];

            $sql = "UPDATE GRAAL.dbo.Compte AS GRAAL 
            SET  GRAAL.Matricule = ?, GRAAL.Nom = ?, GRAAL.Prenom = ?, GRAAL.Email = ?, GRAAL.NoUt = ?, GRAAL.Role = ?
            WHERE GRAAL.Matricule = ?";
            $params = array($mat, $nom, $prenom, $email, $noUt, $role);
            $stmt = sqlsrv_query( $conn, $sql, $params);

            if( $stmt === false ) {
                die( print_r( sqlsrv_errors(), true));
            } else {
                echo'Compte modifier';
            }

          } else {

            $sql = "SELECT GRAAL.Matricule, GRAAL.Nom, GRAAL.Prenom, GRAAL.Email, GRAAL.NoUt, GRAAL.Role
            FROM GRAAL.dbo.Compte AS GRAAL
            WHERE GRAAL.Matricule = ?";
            $params = array($mat);
            $stmt = sqlsrv_query( $conn, $sql, $params);

            if( $stmt === false ) {
                die( print_r( sqlsrv_errors(), true));
            } else {
                
                while( $item = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                    $nom = $item['Nom'];
                    $prenom = $item['Prenom'];
                    $email = $item['Email'];
                    $noUt = $item['NoUt'];
                    $Role = $item['Role'];
                }
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
                <label for="description">Email:
                <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
            </div>
            <div class="form-group">
                <label for="name">N° UT:
                <input type="text" class="form-control" name="noUt" value="<?php echo $noUt;?>">                
            </div>
            <div class="form-group">
                <label for="description">Role:
                <input type="text" class="form-control" name="role" value="<?php echo $role;?>">
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