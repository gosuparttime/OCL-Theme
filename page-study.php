<?php
// Template Name: Past Studies
//
get_header(); ?>

<div id="content" class="clearfix row">
  <div id="main" class="clearfix" role="main">
    <?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('col-md-7 alpha clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
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
        <?php the_content();?>
      </section>
      <aside class="pad-one-b clearfix" itemprop="articleBody">
        <h4>Search OCL Studies</h4>
        <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
          <div class="col-xs-9 pad-half-b">
            <input name="s" id="s" type="text" class="form-control" autocomplete="off" placeholder="<?php _e('Search','ocl-theme'); ?>" data-provide="typeahead" data-items="4" data-source='<?php echo $typeahead_data; ?>'>
            <input type="hidden" name="post_type" value="study" />
          </div>
          <div class="col-xs-3 pad-half-b">
            <button type="submit" class="btn btn-info">Search <i class="icon-search"></i></button>
          </div>
        </form>
      </aside>
      <aside class="pad-one-b clearfix" itemprop="articleBody">
        <h4>Choose From Common Keywords</h4>
        <?php
			$args = array( 'taxonomy' => 'study_tags' );
			$terms = get_terms('study_tags', $args);
			$count = count($terms); $i=0;
			if ($count > 0) {
				$term_list = '<ul class="list-inline zero-mar-b">';
				foreach ($terms as $term) {
					$i++;
					$term_list .= '<li><a href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all post filed under %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a></li>';
					if ($count != $i) $term_list .= '<li>&middot;</li> '; else $term_list .= '</ul>';
				}
				echo $term_list;
			}
			?>
      </aside>
      <!-- end article section -->
      
      <!-- end article footer --> 
      
    </article>
    <!-- end article -->
    <?php endwhile;	?>
    <div class="col-sm-5 hidden-xs hidden-sm">
      <?php 
	$posts = get_field('featured_study', 'options');
	foreach( $posts as $post){
		setup_postdata($post);
	}
	while (have_posts()) : the_post(); 
       if (get_field('study_cover')){
			$attachment_id = get_field('study_cover');
			$size = "cover";
			$image = wp_get_attachment_image_src( $attachment_id, $size );
			$attachment = get_post( get_field('study_cover') );
			$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
            echo '<img src="';
			echo $image[0];
			echo '" alt="';
			echo $alt;
			echo '" />';
		}
	endwhile;	
	wp_reset_postdata();
	?>
    </div>
  </div>
  <!-- end #main --> 
  
</div>
</div>
</div>
<!-- end #content -->
<div class="bluelight-bg divider"></div>
<div class="camel-bg">
  <aside class="container" role="complementary">
    <div class="pad-one-tb clearfix">
      <div class="row">
        <div class="alpha col-xs-12"><h3>Study Archives</h3></div>
      </div>
      <?php 
	  	$c = 0;
	  	$bpr = 2;
		$exclude_ids = array();		
		$current = get_field('current_study', 'options');
		foreach ($current as $pagez){
			array_push($exclude_ids, $pagez->ID);
		}
	  	
	  	$args = array(
			'posts_per_page' => '-1',
			'post_type' => 'study',
			'post_parent' => '0',
			'order' => 'ASC',
			'orderby'   => 'menu_order',
			'post__not_in' => $exclude_ids,
		);
		$query = new WP_Query($args);
		
	 	while ( $query->have_posts() ) : $query->the_post();
      	if ($c == "0"){
			echo '<div class="row">';
	        echo '<div class="col-sm-6 alpha study-archive-item">';
		} else {
        	echo '<div class="col-sm-6 study-archive-item">';
		}
		
		echo '<h4 class="zero-mar-b"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h4>';
		echo '<h5>';
		$study_years = get_the_terms( $post->ID, 'study-year'); 
		foreach ($study_years as $study_year){
			echo $study_year->name;
		}
		echo ' Study</h5>';
		echo '<p>';
		echo get_the_term_list( $post->ID, 'study_tags', '<strong>Keywords: </strong>', ', ', '' ); 
		echo '</p>';
		echo '</div>';
		$c++;
		if ($c == $bpr){
			echo '</div>';
			$c = 0;
		}
		endwhile;
		wp_reset_postdata();
		?>
    </div>
  </aside>
</div>
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
