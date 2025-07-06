<?php
session_start();
session_destroy();
session_start();
// fichier de recuperation et d'affichage des parametres de la base de données
require_once('config/sql.conf.php');
// fichier de recuperation et d'affichage des parametres du site
require_once('config/meta.conf.php');

$log=$_POST['userlog'];
$mp=$_POST['userpswd'];
$mpcrypt = crypt(md5($mp),$pswdctyptogram);
$destinationLinkGranted = 0;
$query_log = "SELECT * FROM ___CONFIG_ADMIN WHERE CNFA_LOGIN='$log' AND CNFA_PSWD='$mpcrypt'";
$request_log = $conn->query($query_log);
if ($request_log->num_rows > 0) 
{
$result_log = $request_log->fetch_assoc();
	if($result_log["CNFA_ACTIV"]=='1')
	{
		//enregistrement sur session
		$_SESSION[$sessionlog]=$log;
		$_SESSION[$sessionkey]=md5($result_log["CNFA_MAIL"]);
	    $destinationLink = $accessPermittedLink;
	    $destinationLinkMsg = "Granted";
	    $destinationLinkGranted = 1;
	}
	else
	{
		// enregistrement d'une fausse session
		$_SESSION[$sessionlog]="default";
		$_SESSION[$sessionkey]=md5("default");
		$destinationLink = $accessSuspendedLink;
	    $destinationLinkMsg = "Suspended";
	    $destinationLinkGranted = 0;
	}
}
else
{
	// enregistrement d'une fausse session
	$_SESSION[$sessionlog]="default";
	$_SESSION[$sessionkey]=md5("default");
	$destinationLink = $accessRefusedLink;
	$destinationLinkMsg = "Refused";
	$destinationLinkGranted = 0;
}

//header("Location: ".$destinationLink);
include("get.access.response.php");
?>