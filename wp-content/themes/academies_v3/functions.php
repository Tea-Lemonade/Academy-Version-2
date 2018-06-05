<?php
function wp_get_attachment( $attachment_id ) {

	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}
/**
 * Academies_V3 functions and definitions
 *
 * @package Academies_V3
 */

if ( ! function_exists( 'academies_v1_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function academies_v1_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Academies_V1, use a find and replace
	 * to change 'academies_v1' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'academies_v1', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'academies_v1' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'academies_v1_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // academies_v1_setup
add_action( 'after_setup_theme', 'academies_v1_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function academies_v1_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'academies_v1_content_width', 640 );
}
add_action( 'after_setup_theme', 'academies_v1_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function academies_v1_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'academies_v1' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
  register_sidebar( array(
		'name'          => __( 'Home Calendar', 'academies_v1' ),
		'id'            => 'home-calendar',
		'description'   => __( 'Appears in the bottom right section of the home page.', 'parish' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) );
  
}
add_action( 'widgets_init', 'academies_v1_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function academies_v1_scripts() {
  wp_enqueue_script('jquery');
  wp_enqueue_style( 'homepage_carousel-style', get_template_directory_uri().'/carousel/tinycarousel.css' );
 wp_enqueue_script( 'bootstrap-modal', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '20161106', true );
  wp_enqueue_script( 'bootstrap-lightbox', get_template_directory_uri() . '/js/ekko-lightbox.min.js', array(), '20161106', true );
	wp_enqueue_script( 'academies_v3-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
  wp_enqueue_script( 'homepage_carousel', get_template_directory_uri() . '/carousel/jquery.tinycarousel.js', 'jQuery','', true );
  wp_enqueue_script( 'ticker', get_template_directory_uri() . '/js/jquery.webticker.min.js', array(), '20130115', true );
	wp_enqueue_script( 'academies_v3-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
 wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');
wp_enqueue_script( 'academies_v1-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'academies_v1_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

function register_my_menus() {
  register_nav_menus(
    array(
      'footer-menu' => __( 'Footer Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

//Initialize the update checker.
require 'theme-updates/theme-update-checker.php';
$example_update_checker = new ThemeUpdateChecker(
	'Academy Version 3',    //Theme folder name, AKA "slug". 
	'https://beta3.saintsaviourcatholicacademy.org/wp-content/themes/info.json' //URL of the metadata file.
);


/** 
	REGISTER CUSTOM POST TYPE: EVENT 
*/

add_action( 'init', 'register_cpt_event' );

function register_cpt_event() {

	$labels = array( 
		'name' => _x( 'Events', 'event' ),
		'singular_name' => _x( 'Event', 'event' ),
		'add_new' => _x( 'Add New', 'event' ),
		'add_new_item' => _x( 'Add New Event', 'event' ),
		'edit_item' => _x( 'Edit Event', 'event' ),
		'new_item' => _x( 'New Event', 'event' ),
		'view_item' => _x( 'View Event', 'event' ),
		'search_items' => _x( 'Search Events', 'event' ),
		'not_found' => _x( 'No events found', 'event' ),
		'not_found_in_trash' => _x( 'No events found in Trash', 'event' ),
		'parent_item_colon' => _x( 'Parent Event:', 'event' ),
		'menu_name' => _x( 'Events', 'event' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-calendar-alt',
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => array( 'slug' => 'events' ),
		'capability_type' => 'post'
	);

	register_post_type( 'event', $args );
}

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_58965a0221114',
	'title' => 'Alert New',
	'fields' => array(
  array (
			'key' => 'field_5a4d1bc81e2e4',
			'label' => 'Alert',
			'name' => 'alert',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'row',
			'button_label' => '',
			'sub_fields' => array (
		array(
			'key' => 'field_5a4c22d7352c1',
			'label' => 'Alert Active',
			'name' => 'alert_active',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_5a4c0bc98c33a',
			'label' => 'Alert Start Date',
			'name' => 'alert_start_date',
			'type' => 'date_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'display_format' => 'm/d/Y',
			'first_day' => 1,
			'return_format' => 'Y-m-d',
		),
		array(
			'key' => 'field_5a4c0bc98c33b',
			'label' => 'Alert Start Hour',
			'name' => 'alert_start_hour',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5a4c0bc98c33c',
			'label' => 'Alert Start Minute',
			'name' => 'alert_start_minute',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5a4c0bc98c33d',
			'label' => 'Alert Start Time AM-PM',
			'name' => 'alert_start_time_am_pm',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'AM' => 'AM',
				'PM' => 'PM',
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => '',
			'layout' => 'vertical',
			'return_format' => 'value',
		),
		array(
			'key' => 'field_5a4c0bc98c33e',
			'label' => 'Alert End Date',
			'name' => 'alert_end_date',
			'type' => 'date_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'display_format' => 'm/d/Y',
			'first_day' => 1,
			'return_format' => 'Y-m-d',
		),
		array(
			'key' => 'field_5a4c0bc98c33f',
			'label' => 'Alert End Time Hour',
			'name' => 'alert_end_time_hour',
			'type' => 'text',
			'instructions' => 'Should be',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5a4c0bc98c340',
			'label' => 'Alert End Time Minute',
			'name' => 'alert_end_time_minute',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5a4c0bc98c341',
			'label' => 'Alert End Time AM-PM',
			'name' => 'alert_end_time_am_pm',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'AM' => 'AM',
				'PM' => 'PM',
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => '',
			'layout' => 'vertical',
			'return_format' => 'value',
		),
  array(
			'key' => 'field_578d20ed33145',
			'label' => 'Recurring Event',
			'name' => 'recurring_event',
			'type' => 'radio',
			'instructions' => 'Select if this is recurring event, either Daily, Weekly, Monthly or Yearly.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'vertical',
			'choices' => array(
				'Not Recurring' => 'Not Recurring',
				'Daily' => 'Daily',
				'Weekly' => 'Weekly',
				'Monthly' => 'Monthly',
				'Yearly' => 'Yearly',
			),
			'default_value' => 'Not Recurring',
			'other_choice' => 0,
			'save_other_choice' => 0,
			'allow_null' => 0,
			'return_format' => 'value',
		),
		array(
			'key' => 'field_5a4c0bc98c342',
			'label' => 'Alert Text',
			'name' => 'alert_text',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => 138,
		),
		array(
			'key' => 'field_5a4c0bc98c343',
			'label' => 'Alert URL',
			'name' => 'alert_url',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			),
		),
	),
),
	'location' => array(
		array(
			array(
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'homepage-template.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;

/* ***********
	order the posts by ACF Event Start Date field 
*/


function my_pre_get_posts( $query ) {
	// do not modify queries in the admin
	if( is_admin() ) {
		return $query;
	}

	// only modify queries for 'event' post type
	if( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'event' ) {
		$query->set('orderby', 'meta_value_num');	
		$query->set('meta_key', 'event_start_date');	 
		$query->set('order', 'ASC'); 
	}
	
	// return
	return $query;
}

add_action('pre_get_posts', 'my_pre_get_posts');



/* 
Change the read more link for EVENTS 
*/


function excerpt_read_more_link($output) {
    global $post;
    $text = '';
    if ( $post->post_type == 'event' ) 
        $text = '>';
    return $output . '<a class="more-link" href="'. get_permalink($post->ID) . '">'. $text .'</a>';
}
add_filter('the_excerpt', 'excerpt_read_more_link');

set_post_thumbnail_size( 175, 175, true );

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();
	
}
add_filter('post_gallery', 'my_post_gallery', 10, 2);
function my_post_gallery($output, $attr) {
    global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';

    // Here's your actual output, you may customize it to your need
    $output = "<div class=\"slideshow-wrapper\">";
    $output .= "<div class=\"preloader\"></div>";
    $output .= "<gallery>";

    // Now you loop through each attachment
    foreach ($attachments as $id => $attachment) {
        $img = wp_get_attachment_image_src($id, 'thumbnail');
      	$imgL = wp_get_attachment_image_src($id, 'full');
     	$attachment_meta = wp_get_attachment($id);

        $output .= "<a href=\"{$imgL[0]}\" data-toggle=\"lightbox\" data-gallery=\"page-gallery\" data-title=\"".$attachment_meta['caption']."\" data-type=\"image\">";
        $output .= "<img src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />";
      	$output .= "<caption>".$attachment_meta['caption']."</caption>";
        $output .= "</a>";
    }

    $output .= "</gallery>";
    $output .= "</div>";

    return $output;
}

function allow_nbsp_in_tinymce( $mceInit ) {
    $mceInit['entities'] = '160,nbsp,38,amp,60,lt,62,gt';   
    $mceInit['entity_encoding'] = 'named';
    return $mceInit;
}
add_filter( 'tiny_mce_before_init', 'allow_nbsp_in_tinymce' );