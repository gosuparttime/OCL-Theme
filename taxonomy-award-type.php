<?php get_header(); ?>
<div id="content" class="clearfix row">
  <div id="main" class="col-md-8 alpha clearfix" role="main">
    <header class="page-header">
      <hgroup>
        <h1>Award Archive</h1>
        <?php if (is_tax('award-type')) { ?>
        <h2 class="subheading">
          <?php single_cat_title(); ?>
        </h2>
        <?php } ?>
      </hgroup>
    </header>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
      <header>
        <h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
          <?php the_title(); ?>
          </a></h3>
        <p class="meta">
          <?php _e("Posted", "ocl-theme"); ?>
          <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate>
            <?php the_date(); ?>
          </time>
          <?php _e("by", "ocl-theme"); ?>
          <?php the_author_posts_link(); ?>
          <span class="amp">&</span>
          <?php _e("filed under", "ocl-theme"); ?>
          <?php the_category(', '); ?>
          .</p>
      </header>
      <!-- end article header -->
      
      <section class="post_content">
        <?php the_post_thumbnail( 'wpbs-featured' ); ?>
        <?php the_excerpt(); ?>
      </section>
      <!-- end article section -->
      
      <footer> </footer>
      <!-- end article footer --> 
      
    </article>
    <!-- end article -->
    
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
  
  <?php get_sidebar(); // sidebar 1 ?>
</div>
<!-- end #content -->

<?php get_footer(); ?>
