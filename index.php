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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>

  <style>
    .noselect {
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    .vertical-bar::-webkit-scrollbar {
      width: 11px;
    }
    .vertical-bar {
      scrollbar-width: thin;
      scrollbar-color: #fff #470000;
    }
    .vertical-bar::-webkit-scrollbar-track {
      background: #470000;
    }
    .vertical-bar::-webkit-scrollbar-thumb {
      background-color: #fff;
      border-radius: 6px;
      border: 3px solid black;
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
  <script src="<?= $path ?>js/app.js"></script>
</body>
</html>
