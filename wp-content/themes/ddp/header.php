<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head >
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" media="screen" title="no title" charset="utf-8">
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.min.js"></script>
	<![endif]-->
	<?php
	//	if (is_admin()) {
	   wp_head();
	//	}
	?>
</head>
<script>
    //<![CDATA[
        jQuery(window).load(function() { // makes sure the whole site is loaded
            jQuery('#status').fadeOut(); // will first fade out the loading animation
            jQuery('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
            jQuery('body').delay(350).css({'overflow':'visible'});
        })
    //]]>


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '980257155403488',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<body id='bg' <?php body_class( $class ); ?>>
	<div id="preloader">
	    <div id="status">&nbsp;</div>
	</div>
	<?php //popup_newsletter(); ?>
	<header class="header">
		<?php get_template_part( 'page-templates/header/header' ); ?>
		<?php get_template_part( 'page-templates/header/nav' ); ?>
	</header>
<main>
