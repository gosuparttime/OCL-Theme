<?php
// Template Name: Past Studies - Single Page
//
get_header(); ?>
<?php 
	
	while (have_posts()) : the_post(); ?>

<div id="content" class="clearfix row">
  <div id="main" class="clearfix" role="main">
    <article id="post-<?php the_ID(); ?>" <?php post_class('col-sm-7 alpha clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
      <header>
        <hgroup class="page-header">
          <h1 class="page-title" itemprop="headline">
          <? 
		  $current = get_field('current_study', 'options');
			foreach ($current as $pagez){
				$currentStudy = $pagez->ID;
			}
		  $present = get_the_ID();
		  $parents = $post->post_parent;
		  if ($present == $currentStudy || $parents == $currentStudy){
			  	echo 'Current Study';
		  } else {
          		echo 'Study Report';
		  } ?>
          </h1>
          
            <?php 
				echo '<h2 class="subheading">';
				the_title();
				echo '</h2>';
			?>
          
          <? 
		  if(is_post_type('study') && $post->post_parent ){
				echo '<h3>';
				echo get_the_title($post->post_parent);
				echo '</h3>';
			}
		  $study_years = get_the_terms( $post->ID, 'study-year'); 
		  		foreach ($study_years as $study_year){
					echo '<h5>'.$study_year->name.' Study</h5>';
				}
		  ?>
        </hgroup>
      </header>
      <!-- end article header -->
      
      <section class="post_content clearfix" itemprop="articleBody">
        <?php if(is_post_type('study') && $post->post_parent ){
			the_content();
			echo '<hr />';
			echo '<a class="link-block mar-half-t" href="';
			echo get_permalink($post->post_parent);
			echo '"><i class="icon-chevron-left"></i> Back to "';
			echo get_the_title($post->post_parent);
			echo '"</a>';
		}else{
			get_template_part('content', 'study');
		}; ?>
      </section>
      <!-- end article section -->
      
      <footer class="pad-one-tb"><?php 
	$exclude_ids = array();		
	$current = get_field('current_study', 'options');
	foreach ($current as $pagez){
		array_push($exclude_ids, $pagez->ID);
	}
	$exclude = get_the_ID();
	array_push($exclude_ids, $exclude);
    $query = new WP_Query( 
	$args = array(
		'posts_per_page' => '-1',
		'post_type' => 'study',
		'post_parent' => '0',
		'order' => 'ASC',
		'orderby'   => 'menu_order',
		'post__not_in' => $exclude_ids,
    ) );
	echo '<h4>Past Studies</h4>';
	echo '<form id="page-changer" class="pad-one-b">';
	echo '<select name="nav" class="form-control">';
	echo '<option value="">Select Study</option>';
	$query = new WP_Query($args);
	while ( $query->have_posts() ) : $query->the_post();
		echo '<option value="'.get_permalink($post).'">';
		$study_years = get_the_terms( $post->ID, 'study-year'); 
		foreach ($study_years as $study_year){
			echo $study_year->name.' - ';
		}
		echo the_title();
		echo '</option>';
	endwhile;
	echo '</select>';
	echo '<input type="submit" value="Go" id="page-change" />';
	echo '</form>';
	wp_reset_postdata();
	?>
    <a href="/studies/past-studies/" class="btn-default">View All Studies <i class="icon-chevron-right"></i></a></footer>
      <!-- end article footer --> 
      
    </article>
    <div class="col-sm-5">
      <?php if (get_field('study_cover')){
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
			
			?>
    </div>
    <!-- end article --> 
    
  </div>
  <!-- end #main --> 
  
</div>
</div>
</div>
<!-- end #content -->
<?php endwhile;
	wp_reset_postdata();
	?>
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
