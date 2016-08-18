<?php

$monthsmeta = new WPAlchemy_MetaBox(array
(
	'id' => '_monthsmeta',
	'title' => 'Date de l\'événement',
	'types' => array('post'), // added only for pages and to custom post type "events"
	'context' => 'normal', // same as above, defaults to "normal"
	'priority' => 'high', // same as above, defaults to "high"
	'template' => get_stylesheet_directory() . '/metaboxes/months-meta.php',
	'include_category_id' => array(522,539,556)
));

/* eof */
