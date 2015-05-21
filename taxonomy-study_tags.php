<?php get_header(); ?>
<div id="content" class="clearfix row">
  <div id="main" class="col-md-8 alpha clearfix" role="main">
    <div class="page-header">
      <h1>Study Archive</h1>
      <?php if (is_tax('study_tags')) { ?>
      <h2 class="subheading"> <span>
        <?php _e("Studies Tagged:", "ocl-theme"); ?>
        </span>
        <?php single_cat_title(); ?>
      </h2>
      <?php } ?>
    </div>
    <?php
	//print_r($wp_query->query_vars);
		$exclude_ids = array();		
		$current = get_field('current_study', 'options');
		foreach ($current as $pagez){
			array_push($exclude_ids, $pagez->ID);
		}
		$myType = get_query_var('study_tags');
		//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
                'post_type'=> 'study',
				'post_parent' => '0',
				'posts_per_page' => '-1',
				'order' => 'ASC',
				'post__not_in' => $exclude_ids,
				'study_tags' => $myType,
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
        <?php if (get_field('study_cover')){
				$attachment_id = get_field('study_cover');
				$size = "thumbnail";
				$image = wp_get_attachment_image_src( $attachment_id, $size );
				$full = wp_get_attachment_image_src( $attachment_id, 'full' );
				$attachment = get_post( get_field('study_cover') );
				$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
            	echo '<div class="col-xs-3 pull-right">';
				echo '<a href="';
				echo $full[0];
				echo '" rel="lightbox['.$post->slug.']"><img src="';
				echo $image[0];
				echo '" alt="';
				echo $alt;
				echo '" class="thumbnail"/></a></div>';
			}
		the_field('study_summary');
		echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="btn-primary">';
		echo 'Study Details <i class="icon-chevron-right"></i>';
		echo '</a>'; ?>
      </section>
      <!-- end article section -->
      
      
        
      
      <!-- end article footer --> 
      
    </article>
    <!-- end article -->
    
    <?php endwhile; ?>
    <?php /*  if (function_exists('page_navi')) { // if expirimental feature is active 
    page_navi(); // use the page navi function 
    } else { // if it is disabled, display regular wp prev & next links 
    echo '<nav class="wp-prev-next">';
    echo '<ul class="clearfix">';
    echo '<li class="prev-link">';
    next_posts_link(_e('&laquo; Older Entries', "ocl-theme"));
    echo ' </li>';
    echo '<li class="next-link">';
    previous_posts_link(_e('Newer Entries &raquo;', "ocl-theme"));
    echo '</li>';
    echo '</ul>';
    echo '</nav>';
    } */ ?>
    <?php else : ?>
    <article id="post-not-found">
      <header>
        <h1>
          <?php _e("Yo Posts Yet", "ocl-theme"); ?>
        </h1>
      </header>
      <section class="post_content">
        <p>
          <?php _e("Sorry, What you were looking for is not here.", "ocl-theme"); ?>
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
