<?php
// Template Name: Board Of Directors Page
//
get_header(); ?>
<?php
	if (isset($_POST['nav'])) {
		 header("Location: $_POST[nav]");
	}
?>
<div id="content" class="clearfix row">
  <div id="main" class="col-md-8 clearfix alpha" role="main">
    <?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
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
      </footer>
      <!-- end article footer --> 
      
    </article>
    <!-- end article -->
    
    <?php endwhile; ?>
    <article id="board-members" class="pad-one-t">
    	<?php 
			

    $query = new WP_Query( 
	$args = array(
		'posts_per_page' => '-1',
		'post_type' => 'staff',
		'order' => 'ASC',
		'orderby'   => 'menu_order',
    ) );
	
	echo '<form id="page-changer" class="pad-one-b">';
	echo '<select name="nav" class="form-control">';
	echo '<option value="">Select Board Member</option>';
	$query = new WP_Query($args);
	 while ( $query->have_posts() ) : $query->the_post();
		echo '<option value="#'.$post->post_name.'">';
		echo the_title();
		echo '</option>';
	endwhile;
	echo '</select>';
	echo '<input type="submit" value="Go" id="page-change" />';
	echo '</form>';
	
    while ( $query->have_posts() ) : $query->the_post();
		echo '<section class="mar-one-b" id="'.$post->post_name.'">';
		echo '<h4>';
		echo the_title();
		echo '</h4>';
		if (get_field('board_position')){
			echo '<h6>OCL Board Member: ';
			$myTax = get_field('board_position');
			$term = get_term($myTax, 'staff-type');
			echo $term->name;
			echo '</h6>';
		}
		echo the_content();
		echo '<small class="mar-one-t-neg clearfix"><a href="#board-members">Back to Board Member Navigation <i class="icon-chevron-up"></i></a></small>';
		echo '</section>';
	endwhile;
	
	wp_reset_postdata();
    
	
	?>
    </article>
  </div>
  <!-- end #main -->
  
  <?php get_sidebar(); // sidebar 1 ?>
</div>
<!-- end #content -->

<?php get_footer(); ?>
