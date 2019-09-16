<?php defined( '_JEXEC' ) or die( 'Restricted access' );
  $app = JFactory::getApplication();
  $menu = $app->getMenu();
  $base = JURI::base(true);
  $path = $base.'/templates/'.$app->getTemplate().'/';

  $current = JURI::getInstance()->toString(array('path'));

  $is_home = $current == $base.'/' || $current == $base.'/index.php';

  if ($is_home)
    $this->setTitle( $app->getCfg( 'sitename' ) );
  else
    $this->setTitle( $this->getTitle() . ' - ' . $app->getCfg( 'sitename' ) );

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <jdoc:include type="head" />

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700|Open+Sans:400,800" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
  <link href="<?= $path ?>css/bootstrap.min.css" rel="stylesheet">

  <script src="<?= $path ?>js/jquery-3.3.1.min.js"></script>
  <script src="<?= $path ?>js/popper.min.js"></script>
  <script src="<?= $path ?>js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js">

  </script>

  <style>
  .dropdown-menu {
      margin-top: 0;
  }

  .dropdown-menu .dropdown .dropdown-menu {
      position: absolute;
      left: 100%;
      top: 0%;
      margin:0;
      border-width: 1px;
  }

  .dropdown-menu > li a:hover,
  .dropdown-menu > li.show {
  	background: #007bff;
  	color: white;
  }
  .dropdown-menu > li.show > a{
  	color: white;
  }

  .dropdown-toggle {
    cursor: pointer;
  }

  .navbar-toggler {
      border-width: 0;
      transition: 0.2s;
      font-size: 1.5rem;
      padding: 1rem;
  }

  .navbar-toggler, .navbar-toggler:hover {
    color: white;
  }

  .navbar-toggler.collapsed {
    color: yellow;
  }

  @media (max-width: 767px) {
    .nav-item {
      padding-bottom: 0.5rem;
    }
    .dropdown-menu {
      position: relative;
      left: 0;
      top: 0;
      border-width: 0;
      background: white;
      width: 100%;
      text-align: center;

    }
    .dropdown-menu .dropdown .dropdown-menu {
        position: relative;
        left: 0;
        top: 0;
        border-width: 0;
        background: rgba(0,0,0,0.1);
        border-radius: 0;
    }

    .easynavbar .nav {
      flex-direction: column;
    }

    .nav-link {
      padding-top: 0;
    }

    .nav-link.active .nav-bars, .nav-link .nav-bars {
      border-bottom-color: transparent;
      border-width: 0;
    }
  }
  @media (min-width: 768px) {
    .dropdown-menu .dropdown-toggle::after {
        vertical-align: middle;
        border-left: 4px solid;
        border-bottom: 4px solid transparent;
        border-top: 4px solid transparent;
    }
  }

  </style>
</head>
<body>
  <header class="background-primary">
    <div style="min-height: 45px; line-height: 1; background-image: url(<?= $path ?>img/lizard.jpg); background-repeat: x-repeat; background-size: contain;">
		</div>
    <nav class="navbar navbar-expand-md p-0">
			<div class="container mt-4">
	      <div class="d-flex flex-column w-100">
	        <div class="mr-3 text-center">
						<img src="<?= $path ?>img/logo.svg" height="90">
	        </div>
	        <div class="text-center text-white">
            <<?php if ($is_home) : ?>h1 <?php else: ?>div <?php endif; ?>
             class="font-weight-bold m-0 p-0" style="line-height: 1">
             <a class="navbar-brand serif pb-0 text-white" href="<?= $base ?>" style="font-size: 2.5rem; white-space: normal">
               <?= $this->params->get('sitetitle') ?>
             </a>
            <?php if ($is_home) : ?>
            </h1> <?php else: ?>
            </div> <?php endif; ?>
            <div class="font-weight-bold" style="font-size: 1rem; color: #aaa"><?= $this->params->get('sitesubtitle') ?></div>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#main-navigation" aria-controls="main-navigation" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="main-navigation">
              <jdoc:include type="modules" name="menu" />
            </div>

          </div>
        </div>
      </div>
    </nav>
  </header>

  <jdoc:include type="modules" name="banner" />

  <?php
    include_once($is_home ? 'template/home.php' : 'template/content.php');
  ?>

  <div class="d-flex justify-content-center">
		<div>
			<img class="mb-5" src="<?= $path ?>img/hagabi.png" width="200">
		</div>
	</div>
	<footer class="sans-serif text-white" style="background-color: #191919">
		<div style="min-height: 45px; background-image: url(<?= $path ?>img/lizard.jpg); background-repeat: x-repeat; background-size: contain;">
		</div>
		<div class="container p-5">
			<div class="row">
				<div class="col-12 col-md-2">
					<img src="<?= $path ?>img/logo2.jpg">
				</div>
				<div class="col-8 col-md">
					<jdoc:include type="modules" name="footer-left" />
				</div>
				<div class="col-4 col-md">
					<jdoc:include type="modules" name="footer-right" />
				</div>
			</div>
		</div>
    <div class="container py-5 text-center">
      <jdoc:include type="modules" name="footer" />
    </div>
	</footer>
  <script>

  (function($) {
      var defaults={
          sm : 540,
          md : 720,
          lg : 960,
          xl : 1140,
          navbar_expand: 'lg'
      };
      $.fn.bootnavbar = function() {

          var screen_width = $(document).width();

          if(screen_width >= defaults.lg){
              $(this).find('.dropdown').hover(function() {
                  $(this).addClass('show');
                  $(this).find('.dropdown-menu').first().addClass('show').addClass('animated fadeIn').one('animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd', function () {
                      $(this).removeClass('animated fadeIn');
                  });
              }, function() {
                  $(this).removeClass('show');
                  $(this).find('.dropdown-menu').first().removeClass('show');
              });
          }

          $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
            if (!$(this).next().hasClass('show')) {
              $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
            }
            $(this).toggleClass('toggled');
            var $subMenu = $(this).next(".dropdown-menu");
            $subMenu.toggleClass('show');

            $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
              $('.dropdown-submenu .show').removeClass("show");
            });

            return false;
          });
      };
  })(jQuery);

  $(function ($) {
      $('.easynavbar').bootnavbar();
      $(document).on("click", '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
      });
  })
  </script>
</body>
</html>
