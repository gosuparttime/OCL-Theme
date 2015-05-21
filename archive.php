<?php get_header(); ?>
<div id="content" class="clearfix row">
  <div id="main" class="col-md-8 clearfix alpha" role="main">
    <div class="page-header">
      <?php if (is_category()) { ?>
      <h1 class="archive_title"> <span>
        <?php _e("Posts Categorized:", "ocl-theme"); ?>
        </span>
        <?php single_cat_title(); ?>
      </h1>
      <?php } elseif (is_tag()) { ?>
      <h1 class="archive_title"> <span>
        <?php _e("Posts Tagged:", "ocl-theme"); ?>
        </span>
        <?php single_tag_title(); ?>
      </h1>
      <?php } elseif (is_author()) { ?>
      <h1 class="archive_title"> <span>
        <?php _e("Posts By:", "ocl-theme"); ?>
        </span>
        <?php get_the_author_meta('display_name'); ?>
      </h1>
      <?php } elseif (is_day()) { ?>
      <h1 class="archive_title"> <span>
        <?php _e("Daily Archives:", "ocl-theme"); ?>
        </span>
        <?php the_time('l, F j, Y'); ?>
      </h1>
      <?php } elseif (is_month()) { ?>
      <h1 class="archive_title"> <span>
        <?php _e("Monthly Archives:", "ocl-theme"); ?>
        :</span>
        <?php the_time('F Y'); ?>
      </h1>
      <?php } elseif (is_year()) { ?>
      <h1 class="archive_title"> <span>
        <?php _e("Yearly Archives:", "ocl-theme"); ?>
        :</span>
        <?php the_time('Y'); ?>
      </h1>
      <?php } ?>
    </div>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php if (has_post_thumbnail()){ ?>
<div class="row">
  <aside class="col-sm-4 col-sm-push-8">
    <?php 
	  	the_post_thumbnail('cover');
		echo '<h6 class="caption">';
		echo get_post(get_post_thumbnail_id())->post_content;
		echo '</h6>';
	  
	  ?>
  </aside>
  <article id="post-<?php the_ID(); ?>" <?php post_class('col-sm-8 col-sm-pull-4 clearfix'); ?> role="article">
  <? } else { ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
    <? }  ?>
    <header>
      <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
        <?php the_title(); ?>
        </a></h2>
      <p class="meta">
        <?php _e("Posted", "ocl-theme"); ?>
        <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate>
          <?php the_date(); ?>
        </time>
      </p>
    </header>
    <!-- end article header -->
    
    <section class="post_content clearfix"> <?php echo excerpt(100); ?> </section>
    <!-- end article section -->
    
    <footer>
      <p class="tags">
        <?php the_tags('<span class="tags-title">' . __("Tags","ocl-theme") . ':</span> ', ' ', ''); ?>
      </p>
    </footer>
    <!-- end article footer --> 
    
  </article>
  <?php if (has_post_thumbnail()){ ?>
</div>
<? }  ?>
    
    <?php endwhile; ?>
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
    <?php else : ?>
    <article id="post-not-found">
      <header>
        <h1>
          <?php _e("No Posts Yet", "ocl-theme"); ?>
        </h1>
      </header>
      <section class="post_content">
        <p>
          <?php _e("Sorry, What you were looking for is not here.", "ocl-theme"); ?>
        </p>
      </section>
      <footer> </footer>
    </article>
    <?php endif; ?>
  </div>
  <!-- end #main -->
  
  <?php get_sidebar('news'); // sidebar 1 ?>
</div>
<!-- end #content -->

<?php get_footer(); ?>
