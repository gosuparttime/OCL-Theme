<?php
// Template Name: Current Study
//
get_header(); ?>
<?php 
	$posts = get_field('current_study', 'options');
	foreach( $posts as $post){
		setup_postdata($post);
	}
	
	while (have_posts()) : the_post(); ?>

<div id="content" class="clearfix row">
  <div id="main" class="clearfix" role="main">
    <article id="post-<?php the_ID(); ?>" <?php post_class('col-sm-7 alpha clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
      <header>
        <hgroup class="page-header">
          <h1 class="page-title" itemprop="headline">Current Study</h1>
          <h2 class="subhead">
            <?php the_title(); ?>
          </h2>
          <? $study_years = get_the_terms( $post->ID, 'study-year'); 
		  		foreach ($study_years as $study_year){
					echo '<h5>'.$study_year->name.' Study</h5>';
				}
		  ?>
        </hgroup>
      </header>
      <!-- end article header -->
      
      <section class="post_content clearfix" itemprop="articleBody">
        <?php the_field('study_summary');
			?>
      </section>
      <!-- end article section -->
      
      <footer>
	  <?php 
		$attachment_id = get_field('study_pdf');
		$url = $attachment_id['url'];
		$title = $attachment_id['title'];
		$subtext = $attachment_id['description'];
		if( get_field('study_pdf') ):
			echo '<div class="clearfix pad-half-b">';
			echo '<h4>View The Study</h4>';
			echo '<a class="btn btn-download" href="';
			echo $url;
			echo '" target="_blank"><i class="icon-download icon-2x pull-right"></i>';
			echo $title;
			echo ' <br/>';
			echo '<small><em>';
			echo $subtext;
			echo '</em></small></a></div>';
		endif;
		?>

        </footer>
      <!-- end article footer --> 
      
    </article>
    <div class="col-sm-5">
      <?php if (get_field('study_cover')){
				$attachment_id = get_field('study_cover');
				$size = "featured";
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
</div></div>
<!-- end #content -->
<div class="bluelight-bg divider"></div>
<div class="camel-bg">
  <aside class="container" role="complementary">
    
      <div class="pad-one-tb clearfix"><div class="row">
        <div class="col-sm-7 alpha">
          <h3>More On
            <?php the_title(); ?>
          </h3>
          <? $links = get_field('study_links');
		if( $links ): ?>
          <ul class="list-unstyled">
            <?php foreach( $links as $link): ?>
            <li> <a href="<?php echo get_permalink($link->ID); ?>" class="btn-primary"><?php echo get_the_title($link->ID); ?> <i class="icon-chevron-right"></i></a> </li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
          
        </div>
        <div class="col-sm-5">
          <h3>
            <?php the_title(); ?>
            News</h3>
            <? $mycat = $post->post_name;
			$myTitle = get_the_title();
			$query = new WP_Query(array( 'post_type' => 'post', 'category_name' => $mycat, 'posts_per_page' => '5'));
			if ( $query->have_posts() ) :
			echo '<ul class="list-unstyled">';
			while ( $query->have_posts() ) : $query->the_post();
				echo '<li>';
				echo '<a href="'.get_permalink().'">';
				echo get_the_title();
				echo '&nbsp;<i class="icon-chevron-right"></i></a>';
				echo '</li>';
			endwhile;
			echo '</ul>';
			echo '<a href="/blog/OCL/'.$mycat.'/" class="btn-default link-block">';
			echo 'See all posts under '.$myTitle.'&nbsp;<i class="icon-chevron-right"></i></a>';
			else :
			echo '<p>No Posts Available At This Time</p>';
			echo '<a href="/news-events/current-news/" class="btn-default">';
			echo 'See all OCL News Articles <i class="icon-chevron-right"></i></a>';
			endif;
			wp_reset_postdata();			
			?>
        </div>
      </div>
    </div>
  </aside>
</div>
<?php endwhile;
	wp_reset_postdata();
	?>
<div class="cream-bg divider"></div>
<div class="bluelight-bg">
  <aside class="container" role="complementary">
    
      <div class="pad-one-tb clearfix"><div class="row">
        <?php get_sidebar('current'); // sidebar 1 ?>
      </div>
    </div>
  </aside>
</div>
<?php get_footer(); ?>
