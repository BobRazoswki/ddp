<?php

$postfooter = new WPAlchemy_MetaBox(array
(
	'id' => '_postfooter',
	'title' => 'Footer de l\'Article',
	'types' => array('post'), // added only for pages and to custom post type "events"
	'context' => 'normal', // same as above, defaults to "normal"
	'priority' => 'high', // same as above, defaults to "high"
	'template' => get_stylesheet_directory() . '/metaboxes/postfooter-meta.php',
));

/* eof */
