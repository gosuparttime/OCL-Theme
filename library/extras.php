<?
// Display Modules
function display_module($type, $heading, $block, $hide) {
	echo '<div class="clearfix';
	
	echo '" role="complementary">';
    $query = new WP_Query(array( 'post_type' => 'module', 'name' => $type));
    while ( $query->have_posts() ) : $query->the_post();
	if (!$hide){
		echo '<h'.$heading.'>';
		the_title();
		echo '</h'.$heading.'>';
	}
	if (has_post_thumbnail()){
		echo '<div class="pad-one-t">'; 
		the_post_thumbnail('featured');
		echo '</div>'; 
	}
	the_content();//$info; 
    endwhile;
	wp_reset_postdata();
	echo '</div>'; 
}
//Display Quotes
function display_quotes(){
	echo '<div id="myQuote" class="carousel">';
	echo '<div class="controls">';
    echo '<a class="slide-left" href="#myQuote" data-slide="prev"><i class="icon-chevron-left"></i></a><ol class="carousel-indicators sub-slider">';
	$post_num = 0;
    $query = new WP_Query(array( 'post_type' => 'quote'));
	while ( $query->have_posts() ) : $query->the_post();
	echo  '<li data-target="#myQuote" data-slide-to="'.$post_num.'" ';
	if($post_num == 0){ 
		echo 'class="active"';
	}
	echo '>';
	$post_num++;
	echo '</li>';
	endwhile;
    echo '</ol><a class="slide-right" href="#myQuote" data-slide="next"><i class="icon-chevron-right"></i></a>';
	echo '</div>';
    // display quote items
    echo '<div class="carousel-inner">';
	$post_num = 0;
    $query = new WP_Query(array( 'post_type' => 'quote'));
	while ( $query->have_posts() ) : $query->the_post();
	$post_num++;
	// Image swaps?
	$attachment_id = get_field('photo');
	$size = "quote";
	$image = wp_get_attachment_image_src( $attachment_id, $size );
    echo '<div class="item ';
	if($post_num == 1){ 
		echo 'active';
	}
	echo '">';
	echo '<div class="row">';
	echo '<div class="col-xs-8"><div class="pad-one">';
	echo get_field('quote');
	echo '<p>';
	echo get_the_title();
	echo '<br/>';
	echo '<em>';
	echo get_field('position');
	echo '</em></p>';
	echo '</div></div>';
	echo '<div class="col-xs-4">';
	echo '<img src="';
	echo $image[0];
	echo '" alt="';
	the_title();
	echo '" /></div>';
	echo '</div></div>';
	endwhile;
    echo '</div>';
	echo '</div>';
	wp_reset_postdata();
}

//Display Quotes
function display_community(){
	echo '<div id="myComm" class="carousel slide">';
	echo '<div class="controls">';
    echo '<a class="slide-left" href="#myComm" data-slide="prev"><i class="icon-chevron-left"></i></a><ol class="carousel-indicators sub-slider">';
	$post_num = 0;
	$events = get_field('featured_community', 'options');
	$myEvents = array();
	foreach($events as $post){
		$featured_event = $post->ID;
		array_push($myEvents, $featured_event);
	}
	$query = new WP_Query(array( 'post_type' => 'any', 'post__in' => $myEvents));
	while ( $query->have_posts() ) : $query->the_post();
	echo  '<li data-target="#myComm" data-slide-to="'.$post_num.'" ';
	if($post_num == 0){ 
		echo 'class="active"';
	}
	echo '>';
	$post_num++;
	echo '</li>';
	endwhile;
    echo '</ol><a class="slide-right" href="#myComm" data-slide="next"><i class="icon-chevron-right"></i></a>';
	echo '</div>';
    // display quote items
    echo '<div class="carousel-inner">';
	$post_num = 0;
	while ( $query->have_posts() ) : $query->the_post();
	$post_num++;
	// Image swaps?
	 echo '<div class="item ';
	if($post_num == 1){ 
		echo 'active';
	}
	echo '">';
	the_post_thumbnail('featured');
	echo '<div class="carousel-caption">';
	echo '<a href="'.get_permalink().'" title="'.get_the_title().'">';
	echo get_the_title();
	echo '&nbsp;<i class="icon-chevron-right"></i></a>';
	echo '</div></div>';
	endwhile;
    echo '</div>';
	
	echo '</div>';
	
	wp_reset_postdata();
}

// Is Post Type?
function is_post_type($type){
    global $wp_query;
    if($type == get_post_type($wp_query->post->ID)) return true;
    return false;
}
// Module Widget
class ModuleWidget extends WP_Widget
{
  function ModuleWidget()
  {
    $widget_ops = array('classname' => 'ModuleWidget', 'description' => 'Displays information from selected module section within "Homepage Options"' );
    $this->WP_Widget('ModuleWidget', 'Module Widget', $widget_ops);
  }
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'available' => '', 'checkbox' => '', ) );
	$available = $instance['available'];
	$checkbox = $instance['checkbox'];
	$query = new WP_Query(array( 'post_type' => 'module', 'orderby' => 'ASC', 'posts_per_page' => '-1'));?>

<p>
  <label for="<?php echo $this->get_field_id('available'); ?>">Choose A Module: </label>
  <select id="<?php echo $this->get_field_id('available'); ?>" name="<?php echo $this->get_field_name('available'); ?>" class="widefat" style="width:100%;">
    <? while ( $query->have_posts() ) : $query->the_post();
  $id = get_the_ID();?>
    <option <?php selected( $instance['available'], $id ); ?> value="<?php echo $id; ?>"><?php echo the_title(); ?></option>
    <? endwhile;
  	wp_reset_postdata(); ?>
  </select>
<p>
  <input id="<?php echo $this->get_field_id('checkbox'); ?>" name="<?php echo $this->get_field_name('checkbox'); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox ); ?>/>
  <label for="<?php echo $this->get_field_id('checkbox'); ?>">
    <?php _e('Remove Title'); ?>
  </label>
</p>
</p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['checkbox'] = $new_instance['checkbox'];
	$instance['available'] = $new_instance['available'];
    return $instance;
  }
 
    function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
	$checkbox = empty($instance['checkbox']) ? ' ' : apply_filters('widget_title', $instance['checkbox']);
	$available = empty($instance['available']) ? ' ' : apply_filters('widget_title', $instance['available']);
    $query = new WP_Query(array( 'post_type' => 'module', 'page_id' => $available));
    while ( $query->have_posts() ) : $query->the_post();
   
    //$title = the_title();
 	
    //if (!empty($title))
    echo $before_widget;
	
	if ($checkbox !="1"){
		echo $before_title;
		echo the_title();
		echo $after_title;
	}
	
    
    // WIDGET CODE GOES HERE
   
	echo '<div class="clearfix pad-one-b">';
	
	echo the_content();
	
	echo '</div>';
	
    echo $after_widget;
	endwhile;
	wp_reset_postdata();
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("ModuleWidget");') );

// Page Widget
class PageWidget extends WP_Widget
{
  function PageWidget()
  {
    $widget_ops = array('classname' => 'PageWidget', 'description' => 'Displays information from selected page' );
    $this->WP_Widget('PageWidget', 'Page Widget', $widget_ops);
  }
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'available' => '', 'checkbox' => '', ) );
	$available = $instance['available'];
	$checkbox = $instance['checkbox'];
	$query = new WP_Query(array( 'post_type' => 'page', 'orderby' => 'ASC', 'posts_per_page' => '-1'));?>
<p>
  <label for="<?php echo $this->get_field_id('available'); ?>">Choose A Module: </label>
  <select id="<?php echo $this->get_field_id('available'); ?>" name="<?php echo $this->get_field_name('available'); ?>" class="widefat" style="width:100%;">
    <? while ( $query->have_posts() ) : $query->the_post();
  $id = get_the_ID();?>
    <option <?php selected( $instance['available'], $id ); ?> value="<?php echo $id; ?>"><?php echo the_title(); ?></option>
    <? endwhile;
  	wp_reset_postdata(); ?>
  </select>
<p>
  <input id="<?php echo $this->get_field_id('checkbox'); ?>" name="<?php echo $this->get_field_name('checkbox'); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox ); ?>/>
  <label for="<?php echo $this->get_field_id('checkbox'); ?>">
    <?php _e('Remove Title'); ?>
  </label>
</p>
</p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['checkbox'] = $new_instance['checkbox'];
	$instance['available'] = $new_instance['available'];
    return $instance;
  }
 
    function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
	$checkbox = empty($instance['checkbox']) ? ' ' : apply_filters('widget_title', $instance['checkbox']);
	$available = empty($instance['available']) ? ' ' : apply_filters('widget_title', $instance['available']);
    $query = new WP_Query(array( 'post_type' => 'page', 'page_id' => $available));
    while ( $query->have_posts() ) : $query->the_post();
   
    //$title = the_title();
 	
    //if (!empty($title))
    echo $before_widget;
	
	if ($checkbox !="1"){
		echo $before_title;
		echo the_title();
		echo $after_title;
	}
	
    
    // WIDGET CODE GOES HERE
   
  	if (get_field('page_summary')){
		the_field('page_summary');
	} else {
		echo the_excerpt();
	}
	echo '<div class="clearfix pad-one-b"><a class="btn-default" href="';
	echo get_permalink();
	echo '">';
	if (get_field('page_action')){
		the_field('page_action');
	} else {
		echo the_title();
	}
	echo ' <i class="icon-chevron-right"></i></a></div>';
    echo $after_widget;
	endwhile;
	wp_reset_postdata();
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("PageWidget");') );

// Featured Study Widget
class StudyWidget extends WP_Widget
{
  function StudyWidget()
  {
    $widget_ops = array('classname' => 'StudyWidget', 'description' => 'Displays information from the Featured Study' );
    $this->WP_Widget('StudyWidget', 'Featured Study Widget', $widget_ops);
  }

 
    function widget($args)
  {
    extract($args, EXTR_SKIP);
	$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
	$study = get_field('featured_study', 'options');
	foreach($study as $post){
		$featured_study = $post->ID;
	}
	$query = new WP_Query(array( 'post_type' => 'study', 'page_id' => $featured_study));
    while ( $query->have_posts() ) : $query->the_post();
   
    //$title = the_title();
 	
    //if (!empty($title))
    echo $before_widget;
	echo $before_title;
	echo the_title();
	echo $after_title;
    
    // WIDGET CODE GOES HERE
   

	if (get_field('study_excerpt')){
		echo get_field('study_excerpt');
	} else {
		echo get_field('study_summary');
	}
	echo '<div class="clearfix pad-one-b"><a class="btn-default" href="';
	echo get_permalink();
	echo '">';
	if (get_field('page_action')){
		the_field('page_action');
	} else {
		echo 'More on "'.get_the_title().'"';
	}
	echo ' <i class="icon-chevron-right"></i></a></div>';
	echo '<div class="clearfix pad-one-b"><a class="btn-default" href="/studies/past-studies/">View Study Archive <i class="icon-chevron-right"></i></a></div>';
	
	
    echo $after_widget;
	endwhile;
	wp_reset_postdata();
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("StudyWidget");') );

// Current Study Widget
class CurrentWidget extends WP_Widget
{
  function CurrentWidget()
  {
    $widget_ops = array('classname' => 'CurrentWidget', 'description' => 'Displays information from the Current Study' );
    $this->WP_Widget('CurrentWidget', 'Current Study Widget', $widget_ops);
  }

 
    function widget($args)
  {
    extract($args, EXTR_SKIP);
	$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
	$study = get_field('current_study', 'options');
	foreach($study as $post){
		$featured_study = $post->ID;
	}
	$query = new WP_Query(array( 'post_type' => 'study', 'page_id' => $featured_study));
    while ( $query->have_posts() ) : $query->the_post();
   
    //$title = the_title();
 	
    //if (!empty($title))
    echo $before_widget;
	echo $before_title;
	echo the_title();
	echo $after_title;
    
    // WIDGET CODE GOES HERE
   

	echo get_field('study_summary');
	echo '<div class="clearfix pad-one-b"><a class="btn-default" href="';
	echo get_permalink();
	echo '">';
	if (get_field('page_action')){
		the_field('page_action');
	} else {
		echo 'More on "'.get_the_title().'"';
	}
	echo ' <i class="icon-chevron-right"></i></a></div>';
	
	
	
    echo $after_widget;
	endwhile;
	wp_reset_postdata();
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("CurrentWidget");') );
/**
 * Search widget class
 *
 * @since 2.8.0
 */
class WP_Study_Search extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'study_search', 'description' => __( "Study search form for your site") );
		$this->WP_Widget('WP_Study_Search', 'Study Search Widget', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		
		// Use current theme search form if it exists
		?>
<form class="" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
  <input name="s" id="s" type="text" class="form-control" autocomplete="off" placeholder="<?php _e('Search','ocl-theme'); ?>" data-provide="typeahead" data-items="4" data-source='<?php echo $typeahead_data; ?>'>
  <input type="hidden" name="post_type" value="study" />
  <button type="submit" class="btn btn-info mar-half-t">Search <i class="icon-search"></i></button>
</form>
<?
		echo $after_widget;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = $instance['title'];
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e('Title:'); ?>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
</p>
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

}
add_action( 'widgets_init', create_function('', 'return register_widget("WP_Study_Search");') );
/*

/**
 * Search widget class
 *
 * @since 2.8.0
 */
class WP_News_Search extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'news_search', 'description' => __( "News search form for your site") );
		$this->WP_Widget('WP_News_Search', 'News Search Widget', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		
		// Use current theme search form if it exists
		?>
<form class="" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
  <input name="s" id="s" type="text" class="form-control" autocomplete="off" placeholder="<?php _e('Search','ocl-theme'); ?>" data-provide="typeahead" data-items="4" data-source='<?php echo $typeahead_data; ?>'>
  <input type="hidden" name="post_type" value="post" />
  <button type="submit" class="btn btn-info mar-half-t">Search <i class="icon-search"></i></button>
</form>
<?
		echo $after_widget;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = $instance['title'];
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e('Title:'); ?>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
</p>
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

}
add_action( 'widgets_init', create_function('', 'return register_widget("WP_News_Search");') );
/*

function remove_archive_widget() {
	unregister_widget('WP_Widget_Archives');
}

add_action( 'widgets_init', 'remove_archive_widget' );
/**
 * Archives widget class
 *
 * @since 2.8.0
 *//*
class WP_My_Archives extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_archive', 'description' => __( 'A monthly archive of your site&#8217;s posts') );
		parent::__construct('archives', __('Archives'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Archives') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		if ( $d ) {
?>
		<select class="form-control" name="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'> <option value=""><?php echo esc_attr(__('Select Month')); ?></option> <?php wp_get_archives(apply_filters('widget_archives_dropdown_args', array('type' => 'monthly', 'format' => 'option', 'show_post_count' => $c))); ?> </select>
<?php
		} else {
?>
		<ul>
		<?php wp_get_archives(apply_filters('widget_archives_args', array('type' => 'monthly', 'show_post_count' => $c))); ?>
		</ul>
<?php
		}

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '', 'count' => 0, 'dropdown' => '') );
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = $new_instance['count'] ? 1 : 0;
		$instance['dropdown'] = $new_instance['dropdown'] ? 1 : 0;

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => 0, 'dropdown' => '') );
		$title = strip_tags($instance['title']);
		$count = $instance['count'] ? 'checked="checked"' : '';
		$dropdown = $instance['dropdown'] ? 'checked="checked"' : '';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $dropdown; ?> id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>" /> <label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e('Display as dropdown'); ?></label>
			<br/>
			<input class="checkbox" type="checkbox" <?php echo $count; ?> id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" /> <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Show post counts'); ?></label>
		</p>
<?php
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("WP_My_Archives");') );

// Remove Default Categories Widget
function remove_categories_widget() {
	unregister_widget('WP_Widget_Categories');
}
add_action( 'widgets_init', 'remove_categories_widget' );

/**
 * Categories widget class
 *
 * @since 2.8.0
 *//*
class WP_My_Categories extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_categories', 'description' => __( "A list or dropdown of categories" ) );
		parent::__construct('categories', __('Categories'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Categories' ) : $instance['title'], $instance, $this->id_base);
		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		$cat_args = array('orderby' => 'name', 'show_count' => $c, 'hierarchical' => $h);

		if ( $d ) {
			$cat_args['show_option_none'] = __('Select Category');
			wp_dropdown_categories(apply_filters('widget_categories_dropdown_args', $cat_args));
?>

<script type='text/javascript'>
/* <![CDATA[ *//*
	var dropdown = document.getElementById("cat");
	function onCatChange() {
		if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
			location.href = "<?php echo home_url(); ?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
		}
	}
	dropdown.onchange = onCatChange;
/* ]]> *//*
</script>

<?php
		} else {
?>
		<ul class="list-unstyled">
<?php
		$cat_args['title_li'] = '';
		wp_list_categories(apply_filters('widget_categories_args', $cat_args));
?>
		</ul>
<?php
		}

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = !empty($new_instance['count']) ? 1 : 0;
		$instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
		$instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = esc_attr( $instance['title'] );
		$count = isset($instance['count']) ? (bool) $instance['count'] :false;
		$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
		$dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>"<?php checked( $dropdown ); ?> />
		<label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e( 'Display as dropdown' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
		<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked( $hierarchical ); ?> />
		<label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e( 'Show hierarchy' ); ?></label></p>
<?php
	}

}
add_action( 'widgets_init', create_function('', 'return register_widget("WP_My_Categories");') );
*/
?>
