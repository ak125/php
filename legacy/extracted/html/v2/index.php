<?php 
session_start();
// parametres relatifs à la page
$typefile="standard";
// fichier de recuperation et d'affichage des parametres de la base de données
require_once('../config/sql.conf.php');
// parametres relatifs à la page
$arianefile="home";
// fichier de recuperation et d'affichage des parametres du site
require_once('../config/meta.conf.php');
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
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Lato Font -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
<!-- Stylesheet -->
<link href="css/gallery-materialize.min.css" rel="stylesheet">
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>

<?php
require_once('global.header.section.php');
?>
    

    <!-- Gallery -->
    <div id="portfolio" class="section gray">
      <div class="container">
        <div class="gallery row">
          <div class="col l4 m6 s12 gallery-item gallery-expand gallery-filter polygon">
            <div class="gallery-curve-wrapper">
              <a class="gallery-cover gray">
                <img class="responsive-img" src="http://placehold.it/350x250" alt="placeholder">
              </a>
              <div class="gallery-header">
                <span>Aquamarine</span>
              </div>
              <div class="gallery-body">
                <div class="title-wrapper">
                  <h3>Aquamarine</h3>
                  <span class="price">$29.99</span>
                </div>
                <p class="description">
Literally venmo before they sold out, DIY heirloom forage polaroid offal yr pop-up selfies health goth. Typewriter scenester hammock truffaut meditation, squid before they sold out polaroid portland tousled taxidermy vice. Listicle butcher thundercats, taxidermy pitchfork next level roof party crucifix narwhal kinfolk you probably haven't heard of them portland small batch.</p>
                <p class="description">
Ea salvia adipisicing vegan man bun. Flexitarian cupidatat skateboard flannel. Drinking vinegar marfa you probably haven't heard of them consequat post-ironic, shabby chic williamsburg raclette vaporware readymade selfies brunch. Venmo selvage biodiesel marfa. Tbh literally 3 wolf moon, proident elit raclette chambray consequat edison bulb four loko accusamus. Semiotics godard eiusmod, ex esse air plant quinoa vaporware selfies keytar. Actually yuccie ennui flannel single-origin coffee, williamsburg cardigan banjo forage pug distillery tumblr hexagon vinyl occaecat.</p>

                <div class="carousel-wrapper">
                  <div class="carousel">
                    <a class="carousel-item" href="#one!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#two!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#three!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#four!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#five!"><img src="http://placehold.it/300x200"></a>
                  </div>
                </div>
              </div>
              <div class="gallery-action">
                <a class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">favorite</i></a>
              </div>
            </div>
          </div>
          <div class="col l4 m6 s12 gallery-item gallery-expand gallery-filter polygon">
            <div class="gallery-curve-wrapper">
              <a class="gallery-cover gray">
                <img src="http://placehold.it/350x300" alt="placeholder">
              </a>
              <div class="gallery-header">
                <span>Sun</span>
              </div>
              <div class="gallery-body">
                <div class="title-wrapper">
                  <h3>Sun</h3>
                  <span class="price">$9.99</span>
                </div>
                <p class="description">
Literally venmo before they sold out, DIY heirloom forage polaroid offal yr pop-up selfies health goth. Typewriter scenester hammock truffaut meditation, squid before they sold out polaroid portland tousled taxidermy vice. Listicle butcher thundercats, taxidermy pitchfork next level roof party crucifix narwhal kinfolk you probably haven't heard of them portland small batch.</p>
                <p class="description">
Ea salvia adipisicing vegan man bun. Flexitarian cupidatat skateboard flannel. Drinking vinegar marfa you probably haven't heard of them consequat post-ironic, shabby chic williamsburg raclette vaporware readymade selfies brunch. Venmo selvage biodiesel marfa. Tbh literally 3 wolf moon, proident elit raclette chambray consequat edison bulb four loko accusamus. Semiotics godard eiusmod, ex esse air plant quinoa vaporware selfies keytar. Actually yuccie ennui flannel single-origin coffee, williamsburg cardigan banjo forage pug distillery tumblr hexagon vinyl occaecat.</p>

                <div class="carousel-wrapper">
                  <div class="carousel">
                    <a class="carousel-item" href="#one!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#two!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#three!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#four!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#five!"><img src="http://placehold.it/300x200"></a>
                  </div>
                </div>
              </div>
              <div class="gallery-action">
                <a class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">favorite</i></a>
              </div>
            </div>
          </div>
          <div class="col l4 m6 s12 gallery-item gallery-expand gallery-filter bigbang">
            <div class="gallery-curve-wrapper">
              <a class="gallery-cover gray">
                <img class="responsive-img" src="http://placehold.it/350x280" alt="placeholder">
              </a>
              <div class="gallery-header">
                <span>Big Bang 1</span>
              </div>
              <div class="gallery-body">
                <div class="title-wrapper">
                  <h3>Big Bang 1</h3>
                  <span class="price">$23.99</span>
                </div>
                <p class="description">
Literally venmo before they sold out, DIY heirloom forage polaroid offal yr pop-up selfies health goth. Typewriter scenester hammock truffaut meditation, squid before they sold out polaroid portland tousled taxidermy vice. Listicle butcher thundercats, taxidermy pitchfork next level roof party crucifix narwhal kinfolk you probably haven't heard of them portland small batch.</p>
                <p class="description">
Ea salvia adipisicing vegan man bun. Flexitarian cupidatat skateboard flannel. Drinking vinegar marfa you probably haven't heard of them consequat post-ironic, shabby chic williamsburg raclette vaporware readymade selfies brunch. Venmo selvage biodiesel marfa. Tbh literally 3 wolf moon, proident elit raclette chambray consequat edison bulb four loko accusamus. Semiotics godard eiusmod, ex esse air plant quinoa vaporware selfies keytar. Actually yuccie ennui flannel single-origin coffee, williamsburg cardigan banjo forage pug distillery tumblr hexagon vinyl occaecat.</p>

                <div class="carousel-wrapper">
                  <div class="carousel">
                    <a class="carousel-item" href="#one!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#two!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#three!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#four!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#five!"><img src="http://placehold.it/300x200"></a>
                  </div>
                </div>
              </div>
              <div class="gallery-action">
                <a class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">favorite</i></a>
              </div>
            </div>
          </div>
          <div class="col l4 m6 s12 gallery-item gallery-expand gallery-filter polygon">
            <div class="gallery-curve-wrapper">
              <a class="gallery-cover gray">
                <img src="http://placehold.it/350x320" alt="placeholder">
              </a>
              <div class="gallery-header">
                <span>Maze</span>
              </div>
              <div class="gallery-body">
                <div class="title-wrapper">
                  <h3>Maze</h3>
                  <span class="price">$11.99</span>
                </div>
                <p class="description">
Literally venmo before they sold out, DIY heirloom forage polaroid offal yr pop-up selfies health goth. Typewriter scenester hammock truffaut meditation, squid before they sold out polaroid portland tousled taxidermy vice. Listicle butcher thundercats, taxidermy pitchfork next level roof party crucifix narwhal kinfolk you probably haven't heard of them portland small batch.</p>
                <p class="description">
Ea salvia adipisicing vegan man bun. Flexitarian cupidatat skateboard flannel. Drinking vinegar marfa you probably haven't heard of them consequat post-ironic, shabby chic williamsburg raclette vaporware readymade selfies brunch. Venmo selvage biodiesel marfa. Tbh literally 3 wolf moon, proident elit raclette chambray consequat edison bulb four loko accusamus. Semiotics godard eiusmod, ex esse air plant quinoa vaporware selfies keytar. Actually yuccie ennui flannel single-origin coffee, williamsburg cardigan banjo forage pug distillery tumblr hexagon vinyl occaecat.</p>

                <div class="carousel-wrapper">
                  <div class="carousel">
                    <a class="carousel-item" href="#one!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#two!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#three!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#four!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#five!"><img src="http://placehold.it/300x200"></a>
                  </div>
                </div>
              </div>
              <div class="gallery-action">
                <a class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">favorite</i></a>
              </div>
            </div>
          </div>
          <div class="col l4 m6 s12 gallery-item gallery-expand gallery-filter polygon">
            <div class="gallery-curve-wrapper">
              <a class="gallery-cover gray">
                <img src="http://placehold.it/350x260" alt="placeholder">
              </a>
              <div class="gallery-header">
                <span>Ice</span>
              </div>
              <div class="gallery-body">
                <div class="title-wrapper">
                  <h3>Ice</h3>
                  <span class="price">$14.99</span>
                </div>
                <p class="description">
Literally venmo before they sold out, DIY heirloom forage polaroid offal yr pop-up selfies health goth. Typewriter scenester hammock truffaut meditation, squid before they sold out polaroid portland tousled taxidermy vice. Listicle butcher thundercats, taxidermy pitchfork next level roof party crucifix narwhal kinfolk you probably haven't heard of them portland small batch.</p>
                <p class="description">
Ea salvia adipisicing vegan man bun. Flexitarian cupidatat skateboard flannel. Drinking vinegar marfa you probably haven't heard of them consequat post-ironic, shabby chic williamsburg raclette vaporware readymade selfies brunch. Venmo selvage biodiesel marfa. Tbh literally 3 wolf moon, proident elit raclette chambray consequat edison bulb four loko accusamus. Semiotics godard eiusmod, ex esse air plant quinoa vaporware selfies keytar. Actually yuccie ennui flannel single-origin coffee, williamsburg cardigan banjo forage pug distillery tumblr hexagon vinyl occaecat.</p>

                <div class="carousel-wrapper">
                  <div class="carousel">
                    <a class="carousel-item" href="#one!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#two!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#three!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#four!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#five!"><img src="http://placehold.it/300x200"></a>
                  </div>
                </div>
              </div>
              <div class="gallery-action">
                <a class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">favorite</i></a>
              </div>
            </div>
          </div>
          <div class="col l4 m6 s12 gallery-item gallery-expand gallery-filter polygon">
            <div class="gallery-curve-wrapper">
              <a class="gallery-cover gray">
                <img src="http://placehold.it/350x290" alt="placeholder">
              </a>
              <div class="gallery-header">
                <span>Cave</span>
              </div>
              <div class="gallery-body">
                <div class="title-wrapper">
                  <h3>Cave</h3>
                  <span class="price">$4.99</span>
                </div>
                <p class="description">
Literally venmo before they sold out, DIY heirloom forage polaroid offal yr pop-up selfies health goth. Typewriter scenester hammock truffaut meditation, squid before they sold out polaroid portland tousled taxidermy vice. Listicle butcher thundercats, taxidermy pitchfork next level roof party crucifix narwhal kinfolk you probably haven't heard of them portland small batch.</p>
                <p class="description">
Ea salvia adipisicing vegan man bun. Flexitarian cupidatat skateboard flannel. Drinking vinegar marfa you probably haven't heard of them consequat post-ironic, shabby chic williamsburg raclette vaporware readymade selfies brunch. Venmo selvage biodiesel marfa. Tbh literally 3 wolf moon, proident elit raclette chambray consequat edison bulb four loko accusamus. Semiotics godard eiusmod, ex esse air plant quinoa vaporware selfies keytar. Actually yuccie ennui flannel single-origin coffee, williamsburg cardigan banjo forage pug distillery tumblr hexagon vinyl occaecat.</p>

                <div class="carousel-wrapper">
                  <div class="carousel">
                    <a class="carousel-item" href="#one!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#two!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#three!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#four!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#five!"><img src="http://placehold.it/300x200"></a>
                  </div>
                </div>
              </div>
              <div class="gallery-action">
                <a class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">favorite</i></a>
              </div>
            </div>
          </div>
          <div class="col l4 m6 s12 gallery-item gallery-expand gallery-filter polygon">
            <div class="gallery-curve-wrapper">
              <a class="gallery-cover gray">
                <img src="http://placehold.it/350x240" alt="placeholder">
              </a>
              <div class="gallery-header">
                <span>Grapefruit</span>
              </div>
              <div class="gallery-body">
                <div class="title-wrapper">
                  <h3>Grapefruit</h3>
                  <span class="price">$14.99</span>
                </div>

                <p class="description">
Literally venmo before they sold out, DIY heirloom forage polaroid offal yr pop-up selfies health goth. Typewriter scenester hammock truffaut meditation, squid before they sold out polaroid portland tousled taxidermy vice. Listicle butcher thundercats, taxidermy pitchfork next level roof party crucifix narwhal kinfolk you probably haven't heard of them portland small batch.</p>
                <p class="description">
Ea salvia adipisicing vegan man bun. Flexitarian cupidatat skateboard flannel. Drinking vinegar marfa you probably haven't heard of them consequat post-ironic, shabby chic williamsburg raclette vaporware readymade selfies brunch. Venmo selvage biodiesel marfa. Tbh literally 3 wolf moon, proident elit raclette chambray consequat edison bulb four loko accusamus. Semiotics godard eiusmod, ex esse air plant quinoa vaporware selfies keytar. Actually yuccie ennui flannel single-origin coffee, williamsburg cardigan banjo forage pug distillery tumblr hexagon vinyl occaecat.</p>

                <div class="carousel-wrapper">
                  <div class="carousel">
                    <a class="carousel-item" href="#one!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#two!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#three!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#four!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#five!"><img src="http://placehold.it/300x200"></a>
                  </div>
                </div>

              </div>
              <div class="gallery-action">
                <a class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">favorite</i></a>
              </div>
            </div>
          </div>
          <div class="col l4 m6 s12 gallery-item gallery-expand gallery-filter bigbang">
            <div class="gallery-curve-wrapper">
              <a class="gallery-cover gray">
                <img class="responsive-img" src="http://placehold.it/350x300" alt="placeholder">
              </a>
              <div class="gallery-header">
                <span>Big Bang 2</span>
              </div>
              <div class="gallery-body">
                <div class="title-wrapper">
                  <h3>Big Bang 2</h3>
                  <span class="price">$40.99</span>
                </div>
                <p class="description">
Literally venmo before they sold out, DIY heirloom forage polaroid offal yr pop-up selfies health goth. Typewriter scenester hammock truffaut meditation, squid before they sold out polaroid portland tousled taxidermy vice. Listicle butcher thundercats, taxidermy pitchfork next level roof party crucifix narwhal kinfolk you probably haven't heard of them portland small batch.</p>
                <p class="description">
Ea salvia adipisicing vegan man bun. Flexitarian cupidatat skateboard flannel. Drinking vinegar marfa you probably haven't heard of them consequat post-ironic, shabby chic williamsburg raclette vaporware readymade selfies brunch. Venmo selvage biodiesel marfa. Tbh literally 3 wolf moon, proident elit raclette chambray consequat edison bulb four loko accusamus. Semiotics godard eiusmod, ex esse air plant quinoa vaporware selfies keytar. Actually yuccie ennui flannel single-origin coffee, williamsburg cardigan banjo forage pug distillery tumblr hexagon vinyl occaecat.</p>

                <div class="carousel-wrapper">
                  <div class="carousel">
                    <a class="carousel-item" href="#one!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#two!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#three!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#four!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#five!"><img src="http://placehold.it/300x200"></a>
                  </div>
                </div>
              </div>
              <div class="gallery-action">
                <a class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">favorite</i></a>
              </div>
            </div>
          </div>
          <div class="col l4 m6 s12 gallery-item gallery-expand gallery-filter bigbang">
            <div class="gallery-curve-wrapper">
              <a class="gallery-cover gray">
                <img class="responsive-img" src="http://placehold.it/350x280" alt="placeholder">
              </a>
              <div class="gallery-header">
                <span>Big Bang 3</span>
              </div>
              <div class="gallery-body">
                <div class="title-wrapper">
                  <h3>Big Bang 3</h3>
                  <span class="price">$18.99</span>
                </div>
                <p class="description">
Literally venmo before they sold out, DIY heirloom forage polaroid offal yr pop-up selfies health goth. Typewriter scenester hammock truffaut meditation, squid before they sold out polaroid portland tousled taxidermy vice. Listicle butcher thundercats, taxidermy pitchfork next level roof party crucifix narwhal kinfolk you probably haven't heard of them portland small batch.</p>
                <p class="description">
Ea salvia adipisicing vegan man bun. Flexitarian cupidatat skateboard flannel. Drinking vinegar marfa you probably haven't heard of them consequat post-ironic, shabby chic williamsburg raclette vaporware readymade selfies brunch. Venmo selvage biodiesel marfa. Tbh literally 3 wolf moon, proident elit raclette chambray consequat edison bulb four loko accusamus. Semiotics godard eiusmod, ex esse air plant quinoa vaporware selfies keytar. Actually yuccie ennui flannel single-origin coffee, williamsburg cardigan banjo forage pug distillery tumblr hexagon vinyl occaecat.</p>

                <div class="carousel-wrapper">
                  <div class="carousel">
                    <a class="carousel-item" href="#one!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#two!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#three!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#four!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#five!"><img src="http://placehold.it/300x200"></a>
                  </div>
                </div>
              </div>
              <div class="gallery-action">
                <a class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">favorite</i></a>
              </div>
            </div>
          </div>

          <div class="col l4 m6 s12 gallery-item gallery-expand gallery-filter sacred">
            <div class="gallery-curve-wrapper">
              <a class="gallery-cover gray">
                <img class="responsive-img" src="http://placehold.it/350x250" alt="placeholder">
              </a>
              <div class="gallery-header">
                <span>Circle</span>
              </div>
              <div class="gallery-body">
                <div class="title-wrapper">
                  <h3>Circle</h3>
                  <span class="price">$10.99</span>
                </div>
                <p class="description">
Literally venmo before they sold out, DIY heirloom forage polaroid offal yr pop-up selfies health goth. Typewriter scenester hammock truffaut meditation, squid before they sold out polaroid portland tousled taxidermy vice. Listicle butcher thundercats, taxidermy pitchfork next level roof party crucifix narwhal kinfolk you probably haven't heard of them portland small batch.</p>
                <p class="description">
Ea salvia adipisicing vegan man bun. Flexitarian cupidatat skateboard flannel. Drinking vinegar marfa you probably haven't heard of them consequat post-ironic, shabby chic williamsburg raclette vaporware readymade selfies brunch. Venmo selvage biodiesel marfa. Tbh literally 3 wolf moon, proident elit raclette chambray consequat edison bulb four loko accusamus. Semiotics godard eiusmod, ex esse air plant quinoa vaporware selfies keytar. Actually yuccie ennui flannel single-origin coffee, williamsburg cardigan banjo forage pug distillery tumblr hexagon vinyl occaecat.</p>

                <div class="carousel-wrapper">
                  <div class="carousel">
                    <a class="carousel-item" href="#one!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#two!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#three!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#four!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#five!"><img src="http://placehold.it/300x200"></a>
                  </div>
                </div>
              </div>
              <div class="gallery-action">
                <a class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">favorite</i></a>
              </div>
            </div>
          </div>

          <div class="col l4 m6 s12 gallery-item gallery-expand gallery-filter sacred">
            <div class="gallery-curve-wrapper">
              <a class="gallery-cover gray">
                <img class="responsive-img" src="http://placehold.it/350x260" alt="placeholder">
              </a>
              <div class="gallery-header">
                <span>Triangle</span>
              </div>
              <div class="gallery-body">
                <div class="title-wrapper">
                  <h3>Triangle</h3>
                  <span class="price">$10.99</span>
                </div>
                <p class="description">
Literally venmo before they sold out, DIY heirloom forage polaroid offal yr pop-up selfies health goth. Typewriter scenester hammock truffaut meditation, squid before they sold out polaroid portland tousled taxidermy vice. Listicle butcher thundercats, taxidermy pitchfork next level roof party crucifix narwhal kinfolk you probably haven't heard of them portland small batch.</p>
                <p class="description">
Ea salvia adipisicing vegan man bun. Flexitarian cupidatat skateboard flannel. Drinking vinegar marfa you probably haven't heard of them consequat post-ironic, shabby chic williamsburg raclette vaporware readymade selfies brunch. Venmo selvage biodiesel marfa. Tbh literally 3 wolf moon, proident elit raclette chambray consequat edison bulb four loko accusamus. Semiotics godard eiusmod, ex esse air plant quinoa vaporware selfies keytar. Actually yuccie ennui flannel single-origin coffee, williamsburg cardigan banjo forage pug distillery tumblr hexagon vinyl occaecat.</p>

                <div class="carousel-wrapper">
                  <div class="carousel">
                    <a class="carousel-item" href="#one!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#two!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#three!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#four!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#five!"><img src="http://placehold.it/300x200"></a>
                  </div>
                </div>
              </div>
              <div class="gallery-action">
                <a class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">favorite</i></a>
              </div>
            </div>
          </div>

          <div class="col l4 m6 s12 gallery-item gallery-expand gallery-filter sacred">
            <div class="gallery-curve-wrapper">
              <a class="gallery-cover gray">
                <img class="responsive-img" src="http://placehold.it/350x300" alt="placeholder">
              </a>
              <div class="gallery-header">
                <span>Hexagon</span>
              </div>
              <div class="gallery-body">
                <div class="title-wrapper">
                  <h3>Hexagon</h3>
                  <span class="price">$10.99</span>
                </div>
                <p class="description">
Literally venmo before they sold out, DIY heirloom forage polaroid offal yr pop-up selfies health goth. Typewriter scenester hammock truffaut meditation, squid before they sold out polaroid portland tousled taxidermy vice. Listicle butcher thundercats, taxidermy pitchfork next level roof party crucifix narwhal kinfolk you probably haven't heard of them portland small batch.</p>
                <p class="description">
Ea salvia adipisicing vegan man bun. Flexitarian cupidatat skateboard flannel. Drinking vinegar marfa you probably haven't heard of them consequat post-ironic, shabby chic williamsburg raclette vaporware readymade selfies brunch. Venmo selvage biodiesel marfa. Tbh literally 3 wolf moon, proident elit raclette chambray consequat edison bulb four loko accusamus. Semiotics godard eiusmod, ex esse air plant quinoa vaporware selfies keytar. Actually yuccie ennui flannel single-origin coffee, williamsburg cardigan banjo forage pug distillery tumblr hexagon vinyl occaecat.</p>

                <div class="carousel-wrapper">
                  <div class="carousel">
                    <a class="carousel-item" href="#one!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#two!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#three!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#four!"><img src="http://placehold.it/300x200"></a>
                    <a class="carousel-item" href="#five!"><img src="http://placehold.it/300x200"></a>
                  </div>
                </div>
              </div>
              <div class="gallery-action">
                <a class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">favorite</i></a>
              </div>
            </div>
          </div>

        </div>

      </div>

    </div><!-- /.container -->


    <!-- Core Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/masonry.pkgd.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/color-thief.min.js"></script>
    <script src="js/galleryExpand.js"></script>
    <script src="js/init.js"></script>

  </body>
</html>
