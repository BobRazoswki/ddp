<?php

// include_once WP_CONTENT_DIR . '/wpalchemy/MetaBox.php';
// include_once WP_CONTENT_DIR . '/wpalchemy/MediaAccess.php';
// include_once 'metaboxes/setup.php';
// include_once 'metaboxes/customizer-spec.php';
// $wpalchemy_media_access = new WPAlchemy_MediaAccess();

// add_theme_support( 'post-thumbnails' );

function popup_newsletter() {
	if (!isset($_COOKIE['sitename_newvisitor'])) {
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
}
function add_slug_body_class( $classes ) {
	global $post;

	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
		return $classes;
}

add_filter( 'body_class', 'add_slug_body_class' );

if ( ! isset( $content_width ) ) $content_width = 900;

function custom_theme_setup() {
	add_theme_support( 'post-thumbnails');
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( "title-tag" );
  add_theme_support( "custom-header");
  add_theme_support( "custom-background");
}

add_action( 'after_setup_theme', 'custom_theme_setup' );

function wpdocs_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );

class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = '<strong>';
           $append = '</strong>';
           $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';



					if ($depth == 0)
           {
						 $nj = get_cat_ID( $item->title );
							$description = $append = $prepend = "";

							//$catNumberToDisplay = get_category_parents(6);
							$prepend .= '<ul class="nav__thumbnails">';
								global $post;
								$argss = array('numberposts' => 3, 'category' => $nj, 'order' => 'ASC');
								$custom_posts = get_posts($argss);
								foreach($custom_posts as $post) : setup_postdata($post);
									// $prepend = get_the_post_thumbnail($post->ID);
									$prepend .= '<li><a href="' . get_the_permalink() . '">' . get_the_post_thumbnail($post->ID) . '</a></li>';
									// $prepend .= count($custom_posts);
								endforeach;
								$prepend .= '</ul>';
           }


            $item_output = $args->before;

						if ($depth == 0) {
							$item_output .= '<a class="nav__linkWithNoDepth"'. $attributes .'>'.$item->title;
						}
						else {
							$item_output .= '<a'. $attributes .'>'.$item->title;
						}


						// pub 38
						// $item_output .= get_cat_ID( $cat_name );
						// $item_output .= '<h1>' .  get_the_post_thumbnail(7163) . '</h1>';



						// $item_output .= '<h1>' . var_dump($args->before); . '</h1>';
							//  $item_output .= '<h1>' . get_cat_ID( $item->title ) . '</h1>';


						// $item_output .= '<h1>' . $alex . '</h1>';
						// $item_output .= '<h1>' . var_dump($item->menu_item_parent) . '</h1>';
						//  //CEST BON !!!!
            $item_output .= $description.$args->link_after;
            $item_output .= '</a>';
						$item_output .= $args->link_before .$prepend.$append;
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $current_object_id );
            }
}


add_action( 'admin_menu', 'register_my_custom_menu_page' );

function register_my_custom_menu_page(){
	add_menu_page( 'Dettach&eacute;e de Presse', 'Dettach&eacute;e de Presse', 'manage_options', 'custompage', 'my_custom_menu_page', "dashicons-heart", 3 );
}

function my_custom_menu_page(){
  if (isset($_POST['logo_url'])) {
        update_option('logo_url', $_POST['logo_url']);
        $logo_url = $_POST['logo_url'];
    }
    $logo_url = get_option('logo_url', 'logo_url');

  if (isset($_POST['logo_url_store'])) {
        update_option('logo_url_store', $_POST['logo_url_store']);
        $logo_url_store = $_POST['logo_url_store'];
    }
    $logo_url_store = get_option('logo_url_store', 'logo_url_store');
    // $value = get_option('awesome_text', 'hey-ho');
include 'page-templates/customizer/ddp.php';

	// get_template_part('page-templates/customizer/ddp');
}

// add_action( 'admin_menu', 'register_my_custom_menu_page' );
//
// function register_my_custom_menu_page(){
// 	add_theme_page( 'Cartes de Visite', 'Cartes de Visite', 'manage_options', 'custompage', 'my_custom_menu_page', plugins_url( 'myplugin/images/icon.png' ), 6 );
// }
//
// function my_custom_menu_page(){
// 	get_template_part('custom-cartes');
// }



// function lda_theme_customizer( $wp_customize ) {
// 	//Logo desktop
//   $wp_customize->add_section( 'lda_logo_section' , array(
//     'title'       => __( 'Logo', 'lda' ),
//     'priority'    => 30,
//     'description' => 'Upload a logo to replace the default site name and description in the header',
// 		)
// 	);
// 	$wp_customize->add_setting( 'lda_logo' );
// 	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lda_logo', array(
//     'label'    => __( 'Logo', 'lda' ),
//     'section'  => 'lda_logo_section',
//     'settings' => 'lda_logo',
// 		) )
// 	);
// 	//Logo desktop retina
//   $wp_customize->add_section( 'lda_logo_retina_section' , array(
//     'title'       => __( 'Logo retina', 'lda' ),
//     'priority'    => 30,
//     'description' => 'Upload a logo to replace the default site name and description in the header',
// 		)
// 	);
// 	$wp_customize->add_setting( 'lda_logo_retina' );
// 	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lda_logo_retina', array(
//     'label'    => __( 'Logo retina', 'lda' ),
//     'section'  => 'lda_logo_retina_section',
//     'settings' => 'lda_logo_retina',
// 		) )
// 	);
// 	//Logo mobile
//   $wp_customize->add_section( 'lda_logo_mobile_section' , array(
//     'title'       => __( 'Logo mobile', 'lda' ),
//     'priority'    => 30,
//     'description' => 'Upload a logo to replace the default site name and description in the header',
// 		)
// 	);
// 	$wp_customize->add_setting( 'lda_logo_mobile' );
// 	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lda_logo_mobile', array(
//     'label'    => __( 'Logo mobile', 'lda' ),
//     'section'  => 'lda_logo_mobile_section',
//     'settings' => 'lda_logo_mobile',
// 		) )
// 	);
// 	//Logo mobile retina
//   $wp_customize->add_section( 'lda_logo_mobile_retina_section' , array(
//     'title'       => __( 'Logo mobile retina', 'lda' ),
//     'priority'    => 30,
//     'description' => 'Upload a logo to replace the default site name and description in the header',
// 		)
// 	);
// 	$wp_customize->add_setting( 'lda_logo_mobile_retina' );
// 	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lda_logo_mobile_retina', array(
//     'label'    => __( 'Logo mobile retina', 'lda' ),
//     'section'  => 'lda_logo_mobile_retina_section',
//     'settings' => 'lda_logo_mobile_retina',
// 		) )
// 	);
// }
// add_action( 'customize_register', 'lda_theme_customizer' );


function register_my_widget_theme()  {
// sidebar pour les pages

	register_sidebar(array(

		'id' => 'page-sidebar', // identifiant

		'name' => 'Sidebar Page', // Nom a afficher dans le tableau de bord

		'description' => 'Sidebar pour mes pages.', // description facultatif

		'before_widget' => '<li id="%1$s" class="widget %2$s large--12 medium--4 small--6 extrasmall--12">', // class attribuer pour le contenu (css)

		'after_widget' => '</li>',

		'before_title' => '<h2 class="widgettitle">', // class attribuer  pour le titre (css)

		'after_title' => '</h2>',

	));

// sidebar pour lers articles

	register_sidebar(array(

		'id' => 'article-sidebar', // identifiant

		'name' => 'Sidebar Article', // Nom a afficher dans le tableau de bord

		'description' => 'Sidebar pour mes articles.',// description facultatif

		'before_widget' => '<li id="%1$s" class="widget %2$s">', // class attribuer pour le contenu (css)

		'after_widget' => '</li>',

		'before_title' => '<h2 class="widgettitle">', // class attribuer  pour le titre (css)

		'after_title' => '</h2>',

	));

}

add_action( 'widgets_init', 'register_my_widget_theme' );

// add_action( 'init', 'register_my_widget_theme' );

function wpc_styles() {
	//Dependencies
	wp_register_script( 'jquery', get_template_directory_uri().'/build/assets/lib/jquery/jquery.min.js' );

	//Themes files
	wp_register_script( 'js', get_template_directory_uri().'/build/assets/js/main.min.js' );
	wp_register_style( 'css', get_template_directory_uri().'/build/assets/css/cssupload.min.css' );

	//Requires
	//wp_enqueue_script( 'angular' );
	wp_enqueue_script( 'jquery' );
	
	wp_enqueue_script( 'js' );
	wp_enqueue_style( 'css' );
}

function load_custom_wp_admin_style() {
    wp_register_style( 'adminCss', get_template_directory_uri().'/build/assets/css/admin.css' );
    wp_register_script( 'adminJs', get_template_directory_uri().'/build/assets/js/admin.js' );
    wp_enqueue_style( 'adminCss' );
    wp_enqueue_script( 'adminJs' );
}

add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );
add_action('wp_head', 'wpc_styles');
add_action('wp_head', 'wpc_styles');


function set_newuser_cookie() {
	if ( !is_admin() && !isset($_COOKIE['sitename_newvisitor'])) {
		setcookie( 'sitename_newvisitor', 1, time()+3600*24*100, COOKIEPATH, COOKIE_DOMAIN, false);
	}
}
add_action( 'init', 'set_newuser_cookie');

/** Customization SweetBid **/

function wpc_dashboard_widget_function() {
	echo
	"<ul>
		<li>Une cr&eacute;ation <a href='http://sweetbid.fr'>SweetBid</a></li>
	</ul>";
}

function wpc_add_dashboard_widgets() {
	wp_add_dashboard_widget('wp_dashboard_widget', 'Informations techniques', 'wpc_dashboard_widget_function');
}

add_action('wp_dashboard_setup', 'wpc_add_dashboard_widgets' );

function remove_footer_admin () {
echo 'Fait avec &#9829; par ton geek pr&eacute;f&eacute;r&eacute; :D';
 }
 add_filter('admin_footer_text', 'remove_footer_admin');
