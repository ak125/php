<?php 
session_start();
// fichier de recuperation et d'affichage des parametres de la base de données
require_once('config/sql.conf.php');
// fichier de recuperation et d'affichage des parametres du site
require_once('config/meta.conf.php');
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
<?Php
// ENTETE DE PAGE
//@require_once('header.first.section.php');
// FIN ENTETE DE PAGE
?>



<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100 h-100" src="<?php echo $domain; ?>/upload/1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 h-100" src="<?php echo $domain; ?>/upload/2.jpg" alt="Second slide">
    </div>
  </div>
</div>

<div style=" position:absolute; z-index:4; top:0px; bottom:0px; left:0px; right:0px; width:100%; text-align:center; background:url(<?php  echo $domain; ?>/assets/img/website-transparent-pattern.png);">&nbsp;</div>

<div class="CONNECTION-PANEL">

    <div class="row nopadding nomargin align-items-center">
        <div class="col-md-4  nopadding">

            <div class="container LOGIN-LABEL centerVertical">

                    <b><?php echo $domaincorename; ?> Plateform</b>

            </div>
            <div class="container LOGIN-LABEL-SECOND centerVertical">

                    SIGN IN

            </div>

        </div>
        <div class="col-md-8 nopadding">

            <form method="post" action="accessRequest" role="form">
            <div class="container LOGIN-FORM-PANEL">

                    <div class="row">
                        <div class="col-12">
                            <span class="CONNECTION-USER-LABEL">UsER name</span><br>
                            <input name="userlog" type="text" class="CONNECTION-USER-INPUT" autocomplete="off" />
                        </div>
                        <div class="col-12">
                            <br><span class="CONNECTION-USER-LABEL">password</span><br>
                            <input name="userpswd" type="password" class="CONNECTION-USER-INPUT" autocomplete="off" />
                        </div>
                    </div>

            </div>
            <div class="container LOGIN-BUTTON-PANEL">

                    <div class="row">
                        <div class="col-md-9 centerVertical LOGIN-ERROR">
                        <?php if(isset($_GET['denied'])) { echo "Check your access code."; } ?>
                        <?php if(isset($_GET['expired'])) { echo "Session expired."; } ?>
                        <?php if(isset($_GET['suspended'])) { echo "Suspended account."; } ?>
                        </div>
                        <div class="col-md-3">
                            <input type="submit" name="" value="&gt;" class="CONNECTION-USER-CONNECT" />
                        </div>
                    </div>

            </div>
            </form>

        </div>
    </div>

</div> 

<?Php
// ENTETE DE PAGE
//@require_once('footer.last.section.php');
// FIN ENTETE DE PAGE
?>
</body>
</html>