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
$pageH1 = "Liste des commandes en cours...";
$pageH2 = "Département Expedition";
$dept_id=3;
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
<div id="mainPageContentCover">&nbsp;</div>
<?Php
// ENTETE DE PAGE
@require_once('../header.first.section.php');
// LEFT PANEL
@require_once('../header.left.section.php');
?>

<div id="mainPageContent">
<div class="container-fluid Page-Welcome-Title">

	<div class="row">
		<div class="col-10 PANEL-LEFT align-self-center pt-3">
			<br><h1><?php echo $pageH1; ?></h1>
            <h2><?php echo $pageH2; ?></h2>
		</div>
		<div class="col-2 PANEL-LEFT align-self-center">
			&nbsp;
		</div>
	</div>

</div>
<div class="container-fluid Page-Welcome-Box">

<!-- CONTENU DE LA PAGE -->
<div class="row">
<div class="col-12 PANEL-LEFT">

<!-- LISTE COMMANDES --><!-- LISTE COMMANDES --><!-- LISTE COMMANDES --><!-- LISTE COMMANDES -->
<!-- LISTE COMMANDES --><!-- LISTE COMMANDES --><!-- LISTE COMMANDES --><!-- LISTE COMMANDES -->
<!-- LISTE COMMANDES --><!-- LISTE COMMANDES --><!-- LISTE COMMANDES --><!-- LISTE COMMANDES -->
<!-- LISTE COMMANDES --><!-- LISTE COMMANDES --><!-- LISTE COMMANDES --><!-- LISTE COMMANDES -->
<!-- LISTE COMMANDES --><!-- LISTE COMMANDES --><!-- LISTE COMMANDES --><!-- LISTE COMMANDES -->
<?php
$query_commande_list = "SELECT ORD_ID, ORD_DATE, ORD_DATE_PAY, ORD_INFO,  
    ORD_AMOUNT_TTC, ORD_DEPOSIT_TTC, ORD_SHIPPING_FEE_TTC, ORD_TOTAL_TTC, 
    ORD_CST_ID, CST_CIVILITY, CST_NAME, CST_FNAME, CST_ADDRESS, CST_ZIP_CODE, CST_CITY, CST_COUNTRY, 
    CST_TEL, CST_GSM, CST_MAIL, 
    ORD_CBA_ID, CBA_CIVILITY, CBA_NAME, CBA_FNAME, CBA_ADDRESS, CBA_ZIP_CODE, CBA_CITY, CBA_COUNTRY, 
    ORD_CDA_ID, CDA_CIVILITY, CDA_NAME, CDA_FNAME, CDA_ADDRESS, CDA_ZIP_CODE, CDA_CITY, CDA_COUNTRY
    FROM ___XTR_ORDER 
    JOIN ___XTR_CUSTOMER ON CST_ID = ORD_CST_ID AND CST_ACTIV = 1
    JOIN ___XTR_CUSTOMER_BILLING_ADDRESS ON CBA_ID = ORD_CBA_ID 
    JOIN ___XTR_CUSTOMER_DELIVERY_ADDRESS ON CDA_ID = ORD_CDA_ID 
    WHERE ORD_IS_PAY = 1 AND ORD_DEPT_ID = $dept_id
    ORDER BY ORD_DATE DESC";
$request_commande_list = $conn->query($query_commande_list);
if ($request_commande_list->num_rows > 0) 
{
?>
<div class="row">
<?php
while($result_commande_list = $request_commande_list->fetch_assoc())
{
$ord_id_this = $result_commande_list['ORD_ID'];
$cst_id_this = $result_commande_list['ORD_CST_ID'];
?>  
<div class="col-4 p-1">


<div class="container-fluid order-list-content">
<a href="<?php echo $domain; ?>/<?php echo $aliasDepartment; ?>/<?php echo $ord_id_this; ?>"> 

    <div class="row p-0 m-0 cyan">  
        <div class="col-12 order-header-bloc align-self-center">
            Commande n° <span><?php echo $ord_id_this; ?>/A</span>
        </div> 
    </div>

    <div class="row p-0 m-0">
        <div class="col-12 order-first-bloc">
                <b>DC</b> : <?php echo date('d/m/Y',strtotime($result_commande_list['ORD_DATE'])); ?>
                &nbsp;
                <b>DP</b> : <?php echo date('d/m/Y',strtotime($result_commande_list['ORD_DATE_PAY'])); ?>
        </div>
        <div class="col-12 order-first-bloc">
                <b><u>Commandée par :</u></b>
                <br>
                <?php echo $result_commande_list['CST_CIVILITY']; ?> <?php echo $result_commande_list['CST_NAME']; ?> 
                <?php echo $result_commande_list['CST_FNAME']; ?>
                <br>
                <?php echo $result_commande_list['CST_ADDRESS']; ?> - <?php echo $result_commande_list['CST_ZIP_CODE']; ?> 
                <?php echo $result_commande_list['CST_CITY']; ?>, <?php echo $result_commande_list['CST_COUNTRY']; ?>
        </div>
        <div class="col-12 order-first-bloc">
                <b><u>Coordonnées de contact :</u></b><br>
                <?php echo $result_commande_list['CST_TEL']; ?> / <?php echo $result_commande_list['CST_GSM']; ?>
                <br>
                <?php echo $result_commande_list['CST_MAIL']; ?>
        </div>
    </div>

</a>
</div>

</div>
<?php
}
?>
</div>
<?php
}
else
{
?>
<div class="container-fluid order-list-no-content">
    <div class="row">
        <div class="col-12 text-center p-3">
        Vous n'avez aucune commande pour le moment.
        </div>
    </div>
</div>
<?php
}
?>
<!-- END LISTE COMMANDES --><!-- END LISTE COMMANDES --><!-- END LISTE COMMANDES --><!-- END LISTE COMMANDES -->
<!-- END LISTE COMMANDES --><!-- END LISTE COMMANDES --><!-- END LISTE COMMANDES --><!-- END LISTE COMMANDES -->
<!-- END LISTE COMMANDES --><!-- END LISTE COMMANDES --><!-- END LISTE COMMANDES --><!-- END LISTE COMMANDES -->
<!-- END LISTE COMMANDES --><!-- END LISTE COMMANDES --><!-- END LISTE COMMANDES --><!-- END LISTE COMMANDES -->
<!-- END LISTE COMMANDES --><!-- END LISTE COMMANDES --><!-- END LISTE COMMANDES --><!-- END LISTE COMMANDES -->

</div>
</div>
<!-- / CONTENU DE LA PAGE -->

</div>
</div>

<?Php
// PIED DE PAGE
@require_once('../footer.last.section.php');
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
	include("../get.access.response.no.privilege.php");
}

}
else
{
	//header("Location: ".$destinationLink);
	include("../get.access.response.php");
}
?>