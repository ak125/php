<div class="container-fluid HEAD-CONTAINER d-none d-md-block">

	<div class="row">
		<div class="col HEAD-CONTAINER-MAIN-TITLE text-left">
			&nbsp;
		</div>
		<div class="col-2 HEAD-CONTAINER-MAIN-MY-CART text-center pt-2">
			<a href="<?php echo $domain; ?>/seo">
			<span>département</span>
			<br><span>Référencement</span>
			</a>
		</div>
		<div class="col-2 HEAD-CONTAINER-MAIN-MY-CART text-center pt-2">
			<a href="<?php echo $domain; ?>/commercial">
			<span>département</span>
			<br><span>Commercial</span>
			</a>
		</div>
		<div class="col-2 HEAD-CONTAINER-MAIN-MY-CART text-center pt-2">
			<a href="<?php echo $domain; ?>/expedition">
			<span>département</span>
			<br><span>Expédition</span>
			</a>
		</div>
		<div class="col-1 HEAD-CONTAINER-MAIN-MY-CART text-center">
			<a href="">
			<img src="<?php echo $domain; ?>/assets/img/icon-header-account.png" width="35" height="35">
			<br><span>Profil</span>
			</a>
		</div>
	</div>
	
</div> 
<?php
// MENU Seo
if(isset($dept_id)&&($dept_id==7))
{
	include("_seo/_menu.section.php");
}
?>
<?php
// MENU COMMERCIAL
if(isset($dept_id)&&($dept_id==1))
{
	include("_commercial/_menu.section.php");
}
?>
<?php
// MENU Expedition
if(isset($dept_id)&&($dept_id==3))
{
	include("_expedition/_menu.section.php");
}
?>
