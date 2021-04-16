<?php
$serverName = "srv-salsaprod2";

$connectionInfo = array("Database"=>"SI_RH", "UID"=>"sa", "PWD"=>"74O@zP\$mig7");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( !$conn ) {
  echo "La connexion avec SQL Server n'a pu être établie.<br />";
  die( print_r( sqlsrv_errors(), true));
}

$connection = odbc_connect("BAP_Gucci", "", "") OR die(odbc_error());
$hfsqlData = '';

if (!$connection) {
  echo "Impossible d'établir une connexion avec HFSQL" . "<br/>"; 
} 

?>