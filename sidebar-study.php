<div id="sidebar1" class="fluid-sidebar sidebar" role="complementary">
  <?php if ( is_active_sidebar( 'sidebar-study' ) ) : ?>
  <?php dynamic_sidebar( 'sidebar-study' ); ?>
  <?php else : ?>
  
  <!-- This content shows up if there are no widgets defined in the backend. -->
  
  <div class="alert alert-message">
    <p>
      <?php _e("Please activate some Widgets","ocl-theme"); ?>
      .</p>
  </div>
  <?php endif; ?>
</div>
