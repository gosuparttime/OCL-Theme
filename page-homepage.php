<?php
/*
Template Name: Homepage
*/
?>
<?php get_header(); ?>

<div id="content" class="clearfix row">
  <div id="main" class="col-xs-12 clearfix" role="main">
    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
      <section class="row post_content">
        <div class="col-sm-7 lead alpha">
          <?php while (have_posts()) : the_post(); ?>
          <?php the_content(); ?>
          <?php endwhile; ?>
        </div>
        <div class="col-sm-5 omega">
          <?php
		$study = get_field('featured_study', 'options');
		foreach($study as $post){
			$featured_study = $post->ID;
		}
		$query = new WP_Query(array( 'post_type' => 'study', 'page_id' => $featured_study));
    	while ( $query->have_posts() ) : $query->the_post(); ?>
          <div class="row">
            <div class="col-sm-7">
              <h3 class="zero-mar-t">Featured Study</h3>
              <?php 
			    if (get_field('study_excerpt')){
					the_field('study_excerpt');
				} else {
					the_field('study_summary');
				}
				echo '<a class="btn-default" href="'.get_permalink().'" title="'.get_the_title().'">';
				echo 'Learn More About "';
				echo get_the_title();
				echo '"&nbsp;<i class="icon-chevron-right"></i>';
				echo '</a>';
				?>
            </div>
            <div class="col-sm-5 hidden-xs">
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
          </div>
          <? endwhile; 
		  wp_reset_postdata();?>
        </div>
      </section>
      <!-- end article header -->
      
      <footer> </footer>
      <!-- end article footer --> 
      
    </article>
    <!-- end article --> 
    
  </div>
  <!-- end #main --> 
  
</div>
</div>
</div>
<div class="cream-bg">
  <div class="container">
    <div class="row">
      <?php
		$study = get_field('current_study', 'options');
		foreach($study as $post){
			$featured_study = $post->ID;
		}
		$query = new WP_Query(array( 'post_type' => 'study', 'page_id' => $featured_study));
    	while ( $query->have_posts() ) : $query->the_post(); ?>
        <div class="col-sm-7 alpha">
          <div class="pad-one-tb">
            <h2>
              <? the_title(); ?>
            </h2>
            <?php
               echo '<h5>';
				$study_years = get_the_terms( $post->ID, 'study-year'); 
				foreach ($study_years as $study_year){
					echo $study_year->name;
				}
				echo ' Study</h5>';
              the_field('study_summary');
				echo '<a class="btn-primary" href="/studies/current-study/" title="'.get_the_title().'">';
				echo 'Study Details <i class="icon-chevron-right"></i>';
				echo '</a>';
				?>
          </div>
        </div>
        <div class="col-sm-5 hidden-xs">
          <?php if (get_field('study_cover')){
				$attachment_id = get_field('study_cover');
				$size = "study-photo";
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
      <? endwhile; 
		  wp_reset_postdata();?>
    </div>
  </div>
</div>
<div class="bluelight-bg pad-two-tb">
<div class="container">
<div class="row">
  <div class="col-sm-7 alpha hidden-xs">
    <div class="bluedark-bg mar-two-b">
      <h3 class="block">OCL In The Community</h3>
      <? display_community(); ?>
    </div>
    <div class="blue-bg mar-one-b">
      <? display_quotes(); ?>
    </div>
  </div>
  <div class="col-sm-5 omega">
    <h3>OCL News</h3>
    <ul class="list-unstyled">
      <?php
		$args = array( 'posts_per_page' => 3 );
		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
      	<li><a href="<? echo get_permalink(); ?>"><h5 class="blue-text"><?php the_title(); ?></h5></a>
		<?php the_excerpt();?>
        </li>
      	<?php
        endforeach; 
		wp_reset_postdata();
		?>
    </ul>
    <a class="btn-default mar-one-t" href="/news-events/current-news/">See All OCL News <i class="icon-chevron-right"></i></a>
  </div>
</div>

<!-- end #content -->

<?php get_footer(); ?>
