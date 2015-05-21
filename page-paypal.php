<?php //
// Template Name: PayPal Page
//
get_header(); ?>

<div id="content" class="clearfix row">
  <div id="main" class="col-md-8 clearfix alpha" role="main">
    <?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
      <header>
        <hgroup class="page-header">
          <h1 class="page-title" itemprop="headline">
            <?php the_title(); ?>
          </h1>
          <?php if (function_exists('the_subheading')) { the_subheading('<h2 class="subhead">', '</h2>'); } ?>
        </hgroup>
      </header>
      <!-- end article header -->
      
      <section class="post_content clearfix" itemprop="articleBody">
        <?php if (has_post_thumbnail()){
	  	echo '<div class="pad-one-b">';
		the_post_thumbnail('featured');
		echo '<h6 class="caption">';
		echo get_post(get_post_thumbnail_id())->post_content;
		echo '</h6></div>';
	  }
	  ?>
        <?php the_content(); ?>
      </section>
      <!-- end article section -->
      
      <footer>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
          <input type="hidden" name="cmd" value="_s-xclick">
          <input type="hidden" name="hosted_button_id" value="GSS9P4JF3XKNU">
          <div class="row">
            <div class="col-xs-12">
              <input type="hidden" name="on0" value="Membership/Renewal levels">
              <h5>Membership/Renewal levels</h5>
              <select name="os0" class="form-control">
                <option value="Lifetime">Lifetime $500.00 USD</option>
                <option value="Individual Supporting">Individual Supporting $100.00 USD</option>
                <option value="Individual Basic">Individual Basic $50.00 USD</option>
                <option value="Student">Student $10.00 USD</option>
                <option value="Corporate Sustaining">Corporate Sustaining $500.00 USD</option>
                <option value="Corporate Supporting">Corporate Supporting $250.00 USD</option>
                <option value="Corporate Basic">Corporate Basic $100.00 USD</option>
              </select>
            </div>
          </div>
          <div class="row pad-one-t">
            <div class="col-xs-12">
              <input type="hidden" name="currency_code" value="USD">
              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            </div>
          </div>
          <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>
      </footer>
      <!-- end article footer --> 
      
    </article>
    <!-- end article -->
    
    <?php endwhile; ?>
  </div>
  <!-- end #main -->
  
  <?php get_sidebar(); // sidebar 1 ?>
</div>
<!-- end #content -->

<?php get_footer(); ?>
