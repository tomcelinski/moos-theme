<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width" />
	<meta name="google-site-verification" content="lWYImvzXYNY7YAyH3TnePFl6l3QhKlJ3upqE7X4keHc" />
	
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />	
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/normalize.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/forms.css">
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/js/select2/select2.css" rel="stylesheet"/>
	
	<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/js.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/select2/select2.js"></script>
	 <script type="text/javascript">
		  jQuery( function() {
				// Make the "Moos" <h1> a drop down menu
				$('#title').click( function() {
					 $('nav').slideToggle();
				});
		  });
		  
		  jQuery(document).ready(function($){
				$('select').select2();
		  });
	</script>
</head>
<body <?php body_class(); ?>>
<!--Facebook-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!--[if lt IE 7]>
	 <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]-->

<div class="header-container">
	 <header class="wrapper clearfix">
		  <h1 id="logoIMG" class="title" id="title"><a href="<?php echo site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Moos" /></a></h1>            

		  
		  <a class="menu_button" href="http://eepurl.com/iwsfU" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/stay_in_touch.png" /></a>
        <a class="menu_button" href="http://twitter.com/home/?status=%40moosaudio%20http://moosaudio.com&20" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/twitter_icon.png" /></a>
        <a class="menu_button" href="http://www.facebook.com/share.php?u=http://moosaudio.com" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/facebook_icon.png" /></a>
	 
		  <nav>
				<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'headerMenu', 'menu' => 'primary1' ) ); ?> 
		  </nav>
</header>
</div>

<div class="main-container">