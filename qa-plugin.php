<?php

/*
	Plugin Name: Custom Hidden Post
	Plugin URI:
	Plugin Update Check URI:
	Plugin Description: Custom Hidden Post comment
	Plugin Version: 0.1
	Plugin Date: 2016-06-23
	Plugin Author: 38qa.net
	Plugin Author URI:
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.7
*/


if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
		header('Location: ../../');
		exit;
}

// layer
qa_register_plugin_layer('qa-custom-hidden-post-layer.php', 'Hide Comment Layer');
// overrides
qa_register_plugin_overrides('qa-custom-hidden-post-overrides.php');

/*
	Omit PHP closing tag to help avoid accidental output
*/
