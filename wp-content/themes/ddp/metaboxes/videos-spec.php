<?php

$videos = new WPAlchemy_MetaBox(array
(
	'id' => '_videos',
	'title' => 'Vidéo Youtube',
	'types' => array('post'), // added only for pages and to custom post type "events"
	'context' => 'normal', // same as above, defaults to "normal"
	'priority' => 'high', // same as above, defaults to "high"
	'template' => get_stylesheet_directory() . '/metaboxes/videos-meta.php',
	'include_category_id' => 570
));

/* eof */
