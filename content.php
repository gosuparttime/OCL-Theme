<?php if (has_post_thumbnail()){ ?>
<div class="row">
  <aside class="col-sm-4 col-sm-push-8">
    <?php 
	  	the_post_thumbnail('cover');  
	  ?>
  </aside>
  <article id="post-<?php the_ID(); ?>" <?php post_class('col-sm-8 col-sm-pull-4 clearfix'); ?> role="article">
  <? } else { ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
    <? }  ?>
  <header>
    <h3 class="no-rule"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
      <?php the_title(); ?>
      </a></h3>
    <p class="meta">
      <?php _e("Posted", "ocl-theme"); ?>
      <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate>
        <?php the_date(); ?>
      </time>
      <span class="amp">&</span> <?php _e("filed under", "ocl-theme"); ?> <?php the_category(', '); ?>.
    </p>
  </header>
  <!-- end article header -->
  
  <section class="post_content clearfix"> <?php echo excerpt(100); ?> </section>
  <!-- end article section -->
  
  <footer>
    <p class="tags">
      <?php the_tags('<span class="tags-title">' . __("Tags","ocl-theme") . ':</strong></span> ', ' ', ''); ?>
    </p>
  </footer>
  <!-- end article footer --> 
  
</article>
  <?php if (has_post_thumbnail()){ ?>
</div>
<? }  ?>
<!-- end article --> 
