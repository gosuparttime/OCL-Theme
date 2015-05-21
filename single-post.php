<?php 
// Single Page for News Posts
get_header(); 
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
	  get_sidebar('article');
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
        <p class="meta">
        <?php _e("Posted", "ocl-theme"); ?>
        <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate>
          <?php the_date(); ?>
        </time>
        <span class="amp">&</span> <?php _e("filed under", "ocl-theme"); ?> <?php the_category(', '); ?>.
      </p>
      </header>
      <!-- end article header -->
      
      <section class="post_content clearfix" itemprop="articleBody">
        <?php the_content(); ?>
      </section>
      <!-- end article section -->
      
      <footer class="pad-one-tb">
      
       <?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags","ocl-theme") . ':</span> ', ' ', '</p>'); ?>
       <a href="/news-events/current-news/" class="btn-default"><i class="icon-chevron-left"></i> Back to OCL News</a>
       
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
<!-- If Gallery is selected -->
<? $mygallery = get_field('add_gallery');
if ($mygallery){
	?>
<div class="bluelight-bg divider"></div>
<div class="camel-bg">
  <aside class="container" role="complementary">
    
      <div class="pad-one-tb clearfix"><div class="row">
      	
        <?
        echo '<h3>';
		echo get_field('gallery_title');
		echo '</h3>';
		$newgallery = get_field('choose_gallery');
		echo do_shortcode('[nggallery id='.$newgallery.']');
		?>
    </div>
  </aside>
</div>
<? } ?>
<!-- End Gallery -->
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