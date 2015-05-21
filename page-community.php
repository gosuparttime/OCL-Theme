<?php
// Template Name: Community Page
//
get_header(); ?>

<div id="content" class="clearfix row">
  <div id="main" class="clearfix" role="main">
    <?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('col-sm-7 alpha clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
      <header>
        <div class="page-header">
          <h1 class="page-title" itemprop="headline">
            <?php the_title(); ?>
          </h1>
        </div>
      </header>
      <!-- end article header -->
      
      <section class="post_content clearfix" itemprop="articleBody">
        <?php the_content(); ?>
      </section>
      <!-- end article section -->
      
      <footer>
      <h3>Community Involvement</h3>
      <?php 
	  	$query = new WP_Query( 
		$args = array(
			'posts_per_page' => '-1',
			'post_type' => 'community-event',
			
			'order' => 'DESC',
    	) );
    	while ( $query->have_posts() ) : $query->the_post();
	  	echo '<h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
		the_excerpt();
		endwhile;
		?>
      </footer>
      <!-- end article footer --> 
      
    </article>
    <div class="col-sm-5">
      <?php 
	  	$query = new WP_Query( 
		$args = array(
			'posts_per_page' => '-1',
			'post_type' => 'community-event',
			
			'order' => 'DESC',
    	) );
    	while ( $query->have_posts() ) : $query->the_post();
	  	if (has_post_thumbnail()){
				the_post_thumbnail('study-photo');
			}
		endwhile;
		?>
    </div>
    <!-- end article -->
    <?php endwhile; ?>
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
    <div class="row"><h2>Awards</h2></div>
    <?php 
	$c = 0;
	$bpr = 2;	
	$award_types = get_terms( 'award-type' );
	foreach ( $award_types as $award_type ) {
	$query = new WP_Query( 
	$args = array(
	'posts_per_page' => '1',
	'post_type' => 'awards',
	'award-type' => $award_type->slug,
	'order' => 'DESC',
    ) );
    while ( $query->have_posts() ) : $query->the_post();
	if ($c == "0"){
		echo '<div class="row">';
	        echo '<div class="col-sm-6 alpha study-archive-item">';
		} else {
        	echo '<div class="col-sm-6 study-archive-item">';
		}
		echo '<h3>';
		echo $award_type->name;
		echo '</h3>';
      	if (has_post_thumbnail()){
			echo '<div class="row">';
			echo '<div class="col-xs-7">';
		}
		echo '<h5><a href="'.get_permalink().'">';
		echo get_the_title();
		echo '</a></h5>';
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
		
		$post_count = $award_type->count;
		$post_slug = $award_type->slug;
		$post_link = get_term_link( $award_type, 'award-type' );
		if ($post_count > "1"){
			if ($post_slug == "civic-education-award"){
				echo '<a href="../levi-l-smith-civic-education-award/" class="link-block mar-half-t">';
				echo 'All '.$award_type->name.' Recipients ';
				echo '<i class="icon-chevron-right"></i></a>';
			} 
		}
      	if (has_post_thumbnail()){
			echo '</div>';
			echo '<div class="col-xs-5">';
				the_post_thumbnail('study-photo');
			echo '</div>';
			echo '</div>';
			}
		
		echo '</div>';
		$c++;
		if ($c == $bpr){
			echo '</div>';
			$c = 0;
		}
	endwhile;
	wp_reset_postdata();
	}
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
        <?php get_sidebar('current'); // sidebar 1 ?>
      </div>
    </div>
  </aside>
</div>
<?php get_footer(); ?>
