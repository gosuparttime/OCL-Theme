<?php get_header(); ?>

<div id="content" class="clearfix row">
  <div id="main" class="col-md-8 clearfix alpha" role="main">

  	<?php if ( have_posts() ) : ?>
  	<h1 class="page-title" itemprop="headline">
            <?php single_post_title(); ?>
    </h1>
    <?php 
	$coco = 0;
	while (have_posts()) : the_post(); ?>
    <?php 
	$coco++;
	if ($coco == "1" && $paged == 1){
		get_template_part( 'content', 'first' );
	} else {
		get_template_part( 'content', get_post_format() );
	}
	?>
    <?php endwhile; ?>
    <?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
    <?php page_navi(); // use the page navi function ?>
    <?php } else { // if it is disabled, display regular wp prev & next links ?>
    <nav class="wp-prev-next">
      <ul class="clearfix">
        <li class="prev-link">
          <?php next_posts_link(_e('&laquo; Older Entries', "ocl-theme")) ?>
        </li>
        <li class="next-link">
          <?php previous_posts_link(_e('Newer Entries &raquo;', "ocl-theme")) ?>
        </li>
      </ul>
    </nav>
    <?php } ?>
    <?php else : ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
  </div>
  <!-- end #main -->
  
  <?php get_sidebar('news'); // sidebar 1 ?>
</div>
<!-- end #content -->

<?php get_footer(); ?>
