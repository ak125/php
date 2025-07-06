<div id="MAIN-MENU-CONTAINER">
	
	<div id="MENU-ICON-CONTAINER" onclick="openNav()">
		&nbsp;
	</div>
	
	<div id="MINI-LOGO-ICON-CONTAINER">
		<!--img src="< ?php echo $domain; ?>/assets/img/mini-logo-icon-gray.png" /><br /><br /-->&copy; <?php echo date("Y"); ?><br /><?php echo $domaincorename; ?>
	</div>
	
	<div id="MAIN-LANG-CONTAINER">
	<!--a href="#"><img src="< ?php  echo $domain; ?>/assets/img/fr.gif"></a>
	&nbsp;-->
	<a href="#"><img src="<?php  echo $domain; ?>/assets/img/en.gif"></a>
	</div>
	
</div>

<?php
$PermissionLevel = 0;
$query_permission= mysqli_query($conn, "SELECT CNFA_LEVEL FROM ___CONFIG_ADMIN 
	WHERE CNFA_LOGIN = '$log' AND CNFA_KEYLOG = '$mykey' AND CNFA_ID = '$ssid' AND CNFA_ACTIV = 1");
if ($result_permission=mysqli_fetch_array($query_permission))
{
	$PermissionLevel = $result_permission['CNFA_LEVEL'];
}
?>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="<?php echo $domain; ?>/welcome">Tableau de Bord</a>
  <!--a href="< ?php echo $domain; ?>/catalog">Gestion Catalogue</a-->
  <?php
  if($PermissionLevel==9)
  {
  	?>
  <a href="<?php echo $domain; ?>/staff">Staff management</a>
  <a href="<?php echo $domain; ?>/payment">Payment management</a>
  	<?php
  }
  ?>
  <a href="<?php echo $domain; ?>/out">Déconnexion</a>
</div>