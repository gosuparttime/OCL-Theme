<?php get_header(); ?>
<?php 
	
	while (have_posts()) : the_post(); ?>

<div id="content" class="clearfix row">
  <div id="main" class="clearfix" role="main">
    <aside class="col-sm-5 col-sm-push-7">
      <?php if (has_post_thumbnail()){
	  	the_post_thumbnail('cover');
		echo '<h6 class="caption">';
		echo get_post(get_post_thumbnail_id())->post_content;
		echo '</h6>';
	  }
	  ?>
    </aside>
    <article id="post-<?php the_ID(); ?>" <?php post_class('col-sm-7 col-sm-pull-5 alpha clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
      <header>
        <hgroup class="page-header">
          <h1 class="page-title" itemprop="headline">
            <? the_title(); ?>
          </h1>
          <?php if (function_exists('the_subheading')) { the_subheading('<h2 class="subhead">', '</h2>'); } ?>
        </hgroup>
      </header>
      <!-- end article header -->
      
      <section class="post_content clearfix" itemprop="articleBody">
        <?php the_content(); ?>
      </section>
      <!-- end article section -->
      
      <footer class="pad-one-tb">
        <?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
        <?php page_navi(); // use the page navi function ?>
        <?php } else { // if it is disabled, display regular wp prev & next links ?>
        <nav class="wp-prev-next">
          <ul class="clearfix">
            <li class="prev-link">
              <?php next_posts_link(_e('&laquo; Older Entries', "ocl-theme")) ?>
            </li>
            <li class="next-link">
              <?php previous_posts_link(_e('Newer Entries &raquo;', "ocl-theme")) ?>
            </li>
          </ul>
        </nav>
        <?php } ?>
      </footer>
      <!-- end article footer --> 
      
    </article>
    
    <!-- end article --> 
    
  </div>
  <!-- end #main --> 
  
</div>
</div>
</div>
<!-- end #content -->
<?php endwhile; ?>
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
<!-- end #content -->

<?php get_footer(); ?>
