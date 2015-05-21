<?php get_header(); ?>


<div id="content" class="clearfix row">
  <div id="main" class="col-md-8 alpha clearfix" role="main">
    <div class="page-header">
      <h1><?php _e("Study Search Results for: ","ocl-theme"); ?>"<?php echo esc_attr(get_search_query()); ?>"</h1>
    </div><?php
	wp_reset_postdata();
  	$exclude_ids = array();		
	$current = get_field('current_study', 'options');
	foreach ($current as $pagez){
		array_push($exclude_ids, $pagez->ID);
	}
	$args = array(
      'post_type'=> 'study',
	  'post_parent' => '0',
	  'paged' => $paged,
	  'order' => 'ASC',
	  'post__not_in' => $exclude_ids,
      's'    => $s,
	);
    query_posts($args);
	?>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
      <header>
        <hgroup>
          <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
            <?php the_title(); ?>
            </a></h3>
          <? $study_years = get_the_terms( $post->ID, 'study-year'); 
		  		foreach ($study_years as $study_year){
					echo '<h5>'.$study_year->name.' Study</h5>';
				}
		  ?>
        </hgroup>
      </header>
      <!-- end article header -->
      
      <section class="post_content clearfix">
        <?php 
		the_field('study_summary');
		echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="btn-primary">';
		echo 'Study Details <i class="icon-chevron-right"></i>';
		echo '</a>'; ?>
      </section>
      <!-- end article section -->
      
      
        <?php
		
	
		wp_reset_postdata(); 

    	?>
      
      <!-- end article footer --> 
      
    </article>
    <!-- end article -->
    
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
    
    <!-- this area shows up if there are no results -->
    
    <article id="post-not-found">
      <header>
        <h1>
          <?php _e("Not Found", "ocl-theme"); ?>
        </h1>
      </header>
      <section class="post_content">
        <p>
          <?php _e("Sorry, but the requested resource was not found on this site.", "ocl-theme"); ?>
        </p>
      </section>
      <footer> </footer>
    </article>
    <?php endif; ?>
  </div>
  <!-- end #main -->
  
  <?php get_sidebar('study_search'); // sidebar 1 ?>
</div>
<!-- end #content -->

<?php get_footer(); ?>
