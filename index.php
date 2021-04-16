<?php
  require 'php/database.php';

  // On détermine sur quelle page on se trouve
  if(isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int) strip_tags($_GET['page']);
  }
  else {
    $currentPage = 1;
  }

  // On détermine le nombre total de salarié
  $sqlcount = "SELECT COUNT (*) AS nb_salarie FROM SI_RH.dbo.Salaries_ADP_Imp_Jour";
  $stmtCount = sqlsrv_query( $conn,  $sqlcount );
  $rowCount = sqlsrv_fetch_array( $stmtCount, SQLSRV_FETCH_ASSOC);
  $nbSalarie = (int) $rowCount['nb_salarie'];
  
  // On détermine le nombre d'articles par page
  $perPage = 190;

  // On calcule le nombre de pages total
  $nbPage = ceil($nbSalarie / $perPage);
  
  sqlsrv_free_stmt( $stmtCount);
  // Mise en place de la pagination
  
  /*$pageCalc = ($currentPage-1)*$perPage;*/
  $pageCalc = ($currentPage * $perPage) - $perPage;

  $sql = "SELECT SI_RH.ADP_SAL_MAT, SI_RH.ADP_SAL_NOM, SI_RH.ADP_SAL_PRENOM, SI_RH.ADP_SAL_MAIL_COALLIA, OSCAR.Cpte_Matricule, GRAAL.Matricule 
  FROM SI_RH.dbo.Salaries_ADP_Imp_Jour AS SI_RH 
  LEFT JOIN OSCAR.dbo.Compte AS OSCAR ON SI_RH.ADP_SAL_MAT = OSCAR.Cpte_Matricule
  LEFT JOIN GRAAL.dbo.Compte AS GRAAL ON SI_RH.ADP_SAL_MAT = GRAAL.Matricule
  ORDER BY SI_RH.ADP_SAL_MAT 
  OFFSET ? ROWS
  FETCH NEXT ? ROWS ONLY";

  $params = array($pageCalc, $perPage);
    
  $stmt = sqlsrv_query( $conn, $sql, $params );
  
  if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
  }
  
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
    <form action = "php/searchPage.php" method = "get" class="form-inline">
      <input class="form-control form-control-dark w-100" type="search" placeholder="Recherche" id="search" name="search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <button class="btn btn-outline-primary" id="sub" name="sub" type="submit">Valider</button> 
        </li>
      </ul>
    </form>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="index.php">
                <span data-feather="users"></span>
                Les comptes <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="php/history.php">
                <span data-feather="file-text"></span>
                L'historique
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="php/log.php">
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
              <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                OSCAR
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Croissant</a>
                <a class="dropdown-item" href="#">Décroissant</a>
              </div>
            </div>
            <div class="dropdown">
              <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                GRAAL
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Croissant</a>
                <a class="dropdown-item" href="#">Décroissant</a>
              </div>
            </div>
            <div class="dropdown">
              <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                BAP
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Croissant</a>
                <a class="dropdown-item" href="#">Décroissant</a>
              </div>
            </div>
            <div class="dropdown">
              <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                IGLOO
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
          <h1 class="h2">Les comptes</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
              <button class="btn btn-sm btn-outline-secondary">Partager</button>
              <button class="btn btn-sm btn-outline-secondary">Exporter</button>
            </div>
          </div>
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
            
              while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $isBAP = false;
                $matBAP = '';

                echo '<tr>';
                echo '<td>'.$row["ADP_SAL_MAT"].'</td>';
                echo '<td>'.$row["ADP_SAL_NOM"].'</td>';
                echo '<td>'.$row["ADP_SAL_PRENOM"].'</td>';
                echo '<td>'.$row["ADP_SAL_MAIL_COALLIA"].'</td>';
  
                if($row["Cpte_Matricule"]) {
                  echo '<td class="table-success"><a href="php/viewOscar.php?mat='.$row['Cpte_Matricule'].'"><span data-feather="check"></span></a></td>';
                } else {
                  echo '<td class="table-danger"><a href="php/addOscar.php?mat='.$row['ADP_SAL_MAT'].'"><span data-feather="x"></span></a></td>';
                }

                if($row["Matricule"]) {
                  echo '<td class="table-success"><a href="php/viewGraal.php?mat='.$row['Matricule'].'"><span data-feather="check"></span></a></td>';
                } else {
                  echo '<td class="table-danger"><a href="php/addGraal.php?mat='.$row['ADP_SAL_MAT'].'"><span data-feather="x"></span></a></td>';
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
                echo'<td></td>';
                echo '</tr>';
              }
            ?>      
            </tbody>
          </table>
          <nav>
            <ul class="pagination">
              <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                <a href="./?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
              </li>
              <?php for($page = 1; $page <= $nbPage; $page++): ?>
              <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                <a href="./?page=<?= $page ?>" class="page-link"><?= $page ?></a>
              </li>
              <?php endfor ?>
              <li class="page-item <?= ($currentPage == $nbPage) ? "disabled" : "" ?>">
                <a href="./?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
              </li>
            </ul>
          </nav>
        </div>
      </main>
    </div>
  </div>

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