<?php
session_start();
// fichier de recuperation et d'affichage des parametres de la base de données
require_once('../config/sql.conf.php');
// fichier de recuperation et d'affichage des parametres du site
require_once('../config/meta.conf.php');

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
	$query_log = "SELECT * FROM ___CONFIG_ADMIN WHERE CNFA_LOGIN='$log' AND CNFA_KEYLOG='$mykey' AND CNFA_LEVEL > 6";
	$request_log = $conn->query($query_log);
	if ($request_log->num_rows > 0) 
	{
	$result_log = $request_log->fetch_assoc();
		if($result_log["CNFA_ACTIV"]=='1')
		{
			$destinationLink = $accessPermittedLink;
            $ssid = $result_log['CNFA_ID'];
            $sslevel = $result_log['CNFA_LEVEL'];
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
// Department DATAS
$aliasDepartment = getDepartmentAlias();

if ($rsverifPrivilege=1)
{
$dept_id=7;
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
<!-- Data Table -->
<script src="<?php echo $domainparent; ?>/system/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $domainparent; ?>/system/datatables/dataTables.bootstrap4.min.js"></script>
<link href="<?php echo $domainparent; ?>/system/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- CSS -->
<link href="<?php echo $domain; ?>/assets/css/intern.css" rel="stylesheet">
</head>
<body>

&lt;urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"&gt;
<br>
	<?php 
	$query_marque = "SELECT MARQUE_ALIAS, MARQUE_ID 
		FROM AUTO_MARQUE  
	    WHERE MARQUE_DISPLAY = 1";
	$request_marque = $conn->query($query_marque);
	while($result_marque = $request_marque->fetch_assoc())
	{
		$marque_id = $result_marque['MARQUE_ID'];
	?>
	&lt;url&gt;
	<br>
		&lt;loc&gt;https://www.automecanik.com/constructeurs/<?php echo $result_marque['MARQUE_ALIAS']; ?>-<?php echo $result_marque['MARQUE_ID']; ?>.html&lt;/loc&gt;
	<br>
		&lt;lastmod&gt;<?php echo date('Y-m-d'); ?>&lt;/lastmod&gt;
	<br>
		&lt;priority&gt;1.0&lt;/priority&gt;
	<br>
	&lt;/url&gt;
	<br>
	<?php
		$query_motorisation = "SELECT TYPE_ID, TYPE_ALIAS, MODELE_ID, MODELE_ALIAS
			FROM AUTO_TYPE 
			JOIN AUTO_MODELE ON MODELE_ID = TYPE_MODELE_ID
			JOIN AUTO_MARQUE ON MARQUE_ID = TYPE_MARQUE_ID
			WHERE TYPE_MARQUE_ID = $marque_id 
			AND TYPE_DISPLAY = 1 AND MODELE_DISPLAY = 1 AND TYPE_RELFOLLOW = 1";
		$request_motorisation = $conn->query($query_motorisation);
		while($result_motorisation = $request_motorisation->fetch_assoc())
		{
		?>
		&lt;url&gt;
		<br>
			&lt;loc&gt;https://www.automecanik.com/constructeurs/<?php echo $result_marque['MARQUE_ALIAS']; ?>-<?php echo $result_marque['MARQUE_ID']; ?>/<?php echo $result_motorisation['MODELE_ALIAS']; ?>-<?php echo $result_motorisation['MODELE_ID']; ?>/<?php echo $result_motorisation['TYPE_ALIAS']; ?>-<?php echo $result_motorisation['TYPE_ID']; ?>.html&lt;/loc&gt;
		<br>
			&lt;lastmod&gt;<?php echo date('Y-m-d'); ?>&lt;/lastmod&gt;
		<br>
			&lt;priority&gt;1.0&lt;/priority&gt;
		<br>
		&lt;/url&gt;
		<br>
		<?php	
		}
	}
	?>
&lt;/urlset&gt;

</body>
</html>
<?php
///////////////////////////////////////////////////////// FIN PAGE SESSION GRANTED /////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// FIN PAGE SESSION GRANTED /////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// FIN PAGE SESSION GRANTED /////////////////////////////////////////////////////////
}
else
{
	include("../get.access.response.no.privilege.php");
}

}
else
{
	//header("Location: ".$destinationLink);
	include("../get.access.response.php");
}
?>