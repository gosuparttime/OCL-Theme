</div>
</div>
<? wp_reset_postdata();
wp_reset_query();
?>

<footer class="container" role="contentinfo">
  <div class="row" id="back-to-top"><div class="col-xs-12"><a href="#wrapper" class="btn">Back to top <i class="icon-chevron-up"></i></a></div></div>
  <div id="inner-footer" class="clearfix">
    <div class="row">
      <div class="col-sm-6 col-sm-push-6 col-xs-12 col-xs-push-0">
        <nav class="clearfix" id="footer-nav">
          <?php ocl_footer_links(); ?>
        </nav>
        <nav class="clearfix pad-one-t" id="utility-nav">
          <?php ocl_utility_links(); ?>
        </nav>
        <div id="social">
          <p><a href="https://www.facebook.com/pages/Onondaga-Citizens-League/123310136554" target="_blank"><i class="icon-facebook-sign icon-2x"></i> Visit Us on Facebook</a></p>
        </div>
      </div>
      <div class="col-sm-3 col-sm-pull-3">
        <p>University College at Syracuse University<br />
          700 University Avenue<br />
          Syracuse NY 13244</p>
        <ul class="list-unstyled">
          <li><strong>Phone: </strong><a href="tel:13154434846">315-443-4846</a></li>
          <li><strong>E-mail: </strong><a href="mailto:ocl@syr.edu">ocl@syr.edu</a></li>
        </ul>
        <p class="attribution"><strong>&copy; <?php echo the_time('Y'); ?>
          <?php bloginfo('name'); ?>
          </strong></p>
      </div>
      <div class="col-sm-3 col-sm-pull-9 hidden-xs"> <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/library/images/UC-logo.png" alt="University College of Syracuse University" /> </div>
    </div>
  </div>
  <!-- end #inner-footer --> 
  
</footer>
<!-- end footer --> 

<!-- end #container -->
</div>
<!-- end #container --> 
<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->

<?php wp_footer(); // js scripts are inserted using this function ?>
</body></html>