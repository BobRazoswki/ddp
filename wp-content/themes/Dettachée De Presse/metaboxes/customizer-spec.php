<?php

$customizer = new WPAlchemy_MetaBox(array
(
	'id' => '_customizer',
	'title' => 'customizer DDP',
	'types' => array('page'), // added only for pages and to custom post type "events"
	'context' => 'normal', // same as above, defaults to "normal"
	'priority' => 'high', // same as above, defaults to "high"
	'include_template' => array('page-templates/customizer/ddp.php'),
	'template' => get_stylesheet_directory() . '/customizer-meta.php'
));

/* eof */
