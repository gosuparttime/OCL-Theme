<? get_header(); 

	  
?>
<div id="content" class="clearfix row">
  <div id="main" class="col-md-8 alpha clearfix" role="main">
    <div class="page-header">
    
      <h1><span>
        <?php _e("Search Results for","ocl-theme"); ?>
        :</span> <?php echo esc_attr(get_search_query()); ?></h1>
    </div>
    <?php
  	

	if (have_posts()) : while (have_posts()) : the_post(); 
	?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
      <header>
        <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
          <?php the_title(); ?>
          </a></h3>
        
      </header>
      <!-- end article header -->
      
      <section class="post_content">
        <?php if('study' == get_post_type()){
				the_field('study_summary');
				echo '<a href="'.get_permalink().'" title="'.get_the_title().'">';
				echo 'Study Details <i class="icon-chevron-right"></i>';
				echo '</a>'; 
		} else if('awards' == get_post_type()){
			$rows = get_field('award_winners');
			if ($rows){
					foreach($rows as $row){
					echo '<p class="zero-mar-b"><strong>Award Recipient: </strong>';
					echo $row['award_winner'];
					echo '</p>';
					if ($row['winner_title']){
						echo '<h6 class="zero-mar-t">';
						echo $row['winner_title'];
						echo '</h6>';
					}
				}
			}
			echo excerpt(100);
			
			
		} else {
			echo excerpt(100);
		} ?>
      </section>
      <!-- end article section -->
      
      <footer> </footer>
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
  
  <?php get_sidebar(); // sidebar 1 ?>
</div>
<!-- end #content -->

<?php get_footer(); ?>
