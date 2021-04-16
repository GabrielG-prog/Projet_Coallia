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
          <h1 class="h2">Ajouter un compte BAP</h1>
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

                if(isset($_POST['unite']) && isset($_POST['qualif']) && isset($_POST['titre']) && isset($_POST['droitG']) && isset($_POST['droitValide']) && isset($_POST['droitConsulte']) && isset($_POST['societe']) && isset($_POST['commentaire']) && isset($_POST['totCo'])){
            
                    $date = '20200101';
                    $heure = '1556';
                    $unite = $_POST['unite']; 
                    $qualif = $_POST['qualif'];
                    $password = '1725456010';
                    $titre = $_POST['titre']; 
                    $droitG = $_POST['droitG']; 
                    $droitValide = $_POST['droitValide'];
                    $droitConsulter = $_POST['droitConsulte'];
                    $societe = $_POST['societe']; 
                    $commentaire = $_POST['commentaire'];
                    $totcO = $_POST['totCo']; 
                    $preValide = (isset($_POST['preValide'])) ? 1 : 0; 
                    $validation = (isset($_POST['validation'])) ? 1 : 0;

                    $request = "INSERT INTO BAP_COMPTE_CONNECTION (BAP_CONNECTION_MATRICULE, BAP_CONNECTION_DTE_LAST_CONN, BAP_CONNECTION_HR_LAST_CONN, BAP_CONNECTION_Nom, BAP_CONNECTION_PRENOM, BAP_CONNECTION_NoUnite, 
                    BAP_CONNECTION_Qualif, BAP_CONNECTION_Mail, BAP_CONNECTION_Passeword, BAP_CONNECTION_TITRE, BAP_CONNECTION_DROIT_GENERAL, BAP_CONNECTION_DROIT_VALIDER, BAP_CONNECTION_DROIT_CONSULTER, 
                    BAP_CONNECTION_SOCIETE, BAP_CONNECTION_COMMENTAIRES, BAP_CONNECTION_TOT_CONNEXION, BAP_CONNECTION_PRE_VALIDATION, BAP_CONNECTION_VALIDATION)  
                    VALUES ($mat, $date, $heure, $nom, $prenom, $unite, $qualif, $email, $password, $titre, $droitG, $droitValide, $droitConsulter, $societe, $commentaire, $totcO, $preValide, $validation)";
                    $result = odbc_exec($connection, $request);

                    if($result) {
                        echo 'compte ajouté';
                    } else {
                        echo 'Erreur INSERT';
                    }
                }
            }
          } else {
            echo 'erreur URL';
          }

        ?>
        <div class="col-md-8 order-md-1">
            <form action="index.php" method="post">
                <p>N° unite : <input type="text" name="unite" /></p>
                <p>Qualif : <input type="text" name="qualif" /></p>
                <p>Titre : <input type="text" name="titre" /></p>
                <p>Droit général : <input type="text" name="droitG" /></p>
                <p>Droit valider : <input type="text" name="droitValide" /></p>
                <p>Droit Consulter : <input type="text" name="droitConsulte" /></p>
                <p>Société : <input type="text" name="societe" /></p>
                <p>Commentaire : <input type="text" name="commentaire" /></p>
                <p>TOT connexion : <input type="number" name="totCo" /></p>
                <p>Pre validation <input type="checkbox" name="preValide" id="preValide" /></p>
                <p>Validation <input type="checkbox" name="validation" id="validation" /></p>
                <p><input type="submit" value="Valider" /></p>
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