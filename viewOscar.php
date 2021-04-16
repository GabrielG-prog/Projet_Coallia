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
          <h1 class="h2">Voir un compte OSCAR</h1>
        </div>
        <?php
        require 'database.php';

        $mat='';
        if(isset($_GET["mat"])) {

          $mat = $_GET["mat"];

          $sql = "SELECT OSCAR.Cpte_Matricule, OSCAR.Cpte_Nom, OSCAR.Cpte_Prenom, OSCAR.Cpte_Email, OSCAR.Cpte_Service, OSCAR.Cpte_Fonction, OSCAR.Cpte_DUT, OSCAR.Cpte_Region 
            FROM OSCAR.dbo.Compte AS OSCAR
            WHERE OSCAR.Cpte_Matricule = ?";
          $params = array($mat);
          $stmt = sqlsrv_query( $conn, $sql, $params);

          if( $stmt === false ) {
            die( print_r( sqlsrv_errors(), true));
          } else {
            while( $item = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
          ?>

          <form>
            <div class="form-group">
              <label>Matricule:</label><?php echo '  '.$item['Cpte_Matricule'];?>
            </div>
            <div class="form-group">
              <label>Nom:</label><?php echo '  '.$item['Cpte_Nom'];?>
            </div>
            <div class="form-group">
              <label>Prenom:</label><?php echo '  '.$item['Cpte_Prenom'];?>
            </div>
            <div class="form-group">
              <label>Email:</label><?php echo '  '.$item['Cpte_Email'];?>
            </div>
            <div class="form-group">
              <label>Service:</label><?php echo '  '.$item['Cpte_Service'];?>
            </div>
            <div class="form-group">
              <label>Fonction:</label><?php echo '  '.$item['Cpte_Fonction'];?>
            </div>
            <div class="form-group">
              <label>DUT:</label><?php echo '  '.$item['Cpte_DUT'];?>
            </div>
            <div class="form-group">
              <label>Region:</label><?php echo '  '.$item['Cpte_Region'];?>
            </div>
          </form>
        <?php
            }
          }
          echo'<a class="btn btn-primary" href="editOscar.php?mat='.$mat.'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
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