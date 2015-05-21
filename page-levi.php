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
    <div class="row">
    <div class="col-sm-7 alpha">
      <?php 
			

    $query = new WP_Query( 
	$args = array(
		'posts_per_page' => '-1',
		'post_type' => 'awards',
		'award-type' => 'civic-education-award',
		'order' => 'DESC',
    ) );
	
	
	
	
    while ( $query->have_posts() ) : $query->the_post();
		echo '<section class="mar-one-b" id="'.$post->post_name.'">';
		echo '<h4>';
		echo the_title();
		echo '</h4>';
		echo the_content();
		echo '<small class="mar-one-t-neg clearfix"><a href="#board-members">Back to Board Member Navigation <i class="icon-chevron-up"></i></a></small>';
		echo '</section>';
	
    
	
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
