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
          <h1 class="h2">Voir un compte BAP</h1>
        </div>
        <?php
        require 'database.php';
 
        if (isset($_GET["mat"])) {

          $mat = $_GET["mat"];

            $request = "SELECT BAP_CONNECTION_MATRICULE, BAP_CONNECTION_NoM, BAP_CONNECTION_PRENOM, BAP_CONNECTION_NoUnite, BAP_CONNECTION_Mail, BAP_CONNECTION_TITRE, BAP_CONNECTION_DROIT_GENERAL, BAP_CONNECTION_SOCIETE, BAP_CONNECTION_TOT_CONNEXION, BAP_CONNECTION_PRE_VALIDATION, BAP_CONNECTION_VALIDATION 
            FROM BAP_COMPTE_CONNECTION
            WHERE BAP_CONNECTION_MATRICULE='".$mat."'";
            $result = odbc_exec($connection, $request);

            if($result){
              while(odbc_fetch_row($result)) {
                ?>
                <form>
                  <div class="form-group">
                    <label>Matricule:</label><?php echo '  '.odbc_result($result, 1);?>
                  </div>
                  <div class="form-group">
                    <label>Nom:</label><?php echo '  '.odbc_result($result, 2);?>
                  </div>
                  <div class="form-group">
                    <label>Prenom:</label><?php echo '  '.odbc_result($result, 3);?>
                  </div>
                  <div class="form-group">
                    <label>N° unité:</label><?php echo '  '.odbc_result($result, 4);?>
                  </div>
                  <div class="form-group">
                    <label>Email:</label><?php echo '  '.odbc_result($result, 5);?>
                  </div>
                  <div class="form-group">
                    <label>Titre:</label><?php echo '  '.odbc_result($result, 6);?>
                  </div>
                  <div class="form-group">
                    <label>Droit Général:</label><?php echo '  '.odbc_result($result, 7);?>
                  </div>
                  <div class="form-group">
                    <label>Connexion société:</label><?php echo '  '.odbc_result($result, 8);?>
                  </div>
                  <div class="form-group">
                    <label>TOT Connexion:</label><?php echo '  '.odbc_result($result, 9);?>
                  </div>
                  <div class="form-group">
                    <label>Pré validation:</label><?php echo '  '.odbc_result($result, 10);?>
                  </div>
                  <div class="form-group">
                    <label>Validation:</label><?php echo '  '.odbc_result($result, 11);?>
                  </div>
                </form>
              <?php
              }
              echo'<a class="btn btn-primary" href="editBAP.php?mat='.$mat.'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
            } else {
              echo'Erreur execution SQL';
            }
        }else {
          echo'Erreur URL';
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