<?php get_header(); ?>
<div id="content" class="clearfix row">
  <div id="main" class="col-md-8 clearfix alpha" role="main">
    <?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
      <header>
        <hgroup class="page-header">
          <h1 class="page-title" itemprop="headline">
            <?php the_title(); ?>
          </h1>
          <?php if (function_exists('the_subheading')) { the_subheading('<h2 class="subhead">', '</h2>'); } ?>
        </hgroup>
      </header>
      <!-- end article header -->
      
      <section class="post_content clearfix" itemprop="articleBody">
      <?php if (has_post_thumbnail()){
	  	echo '<div class="pad-one-b">';
		the_post_thumbnail('featured');
		echo '<h6 class="caption">';
		echo get_post(get_post_thumbnail_id())->post_content;
		echo '</h6></div>';
	  }
	  ?>
        <?php the_content(); ?>
      </section>
      <!-- end article section -->
      
      <footer>
        <?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags","ocl-theme") . ':</span> ', ', ', '</p>'); ?>
      </footer>
      <!-- end article footer --> 
      
    </article>
    <!-- end article -->
    
    <?php endwhile; ?>
  </div>
  <!-- end #main -->
  
  <?php get_sidebar(); // sidebar 1 ?>
</div>
<!-- end #content -->

<?php get_footer(); ?>
