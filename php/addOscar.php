<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../images/coallia-squarelogo-1408465071664.png">

  <title>GUCCI</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="../css/styles.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">GUCCI</a>
    <input class="form-control form-control-dark w-100" type="search" placeholder="Recherche" aria-label="Search">
    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Valider</button>

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
              <a class="nav-link active" href="#">
                <span data-feather="users"></span>
                Les comptes <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                L'historique
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="bar-chart-2"></span>
                Les logs
              </a>
            </li>
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Filtres</span>
            <a class="d-flex align-items-center text-muted" href="#">
              <span data-feather="filter"></span>
            </a>
          </h6>
          <div class="btn-group-vertical">
            <div class="dropdown">
              <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Matricule
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Croissant</a>
                <a class="dropdown-item" href="#">Décroissant</a>
              </div>
            </div>
            <div class="dropdown">
              <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Nom
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Croissant</a>
                <a class="dropdown-item" href="#">Décroissant</a>
              </div>
            </div>
            <div class="dropdown">
              <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Prénom
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Croissant</a>
                <a class="dropdown-item" href="#">Décroissant</a>
              </div>
            </div>
          </div>
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Ajouter un compte OSCAR</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
              <button class="btn btn-sm btn-outline-secondary">Partager</button>
              <button class="btn btn-sm btn-outline-secondary">Exporter</button>
            </div>
          </div>
        </div>
        <?php
          require 'database.php';

          if (isset($_GET["mat"])) {

            $mat = $_GET["mat"];

            $sqlSirh = "SELECT SI_RH.ADP_SAL_NOM, SI_RH.ADP_SAL_PRENOM, SI_RH.ADP_SAL_MAIL_COALLIA 
            FROM SI_RH.dbo.Salaries_ADP_Imp_Jour AS SI_RH
            WHERE SI_RH.ADP_SAL_MAT = ?";
            $paramSirh = array($mat);
            $stmtSirh = sqlsrv_query( $conn, $sqlSirh, $paramSirh);

            $nom='';
            $prenom='';
            $email='';
  
            if( $stmtSirh === false ) {
              die( print_r( sqlsrv_errors(), true));
            } else {
              while( $row = sqlsrv_fetch_array( $stmtSirh, SQLSRV_FETCH_ASSOC) ) {
                $nom = $row['ADP_SAL_NOM'];
                $prenom = $row['ADP_SAL_PRENOM'];
                $email = $row['ADP_SAL_MAIL_COALLIA'];
              }

              if(isset($_POST['service']) && isset($_POST['fonction']) && isset($_POST['dut']) && isset($_POST['region'])) {
                $service   = $_POST['service'];
                $fonction  = $_POST['fonction'];
                $dut       = $_POST['dut'];
                $region    = $_POST['region']; 
              
                $sql = "INSERT INTO OSCAR.dbo.Compte (Cpte_matricule, Cpte_Nom, Cpte_Prenom, Cpte_Email, Cpte_Dte_Conn, Cpte_Nbres_Conn, Cpte_Service, Cpte_Fonction, Cpte_DUT, Cpte_Region) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $params = array($mat, $nom, $prenom, $email, null, null, $service, $fonction, $dut, $region);
                $stmt = sqlsrv_query( $conn, $sql, $params);

                if( $stmt === false ) {
                  die( print_r( sqlsrv_errors(), true));
                } else {
                  echo'Compte ajouté';
                }
          
              }
            }
          } else {
            echo 'erreur URL';
          }

        ?>
        <div class="col-md-8 order-md-1">
          <form class="form" action="addOscar.php" method="post">
            <div class="mb-3">
              <input type="text" class="form-control" name="service" placeholder="Service">
            </div>

            <div class="mb-3">
              <input type="text" class="form-control" name="fonction" placeholder="Fonction">
            </div>

            <div class="mb-3">
              <input type="number" class="form-control" name="dut" placeholder="DUT">
            </div>

            <div class="mb-3">
              <input type="number" class="form-control" name="region" placeholder="Region">
            </div>
            
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Ajouter</button>
          </form>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
          <p class="mb-1">&copy; 2020-2021 GUCCI</p>
        </footer>
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