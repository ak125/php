<?php 
session_start();
// parametres relatifs à la page
$typefile="standard";
// fichier de recuperation et d'affichage des parametres de la base de données
require_once('config/sql.conf.php');
// parametres relatifs à la page
$arianefile="mycartvalidate";
// fichier de recuperation et d'affichage des parametres du site
require_once('config/meta.conf.php');


$CartAmount = 0;
$CartAmount_shipping_deja_inclus = 0;
$CartPoids = 0;
$amcnkCart_count = @count($_SESSION['amcnkCart']['id_article']);
for($i = 0; $i < $amcnkCart_count; $i++) 
{ 
$piece_id_this = $_SESSION['amcnkCart']['id_article'][$i];
$piece_qte_this = $_SESSION['amcnkCart']['qte'][$i];
	$query_piece_global = "SELECT DISTINCT PIECE_ID, (PRI_VENTE_TTC * PIECE_QTY_SALE) AS PVTTC, 
	(PRI_CONSIGNE_TTC * PIECE_QTY_SALE) AS PCTTC, PRI_FRAIS_PORT_HT, PIECE_WEIGHT_KGM 
	FROM PIECES 
	JOIN PIECES_PRICE ON PRI_PIECE_ID = PIECE_ID 
	JOIN PIECES_MARQUE ON PM_ID = PRI_PM_ID 
	WHERE PIECE_ID = $piece_id_this AND PIECE_DISPLAY = 1 
	ORDER BY PIECE_SORT";
	$request_piece_global = $conn->query($query_piece_global);
	if ($request_piece_global->num_rows > 0) 
	{
		$result_piece_global = $request_piece_global->fetch_assoc();
		$CartAmount = $CartAmount + ($result_piece_global['PVTTC']*$piece_qte_this) + ($result_piece_global['PCTTC']*$piece_qte_this);
		$CartAmount_shipping_deja_inclus =  $CartAmount_shipping_deja_inclus + ($result_piece_global['PRI_FRAIS_PORT_HT']*$piece_qte_this);
		$CartPoids = $CartPoids + ($result_piece_global['PIECE_WEIGHT_KGM']*$piece_qte_this);		
    }
}
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
              // calcul de frais de port final //
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
function GenerateFinalShippingFee($FraisBase, $FraisSeuil, $FraisAfterSeuil, $CartAmount, $CartPoids, $CartAmount_shipping_deja_inclus, $FraisNormalementAPayer, $ZipCodeDeliveryIdentificator)
{
  
  // rajout demandé des kilo supp
  if($CartPoids>30)
  {
  $FraisNormalementAPayer=21.72+0.53;
  // calcul des kilogramme supplementaire
  $FrasiKiloSupp=($CartPoids-30)*0.53;
  $FraisNormalementAPayer=$FraisNormalementAPayer+$FrasiKiloSupp;
  }
  
  // rajout demandé par mourad le 30/09/2016 $FraisNormalementAPayer=($FraisNormalementAPayer+((0.39+1)*1.2))*7.24%;
  $FraisNormalementAPayer=($FraisNormalementAPayer+1.668)*1.0724;

  if($CartPoids>0)
  {
  
    if($FraisNormalementAPayer==0) { $FraisNormalementAPayer = $FraisBase; }
    if($FraisNormalementAPayer<$CartAmount_shipping_deja_inclus)
    {
    $FinalShippingFrais=0;
    }
    else
    {
    $FinalShippingFrais=$FraisNormalementAPayer-$CartAmount_shipping_deja_inclus;
    }
  }
  else
  {
    $FinalShippingFrais=$FraisBase;
  }  
  
  if($FinalShippingFrais>0)
  {
  $FinalShippingFraisINT=intval($FinalShippingFrais);
  $FinalShippingFraisINT=$FinalShippingFraisINT-1;
  $FinalShippingFrais=$FinalShippingFraisINT+0.9;
  }
  
  $FinalShippingFrais=round($FinalShippingFrais, 2);

  if($FinalShippingFrais<4.90) $FinalShippingFrais = 4.90;

  return($FinalShippingFrais);  
}
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
              // calcul de frais de port final //
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */

// données du panier informations complémentaires
if(isset($_POST['ASK2VALIDATE']))
{
	$_SESSION['cartimmat']=$_POST['cartimmat'];
    $_SESSION['cartvin']=$_POST['cartvin'];
    $_SESSION['oemcom']=$_POST['oemcom'];
    $_SESSION['infossup']=$_POST['infossup'];
    if($_POST['equiv']=="oui")
    {
      $_SESSION['equiv']="Oui";
    }
    else
    {
      $_SESSION['equiv']="Non";
    }
}
?>
<!doctype html>
<html lang="<?php echo $hr; ?>">
<head>
<meta charset="utf-8">
<title><?php  echo $pagetitle; ?></title>
<meta name="title" content="<?php  echo $pagetitle; ?>" />
<meta name="description" content="<?php  echo $pagedescription; ?>" />
<meta name="keywords" content="<?php  echo $pagekeywords; ?>"/>
<meta name="robots" content="<?php echo $pageRobots; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Url de base du site -->
<base href="<?php echo $domain; ?>">
<!-- CSS -->
<style>
@import url('https://fonts.googleapis.com/css?family=Oswald:300,400,700&display=swap');
</style>
<link href="/system/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all">
<link href="/assets/css/<?php echo $hr;?>.css" rel="stylesheet" media="all">
</head>
<body>

<?php
require_once('global.header.section.php');
?>

<div class="container-fluid globalthirdheader">
<div class="container-fluid mywidecontainer nocarform">
</div>
</div>

<div class="container-fluid containerPage">
<div class="container-fluid containerinPage txt18">

	<!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE -->
	<div class="row">
	<div class="col-12 d-none d-md-block">
		<?php
		// fichier de recuperation et d'affichage des parametres de la base de données
		require_once('config/ariane.conf.php');
		?>
	</div>
	</div>
	<!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE -->
	
	<!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE -->
	<div class="row d-none d-lg-block">
	<div class="col-12 pt-3 pb-3">
		<span class="containerh1">
			<h1><?php echo $pageh1; ?></h1>
		</span>
	</div>
	</div>
	<!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE -->

<?php 
if(isset($_SESSION['myaklog'])) // le client est deja connecté
{
?>
<form action="<?php echo $domain; ?>/mycart.proceed.to.pay.php" method="post" role="form">

	<?php
    // GET CLIENT DATA
    $mailclt=$_SESSION['myaklog'];
    $query_client_data = "SELECT * FROM ___XTR_CUSTOMER 
        WHERE CST_MAIL = '$mailclt'";
    $request_client_data = $conn->query($query_client_data);
    $result_client_data = $request_client_data->fetch_assoc();
    	// personnel data
		$connectedclt_id = $result_client_data['CST_ID'];
		$connectedclt_mail = $result_client_data['CST_MAIL'];
		$connectedclt_civ = $result_client_data['CST_CIVITILY'];
		$connectedclt_nom = $result_client_data['CST_NAME'];
		$connectedclt_prenom = $result_client_data['CST_FNAME'];
		$connectedclt_adr = $result_client_data['CST_ADDRESS'];
		$connectedclt_tel = $result_client_data['CST_TEL'];
		$connectedclt_port = $result_client_data['CST_GSM'];
		$connectedclt_zipcode = $result_client_data['CST_ZIP_CODE'];
		$connectedclt_ville = $result_client_data['CST_CITY'];
		$connectedclt_pays = $result_client_data['CST_COUNTRY'];
		// company data
		$connectedclt_is_pro = $result_client_data['CST_IS_PRO'];
		$connectedclt_ste = $result_client_data['CST_RS'];
		$connectedclt_siret = $result_client_data['CST_SIRET'];
		// Facture data
	    $query_client_data_billing = "SELECT * FROM ___XTR_CUSTOMER_BILLING_ADDRESS 
	        WHERE CBA_CST_ID = '$connectedclt_id'";
	    $request_client_data_billing = $conn->query($query_client_data_billing);
	    if($result_client_data_billing = $request_client_data_billing->fetch_assoc())
	    {
			$connectedclt_fact_mail = $result_client_data_billing['CBA_MAIL'];
			$connectedclt_fact_civ = $result_client_data_billing['CBA_CIVITILY'];
			$connectedclt_fact_nom = $result_client_data_billing['CBA_NAME'];
			$connectedclt_fact_prenom = $result_client_data_billing['CBA_FNAME'];
			$connectedclt_fact_adr = $result_client_data_billing['CBA_ADDRESS'];
			$connectedclt_fact_tel = $result_client_data_billing['CBA_TEL'];
			$connectedclt_fact_port = $result_client_data_billing['CBA_GSM'];
			$connectedclt_fact_zipcode = $result_client_data_billing['CBA_ZIP_CODE'];
			$connectedclt_fact_ville = $result_client_data_billing['CBA_CITY'];
			$connectedclt_fact_pays = $result_client_data_billing['CBA_COUNTRY'];
			// BILLING ADDRESS ID
			$connectedclt_cba_id = $result_client_data_billing['CBA_ID'];
		}
		else
		{
			$connectedclt_fact_mail = $connectedclt_mail;
			$connectedclt_fact_civ = $connectedclt_civ;
			$connectedclt_fact_nom = $connectedclt_nom;
			$connectedclt_fact_prenom = $connectedclt_prenom;
			$connectedclt_fact_adr = $connectedclt_adr;
			$connectedclt_fact_tel = $connectedclt_tel;
			$connectedclt_fact_port = $connectedclt_port;
			$connectedclt_fact_zipcode = $connectedclt_zipcode;
			$connectedclt_fact_ville = $connectedclt_ville;
			$connectedclt_fact_pays = $connectedclt_pays;
			// BILLING ADDRESS ID
			$connectedclt_cba_id = 0;
		}
		// Delivry data
		$query_client_data_delivery = "SELECT * FROM ___XTR_CUSTOMER_DELIVERY_ADDRESS 
	        WHERE CDA_CST_ID = '$connectedclt_id'";
	    $request_client_data_delivery = $conn->query($query_client_data_delivery);
	    if($result_client_data_delivery = $request_client_data_delivery->fetch_assoc())
	    {
			$connectedclt_liv_mail = $result_client_data_delivery['CDA_MAIL'];
			$connectedclt_liv_civ = $result_client_data_delivery['CDA_CIVITILY'];
			$connectedclt_liv_nom = $result_client_data_delivery['CDA_NAME'];
			$connectedclt_liv_prenom = $result_client_data_delivery['CDA_FNAME'];
			$connectedclt_liv_adr = $result_client_data_delivery['CDA_ADDRESS'];
			$connectedclt_liv_tel = $result_client_data_delivery['CDA_TEL'];
			$connectedclt_liv_port = $result_client_data_delivery['CDA_GSM'];
			$connectedclt_liv_zipcode = $result_client_data_delivery['CDA_ZIP_CODE'];
			$connectedclt_liv_ville = $result_client_data_delivery['CDA_CITY'];
			$connectedclt_liv_pays = $result_client_data_delivery['CDA_COUNTRY'];
			// DELIVERY ADDRESS ID
			$connectedclt_cda_id = $result_client_data_delivery['CDA_ID'];
		}
		else
		{
			$connectedclt_liv_mail = $connectedclt_mail;
			$connectedclt_liv_civ = $connectedclt_civ;
			$connectedclt_liv_nom = $connectedclt_nom;
			$connectedclt_liv_prenom = $connectedclt_prenom;
			$connectedclt_liv_adr = $connectedclt_adr;
			$connectedclt_liv_tel = $connectedclt_tel;
			$connectedclt_liv_port = $connectedclt_port;
			$connectedclt_liv_zipcode = $connectedclt_zipcode;
			$connectedclt_liv_ville = $connectedclt_ville;
			$connectedclt_liv_pays = $connectedclt_pays;
			// DELIVERY ADDRESS ID
			$connectedclt_cda_id = 0;
		}
	?>

	<?php ///////////////////////// DETAILS DE LIVRAISON ////////////////////////////////////////////// ?>
    <input type="hidden" name="cba_id" value="<?php echo $connectedclt_cba_id; ?>" /> 
    <input type="hidden" name="cda_id" value="<?php echo $connectedclt_cda_id; ?>" /> 

    <?php ///////////////////////// DETAILS DU LIVREUR ////////////////////////////////////////////// ?>
    <?php
    // LIVRAISON PAR DEFAUT
    $query_shipping_default = "SELECT * FROM ___XTR_DELIVERY_AGENT 
	WHERE DA_ID = 1";
	$request_shipping_default = $conn->query($query_shipping_default);
	$result_shipping_default = $request_shipping_default->fetch_assoc();

	$fraismode = $result_shipping_default['DA_NAME'];
	$livmethod = $result_shipping_default['DA_ID'];
	$frais = $result_shipping_default['DA_FEE'];
    ?>

	<div class="row">
	<div class="col-md-8 col-lg-9">
<!-- COL LEFT -->
<!-- COL LEFT -->
<!-- COL LEFT -->
<!-- COL LEFT -->
<!-- COL LEFT -->
<div class="row">
<div class="col-12 pb-3">
	<h2 class="TXT">Mode de Livraison</h2>
</div>
</div>
	
<?php
$query_shipping = "SELECT * FROM ___XTR_DELIVERY_AGENT 
	WHERE DA_EXTERN = 0  ORDER BY DA_ID ASC";
$request_shipping = $conn->query($query_shipping);
while($result_shipping = $request_shipping->fetch_assoc())
{
	// preparation des variables pour le calvul des frais de liraison
	$LivreurTableTarif = "___XTR_DELIVERY_".$result_shipping['DA_SQL_TABLE'];
	$FraisBase = $result_shipping['DA_FEE'];
	$FraisSeuil = $result_shipping['DA_SEUIL'];
	$FraisAfterSeuil = $result_shipping['DA_FEE_NEW'];
	// pour verifier les domtom et les corse
	$ZipCodeDelivery=$connectedclt_liv_zipcode;
	$ZipCodeDeliveryIdentificator=substr($ZipCodeDelivery,0,2);
	// Est ce la corse domtom ou france ?
	switch ($ZipCodeDeliveryIdentificator)
	{
		case '20':
		{
			$LivreurTableTarif.="_CORSE";
			$ZipCodeName="CORSE";
			break;
		}
		case '97':
		{
			$LivreurTableTarif.="_DOMTOM1";
			$ZipCodeName="DOM TOM";
			break;
		}
		case '98':
		{
			$LivreurTableTarif.="_DOMTOM2";
			$ZipCodeName="DOM TOM";
			break;
		}
		default:
		{
			$LivreurTableTarif.="_FRANCE";
			$ZipCodeName="FRANCE";
			break;
		}
	}
	// montant frais de port initial
	$query_shipping_values = "SELECT TPG_FRAIS_PORT 
		FROM $LivreurTableTarif 
		WHERE TPG_MIN <  $CartPoids  AND TPG_MAX >=  $CartPoids ";
	$request_shipping_values = $conn->query($query_shipping_values);
	if ($request_shipping_values->num_rows > 0) 
	{
	$result_shipping_values = $request_shipping_values->fetch_assoc();
	$FraisNormalementAPayer = $result_shipping_values['TPG_FRAIS_PORT'];
	}
	// montant frais de port final
	$FinalShippingFrais = GenerateFinalShippingFee($FraisBase, $FraisSeuil, $FraisAfterSeuil, $CartAmount_en_norme, $CartPoids, $CartAmount_shipping_deja_inclus, $FraisNormalementAPayer, $ZipCodeDeliveryIdentificator);
	?>
	<div class="row">
	<div class="col-12 pb-1">

		<div class="container-fluid containerShipping">
			
			<div class="row">
				<div class="col-sm-1 text-center align-self-center">
					
					<input name="livmethod" type="radio" value="<?php echo $result_shipping['DA_ID']; ?>" 
					checked="checked" />

				</div>
				<div class="col-sm-3 text-left align-self-center">

					<img src="<?php echo $domain; ?>/assets/img/<?php echo $result_shipping['DA_ICON']; ?>" class="mw-100" />

				</div>
	            <div class="col-sm-6 align-self-center">
	              <u><?php echo $result_shipping['DA_NAME']; ?> : <?php echo $ZipCodeName; ?></u>
	              <br />
	              <span>
	              	<?php
						if($connectedclt_is_pro==1) 
						{ echo $connectedclt_ste."<br>"; echo $connectedclt_siret."<br>"; }
						echo $connectedclt_liv_civ." ";
						echo $connectedclt_liv_nom." ";
						echo $connectedclt_liv_prenom."<br>";
						echo $connectedclt_liv_adr."<br>".$connectedclt_liv_zipcode." ".$connectedclt_liv_ville."<br>".$connectedclt_liv_pays.".";
					?>
	              </span>
	            </div>
	            <div class="col-sm-2 align-self-center text-right">
					<b><?php echo number_format($FinalShippingFrais, 2, '.', ' '); ?></b> <?php echo $GlobalSiteCurrencyChar; ?>
				</div>
			</div>

		</div>

	</div>
	</div>
	<?php
}
?>
<input type="hidden" name="FinalShippingFraisAtivated" value="<?php echo $FinalShippingFrais; ?>" />

	<?php
	// CALCUL CART
	$amcnkCart_total_amount = 0;
	$amcnkCart_total_consigne = 0;
	for($i = 0; $i < $amcnkCart_count; $i++) 
	{ 
	$piece_id_this = $_SESSION['amcnkCart']['id_article'][$i];
	$piece_qte_this = $_SESSION['amcnkCart']['qte'][$i];
		$query_piece = "SELECT DISTINCT PIECE_ID, PIECE_REF, PIECE_REF_CLEAN, PIECE_NAME, 
		PIECE_PM_ID, PM_NAME, 
		(PRI_VENTE_TTC * PIECE_QTY_SALE) AS PVTTC, (PRI_CONSIGNE_TTC * PIECE_QTY_SALE) AS PCTTC, 
		PIECE_HAS_IMG 
		FROM PIECES 
		JOIN PIECES_PRICE ON PRI_PIECE_ID = PIECE_ID 
		JOIN PIECES_MARQUE ON PM_ID = PRI_PM_ID 
		WHERE PIECE_ID = $piece_id_this AND PIECE_DISPLAY = 1 
		ORDER BY PIECE_SORT";
		$request_piece = $conn->query($query_piece);
		if ($request_piece->num_rows > 0) 
		{
		$result_piece = $request_piece->fetch_assoc();
	    $amcnkCart_total_amount = $amcnkCart_total_amount + ($result_piece['PVTTC']*$piece_qte_this);
	    $amcnkCart_total_consigne = $amcnkCart_total_consigne + ($result_piece['PCTTC']*$piece_qte_this);
	    }
	}
	$amcnkCart_total = $amcnkCart_total_amount+$amcnkCart_total_consigne+$FinalShippingFrais;
	?>

<div class="row">
<div class="col-12 pt3 pb-3">
	<h2 class="TXT">Mode de paiement</h2>
</div>
</div>

	<div class="row">
	<div class="col-6 pb-3">

		<div class="container-fluid containerShipping">
			
			<div class="row">
				<div class="col-12 text-center">
					<img src="<?php echo $domain; ?>/assets/img/pay-paybox.jpg" class="mw-100" />
	                <br />
	                Carte bancaire
	                <br />
	                <input name="paymethod" type="radio" value="PAYBOX" checked="checked" />
				</div>
			</div>

		</div>

	</div>
	<div class="col-6 pb-3">

		<div class="container-fluid containerShipping">
			
			<div class="row">
				<div class="col-12 text-center">
					<img src="<?php echo $domain; ?>/assets/img/pay-paypal.jpg" class="mw-100" />
	                <br />
	                Paypal
	                <br />
	                <input name="paymethod" type="radio" value="PAYBOX" />
				</div>
			</div>

		</div>

	</div>
	<?php
	//if(($_SERVER['REMOTE_ADDR']==$IpBureauTn)||($_SERVER['REMOTE_ADDR']==$IpBureauFr)||($_SERVER['REMOTE_ADDR']==$IpBureauAmin))
	if($_SERVER['REMOTE_ADDR']==$IpBureauAmin)
	{
	?>
	<div class="col-12 pb-3">

		<div class="container-fluid containerShipping">
			
			<div class="row">
				<div class="col-12 text-center">
					<img src="<?php echo $domain; ?>/assets/img/pay-paybox.jpg" class="mw-100" />
	                <br />
	                PAYBOX
	                <br />
	                <input name="paymethod" type="radio" value="PAYBOX" />
				</div>
			</div>

		</div>

	</div>
	<?php
	}
	?>
	<div class="col-12 pt-3 pb-3">

		<div class="container-fluid containerReadCGV">
			
			<div class="row">
				<div class="col-12">
				En cliquant sur le bouton « Payer maintenant », vous acceptez de vous conformer aux <a href="<?php echo $domain; ?>/conditions-generales-de-vente.html" target="_blank"><i><u>Conditions générales de vente</u></i></a> que vous reconnaissez avoir lus, comprises et acceptées dans leur intégralité.
				</div>
			</div>

		</div>

	</div>
	</div>
<!-- / COL LEFT -->
<!-- / COL LEFT -->
<!-- / COL LEFT -->
<!-- / COL LEFT -->
<!-- / COL LEFT -->
	</div>
	<div class="col-md-4 col-lg-3">
<!-- COL RIGHT -->
<!-- COL RIGHT -->
<!-- COL RIGHT -->
<!-- COL RIGHT -->
<!-- COL RIGHT -->
<div class="row p-0 m-0">
<div class="col-12 mycarttotal">

	<div class="row">
	<div class="col-12 pt3 pb-3 text-center">
		<h2 class="TXT">Ticket Paiement</h2>
	</div>
	<div class="col-12 mycarttotal-line pl-0">
	<b>Facturé à</b>
	</div>
	<div class="col-12 mycarttotal-line pl-0">
	<?php
		if($connectedclt_is_pro==1) 
		{ echo $connectedclt_ste."<br>"; echo $connectedclt_siret."<br>"; }
		echo $connectedclt_fact_civ." ";
		echo $connectedclt_fact_nom." ";
		echo $connectedclt_fact_prenom."<br>";
		echo $connectedclt_fact_adr." ".$connectedclt_fact_zipcode." ".$connectedclt_fact_ville."<br>".$connectedclt_fact_pays.".";
	?>
	</div>
	<div class="col-12 mycarttotal-line pl-0">
	<b>Détails</b>
	</div>
	<div class="col-7 mycarttotal-line pl-0 pr-0">
	Total commande TTC
	</div>
	<div class="col-5 mycarttotal-line pr-0 text-right">
	<?php echo number_format(($amcnkCart_total_amount+$amcnkCart_total_consigne), 2, '.', ' '); ?> <?php echo $GlobalSiteCurrencyChar; ?>
	</div>
	<div class="col-7 mycarttotal-line pl-0 pr-0">
	Frais de port
	</div>
	<div class="col-5 mycarttotal-line pr-0 text-right">
	<?php echo number_format($FinalShippingFrais, 2, '.', ' '); ?> <?php echo $GlobalSiteCurrencyChar; ?>
	</div>
	<div class="col-7 mycarttotal-line pl-0 pr-0">
	<b>Total TTC</b>
	</div>
	<div class="col-5 mycarttotal-line pr-0 text-right">
	<b><?php echo number_format($amcnkCart_total, 2, '.', ' '); ?> <?php echo $GlobalSiteCurrencyChar; ?></b>
	</div>
	<div class="col-12 mycarttotal-submit text-center pl-0 pr-0">

	<input type="submit" class="subscribeSubmit" value="Payer maintenant" />
    <input type="hidden" name="ASK2PAY" value="1">
    <input type="hidden" name="ASK2PAYLINK" value="1">  

	</div>
	</div>

</div>
</div>
<!-- / COL RIGHT -->
<!-- / COL RIGHT -->
<!-- / COL RIGHT -->
<!-- / COL RIGHT -->
<!-- / COL RIGHT -->
	</div>
	</div>

</form>
<?php
}
else
{
?>
	<?php
	// connect to pay
	$ask2connectResponseLinkCode = 7;
	require_once('myspace.connect.try.php');
	?>
<?php
}
?>

</div>
</div>

<?php
require_once('global.footer.section.php');
?>

</body>
</html>
<!-- JS Bootstrap -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="/system/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php
// fichier de recuperation et d'affichage des parametres de la base de données
require_once('config/analytics.track.php');
?>