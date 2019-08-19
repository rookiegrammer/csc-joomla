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
  <link href="<?= $path ?>css/bootstrap.min.css" rel="stylesheet">

  <style>
  /*
  *
  * ==========================================
  * CUSTOM UTIL CLASSES
  * ==========================================
  *
  */

  .dropdown-submenu {
  position: relative;
  }

  .dropdown-submenu>a:after {
  content: "\f0da";
  float: right;
  border: none;
  font-family: 'FontAwesome';
  }

  .dropdown-submenu>.dropdown-menu {
  top: 0;
  left: 100%;
  margin-top: 0px;
  margin-left: 0px;
  }
  </style>

  <script src="<?= $path ?>js/jquery-3.3.1.min.js"></script>
  <script src="<?= $path ?>js/popper.min.js"></script>
  <script src="<?= $path ?>js/bootstrap.min.js"></script>
</head>
<body>
  <header class="background-primary">
    <div style="min-height: 45px; line-height: 1; background-image: url(<?= $path ?>img/lizard.jpg); background-repeat: x-repeat; background-size: contain;">
		</div>
    <nav class="navbar navbar-light p-0">
			<div class="container mt-4">
	      <div class="d-flex flex-column w-100">
	        <div class="mr-3 text-center">
						<img src="<?= $path ?>img/logo.svg" height="90">
	        </div>
	        <div class="text-center text-white">
            <<?php if ($is_home) : ?>h1 <?php else: ?>div <?php endif; ?>
             class="font-weight-bold m-0 p-0" style="line-height: 1">
             <a class="navbar-brand serif pb-0 text-white" href="#" style="font-size: 2.5rem;">
               <?= $this->params->get('sitetitle') ?>
             </a>
            <?php if ($is_home) : ?>
            </h1> <?php else: ?>
            </div> <?php endif; ?>
            <div class="font-weight-bold" style="font-size: 1rem; color: #aaa"><?= $this->params->get('sitesubtitle') ?></div>
            <jdoc:include type="modules" name="menu" />
          </div>
        </div>
      </div>
    </nav>
  </header>

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
					<h5>Resources</h5>
						<ul class="list-unstyled text-small">
							<li>Location</li>
							<li>Phone</li>
							<li>Email</li>
						</ul>
				</div>
				<div class="col-4 col-md">
					<h5>Menu</h5>
					<ul class="list-unstyled text-small">
						<li><a class="text-muted" href="#">Home</a></li>
						<li><a class="text-muted" href="#">About</a></li>
						<li><a class="text-muted" href="#">Research</a></li>
						<li><a class="text-muted" href="#">Affiliates</a></li>
						<li><a class="text-muted" href="#">Publications</a></li>
						<li><a class="text-muted" href="#">Contact us</a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
  <script>
  $(function() {
// ------------------------------------------------------- //
// Multi Level dropdowns
// ------------------------------------------------------ //
$("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
  event.preventDefault();
  event.stopPropagation();

  $(this).siblings().toggleClass("show");


  if (!$(this).next().hasClass('show')) {
    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
  }
  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
    $('.dropdown-submenu .show').removeClass("show");
  });

});
});
  </script>
</body>
</html>
