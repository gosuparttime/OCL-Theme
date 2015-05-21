<?php 
/* Template Name: Search Results */
$search_refer = $_GET["post_type"];
if ($search_refer == 'study') { 
	load_template(TEMPLATEPATH . '/search-study.php');
} elseif ($search_refer == '') { 
	load_template(TEMPLATEPATH . '/search-all.php');
} ?>