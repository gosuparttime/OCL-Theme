<?php



// Homepage Options Dashboard Menu
//$file_url = get_bloginfo('template_directory').'/library/images/custom-post-icon.png';
function home_page_menu() {
  add_menu_page( 'Site Options', 'Site Options', 'edit_posts', 'home-menu', null, '', 32 );
}

add_action('admin_menu', 'home_page_menu');

function comm_page_menu() {
  add_menu_page( 'Community', 'Community', 'edit_posts', 'community-menu', null, '', 33 );
}

add_action('admin_menu', 'comm_page_menu');

add_action( 'init', 'create_post_tax' );

/*add_action( 'init', 'my_new_default_post_type', 1 );
function my_new_default_post_type() {
 
    register_post_type( 'post', array(
        'labels' => array(
            'name_admin_bar' => _x( 'Post', 'add new on admin bar' ),
        ),
        'public'  => true,
        '_builtin' => false, 
        '_edit_link' => 'post.php?post=%d', 
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => array( 'slug' => 'news-events/current-news' ),
        'query_var' => false,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats' ),
    ) );
}
*/
// Custom Post Types
add_action( 'init', 'create_new_slides' );
function create_new_slides() {
	// Add Student Types
	$labels = array(
		'name' => 'Slides',
		 'singular_name' => 'Slide',
		 'menu_name' => 'Slides',
		 'add_new' => 'Add Slide',
		 'add_new_item' => 'Add New Slide',
		 'edit' => 'Edit',
		 'edit_item' => 'Edit Slide',
		 'new_item' => 'New Slide',
		 'view' => 'View Slide',
		 'view_item' => 'View Slide',
		 'search_items' => 'Search Slides',
		 'not_found' => 'No Slides Found',
		 'not_found_in_trash' => 'No Slides Found in Trash',
		 'parent' => 'Parent Slide'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Create new slides for OCL. These are displayed on the homepage',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'page',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'slide'),
		'query_var' => true,
		'exclude_from_search' => true,
		'menu_position' => 1,
		'show_in_menu' => 'home-menu',
		'menu_icon' => get_bloginfo('template_directory') . '/library/images/custom-post-icon.png',  // Icon Path
		'supports' => array('title'),
	);
	register_post_type('slide', $args);
};
function set_slide_columns($columns) {
    return array(
        'cb' => '<input type="checkbox" />',
        'title' => __('Title'),
        'date' => __('Date'),
        'author' => __('Author'),
		'column_1' => __('Slide Image'),
        'column_2' => __('Slide URL'),
    );
}
// POPULATE CUSTOM COLUMNS ON CUSTOM POST
add_action('manage_slide_posts_custom_column', 'add_new_slide_cols', 10, 2);
	function add_new_slide_cols($column, $post_id){
	global $post;
	switch ($column){
	case 'column_1':
	$column_1_content = the_field('slide_image');
	echo $column_1_content;
	case 'column_2':
	$column_2_content = the_field('slide_url');
	echo $column_2_content;
	default:
	break;
	}
}
add_filter('manage_slide_posts_columns' , 'set_slide_columns');
// New Modules For Site
add_action( 'init', 'create_new_modules' );
function create_new_modules() {
	// Add Modules
	$labels = array(
		'name' => 'Modules',
		 'singular_name' => 'Module',
		 'menu_name' => 'Modules',
		 'add_new' => 'Add Module',
		 'add_new_item' => 'Add New Module',
		 'edit' => 'Edit',
		 'edit_item' => 'Edit Module',
		 'new_item' => 'New Module',
		 'view' => 'View Module',
		 'view_item' => 'View Module',
		 'search_items' => 'Search Modules',
		 'not_found' => 'No Modules Found',
		 'not_found_in_trash' => 'No Modules Found in Trash',
		 'parent' => 'Parent Module'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Create new modules for OCL. These can be content blocks for the homepage',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'page',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'module'),
		'query_var' => true,
		'exclude_from_search' => true,
		'menu_position' => 2,
		'show_in_menu' => 'home-menu',
		'menu_icon' => get_bloginfo('template_directory') . '/library/images/custom-post-icon.png',  // Icon Path
		'supports' => array('title', 'editor', 'thumbnail'),
	);
	register_post_type('module', $args);
};
// New Blogs For Site
add_action( 'init', 'create_new_blogs' );
function create_new_blogs() {
	// Add Modules
	$labels = array(
		'name' => 'Blogs',
		 'singular_name' => 'Blog',
		 'menu_name' => 'Blogs',
		 'add_new' => 'Add Blog',
		 'add_new_item' => 'Add New Blog',
		 'edit' => 'Edit',
		 'edit_item' => 'Edit Blog',
		 'new_item' => 'New Blog',
		 'view' => 'View Blog',
		 'view_item' => 'View Blog',
		 'search_items' => 'Search Blogs',
		 'not_found' => 'No Blogs Found',
		 'not_found_in_trash' => 'No Blogs Found in Trash',
		 'parent' => 'Parent Blog'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Create new blogs for OCL. These will show under the "OCL Topic Blogs" page. Any blogs will first have to be added by the Web Administrator before making an entry in this section about it',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'page',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'blog'),
		'query_var' => true,
		'exclude_from_search' => true,
		'menu_position' => 3,
		'show_in_menu' => 'home-menu',
		'menu_icon' => get_bloginfo('template_directory') . '/library/images/custom-post-icon.png',  // Icon Path
		'supports' => array('title', 'editor', 'thumbnail'),
	);
	register_post_type('blogs', $args);
};
// New Stories For Site
add_action( 'init', 'create_new_study' );
function create_new_study() {
	// Add Modules
	$labels = array(
		'name' => 'Studies',
		 'singular_name' => 'Study',
		 'menu_name' => 'Studies',
		 'add_new' => 'Add Study',
		 'add_new_item' => 'Add New Study',
		 'edit' => 'Edit',
		 'edit_item' => 'Edit Study',
		 'new_item' => 'New Study',
		 'view' => 'View Study',
		 'view_item' => 'View Study',
		 'search_items' => 'Search Studies',
		 'not_found' => 'No Studies Found',
		 'not_found_in_trash' => 'No Studies Found in Trash',
		 'parent' => 'Parent Study'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Create new studies for OCL.',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'page',
		'map_meta_cap' => true,
		'hierarchical' => true,
		'rewrite' => array('slug' => 'studies/study-archive'),
		'query_var' => true,
		'exclude_from_search' => true,
		'menu_position' => 36,
		'menu_icon' => get_bloginfo('template_directory') . '/library/images/custom-post-icon.png',  // Icon Path
		'supports' => array('title', 'editor', 'page-attributes'),
	);
	register_post_type('study', $args);
};
function create_study_years()  {

	$labels = array(
		'name'                       => _x( 'Study Years', 'Taxonomy General Name', 'ocl-theme' ),
		'singular_name'              => _x( 'Study Year', 'Taxonomy Singular Name', 'ocl-theme' ),
		'menu_name'                  => __( 'Study Years', 'ocl-theme' ),
		'all_items'                  => __( 'All Study Years', 'ocl-theme' ),
		'parent_item'                => __( 'Parent Study Year', 'ocl-theme' ),
		'parent_item_colon'          => __( 'Parent Study Year:', 'ocl-theme' ),
		'new_item_name'              => __( 'New Study Year', 'ocl-theme' ),
		'add_new_item'               => __( 'Add New Study Year', 'ocl-theme' ),
		'edit_item'                  => __( 'Edit Study Year', 'ocl-theme' ),
		'update_item'                => __( 'Update Study Year', 'ocl-theme' ),
		'separate_items_with_commas' => __( 'Separate study years with commas', 'ocl-theme' ),
		'search_items'               => __( 'Search Study Years', 'ocl-theme' ),
		'add_or_remove_items'        => __( 'Add or Remove Study Year', 'ocl-theme' ),
		'choose_from_most_used'      => __( 'Choose from the most used study years', 'ocl-theme' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'study-year', 'study', $args );
}
// Hook into the 'init' action
add_action( 'init', 'create_study_years', 0 );

// Register Custom Taxonomy
// Add Content Tagging
function add_study_tags()  {

	$labels = array(
		'name'                       => _x( 'Study Keywords', 'Taxonomy General Name', 'ocl-theme' ),
		'singular_name'              => _x( 'Study Keyword', 'Taxonomy Singular Name', 'ocl-theme' ),
		'menu_name'                  => __( 'Study Keyword', 'ocl-theme' ),
		'all_items'                  => __( 'All Study Keywords', 'ocl-theme' ),
		'parent_item'                => __( 'Parent Study Keyword', 'ocl-theme' ),
		'parent_item_colon'          => __( 'Parent Study Keyword:', 'ocl-theme' ),
		'new_item_name'              => __( 'New Study Keyword', 'ocl-theme' ),
		'add_new_item'               => __( 'Add New Study Keyword', 'ocl-theme' ),
		'edit_item'                  => __( 'Edit Study Keyword', 'ocl-theme' ),
		'update_item'                => __( 'Update Study Keyword', 'ocl-theme' ),
		'separate_items_with_commas' => __( 'Separate study keywords with commas', 'ocl-theme' ),
		'search_items'               => __( 'Search Study Keywords', 'ocl-theme' ),
		'add_or_remove_items'        => __( 'Add or Remove Study Keywords', 'ocl-theme' ),
		'choose_from_most_used'      => __( 'Choose from the most used Study Keywords', 'ocl-theme' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => true,
		'rewrite'               	 => array( 'slug' => 'studies/study-archive/study-tags' ),
	);
	register_taxonomy( 'study_tags', 'study', $args );

}

// Hook into the 'init' action
add_action( 'init', 'add_study_tags', 0 );

// New Did You Knows For Site
add_action( 'init', 'create_new_quotes' );
function create_new_quotes() {
	// Add Modules
	$labels = array(
		'name' => 'Quotes',
		 'singular_name' => 'Quote',
		 'menu_name' => 'Quote',
		 'add_new' => 'Add Quote',
		 'add_new_item' => 'Add New Quote',
		 'edit' => 'Edit',
		 'edit_item' => 'Edit Quote',
		 'new_item' => 'New Quote',
		 'view' => 'View Quote',
		 'view_item' => 'View Quote',
		 'search_items' => 'Search Quotes',
		 'not_found' => 'No Quotes Found',
		 'not_found_in_trash' => 'No Quotes Found in Trash',
		 'parent' => 'Parent Quote'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Create new quote feature items for OCL. These are displayed on the homepage',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'page',
		'map_meta_cap' => true,
		'hierarchical' => false,
		//'rewrite' => array('slug' => 'quote'),
		'query_var' => true,
		'exclude_from_search' => true,
		'menu_position' => 3,
		'show_in_menu' => 'home-menu',
		'menu_icon' => get_bloginfo('template_directory') . '/library/images/custom-post-icon.png',  // Icon Path
		'supports' => array('title'),
	);
	register_post_type('quote', $args);
};
//
add_action( 'init', 'create_new_staff' );
function create_new_staff() {
	// Add Student Types
	$labels = array(
		'name' => 'Board Of Directors',
		 'singular_name' => 'Board Member',
		 'menu_name' => 'Board Members',
		 'add_new' => 'Add Board Member',
		 'add_new_item' => 'Add New Board Member',
		 'edit' => 'Edit',
		 'edit_item' => 'Edit Board Member',
		 'new_item' => 'New Board Member',
		 'view' => 'View Board Member',
		 'view_item' => 'View Board Member',
		 'search_items' => 'Search Board Members',
		 'not_found' => 'No Board Members Found',
		 'not_found_in_trash' => 'No Board Members Found in Trash',
		 'parent' => 'Parent Board'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Create new Board Members for OCL.',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'page',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'about-us/board-member'),
		'query_var' => true,
		'exclude_from_search' => true,
		'menu_position' => 35,
		'menu_icon' => get_bloginfo('template_directory') . '/library/images/custom-post-icon.png',  // Icon Path
		'supports' => array('title', 'editor'),
	);
	register_post_type('staff', $args);
};

// Register Custom Taxonomy for Award Types
function add_staff_type()  {

	$labels = array(
		'name'                       => _x( 'Board Member Types', 'Taxonomy General Name', 'ocl-theme' ),
		'singular_name'              => _x( 'Board Member Type', 'Taxonomy Singular Name', 'ocl-theme' ),
		'menu_name'                  => __( 'Board Member Types', 'ocl-theme' ),
		'all_items'                  => __( 'All Board Member Types', 'ocl-theme' ),
		'parent_item'                => __( 'Parent Board Member Type', 'ocl-theme' ),
		'parent_item_colon'          => __( 'Parent Board Member Type:', 'ocl-theme' ),
		'new_item_name'              => __( 'New Board Member Type', 'ocl-theme' ),
		'add_new_item'               => __( 'Add New Board Member Type', 'ocl-theme' ),
		'edit_item'                  => __( 'Edit Board Member Type', 'ocl-theme' ),
		'update_item'                => __( 'Update Board Member Type', 'ocl-theme' ),
		'separate_items_with_commas' => __( 'Separate Board Member types with commas', 'ocl-theme' ),
		'search_items'               => __( 'Search Board Member Types', 'ocl-theme' ),
		'add_or_remove_items'        => __( 'Add or Remove Board Member Types', 'ocl-theme' ),
		'choose_from_most_used'      => __( 'Choose from the most used Board Member Types', 'ocl-theme' ),
	);
	$rewrite = array(
		'slug'                       => 'about-us/board-member',
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'staff-type', 'staff', $args );

}
// Hook into the 'init' action
add_action( 'init', 'add_staff_type', 0 );

// Community Post Type
// Register Custom Post Type
function add_new_comm_event() {

	$labels = array(
		'name'                => _x( 'Community Event', 'Post Type General Name', 'ocl-theme' ),
		'singular_name'       => _x( 'Community Event', 'Post Type Singular Name', 'ocl-theme' ),
		'menu_name'           => __( 'Community Events', 'ocl-theme' ),
		'parent_item_colon'   => __( 'Parent Community Event:', 'ocl-theme' ),
		'all_items'           => __( 'Community Events', 'ocl-theme' ),
		'view_item'           => __( 'View Community Event', 'ocl-theme' ),
		'add_new_item'        => __( 'Add New Community Event', 'ocl-theme' ),
		'add_new'             => __( 'New Community Event', 'ocl-theme' ),
		'edit_item'           => __( 'Edit Community Event', 'ocl-theme' ),
		'update_item'         => __( 'Update Community Event', 'ocl-theme' ),
		'search_items'        => __( 'Search Community Events', 'ocl-theme' ),
		'not_found'           => __( 'No Community Events Found', 'ocl-theme' ),
		'not_found_in_trash'  => __( 'No Community Events found in Trash', 'ocl-theme' ),
	);
	$rewrite = array(
		'slug'                => 'community/events',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'community-event', 'ocl-theme' ),
		'description'         => __( 'OCL Community Events', 'ocl-theme' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'          => array( 'award-type' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position' 	  => 1,
		'show_in_menu'		  => 'community-menu',
		'menu_icon' => get_bloginfo('template_directory') . '/library/images/custom-post-icon.png',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'community-event', $args );

}

// Hook into the 'init' action
add_action( 'init', 'add_new_comm_event', 0 );

// Awards Post Type
// Register Custom Post Type
function add_new_awards() {

	$labels = array(
		'name'                => _x( 'Awards', 'Post Type General Name', 'ocl-theme' ),
		'singular_name'       => _x( 'Award', 'Post Type Singular Name', 'ocl-theme' ),
		'menu_name'           => __( 'Awards', 'ocl-theme' ),
		'parent_item_colon'   => __( 'Parent Award:', 'ocl-theme' ),
		'all_items'           => __( 'Awards', 'ocl-theme' ),
		'view_item'           => __( 'View Award', 'ocl-theme' ),
		'add_new_item'        => __( 'Add New Award', 'ocl-theme' ),
		'add_new'             => __( 'New Award', 'ocl-theme' ),
		'edit_item'           => __( 'Edit Award', 'ocl-theme' ),
		'update_item'         => __( 'Update Award', 'ocl-theme' ),
		'search_items'        => __( 'Search Awards', 'ocl-theme' ),
		'not_found'           => __( 'No Awards Found', 'ocl-theme' ),
		'not_found_in_trash'  => __( 'No Awards found in Trash', 'ocl-theme' ),
	);
	$rewrite = array(
		'slug'                => 'community/awards',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'awards', 'ocl-theme' ),
		'description'         => __( 'OCL Awards and Ceremonies', 'ocl-theme' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'          => array( 'award-type' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position' 	  => 2,
		'show_in_menu'		  => 'community-menu',
		'menu_icon' => get_bloginfo('template_directory') . '/library/images/custom-post-icon.png',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'awards', $args );

}

// Hook into the 'init' action
add_action( 'init', 'add_new_awards', 0 );

// Register Custom Taxonomy for Award Types
function add_award_type()  {

	$labels = array(
		'name'                       => _x( 'Award Types', 'Taxonomy General Name', 'ocl-theme' ),
		'singular_name'              => _x( 'Award Type', 'Taxonomy Singular Name', 'ocl-theme' ),
		'menu_name'                  => __( 'Award Types', 'ocl-theme' ),
		'all_items'                  => __( 'All Award Types', 'ocl-theme' ),
		'parent_item'                => __( 'Parent Award Type', 'ocl-theme' ),
		'parent_item_colon'          => __( 'Parent Award Type:', 'ocl-theme' ),
		'new_item_name'              => __( 'New Award Type', 'ocl-theme' ),
		'add_new_item'               => __( 'Add New Award Type', 'ocl-theme' ),
		'edit_item'                  => __( 'Edit Award Type', 'ocl-theme' ),
		'update_item'                => __( 'Update Award Type', 'ocl-theme' ),
		'separate_items_with_commas' => __( 'Separate award types with commas', 'ocl-theme' ),
		'search_items'               => __( 'Search Award Types', 'ocl-theme' ),
		'add_or_remove_items'        => __( 'Add or Remove Award Types', 'ocl-theme' ),
		'choose_from_most_used'      => __( 'Choose from the most used Award Types', 'ocl-theme' ),
	);
	$rewrite = array(
		'slug'                       => 'community/award-archive',
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'award-type', 'awards', $args );

}
// Hook into the 'init' action
add_action( 'init', 'add_award_type', 0 );

// Register Custom Taxonomy for Award Years
function add_award_year()  {

	$labels = array(
		'name'                       => _x( 'Award Years', 'Taxonomy General Name', 'ocl-theme' ),
		'singular_name'              => _x( 'Award Year', 'Taxonomy Singular Name', 'ocl-theme' ),
		'menu_name'                  => __( 'Award Years', 'ocl-theme' ),
		'all_items'                  => __( 'All Award Years', 'ocl-theme' ),
		'parent_item'                => __( 'Parent Award Year', 'ocl-theme' ),
		'parent_item_colon'          => __( 'Parent Award Year:', 'ocl-theme' ),
		'new_item_name'              => __( 'New Award Year', 'ocl-theme' ),
		'add_new_item'               => __( 'Add New Award Year', 'ocl-theme' ),
		'edit_item'                  => __( 'Edit Award Year', 'ocl-theme' ),
		'update_item'                => __( 'Update Award Year', 'ocl-theme' ),
		'separate_items_with_commas' => __( 'Separate award years with commas', 'ocl-theme' ),
		'search_items'               => __( 'Search Award Years', 'ocl-theme' ),
		'add_or_remove_items'        => __( 'Add or Remove Award Years', 'ocl-theme' ),
		'choose_from_most_used'      => __( 'Choose from the most used Award Years', 'ocl-theme' ),
	);
	$rewrite = array(
		'slug'                       => 'community/awards/award-years',
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => false,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'award-year', 'awards', $args );
}

// Hook into the 'init' action
add_action( 'init', 'add_award_year', 0 );

add_action('admin_menu', 'register_my_custom_submenu_page');
function register_my_custom_submenu_page() {
	add_submenu_page( 'community-menu', 'Add New Event', 'Add New Event', 'edit_posts',' post-new.php?post_type=community-event');
	add_submenu_page( 'community-menu', 'Add New Award', 'Add New Award', 'edit_posts',' post-new.php?post_type=awards');
	add_submenu_page( 'community-menu', 'Award Types', 'Award Types', 'edit_posts',' edit-tags.php?taxonomy=award-type&post_type=awards');
	add_submenu_page( 'community-menu', 'Award Years', 'Award Years', 'edit_posts',' edit-tags.php?taxonomy=award-year&post_type=awards');
	add_submenu_page( 'community-menu', 'Community Options', 'Community Options', 'edit_posts', 'edit.php?page=acf-options-community');
}
//Media Gallery Custom Tax
// Register Custom Taxonomy
function media_directory()  {
	$labels = array(
		'name'                       => _x( 'Media Types', 'Taxonomy General Name', 'ocl-theme' ),
		'singular_name'              => _x( 'Media Type', 'Taxonomy Singular Name', 'ocl-theme' ),
		'menu_name'                  => __( 'Media Types', 'ocl-theme' ),
		'all_items'                  => __( 'All Media Types', 'ocl-theme' ),
		'parent_item'                => __( 'Parent Media Type', 'ocl-theme' ),
		'parent_item_colon'          => __( 'Parent Media Type:', 'ocl-theme' ),
		'new_item_name'              => __( 'New Media Type Name', 'ocl-theme' ),
		'add_new_item'               => __( 'Add New Media Type', 'ocl-theme' ),
		'edit_item'                  => __( 'Edit Media Type', 'ocl-theme' ),
		'update_item'                => __( 'Update Media Type', 'ocl-theme' ),
		'separate_items_with_commas' => __( 'Separate media types with commas', 'ocl-theme' ),
		'search_items'               => __( 'Search Media Types', 'ocl-theme' ),
		'add_or_remove_items'        => __( 'Add or remove media types', 'ocl-theme' ),
		'choose_from_most_used'      => __( 'Choose from the most used media types', 'ocl-theme' ),
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);

	register_taxonomy( 'types', 'attachment', $args );
}

// Hook into the 'init' action
add_action( 'init', 'media_directory', 0 );

// Add Options Pages
if( function_exists('acf_add_options_sub_page') )
{
    acf_add_options_sub_page(array(
        'title' => 'Study Options',
        'parent' => 'edit.php?post_type=study',
        'capability' => 'edit_posts'
    ));
	acf_add_options_sub_page(array(
		'title' => 'Community',
        //'parent' => 'edit.php?post_type=community-event',
        'capability' => 'edit_posts'
    ));
}

/*// Create Sub Pages for Studies
function wpa8582_add_show_children( $post_id ) {  
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;

    if ( !wp_is_post_revision( $post_id )
    && 'study' == get_post_type( $post_id )
    && 'auto-draft' != get_post_status( $post_id ) ) {  
        $show = get_post( $post_id );
        if( 0 == $show->post_parent ){
            $children =& get_children(
                array(
                    'post_parent' => $post_id,
                    'post_type' => 'study'
                )
            );
            if( empty( $children ) ){
				$parent_term = get_the_terms( $post_id, 'study-year' );
				foreach ( $parent_term as $term ) {
					$pub_year = $term->name;
				}
				// Mission Statement
                $mission = array(
                    'post_type' => 'study',
                    'post_title' => $pub_year. ' Mission Statement',
                    'post_content' => '',
                    'post_status' => 'draft',
                    'post_parent' => $post_id,
                    'post_author' => $user_ID,
                    'tax_input' => array( 'study-year' => array( $parent_term ) )
                );
                wp_insert_post( $mission );
				// Study Resources
				$resources = array(
                    'post_type' => 'study',
                    'post_title' => $pub_year. ' Study Resources',
                    'post_content' => '',
                    'post_status' => 'draft',
                    'post_parent' => $post_id,
                    'post_author' => $user_ID,
                    'tax_input' => array( 'study-year' => array( $parent_term ) )
                );
                wp_insert_post( $resources );
				// Committee Notes
				$committee = array(
                    'post_type' => 'study',
                    'post_title' => $pub_year. ' Committee Notes',
                    'post_content' => '',
                    'post_status' => 'draft',
                    'post_parent' => $post_id,
                    'post_author' => $user_ID,
                    'tax_input' => array( 'study-year' => array( $parent_term ) )
                );
                wp_insert_post( $committee );
				$presentations = array(
                    'post_type' => 'study',
                    'post_title' => $pub_year. ' Study Presentations',
                    'post_content' => '',
                    'post_status' => 'draft',
                    'post_parent' => $post_id,
                    'post_author' => $user_ID,
                    'tax_input' => array( 'study-year' => array( $parent_term ) )
                );
                wp_insert_post( $presentations );
            }
        }
    }
}
add_action( 'save_post', 'wpa8582_add_show_children' );

*/
?>