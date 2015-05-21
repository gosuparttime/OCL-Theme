<?php
// Template Name: Award Pages
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
      
      <footer> </footer>
      <!-- end article footer --> 
      
    </article>
    <div class="col-sm-5">
      <?php if (has_post_thumbnail()){
				the_post_thumbnail('study');
			}
			
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
    <?php 
	$c = 0;
	$bpr = 2;	
	$award_types = get_field('award_type');
	$myAward = $award_types->slug;
	$query = new WP_Query( 
	$args = array(
	'posts_per_page' => '-1',
	'post_type' => 'awards',
	'award-type' => $myAward,
	'order' => 'DESC',
    ) );
    while ( $query->have_posts() ) : $query->the_post();
	if ($c == "0"){
		echo '<div class="row">';
	        echo '<div class="col-sm-6 alpha study-archive-item">';
		} else {
        	echo '<div class="col-sm-6 study-archive-item">';
		}
		
      	if (has_post_thumbnail()){
			echo '<div class="row">';
			echo '<div class="col-xs-7">';
		}
		echo '<h4>';
		if($post->post_content != "") : 
		echo '<a href="'.get_permalink().'">';
		endif;
		echo get_the_title();
		if($post->post_content != "") : 
		echo '</a>';
		endif;
		echo '</h4>';
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
