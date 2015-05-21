<?php
// Template Name: Studies Template
//
get_header(); ?>
<?php 
	
	while (have_posts()) : the_post(); ?>

<div id="content" class="clearfix row">
  <div id="main" class="clearfix" role="main">
  <aside class="col-sm-5 col-sm-push-7">
      <?php if (has_post_thumbnail()){
	  	the_post_thumbnail('cover');
		echo '<h6 class="caption">';
		echo get_post(get_post_thumbnail_id())->post_content;
		echo '</h6>';
	  }
	  ?>
    </aside>
    <article id="post-<?php the_ID(); ?>" <?php post_class('col-sm-7 col-sm-pull-5 alpha clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
      <header>
        <hgroup class="page-header">
          <h1 class="page-title" itemprop="headline">
            <? the_title(); ?>
          </h1>
         <?php if (function_exists('the_subheading')) { the_subheading('<h2 class="subhead">', '</h2>'); } ?>
        </hgroup>
      </header>
      <!-- end article header -->
      
      <section class="post_content clearfix" itemprop="articleBody">
        <?php the_content(); ?>
      </section>
      <!-- end article section -->
      
     </article>
    
    <!-- end article --> 
    
  </div>
  <!-- end #main --> 
  
</div>
</div>
</div>
<!-- end #content -->
<?php endwhile; ?>
<div class="cream-bg divider"></div>
<div class="bluelight-bg">
  <aside class="container" role="complementary">
    <div class="pad-one-tb clearfix">
      <div class="row">
        <?php get_sidebar('study'); // sidebar 1 ?>
      </div>
    </div>
  </aside>
</div>
<?php get_footer(); ?>
