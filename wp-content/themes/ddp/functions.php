<?php

add_theme_support( 'post-thumbnails' );

class description_walker extends Walker_Nav_Menu
{
	// function end_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
	//                 // $indent = str_repeat("\t", $depth);
	// 	              // $output .= "\n$indent<ul class=\"sub-menu\">\n";
	//
	//
	//
  //       }
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

// object(WP_Post)#3009 (40)
// { ["ID"]=> int(10340) ["post_author"]=> string(1) "1" ["post_date"]=> string(19) "2016-04-08 10:30:02" ["post_date_gmt"]=> string(19) "2016-04-08 09:30:02" ["post_content"]=> string(1) " " ["post_title"]=> string(0) "" ["post_excerpt"]=> string(0) "" ["post_status"]=> string(7) "publish" ["comment_status"]=> string(6) "closed" ["ping_status"]=> string(6) "closed" ["post_password"]=> string(0) "" ["post_name"]=> string(5) "10340" ["to_ping"]=> string(0) "" ["pinged"]=> string(0) "" ["post_modified"]=> string(19) "2016-04-08 10:30:11" ["post_modified_gmt"]=> string(19) "2016-04-08 09:30:11" ["post_content_filtered"]=> string(0) "" ["post_parent"]=> int(0) ["guid"]=> string(34) "http://localhost:8890/ddp/?p=10340" ["menu_order"]=> int(1) ["post_type"]=> string(13) "nav_menu_item" ["post_mime_type"]=> string(0) "" ["comment_count"]=> string(1) "0" ["filter"]=> string(3) "raw" ["db_id"]=> int(10340) ["menu_item_parent"]=> string(1) "0" ["object_id"]=> string(2) "38" ["object"]=> string(8) "category" ["type"]=> string(8) "taxonomy" ["type_label"]=> string(10) "Catégorie" ["url"]=> string(45) "http://localhost:8890/ddp/category/publicite/" ["title"]=> string(10) "Publicité" ["target"]=> string(0) "" ["attr_title"]=> string(0) "" ["description"]=> string(0) "" ["classes"]=> array(5)
// 	{ [0]=> string(0) "" [1]=> string(9) "menu-item" [2]=> string(23) "menu-item-type-taxonomy" [3]=> string(25) "menu-item-object-category" [4]=> string(22) "menu-item-has-children" } ["xfn"]=> string(0) "" ["current"]=> bool(false) ["current_item_ancestor"]=> bool(false) ["current_item_parent"]=> bool(false) } object(WP_Post)#3012 (40)
// 	{ ["ID"]=> int(10341) ["post_author"]=> string(1) "1" ["post_date"]=> string(19) "2016-04-08 10:30:02" ["post_date_gmt"]=> string(19) "2016-04-08 09:30:02" ["post_content"]=> string(1) " " ["post_title"]=> string(0) "" ["post_excerpt"]=> string(0) "" ["post_status"]=> string(7) "publish" ["comment_status"]=> string(6) "closed" ["ping_status"]=> string(6) "closed" ["post_password"]=> string(0) "" ["post_name"]=> string(5) "10341" ["to_ping"]=> string(0) "" ["pinged"]=> string(0) "" ["post_modified"]=> string(19) "2016-04-08 10:30:11" ["post_modified_gmt"]=> string(19) "2016-04-08 09:30:11" ["post_content_filtered"]=> string(0) "" ["post_parent"]=> int(0) ["guid"]=> string(34) "http://localhost:8890/ddp/?p=10341" ["menu_order"]=> int(2) ["post_type"]=> string(13) "nav_menu_item" ["post_mime_type"]=> string(0) "" ["comment_count"]=> string(1) "0" ["filter"]=> string(3) "raw" ["db_id"]=> int(10341) ["menu_item_parent"]=> string(5) "10340" ["object_id"]=> string(1) "1" ["object"]=> string(8) "category" ["type"]=> string(8) "taxonomy" ["type_label"]=> string(10) "Catégorie" ["url"]=> string(46) "http://localhost:8890/ddp/category/non-classe/" ["title"]=> string(11) "Non classé" ["target"]=> string(0) "" ["attr_title"]=> string(0) "" ["description"]=> string(0) "" ["classes"]=> array(4)
// 		{ [0]=> string(0) "" [1]=> string(9) "menu-item" [2]=> string(23) "menu-item-type-taxonomy" [3]=> string(25) "menu-item-object-category" } ["xfn"]=> string(0) "" ["current"]=> bool(false) ["current_item_ancestor"]=> bool(false) ["current_item_parent"]=> bool(false) } object(WP_Post)#3013 (40)
// 		{ ["ID"]=> int(10342) ["post_author"]=> string(1) "1" ["post_date"]=> string(19) "2016-04-08 10:30:02" ["post_date_gmt"]=> string(19) "2016-04-08 09:30:02" ["post_content"]=> string(1) " " ["post_title"]=> string(0) "" ["post_excerpt"]=> string(0) "" ["post_status"]=> string(7) "publish" ["comment_status"]=> string(6) "closed" ["ping_status"]=> string(6) "closed" ["post_password"]=> string(0) "" ["post_name"]=> string(5) "10342" ["to_ping"]=> string(0) "" ["pinged"]=> string(0) "" ["post_modified"]=> string(19) "2016-04-08 10:30:11" ["post_modified_gmt"]=> string(19) "2016-04-08 09:30:11" ["post_content_filtered"]=> string(0) "" ["post_parent"]=> int(0) ["guid"]=> string(34) "http://localhost:8890/ddp/?p=10342" ["menu_order"]=> int(3) ["post_type"]=> string(13) "nav_menu_item" ["post_mime_type"]=> string(0) "" ["comment_count"]=> string(1) "0" ["filter"]=> string(3) "raw" ["db_id"]=> int(10342) ["menu_item_parent"]=> string(5) "10340" ["object_id"]=> string(2) "29" ["object"]=> string(8) "category" ["type"]=> string(8) "taxonomy" ["type_label"]=> string(10) "Catégorie" ["url"]=> string(39) "http://localhost:8890/ddp/category/day/" ["title"]=> string(3) "Day" ["target"]=> string(0) "" ["attr_title"]=> string(0) "" ["description"]=> string(0) "" ["classes"]=> array(4)
// 			{ [0]=> string(0) "" [1]=> string(9) "menu-item" [2]=> string(23) "menu-item-type-taxonomy" [3]=> string(25) "menu-item-object-category" } ["xfn"]=> string(0) "" ["current"]=> bool(false) ["current_item_ancestor"]=> bool(false) ["current_item_parent"]=> bool(false) } object(WP_Post)#3014 (40)
// 			{ ["ID"]=> int(10343) ["post_author"]=> string(1) "1" ["post_date"]=> string(19) "2016-04-08 10:30:02" ["post_date_gmt"]=> string(19) "2016-04-08 09:30:02" ["post_content"]=> string(1) " " ["post_title"]=> string(0) "" ["post_excerpt"]=> string(0) "" ["post_status"]=> string(7) "publish" ["comment_status"]=> string(6) "closed" ["ping_status"]=> string(6) "closed" ["post_password"]=> string(0) "" ["post_name"]=> string(5) "10343" ["to_ping"]=> string(0) "" ["pinged"]=> string(0) "" ["post_modified"]=> string(19) "2016-04-08 10:30:11" ["post_modified_gmt"]=> string(19) "2016-04-08 09:30:11" ["post_content_filtered"]=> string(0) "" ["post_parent"]=> int(0) ["guid"]=> string(34) "http://localhost:8890/ddp/?p=10343" ["menu_order"]=> int(4) ["post_type"]=> string(13) "nav_menu_item" ["post_mime_type"]=> string(0) "" ["comment_count"]=> string(1) "0" ["filter"]=> string(3) "raw" ["db_id"]=> int(10343) ["menu_item_parent"]=> string(1) "0" ["object_id"]=> string(2) "25" ["object"]=> string(8) "category" ["type"]=> string(8) "taxonomy" ["type_label"]=> string(10) "Catégorie" ["url"]=> string(45) "http://localhost:8890/ddp/category/bon-plans/" ["title"]=> string(11) "Bon plans !" ["target"]=> string(0) "" ["attr_title"]=> string(0) "" ["description"]=> string(0) "" ["classes"]=> array(5)
// 				{ [0]=> string(0) "" [1]=> string(9) "menu-item" [2]=> string(23) "menu-item-type-taxonomy" [3]=> string(25) "menu-item-object-category" [4]=> string(22) "menu-item-has-children" } ["xfn"]=> string(0) "" ["current"]=> bool(false) ["current_item_ancestor"]=> bool(false) ["current_item_parent"]=> bool(false) } object(WP_Post)#3015 (40)
// 				{ ["ID"]=> int(10344) ["post_author"]=> string(1) "1" ["post_date"]=> string(19) "2016-04-08 10:30:02" ["post_date_gmt"]=> string(19) "2016-04-08 09:30:02" ["post_content"]=> string(1) " " ["post_title"]=> string(0) "" ["post_excerpt"]=> string(0) "" ["post_status"]=> string(7) "publish" ["comment_status"]=> string(6) "closed" ["ping_status"]=> string(6) "closed" ["post_password"]=> string(0) "" ["post_name"]=> string(5) "10344" ["to_ping"]=> string(0) "" ["pinged"]=> string(0) "" ["post_modified"]=> string(19) "2016-04-08 10:30:11" ["post_modified_gmt"]=> string(19) "2016-04-08 09:30:11" ["post_content_filtered"]=> string(0) "" ["post_parent"]=> int(0) ["guid"]=> string(34) "http://localhost:8890/ddp/?p=10344" ["menu_order"]=> int(5) ["post_type"]=> string(13) "nav_menu_item" ["post_mime_type"]=> string(0) "" ["comment_count"]=> string(1) "0" ["filter"]=> string(3) "raw" ["db_id"]=> int(10344) ["menu_item_parent"]=> string(5) "10343" ["object_id"]=> string(1) "3" ["object"]=> string(8) "category" ["type"]=> string(8) "taxonomy" ["type_label"]=> string(10) "Catégorie" ["url"]=> string(43) "http://localhost:8890/ddp/category/web-2-0/" ["title"]=> string(7) "Web 2.0" ["target"]=> string(0) "" ["attr_title"]=> string(0) "" ["description"]=> string(0) "" ["classes"]=> array(4)
// 					{ [0]=> string(0) "" [1]=> string(9) "menu-item" [2]=> string(23) "menu-item-type-taxonomy" [3]=> string(25) "menu-item-object-category" } ["xfn"]=> string(0) "" ["current"]=> bool(false) ["current_item_ancestor"]=> bool(false) ["current_item_parent"]=> bool(false) } object(WP_Post)#3016 (40)
// 					{ ["ID"]=> int(10345) ["post_author"]=> string(1) "1" ["post_date"]=> string(19) "2016-04-08 10:30:02" ["post_date_gmt"]=> string(19) "2016-04-08 09:30:02" ["post_content"]=> string(1) " " ["post_title"]=> string(0) "" ["post_excerpt"]=> string(0) "" ["post_status"]=> string(7) "publish" ["comment_status"]=> string(6) "closed" ["ping_status"]=> string(6) "closed" ["post_password"]=> string(0) "" ["post_name"]=> string(5) "10345" ["to_ping"]=> string(0) "" ["pinged"]=> string(0) "" ["post_modified"]=> string(19) "2016-04-08 10:30:11" ["post_modified_gmt"]=> string(19) "2016-04-08 09:30:11" ["post_content_filtered"]=> string(0) "" ["post_parent"]=> int(0) ["guid"]=> string(34) "http://localhost:8890/ddp/?p=10345" ["menu_order"]=> int(6) ["post_type"]=> string(13) "nav_menu_item" ["post_mime_type"]=> string(0) "" ["comment_count"]=> string(1) "0" ["filter"]=> string(3) "raw" ["db_id"]=> int(10345) ["menu_item_parent"]=> string(5) "10343" ["object_id"]=> string(2) "24" ["object"]=> string(8) "category" ["type"]=> string(8) "taxonomy" ["type_label"]=> string(10) "Catégorie" ["url"]=> string(44) "http://localhost:8890/ddp/category/shopping/" ["title"]=> string(8) "Shopping" ["target"]=> string(0) "" ["attr_title"]=> string(0) "" ["description"]=> string(0) "" ["classes"]=> array(4)
// 						{ [0]=> string(0) "" [1]=> string(9) "menu-item" [2]=> string(23) "menu-item-type-taxonomy" [3]=> string(25) "menu-item-object-category" } ["xfn"]=> string(0) "" ["current"]=> bool(false) ["current_item_ancestor"]=> bool(false) ["current_item_parent"]=> bool(false) } object(WP_Post)#3017 (40)
// 						{ ["ID"]=> int(10346) ["post_author"]=> string(1) "1" ["post_date"]=> string(19) "2016-04-08 10:30:02" ["post_date_gmt"]=> string(19) "2016-04-08 09:30:02" ["post_content"]=> string(1) " " ["post_title"]=> string(0) "" ["post_excerpt"]=> string(0) "" ["post_status"]=> string(7) "publish" ["comment_status"]=> string(6) "closed" ["ping_status"]=> string(6) "closed" ["post_password"]=> string(0) "" ["post_name"]=> string(5) "10346" ["to_ping"]=> string(0) "" ["pinged"]=> string(0) "" ["post_modified"]=> string(19) "2016-04-08 10:30:12" ["post_modified_gmt"]=> string(19) "2016-04-08 09:30:12" ["post_content_filtered"]=> string(0) "" ["post_parent"]=> int(0) ["guid"]=> string(34) "http://localhost:8890/ddp/?p=10346" ["menu_order"]=> int(7) ["post_type"]=> string(13) "nav_menu_item" ["post_mime_type"]=> string(0) "" ["comment_count"]=> string(1) "0" ["filter"]=> string(3) "raw" ["db_id"]=> int(10346) ["menu_item_parent"]=> string(1) "0" ["object_id"]=> string(2) "26" ["object"]=> string(8) "category" ["type"]=> string(8) "taxonomy" ["type_label"]=> string(10) "Catégorie" ["url"]=> string(42) "http://localhost:8890/ddp/category/slider/" ["title"]=> string(6) "Slider" ["target"]=> string(0) "" ["attr_title"]=> string(0) "" ["description"]=> string(0) "" ["classes"]=> array(5)
// 							{ [0]=> string(0) "" [1]=> string(9) "menu-item" [2]=> string(23) "menu-item-type-taxonomy" [3]=> string(25) "menu-item-object-category" [4]=> string(22) "menu-item-has-children" } ["xfn"]=> string(0) "" ["current"]=> bool(false) ["current_item_ancestor"]=> bool(false) ["current_item_parent"]=> bool(false) } object(WP_Post)#3018 (40)
// 							{ ["ID"]=> int(10347) ["post_author"]=> string(1) "1" ["post_date"]=> string(19) "2016-04-08 10:30:02" ["post_date_gmt"]=> string(19) "2016-04-08 09:30:02" ["post_content"]=> string(1) " " ["post_title"]=> string(0) "" ["post_excerpt"]=> string(0) "" ["post_status"]=> string(7) "publish" ["comment_status"]=> string(6) "closed" ["ping_status"]=> string(6) "closed" ["post_password"]=> string(0) "" ["post_name"]=> string(5) "10347" ["to_ping"]=> string(0) "" ["pinged"]=> string(0) "" ["post_modified"]=> string(19) "2016-04-08 10:30:12" ["post_modified_gmt"]=> string(19) "2016-04-08 09:30:12" ["post_content_filtered"]=> string(0) "" ["post_parent"]=> int(0) ["guid"]=> string(34) "http://localhost:8890/ddp/?p=10347" ["menu_order"]=> int(8) ["post_type"]=> string(13) "nav_menu_item" ["post_mime_type"]=> string(0) "" ["comment_count"]=> string(1) "0" ["filter"]=> string(3) "raw" ["db_id"]=> int(10347) ["menu_item_parent"]=> string(5) "10346" ["object_id"]=> string(2) "95" ["object"]=> string(8) "category" ["type"]=> string(8) "taxonomy" ["type_label"]=> string(10) "Catégorie" ["url"]=> string(41) "http://localhost:8890/ddp/category/night/" ["title"]=> string(5) "Night" ["target"]=> string(0) "" ["attr_title"]=> string(0) "" ["description"]=> string(0) "" ["classes"]=> array(4)
// 								{ [0]=> string(0) "" [1]=> string(9) "menu-item" [2]=> string(23) "menu-item-type-taxonomy" [3]=> string(25) "menu-item-object-category" } ["xfn"]=> string(0) "" ["current"]=> bool(false) ["current_item_ancestor"]=> bool(false) ["current_item_parent"]=> bool(false) } object(WP_Post)#3019 (40)
// 								{ ["ID"]=> int(10348) ["post_author"]=> string(1) "1" ["post_date"]=> string(19) "2016-04-08 10:30:02" ["post_date_gmt"]=> string(19) "2016-04-08 09:30:02" ["post_content"]=> string(1) " " ["post_title"]=> string(0) "" ["post_excerpt"]=> string(0) "" ["post_status"]=> string(7) "publish" ["comment_status"]=> string(6) "closed" ["ping_status"]=> string(6) "closed" ["post_password"]=> string(0) "" ["post_name"]=> string(5) "10348" ["to_ping"]=> string(0) "" ["pinged"]=> string(0) "" ["post_modified"]=> string(19) "2016-04-08 10:30:12" ["post_modified_gmt"]=> string(19) "2016-04-08 09:30:12" ["post_content_filtered"]=> string(0) "" ["post_parent"]=> int(0) ["guid"]=> string(34) "http://localhost:8890/ddp/?p=10348" ["menu_order"]=> int(9) ["post_type"]=> string(13) "nav_menu_item" ["post_mime_type"]=> string(0) "" ["comment_count"]=> string(1) "0" ["filter"]=> string(3) "raw" ["db_id"]=> int(10348) ["menu_item_parent"]=> string(5) "10346" ["object_id"]=> string(2) "21" ["object"]=> string(8) "category" ["type"]=> string(8) "taxonomy" ["type_label"]=> string(10) "Catégorie" ["url"]=> string(44) "http://localhost:8890/ddp/category/insolite/" ["title"]=> string(8) "Insolite" ["target"]=> string(0) "" ["attr_title"]=> string(0) "" ["description"]=> string(0) "" ["classes"]=> array(4)
// 									{ [0]=> string(0) "" [1]=> string(9) "menu-item" [2]=> string(23) "menu-item-type-taxonomy" [3]=> string(25) "menu-item-object-category" } ["xfn"]=> string(0) "" ["current"]=> bool(false) ["current_item_ancestor"]=> bool(false) ["current_item_parent"]=> bool(false) } object(WP_Post)#3020 (40)
// 									{ ["ID"]=> int(10349) ["post_author"]=> string(1) "1" ["post_date"]=> string(19) "2016-04-08 10:30:02" ["post_date_gmt"]=> string(19) "2016-04-08 09:30:02" ["post_content"]=> string(1) " " ["post_title"]=> string(0) "" ["post_excerpt"]=> string(0) "" ["post_status"]=> string(7) "publish" ["comment_status"]=> string(6) "closed" ["ping_status"]=> string(6) "closed" ["post_password"]=> string(0) "" ["post_name"]=> string(5) "10349" ["to_ping"]=> string(0) "" ["pinged"]=> string(0) "" ["post_modified"]=> string(19) "2016-04-08 10:30:12" ["post_modified_gmt"]=> string(19) "2016-04-08 09:30:12" ["post_content_filtered"]=> string(0) "" ["post_parent"]=> int(0) ["guid"]=> string(34) "http://localhost:8890/ddp/?p=10349" ["menu_order"]=> int(10) ["post_type"]=> string(13) "nav_menu_item" ["post_mime_type"]=> string(0) "" ["comment_count"]=> string(1) "0" ["filter"]=> string(3) "raw" ["db_id"]=> int(10349) ["menu_item_parent"]=> string(1) "0" ["object_id"]=> string(2) "20" ["object"]=> string(8) "category" ["type"]=> string(8) "taxonomy" ["type_label"]=> string(10) "Catégorie" ["url"]=> string(49) "http://localhost:8890/ddp/category/tendancesmode/" ["title"]=> string(14) "Tendances/Mode" ["target"]=> string(0) "" ["attr_title"]=> string(0) "" ["description"]=> string(0) "" ["classes"]=> array(4)
// 										{ [0]=> string(0) "" [1]=> string(9) "menu-item" [2]=> string(23) "menu-item-type-taxonomy" [3]=> string(25) "menu-item-object-category" } ["xfn"]=> string(0) "" ["current"]=> bool(false) ["current_item_ancestor"]=> bool(false) ["current_item_parent"]=> bool(false) }


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
