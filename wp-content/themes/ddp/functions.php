<?php

include_once WP_CONTENT_DIR . '/wpalchemy/MetaBox.php';
include_once WP_CONTENT_DIR . '/wpalchemy/MediaAccess.php';
include_once 'metaboxes/setup.php';
include_once 'metaboxes/customizer-spec.php';
$wpalchemy_media_access = new WPAlchemy_MediaAccess();

add_theme_support( 'post-thumbnails' );

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
	add_menu_page( 'Dettachée de Presse', 'Dettachée de Presse', 'manage_options', 'custompage', 'my_custom_menu_page', "dashicons-heart", 30 );
}

function my_custom_menu_page(){
  if (isset($_POST['awesome_text'])) {
        update_option('awesome_text', $_POST['awesome_text']);
        $value = $_POST['awesome_text'];
    }

  if (isset($_POST['logo'])) {
        update_option('logo', $_POST['logo']);
        $value = $_POST['logo'];
    }
    $logo = get_option('logo', 'logo');
    $value = get_option('awesome_text', 'hey-ho');
include 'page-templates/customizer/ddp.php';

	// get_template_part('page-templates/customizer/ddp');
}

// add_action( 'admin_menu', 'register_my_custom_menu_page' );
//
// function register_my_custom_menu_page(){
// 	add_menu_page( 'Cartes de Visite', 'Cartes de Visite', 'manage_options', 'custompage', 'my_custom_menu_page', plugins_url( 'myplugin/images/icon.png' ), 6 );
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

		'before_widget' => '<li id="%1$s" class="widget %2$s">', // class attribuer pour le contenu (css)

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

add_action( 'init', 'register_my_widget_theme' );

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

add_action('wp_enqueue_scripts', 'wpc_styles');
add_action('wp_enqueue_style', 'wpc_styles');


/** Customization SweetBid **/

function wpc_dashboard_widget_function() {
	echo
	"<ul>
		<li>Une création <a href='http://sweetbid.fr'>SweetBid</a></li>
	</ul>";
}

function wpc_add_dashboard_widgets() {
	wp_add_dashboard_widget('wp_dashboard_widget', 'Informations techniques', 'wpc_dashboard_widget_function');
}

add_action('wp_dashboard_setup', 'wpc_add_dashboard_widgets' );

?>
