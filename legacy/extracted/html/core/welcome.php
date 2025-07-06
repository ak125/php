<?php
session_start();
// fichier de recuperation et d'affichage des parametres de la base de données
require_once('config/sql.conf.php');
// fichier de recuperation et d'affichage des parametres du site
require_once('config/meta.conf.php');

$log=$_SESSION[$sessionlog];
$mykey=$_SESSION[$sessionkey];

if(($mykey==md5("default"))||($mykey=="")||($mykey=="NULL"))
{
	$destinationLink = $accessExpiredLink;
	$ssid=0;
	$accessRequest = false;
    $destinationLinkMsg = "Expired";
    $destinationLinkGranted = 0;
}
else
{
	$query_log = "SELECT * FROM ___CONFIG_ADMIN WHERE CNFA_LOGIN='$log' AND CNFA_KEYLOG='$mykey'";
	$request_log = $conn->query($query_log);
	if ($request_log->num_rows > 0) 
	{
	$result_log = $request_log->fetch_assoc();
		if($result_log["CNFA_ACTIV"]=='1')
		{
			$destinationLink = $accessPermittedLink;
			$ssid = $result_log['CNFA_ID'];
			$accessRequest = true;
		    $destinationLinkMsg = "Granted";
		    $destinationLinkGranted = 1;
		}
		else
		{
			$destinationLink = $accessSuspendedLink;
			$ssid =0;
			$accessRequest = false;
		    $destinationLinkMsg = "Suspended";
		    $destinationLinkGranted = 0;
		}
	}
	else
	{
		$destinationLink = $accessRefusedLink;
		$ssid=0;
		$accessRequest = false;
	    $destinationLinkMsg = "Denied";
	    $destinationLinkGranted = 0;
	}
}
?>
<?php
if($accessRequest==true) 
{
///////////////////////////////////////////////////////// PAGE SESSION GRANTED /////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// PAGE SESSION GRANTED /////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// PAGE SESSION GRANTED /////////////////////////////////////////////////////////
?>
<!doctype html>
<html lang="<?php echo $hr; ?>">
<head>
<meta charset="utf-8">
<title><?php echo $domaincorename; ?></title>
<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
<!-- Données de la page d'accueil -->
<meta name="robots" content="noindex, nofollow">
<link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
<!-- CSS Bootstrap -->
<link href="<?php echo $domainparent; ?>/system/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- JS Bootstrap -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="<?php echo $domainparent; ?>/system/bootstrap/js/bootstrap.min.js"></script>
<link href="<?php echo $domain; ?>/assets/css/intern.css" rel="stylesheet">
</head>
<body>
<div id="mainPageContentCover">&nbsp;</div>
<?Php
// ENTETE DE PAGE
@require_once('header.first.section.php');
// LEFT PANEL
@require_once('header.left.section.php');
?>

<div id="mainPageContent">

	<div class="container-fluid Page-Welcome-Title">
			<h1><?php echo $domainname; ?></h1>
			<h2>Bienvenu sur votre tableau de bord</h2>
	</div>
	<div class="container-fluid Page-Welcome-Box">
		
		<div class="row text-center w-100">
			<!-- LISTE DEPARTEMENTS AUTORISES -->
			<br><br><b>Cliquez sur l'icone menu en haut à gauche de votre écran pour accéder à votre liste de gestion.</b>
			<!-- / LISTE DEPARTEMENTS AUTORISES -->
		</div>	

	</div>

</div>

<?Php
// PIED DE PAGE
@require_once('footer.last.section.php');
?>
</body>
</html>
<?php
///////////////////////////////////////////////////////// FIN PAGE SESSION GRANTED /////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// FIN PAGE SESSION GRANTED /////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// FIN PAGE SESSION GRANTED /////////////////////////////////////////////////////////
}
else
{
	//header("Location: ".$destinationLink);
	include("get.access.response.php");
}
?>