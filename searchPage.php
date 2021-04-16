<?php
  require 'database.php';

  if (isset($_GET["sub"]) && !empty($_GET["search"])) {  
    $_GET["search"] = htmlspecialchars($_GET["search"]);
    $search = $_GET["search"];  
    $search = trim($search);
    $search = strip_tags($search);
    
    if (isset($search)) {  
      $search = ucwords($search);
      $sql = "SELECT SI_RH.ADP_SAL_MAT, SI_RH.ADP_SAL_NOM, SI_RH.ADP_SAL_PRENOM, SI_RH.ADP_SAL_MAIL_COALLIA, OSCAR.Cpte_Matricule, GRAAL.Matricule 
        FROM SI_RH.dbo.Salaries_ADP_Imp_Jour AS SI_RH 
        LEFT JOIN OSCAR.dbo.Compte AS OSCAR ON SI_RH.ADP_SAL_MAT = OSCAR.Cpte_Matricule
        LEFT JOIN GRAAL.dbo.Compte AS GRAAL ON SI_RH.ADP_SAL_MAT = GRAAL.Matricule
        WHERE SI_RH.ADP_SAL_MAT LIKE ? OR SI_RH.ADP_SAL_NOM LIKE ? OR SI_RH.ADP_SAL_PRENOM LIKE ?";
      $params = array("%".$search."%", "%".$search."%", "%".$search."%");
      $stmt = sqlsrv_query( $conn, $sql, $params);
      if( $stmt === false ) {
        die( print_r( sqlsrv_errors(), true));
      } else {
?>

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
    <form action="searchPage.php" method="get" class="form-inline" >
      <input class="form-control form-control-dark w-100" type="search" placeholder="Recherche" id="search"
        name="search" aria-label="Search">
      <button class="btn btn-outline-primary my-2 my-sm-0" id="sub" name="sub" type="submit">Valider</button>
    </form>
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
          <h1 class="h2">Votre recherche</h1>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Matricule</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>OSCAR</th>
                <th>GRAAL</th>
                <th>BAP</th>
                <th>IGLOO</th>
              </tr>
            </thead>
            <tbody>
              <?php

              $request = "SELECT BAP_CONNECTION_MATRICULE FROM BAP_COMPTE_CONNECTION";
              $result = odbc_exec($connection, $request);
              $dataHfsql = [];

              while(odbc_fetch_row($result)) {
                $dataHfsql[] = odbc_result($result, 1);
              }

              while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                $isBAP = false;
                $matBAP = '';

                echo '<tr>';
                echo '<td>'. $row["ADP_SAL_MAT"] . '</td>';
                echo '<td>'. $row["ADP_SAL_NOM"] . '</td>';
                echo '<td>'. $row["ADP_SAL_PRENOM"] . '</td>';
                echo '<td>'. $row["ADP_SAL_MAIL_COALLIA"] . '</td>';
                if ($row["Cpte_Matricule"]) {
                  echo '<td class="table-success"><a href="viewOscar.php?mat='.$row['Cpte_Matricule'].'"><span data-feather="check"></span></a></td>';
                }else{
                  echo '<td class="table-danger"><a href="addOscar.php?mat='.$row['ADP_SAL_MAT'].'&amp;nom='.$row['ADP_SAL_NOM'].'&amp;prenom='.$row['ADP_SAL_PRENOM'].'&amp;email='.$row['ADP_SAL_MAIL_COALLIA'].'"><span data-feather="x"></span></a></td>';
                }
                if ($row["Matricule"]) {
                  echo '<td class="table-success"><a href="viewGraal.php?mat='.$row['Matricule'].'"><span data-feather="check"></span></a></td>';
                }else{
                  echo '<td class="table-danger"><a href="addGraal.php?mat='.$row['ADP_SAL_MAT'].'&amp;nom='.$row['ADP_SAL_NOM'].'&amp;prenom='.$row['ADP_SAL_PRENOM'].'&amp;email='.$row['ADP_SAL_MAIL_COALLIA'].'"><span data-feather="x"></span></a></td>';
                }

                foreach($dataHfsql as $mat) {
                  if($row["ADP_SAL_MAT"] == $mat) {
                    $isBAP = true;
                    $matBAP = $mat;
                  }
                }

                if($isBAP) {
                  echo '<td class="table-success"><a href="php/viewBap.php?mat='.$matBAP.'"><span data-feather="check"></span></a></td>';
                } else {
                  echo '<td class="table-danger"><a href="php/addBap.php?mat='.$row['ADP_SAL_MAT'].'"><span data-feather="x"></span></a></td>';
                }
                echo '<td></td>';           
                echo '</tr>';
              }
            }  
          }
        }
        sqlsrv_free_stmt( $stmt); 
            ?>
            </tbody>
          </table>
        </div>
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