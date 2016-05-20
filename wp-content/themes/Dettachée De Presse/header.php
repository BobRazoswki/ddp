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
<body <?php //body_class( $class ); ?> >
	<?php
		if (isset($_COOKIE['sitename_newvisitor']) === false) {
			echo "<article id='popup' class='popup'>";
			echo "<div id='popup__cross--container' class='popup__cross--container'>";
				echo "<span class='popup__cross popup__cross--left'></span>";
				echo "<span class='popup__cross popup__cross--right'></span>";
			echo "</div>";
				global $post;
				$args = array(
					'posts_per_page' => 3,
					'category' => 568
				);
				echo '<h3 class="popup__title">L\'EMAIL QUI FAIT DU BIEN!</h3>';
				echo '<ul class="popup__post">';
					$custom_posts = get_posts($args);
					foreach($custom_posts as $post) : setup_postdata($post);
						echo '<li class="popup__post--li">';
							the_post_thumbnail( 'thumbnail' );
							echo '<span class="popup__post--title">';
								the_title();
							echo '</span>';
						echo '</li>';
					endforeach;
				echo '</ul>';
				echo '<section class="newsletter">';
					echo '<h3 class="newsletter__h3">INSCRIVEZ-VOUS À LA NEWSLETTER</h3>';
					echo '<section class="newsletter__container">';
						echo '<button class="newsletter__button--homme" type="button" name="button__homme">H</button>';
						echo '<button class="newsletter__button--femme" type="button" name="button__femme">F</button>';
							echo '<span class="newsletter__homme">';
									if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( 5 ); }
							echo '</span>';
							echo '<span class="newsletter__femme">';
									if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( 6 ); }
							echo '</span>';
						echo '</section>';
				echo '</section>';
			echo '</article>';
		}
	?>
<header class="header">
	<?php get_template_part( 'page-templates/header/header' ); ?>
	<?php get_template_part( 'page-templates/header/nav' ); ?>
</header>
