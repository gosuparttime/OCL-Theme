<?php
// Template Name: OCL Topic Blog Page
//
get_header(); ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=1434457936778008";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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
      <div class="fb-follow" data-href="https://www.facebook.com/pages/Onondaga-Citizens-League/123310136554" data-width="450" data-height="300" data-colorscheme="light" data-layout="standard" data-show-faces="true"></div>
      </footer>
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
	$query = new WP_Query( 
	$args = array(
	'posts_per_page' => '-1',
	'post_type' => 'blogs',
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
		echo '<h4><a href="'.get_permalink().'">';
		echo get_the_title();
		echo '</a></h4>';
		the_content();
		if (has_post_thumbnail()){
			echo '</div>';
			echo '<div class="col-xs-5">';
				the_post_thumbnail('cover');
			echo '</div>';
			echo '</div>';
		}
		echo '<a class="btn-default" href="';
		echo get_field('blog_url');
		echo '"> Read the ';
		echo get_the_title();
		echo ' Blog <i class="icon-chevron-right"></i></a>'; 
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
