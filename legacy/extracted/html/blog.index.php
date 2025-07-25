<?php 
session_start();
// parametres relatifs à la page
$typefile="blog";
// fichier de recuperation et d'affichage des parametres de la base de données
require_once('config/sql.conf.php');
// parametres relatifs à la page
$arianefile="home";
// fichier de recuperation et d'affichage des parametres du site
require_once('config/meta.conf.php');
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
<link rel="canonical" href="<?php echo $domain; ?>/<?php echo $blog; ?>/">
<!-- CSS -->
<link rel="dns-prefetch" href="https://www.google-analytics.com">
<link rel="dns-prefetch" href="https://www.googletagmanager.com">
<!-- CSS -->
<link rel="preload" as="font" href="/assets/fonts/oswald-v35-latin-700.woff2" type="font/woff2" crossorigin="anonymous">
<link rel="preload" as="font" href="/assets/fonts/oswald-v35-latin-300.woff2" type="font/woff2" crossorigin="anonymous">
<link rel="preload" as="font" href="/assets/fonts/oswald-v35-latin-regular.woff2" type="font/woff2" crossorigin="anonymous">
<link href="/assets/css/style.blog.home.min.css" rel="stylesheet" media="all">
<!--
<link href="/assets/bootstrap-4.3.1/css/bootstrap.css" rel="stylesheet" media="all">
<link href="/assets/css/style.css" rel="stylesheet" media="all">
--> 
</head>
<body>

<?php
require_once('blog.global.header.section.php');
?>

<div class="container-fluid containerPage">
<div class="container-fluid containerinPage">

	<!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE -->
	<div class="row">
	<div class="col-sm-8 col-lg-9">
	<!-- COL LEFT -->
		<?php
		// fichier de recuperation et d'affichage des parametres de la base de données
		require_once('config/ariane.conf.php');
		?>
	<!-- / COL LEFT -->
	</div>
	<div class="col-sm-4 col-lg-3 text-right">
	<!-- COL RIGHT -->
		<?php
		// fichier de recuperation et d'affichage des parametres de la base de données
		require_once('global.social.share.php');
		?>
	<!-- / COL RIGHT -->
	</div>
	</div>
	<!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE -->

	<?php
	$query_a_la_une = "SELECT DISTINCT BA_ID, BA_H1, BA_ALIAS, BA_PREVIEW, BA_WALL, BA_CREATE, BA_UPDATE, 
			PG_NAME, PG_ALIAS, PG_PIC, PG_IMG, PG_WALL 
			FROM __BLOG_ADVICE
			JOIN PIECES_GAMME ON PG_ID = BA_PG_ID
			INNER JOIN CATALOG_GAMME ON MC_PG_ID = PG_ID
			INNER JOIN CATALOG_FAMILY ON MF_ID = MC_MF_PRIME
			WHERE BA_PG_ID > 0 
			ORDER BY BA_UPDATE DESC, BA_CREATE DESC LIMIT 12";
	$request_a_la_une = $conn->query($query_a_la_une);
	if ($request_a_la_une->num_rows > 0) 
	{
	?>
	<!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE -->
	<div class="row">
	<div class="col-12 pt-3 pb-3">
		<span class="containerh2">
			<h2>articles récents</h2>
		</span>
	</div>
	</div>
	<div class="row p-0 m-0">
		<?php
		$query_advice = "SELECT DISTINCT BG_ID, BG_H1, BG_ALIAS, BG_PREVIEW, BG_WALL, BG_CREATE, BG_UPDATE 
				FROM __BLOG_GUIDE
				ORDER BY BG_UPDATE DESC, BG_CREATE DESC";
		$request_advice = $conn->query($query_advice);
		if ($request_advice->num_rows > 0) 
		{
		?>
			<?php
			while($result_advice = $request_advice->fetch_assoc())
			{
				$this_bg_id = $result_advice['BG_ID'];
				$this_bg_h1 = $result_advice['BG_H1'];
				$this_bg_alias = $result_advice['BG_ALIAS'];
				$this_bg_preview = $result_advice['BG_PREVIEW'];
				$this_bg_wall =  $result_advice['BG_WALL'];
				?>
				<?php
				// photo article blog
				$this_bg_wall_link = $domain."/upload/blog/guide/mini/".$this_bg_wall;
				?>
				<div class="col-12 col-sm-6 col-lg-4 col-xl-3 blocToBlogItem">

					<div class="container-fluid p-3 pb-0 mh57">
						<i><?php echo $this_bg_h1; ?></i>
						<br><span><?php echo date_format(date_create($result_advice['BG_UPDATE']), 'd/m/Y à H:i'); ?></span>
					</div>
					<div class="container-fluid p-3 mh167 text-center">
						<img data-src="<?php echo $this_bg_wall_link; ?>" src="/upload/loading-min.gif" 
						alt="<?php echo $this_bg_h1; ?>"
						class="w-100 lazy" />
					</div>
					<div class="container-fluid regularContent p-3 mh187">
						<?php echo content_cleaner($this_bg_preview); ?>
					</div>
					<div class="container-fluid regularContentBordered text-center pb-3">
						<a href="<?php echo $domain.'/'.$blog.'/'.$guide.'/'.$this_bg_alias; ?>" class="blog-read-more">Lire plus</a>
					</div>

				</div>
				<?php
			}
			?>
		<?php
		}
		?>
		<?php
		while($result_a_la_une = $request_a_la_une->fetch_assoc())
		{
			$this_ba_id = $result_a_la_une['BA_ID'];
			$this_ba_h1 = $result_a_la_une['BA_H1'];
			$this_ba_alias = $result_a_la_une['BA_ALIAS'];
			$this_ba_preview = $result_a_la_une['BA_PREVIEW'];
			$this_pg_name_site = $result_a_la_une['PG_NAME'];
			$this_pg_alias = $result_a_la_une['PG_ALIAS'];
			?>
			<?php
			// photo article blog
			$this_ba_wall = $result_a_la_une['BA_WALL'];
			if($this_ba_wall=="no.jpg")
			{
			// image standard de la gamme
			if($isMacVersion == false)
			{
				$this_pg_img = $result_a_la_une['PG_IMG'];
			}
			else
			{
				$this_pg_img = str_replace(".webp",".jpg",$result_a_la_une['PG_IMG']);
			}
			$this_ba_wall_link = $domain."/upload/articles/gammes-produits/catalogue/".$this_pg_img;
			}
			else
			{
			// image de l'article
			$this_ba_wall_link = $domain."/upload/blog/conseils/mini/".$this_ba_wall;
			}
			?>
			<div class="col-12 col-sm-6 col-lg-4 col-xl-3 blocToBlogItem">

				<div class="container-fluid p-3 pb-0 mh57">
					<i><?php echo $this_ba_h1; ?></i>
					<br>
					<b><?php echo $this_pg_name_site; ?></b>
					<span> | <?php echo date_format(date_create($result_a_la_une['BA_UPDATE']), 'd/m/Y'); ?></span>
				</div>
				<div class="container-fluid p-3 mh167 text-center">
					<img data-src="<?php echo $this_ba_wall_link; ?>" src="/upload/loading-min.gif"
					alt="<?php echo $this_ba_h1; ?>"
					class="w-100 lazy" />
				</div>
				<div class="container-fluid regularContent p-3 mh187">
					<?php echo content_cleaner($this_ba_preview); ?>
				</div>
				<div class="container-fluid regularContentBordered text-center pb-3">
					<a href="<?php echo $domain.'/'.$blog.'/'.$entretien.'/'.$this_pg_alias; ?>" class="blog-read-more">Lire plus</a>
				</div>

			</div>
			<?php
		}
		?>
	</div>
	<!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE -->
	<?php
	}
	?>

	<?php
	$query_a_la_une = "SELECT DISTINCT BA_ID, BA_H1, BA_ALIAS, BA_PREVIEW, BA_WALL, BA_CREATE, BA_UPDATE, 
			PG_NAME, PG_ALIAS, PG_PIC, PG_IMG, PG_WALL, BA_VISIT 
			FROM __BLOG_ADVICE
			JOIN PIECES_GAMME ON PG_ID = BA_PG_ID
			INNER JOIN CATALOG_GAMME ON MC_PG_ID = PG_ID
			INNER JOIN CATALOG_FAMILY ON MF_ID = MC_MF_PRIME
			WHERE BA_PG_ID > 0 
			ORDER BY BA_VISIT DESC LIMIT 12";
	$request_a_la_une = $conn->query($query_a_la_une);
	if ($request_a_la_une->num_rows > 0) 
	{
	?>
	<!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE --><!-- LINE -->
	<div class="row">
	<div class="col-12 pt-3 pb-3">
		<span class="containerh2">
			<h2>articles les plus lus</h2>
		</span>
	</div>
	</div>
	<div class="row p-0 m-0">
		<?php
		while($result_a_la_une = $request_a_la_une->fetch_assoc())
		{
			$this_ba_id = $result_a_la_une['BA_ID'];
			$this_ba_h1 = $result_a_la_une['BA_H1'];
			$this_ba_alias = $result_a_la_une['BA_ALIAS'];
			$this_ba_preview = $result_a_la_une['BA_PREVIEW'];
			$this_pg_name_site = $result_a_la_une['PG_NAME'];
			$this_pg_alias = $result_a_la_une['PG_ALIAS'];
			?>
			<?php
			// photo article blog
			$this_ba_wall = $result_a_la_une['BA_WALL'];
			if($this_ba_wall=="no.jpg")
			{
			// image standard de la gamme
			if($isMacVersion == false)
			{
				$this_pg_img = $result_a_la_une['PG_IMG'];
			}
			else
			{
				$this_pg_img = str_replace(".webp",".jpg",$result_a_la_une['PG_IMG']);
			}
			$this_ba_wall_link = $domain."/upload/articles/gammes-produits/catalogue/".$this_pg_img;
			}
			else
			{
			// image de l'article
			$this_ba_wall_link = $domain."/upload/blog/conseils/mini/".$this_ba_wall;
			}
			?>
			<div class="col-12 col-sm-6 col-lg-4 col-xl-3 blocToBlogItem">

				<div class="container-fluid p-3 pb-0 mh57">
					<i><?php echo $this_ba_h1; ?></i>
					<br>
					<b><?php echo $this_pg_name_site; ?></b>
					<span> | <?php echo date_format(date_create($result_a_la_une['BA_UPDATE']), 'd/m/Y'); ?></span>
				</div>
				<div class="container-fluid p-3 mh167 text-center">
					<img data-src="<?php echo $this_ba_wall_link; ?>" src="/upload/loading-min.gif"
					alt="<?php echo $this_ba_h1; ?>"
					class="w-100 lazy" />
				</div>
				<div class="container-fluid regularContent p-3 mh187">
					<?php echo content_cleaner($this_ba_preview); ?>
				</div>
				<div class="container-fluid regularContentBordered text-center pb-3">
					<a href="<?php echo $domain.'/'.$blog.'/'.$entretien.'/'.$this_pg_alias; ?>" class="blog-read-more">Lire plus</a>
				</div>

			</div>
			<?php
		}
		?>
	</div>
	<!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE --><!-- / LINE -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="/assets/bootstrap-4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
!function(r){function e(){for(var e,t,n=0;n<l.length;n++)e=l[n],0<=(t=e.getBoundingClientRect()).top&&0<=t.left&&t.top<=(r.innerHeight||document.documentElement.clientHeight)&&function(e,t){var n=new Image,r=e.getAttribute("data-src");n.onload=function(){e.parent?e.parent.replaceChild(n,e):e.src=r,t&&t()},n.src=r}(l[n],function(){l.splice(n,n)})}for(var l=new Array,t=function(e,t){if(document.querySelectorAll)t=document.querySelectorAll(e);else{var n=document,r=n.styleSheets[0]||n.createStyleSheet();r.addRule(e,"f:b");for(var l=n.all,c=0,o=[],i=l.length;c<i;c++)l[c].currentStyle.f&&o.push(l[c]);r.removeRule(0),t=o}return t}("img.lazy"),n=0;n<t.length;n++)l.push(t[n]);e(),function(e,t){r.addEventListener?this.addEventListener(e,t,!1):r.attachEvent?this.attachEvent("on"+e,t):this["on"+e]=t}("scroll",e)}(this);
</script>
<?php
// fichier de recuperation et d'affichage des parametres de la base de données
require_once('config/analytics.track.min.php');
?>