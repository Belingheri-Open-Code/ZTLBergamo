<head>
	<?php
	$servername = "localhost";
$username = "ztlbergamo";
$password = "riccardo123";
$dbname = "ztlbergamo";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo "<script>alert('problema interno');</script>";
}
$attData=date("Y-m-d");
$sql = "UPDATE ultimoaccesso SET data='".$attData."' WHERE pagina='".$_SESSION["dove"]."'";
if ($conn->query($sql) !== TRUE) {
    echo "<script>alert('problema interno ".$conn->error."');</script>";
} 
$conn->close();
	?>
	<title>ZTL Bergamo -Belingheri</title>
	<meta charset="UTF-8">
	<link rel="icon" href="/favicon.ico">
	<META NAME="KEYWORDS" CONTENT="ztl,bergamo,zona a traffico limitato,traffico limitato ,ztl bergamo, zone a traffico limitato bergamo,zone traffico limitato bergamo">
	<meta name="description" content="Stanco di prendere multe? Consulta ora in modo completamente gratuito le zone ZTL attive ORA a Bergamo! TUTTE le ZTL in Bergamo">
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<style>
	p{
		font-size: 13pt;
	}
	body {
	background-color: #eee;
	}
	.form-control, .list-group-item {
	color:white;
	background-color:#222;
	}
	</style>