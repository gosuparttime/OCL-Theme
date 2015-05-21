<!doctype html>

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>
<?php wp_title( '|', true, 'right' ); ?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- media-queries.js (fallback) -->
<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>			
		<![endif]-->

<!-- html5.js -->
<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<!-- wordpress head functions -->
<?php wp_head(); ?>
<!-- end of wordpress head -->

<!-- typeahead plugin - if top nav search bar enabled -->
<?php require_once('library/typeahead.php'); ?>
</head>

<body>
<div class="row-offcanvas-left row-offcanvas" id="wrapper">
<header role="banner">
  <div id="inner-header" class="clearfix">
    <div class="collapse bluelight-bg" id="search-site">
      <div class="container">
        <form class="navbar-search pull-right" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
          <label for="s">Search the OCL Site</label>
          <input name="s" id="s" type="text" class="search-query" autocomplete="off" placeholder="<?php _e('Search','ocl-theme'); ?>" data-provide="typeahead" data-items="4" data-source='<?php echo $typeahead_data; ?>'>
          <button type="submit" class="btn btn-primary">Search</button>
        </form>
      </div>
    </div>
    <div class="navbar navbar-default">
      <div class="container nav-container">
        <div class="row">
          <div class="col-md-3 zero-pad-l zero-pad-r" id="logo">
            <div class="branding bluedark-bg" id="branding">
              <h1 class="brand"><a title="<?php echo get_bloginfo('title'); ?>" href="<?php echo home_url(); ?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/library/images/OCL-logo.png" alt="<?php bloginfo( 'name' ); ?>" /> <span class="hidden">
                <?php bloginfo('name'); ?>
                </span></a></h1>
            </div>
          </div>
          <div role="navigation" class="col-md-9"> 
            <button type="button" class="navbar-toggle" data-toggle="offcanvas"><div class="pull-left">Menu</div><div class="pull-right"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></div> </button>
            <div class="pull-right">
              <button type="button" class="navbar-search-btn hidden-sm hidden-xs" data-toggle="collapse" data-target="#search-site"><span class="glyphicon glyphicon-search"></span></button>
            </div>
            <nav class="sidebar-offcanvas">
              <?php ocl_main_nav(); // Adjust using Menus in Wordpress Admin ?>
              <div class="visible-sm visible-xs pad-one-lr">
              	<form class="navbar-search" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                  <input name="s" id="s" type="text" class="search-query form-control" autocomplete="off" placeholder="<?php _e('Search','ocl-theme'); ?>" data-provide="typeahead" data-items="4" data-source='<?php echo $typeahead_data; ?>'>
                  <button type="submit" class="btn btn-info mar-half-t">Search <i class="icon-search"></i></button>
                </form>
                <button type="button" class="btn pull-left" data-toggle="offcanvas">Close Menu <i class="icon-remove icon-large"></i></button>
              </div>
            </nav>
          </div>
        </div>
      </div></div>
      <div class="my-fade hidden-xs">
        <div class="container">
          <h2 class="tagline"><?php echo get_bloginfo('description'); ?></h2>
        
      </div>
      <!-- end .nav-container --> 
    </div>
    <!-- end .navbar --> 
    
  </div>
  <!-- end #inner-header --> 
  
</header>
<!-- end header -->
<?php if (is_front_page()){ ?>
<div class="bluelight-bg"><div class="container-fluid">
<div id="myCarousel" class="carousel slide">
      <ol class="carousel-indicators carousel-paginate hidden-xs">
        <?php 
			$post_num = 0;
            $query = new WP_Query(array( 'post_type' => 'slide'));
			while ( $query->have_posts() ) : $query->the_post();
			
			echo  '<li data-target="#myCarousel" data-slide-to="'.$post_num.'" ';
			 
			if($post_num == 0){ 
				echo 'class="active"';
			}
			echo '>*';
			
			$post_num++;
			echo '</li>';
			
			endwhile; ?>
      </ol>
      <!-- Carousel items -->
      <div class="carousel-inner">
        <?php 
			$post_num = 0;
            $query = new WP_Query(array( 'post_type' => 'slide'));
			while ( $query->have_posts() ) : $query->the_post();
			$post_num++;
			// Image swaps?
			$attachment_id = get_field('slide_image');
			if (is_mobile()){
				$size = "featured";
			} else {
				$size = "carousel";
			}
			$image = wp_get_attachment_image_src( $attachment_id, $size );
            echo '<div class="item ';
			if($post_num == 1){ 
				echo 'active';
			}
			echo '"><img src="';
			echo $image[0];
			echo '" alt="';
			the_title();
			echo '" /></div>';
			
			endwhile; ?>
      </div>
      <div class="left-fade"></div>
      <div class="right-fade"></div>
      <!-- Carousel nav -->
      <div class="visible-xs"><a class="carousel-control left" href="#myCarousel" data-slide="prev"><i class="icon-chevron-left"></i></a> <a class="carousel-control right" href="#myCarousel" data-slide="next"><i class="icon-chevron-right"></i></a></div>
    </div></div>
</div>
<div class="camel-bg">
<div class="container">
<? } else { ?>
<div class="cream-bg">
<div class="container">
<? } ?>
